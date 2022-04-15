<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
 
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

/* Route::get('/getBitcoinInfo/{id}', function () {
    
    $json = json_decode(file_get_contents('https://api.coindesk.com/v1/bpi/historical/close.json?start=2013-09-01&end=2013-09-05&currency=eur'), true);
    return $json;
}); */

Route::get('/getBitcoinInfo/{id}', [InfoController::class,'index']) ;


