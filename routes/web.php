<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\permissionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\admin\PostController as adminpost;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\admin\UserController as adminuser;
use App\Http\Controllers\ProfileController;
use App\Models\Role;
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

// Route::get('/', function () {
//     return view('index');
// });

Auth::routes();


Route::get('/', [PostController::class, 'index']);

Route::resource('/post', PostController::class);

Route::get('/{id}/{slug}', [PostController::class, 'getByCategory'])->name('category')->where('id', '[0-9]+');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/search', [PostController::class, 'search'])->name('search');

Route::resource('/comment', CommentController::class);

Route::get('/user/{id}', [ProfileController::class, 'getByUser'])->name('profile');

Route::get('/user/{id}/comments', [ProfileController::class, 'getByUser'])->name('comments');

Route::get('/setting', [ProfileController::class, 'settings'])->name('settings');

Route::post('/setting', [ProfileController::class, 'updatesettings'])->name('settings');




Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/category', CategoryController::class);
    Route::resource('/posts', adminpost::class);
    Route::resource('/users', adminuser::class);
    Route::resource('/page', PageController::class);
    // Route::get('/page/create', [PageController::class, 'store'])->name('page.create');
    Route::get('/permissions', [permissionController::class, 'index'])->name('permissions');
    Route::post('/permissions', [RoleController::class, 'store'])->name('permissions');
});

Route::post('/permission/byRole', [RoleController::class, 'permission_byRole'])->name('permission_byRole');
Route::get('page/{page}', [PageController::class, 'show'])->name('pages');
