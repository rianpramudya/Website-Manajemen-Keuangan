<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        
        // 1. Ambil Filter Tanggal (Default: Awal s/d Akhir Bulan Ini)
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Format Label Periode
        $periodLabel = Carbon::parse($startDate)->translatedFormat('d M Y') . ' - ' . Carbon::parse($endDate)->translatedFormat('d M Y');

        // 2. Query Data Berdasarkan Rentang Tanggal
        $totalIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount');

        $totalExpense = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount');

        $cashflow = $totalIncome - $totalExpense;

        // 3. Grafik Kategori
        $expenseByCategory = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereBetween('date', [$startDate, $endDate])
            ->with('category')
            ->select('category_id', DB::raw('sum(amount) as total'))
            ->groupBy('category_id')
            ->get();

        $chartLabels = [];
        $chartData = [];
        foreach ($expenseByCategory as $data) {
            $chartLabels[] = $data->category->name ?? 'Tanpa Kategori';
            $chartData[] = $data->total;
        }

        // 4. Estimasi Tagihan (Tetap ambil dari Master Data Bill, tidak terpengaruh tanggal karena ini 'forecast')
        $bills = Bill::where('user_id', $userId)->get();
        $totalEstimatedBills = 0;

        foreach($bills as $bill) {
            if($bill->frequency == 'weekly') {
                $totalEstimatedBills += ($bill->amount * 4);
            } else {
                $totalEstimatedBills += $bill->amount;
            }
        }
        
        $disposableIncome = $totalIncome - $totalEstimatedBills;

        return view('reports.index', [
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'cashflow' => $cashflow,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            'totalEstimatedBills' => $totalEstimatedBills,
            'disposableIncome' => $disposableIncome,
            'periodLabel' => $periodLabel,
            'startDate' => $startDate, // Kirim balik ke view untuk isi value input date
            'endDate' => $endDate
        ]);
    }

    // --- FITUR EXPORT PDF DENGAN FILTER ---
    public function exportPdf(Request $request)
    {
        $userId = Auth::id();
        
        // Ambil Filter Tanggal dari URL Parameter
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        
        $dateLabel = Carbon::parse($startDate)->translatedFormat('d M Y') . ' - ' . Carbon::parse($endDate)->translatedFormat('d M Y');

        // Query Data (Sama dengan Index)
        $totalIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount');

        $totalExpense = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount');

        $cashflow = $totalIncome - $totalExpense;

        // Detail Transaksi untuk Tabel PDF
        $transactions = Transaction::where('user_id', $userId)
            ->whereBetween('date', [$startDate, $endDate])
            ->with('category')
            ->orderBy('date', 'desc')
            ->get();

        // Breakdown Kategori
        $expenseByCategory = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereBetween('date', [$startDate, $endDate])
            ->with('category')
            ->select('category_id', DB::raw('sum(amount) as total'))
            ->groupBy('category_id')
            ->get();

        $pdf = Pdf::loadView('reports.pdf', [
            'user' => Auth::user(),
            'monthName' => $dateLabel, // Sekarang menampilkan range tanggal
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'cashflow' => $cashflow,
            'transactions' => $transactions,
            'expenseByCategory' => $expenseByCategory
        ]);

        return $pdf->download('Laporan-Keuangan-'.$startDate.'-'.$endDate.'.pdf');
    }
}