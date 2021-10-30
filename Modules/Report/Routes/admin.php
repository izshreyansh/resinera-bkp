<?php

use Illuminate\Support\Facades\Route;

Route::get('reports', [
    'as' => 'admin.reports.index',
    'uses' => 'ReportController@index',
    'middleware' => 'can:admin.reports.index',
]);

Route::get('reports/download', [
    'as' => 'admin.reports.download',
    'uses' => 'ReportController@download',
    'middleware' => 'can:admin.reports.download',
]);
