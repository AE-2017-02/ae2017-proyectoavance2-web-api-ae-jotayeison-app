<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configuraciones')->insert([
            'usuario' => 'admin',
            'pwd' => md5('admin')
        ]);

        DB::table('pacientes')->insert([
            ['nombre' => 'Alan',
                'ape_paterno' => 'Ibarra',
                'ape_materno' => 'Lopez',
                'fecha_naci' => '1994-09-18',
                'email'=>'alanibarralop@gmail.com',
                'sexo' => 'm' ,'meta' => 'bajar peso',
                'patologias' =>'ninguna',
                'alergias'=>'ninguna',
                'antibioticos'=>'ninguna',
                'telefono'=>'3118472056',
                'fecha_reg'=>'2017-11-16',
                'activo'=>false,
                'pre_registro'=>'true'],

            ['nombre' => 'Luis',
                'ape_paterno' => 'Luna',
                'ape_materno' => 'Padilla',
                'fecha_naci' => '1994-11-18',
                'email'=>'lunapap@gmail.com',
                'sexo' => 'm' ,'meta' => 'bajar peso',
                'patologias' =>'ninguna',
                'alergias'=>'ninguna',
                'antibioticos'=>'ninguna',
                'telefono'=>'31184232056',
                'fecha_reg'=>'2017-11-16',
                'activo'=>false,
                'pre_registro'=>'true'],

            ['nombre' => 'Salvador',
                'ape_paterno' => 'Gonzalez',
                'ape_materno' => 'Llamas',
                'fecha_naci' => '1995-01-01',
                'email'=>'sagonzalez@gmail.com',
                'sexo' => 'm' ,'meta' => 'bajar peso',
                'patologias' =>'ninguna',
                'alergias'=>'ninguna',
                'antibioticos'=>'ninguna',
                'telefono'=>'311232356',
                'fecha_reg'=>'2017-11-16',
                'activo'=>false,
                'pre_registro'=>'true'],

            ['nombre' => 'Citlali',
                'ape_paterno' => 'Sandoval',
                'ape_materno' => 'Ledezma',
                'fecha_naci' => '1995-05-23',
                'email'=>'cisandovalle@gmail.com',
                'sexo' => 'm' ,'meta' => 'bajar peso',
                'patologias' =>'ninguna',
                'alergias'=>'ninguna',
                'antibioticos'=>'ninguna',
                'telefono'=>'311232323',
                'fecha_reg'=>'2017-11-16',
                'activo'=>false,
                'pre_registro'=>'true'],

            ['nombre' => 'Celeste',
                'ape_paterno' => 'Garcia',
                'ape_materno' => 'Diaz',
                'fecha_naci' => '1995-03-01',
                'email'=>'celeste@gmail.com',
                'sexo' => 'm' ,'meta' => 'bajar peso',
                'patologias' =>'ninguna',
                'alergias'=>'ninguna',
                'antibioticos'=>'ninguna',
                'telefono'=>'312332356',
                'fecha_reg'=>'2017-11-16',
                'activo'=>false,
                'pre_registro'=>'true']
        ]);

        DB::table('alimentos')->insert([
            ['descripcion'=>'Pescado frito','um'=>'dos filetes'],
            ['descripcion'=>'Sopa de verduras','um'=>'medio litro'],
            ['descripcion'=>'Carne asada','um'=>'dos filetes'],
            ['descripcion'=>'Cereal','um'=>'una taza de leche'],
            ['descripcion'=>'Yogurth','um'=>'una taza'  ]
        ]);


    }
}
