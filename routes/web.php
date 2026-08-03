<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\MarketplaceController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::view('/ekosistem', 'pages.ekosistem')->name('ekosistem');
Route::view('/layanan', 'pages.layanan')->name('layanan');
Route::get('/creator', [MarketplaceController::class, 'index'])->name('creator');
Route::get('/campaign', [MarketplaceController::class, 'campaigns'])->name('campaign');
Route::get('/campaign/{campaign}', [MarketplaceController::class, 'campaign'])->name('campaign.show');
Route::post('/campaign/{campaign}/ajukan', [LeadController::class, 'campaign'])->name('campaign.apply');
Route::post('/creator/ajak', [LeadController::class, 'marketplace'])->name('creator.ajak');
Route::redirect('/marketplace', '/creator');
Route::redirect('/paket', '/campaign');
Route::view('/success', 'pages.success')->name('success');
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog');
Route::get('/blog/{post}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

Route::view('/gabung', 'pages.gabung')->name('gabung');
Route::post('/gabung', [LeadController::class, 'gabung'])->name('gabung.store');

Route::view('/kontak', 'pages.kontak')->name('kontak');
Route::post('/kontak', [LeadController::class, 'kontak'])->name('kontak.store');

// sitemap.xml
Route::get('/sitemap.xml', function () {
    $routes = ['home', 'ekosistem', 'layanan', 'creator', 'campaign', 'success', 'blog', 'gabung', 'kontak'];
    $urls = collect($routes)->map(fn ($r) => [
        'loc' => route($r),
        'priority' => $r === 'home' ? '1.0' : '0.8',
    ]);

    foreach (\App\Models\Campaign::active()->get() as $c) {
        $urls->push(['loc' => route('campaign.show', $c), 'priority' => '0.7']);
    }
    foreach (\App\Models\Post::where('is_published', true)->get() as $post) {
        $urls->push(['loc' => route('blog.show', $post), 'priority' => '0.6']);
    }

    return response()
        ->view('sitemap', ['urls' => $urls])
        ->header('Content-Type', 'application/xml');
})->name('sitemap');
