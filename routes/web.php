<?php

use App\Http\Controllers\AffectationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DotationController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\PuceController;
use App\Http\Controllers\UserController;
use App\Models\Affectation;
use App\Models\Dotation;
use App\Models\Entity;
use App\Models\Personnel;
use App\Models\Puce;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "auth"] , function () {
    Route::get('/dashboard', function () {
        return view(
            'components.dashboard',
            [
                'affectation' => Affectation::count(),
                'puce' => Puce::count(),
                'entity' => Entity::count(),
                'personnel' => Personnel::count(),
                'utilisateur' => User::count(),
                'dotation' => Dotation::count(),
            ]
        );
    })->name("dashboard");
    Route::resources(
        [
            "affectation" => AffectationController::class,
            "puce" => PuceController::class,
            "dotation" => DotationController::class,
            "personnel" => PersonnelController::class,
            "utilisateur" => UserController::class,
            "entity" => EntityController::class
        ]
    );
    Route::get("/logout", [AuthController::class , "logout"])->name("logout");
});



Route::get("login", [AuthController::class, "login"])
    ->name("login");

Route::post("login", [AuthController::class, "loginPost"])
    ->name("login.post");

Route::get("register", [AuthController::class, "register"])
    ->name("register");

Route::post("register", [AuthController::class, "registerPost"])
    ->name("register.post");

Route::get("/" , function () {
    return redirect()->route('dashboard');
});