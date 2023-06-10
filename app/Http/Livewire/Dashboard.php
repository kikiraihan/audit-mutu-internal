<?php

namespace App\Http\Livewire;

use App\Models\Auditee;
use App\Models\FormAmiDokumen;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $this->getDataLineKTSPerAuditees();

        return view('livewire.dashboard',[
            'pie_auditee' => $this->getDataPieAuditee(),
            'line_form_ami' => $this->getDataLineFormAmi(),
            'line_kts' => $this->getDataLineKTS(),
            'line_kts_per_audite'=>$this->getDataLineKTSPerAuditees(),
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

    public function getDataLineKTS(){
        $currentMonth = Carbon::now()->month;

        if ($currentMonth >= 1 && $currentMonth <= 6) {
            $group1Year = Carbon::now()->year;
            $group2Year = Carbon::now()->year - 1;
        } else {
            $group1Year = Carbon::now()->year;
            $group2Year = Carbon::now()->year + 1;
        }

        //ganjil
        $group1 = DB::table('jawaban_form_ami_dokumens')
            ->join('form_ami_dokumens', 'jawaban_form_ami_dokumens.id_form_ami_dokumen', '=', 'form_ami_dokumens.id')
            ->whereMonth('form_ami_dokumens.created_at', '>=', 7) // Grup 1: bulan Juni hingga Desember
            ->whereMonth('form_ami_dokumens.created_at', '<=', 12)
            ->whereYear('form_ami_dokumens.created_at', '=', $group1Year)
            ->where('jawaban_form_ami_dokumens.kts', 'kts')
            ->count();

        //genap
        $group2 = DB::table('jawaban_form_ami_dokumens')
            ->join('form_ami_dokumens', 'jawaban_form_ami_dokumens.id_form_ami_dokumen', '=', 'form_ami_dokumens.id')
            ->whereMonth('form_ami_dokumens.created_at', '>=', 1) // Grup 2: bulan Januari hingga Juni
            ->whereMonth('form_ami_dokumens.created_at', '<=', 6)
            ->whereYear('form_ami_dokumens.created_at', '=', $group2Year)
            ->where('jawaban_form_ami_dokumens.kts', 'kts')
            ->count();

        return [
            'currentYear'=> Carbon::now()->year,
            'group' => ['ganjil', 'genap'],
            'counts' => [$group1,$group2],
        ];
    }

    public function getDataLineKTSPerAuditees(){
        $currentMonth = Carbon::now()->month;

        $data = FormAmiDokumen::select('auditees.id_user', 'auditees.level', 'users.name')
            ->join('auditees', 'form_ami_dokumens.id_user_auditee', '=', 'auditees.id_user')
            ->join('users', 'auditees.id_user', '=', 'users.id')
            ->join('jawaban_form_ami_dokumens', 'form_ami_dokumens.id', '=', 'jawaban_form_ami_dokumens.id_form_ami_dokumen')
            ->where('jawaban_form_ami_dokumens.kts', 'kts')
            ->groupBy('auditees.id_user', 'auditees.level', 'users.name');

        if ($currentMonth >= 1 && $currentMonth <= 6) {
            // Bulan Januari hingga Juni
            $previousYear = Carbon::now()->subYear()->year;
            $data = $data->where(function($query) use ($previousYear){
                $query
                ->whereYear('form_ami_dokumens.created_at', '>=', $previousYear)
                ->whereMonth('form_ami_dokumens.created_at', '>=', 7) // Grup 1: bulan Juni hingga Desember
                ->whereMonth('form_ami_dokumens.created_at', '<=', 12);
            })->orWhere(function ($query){
                $query
                ->whereYear('form_ami_dokumens.created_at', '<=', Carbon::now()->year)
                ->whereMonth('form_ami_dokumens.created_at', '>=', 1) // Grup 2: bulan Januari hingga Juni
                ->whereMonth('form_ami_dokumens.created_at', '<=', 6);
            });
                
        } elseif ($currentMonth >= 7 && $currentMonth <= 12) {
            // Bulan Juni hingga Desember
            $nextYear = Carbon::now()->addYear()->year;
            $data = $data->where(function($query) use ($nextYear){
                $query
                ->whereYear('form_ami_dokumens.created_at', '>=', $nextYear)
                ->whereMonth('form_ami_dokumens.created_at', '>=', 1) // Grup 2: bulan Januari hingga Juni
                ->whereMonth('form_ami_dokumens.created_at', '<=', 6);
            })->orWhere(function ($query){
                $query
                ->whereYear('form_ami_dokumens.created_at', '<=', Carbon::now()->year)
                ->whereMonth('form_ami_dokumens.created_at', '>=', 7) // Grup 1: bulan Juni hingga Desember
                ->whereMonth('form_ami_dokumens.created_at', '<=', 12);
            });
        }

        $data=$data->selectRaw('auditees.id_user, auditees.level, users.name, count(*) as jumlah_kts')
            ->get();

        $id_user = $data->pluck('id_user')->toArray();
        $level = $data->pluck('level')->toArray();
        $name = $data->pluck('name')->toArray();
        $jumlah_kts = $data->pluck('jumlah_kts')->toArray();

        return [
            'id_user' => $id_user,
            'level' => $level,
            'name' => $name,
            'jumlah_kts' => $jumlah_kts,
        ];
    }


    public function getDataLineKTSPerAuditeesGabung(){
        $currentYear = date('Y');
        $data = FormAmiDokumen::select('auditees.id_user', 'auditees.level', 'users.name')
            ->join('auditees', 'form_ami_dokumens.id_user_auditee', '=', 'auditees.id_user')
            ->join('users', 'auditees.id_user', '=', 'users.id')
            ->join('jawaban_form_ami_dokumens', 'form_ami_dokumens.id', '=', 'jawaban_form_ami_dokumens.id_form_ami_dokumen')
            ->where('jawaban_form_ami_dokumens.kts', 'kts')
            ->whereYear('form_ami_dokumens.created_at', $currentYear)
            ->groupBy('auditees.id_user', 'auditees.level', 'users.name')
            ->selectRaw('auditees.id_user, auditees.level, users.name, count(*) as jumlah_kts')
            ->get();
        $data2=$data->groupBy(function ($item) {
            $createdMonth = date('m', strtotime($item->created_at));
            return ($createdMonth >= 1 && $createdMonth <= 6) ? 'Genap (Januari-Juni)' : 'Ganjil (Juni-Desember)';
        });


        dd($data2); 
    }
}
