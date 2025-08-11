<?php

namespace App\Http\Controllers;

use App\Imports\TransactionImport;
use Carbon\Carbon;
use App\Models\CardMember;
use App\Models\Transaction;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller {
    //

    public function import(Request $request) {
        // dd($request->file('file'));
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        try {
            Excel::import(new TransactionImport, $request->file('file'));
        } catch (\Exception $e) {
            return redirect(route('table.transaction'))->with('failed', $e->getMessage());
        }

        return redirect(route('table.transaction'))->with('successTransaction', 'Data berhasil di import.');
    }

    public function index() {
        $query = Transaction::query();

        if (request()->has('search')) {
            $search = request()->input('search');
            $query->whereAny(['trans_no', 'member_card_no'], 'like', "%$search%")
                ->orWhereHas('member', function ($q) use ($search) {
                    $q->where('nama', 'like', "%$search%");
                });
        }

        if (request()->filled('tanggal_mulai') && request()->filled('tanggal_selesai')) {
            $tanggal_mulai = request('tanggal_mulai');
            $tanggal_selesai = request('tanggal_selesai');
            // dd([$tanggal_mulai, $tanggal_selesai]);

            // if ($tanggal_mulai === null || $tanggal_selesai === null) {
            //     return null;
            // }

            $query->whereBetween('trans_date', [$tanggal_mulai . ' 00:00:00', $tanggal_selesai . ' 23:59:59']);
        }

        $transactions = $query->latest()->paginate(10);
        return view('auth.table_customer', [
            'transactions' => $transactions
        ]);
    }

    public function viewDashboard() {
        $paginatedTransactions = Auth::user()->member?->transactions()->paginate(10) ?? collect();
        $allTransactions = Auth::user()->member?->transactions;
        $total_poin = 0;
        $trans_total = 0;
        if ($allTransactions) {
            $total_poin = $allTransactions->sum('trans_poin_pas');
            $trans_total = $allTransactions->sum('trans_total_transaction');
        }
        $is_member_active = Auth::user()->member?->is_active;

        $data = [];
        if ($allTransactions) {
            $currentYear = now()->year;
             // Filter transaksi untuk tahun ini
            $transactionsThisYear = $allTransactions->filter(function ($transaction) use ($currentYear) {
            return \Carbon\Carbon::parse($transaction->trans_date)->year == $currentYear;
            });
            
             $totalPerMonth = $transactionsThisYear
            ->groupBy(function ($transaction) {
                return \Carbon\Carbon::parse($transaction->trans_date)->format('m');
            })->map(function ($group) {
                return round($group->sum('trans_total_transaction'));
            });

            $months = range(1, 12);
            // $data = [];

            foreach ($months as $month) {
                $data[] = $totalPerMonth->get(str_pad($month, 2, '0', STR_PAD_LEFT), 0);
            }
        }

        $chart = (new LarapexChart)->horizontalBarChart()
            // ->setTitle('Grafik Belanja Tahunan')
            // ->setSubtitle('Tahun' . date('Y'))
            ->addData('total transaksi Rp', $data)
            ->setColors(['#FFC107', '#303F9F'])
            ->setXAxis([
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'Mei',
                'Jun',
                'Jul',
                'Agu',
                'Sep',
                'Okt',
                'Nov',
                'Des'
            ]);

        return view('auth.new_dashboard', [
            'transactions' => $paginatedTransactions,
            'total_poin' => $total_poin,
            'trans_total' => $trans_total,
            'is_member_active' => $is_member_active,
            'chart' => $chart
        ]);
    }
}
