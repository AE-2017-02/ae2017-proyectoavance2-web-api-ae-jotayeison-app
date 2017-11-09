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

class PacienteController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */


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
        $paciente->nombre = $request->input('nombre');
        $paciente->ape_paterno = $request->input('ape_paterno');
        $paciente->ape_materno = $request->input('ape_materno');
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
        $prereg = Paciente::where('activo',false)->get();
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
        $paciente->activo = $estado;
        $paciente->save();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Estado Actualizado'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//estadoRegistro



}//PacienteController