<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipements;
use Illuminate\Support\Str;

class EquipementsSeeder extends Seeder
{
    public function run()
    {
        $marquesPC = [
            'Dell',
            'HP',
            'Lenovo',
            'Apple',
            'Asus',
            'Acer',
            'MSI',
            'Samsung',
            'Microsoft',
            'Razer'
        ];

        foreach ($marquesPC as $index => $marque) {
            Equipements::create([
                'num_serie' => 'NS' . Str::random(5),
                'designation_equipement' => $marque,
                'nom_equipement' => 'Ordinateur ' . ($index + 1),
                'type_equipement' => 'Laptop',
                'etat_equipement' => 'En Service',
                'date_acq' => now()->subDays(rand(1, 365)),
                'site' => 'Site ' . ($index + 1),
            ]);
        }
    }
}