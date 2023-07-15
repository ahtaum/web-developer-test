<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::controller(MainController::class)->group(function () {
    Route::get("/", "index")->name("main-page");
    Route::post("/cek-ongkir", "cekOngkir")->name("cek-ongkir");
});
