<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan Dompet Rantau</title>
    <style>
        /* BASE & TYPOGRAPHY */
        body { 
            font-family: Arial, sans-serif; 
            color: #1e293b; /* Slate-800 */
            margin: 0;
            padding: 30px;
            background-color: #f8fafc; /* Lighter background */
        }
        
        /* HEADER (Clean & Bold - MODIFIED FOR VIBRANT BANK JAGO STYLE) */
        .header { 
            text-align: center; 
            margin-bottom: 40px; 
            padding: 25px 20px; /* Padding lebih besar */
            border-bottom: 1px solid #e2e8f0; 
            border-radius: 18px; /* Rounded corners */
            
            /* Warna Header Futuristik */
            background-color: #312e81; /* Indigo-800 Dark Base */
            color: #e0e7ff; /* Text Light Indigo */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            /* Optional: subtle vertical gradient */
            background-image: linear-gradient(to bottom, #4f46e5, #3730a3); 
        }
        .header h1 { 
            margin: 0; 
            font-size: 28px; 
            color: #ffffff; /* White text for contrast */
            font-weight: 900;
            letter-spacing: 1px;
        }
        .header p { 
            margin: 5px 0 0; 
            color: #c7d2fe; /* Indigo-200 */
            font-size: 14px; 
            font-weight: 500;
        }
        
        /* SUMMARY GRID (Card Style) */
        .summary-box { 
            width: 100%; 
            margin-bottom: 30px; 
            border-spacing: 15px; /* Gap antar kolom */
        }
        .summary-box-cell { 
            width: 33%; 
            padding: 20px; 
            text-align: center; 
            background: #ffffff; 
            border: 1px solid #e0e7ff; /* Indigo-100 */
            border-radius: 18px; 
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            background-image: linear-gradient(to bottom right, #ffffff, #f9faff);
        }
        .summary-label { 
            display: block; 
            font-size: 11px; 
            text-transform: uppercase; 
            color: #6366f1; /* Indigo-500 (Primary accent) */
            margin-bottom: 8px; 
            font-weight: 700; 
            letter-spacing: 0.8px;
        }
        .summary-value { 
            font-size: 26px; 
            font-weight: 900; 
            line-height: 1.2;
        }
        
        /* COLOR UTILITIES */
        .text-success { color: #10b981; } /* Emerald-500 */
        .text-danger { color: #f43f5e; } /* Rose-500 */
        .text-primary { color: #3b82f6; } /* Blue-500 */
        
        /* SECTION TITLES (Clean Block) */
        .section-title { 
            font-size: 20px; 
            font-weight: 800; 
            margin: 30px 0 15px; 
            padding-bottom: 5px;
            color: #0f172a; 
            border-bottom: 2px solid #f1f5f9; /* Subtle divider */
        }
        
        /* TABLE STYLING (Modern Grid) */
        .transaction-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 20px; 
            font-size: 13px;
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .transaction-table thead {
            background-color: #6366f1; /* Indigo-500 Header */
        }
        th { 
            text-align: left; 
            padding: 15px 12px; 
            font-weight: 600; 
            color: #ffffff; 
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }
        td { 
            border-bottom: 1px solid #f1f5f9; /* Slate-100 row divider */
            padding: 12px; 
            color: #334155; 
        }
        .text-right { text-align: right; }
        
        /* BADGES (Pill Style) */
        .badge { 
            padding: 4px 12px; 
            border-radius: 9999px; /* Full pill */
            font-size: 10px; 
            font-weight: bold;
            display: inline-block; 
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .badge-income { 
            background: #d1fae5; /* Emerald-100 */
            color: #065f46; /* Emerald-900 */
        }
        .badge-expense { 
            background: #ffe4e6; /* Rose-100 */
            color: #9f1239; /* Rose-900 */
        }

        /* FOOTER */
        .footer {
            text-align: center; 
            margin-top: 40px; 
            font-size: 11px; 
            color: #94a3b8; /* Slate-400 */
            padding-top: 10px;
        }

    </style>
</head>
<body>

    <div class="header">
        <h1>LAPORAN KEUANGAN DOMPET RANTAU</h1>
        <p>Periode: {{ $monthName }} | Pemilik: {{ $user->name }}</p>
    </div>

    <!-- Ringkasan -->
    <table class="summary-box">
        <tr>
            <td class="summary-box-cell">
                <span class="summary-label">Pemasukan</span>
                <span class="summary-value text-success">Rp {{ number_format($totalIncome, 0, ',', '.') }}</span>
            </td>
            <td class="summary-box-cell">
                <span class="summary-label">Pengeluaran</span>
                <span class="summary-value text-danger">Rp {{ number_format($totalExpense, 0, ',', '.') }}</span>
            </td>
            <td class="summary-box-cell">
                <span class="summary-label">Arus Kas Bersih</span>
                <span class="summary-value {{ $cashflow >= 0 ? 'text-primary' : 'text-danger' }}">
                    Rp {{ number_format($cashflow, 0, ',', '.') }}
                </span>
            </td>
        </tr>
    </table>

    <!-- Breakdown Kategori -->
    <div class="section-title">Rincian Pengeluaran per Kategori</div>
    <table class="transaction-table">
        <thead>
            <tr>
                <th>Kategori</th>
                <th class="text-right">Total</th>
                <th class="text-right">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenseByCategory as $cat)
                @php $percent = $totalExpense > 0 ? ($cat->total / $totalExpense) * 100 : 0; @endphp
                <tr>
                    <td>{{ $cat->category->name ?? 'Lainnya' }}</td>
                    <td class="text-right">Rp {{ number_format($cat->total, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($percent, 1) }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <!-- Riwayat Transaksi -->
    <div class="section-title">Riwayat Transaksi Bulan Ini</div>
    <table class="transaction-table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th class="text-right">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
            <tr>
                <td>{{ \Carbon\Carbon::parse($trx->date)->format('d/m/Y') }}</td>
                <td>
                    <span class="badge {{ $trx->type == 'income' ? 'badge-income' : 'badge-expense' }}">
                        {{ $trx->category->name ?? 'Umum' }}
                    </span>
                </td>
                <td>{{ $trx->description ?: '-' }}</td>
                <td class="text-right {{ $trx->type == 'income' ? 'text-success' : 'text-danger' }}">
                    {{ $trx->type == 'income' ? '+' : '-' }} Rp {{ number_format($trx->amount, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak otomatis oleh sistem Dompet Rantau pada {{ date('d M Y H:i') }}
    </div>

</body>
</html>