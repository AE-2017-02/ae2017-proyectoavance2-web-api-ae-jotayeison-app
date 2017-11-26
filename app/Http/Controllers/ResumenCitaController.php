<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 21/11/2017
 * Time: 03:26 PM
 */

namespace App\Http\Controllers;

use App\Cita;
use App\Resumen_cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResumenCitaController extends Controller {
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function insert(Request $request){
        $this->validate($request,[
            'brazo' => 'required',
            'bcontraido' => 'required',
            'cintura' => 'required',
            'muslo' => 'required',
            'cadera' => 'required',
            'pantorrilla' => 'required',
            'muneca' => 'required',
            'tricipal' => 'required',
            'sespinale' => 'required',
            'sescapular' => 'required',
            'abdominal' => 'required',
            'bicipital' => 'required',
            'pmuslo' => 'required',
            'sliaco' => 'required',
            'ppantorrillas' => 'required',
            'pliegues4' => 'required',
            'pliegues8' => 'required',
            'tipodieta' => 'required',
            'observacion' => 'required',
            'paciente_id' => 'required',
            'cita_id' => 'required'
        ]);
        $brazo = $request->input('brazo');
        $bcontraido = $request->input('bcontraido');
        $cintura = $request->input('cintura');
        $muslo = $request->input('muslo');
        $cadera = $request->input('cadera');
        $pantorrilla = $request->input('pantorrilla');
        $muneca = $request->input('muneca');
        $tricipital = $request->input('tricipital');
        $sespinale = $request->input('sespinale');
        $sescapular = $request->input('sescapular');
        $abdominal = $request->input('abdominal');
        $bicipital = $request->input('bicipital');
        $pmuslo = $request->input('pmuslo');
        $sliaco = $request->input('sliaco');
        $ppantorrillas = $request->input('ppantorrillas');
        $pliegues4 = $request->input('pliegues4');
        $pliegues8 = $request->input('pliegues8');
        $tipodieta = $request->input('tipodieta');
        $observacion = $request->input('observacion');
        $paciente_id = $request->input('paciente_id');
        $cita_id = $request->input('cita_id');

        $resumencita = new Resumen_cita();
        $resumencita->brazo = $brazo;
        $resumencita->bcontraido = $bcontraido ;
        $resumencita->cintura = $cintura;
        $resumencita->muslo = $muslo;
        $resumencita->cadera = $cadera;
        $resumencita->pantorrilla = $pantorrilla;
        $resumencita->muneca = $muneca;
        $resumencita->tricipital = $tricipital;
        $resumencita->sespinale = $sespinale;
        $resumencita->sescapular = $sescapular;
        $resumencita->abdominal = $abdominal;
        $resumencita->bicipital = $bicipital;
        $resumencita->pmuslo = $pmuslo;
        $resumencita->sliaco = $sliaco;
        $resumencita->pliegues4 = $pliegues4;
        $resumencita->pliegues8 = $pliegues8;
        $resumencita->tipodieta = $tipodieta;
        $resumencita->observacion = $observacion;
        $resumencita->ppantorrillas = $ppantorrillas;
        $resumencita->paciente_id = $paciente_id;
        $resumencita->cita_id = $cita_id;
        $resumencita->save();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se registro el resumen de la cita correctamente'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//insertar resumen citas

    public function getResumenCitas(Request $request){
        $resumencitas = null;
        $paciente_id = $request->input('paciente_id');
        $resumencitas = DB::table('resumen_citas')
            ->join('pacientes','resumen_citas.paciente_id','=','pacientes.paciente_id')
            ->join('citas','resumen_citas.cita_id','=','citas.cita_id')
            ->select('citas.fecha','citas.hora','pacientes.nombre','pacientes.ape_paterno','pacientes.ape_materno','resumen_citas.*')
            ->where('pacientes.paciente_id',$paciente_id)
            ->orderBy('fecha','desc')
            ->orderBy('hora','desc')->get();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $resumencitas
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }// get ResumenCitas

}//controller resumen citas