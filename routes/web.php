<?php
// There is a problem with the code in the file. Please fix it and try again.
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [IndexController::class, 'home'])->name('homepage');
//giải thích: khi gõ vào trang chủ thì sẽ chạy vào hàm home() trong IndexController
//trong hàm home() sẽ trả về view('pages.home')
//trong view('pages.home') sẽ gọi đến file home.blade.php trong thư mục pages
//nếu không có thì sẽ gọi đến file home.blade.php trong thư mục layouts
//name là tên của route
//nếu không có name thì sẽ gọi đến route mặc định là route('home')
//nếu có name thì sẽ gọi đến route có tên là route('homepage')
//đường dẫn sẽ rất dài nếu không có name    
Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
Route::get('/phim-le', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim', [IndexController::class, 'watch'])->name('watch');
Route::get('/episode', [IndexController::class, 'episode'])->name('episode');



Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('category', CategoryController::class);
    Route::resource('genre', GenreController::class);
    Route::resource('country', CountryController::class);
    // Route::get('/genre', [GenreController::class, 'create'])->name('create');
    // Route::get('/genre', [GenreController::class, 'create']);
    // Route::get('/country', [GenreController::class, 'create']);
    Route::resource('genre', GenreController::class);
    Route::resource('country', CountryController::class);
    Route::resource('movie', MovieController::class);
    Route::resource('episode', EpisodeController::class);
});