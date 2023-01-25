<?php

use App\Http\Livewire\AmidokumenAdd;
use App\Http\Livewire\AmidokumenEdit;
use App\Http\Livewire\AmidokumenIndex;
use App\Http\Livewire\FormAmidokumenAdd;
use App\Http\Livewire\FormAmidokumenEdit;
use App\Http\Livewire\FormAmidokumenIndex;
use App\Http\Livewire\FormAmidokumenTimauditor;
use App\Http\Livewire\JawabanAmidokumenEdit;
use App\Http\Livewire\JawabanAmidokumenIndex;
use App\Http\Livewire\SuburaianEdit;
use App\Http\Livewire\UserAdd;
use App\Http\Livewire\UserEdit;
use App\Http\Livewire\UserIndex;
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
    return view('welcome');
})->name('base');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::group(['middleware' => ['auth','role:Admin']], function ($route) {
    $route->get('/amidokumen', AmidokumenIndex::class)->name('amidokumen');
    $route->get('/amidokumen/add', AmidokumenAdd::class)->name('amidokumen.add');
    $route->get('/amidokumen/{id}/edit', AmidokumenEdit::class)->name('amidokumen.edit');
    $route->get('/amidokumen/{id}/edit-suburaian', SuburaianEdit::class)->name('amidokumen.edit.suburaian');

    $route->get('/user', UserIndex::class)->name('user');
    $route->get('/user/add', UserAdd::class)->name('user.add');
    $route->get('/user/{id}/edit', UserEdit::class)->name('user.edit');

    $route->get('/form-amidokumen', FormAmidokumenIndex::class)->name('formAmiDokumen');
    $route->get('/form-amidokumen/add', FormAmidokumenAdd::class)->name('formAmiDokumen.add');
    $route->get('/form-amidokumen/{id}/edit', FormAmidokumenEdit::class)->name('formAmiDokumen.edit');
    $route->get('/form-amidokumen/{id}/auditor', FormAmidokumenTimauditor::class)->name('formAmiDokumen.auditor');
});

Route::group(['middleware' => ['auth','role:Auditee']], function ($route) {
    $route->get('/jawaban-amidokumen', JawabanAmidokumenIndex::class)->name('jawabanAmiDokumen');
    $route->get('/jawaban-amidokumen/{id}/edit', JawabanAmidokumenEdit::class)->name('jawabanAmiDokumen.edit');
});




require __DIR__.'/auth.php';