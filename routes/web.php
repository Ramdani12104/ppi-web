<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\MAController;
use App\Http\Controllers\MTsController;
use App\Http\Controllers\TokohPendiriController;
use App\Http\Controllers\SaranaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EducationalLevelController;
use App\Http\Controllers\KoberController;
use App\Http\Controllers\RaController;
use App\Http\Controllers\SditController;
use App\Http\Controllers\MdtController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('LandingPage', [
        'news' => \App\Models\NewsPost::where('is_published', true)->latest('published_at')->take(4)->get(),
        'testimonials' => \App\Models\Testimonial::latest('updated_at')->get(),
        'programs' => \App\Models\Program::all(),
        'extracurriculars' => \App\Models\Extracurricular::all(),
        'settings' => \App\Models\Setting::pluck('value', 'key')->toArray(),
        'facilities' => \App\Models\Facility::all(),
    ]);
});

// Dynamic CMS Routes
Route::get('/jenjang/{slug}', [EducationalLevelController::class, 'show'])->name('jenjang.show');
Route::get('/p/{slug}', [PageController::class, 'show'])->name('page.show');

// Berita Routes
Route::get('/berita', [NewsController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('berita.show');

// Legacy & Program Routes
Route::get('/profil/sejarah', [HistoryController::class, 'index'])->name('sejarah');
Route::get('/profil/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi');
Route::get('/profil/struktur', [StrukturController::class, 'index'])->name('struktur');
Route::get('/profil/tokoh-pendiri', [TokohPendiriController::class, 'index'])->name('profil.tokoh-pendiri');
Route::get('/profil/sarana', [SaranaController::class, 'index'])->name('profil.sarana');
Route::prefix('dukungan')->group(function () {
    Route::get('/', [\App\Http\Controllers\WakafController::class, 'index'])->name('dukungan.index');
    Route::get('/pembangunan', [\App\Http\Controllers\PembangunanController::class, 'index'])->name('dukungan.pembangunan');
    Route::get('/beasiswa', [\App\Http\Controllers\BeasiswaController::class, 'index'])->name('dukungan.beasiswa');
});
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak.index');
Route::get('/program/kober', [KoberController::class, 'index'])->name('program.kober');
Route::get('/program/ra', [RaController::class, 'index'])->name('program.ra');
Route::get('/program/sdit', [SditController::class, 'index'])->name('program.sdit');
Route::get('/program/mdt', [MdtController::class, 'index'])->name('program.mdt');
Route::get('/program/ma', [MAController::class, 'index'])->name('ma');
Route::get('/program/mts', [MTsController::class, 'index'])->name('mts');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
