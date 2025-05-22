<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Mail;
use App\Mail\PDFMail;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::prefix('c')->group(function () {
Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactController::class, 'create'])->middleware('auth')->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->middleware('auth')->name('contacts.store');
Route::post('/contacts/{id}/restore', [ContactController::class, 'restore'])->middleware('auth')->name('contacts.restore');
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->middleware('auth')->name('contacts.destroy');

Route::get('/contacts/trashed', [ContactController::class, 'trashed'])->middleware('auth')->name('contacts.trashed');
Route::delete('/contacts/{id}/force-delete', [ContactController::class, 'forceDelete'])->middleware('auth')->name('contacts.forceDelete');

Route::get('/contacts/pdf', [PDFController::class, 'generatePDF'])->name('contacts.pdf');
Route::get('/send-pdf-mail', function () {
        Mail::to('test@example.com')->send(new PDFMail());
        return 'Laiškas išsiųstas';
    });
});