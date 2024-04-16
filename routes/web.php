<?php

use App\Http\Controllers\AffectationController;
use App\Http\Controllers\DotationController;
use App\Http\Controllers\PuceController;
use App\Models\Affectation;
use App\Models\Dotation;
use App\Models\Entity;
use App\Models\Personnel;
use App\Models\Puce;
use App\Models\User;
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



Route::get('/dashboard', function () {
    return view('components.dashboard' , 
        [
            'affectation' => Affectation::count() , 
            'puce' => Puce::count() , 
            'entity' => Entity::count() ,
            'personnel' => Personnel::count() ,
            'utilisateur' => User::count() , 
            'dotation' => Dotation::count() ,
        ]
    );
})->name("dashboard");


Route::resources(
    [
        "affectation" => AffectationController::class ,
        "puce" => PuceController::class , 
        "dotation" => DotationController::class ,
    ]
);
