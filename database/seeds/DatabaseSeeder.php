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
            'pwd' => strtoupper('admin')
        ]);

        DB::table('pacientes')->insert([
            ['nombre' => strtoupper('Alan'),
                'ape_paterno' => strtoupper('Ibarra'),
                'ape_materno' => strtoupper('Lopez'),
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

            ['nombre' => strtoupper('Luis'),
                'ape_paterno' => strtoupper('Luna'),
                'ape_materno' => strtoupper('Padilla'),
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

            ['nombre' => strtoupper('Salvador'),
                'ape_paterno' => strtoupper('Gonzalez'),
                'ape_materno' => strtoupper('Llamas'),
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

            ['nombre' => strtoupper('Citlali'),
                'ape_paterno' => strtoupper('Sandoval'),
                'ape_materno' => strtoupper('Ledezma'),
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

            ['nombre' => strtoupper('Celeste'),
                'ape_paterno' => strtoupper('Garcia'),
                'ape_materno' => strtoupper('Diaz'),
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

            ['nombre' => strtoupper('Marco'),
                'ape_paterno' => strtoupper('Yera'),
                'ape_materno' => strtoupper('Partida'),
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

            ['nombre' => strtoupper('Jorge'),
                'ape_paterno' => strtoupper('Guzman'),
                'ape_materno' => strtoupper('Loera'),
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
            ['grupo' => strtoupper('Verduras'),'proteinas' => 12, 'grasas' => 13,'energia' => 13,'carbohidratos' => 23],
            ['grupo' => strtoupper('Carnes'),'proteinas' => 14, 'grasas' => 12,'energia' => 15,'carbohidratos' => 30],
            ['grupo' => strtoupper('Legumbres'),'proteinas' => 15, 'grasas' => 11,'energia' => 12,'carbohidratos' => 15],
            ['grupo' => strtoupper('Cereales'),'proteinas' => 16, 'grasas' => 10,'energia' => 25,'carbohidratos' => 19],
            ['grupo' => strtoupper('Lacteos'),'proteinas' => 17, 'grasas' => 9,'energia' => 23,'carbohidratos' => 12]

        ]);

        DB::table('alimentos')->insert([
            ['descripcion'=>strtoupper('Pescado frito'),'um'=>'dos filetes','grupo_id' => 2],
            ['descripcion'=>strtoupper('Sopa de verduras'),'um'=>'medio litro','grupo_id' => 1],
            ['descripcion'=>strtoupper('Carne asada'),'um'=>'dos filetes','grupo_id' => 2],
            ['descripcion'=>strtoupper('Cereal'),'um'=>'una taza de leche','grupo_id' => 4],
            ['descripcion'=>strtoupper('Yogurth'),'um'=>'una taza' ,'grupo_id' => 5]
        ]);

        DB::table('menus')->insert([
            ['nombre' => strtoupper('MenuSeeder'),'energia' => 43,'grasas' => 37,'proteinas' => 40,'carbohidratos' => 83]
        ]);

        DB::table('det_ali_men')->insert([
            ['alimento_id' => 1 , 'menu_id' => 1 , 'porciones' => 23],
            ['alimento_id' => 2 , 'menu_id' => 1 , 'porciones' => 44],
            ['alimento_id' => 3 , 'menu_id' => 1 , 'porciones' => 21],
        ]);

        DB::table('det_pac_men')->insert([
            ['paciente_id' => 1 , 'menu_id' => 1]
        ]);

    }//



}//
