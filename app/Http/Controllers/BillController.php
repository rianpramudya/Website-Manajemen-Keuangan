<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BillController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // 1. Ambil semua tagihan user
        $rawBills = Bill::where('user_id', $userId)
            ->orderBy('due_date', 'asc')
            ->get();

        // 2. Hitung status pembayaran
        $bills = $rawBills->map(function ($bill) use ($currentMonth, $currentYear) {
            $paidAmount = $bill->transactions()
                ->where('type', 'expense')
                ->whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->sum('amount');

            $bill->paid_amount = $paidAmount;
            $bill->remaining_amount = max(0, $bill->amount - $paidAmount);

            if ($bill->remaining_amount == 0 && $bill->amount > 0) {
                $bill->status = 'paid';
            } elseif ($paidAmount > 0) {
                $bill->status = 'partial';
            } else {
                $bill->status = 'unpaid';
            }

            return $bill;
        });

        // 3. Hitung Saldo Bersih (Hanya dari Kantong tipe 'income')
        $savingCategoryIds = Category::where('user_id', $userId)
            ->where('type', 'income')
            ->pluck('id');

        $savingIncome = Transaction::where('user_id', $userId)
            ->whereIn('category_id', $savingCategoryIds)
            ->where('type', 'income')
            ->sum('amount');

        $savingExpense = Transaction::where('user_id', $userId)
            ->whereIn('category_id', $savingCategoryIds)
            ->where('type', 'expense')
            ->sum('amount');

        $currentBalance = $savingIncome - $savingExpense;

        // 4. Ambil Sumber Dana (HANYA Kantong tipe 'income')
        // Agar pembayaran memotong Saldo Bersih
        $fundingSources = Category::where('user_id', $userId)
            ->where('type', 'income')
            ->get();

        return view('bills.index', compact('bills', 'currentBalance', 'fundingSources'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'due_date' => 'nullable|integer|min:1|max:31',
            'frequency' => 'required|in:monthly,weekly,one_time'
        ]);

        Bill::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'amount' => $request->amount,
            'due_date' => $request->due_date,
            'frequency' => $request->frequency,
        ]);

        return redirect()->back()->with('success', 'Tagihan berhasil ditambahkan.');
    }

    public function update(Request $request, Bill $bill)
    {
        if ($bill->user_id !== Auth::id()) abort(403);

        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'due_date' => 'nullable|integer|min:1|max:31',
            'frequency' => 'required|in:monthly,weekly,one_time'
        ]);

        $bill->update([
            'name' => $request->name,
            'amount' => $request->amount,
            'due_date' => $request->due_date,
            'frequency' => $request->frequency,
        ]);

        return redirect()->back()->with('success', 'Data tagihan berhasil diperbarui.');
    }

    public function pay(Request $request, Bill $bill)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'date' => 'required|date',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        // LOGIKA BARU:
        // Jika user memilih kategori, pakai itu.
        // Jika tidak (null), cari Kantong Nabung (income) pertama agar saldo bersih berkurang.
        $categoryId = $request->category_id;

        if (!$categoryId) {
            $defaultSource = Category::where('user_id', Auth::id())
                ->where('type', 'income')
                ->first();
            $categoryId = $defaultSource ? $defaultSource->id : null;
        }

        Transaction::create([
            'user_id' => Auth::id(),
            'bill_id' => $bill->id,
            'category_id' => $categoryId, // Ini penting agar saldo bersih berkurang
            'type' => 'expense',
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => 'Bayar Tagihan: ' . $bill->name
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil dicatat!');
    }

    public function bulkPay(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'payments' => 'required|array',
            'payments.*.bill_id' => 'required|exists:bills,id',
            'payments.*.amount' => 'nullable|numeric|min:0',
        ]);

        // Ambil default funding source (Kantong Nabung Utama)
        $defaultSource = Category::where('user_id', Auth::id())
            ->where('type', 'income')
            ->first();

        $defaultSourceId = $defaultSource ? $defaultSource->id : null;

        $count = 0;

        foreach ($request->payments as $payment) {
            // PERBAIKAN ERROR DISINI:
            // Tambahkan pengecekan `isset($payment['amount'])`
            if (!empty($payment['selected']) && isset($payment['amount']) && $payment['amount'] > 0) {

                $bill = Bill::find($payment['bill_id']);

                if ($bill && $bill->user_id == Auth::id()) {
                    Transaction::create([
                        'user_id' => Auth::id(),
                        'bill_id' => $bill->id,
                        'category_id' => $defaultSourceId, // Otomatis pakai Kantong Nabung
                        'type' => 'expense',
                        'amount' => $payment['amount'],
                        'date' => $request->date,
                        'description' => 'Bayar Tagihan (Bulk): ' . $bill->name
                    ]);
                    $count++;
                }
            }
        }

        if ($count > 0) {
            return redirect()->back()->with('success', $count . ' tagihan berhasil dibayarkan dari Saldo Bersih!');
        } else {
            return redirect()->back()->with('error', 'Tidak ada tagihan yang dipilih.');
        }
    }

    public function addFunds(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:1']);

        $defaultIncomeCategory = Category::where('user_id', Auth::id())->where('type', 'income')->first();

        Transaction::create([
            'user_id' => Auth::id(),
            'category_id' => $defaultIncomeCategory ? $defaultIncomeCategory->id : null,
            'type' => 'income',
            'amount' => $request->amount,
            'date' => now(),
            'description' => 'Tambah Saldo (Menu Tagihan)'
        ]);

        return redirect()->back()->with('success', 'Saldo berhasil ditambahkan.');
    }

    public function destroy(Bill $bill)
    {
        if ($bill->user_id !== Auth::id()) abort(403);
        $bill->delete();
        return redirect()->back()->with('success', 'Data tagihan dihapus.');
    }
}
