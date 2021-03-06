<?php
/**
 * Created by PhpStorm.
 * User: ibalop
 * Date: 8/11/17
 * Time: 08:15 PM
 */

namespace App\Http\Controllers;

use App\Paciente;
use App\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Intervention\Image\Facades\Image;

class PacienteController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */

    public function registro(Request $request){

        $this->validate($request,[
              'nombre' => 'required',
              'ape_paterno' => 'required',
              'ape_materno' => 'required',
              'email' => 'required',
              'fecha_naci' => 'required',
              'sexo' => 'required|max:1',
          ]);

        $paciente = new Paciente;
        $paciente->nombre = mb_strtoupper($request->input('nombre'));
        $paciente->ape_paterno = mb_strtoupper($request->input('ape_paterno'));
        $paciente->ape_materno = mb_strtoupper($request->input('ape_materno'));
        $paciente->email = $request->input('email');
        $paciente->fecha_naci = $request->input('fecha_naci');
        $paciente->sexo = $request->input('sexo');
        $paciente->meta = $request->input('meta')?$request->input('meta'):"";
        $paciente->patologias = $request->input('patologias')?$request->input('patologias'):"";
        $paciente->alergias = $request->input('alergias')?$request->input('alergias'):"";
        $paciente->antibioticos = $request->input('medicamentos')?$request->input('medicamentos') : "";
        $paciente->telefono = $request->input('telefono')?$request->input('telefono'):"";
        $paciente->fecha_reg = date('Y-m-d');

        $paciente->peso = $request->input('peso')?$request->input('peso'):0;
        $paciente->peso_habitual = $request->input('peso_habitual')?$request->input('peso_habitual'):0;
        $paciente->altura = $request->input('altura')?$request->input('altura'):0;
        $paciente->precion_arteria = $request->input('precion_arteria')?$request->input('precion_arteria'):0;
        $paciente->lugar_naci = $request->input('lugar_naci')?$request->input('lugar_naci'):"";
        $paciente->domicilio = $request->input('domicilio')?$request->input('domicilio'):"";
        $paciente->alcohol = $request->input('alcohol')?$request->input('alcohol'):false;
        $paciente->obesidad = $request->input('obesidad')?$request->input('obesidad'):false;
        $paciente->tabaco = $request->input('tabaco')?$request->input('tabaco'):false;
        $paciente->colesterol = $request->input('colesterol')?$request->input('colesterol'):false;
        $paciente->diabetes = $request->input('diabetes')?$request->input('diabetes'):false;
        $paciente->hipertencion = $request->input('hipertencion')?$request->input('hipertencion'):false;
        $paciente->hipotencion = $request->input('hipotencion')?$request->input('hipotencion'):false;
        $paciente->alimentos_unlike = $request->input('alimentos_unlike')?$request->input('alimentos_unlike'):'';

        $paciente->pwd = $request->input('pwd')?md5($request->input('pwd')):md5('');

        $paciente->activo = $request->input('activo')?$request->input('activo'):true;
        $paciente->pre_registro = $request->input('pre_registro')?$request->input('pre_registro'):false;
        $paciente->save();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Registro completado'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//registro

    public function updateRegistro(Request $request){

        $this->validate($request,[
            'id' => 'required'
        ]);
        $id = $request->input('id');
        $paciente = Paciente::find($id);
        $paciente->nombre = mb_strtoupper($request->input('nombre')?$request->input('nombre'):$paciente->nombre);
        $paciente->ape_paterno = mb_strtoupper($request->input('ape_paterno')?$request->input('ape_paterno'):$paciente->ape_paterno);
        $paciente->ape_materno = mb_strtoupper($request->input('ape_materno')?$request->input('ape_materno'):$paciente->ape_materno);
        $paciente->email = $request->input('email')?$request->input('email'):$paciente->email;
        $paciente->fecha_naci = $request->input('fecha_naci')?$request->input('fecha_naci'):$paciente->fecha_naci;
        $paciente->sexo = $request->input('sexo')?$request->input('sexo'):$paciente->sexo;
        $paciente->meta = $request->input('meta')?$request->input('meta'):$paciente->meta;
        $paciente->patologias = $request->input('patologias')?$request->input('patologias'):$paciente->patologias;
        $paciente->alergias = $request->input('alergias')?$request->input('alergias'):$paciente->alergias;
        $paciente->antibioticos = $request->input('medicamentos')?$request->input('medicamentos') : $paciente->antibioticos;
        $paciente->telefono = $request->input('telefono')?$request->input('telefono'):$paciente->telefono;

        $paciente->peso = $request->input('peso')?$request->input('peso'):$paciente->peso;
        $paciente->peso_habitual = $request->input('peso_habitual')?$request->input('peso_habitual'):$paciente->peso_habitual;
        $paciente->altura = $request->input('altura')?$request->input('altura'):$paciente->altura;
        $paciente->precion_arteria = $request->input('precion_arteria')?$request->input('precion_arteria'):$paciente->precio_arteria;
        $paciente->lugar_naci = $request->input('lugar_naci')?$request->input('lugar_naci'):$paciente->lugar_naci;
        $paciente->domicilio = $request->input('domicilio')?$request->input('domicilio'):$paciente->domicilio;
        $paciente->alcohol = $request->input('alcohol')?$request->input('alcohol'):$paciente->alcohol;
        $paciente->obesidad = $request->input('obesidad')?$request->input('obesidad'):$paciente->obesidad;
        $paciente->tabaco = $request->input('tabaco')?$request->input('tabaco'):$paciente->tabaco;
        $paciente->colesterol = $request->input('colesterol')?$request->input('colesterol'):$paciente->colesterol;
        $paciente->diabetes = $request->input('diabetes')?$request->input('diabetes'):$paciente->diabetes;
        $paciente->hipertencion = $request->input('hipertencion')?$request->input('hipertencion'):$paciente->hipertencion;
        $paciente->hipotencion = $request->input('hipotencion')?$request->input('hipotencion'):$paciente->hipotencion;
        $paciente->alimentos_unlike = $request->input('alimentos_unlike')?$request->input('alimentos_unlike'):$paciente->alimentos_unlike;

        $paciente->pwd = $request->input('pwd')?md5($request->input('pwd')):$paciente->pwd;

        $paciente->activo = $request->input('activo')?$request->input('activo'):$paciente->activo;
        $paciente->pre_registro = $request->input('pre_registro')?$request->input('pre_registro'):$paciente->pre_registro;
        $paciente->save();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Registro Actualizado'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//updateRegistro

    public function getPaciente(Request $request){

        $this->validate($request,[
            'id' => 'required'
        ]);
        $id = $request->input('id');
        $paciente = Paciente::find($id);
        $foto =(string) Image::make(storage_path('recursos/perfiles/'.$paciente->foto))->encode("data-url");
        $paciente->foto = $foto;
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $paciente
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//getPaciente

    public function getPacienteByCorreo(Request $request){

        $this->validate($request,[
            'correo' => 'required'
        ]);

        $correo = $request->input('correo');
        $pacientes = json_decode(Paciente::where('email',$correo)->get());
        $paciente="";
        foreach($pacientes as $pac){
            $paciente=$pac;
        }
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $paciente
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//getTelefonoByCorreo

    public function getPacientes(Request $request){

        $pacientes = null;
        if($request->input('inactivos')){
            $pacientes = Paciente::where([['activo',false],['pre_registro',false]])->get();
        }else if($request->input('pre')){
            $pacientes = Paciente::where('pre_registro',true)->get();
        }else if($request->input('activos')){
            $pacientes = Paciente::where('activo',true)->get();
        }else{
            $pacientes = Paciente::all();
        }

        $pac = array();
        foreach($pacientes as $paciente){
            $foto =(string) Image::make(storage_path('recursos/perfiles/'.$paciente->foto))->encode("data-url");
            $paciente->foto = $foto;
            $pac[]  = $paciente;
        }

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $pacientes
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//getPacientes

    public function preRegistro(Request $request){

      $this->validate($request,[
            'nombre' => 'required',
            'ape_paterno' => 'required',
            'ape_materno' => 'required',
            'email' => 'required|email|unique:pacientes',
            'fecha_naci' => 'required',
            'sexo' => 'required|max:1',
        ]);

        $paciente = new Paciente;
        $paciente->nombre = mb_strtoupper($request->input('nombre'));
        $paciente->ape_paterno = mb_strtoupper($request->input('ape_paterno'));
        $paciente->ape_materno = mb_strtoupper($request->input('ape_materno'));
        $paciente->email = $request->input('email');
        $paciente->fecha_naci = $request->input('fecha_naci');
        $paciente->sexo = strtoupper($request->input('sexo'));
        $paciente->meta = $request->input('meta')?$request->input('meta'):"";
        $paciente->patologias = $request->input('patologias')?$request->input('patologias'):"";
        $paciente->alergias = $request->input('alergias')?$request->input('alergias'):"";
        $paciente->antibioticos = $request->input('medicamentos')?$request->input('medicamentos') : "";
        $paciente->telefono = $request->input('telefono')?$request->input('telefono'):"";
        $paciente->fecha_reg = date('Y-m-d');
        $paciente->activo = false;
        $paciente->pre_registro = true;
        if ($request->input('sexo') == 'M'){
            $paciente->foto = "mujer.jpg";
        }else{
            $paciente->foto = "hombre.jpg";
        }
        $paciente->save();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Pre-registro completado'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//preregistro


    public function getPreRegistros(){
        $prereg = Paciente::where('pre_registro',true)->get();
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $prereg
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//getpreregistros


    public function estadoRegistro(Request $request){
        $this->validate($request,[
            'id' => 'required|numeric',
            'estado' => 'required|boolean'
        ]);

        $id = $request->input('id');
        $estado = $request->input('estado');
        $paciente = Paciente::find($id);
        if($estado == 1){
            $paciente->pre_registro = false;
            $paciente->activo = true;
        }else{
            $paciente->pre_registro = true;
            $paciente->activo = false;
        }

        if($estado == 1 && empty($paciente->pwd)){
            $pwd = $request->input('pwd')?$request->input('pwd'):"";
            $paciente->pwd = md5($pwd);
        }

        $paciente->save();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Estado Actualizado'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//estadoRegistro

    public function loginPaciente(Request $request){
        $this->validate($request,[
            'email' => 'required',
            'pwd' => 'required'
        ]);
        $email = $request->input('email');
        $pwd = $request->input('pwd');
        $login = DB::table('pacientes')->select('paciente_id','nombre','ape_paterno','ape_materno','email')->where([
            ['email' , '=' , $email] ,
            ['pwd','=',md5($pwd)],
            ['activo','=',true]
        ])->get();

	    if (sizeof($login) == 0){
            return response()->json([
                'status' => 'fail',
                'code' => 400,
                'result' => ['error' => 'Dato(s) incorrectos']
            ],400)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Content-Type', 'application/json');
        }

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $login
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//loginPaciente

    public function eliminarPreRegistro(Request $request){
        $this->validate($request,['id' => 'required']);
        $id = $request->input('id');
        $paciente = Paciente::find($id);
        $paciente->delete();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => "Se elimino el pre-registro"
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//eliminarPreRegistro , elimina el registro por completo

    public function estadoPaciente(Request $request){
        $this->validate($request,[
            'id' => 'required',
            'estatus' => 'required:boolean'
        ]);
        $id = $request->input('id');
        $estatus = $request->input('estatus');
        $paciente = Paciente::find($id);
        $paciente->activo = $estatus;
        $paciente->pre_registro = false;
        $paciente->save();
        
         return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => "Se actualizo el estatus del paciente"
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
        
    }//estado paciente
    
    /*
     *  menu
     * */

    public function setMenus(Request $request){

        $this->validate($request,[
            'menus' => 'required|array',
            'paciente_id' => 'required'
        ]);

        $paciente = $request->input('paciente_id');
        $menus = $request->input('menus');
        foreach ($menus as $menu ){
            DB::table('det_pac_men')->insert(
                ['menu_id' => $menu, 'paciente_id' => $paciente]
            );
        }
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => "Se asigno menu"
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//set menu


    public function getMenus(Request $request){
        $this->validate($request,[
            'id' => 'required'
        ]);

        $paciente = $request->input('id');

        $menus = DB::table('pacientes')
            ->join('det_pac_men', 'det_pac_men.paciente_id', '=', 'pacientes.paciente_id')
            ->join('menus','menus.menu_id','=','det_pac_men.menu_id')
            ->select('menus.*')
            ->where('pacientes.paciente_id',$paciente)
            ->get()->toArray();

        $menu_paciente  = array();
        foreach ($menus as $menu){
            $id = $menu['menu_id'];

            $alimentos = DB::table('menus')
                ->join('det_ali_men', 'det_ali_men.menu_id', '=', 'menus.menu_id')
                ->join('alimentos','alimentos.alimento_id','=','det_ali_men.alimento_id')
                ->select('alimentos.alimento_id','alimentos.descripcion', 'alimentos.um', 'alimentos.kcal','alimentos.tipo')
                ->where('menus.menu_id',$id)
                ->get()->toArray();

            $menu['alimentos'] = $alimentos;
            $menu_paciente[] = $menu;
        }

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $menu_paciente
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//get Menus

    public function setPicture(Request $request){
        $this->validate($request,['id' => 'required']);
        $id = $request->input('id');
        if ($request->input('foto')){
            //if ($request->file('foto')->isValid()){
                ##visualizar la imagen
                /*$img  = Image::make($file)->resize(200,260)->encode('jpg');
                return response()->make($img)->header("Content-Type", "image/jpg");*/
                ##get imagen en base64
                //$img  = (string)Image::make($file)->resize(200,260)->encode('data-url');
                //echo strlen($img);
                $paciente = Paciente::find($id);
                $filename = "paciente".$id.".jpg";
                $paciente->foto = $filename;
                $file = $request->input('foto');
                $img  = Image::make($file)->resize(200,260)->encode('jpg');
                $img->save(storage_path('recursos/perfiles/'.$filename));

                $paciente->domicilio = $request->input('domicilio')?$request->input('domicilio'):$paciente->domicilio;
                $paciente->telefono = $request->input('telefono')?$request->input('telefono'):$paciente->telefono;
                $paciente->pwd = $request->input('pwd1')?md5($request->input('pwd1')):$paciente->pwd;
                $paciente->save();

                return response()->json([
                    'status' => 'OK',
                    'code' => 200,
                    'result' => "Datos de perfil guardados"
                ],200)
                    ->header('Access-Control-Allow-Origin','*')
                    ->header('Content-Type', 'application/json');
            //}
        }else{
            $paciente = Paciente::find($id);
            $paciente->domicilio = $request->input('domicilio')?$request->input('domicilio'):$paciente->domicilio;
            $paciente->telefono = $request->input('telefono')?$request->input('telefono'):$paciente->telefono;
            $paciente->pwd = $request->input('pwd1')?md5($request->input('pwd1')):$paciente->pwd;
            $paciente->save();

            return response()->json([
                'status' => 'OK',
                'code' => 200,
                'result' => "Datos de perfil guardados"
            ],200)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Content-Type', 'application/json');
        }


        return response()->json([
            'status' => 'Fail',
            'code' => 400,
            'result' => "Error al subir la imagen"
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');


    }//guardar una imagen de paciente


    public function getPicture(Request $request){
        $this->validate($request,['id' => 'required']);
        $id = $request->input('id');
        $paciente = Paciente::find($id);
        $foto =(string) Image::make(storage_path('recursos/perfiles/'.$paciente->foto))->encode("data-url");

        return response()->json([
            'status' => 'ok',
            'code' => 200,
            'result' => ['foto' => $foto,'domicilio' => $paciente->domicilio,'telefono' => $paciente->telefono]
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//getPhoto


    public function setPictureSeguimiento(Request $request){

        $this->validate($request,['id' => 'required']);
        date_default_timezone_set('america/mazatlan');
        $fecha = date('Y-m-d');
        if ($request->input('foto')){
            $id = $request->input('id');
            $count =  Seguimiento::where('paciente_id',$id)->count('paciente_id');
            $filename = "paciente".$id."-".($count+1)."-".$fecha.".jpg";
            $seguimiento = new Seguimiento();
            $seguimiento->fecha = $fecha;
            $seguimiento->foto = $filename;
            $seguimiento->paciente_id = $id;
            $file = $request->input('foto');
            $img  = Image::make($file)->resize(400,460)->encode('jpg');
            $img->save(storage_path('recursos/seguimientos/'.$filename));
            $seguimiento->save();

            return response()->json([
                'status' => 'ok',
                'code' => 200,
                'result' => 'Imagen guardada'
            ],200)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Content-Type', 'application/json');

        }else{
            return response()->json([
                'status' => 'fail',
                'code' => 400,
                'result' => 'Error al subir la foto'
            ],200)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Content-Type', 'application/json');

        }

    }//enviar foto del seguimiento


    public function getPicturesSeguimiento(Request $request){
        $this->validate($request,['id' => 'required']);
        $id = $request->input('id');
        $seguimiento = Seguimiento::where('paciente_id',$id)->get();
        $result = array();
        foreach ($seguimiento as $seg){
            $foto =(string) Image::make(storage_path('recursos/seguimientos/'.$seg->foto))->encode("data-url");
            $seg->foto = $foto;
            $result[] = $seg;
        }

        return response()->json([
            'status' => 'ok',
            'code' => 200,
            'result' => $result
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//obtener imagenes de seguimiento de un paciente


    public function deleteSeguimientos(Request $request){
        $this->validate($request,['id' => 'required']);
        $id = $request->input('id');
        $seguimiento = Seguimiento::where('paciente_id',$id)->get()->toArray();
        foreach($seguimiento as $seg){
            $file = storage_path('recursos/seguimientos/'.$seg['foto']);
            unlink($file);
        }

        DB::table('seguimientos')->where('paciente_id',$id)->delete();

        return response()->json([
            'status' => 'ok',
            'code' => 200,
            'result' => 'Se elimino el seguimiento'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//eleminar el seguimiento de fotos de un paciente



    public function deleteSeguimiento(Request $request){
        $this->validate($request,['id' => 'required']);
        $id = $request->input('id');
        $seguimiento = Seguimiento::find($id);
        if($seguimiento != null){
            $file = storage_path('recursos/seguimientos/'.$seguimiento->foto);
            unlink($file);
            $seguimiento->delete();
        }

        return response()->json([
            'status' => 'ok',
            'code' => 200,
            'result' => 'Se elimino el seguimiento'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//eliminar una seguimiento en especifico

}//PacienteController
