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
                'pre_registro'=>'true'],

            ['nombre' => 'Marco',
                'ape_paterno' => 'Yera',
                'ape_materno' => 'Partida',
                'fecha_naci' => '1995-03-01',
                'email'=>'yera@gmail.com',
                'sexo' => 'm' ,'meta' => 'bajar peso',
                'patologias' =>'ninguna',
                'alergias'=>'ninguna',
                'antibioticos'=>'ninguna',
                'telefono'=>'312332356',
                'fecha_reg'=>'2017-11-16',
                'activo'=>false,
                'pre_registro'=>'true'],

            ['nombre' => 'Jorge',
                'ape_paterno' => 'Guzman',
                'ape_materno' => 'Loera',
                'fecha_naci' => '1995-03-01',
                'email'=>'loera@gmail.com',
                'sexo' => 'm' ,'meta' => 'bajar peso',
                'patologias' =>'ninguna',
                'alergias'=>'ninguna',
                'antibioticos'=>'ninguna',
                'telefono'=>'312332356',
                'fecha_reg'=>'2017-11-16',
                'activo'=>false,
                'pre_registro'=>'true']
        ]);

        DB::table('grupos')->insert([
            ['grupo' => 'Verduras','proteinas' => 12, 'grasas' => 13,'energia' => 13,'carbohidratos' => 23],
            ['grupo' => 'Carnes','proteinas' => 14, 'grasas' => 12,'energia' => 15,'carbohidratos' => 30],
            ['grupo' => 'Legumbres','proteinas' => 15, 'grasas' => 11,'energia' => 12,'carbohidratos' => 15],
            ['grupo' => 'Cereales','proteinas' => 16, 'grasas' => 10,'energia' => 25,'carbohidratos' => 19],
            ['grupo' => 'Lacteos','proteinas' => 17, 'grasas' => 9,'energia' => 23,'carbohidratos' => 12]

        ]);

        DB::table('alimentos')->insert([
            ['descripcion'=>'Pescado frito','um'=>'dos filetes','grupo_id' => 2],
            ['descripcion'=>'Sopa de verduras','um'=>'medio litro','grupo_id' => 1],
            ['descripcion'=>'Carne asada','um'=>'dos filetes','grupo_id' => 2],
            ['descripcion'=>'Cereal','um'=>'una taza de leche','grupo_id' => 4],
            ['descripcion'=>'Yogurth','um'=>'una taza' ,'grupo_id' => 5]
        ]);

        DB::table('menus')->insert([
            ['nombre' => 'MenuSeeder','energia' => 43,'grasas' => 37,'proteinas' => 40,'carbohidratos' => 83]
        ]);

        DB::table('det_ali_men')->insert([
            ['alimento_id' => 1 , 'menu_id' => 1],
            ['alimento_id' => 2 , 'menu_id' => 1],
            ['alimento_id' => 3 , 'menu_id' => 1],
        ]);


    }//



}//
