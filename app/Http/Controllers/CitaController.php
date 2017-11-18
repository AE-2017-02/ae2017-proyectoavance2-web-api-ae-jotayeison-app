<?php
/**
 * Created by PhpStorm.
 * User: ibalop
 * Date: 18/11/17
 * Time: 01:02 PM
 */

namespace App\Http\Controllers;


use App\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function insert(Request $request){
        $this->validate($request,[
            'fecha' => 'required',
            'paciente' => 'required'
        ]);
        $fecha = $request->input('fecha');
        $id = $request->input('paciente');
        $cita = new Cita();
        $cita->fec_hor = $fecha;
        $cita->status = 0;
        $cita->paciente_id = $id;
        $cita->save();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se registro la cita correctamente'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//insertar cita

    public function getCitas(Request $request){
        //$this->validate($request,['status'=>'required']);
        //$citas = Cita::join()->where('status',$status)->orderBy('fec_hor','desc')->get();
        $citas = null;
        if($request->input('status')){
            $status = $request->input('status');
            $citas = DB::table('citas')
                ->select('citas.*','pacientes.nombre','pacientes.ape_paterno','pacientes.ape_materno')
                ->join('pacientes','citas.paciente_id','=','citas.paciente_id')
                ->where('status',$status)
                ->orderBy('fec_hor','desc')->get();
        }else{
            $citas = Cita::all();
        }

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $citas
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }// get citas

    public function cancel(Request $request){
        $this->validate($request,[
            'id' => "required"
        ]);
        $id = $request->input('id');
        $cita = Cita::find($id);
        $cita->status = 2;
        $cita->motivo = $request->input('motivo')?$request->input('motivo'):"";
        $cita->save();
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se cancelo la cita'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//cancelar cita

    public function update(Request $request){
        $this->validate($request,[
            'id' => 'required'
        ]);

        $id = $request->input('id');
        $cita = Cita::find($id);
        $cita->fec_hor = $request->input('fecha')?$request->input('fecha'):$cita->fec_hor;
        $cita->status = $request->input('status')?$request->input('status'):$cita->status;
        $cita->motivo = $request->input('motivo')?$request->input('status'):$cita->motivo;
        $cita->save();


        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se actualizo la cita'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');


    }//actualizar cita


    public function delete(Request $request){
        $this->validate($request,[
            'id' => 'required'
        ]);
        $id = $request->input('id');
        $cita = Cita::find($id);
        $cita->delete();
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se elimino la cita'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//eliminar

    public function getCitasBetween(Request $request){
        $request->validate($request,['fecha1'=>'required','fecha2'=>'required']);
        $f1 = $request->input('fecha1');
        $f2 = $request->input('fecha2');
        //$citas = Cita::whereBetween('fec_hor',[$f1,$f2])->get();
        $citas = DB::table('citas')
            ->select('citas.*','pacientes.nombre','pacientes.ape_paterno','pacientes.ape_materno')
            ->join('pacientes','citas.paciente_id','=','citas.paciente_id')
            ->whereBetween('fec_hor',[$f1,$f2])->get();
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $citas
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//traer citas entre rango de fechas




}//controller