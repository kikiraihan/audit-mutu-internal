<?php

namespace App\Http\Livewire;

use App\Models\Auditee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard',[
            'pie_auditee' => $this->getDataPieAuditee(),
            'line_form_ami' => $this->getDataLineFormAmi(),
        ]);
    }

    public function getDataPieAuditee(){
        $categories = ['fakultas', 'jurusan', 'prodi'];
        $rowCounts = [];
        foreach ($categories as $category) {
            $rowCounts[$category] = Auditee::where('level', $category)->count();
        }
        return [
            'categories' => $categories,
            'rowCounts' => $rowCounts
        ];
    }

    public function getDataLineFormAmi(){
        // Mendapatkan bulan ini
        $currentMonth = Carbon::now()->toDateTimeString();
        // Mendapatkan 5 bulan sebelum bulan ini
        $startDate = Carbon::now()->subMonths(8)->toDateTimeString();
        // Mendapatkan 5 bulan setelah bulan ini
        $endDate = Carbon::now()->addMonths(8)->toDateTimeString();

        // Mengambil data yang dikelompokkan berdasarkan bulan dan menghitung jumlah baris
        $data = DB::table('form_ami_dokumens')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") AS month'), DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('month')
            ->get();

        // Memisahkan data bulan dan jumlah baris menjadi dua variabel terpisah
        $bulan = $data->pluck('month')->toArray();
        $jumlahBaris = $data->pluck('count')->toArray();
        return [
            'bulan' => $bulan,
            'rowCounts' => $jumlahBaris
        ];
    }
}
