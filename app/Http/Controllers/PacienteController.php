<?php
/**
 * Created by PhpStorm.
 * User: ibalop
 * Date: 8/11/17
 * Time: 08:15 PM
 */

namespace App\Http\Controllers;

use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class PacienteController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function preRegistro(Request $request){

      /*  $this->validate($request,[
            'nombre' => 'required',
            'ape_paterno' => 'required',
            'ape_materno' => 'required',
            'email' => 'required|email|unique:pacientes',
            'fecha_naci' => 'required',
            'sexo' => 'required|max:1',
        ]);*/

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
        $paciente->activo = false;
        $paciente->pre_registro = true;
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

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $login
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//loginPaciente


}//PacienteController