<?php

use App\Http\Controllers\PDFLaporanController;
use App\Http\Livewire\AmidokumenAdd;
use App\Http\Livewire\AmidokumenDetail;
use App\Http\Livewire\AmidokumenEdit;
use App\Http\Livewire\AmidokumenIndex;
use App\Http\Livewire\AuditorAmidokumen;
use App\Http\Livewire\AuditorAmidokumenDetail;
use App\Http\Livewire\AuditorAmidokumenEdit;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\DeskripsiTemuanAdd;
use App\Http\Livewire\DeskripsiTemuanEdit;
use App\Http\Livewire\DeskripsiTemuanIndex;
use App\Http\Livewire\EditProfile;
use App\Http\Livewire\FormAmidokumenAdd;
use App\Http\Livewire\FormAmidokumenEdit;
use App\Http\Livewire\FormAmidokumenIndex;
use App\Http\Livewire\FormAmidokumenTimauditor;
use App\Http\Livewire\JawabanAmidokumenAuditor;
use App\Http\Livewire\JawabanAmidokumenDetail;
use App\Http\Livewire\JawabanAmidokumenEdit;
use App\Http\Livewire\JawabanAmidokumenIndex;
use App\Http\Livewire\SuburaianEdit;
use App\Http\Livewire\TemplateSuratAdd;
use App\Http\Livewire\TemplateSuratEdit;
use App\Http\Livewire\TemplateSuratIndex;
use App\Http\Livewire\UserAdd;
use App\Http\Livewire\UserEdit;
use App\Http\Livewire\UserIndex;
use App\Models\FormAmiDokumen;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', function () {
    return view('landing');
})->name('base');
Route::get('/dashboard', Dashboard::class)->middleware(['auth'])->name('dashboard');


Route::get('/instrumen', AmidokumenIndex::class)->name('amidokumen')
    ->middleware('role:Auditor|Admin');
Route::get('/instrumen/{id}/detail', AmidokumenDetail::class)->name('amidokumen.detail')
    ->middleware('role:Auditor|Admin');
    Route::get('/my-profile', EditProfile::class)->name('profile.edit')
    ->middleware('auth');

Route::group(['middleware' => ['auth', 'role:Admin']], function ($route) {
    $route->get('/instrumen/add', AmidokumenAdd::class)->name('amidokumen.add');
    $route->get('/instrumen/{id}/edit', AmidokumenEdit::class)->name('amidokumen.edit');
    $route->get('/instrumen/{id}/edit-suburaian', SuburaianEdit::class)->name('amidokumen.edit.suburaian');

    $route->get('/user', UserIndex::class)->name('user');
    $route->get('/user/add', UserAdd::class)->name('user.add');
    $route->get('/user/{id}/edit', UserEdit::class)->name('user.edit');

    $route->get('/form-amidokumen', FormAmidokumenIndex::class)->name('formAmiDokumen');
    $route->get('/form-amidokumen/add', FormAmidokumenAdd::class)->name('formAmiDokumen.add');
    $route->get('/form-amidokumen/{id}/edit', FormAmidokumenEdit::class)->name('formAmiDokumen.edit');
    $route->get('/form-amidokumen/{id}/auditor', FormAmidokumenTimauditor::class)->name('formAmiDokumen.auditor');

    $route->get('/template-surat', TemplateSuratIndex::class)->name('templateSurat');
    $route->get('/template-surat/add', TemplateSuratAdd::class)->name('templateSurat.add');
    $route->get('/template-surat/{id}/edit', TemplateSuratEdit::class)->name('templateSurat.edit');
});

Route::group(['middleware' => ['auth', 'role:Auditee']], function ($route) {
    $route->get('/jawaban-amidokumen', JawabanAmidokumenIndex::class)->name('jawabanAmiDokumen');
    $route->get('/jawaban-amidokumen/{id}/edit', JawabanAmidokumenEdit::class)->name('jawabanAmiDokumen.edit');
    $route->get('/jawaban-amidokumen/{id}/detail', JawabanAmidokumenDetail::class)->name('jawabanAmiDokumen.detail');
});

Route::group(['middleware' => ['auth', 'role:Auditor']], function ($route) {
    $route->get('/auditor-amidokumen', AuditorAmidokumen::class)->name('auditorAmidokumen');
    $route->get('/auditor-jawaban-amidokumen/{id}/edit', AuditorAmidokumenEdit::class)->name('auditorAmidokumen.edit');
    $route->get('/auditor-jawaban-amidokumen/{id}/detail', AuditorAmidokumenDetail::class)->name('auditorAmidokumen.detail');
    $route->get('/deskripsi-temuan', DeskripsiTemuanIndex::class)->name('deskripsiTemuan');
    $route->get('/deskripsi-temuan/add/{id}', DeskripsiTemuanAdd::class)->name('deskripsiTemuan.add');
    $route->get('/deskripsi-temuan/{id}/edit', DeskripsiTemuanEdit::class)->name('deskripsiTemuan.edit');
});






Route::get('coba',function(){
    return 'hello';
});


Route::get('/laporan/coba', function () {
    $data = FormAmiDokumen::with(['amiDokumen.uraians.suburaians', 'jawabanFormAmiDokumens.jawabanable', 'jawabanFormAmiDokumens.deskripsiTemuan', 'timAuditors', 'auditee'])->where('id', 2)->first();
    return view('pdf.laporan', [
        'ami' => $data->amiDokumen,
        'form' => $data,
        'jawabanForm' => $data->jawabanFormAmiDokumens,
        'timAuditor' => $data->timAuditors,
        'ketuaAuditor' => $data->timAuditors()->where('status', 'ketua')->first(),
        'user_auditee' => $data->auditee,
        'temuan' => $data->jawabanFormAmiDokumens()->where('kts', 'kts')->get(),
    ]);
})->name('base');





require __DIR__ . '/auth.php';
