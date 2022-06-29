<?php

use Illuminate\Support\Facades\Route;
use App\Helpers\Facades\CustomLog;

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
//    CustomLog::logInfo('------------------test log info----------------');
//    CustomLog::logApi('------------------test log api----------------');
//    CustomLog::logWarning('------------------test log warning----------------');
//    CustomLog::logBatch('------------------test log batch----------------');
//    CustomLog::logError('------------------test log error----------------');
//    CustomLog::logDebug('------------------test log debug----------------');
    return view('welcome');
});
