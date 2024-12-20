<?php

use App\Models\Equipements;
use Illuminate\Support\Facades\Route;
use App\Livewire\EquipementsComponent;



Route::get('/', function () {
    return view('welcome');
});



Route::get('/equipements', EquipementsComponent::class);
