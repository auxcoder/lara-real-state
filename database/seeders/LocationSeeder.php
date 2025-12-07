<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder; // Assuming your model is named Location
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    public function run()
    {
        $communities = [
            [
                'name' => 'Andalucía',
                'slug' => 'andalucia',
                'image' => 'flag_of_andalucia.svg',
            ],
            [
                'name' => 'Aragón',
                'slug' => 'aragon',
                'image' => 'flag_of_aragon.svg',
            ],
            [
                'name' => 'Principado de Asturias',
                'slug' => 'asturias',
                'image' => 'flag_of_asturias.svg',
            ],
            [
                'name' => 'Illes Balears',
                'slug' => 'balears',
                'image' => 'flag_of_the_balearic_islands.svg',
            ],
            [
                'name' => 'País Vasco / Euskadi',
                'slug' => 'euskadi',
                'image' => 'flag_of_the_basque_country.svg',
            ],
            [
                'name' => 'Islas Canarias',
                'slug' => 'canarias',
                'image' => 'flag_of_the_canary_islands.svg',
            ],
            [
                'name' => 'Cantabria',
                'slug' => 'cantabria',
                'image' => 'flag_of_cantabria.svg',
            ],
            [
                'name' => 'Castilla-La Mancha',
                'slug' => 'castilla-la-mancha',
                'image' => 'flag_of_castile-la_mancha.svg',
            ],
            [
                'name' => 'Castilla y León',
                'slug' => 'castilla-leon',
                'image' => 'flag_of_castile_and_leon.svg',
            ],
            [
                'name' => 'Cataluña / Catalunya',
                'slug' => 'catalunya',
                'image' => 'flag_of_catalonia.svg',
            ],
            [
                'name' => 'Extremadura',
                'slug' => 'extremadura',
                'image' => 'flag_of_extremadura.svg',
            ],
            [
                'name' => 'Galicia',
                'slug' => 'galicia',
                'image' => 'flag_of_galicia.svg',
            ],
            [
                'name' => 'Comunidad de Madrid',
                'slug' => 'madrid',
                'image' => 'flag_of_the_community_of_madrid.svg',
            ],
            [
                'name' => 'Región de Murcia',
                'slug' => 'murcia',
                'image' => 'flag_of_the_region_of_murcia.svg',
            ],
            [
                'name' => 'Comunidad Foral de Navarra',
                'slug' => 'navarra',
                'image' => 'flag_of_navarra.svg',
            ],
            [
                'name' => 'La Rioja',
                'slug' => 'rioja',
                'image' => 'flag_of_la_rioja.svg',
            ],
            [
                'name' => 'Comunitat Valenciana',
                'slug' => 'valencia',
                'image' => 'flag_of_the_valencian_community.svg',
            ],
            // Autonomous Cities (Ciudades Autónomas)
            [
                'name' => 'Ceuta',
                'slug' => 'ceuta',
                'image' => 'flag_of_ceuta.svg',
            ],
            [
                'name' => 'Melilla',
                'slug' => 'melilla',
                'image' => 'flag_of_melilla.svg',
            ],
        ];

        foreach ($communities as $community) {
            Location::create([
                'name' => $community['name'],
                'slug' => $community['slug'], // Str::slug($var) // Generates the clean URL slug
                'image' => $community['image'],
            ]);
        }
    }
}
