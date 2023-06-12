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
        // dd( $this->getDataLineKTSPerAuditees());

        return view('livewire.dashboard',[
            'pie_auditee' => $this->getDataPieAuditee(),
            'line_form_ami' => $this->getDataLineFormAmi(),
            'line_kts' => $this->getDataLineKTS(),
            'line_kts_per_audite'=>$this->getDataLineKTSPerAuditees(),
        ]);
    }

    public function coba(){
        // Ambil data auditees yang memiliki level "fakultas", "jurusan", atau "prodi"
        $auditees = DB::table('auditees')->whereIn('level', ['fakultas', 'jurusan', 'prodi'])->get();

        // Inisialisasi array untuk menyimpan jumlah KTS per ID user
        $ktsCounts = [];

        foreach ($auditees as $auditee) {
            $idAuditee = $auditee->id_user;
            
            // Ambil jumlah KTS dari tabel jawaban_form_ami_dokumens berdasarkan ID auditee
            $ktsCount = DB::table('jawaban_form_ami_dokumens')
                ->where('jawabanable_type', 'App\Models\Auditee')
                ->where('jawabanable_id', $idAuditee)
                ->where('kts', 'kts')
                ->count();
            
            // Simpan jumlah KTS ke dalam array dengan key sebagai ID auditee
            $ktsCounts[$idAuditee] = $ktsCount;
        }

        // Cetak array hasil
        return $ktsCounts;
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
            $group1Year = Carbon::now()->year - 1;
            $group2Year = Carbon::now()->year;
        } elseif ($currentMonth >= 7 && $currentMonth <= 12){
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

        $counts_kts=[$group1,$group2];

        //ganjil
        $group1 = DB::table('jawaban_form_ami_dokumens')
            ->join('form_ami_dokumens', 'jawaban_form_ami_dokumens.id_form_ami_dokumen', '=', 'form_ami_dokumens.id')
            ->whereMonth('form_ami_dokumens.created_at', '>=', 7) // Grup 1: bulan Juni hingga Desember
            ->whereMonth('form_ami_dokumens.created_at', '<=', 12)
            ->whereYear('form_ami_dokumens.created_at', '=', $group1Year)
            ->where('jawaban_form_ami_dokumens.kts', 'ob')
            ->count();

        //genap
        $group2 = DB::table('jawaban_form_ami_dokumens')
            ->join('form_ami_dokumens', 'jawaban_form_ami_dokumens.id_form_ami_dokumen', '=', 'form_ami_dokumens.id')
            ->whereMonth('form_ami_dokumens.created_at', '>=', 1) // Grup 2: bulan Januari hingga Juni
            ->whereMonth('form_ami_dokumens.created_at', '<=', 6)
            ->whereYear('form_ami_dokumens.created_at', '=', $group2Year)
            ->where('jawaban_form_ami_dokumens.kts', 'ob')
            ->count();

        $counts_ob=[$group1,$group2];

        //ganjil
        $group1 = DB::table('jawaban_form_ami_dokumens')
            ->join('form_ami_dokumens', 'jawaban_form_ami_dokumens.id_form_ami_dokumen', '=', 'form_ami_dokumens.id')
            ->whereMonth('form_ami_dokumens.created_at', '>=', 7) // Grup 1: bulan Juni hingga Desember
            ->whereMonth('form_ami_dokumens.created_at', '<=', 12)
            ->whereYear('form_ami_dokumens.created_at', '=', $group1Year)
            ->where('jawaban_form_ami_dokumens.kts', 'belum')
            ->count();

        //genap
        $group2 = DB::table('jawaban_form_ami_dokumens')
            ->join('form_ami_dokumens', 'jawaban_form_ami_dokumens.id_form_ami_dokumen', '=', 'form_ami_dokumens.id')
            ->whereMonth('form_ami_dokumens.created_at', '>=', 1) // Grup 2: bulan Januari hingga Juni
            ->whereMonth('form_ami_dokumens.created_at', '<=', 6)
            ->whereYear('form_ami_dokumens.created_at', '=', $group2Year)
            ->where('jawaban_form_ami_dokumens.kts', 'belum')
            ->count();

        $counts_belum=[$group1,$group2];

        return [
            'currentYear'=> Carbon::now()->year,
            'group' => ['ganjil', 'genap'],
            'counts_kts' => $counts_kts,
            'counts_ob' => $counts_ob,
            'counts_belum' => $counts_belum,
        ];
    }

    public function __kts_per_auditees_db($currentMonth, $jawaban){
        $data = FormAmiDokumen::select('auditees.id_user', 'auditees.level', 'users.name')
            ->join('auditees', 'form_ami_dokumens.id_user_auditee', '=', 'auditees.id_user')
            ->join('users', 'auditees.id_user', '=', 'users.id')
            ->join('jawaban_form_ami_dokumens', 'form_ami_dokumens.id', '=', 'jawaban_form_ami_dokumens.id_form_ami_dokumen')
            ->where('jawaban_form_ami_dokumens.kts', $jawaban)
            ->groupBy('auditees.id_user', 'auditees.level', 'users.name');
        if ($currentMonth >= 1 && $currentMonth <= 6) {
            // Bulan Januari hingga Juni
            $previousYear = Carbon::now()->subYear()->year;
            $data = $data->where(function($q) use ($previousYear){
                $q->where(function($query) use ($previousYear){
                    $query
                    ->whereYear('form_ami_dokumens.created_at', '=', $previousYear)
                    ->whereMonth('form_ami_dokumens.created_at', '>=', 7) // Grup 1: bulan Juni hingga Desember
                    ->whereMonth('form_ami_dokumens.created_at', '<=', 12);
                })->orWhere(function ($query){
                    $query
                    ->whereYear('form_ami_dokumens.created_at', '=', Carbon::now()->year)
                    ->whereMonth('form_ami_dokumens.created_at', '>=', 1) // Grup 2: bulan Januari hingga Juni
                    ->whereMonth('form_ami_dokumens.created_at', '<=', 6);
                });
            }); 
        } elseif ($currentMonth >= 7 && $currentMonth <= 12) {
            // Bulan Juni hingga Desember
            $nextYear = Carbon::now()->addYear()->year;
            $data = $data->where(function($q) use ($nextYear){
                $q->where(function($query) use ($nextYear){
                    $query
                    ->whereYear('form_ami_dokumens.created_at', '=', $nextYear)
                    ->whereMonth('form_ami_dokumens.created_at', '>=', 1) // Grup 2: bulan Januari hingga Juni
                    ->whereMonth('form_ami_dokumens.created_at', '<=', 6);
                })->orWhere(function ($query){
                    $query
                    ->whereYear('form_ami_dokumens.created_at', '=', Carbon::now()->year)
                    ->whereMonth('form_ami_dokumens.created_at', '>=', 7) // Grup 1: bulan Juni hingga Desember
                    ->whereMonth('form_ami_dokumens.created_at', '<=', 12);
                });
            });
        }
        $data=$data->selectRaw('auditees.id_user, auditees.level, users.name, count(*) as jumlah_kts')
            ->get();

        return $data;
    }

    public function getDataLineKTSPerAuditees(){
        $currentMonth = Carbon::now()->month;

        $data = $this->__kts_per_auditees_db($currentMonth, 'kts');
        $id_user = $data->pluck('id_user')->toArray();
        $level = $data->pluck('level')->toArray();
        $name = $data->pluck('name')->toArray();
        $jumlah_kts = $data->pluck('jumlah_kts')->toArray();

        $data = $this->__kts_per_auditees_db($currentMonth, 'ob');
        $jumlah_ob = $data->pluck('jumlah_kts')->toArray();

        $data = $this->__kts_per_auditees_db($currentMonth, 'belum');
        $jumlah_belum = $data->pluck('jumlah_kts')->toArray();

        
        // dd($data);

        return [
            'id_user' => $id_user,
            'level' => $level,
            'name' => $name,
            'jumlah_kts' => $jumlah_kts,
            'jumlah_ob' => $jumlah_ob,
            'jumlah_belum' => $jumlah_belum,
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
