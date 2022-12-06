<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\metode_wp\WPController;
use App\Http\Controllers\metode_saw\SAWController;
use App\Http\Controllers\metode_saw\KriteriaController;
use App\Http\Controllers\metode_topsis\TOPSISController;
use App\Http\Controllers\metode_wp\KriteriaWPController;
use App\Http\Controllers\metode_saw\AlternatifController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\metode_saw\PerhitunganController;

use App\Http\Controllers\metode_wp\AlternatifWPController;
use App\Http\Controllers\metode_wp\PerhitunganWPController;
use App\Http\Controllers\metode_saw\NilaiAlternatifController;
use App\Http\Controllers\metode_wp\NilaiAlternatifWPController;
use App\Http\Controllers\metode_topsis\KriteriaTOPSISController;
use App\Http\Controllers\metode_topsis\AlternatifTOPSISController;
use App\Http\Controllers\metode_topsis\PerhitunganTOPSISController;
use App\Http\Controllers\metode_topsis\NilaiAlternatifTOPSISController;


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

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/dologin', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);



//metode saw
Route::controller(SAWController::class)->group(function () {
    Route::get('/metode/saw', 'index');



    Route::get('/metode/ahp', 'metode_ahp');
});

Route::controller(AlternatifController::class)->group(function () {
    Route::get('/metode/saw/alternatif', 'alternatif_saw');
    Route::post('/metode/saw/tambah_alternatif', 'tambah_alternatif_saw');
    Route::get('/metode/saw/tambah_alternatif', 'tambah_alternatif');
    Route::get('/metode/saw/{id}/edit_alternatif', 'edit_alternatif');
    Route::post('/metode/saw/{id}/edit_alternatif', 'edit_alternatif_saw');
});

Route::controller(KriteriaController::class)->group(function () {
    Route::get('/metode/saw/kriteria', 'kriteria_saw');
    Route::get('/metode/saw/crips/{id}', 'crips_saw');
    Route::get('/metode/saw/crips/{kode_kriteria}/tambah', 'tambah_crips');
    Route::post('/metode/saw/crips/{kode_kriteria}/tambah_kriteria', 'tambah_kriteria_crips');
    Route::get('/metode/saw/tambah_kriteria', 'tambah_kriteria_saw');
    Route::post('/metode/saw/tambah_kriteria', 'tambah_kriteria');
    Route::get('/metode/saw/{id}/edit_kriteria', 'edit_kriteria');
    Route::post('/metode/saw/{id}/edit_kriteria', 'edit_kriteria_saw');
    Route::get('/metode/saw/{id}/edit_crips', 'edit_crips');
    Route::post('/metode/saw/{id}/edit_crips', 'edit_crips_saw');
});
Route::post('/metode/saw/tambah_nilai', [NilaiAlternatifController::class, 'nilai_alternatif']);
Route::get('/metode/saw/{id}/edit_nilai', [NilaiAlternatifController::class, 'edit_nilai']);
Route::get('/metode/saw/nilai_alternatif', [NilaiAlternatifController::class, 'index']);
Route::post('/metode/saw/{id}/edit_nilai', [NilaiAlternatifController::class, 'edit_nilai_alternatif']);
Route::get('/metode/saw/perhitungan', [PerhitunganController::class, 'index',]);


//metode wp

Route::get('/metode/wp',  [WPController::class, 'index']);

