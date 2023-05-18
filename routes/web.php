<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
 
// routes/web.php

Route::post('/import', [App\Http\Controllers\DocumentController::class, 'import'])->name('documents.import');
Route::put('/process', [App\Http\Controllers\DocumentController::class, 'process'])->name('documents.process');

