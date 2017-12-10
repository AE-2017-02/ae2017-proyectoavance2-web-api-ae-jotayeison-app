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
            'pwd' => md5('admin'),
            'horario' => '{"duracion":"+15 minute","lunes":{"inicio":"9:00:00","fin":"18:00:00","inini":"14:00:00","infin":"16:00:00"},"martes":{"inicio":"9:00:00","fin":"18:00:00","inini":"14:00:00","infin":"16:00:00"},"miercoles":{"inicio":"9:00:00","fin":"18:00:00","inini":"14:00:00","infin":"16:00:00"},"jueves":{"inicio":"9:00:00","fin":"18:00:00","inini":"14:00:00","infin":"16:00:00"},"viernes":{"inicio":"9:00:00","fin":"18:00:00","inini":"14:00:00","infin":"16:00:00"},"sabado":{"inicio":"9:00:00","fin":"14:00:00","inini":null,"infin":null},"domingo":{"inicio":null,"fin":null,"inini":null,"infin":null}}'
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
            ['grupo' => strtoupper('Lacteos'),'proteinas' => 17, 'grasas' => 9,'energia' => 23,'carbohidratos' => 12],
            ['grupo' => strtoupper('Frutas'),'proteinas' => 10, 'grasas' => 4,'energia' => 10,'carbohidratos' => 11]

        ]);

        DB::table('alimentos')->insert([
            ['descripcion'=>strtoupper('Pescado frito'),'um'=>'dos filetes','grupo_id' => 2],
            ['descripcion'=>strtoupper('Sopa de verduras'),'um'=>'medio litro','grupo_id' => 1],
            ['descripcion'=>strtoupper('Carne asada'),'um'=>'dos filetes','grupo_id' => 2],
            ['descripcion'=>strtoupper('Cereal'),'um'=>'una taza de leche','grupo_id' => 4],
            ['descripcion'=>strtoupper('Yogurth'),'um'=>'una taza' ,'grupo_id' => 5],
            ['descripcion'=>strtoupper('Sandwich de pollo'),'um'=>'1 sandwich' ,'grupo_id' => 5],

            ['descripcion'=>strtoupper('Huevos'),'um'=>'dos huevos al gusto' ,'grupo_id' => 5],
            ['descripcion'=>strtoupper('Salmon'),'um'=>'1 filete' ,'grupo_id' => 2],
            ['descripcion'=>strtoupper('Patata hervida'),'um'=>'1 patata' ,'grupo_id' => 3],
            ['descripcion'=>strtoupper('Atun'),'um'=>'1 sobre' ,'grupo_id' => 2],
            ['descripcion'=>strtoupper('Zanahoria'),'um'=>'dos zanahorias' ,'grupo_id' => 1],
            ['descripcion'=>strtoupper('Fresas'),'um'=>'tres fresas' ,'grupo_id' => 6],

            ['descripcion'=>strtoupper('Cafe'),'um'=>'1 taza' ,'grupo_id' => 5],
            ['descripcion'=>strtoupper('Jugo de naranja'),'um'=>'1 vaso' ,'grupo_id' => 6],
            ['descripcion'=>strtoupper('Agua de limon'),'um'=>'2 vaso' ,'grupo_id' => 6],

        ]);

        DB::table('menus')->insert([
            ['nombre' => strtoupper('nutrete Desayuno inicial'),'energia' => 20,'grasas' => 5,'proteinas' => 23,'carbohidratos' => 10],
            ['nombre' => strtoupper('nutrete Comida inicial'),'energia' => 15,'grasas' => 6,'proteinas' => 15,'carbohidratos' => 14],
            ['nombre' => strtoupper('nutrete Cena inicial'),'energia' => 19,'grasas' => 5,'proteinas' => 20,'carbohidratos' => 12],
            ['nombre' => strtoupper('nutrete colacion inicial Matutina'),'energia' => 20,'grasas' => 2,'proteinas' => 15,'carbohidratos' => 15],
            ['nombre' => strtoupper('nutrete colacion inicial Vespertina'),'energia' => 19,'grasas' => 4,'proteinas' => 10,'carbohidratos' => 15]
        ]);

        DB::table('det_ali_men')->insert([
            ['alimento_id' => 7 , 'menu_id' => 1 , 'porciones' => 2],
            ['alimento_id' => 6 , 'menu_id' => 1 , 'porciones' => 1],
            ['alimento_id' => 14 , 'menu_id' => 1 , 'porciones' => 1],

            ['alimento_id' => 1 , 'menu_id' => 2, 'porciones' => 2],
            ['alimento_id' => 2 , 'menu_id' => 2, 'porciones' => 1],
            ['alimento_id' => 15 , 'menu_id' => 2, 'porciones' => 1],

            ['alimento_id' => 4 , 'menu_id' => 3, 'porciones' => 1],
            ['alimento_id' => 9, 'menu_id' => 3, 'porciones' => 1],
            ['alimento_id' => 13, 'menu_id' => 3, 'porciones' => 1],

            ['alimento_id' => 11, 'menu_id' => 4, 'porciones' => 2],
            ['alimento_id' => 12, 'menu_id' => 4, 'porciones' => 3],

            ['alimento_id' => 5, 'menu_id' => 5, 'porciones' => 1],

        ]);

        /*DB::table('det_pac_men')->insert([
            ['paciente_id' => 1 , 'menu_id' => 1]
        ]);*/

    }//



}//
