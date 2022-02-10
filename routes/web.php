<?php

use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\UserController;
use App\Models\Discussion;
use Illuminate\Support\Facades\Auth;
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
});


Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('discussions',DiscussionController::class);
Route::resource('discussions/{discussion}/replies',ReplyController::class);

Route::get('users/notifications',[UserController::class,'notifications'])->name('users.notifications');
Route::post('discussions/{discussion}/replies/{reply}/mark-as-best-reply',[DiscussionController::class,'bestReply'])->name('discussions.best');
