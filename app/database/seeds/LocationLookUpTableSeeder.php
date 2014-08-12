<?php
class LocationLookUpTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('es_location_lookup')->delete();
        LocationLookUp::create([
            'parent_id' =>1,
            'location' =>'Philippines',
            'type' => 0
        ]);
        LocationLookUp::create([
            'parent_id' =>1,
            'location' =>'Luzon',
            'type' => 1
        ]);
        LocationLookUp::create([
            'parent_id' =>1,
            'location' =>'Visayas',
            'type' => 1
        ]);
        LocationLookUp::create([
            'parent_id' =>1,
            'location' =>'Mindanao',
            'type' => 1
        ]);
        LocationLookUp::create([
            'parent_id' =>2,
            'location' =>'NCR',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>2,
            'location' =>'CAR',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>2,
            'location' =>'Region 1 (Ilocos Region)',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>2,
            'location' =>'Region 2 (Cagayan Valley)',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>2,
            'location' =>'Region 3 (Central Luzon)',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>2,
            'location' =>'Region 4A (Calabarzon)',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>2,
            'location' =>'Region 4B (Mimaropa)',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>2,
            'location' =>'Region 5 (Bicol Region)',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>3,
            'location' =>'Region 6 (Western Visayas)',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>3,
            'location' =>'Region 7 (Central Visayas)',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>3,
            'location' =>'Region 8 (Eastern Visayas)',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>4,
            'location' =>'Region 9 (Zamboanga Peninsula)',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>4,
            'location' =>'Region 10 (Northern Mindanao)',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>4,
            'location' =>'Region 11 (Davao Region)',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>4,
            'location' =>'Region 12 (Soccsksargen)',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>4,
            'location' =>'Region 13 (Caraga)',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>4,
            'location' =>'ARMM',
            'type' => 2
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Caloocan',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Las Pinas',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Makati',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Malabon',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Mandaluyong',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Manila',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Marikina',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Muntinlupa',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Navotas',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Paranaque',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Pasay',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Pasig',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Pateros',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Quezon City',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'San Juan',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Taguig',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>5,
            'location' =>'Valenzuela',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>6,
            'location' =>'Abra',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>6,
            'location' =>'Apayao',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>6,
            'location' =>'Benguet',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>6,
            'location' =>'Ifugao',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>6,
            'location' =>'Kalinga',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>6,
            'location' =>'Mt Province',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>7,
            'location' =>'Ilocos Norte',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>7,
            'location' =>'Ilocos Sur',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>7,
            'location' =>'La Union',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>7,
            'location' =>'Pangasinan',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>8,
            'location' =>'Batanes',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>8,
            'location' =>'Cagayan',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>8,
            'location' =>'Isabela',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>8,
            'location' =>'Nueva Vizcaya',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>8,
            'location' =>'Quirino',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>9,
            'location' =>'Aurora',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>9,
            'location' =>'Bataan',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>9,
            'location' =>'Bulacan',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>9,
            'location' =>'Nueva Ecija',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>9,
            'location' =>'Pampanga',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>9,
            'location' =>'Tarlac',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>9,
            'location' =>'Zambales',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>10,
            'location' =>'Batangas',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>10,
            'location' =>'Cavite',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>10,
            'location' =>'Laguna',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>10,
            'location' =>'Quezon',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>10,
            'location' =>'Rizal',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>11,
            'location' =>'Marinduque',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>11,
            'location' =>'Occidental Mindoro',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>11,
            'location' =>'Oriental Mindoro',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>11,
            'location' =>'Palawan',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>11,
            'location' =>'Romblon',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>12,
            'location' =>'Albay',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>12,
            'location' =>'Camarines Norte',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>12,
            'location' =>'Camarines Sur',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>12,
            'location' =>'Catanduanes',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>12,
            'location' =>'Masbate',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>12,
            'location' =>'Sorsogon',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>13,
            'location' =>'Aklan',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>13,
            'location' =>'Antique',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>13,
            'location' =>'Capiz',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>13,
            'location' =>'Guimaras',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>13,
            'location' =>'Iloilo',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>13,
            'location' =>'Negros Occidental',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>14,
            'location' =>'Bohol',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>14,
            'location' =>'Cebu',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>14,
            'location' =>'Negros Oriental',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>14,
            'location' =>'Siquijor',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>15,
            'location' =>'Biliran',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>15,
            'location' =>'Eastern Samar',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>15,
            'location' =>'Leyte',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>15,
            'location' =>'Northern Samar',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>15,
            'location' =>'Samar',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>15,
            'location' =>'Southern Leyte',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>16,
            'location' =>'Isabela City',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>16,
            'location' =>'Zamboanga del Norte',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>16,
            'location' =>'Zamboanga del Sur',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>16,
            'location' =>'Zamboanga Sibugay',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>17,
            'location' =>'Bukidnon',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>17,
            'location' =>'Camiguin',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>17,
            'location' =>'Lanao del Norte',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>17,
            'location' =>'Misamis Occidental',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>17,
            'location' =>'Misamis Oriental',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>18,
            'location' =>'Compostela Valley',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>18,
            'location' =>'Davao del Norte',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>18,
            'location' =>'Davao del Sur',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>18,
            'location' =>'Davao Oriental',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>19,
            'location' =>'Cotabato',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>19,
            'location' =>'Cotabato City',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>19,
            'location' =>'Sarangani',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>19,
            'location' =>'South Cotabato',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>19,
            'location' =>'Sultan Kudarat',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>20,
            'location' =>'Agusan del Norte',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>20,
            'location' =>'Agusan del Sur',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>20,
            'location' =>'Dinagat Islands',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>20,
            'location' =>'Surigao del Norte',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>20,
            'location' =>'Surigao del Sur',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>21,
            'location' =>'Basilan',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>21,
            'location' =>'Lanao del Sur',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>21,
            'location' =>'Maguindanao',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>21,
            'location' =>'Sulu',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>21,
            'location' =>'Tawi-Tawi',
            'type' => 3
        ]);
        LocationLookUp::create([
            'parent_id' =>22,
            'location' =>'Caloocan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>23,
            'location' =>'Las Pinas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>24,
            'location' =>'Makati',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>25,
            'location' =>'Malabon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>26,
            'location' =>'Mandaluyong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>27,
            'location' =>'Manila',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>28,
            'location' =>'Marikina',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>29,
            'location' =>'Muntinlupa',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>30,
            'location' =>'Navotas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>31,
            'location' =>'Paranaque',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>32,
            'location' =>'Pasay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>33,
            'location' =>'Pasig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>34,
            'location' =>'Pateros',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>35,
            'location' =>'Quezon City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>36,
            'location' =>'San Juan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>37,
            'location' =>'Taguig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>38,
            'location' =>'Valenzuela',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Bangued (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Boliney',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Bucay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Daguioman',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Dolores',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'La Paz',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Lacub',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Lagayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Langiden',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Licuan-baay (licuan)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Malibcong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Manabo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'PeÑarrubia',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Pilar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Sallapadan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'San Isidro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'San Quintin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Tayum',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Tineg',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>39,
            'location' =>'Villaviciosa',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>40,
            'location' =>'Calanasan (Bayag)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>40,
            'location' =>'Conner',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>40,
            'location' =>'Flora',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>40,
            'location' =>'Kabugao (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>40,
            'location' =>'Luna',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>40,
            'location' =>'Pudtol',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>40,
            'location' =>'Santa Marcela',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>42,
            'location' =>'Atok',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>42,
            'location' =>'Baguio City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>42,
            'location' =>'Bakun',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>42,
            'location' =>'Bokod',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>42,
            'location' =>'Buguias',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>42,
            'location' =>'Itogon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>42,
            'location' =>'Kabayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>42,
            'location' =>'Kapangan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>42,
            'location' =>'Kibungan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>42,
            'location' =>'La Trinidad (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>42,
            'location' =>'Mankayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>42,
            'location' =>'Sablan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>42,
            'location' =>'Tuba',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>42,
            'location' =>'Tublay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>43,
            'location' =>'Tublay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>43,
            'location' =>'Banaue',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>43,
            'location' =>'City/Municipality',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>43,
            'location' =>'Hungduan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>43,
            'location' =>'Kiangan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>43,
            'location' =>'Lagawe (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>43,
            'location' =>'Lamut',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>43,
            'location' =>'Mayoyao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>43,
            'location' =>'Alfonso Lista (Potia)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>43,
            'location' =>'Aguinaldo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>43,
            'location' =>'Hingyon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>43,
            'location' =>'Tinoc',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>43,
            'location' =>'Asipulo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>44,
            'location' =>'Asipulo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>44,
            'location' =>'Balbalan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>44,
            'location' =>'Lubuagan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>44,
            'location' =>'Pasil',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>44,
            'location' =>'Pinukpuk',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>44,
            'location' =>'Rizal (Liwan)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>44,
            'location' =>'City Of Tabuk (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>44,
            'location' =>'Tanudan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>44,
            'location' =>'Tinglayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>45,
            'location' =>'Barlig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>45,
            'location' =>'Bauko',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>45,
            'location' =>'Besao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>45,
            'location' =>'Bontoc (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>45,
            'location' =>'Natonin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>45,
            'location' =>'Paracelis',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>45,
            'location' =>'Sabangan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>45,
            'location' =>'Sadanga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>45,
            'location' =>'Sagada',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>45,
            'location' =>'Tadian',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Badoc',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Bangui',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'City Of Batac',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Burgos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Carasi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Currimao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Dingras',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Dumalneg',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Banna (Espiritu)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Laoag City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Marcos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Nueva Era',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Pagudpud',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Paoay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Pasuquin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Piddig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Pinili',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'San Nicolas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Sarrat',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Solsona',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>47,
            'location' =>'Vintar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Alilem',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Banayoyo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Bantay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Burgos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Cabugao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'City Of Candon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Caoayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Cervantes',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Galimuyod',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Gregorio Del Pilar (Concepcion)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Lidlidda',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Magsingal',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Nagbukel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Narvacan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Quirino (Angkaki)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Salcedo (Baugen)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'San Emilio',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'San Esteban',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'San Ildefonso',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'San Juan (Lapog)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'San Vicente',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Santa',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Santa Catalina',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Santa Cruz',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Santa Lucia',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Santa Maria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Santiago',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Santo Domingo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Sigay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Sinait',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Sugpon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Suyo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'Tagudin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>48,
            'location' =>'City Of Vigan (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Agoo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Aringay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Bacnotan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Bagulin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Balaoan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Bangar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Bauang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Burgos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Caba',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Luna',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Naguilian',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Pugo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Rosario',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'City Of San Fernando (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'San Gabriel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'San Juan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Santo Tomas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Santol',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Sudipen',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>49,
            'location' =>'Tubao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Agno',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Aguilar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'City Of Alaminos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Alcala',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Anda',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Asingan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Balungao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Bani',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Basista',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Bautista',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Bayambang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Binalonan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Binmaley',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Bolinao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Bugallon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Burgos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Calasiao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Dagupan City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Dasol',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Infanta',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Labrador',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Lingayen (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Mabini',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Malasiqui',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Manaoag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Mangaldan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Mangatarem',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Mapandan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Natividad',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Pozzorubio',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Rosales',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'San Carlos City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'San Fabian',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'San Jacinto',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'San Manuel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'San Nicolas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'San Quintin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Santa Barbara',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Santa Maria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Santo Tomas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Sison',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Sual',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Tayug',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Umingan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Urbiztondo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'City Of Urdaneta',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Villasis',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>50,
            'location' =>'Laoac',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>51,
            'location' =>'Basco (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>51,
            'location' =>'Itbayat',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>51,
            'location' =>'Ivana',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>51,
            'location' =>'Mahatao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>51,
            'location' =>'Sabtang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>51,
            'location' =>'Uyugan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Abulug',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Alcala',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Allacapan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Amulung',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Aparri',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Baggao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Ballesteros',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Buguey',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Calayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Camalaniugan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Claveria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Enrile',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Gattaran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Gonzaga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Iguig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Lal-Lo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Lasam',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Pamplona',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Peñablanca',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Piat',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Rizal',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Sanchez-Mira',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Santa Ana',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Santa Praxedes',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Santa Teresita',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Santo Niño (Faire)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Solana',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Tuao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>52,
            'location' =>'Tuguegarao City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Alicia',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Angadanan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Aurora',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Benito Soliven',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Burgos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Cabagan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Cabatuan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'City Of Cauayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Cordon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Dinapigue',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Divilacan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Echague',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Gamu',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Ilagan (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Jones',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Luna',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Maconacon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Delfin Albano (Magsaysay)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Mallig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Naguilian',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Palanan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Quezon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Quirino',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Ramon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Reina Mercedes',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Roxas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'San Agustin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'San Guillermo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'San Isidro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'San Manuel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'San Mariano',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'San Mateo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'San Pablo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Santa Maria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'City Of Santiago',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Santo Tomas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>53,
            'location' =>'Tumauini',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>54,
            'location' =>'Ambaguio',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>54,
            'location' =>'Aritao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>54,
            'location' =>'Bagabag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>54,
            'location' =>'Bambang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>54,
            'location' =>'Bayombong (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>54,
            'location' =>'Diadi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>54,
            'location' =>'Dupax Del Norte',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>54,
            'location' =>'Dupax Del Sur',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>54,
            'location' =>'Kasibu',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>54,
            'location' =>'Kayapa',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>54,
            'location' =>'Quezon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>54,
            'location' =>'Santa Fe',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>54,
            'location' =>'Solano',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>54,
            'location' =>'Villaverde',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>54,
            'location' =>'Alfonso Castaneda',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>55,
            'location' =>'Aglipay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>55,
            'location' =>'Cabarroguis (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>55,
            'location' =>'Diffun',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>55,
            'location' =>'Maddela',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>55,
            'location' =>'Saguday',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>55,
            'location' =>'Nagtipunan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>58,
            'location' =>'Baler (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>58,
            'location' =>'Casiguran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>58,
            'location' =>'Dilasag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>58,
            'location' =>'Dinalungan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>58,
            'location' =>'Dingalan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>58,
            'location' =>'Dipaculao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>58,
            'location' =>'Maria Aurora',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>58,
            'location' =>'San Luis',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>59,
            'location' =>'Abucay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>59,
            'location' =>'Bagac',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>59,
            'location' =>'City Of Balanga (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>59,
            'location' =>'Dinalupihan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>59,
            'location' =>'Hermosa',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>59,
            'location' =>'Limay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>59,
            'location' =>'Mariveles',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>59,
            'location' =>'Morong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>59,
            'location' =>'Orani',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>59,
            'location' =>'Orion',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>59,
            'location' =>'Pilar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>59,
            'location' =>'Samal',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Angat',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Balagtas (Bigaa)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Baliuag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Bocaue',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Bulacan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Bustos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Calumpit',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Guiguinto',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Hagonoy',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'City Of Malolos (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Marilao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'City Of Meycauayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Norzagaray',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Obando',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Pandi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Paombong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Plaridel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Pulilan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'San Ildefonso',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'City Of San Jose Del Monte',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'San Miguel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'San Rafael',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Santa Maria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>60,
            'location' =>'Doña Remedios Trinidad',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Aliaga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Bongabon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Cabanatuan City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Cabiao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Carranglan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Cuyapo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Gabaldon (Bitulok & Sabani)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'City Of Gapan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'General Mamerto Natividad',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'General Tinio (Papaya)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Guimba',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Jaen',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Laur',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Licab',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Llanera',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Lupao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Science City Of Muñoz',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Nampicuan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Palayan City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Pantabangan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Peñaranda',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Quezon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Rizal',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'San Antonio',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'San Isidro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'San Jose City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'San Leonardo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Santa Rosa',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Santo Domingo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Talavera',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Talugtug',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>61,
            'location' =>'Zaragoza',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Angeles City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Apalit',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Arayat',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Bacolor',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Candaba',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Floridablanca',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Guagua',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Lubao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Mabalacat',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Macabebe',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Magalang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Masantol',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Mexico',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Minalin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Porac',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'City Of San Fernando (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'San Luis',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'San Simon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Santa Ana',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Santa Rita',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Santo Tomas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>63,
            'location' =>'Sasmuan (Sexmoan)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'Anao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'Bamban',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'Camiling',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'Capas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'Concepcion',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'Gerona',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'La Paz',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'Mayantoc',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'Moncada',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'Paniqui',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'Pura',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'Ramos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'San Clemente',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'San Manuel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'Santa Ignacia',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'City Of Tarlac (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'Victoria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>64,
            'location' =>'San Jose',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>65,
            'location' =>'Botolan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>65,
            'location' =>'Cabangan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>65,
            'location' =>'Candelaria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>65,
            'location' =>'Castillejos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>65,
            'location' =>'Iba (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>65,
            'location' =>'Masinloc',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>65,
            'location' =>'Olongapo City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>65,
            'location' =>'Palauig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>65,
            'location' =>'San Antonio',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>65,
            'location' =>'San Felipe',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>65,
            'location' =>'San Marcelino',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>65,
            'location' =>'San Narciso',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>65,
            'location' =>'Santa Cruz',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>65,
            'location' =>'Subic',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Agoncillo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Alitagtag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Balayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Balete',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Batangas City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Bauan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Calaca',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Calatagan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Cuenca',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Ibaan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Laurel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Lemery',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Lian',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Lipa City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Lobo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Mabini',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Malvar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Mataasnakahoy',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Nasugbu',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Padre Garcia',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Rosario',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'San Jose',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'San Juan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'San Luis',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'San Nicolas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'San Pascual',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Santa Teresita',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Santo Tomas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Taal',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Talisay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'City Of Tanauan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Taysan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Tingloy',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>66,
            'location' =>'Tuy',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Alfonso',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Amadeo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Bacoor',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Carmona',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Cavite City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Dasmariñas City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'General Emilio Aguinaldo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'General Trias',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Imus',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Indang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Kawit',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Magallanes',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Maragondon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Mendez (Mendez-Nuñez)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Naic',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Noveleta',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Rosario',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Silang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Tagaytay City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Tanza',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Ternate',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Trece Martires City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>67,
            'location' =>'Gen. Mariano Alvarez',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Alaminos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Bay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'City Of Biñan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Cabuyao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'City Of Calamba',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Calauan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Cavinti',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Famy',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Kalayaan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Liliw',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Los Baños',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Luisiana',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Lumban',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Mabitac',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Magdalena',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Majayjay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Nagcarlan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Paete',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Pagsanjan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Pakil',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Pangil',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Pila',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Rizal',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'San Pablo City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'San Pedro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Santa Cruz (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Santa Maria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'City Of Santa Rosa',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Siniloan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>68,
            'location' =>'Victoria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Agdangan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Alabat',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Atimonan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Buenavista',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Burdeos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Calauag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Candelaria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Catanauan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Dolores',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'General Luna',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'General Nakar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Guinayangan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Gumaca',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Infanta',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Jomalig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Lopez',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Lucban',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Lucena City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Macalelon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Mauban',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Mulanay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Padre Burgos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Pagbilao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Panukulan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Patnanungan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Perez',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Pitogo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Plaridel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Polillo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Quezon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Real',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Sampaloc',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'San Andres',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'San Antonio',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'San Francisco (Aurora)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'San Narciso',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Sariaya',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Tagkawayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'City Of Tayabas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Tiaong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>70,
            'location' =>'Unisan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>71,
            'location' =>'Angono',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>71,
            'location' =>'City Of Antipolo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>71,
            'location' =>'Baras',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>71,
            'location' =>'Binangonan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>71,
            'location' =>'Cainta',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>71,
            'location' =>'Cardona',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>71,
            'location' =>'Jala-Jala',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>71,
            'location' =>'Rodriguez (Montalban)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>71,
            'location' =>'Morong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>71,
            'location' =>'Pililla',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>71,
            'location' =>'San Mateo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>71,
            'location' =>'Tanay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>71,
            'location' =>'Taytay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>71,
            'location' =>'Teresa',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>72,
            'location' =>'Boac (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>72,
            'location' =>'Buenavista',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>72,
            'location' =>'Gasan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>72,
            'location' =>'Mogpog',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>72,
            'location' =>'Santa Cruz',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>72,
            'location' =>'Torrijos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>73,
            'location' =>'Torrijos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>73,
            'location' =>'Abra De Ilog',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>73,
            'location' =>'Calintaan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>73,
            'location' =>'Looc',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>73,
            'location' =>'Lubang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>73,
            'location' =>'Magsaysay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>73,
            'location' =>'Mamburao (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>73,
            'location' =>'Paluan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>73,
            'location' =>'Rizal',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>73,
            'location' =>'Sablayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>73,
            'location' =>'San Jose',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>73,
            'location' =>'Santa Cruz',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>74,
            'location' =>'Baco',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>74,
            'location' =>'Bansud',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>74,
            'location' =>'Bongabong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>74,
            'location' =>'Bulalacao (San Pedro)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>74,
            'location' =>'City Of Calapan (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>74,
            'location' =>'Gloria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>74,
            'location' =>'Mansalay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>74,
            'location' =>'Naujan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>74,
            'location' =>'Pinamalayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>74,
            'location' =>'Pola',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>74,
            'location' =>'Puerto Galera',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>74,
            'location' =>'Roxas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>74,
            'location' =>'San Teodoro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>74,
            'location' =>'Socorro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>74,
            'location' =>'Victoria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Victoria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Aborlan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Agutaya',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Araceli',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Balabac',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Bataraza',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Brooke\'s Point',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Busuanga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Cagayancillo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Coron',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Cuyo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Dumaran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'El Nido (Bacuit)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Linapacan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Magsaysay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Narra',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Puerto Princesa City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Quezon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Roxas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'San Vicente',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Taytay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Kalayaan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Culion',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Rizal (Marcos)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>75,
            'location' =>'Sofronio Española',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'Sofronio Española',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'Alcantara',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'Banton',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'Cajidiocan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'Calatrava',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'Concepcion',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'Corcuera',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'Looc',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'Magdiwang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'Odiongan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'Romblon (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'San Agustin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'San Andres',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'San Fernando',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'San Jose',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'Santa Fe',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'Ferrol',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>77,
            'location' =>'Santa Maria (Imelda)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Bacacay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Camalig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Daraga (Locsin)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Guinobatan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Jovellar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Legazpi City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Libon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'City Of Ligao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Malilipot',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Malinao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Manito',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Oas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Pio Duran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Polangui',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Rapu-Rapu',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Santo Domingo (Libog)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'City Of Tabaco',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>78,
            'location' =>'Tiwi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>79,
            'location' =>'Tiwi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>79,
            'location' =>'Basud',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>79,
            'location' =>'Capalonga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>79,
            'location' =>'Daet (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>79,
            'location' =>'San Lorenzo Ruiz (Imelda)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>79,
            'location' =>'Jose Panganiban',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>79,
            'location' =>'Labo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>79,
            'location' =>'Mercedes',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>79,
            'location' =>'Paracale',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>79,
            'location' =>'San Vicente',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>79,
            'location' =>'Santa Elena',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>79,
            'location' =>'Talisay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>79,
            'location' =>'Vinzons',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Vinzons',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Baao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Balatan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Bato',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Bombon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Buhi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Bula',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Cabusao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Calabanga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Camaligan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Canaman',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Caramoan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Del Gallego',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Gainza',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Garchitorena',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Goa',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Iriga City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Lagonoy',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Libmanan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Lupi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Magarao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Milaor',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Minalabac',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Nabua',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Naga City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Ocampo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Pamplona',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Pasacao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Pili (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Presentacion (Parubcan)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Ragay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Sagñay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'San Fernando',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'San Jose',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Sipocot',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Siruma',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Tigaon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>80,
            'location' =>'Tinambac',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>81,
            'location' =>'Tinambac',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>81,
            'location' =>'Bagamanoc',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>81,
            'location' =>'Baras',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>81,
            'location' =>'Bato',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>81,
            'location' =>'Caramoran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>81,
            'location' =>'Gigmoto',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>81,
            'location' =>'Pandan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>81,
            'location' =>'Panganiban (Payo)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>81,
            'location' =>'San Andres (Calolbon)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>81,
            'location' =>'San Miguel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>81,
            'location' =>'Viga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>81,
            'location' =>'Virac (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Virac (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Aroroy',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Baleno',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Balud',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Batuan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Cataingan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Cawayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Claveria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Dimasalang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Esperanza',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Mandaon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'City Of Masbate (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Milagros',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Mobo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Monreal',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Palanas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Pio V. Corpuz (Limbuhan)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Placer',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'San Fernando',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'San Jacinto',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'San Pascual',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>82,
            'location' =>'Uson',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'Uson',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'Barcelona',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'Bulan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'Bulusan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'Casiguran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'Castilla',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'Donsol',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'Gubat',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'Irosin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'Juban',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'Magallanes',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'Matnog',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'Pilar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'Prieto Diaz',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'Santa Magdalena',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>84,
            'location' =>'City Of Sorsogon (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Altavas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Balete',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Banga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Batan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Buruanga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Ibajay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Kalibo (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Lezo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Libacao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Madalag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Makato',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Malay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Malinao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Nabas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'New Washington',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Numancia',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>85,
            'location' =>'Tangalan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Tangalan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Anini-Y',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Barbaza',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Belison',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Bugasong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Caluya',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Culasi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Tobias Fornier (Dao)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Hamtic',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Laua-An',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Libertad',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Pandan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Patnongon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'San Jose (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'San Remigio',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Sebaste',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Sibalom',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Tibiao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>86,
            'location' =>'Valderrama',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Valderrama',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Cuartero',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Dao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Dumalag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Dumarao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Ivisan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Jamindan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Ma-Ayon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Mambusao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Panay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Panitan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Pilar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Pontevedra',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'President Roxas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Roxas City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Sapi-An',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Sigma',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>88,
            'location' =>'Tapaz',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>89,
            'location' =>'Buenavista',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>89,
            'location' =>'Jordan (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>89,
            'location' =>'Nueva Valencia',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>89,
            'location' =>'San Lorenzo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>89,
            'location' =>'Sibunag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Tapaz',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Ajuy',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Alimodian',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Anilao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Badiangan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Balasan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Banate',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Barotac Nuevo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Barotac Viejo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Batad',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Bingawan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Cabatuan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Calinog',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Carles',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Concepcion',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Dingle',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Dueñas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Dumangas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Estancia',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Guimbal',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Igbaras',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Iloilo City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Janiuay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Lambunao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Leganes',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Lemery',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Leon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Maasin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Miagao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Mina',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'New Lucena',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Oton',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'City Of Passi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Pavia',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Pototan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'San Dionisio',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'San Enrique',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'San Joaquin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'San Miguel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'San Rafael',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Santa Barbara',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Sara',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Tigbauan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Tubungan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>90,
            'location' =>'Zarraga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Bacolod City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Bago City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Binalbagan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Cadiz City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Calatrava',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Candoni',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Cauayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Enrique B. Magalona (Saravia)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'City Of Escalante',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'City Of Himamaylan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'City/Municipality',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Hinigaran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Hinoba-An (Asia)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Ilog',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Isabela',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'City Of Kabankalan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'La Carlota City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'La Castellana',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Manapla',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Moises Padilla (Magallon)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Murcia',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Pontevedra',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Pulupandan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Sagay City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'San Carlos City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'San Enrique',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Silay City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'City Of Sipalay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'City Of Talisay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Toboso',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Valladolid',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'City Of Victorias',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>92,
            'location' =>'Salvador Benedicto',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Alburquerque',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Alicia',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Anda',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Antequera',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Baclayon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Balilihan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Batuan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Bilar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Buenavista',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Calape',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Candijay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Carmen',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Catigbian',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Clarin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Corella',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Cortes',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Dagohoy',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Danao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Dauis',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Dimiao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Duero',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Garcia Hernandez',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'City Of Guindulman',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Inabanga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Jagna',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Jetafe',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Lila',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Loay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Loboc',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Loon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Mabini',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Maribojoc',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Panglao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Pilar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Pres. Carlos P. Garcia (Pitogo)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Sagbayan (Borja)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'San Isidro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'San Miguel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Sevilla',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Sierra Bullones',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Sikatuna',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Tagbilaran City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Talibon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Trinidad',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Tubigon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Ubay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Valencia',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>93,
            'location' =>'Bien Unido',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Alcantara',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Alcoy',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Alegria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Aloguinsan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Argao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Asturias',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Badian',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Balamban',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Bantayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Barili',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'City Of Bogo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Boljoon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Borbon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'City Of Carcar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Carmen',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Catmon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Cebu City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Compostela',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Consolacion',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Cordoba',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Daanbantayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Dalaguete',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Danao City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Dumanjug',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Ginatilan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Lapu-Lapu City (Opon)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Liloan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Madridejos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Malabuyoc',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Mandaue City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Medellin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Minglanilla',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Moalboal',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'City Of Naga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Oslob',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Pilar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Pinamungahan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Poro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Ronda',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Samboan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'San Fernando',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'San Francisco',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'San Remigio',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Santa Fe',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Santander',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Sibonga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Sogod',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Tabogon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Tabuelan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'City Of Talisay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Toledo City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Tuburan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>94,
            'location' =>'Tudela',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Amlan (Ayuquitan)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Ayungon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Bacong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Bais City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Basay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'City Of Bayawan (Tulong)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Bindoy (Payabon)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Canlaon City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Dauin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'City/Municipality',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Dumaguete City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Guihulngan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Jimalalud',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'La Libertad',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Mabinay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Manjuyod',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Pamplona',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'San Jose',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Santa Catalina',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Siaton',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Sibulan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'City Of Tanjay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Tayasan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Valencia (Luzurriaga)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Vallehermoso',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>98,
            'location' =>'Zamboanguita',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>99,
            'location' =>'Enrique Villanueva',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>99,
            'location' =>'Larena',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>99,
            'location' =>'Lazi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>99,
            'location' =>'Maria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>99,
            'location' =>'San Juan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>99,
            'location' =>'Siquijor (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>100,
            'location' =>'Almeria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>100,
            'location' =>'Biliran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>100,
            'location' =>'Cabucgayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>100,
            'location' =>'Caibiran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>100,
            'location' =>'Culaba',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>100,
            'location' =>'Kawayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>100,
            'location' =>'Maripipi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>100,
            'location' =>'Naval (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Arteche',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Balangiga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Balangkayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'City Of Borongan (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Can-Avid',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Dolores',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'General Macarthur',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Giporlos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Guiuan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Hernani',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Jipapad',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Lawaan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Llorente',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Maslog',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Maydolong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Mercedes',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Oras',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Quinapondan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Salcedo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'San Julian',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'San Policarpo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Sulat',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>101,
            'location' =>'Taft',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Abuyog',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Alangalang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Albuera',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Babatngon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Barugo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Bato',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'City Of Baybay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Burauen',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Calubian',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Capoocan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Carigara',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Dagami',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Dulag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Hilongos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Hindang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Inopacan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Isabel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Jaro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Javier (Bugho)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Julita',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Kananga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'La Paz',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Leyte',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Macarthur',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Mahaplag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Matag-Ob',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Matalom',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Mayorga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Merida',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Ormoc City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'City/Municipality',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Palo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Palompon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Pastrana',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'San Isidro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'San Miguel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Santa Fe',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Tabango',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Tabontabon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Tacloban City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Tanauan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Tolosa',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Tunga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>102,
            'location' =>'Villaba',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Allen',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Biri',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Bobon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Capul',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Catarman (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Catubig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Gamay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Laoang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Lapinig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Las Navas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Lavezares',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Mapanas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Mondragon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Palapag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Pambujan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Rosario',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'San Antonio',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'San Isidro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'San Jose',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'San Roque',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'San Vicente',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Silvino Lobos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Victoria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>103,
            'location' =>'Lope De Vega',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Almagro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Basey',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Calbayog City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Calbiga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'City Of Catbalogan (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Daram',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Gandara',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Hinabangan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Jiabong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Marabut',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Matuguinao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Motiong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Pinabacdao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'San Jose De Buan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'San Sebastian',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Santa Margarita',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Santa Rita',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Santo Niño',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Talalora',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Tarangnan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Villareal',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Paranas (Wright)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Zumarraga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Tagapul-An',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'San Jorge',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>105,
            'location' =>'Pagsanghan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'Anahawan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'Bontoc',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'Hinunangan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'Hinundayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'Libagon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'Liloan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'City Of Maasin (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'Macrohon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'Malitbog',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'Padre Burgos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'Pintuyan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'Saint Bernard',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'San Francisco',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'San Juan (Cabalian)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'San Ricardo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'Silago',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'Sogod',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'Tomas Oppus',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>106,
            'location' =>'Limasawa',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>108,
            'location' =>'Isabela City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Dapitan City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Dipolog City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Katipunan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'La Libertad',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Labason',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Liloy',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Manukan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Mutia',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Piñan (New Piñan)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Polanco',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Pres. Manuel A. Roxas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Rizal',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Salug',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Sergio Osmeña Sr.',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Siayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Sibuco',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Sibutad',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Sindangan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Siocon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Sirawai',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Tampilisan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Jose Dalman (Ponot)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Gutalac',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Baliguian',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Godod',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Bacungan (Leon T. Postigo)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>110,
            'location' =>'Kalawit',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Aurora',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Bayog',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Dimataling',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Dinas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Dumalinao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Dumingag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Kumalarang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Labangan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Lapuyan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Mahayag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Margosatubig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Midsalip',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Molave',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Pagadian City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Ramon Magsaysay (Liargo)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'San Miguel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'San Pablo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'City/Municipality',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Tabina',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Tambulig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Tukuran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Zamboanga City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Lakewood',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Josefina',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Pitogo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Sominot (Don Mariano Marcos)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Vincenzo A. Sagun',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Guipos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>111,
            'location' =>'Tigbao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Alicia',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Buug',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Diplahan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Imelda',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Ipil (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Kabasalan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Mabuhay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Malangas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Naga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Olutanga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Payao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Roseller Lim',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Siay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Talusan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Titay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>112,
            'location' =>'Tungawan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Baungon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Damulog',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Dangcagan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Don Carlos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Impasug-Ong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Kadingilan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Kalilangan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Kibawe',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Kitaotao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Lantapan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Libona',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'City Of Malaybalay (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Malitbog',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Manolo Fortich',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Maramag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Pangantucan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Quezon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'San Fernando',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Sumilao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Talakag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'City Of Valencia',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>113,
            'location' =>'Cabanglasan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>115,
            'location' =>'Catarman',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>115,
            'location' =>'Guinsiliban',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>115,
            'location' =>'Mahinog',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>115,
            'location' =>'Mambajao (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>115,
            'location' =>'Sagay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Bacolod',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Baloi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Baroy',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Iligan City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Kapatagan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Sultan Naga Dimaporo (Karomatan)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Kauswagan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Kolambugan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Lala',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Linamon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Magsaysay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Maigo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Matungao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Munai',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Nunungan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Pantao Ragat',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Poona Piagapo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Salvador',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Sapad',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Tagoloan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Tangcal',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Tubod (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>117,
            'location' =>'Pantar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Aloran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Baliangao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Bonifacio',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Calamba',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Clarin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Concepcion',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Jimenez',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Lopez Jaena',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Oroquieta City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Ozamis City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Panaon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Plaridel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Sapang Dalaga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Sinacaban',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Tangub City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Tudela',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>118,
            'location' =>'Don Victoriano Chiongbian',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Alubijid',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Balingasag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Balingoan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Binuangan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Cagayan De Oro City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Claveria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'City Of El Salvador',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Gingoog City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Gitagum',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Initao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Jasaan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Kinoguitan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Lagonglong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Laguindingan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Libertad',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Lugait',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Magsaysay (Linugos)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Manticao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Medina',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Naawan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Opol',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Salay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Sugbongcogon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Tagoloan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Talisayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>119,
            'location' =>'Villanueva',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>120,
            'location' =>'Compostela',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>120,
            'location' =>'Laak (San Vicente)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>120,
            'location' =>'Mabini (Doña Alicia)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>120,
            'location' =>'Maco',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>120,
            'location' =>'Maragusan (San Mariano)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>120,
            'location' =>'Mawab',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>120,
            'location' =>'Monkayo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>120,
            'location' =>'Montevista',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>120,
            'location' =>'Nabunturan (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>120,
            'location' =>'New Bataan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>120,
            'location' =>'Pantukan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>122,
            'location' =>'Asuncion (Saug)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>122,
            'location' =>'Carmen',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>122,
            'location' =>'Kapalong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>122,
            'location' =>'New Corella',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>122,
            'location' =>'City Of Panabo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>122,
            'location' =>'Island Garden City Of Samal',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>122,
            'location' =>'Santo Tomas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>122,
            'location' =>'City Of Tagum (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>122,
            'location' =>'City/Municipality',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>122,
            'location' =>'Talaingod',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>122,
            'location' =>'Braulio E. Dujali',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>122,
            'location' =>'San Isidro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'Bansalan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'Davao City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'City Of Digos (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'Hagonoy',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'Jose Abad Santos (Trinidad)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'Kiblawan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'Magsaysay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'Malalag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'Malita',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'Matanao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'Padada',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'Santa Cruz',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'Santa Maria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'Sulop',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'Sarangani',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>123,
            'location' =>'Don Marcelino',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>124,
            'location' =>'Baganga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>124,
            'location' =>'Banaybanay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>124,
            'location' =>'Boston',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>124,
            'location' =>'Caraga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>124,
            'location' =>'Cateel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>124,
            'location' =>'Governor Generoso',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>124,
            'location' =>'Lupon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>124,
            'location' =>'Manay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>124,
            'location' =>'City Of Mati (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>124,
            'location' =>'San Isidro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>124,
            'location' =>'Tarragona',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'Alamada',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'Carmen',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'Kabacan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'City Of Kidapawan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'Libungan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'Magpet',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'Makilala',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'Matalam',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'Midsayap',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'M\'Lang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'Pigkawayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'Pikit',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'President Roxas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'Tulunan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'Antipas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'Banisilan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'Aleosan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>126,
            'location' =>'Arakan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>127,
            'location' =>'Cotabato City',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>129,
            'location' =>'Alabel (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>129,
            'location' =>'Glan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>129,
            'location' =>'Kiamba',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>129,
            'location' =>'Maasim',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>129,
            'location' =>'Maitum',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>129,
            'location' =>'Malapatan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>129,
            'location' =>'Malungon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>130,
            'location' =>'Banga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>130,
            'location' =>'General Santos City (Dadiangas)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>130,
            'location' =>'City Of Koronadal (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>130,
            'location' =>'Norala',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>130,
            'location' =>'Polomolok',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>130,
            'location' =>'Surallah',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>130,
            'location' =>'Tampakan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>130,
            'location' =>'Tantangan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>130,
            'location' =>'T\'Boli',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>130,
            'location' =>'Tupi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>130,
            'location' =>'Santo Niño',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>130,
            'location' =>'Lake Sebu',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>131,
            'location' =>'Bagumbayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>131,
            'location' =>'Columbio',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>131,
            'location' =>'Esperanza',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>131,
            'location' =>'Isulan (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>131,
            'location' =>'Kalamansig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>131,
            'location' =>'Lebak',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>131,
            'location' =>'Lutayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>131,
            'location' =>'Lambayong (Mariano Marcos)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>131,
            'location' =>'Palimbang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>131,
            'location' =>'President Quirino',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>131,
            'location' =>'City Of Tacurong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>131,
            'location' =>'Sen. Ninoy Aquino',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>132,
            'location' =>'Buenavista',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>132,
            'location' =>'Butuan City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>132,
            'location' =>'City Of Cabadbaran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>132,
            'location' =>'Carmen',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>132,
            'location' =>'Jabonga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>132,
            'location' =>'Kitcharao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>132,
            'location' =>'Las Nieves',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>132,
            'location' =>'Magallanes',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>132,
            'location' =>'Nasipit',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>132,
            'location' =>'Santiago',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>132,
            'location' =>'Tubay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>132,
            'location' =>'Remedios T. Romualdez',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>133,
            'location' =>'City Of Bayugan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>133,
            'location' =>'Bunawan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>133,
            'location' =>'Esperanza',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>133,
            'location' =>'La Paz',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>133,
            'location' =>'Loreto',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>133,
            'location' =>'Prosperidad (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>133,
            'location' =>'Rosario',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>133,
            'location' =>'San Francisco',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>133,
            'location' =>'San Luis',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>133,
            'location' =>'Santa Josefa',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>133,
            'location' =>'Talacogon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>133,
            'location' =>'Trento',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>133,
            'location' =>'Veruela',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>133,
            'location' =>'Sibagat',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>135,
            'location' =>'Basilisa (Rizal)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>135,
            'location' =>'Cagdianao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>135,
            'location' =>'Dinagat',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>135,
            'location' =>'Libjo (Albor)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>135,
            'location' =>'Loreto',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>135,
            'location' =>'San Jose (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>135,
            'location' =>'Tubajon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>135,
            'location' =>'Santiago',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Alegria',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Bacuag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Burgos',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Claver',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Dapa',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Del Carmen',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'General Luna',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Gigaquit',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Mainit',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Malimono',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Pilar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Placer',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'San Benito',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'San Francisco (Anao-Aon)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'San Isidro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Santa Monica (Sapao)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Sison',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Socorro',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Surigao City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Tagana-An',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>136,
            'location' =>'Tubod',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'Barobo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'Bayabas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'City Of Bislig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'Cagwait',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'Cantilan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'Carmen',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'Carrascal',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'Cortes',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'Hinatuan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'Lanuza',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'Lianga',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'Lingig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'Madrid',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'Marihatag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'San Agustin',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'San Miguel',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'Tagbina',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'Tago',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>137,
            'location' =>'City Of Tandag (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>138,
            'location' =>'City Of Lamitan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>138,
            'location' =>'Lantawan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>138,
            'location' =>'Maluso',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>138,
            'location' =>'Sumisip',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>138,
            'location' =>'Tipo-Tipo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>138,
            'location' =>'Tuburan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>138,
            'location' =>'Akbar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>138,
            'location' =>'Al-Barka',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>138,
            'location' =>'Hadji Mohammad Ajul',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>138,
            'location' =>'Ungkaya Pukan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>138,
            'location' =>'Hadji Muhtamad',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>138,
            'location' =>'Tabuan-Lasa',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Bacolod-Kalawi (Bacolod Grande)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Balabagan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Balindong (Watu)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Bayang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Binidayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Bubong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Butig',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Ganassi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Kapai',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Lumba-Bayabao (Maguing)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Lumbatan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Madalum',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Madamba',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Malabang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Marantao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Marawi City (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Masiu',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Mulondo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Pagayawan (Tatarikan)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Piagapo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Poona Bayabao (Gata)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Pualas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Ditsaan-Ramain',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Saguiaran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Tamparan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Taraka',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Tubaran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Tugaya',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Wao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Marogong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Calanogas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Buadiposo-Buntong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Maguing',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Picong (Sultan Gumander)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Lumbayanague',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Bumbaran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Tagoloan Ii',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Kapatagan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Sultan Dumalondong',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>139,
            'location' =>'Lumbaca-Unayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Ampatuan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Buldon',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Buluan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Datu Paglas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Datu Piang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Datu Odin Sinsuat (Dinaig) (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Shariff Aguak (Maganoy) (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Matanog',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Pagalungan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Parang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Sultan Kudarat (Nuling)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Sultan Sa Barongis (Lambayong)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Kabuntalan (Tumbao)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Upi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Talayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'South Upi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Barira',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Gen. S. K. Pendatun',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Mamasapano',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Talitay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Pagagawan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Paglat',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Sultan Mastura',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Guindulungan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Datu Saudi-Ampatuan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Datu Unsay',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Datu Abdullah Sangki',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Rajah Buayan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Datu Blah T. Sinsuat',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Datu Anggal Midtimbang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Mangudadatu',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Pandag',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Northern Kabuntalan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Datu Hoffer Ampatuan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Datu Salibo',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>140,
            'location' =>'Shariff Saydona Mustapha',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Indanan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Jolo (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Kalingalan Caluang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Luuk',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Maimbung',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Hadji Panglima Tahil (Marunggas)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Old Panamao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Pangutaran',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Parang',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Pata',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Patikul',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Siasi',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Talipao',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Tapul',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Tongkil',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Panglima Estino (New Panamao)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Lugus',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Pandami',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>141,
            'location' =>'Omar',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>142,
            'location' =>'Panglima Sugala (Balimbing)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>142,
            'location' =>'Bongao (Capital)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>142,
            'location' =>'Mapun (Cagayan De Tawi-Tawi)',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>142,
            'location' =>'Simunul',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>142,
            'location' =>'Sitangkai',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>142,
            'location' =>'South Ubian',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>142,
            'location' =>'Tandubas',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>142,
            'location' =>'Turtle Islands',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>142,
            'location' =>'Languyan',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>142,
            'location' =>'Sapa-Sapa',
            'type' => 4
        ]);
        LocationLookUp::create([
            'parent_id' =>142,
            'location' =>'Sibutu',
            'type' => 4
        ]);
    }
}
