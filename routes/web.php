<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Auth::routes();

Route::get('/', function () {
    return redirect()->route('reports.my');
});

Route::get('/reports/my-reports', [App\Http\Controllers\ReportController::class, 'myReports'])->middleware('auth')->name('reports.my');
Route::get('/reports/new', [App\Http\Controllers\ReportController::class, 'newReportForm'])->middleware('auth')->name('reports.new');
Route::post('/reports/new', [App\Http\Controllers\ReportController::class, 'newReportCreate'])->middleware('auth');

Route::get('/admin', [AdminController::class, 'adminPanel'])->middleware('auth')->name('admin.panel');
Route::post('/admin/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve');
Route::post('/admin/{id}/reject', [AdminController::class, 'reject'])->name('admin.reject');