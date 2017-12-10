<?php
/**
 * Created by PhpStorm.
 * User: ibalop
 * Date: 18/11/17
 * Time: 01:02 PM
 */

namespace App\Http\Controllers;


use App\Cita;
use App\Paciente;
use Faker\Provider\DateTime;
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
     public function horas($fecha){
        $horarios=[];
        $configuraciones =json_decode(DB::table('configuraciones')
            ->select('configuraciones.horario')
            ->get());
        $horario=[];
        foreach ($configuraciones as $config){
            $horario=json_decode($config->horario);
        }
        $citas=DB::table('citas')
            ->select('citas.hora')
            ->where('citas.fecha',$fecha)
            ->get();

        $array_dias['Sunday'] = "domingo";
        $array_dias['Monday'] = "lunes";
        $array_dias['Tuesday'] = "martes";
        $array_dias['Wednesday'] = "miercoles";
        $array_dias['Thursday'] = "jueves";
        $array_dias['Friday'] = "viernes";
        $array_dias['Saturday'] = "sabado";
        $diasemana=$array_dias[date('l', strtotime($fecha))];
        $dia=$horario->$diasemana;

        $incremento=$horario->duracion;

        $hora=strtotime($dia->inicio);
        $fin=strtotime($dia->fin);

        $descansoini=strtotime($dia->inini);
        $descansofin=strtotime($dia->infin);

        $array=[];
        foreach ($citas as $cita){
            array_push($array, $cita->hora);

        }
        while($hora<$fin){

            if (!in_array(date("h:i:s",$hora),$array)) {
                if($hora>=$descansoini&&$hora<$descansofin){

                }
                else {
                    array_push($horarios, date("h:i:s", $hora));
                }
            }
            $hora=strtotime ( $incremento ,$hora);
        }
        return $horarios;
    }


    public function insert(Request $request){
        $this->validate($request,[
            'fecha' => 'required',
            'hora'  => 'required',
            'paciente' => 'required'
        ]);
        $fecha =$request->input('fecha');
        $hora = date('h:i:s', strtotime($request->input('hora')));
        $id = $request->input('paciente');
        $cita = new Cita();
        $cita->fecha = $fecha;
        $cita->hora =$hora;
        $cita->status = 0;
        $cita->paciente_id = $id;
        $array=$this->horas($fecha);

        if(in_array($hora,$array)) {
            $cita->save();
            return response()->json([
                'status' => 'OK',
                'code' => 200,
                'result' => 'Se registro la cita correctamente'
            ], 200)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Content-Type', 'application/json');
        }
        else{
            return response()->json([
                'status' => 'Error',
                'code' => 405,
                'result' => 'La hora no es valida o no se encuentra disponible'
            ], 200)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Content-Type', 'application/json');
        }
    }//insertar cita

    public function getCitas(Request $request){
        //$this->validate($request,['status'=>'required']);
        //$citas = Cita::join()->where('status',$status)->orderBy('fec_hor','desc')->get();
        $citas = null;
        //die($request->input('status'));
        if($request->input('status')!=null){
            $status = $request->input('status');
                $citas = DB::table('citas')
                ->join('pacientes','citas.paciente_id','=','pacientes.paciente_id')
                ->select('citas.*','pacientes.nombre','pacientes.ape_paterno','pacientes.ape_materno')
                ->where('status',$status)
                ->orderBy('fecha','desc')
                ->orderBy('hora','desc')->get();
        }else{
            $citas = DB::table('citas')
                ->join('pacientes','citas.paciente_id','=','pacientes.paciente_id')
                ->select('citas.*','pacientes.nombre','pacientes.ape_paterno','pacientes.ape_materno')
                ->get();
        }

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $citas
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }// get citas

    public function getCitasByPaciente(Request $request){
        $this->validate($request,['id'=>'required']);
        $id = $request->input('id');
        $citas = null;
        if($request->input('status')){
            $status = $request->input('status');
            $citas = DB::table('citas')
                ->join('pacientes','citas.paciente_id','=','pacientes.paciente_id')
                ->select('citas.*','pacientes.nombre','pacientes.ape_paterno','pacientes.ape_materno')
                ->where('status',$status)
                ->orderBy('fecha','desc')
                ->orderBy('hora','desc')->get();
        }else{
            $citas = DB::table('citas')
                ->join('pacientes','citas.paciente_id','=','pacientes.paciente_id')
                ->select('citas.*','pacientes.nombre','pacientes.ape_paterno','pacientes.ape_materno')
                ->where('pacientes.paciente_id',$id)
                ->get();
        }

        if(sizeof($citas)==0 ){
            return response()->json([
                'status' => 'fail',
                'code' => 400,
                'result' => ['error' => 'No hay citas para el paciente '.$id]
            ],400)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Content-Type', 'application/json');
        }
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $citas
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }// get citas by id

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
        $cita->fecha = $request->input('fecha')?$request->input('fecha'):$cita->fecha;
        $cita->hora = $request->input('hora')?$request->input('hora'):$cita->hora;
        $cita->status = $request->input('status')?$request->input('status'):$cita->status;
        $cita->motivo = $request->input('motivo')?$request->input('motivo'):$cita->motivo;

        if($request->input('fecha')||$request->input('hora')) {
            $array = $this->horas($cita->fecha);
            if (in_array($cita->hora, $array)) {
                $cita->save();
                return response()->json([
                    'status' => 'OK',
                    'code' => 200,
                    'result' => 'Se actualizo la cita correctamente'
                ], 200)
                    ->header('Access-Control-Allow-Origin', '*')
                    ->header('Content-Type', 'application/json');
            } else {
                return response()->json([
                    'status' => 'Error',
                    'code' => 405,
                    'result' => 'La hora no es valida o no se encuentra disponible'
                ], 200)
                    ->header('Access-Control-Allow-Origin', '*')
                    ->header('Content-Type', 'application/json');
            }
        }
        else{
            $cita->save();
            return response()->json([
                'status' => 'OK',
                'code' => 200,
                'result' => 'Se actualizo la cita'
            ], 200)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Content-Type', 'application/json');
        }

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
        $this->validate($request,[
            'fecha1'=>'required',
            'fecha2'=>'required',
            'hora1'=>'required',
            'hora2'=>'required'
        ]);
        $f1 = $request->input('fecha1');
        $f2 = $request->input('fecha2');
        $h1 = $request->input('hora1');
        $h2 = $request->input('hora2');
        //$citas = Cita::whereBetween('fec_hor',[$f1,$f2])->get();
        $citas = DB::table('citas')
            ->select('citas.*','pacientes.nombre','pacientes.ape_paterno','pacientes.ape_materno')
            ->join('pacientes','citas.paciente_id','=','pacientes.paciente_id')
            ->whereBetween('fecha',[$f1,$f2])
            ->whereBetween('hora',[$h1,$h2])->get();
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $citas
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }//traer citas entre rango de fechas



    ##
    ## Movil
    ##
        public function getHorarios(Request $request){
        $this->validate($request,['fecha'=>'required']);
        $fecha = $request->input('fecha');

        $horarios=[];
        $horarios2=[];
        $configuraciones =json_decode(DB::table('configuraciones')
            ->select('configuraciones.horario')
            ->get());
        $horario=[];
        foreach ($configuraciones as $config){
            $horario=json_decode($config->horario);
        }
        $citas=DB::table('citas')
            ->select('citas.hora')
            ->where('citas.fecha',$fecha)
            ->get();

        $array_dias['Sunday'] = "domingo";
        $array_dias['Monday'] = "lunes";
        $array_dias['Tuesday'] = "martes";
        $array_dias['Wednesday'] = "miercoles";
        $array_dias['Thursday'] = "jueves";
        $array_dias['Friday'] = "viernes";
        $array_dias['Saturday'] = "sabado";
        $diasemana=$array_dias[date('l', strtotime($fecha))];
        $dia=$horario->$diasemana;

        $incremento=$horario->duracion;

        $hora=strtotime($dia->inicio);
        $fin=strtotime($dia->fin);

        $descansoini=strtotime($dia->inini);
        $descansofin=strtotime($dia->infin);

        $array=[];
        foreach ($citas as $cita){
            array_push($array, $cita->hora);

        }
        while($hora<$fin){

            if (!in_array(date("h:i:s",$hora),$array)) {
                if($hora>=$descansoini&&$hora<$descansofin){

                }
                else {
                    array_push($horarios, date("h:i", $hora));
                    array_push($horarios2, date("h:i:s", $hora));
                }
            }
            $hora=strtotime ( $incremento ,$hora);
        }
        $horas=[
            'hm'=>$horarios,
            'hms'=>$horarios2
        ];




        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $horas
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }// get citas


    public function getLastDates(){
        $pacientes = Paciente::where('activo',true)->get();
        $datos = array();

        foreach ($pacientes as $paciente){
            $d  = array();
            date_default_timezone_set('america/mazatlan');
            $fecha = date('Y-m-d');
            //die($fecha);
            $citas = Cita::where([["paciente_id",$paciente->paciente_id],['fecha','>=',$fecha],['status',1]])->get()->toArray();

            if (sizeof($citas)>0){
                $d['paciente_id'] = $paciente->paciente_id;
                $d['paciente'] = $paciente->nombre." ".$paciente->ape_paterno." ".$paciente->ape_materno;
                $d['citas'] = $citas;
                $datos[] = $d;
            }

        }

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $datos
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }
    public function getSinSeguimiento(){
        $pacientes = Paciente::where('activo',true)->get();
        $datos = array();
        foreach ($pacientes as $paciente){
            $d  = array();
            $idcita = Cita::where("paciente_id",$paciente->paciente_id)->max("cita_id");
            if ($idcita){
                $cita = Cita::where("cita_id",$idcita)->first();
                //$d['paciente_id'] = $paciente->paciente_id;
                $d['paciente'] = $paciente;
                $d['cita_id'] = $idcita;
                //$d['paciente'] = $paciente->nombre." ".$paciente->ape_paterno." ".$paciente->ape_materno;
                $d['fecha'] = $cita->fecha;
                $d['hora'] = $cita->hora;
                $datos[] = $d;
            }
        }
        $lpaciente=array();
        foreach($datos as $dato){
            $ayer = date('Y-m-d', strtotime('-1 day')) ;;
            $fecha = date('Y-m-d',strtotime($dato['fecha']));
            if($fecha <= $ayer){
                array_push($lpaciente,$dato);
            }
        }

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $lpaciente
        ],200)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Content-Type', 'application/json');
    }

}//controller