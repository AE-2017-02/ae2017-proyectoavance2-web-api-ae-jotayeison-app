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
    public function delete(Request $request){
        $this->validate($request,['id'=>'required']);
        $id = $request->input('id');
        $rc = Resumen_cita::find($id);
        $rc->delete();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se elimino el resumen de la cita correctamente'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//
    public function insert(Request $request){
        $this->validate($request,[
            'braso' => 'required',
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
        $braso = $request->input('braso');
        $bcontraido = $request->input('bcontraido');
        $cintura = $request->input('cintura');
        $muslo = $request->input('muslo');
        $cadera = $request->input('cadera');
        $pantorrilla = $request->input('pantorrilla');
        $muneca = $request->input('muneca');

        $tricipal = $request->input('tricipal');
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
        $resumencita->braso = $braso;
        $resumencita->bcontraido = $bcontraido ;
        $resumencita->cintura = $cintura;
        $resumencita->muslo = $muslo;
        $resumencita->cadera = $cadera;
        $resumencita->pantorrilla = $pantorrilla;
        $resumencita->muneca = $muneca;

        $resumencita->tricipal = $tricipal;
        $resumencita->sespinale = $sespinale;
        $resumencita->sescapular = $sescapular;
        $resumencita->abdominal = $abdominal;
        $resumencita->bicipital = $bicipital;
        $resumencita->pmuslo = $pmuslo;
        $resumencita->sliaco = $sliaco;
        $resumencita->pliegues4 = $pliegues4;
        $resumencita->pliegues8 = $pliegues8;
        $resumencita->ppantorrillas = $ppantorrillas;

        $resumencita->tipodieta = $tipodieta;
        $resumencita->observacion = $observacion;

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

    public function update(Request $request){
        $this->validate($request,[
            'id' => 'required'
        ]);
        $id = $request->input('id');

        $ppantorrillas = ;

        $tipodieta = ;
        $observacion = ;

        $paciente_id = $request->input('paciente_id');
        $cita_id = $request->input('cita_id');

        $resumencita = Resumen_cita::find($id);
        $resumencita->braso = $request->input('braso')?$request->input('braso'):$resumencita->braso;
        $resumencita->bcontraido = $request->input('bcontraido')?$request->input('bcontraido'):$resumencita->bcontraido ;
        $resumencita->cintura =  $request->input('cintura')? $request->input('cintura'):$resumencita->cintura;
        $resumencita->muslo = $request->input('muslo')?$request->input('muslo'):$resumencita->muslo ;
        $resumencita->cadera =$request->input('cadera')?$request->input('cadera'):$resumencita->cadera ;
        $resumencita->pantorrilla = $request->input('pantorrilla')?$request->input('pantorrilla'):$resumencita->pantorrilla;
        $resumencita->muneca = $request->input('muneca')?$request->input('muneca'):$resumencita->muneca;

        $resumencita->tricipal = $request->input('tricipal')?$request->input('tricipal'):$resumencita->tricipal;
        $resumencita->sespinale = $request->input('sespinale')?$request->input('sespinale'):$resumencita->sespinale;
        $resumencita->sescapular = $request->input('sescapular')?$request->input('sescapular'):$resumencita->sescapular;
        $resumencita->abdominal =  $request->input('abdominal')? $request->input('abdominal'):$resumencita->abdominal;
        $resumencita->bicipital =$request->input('bicipital')?$request->input('bicipital'):$resumencita->bicipital ;
        $resumencita->pmuslo =  $request->input('pmuslo')? $request->input('pmuslo'):$resumencita->pmuslo;
        $resumencita->sliaco = $request->input('sliaco')?$request->input('sliaco'):$resumencita->sliaco;
        $resumencita->pliegues4 =  $request->input('pliegues4')? $request->input('pliegues4'):$resumencita->pliegues4;
        $resumencita->pliegues8 =  $request->input('pliegues8')? $request->input('pliegues8'):$resumencita->pliegues8;
        $resumencita->ppantorrillas = $request->input('ppantorrillas')?$request->input('ppantorrillas'): $resumencita->ppantorrillas;

        $resumencita->tipodieta = $request->input('tipodieta')?$request->input('tipodieta'):$resumencita->tipodieta;
        $resumencita->observacion = $request->input('observacion')?$request->input('observacion'):$resumencita->observacion;

        $resumencita->save();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => 'Se actualizo el resumen de la cita correctamente'
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');

    }//actualiza datos de un resumen de citas
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