Route::controller(AlternatifWPController::class)->group(function () {
    Route::get('/metode/wp/alternatif', 'alternatif_wp');
    Route::post('/metode/wp/tambah_alternatif', 'tambah_alternatif_wp');
    Route::get('/metode/wp/tambah_alternatif', 'tambah_alternatif');
    Route::get('/metode/wp/{id}/edit_alternatif', 'edit_alternatif');
    Route::post('/metode/wp/{id}/edit_alternatif', 'edit_alternatif_wp');
});
Route::controller(KriteriaWPController::class)->group(function () {
    Route::get('/metode/wp/kriteria', 'kriteria_wp');
    Route::get('/metode/wp/crips/{id}', 'crips_wp');
    Route::get('/metode/wp/crips/{kode_kriteria}/tambah', 'tambah_crips');
    Route::post('/metode/wp/crips/{kode_kriteria}/tambah_kriteria', 'tambah_kriteria_crips');
    Route::get('/metode/wp/tambah_kriteria', 'tambah_kriteria_wp');
    Route::post('/metode/wp/tambah_kriteria', 'tambah_kriteria');
    Route::get('/metode/wp/{id}/edit_kriteria', 'edit_kriteria');
    Route::post('/metode/wp/{id}/edit_kriteria', 'edit_kriteria_wp');
    Route::get('/metode/wp/{id}/edit_crips', 'edit_crips');
    Route::post('/metode/wp/{id}/edit_crips', 'edit_crips_saw');
});

Route::post('/metode/wp/tambah_nilai', [NilaiAlternatifWPController::class, 'nilai_alternatif']);
Route::get('/metode/wp/{id}/edit_nilai', [NilaiAlternatifWPController::class, 'edit_nilai']);
Route::get('/metode/wp/nilai_alternatif', [NilaiAlternatifWPController::class, 'index']);
Route::post('/metode/wp/{id}/edit_nilai', [NilaiAlternatifWPController::class, 'edit_nilai_alternatif']);
Route::get('/metode/wp/perhitungan', [PerhitunganWPController::class, 'index',]);



//metode TOPSIS

Route::get('/metode/topsis',  [TOPSISController::class, 'index']);

Route::controller(AlternatifTOPSISController::class)->group(function () {
    Route::get('/metode/topsis/alternatif', 'alternatif_topsis');
    Route::post('/metode/topsis/tambah_alternatif', 'tambah_alternatif_topsis');
    Route::get('/metode/topsis/tambah_alternatif', 'tambah_alternatif');
    Route::get('/metode/topsis/{id}/edit_alternatif', 'edit_alternatif');
    Route::post('/metode/topsis/{id}/edit_alternatif', 'edit_alternatif_topsis');
});
Route::controller(KriteriaTOPSISController::class)->group(function () {
    Route::get('/metode/topsis/kriteria', 'kriteria_topsis');
    Route::get('/metode/topsis/crips/{id}', 'crips_topsis');
    Route::get('/metode/topsis/crips/{kode_kriteria}/tambah', 'tambah_crips');
    Route::post('/metode/topsis/crips/{kode_kriteria}/tambah_kriteria', 'tambah_kriteria_crips');
    Route::get('/metode/topsis/tambah_kriteria', 'tambah_kriteria_topsis');
    Route::post('/metode/topsis/tambah_kriteria', 'tambah_kriteria');
    Route::get('/metode/topsis/{id}/edit_kriteria', 'edit_kriteria');
    Route::post('/metode/topsis/{id}/edit_kriteria', 'edit_kriteria_topsis');
    Route::get('/metode/topsis/{id}/edit_crips', 'edit_crips');
    Route::post('/metode/topsis/{id}/edit_crips', 'edit_crips_topsis');
});

Route::post('/metode/topsis/tambah_nilai', [NilaiAlternatifTOPSISController::class, 'nilai_alternatif']);
Route::get('/metode/topsis/{id}/edit_nilai', [NilaiAlternatifTOPSISController::class, 'edit_nilai']);
Route::get('/metode/topsis/nilai_alternatif', [NilaiAlternatifTOPSISController::class, 'index']);
Route::post('/metode/topsis/{id}/edit_nilai', [NilaiAlternatifTOPSISController::class, 'edit_nilai_alternatif']);
Route::get('/metode/topsis/perhitungan', [PerhitunganTOPSISController::class, 'index',]);


// Route::get('/metode_saw', [DashboardController::class, 'saw']);
// Route::get('/metode_wp', [DashboardController::class, 'wp']);
// Route::get('/metode_topsis', [DashboardController::class, 'topsis']);
// Route::get('/metode_ahp', [DashboardController::class, 'ahp']);
