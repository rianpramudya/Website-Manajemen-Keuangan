<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    // ... (Method index, listCategories, show, storeCategory, storeTransaction, storeTransfer TETAP SAMA) ...

    // --- Method index() Tetap Sama ---
    public function index()
    {
        $userId = Auth::id();
        $totalIncome = Transaction::where('user_id', $userId)->where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('user_id', $userId)->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $displayPockets = Category::where('user_id', $userId)->latest()->take(3)->get()->map(function ($category) {
            $catIncome = $category->transactions()->where('type', 'income')->sum('amount');
            $catExpense = $category->transactions()->where('type', 'expense')->sum('amount');
            $category->balance = $catIncome - $catExpense;
            return $category;
        });

        $allCategories = Category::where('user_id', $userId)->get()->map(function ($category) {
            $catIncome = $category->transactions()->where('type', 'income')->sum('amount');
            $catExpense = $category->transactions()->where('type', 'expense')->sum('amount');
            $category->balance = $catIncome - $catExpense;
            return $category;
        });

        // Ambil 10 transaksi terakhir untuk dashboard
        $transactions = Transaction::where('user_id', $userId)->with('category')->latest()->take(10)->get();

        return view('dashboard', [
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance,
            'transactions' => $transactions,
            'displayPockets' => $displayPockets,
            'categories' => $allCategories
        ]);
    }

    // --- FITUR BARU: HALAMAN SEMUA RIWAYAT TRANSAKSI ---
    public function history()
    {
        $userId = Auth::id();

        // Ambil semua transaksi
        $allTransactions = Transaction::where('user_id', $userId)->with('category')->latest()->get();

        // Pisahkan Pemasukan & Hitung Totalnya
        $incomeTransactions = $allTransactions->where('type', 'income');
        $totalIncome = $incomeTransactions->sum('amount');

        // Pisahkan Pengeluaran & Hitung Totalnya
        $expenseTransactions = $allTransactions->where('type', 'expense');
        $totalExpense = $expenseTransactions->sum('amount');

        return view('transactions.history', compact(
            'incomeTransactions',
            'expenseTransactions',
            'totalIncome',
            'totalExpense'
        ));
    }

    // ... (Method listCategories, show, storeCategory, storeTransaction, storeTransfer, destroyTransaction TETAP SAMA) ...

    public function listCategories()
    {
        $userId = Auth::id();
        $categories = Category::where('user_id', $userId)->get()->map(function ($category) {
            $income = $category->transactions()->where('type', 'income')->sum('amount');
            $expense = $category->transactions()->where('type', 'expense')->sum('amount');
            $category->balance = $income - $expense;
            return $category;
        });
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        if ($category->user_id !== Auth::id()) abort(403);
        $income = $category->transactions()->where('type', 'income')->sum('amount');
        $expense = $category->transactions()->where('type', 'expense')->sum('amount');
        $balance = $income - $expense;
        $transactions = $category->transactions()->latest()->get();
        return view('categories.show', compact('category', 'balance', 'transactions'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
        ]);
        Category::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'type' => $request->type,
        ]);
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function storeTransaction(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1|max:9999999999999',
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255'
        ]);
        Transaction::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'type' => $request->type,
            'date' => $request->date,
            'description' => $request->description
        ]);
        return redirect()->back()->with('success', 'Transaksi berhasil dicatat!');
    }

    public function storeTransfer(Request $request)
    {
        $request->validate([
            'from_category_id' => 'required|exists:categories,id',
            'to_category_id'   => 'required|exists:categories,id|different:from_category_id',
            'amount'           => 'required|numeric|min:1|max:9999999999999',
            'date'             => 'required|date',
        ]);
        $fromCat = Category::find($request->from_category_id);
        $currentBalance =
            $fromCat->transactions()->where('type', 'income')->sum('amount') -
            $fromCat->transactions()->where('type', 'expense')->sum('amount');

        if ($request->amount > $currentBalance) {
            return redirect()->back()->withErrors(['amount' => 'Saldo kantong sumber tidak mencukupi!']);
        }
        DB::transaction(function () use ($request, $fromCat) {
            $user_id = Auth::id();
            $toCat = Category::find($request->to_category_id);
            Transaction::create([
                'user_id'     => $user_id,
                'category_id' => $request->from_category_id,
                'amount'      => $request->amount,
                'type'        => 'expense',
                'date'        => $request->date,
                'description' => "Transfer ke " . $toCat->name,
            ]);
            Transaction::create([
                'user_id'     => $user_id,
                'category_id' => $request->to_category_id,
                'amount'      => $request->amount,
                'type'        => 'income',
                'date'        => $request->date,
                'description' => "Terima dari " . $fromCat->name,
            ]);
        });
        return redirect()->back()->with('success', 'Berhasil memindahkan uang!');
    }

    public function destroyTransaction(Transaction $transaction)
    {
        if ($transaction->user_id != Auth::id()) abort(403);
        $transaction->delete();
        return redirect()->back()->with('success', 'Transaksi dihapus.');
    }

    // --- METHOD BARU: HAPUS KANTONG ---
    public function destroyCategory(Category $category)
    {
        // Pastikan yang menghapus adalah pemilik kantong
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }

        // Hapus SEMUA transaksi yang terkait dengan kategori ini terlebih dahulu
        // Ini agar saldo dari transaksi tersebut hilang dari perhitungan Total Aset
        $category->transactions()->delete();

        // Setelah isinya bersih, baru hapus kategorinya
        $category->delete();

        // Redirect ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Kantong dan semua isinya berhasil dihapus. Saldo telah disesuaikan.');
    }
}
