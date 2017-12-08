<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 25/11/2017
 * Time: 04:15 PM
 */

namespace App\Http\Controllers;

use App\Cita;
use App\Resumen_cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ExpedienteController
{
    public function getExpediente(Request $request)
    {
        $resultados = null;
        $expediente = null;
        $paciente_id = $request->input('paciente_id');
        $pacientes = DB::table('pacientes')
            ->select('pacientes.*')
            ->where('pacientes.paciente_id', $paciente_id)
            ->get();
        $resumencitas = DB::table('resumen_citas')
            ->select('resumen_citas.*')
            ->where('resumen_citas.paciente_id', $paciente_id)
            ->get();
        if ($pacientes[0]->sexo == 'm') {
            $resultados = [
                'pesoideal' => ($pacientes[0]->altura * 0.01) * ($pacientes[0]->altura * 0.01) * 21,
                'peso' => $pacientes[0]->peso,
                'imcideal' => 21,
                'imc' => ($pacientes[0]->peso) / (($pacientes[0]->altura * 0.01) * ($pacientes[0]->altura * 0.01)),
                'icc' => ($resumencitas[0]->cintura) / ($resumencitas[0]->cadera),
                'complexion' => ($pacientes[0]->altura) / ($resumencitas[0]->muneca)
            ];
        } else if ($pacientes[0]->sexo == 'h') {
            $resultados = [
                'pesoideal' => ($pacientes[0]->altura * 0.01) * ($pacientes[0]->altura * 0.01) * 23,
                'peso' => $pacientes[0]->peso,
                'imcideal' => 23,
                'imc' => ($pacientes[0]->peso) / (($pacientes[0]->altura * 0.01) * ($pacientes[0]->altura * 0.01)),
                'icc' => ($resumencitas[0]->cintura) / ($resumencitas[0]->cadera),
                'complexion' => ($pacientes[0]->altura) / ($resumencitas[0]->muneca)
            ];
        }
        $circunferencias = DB::table('resumen_citas')
            ->select('resumen_citas.brazo', 'resumen_citas.bcontraido', 'resumen_citas.cintura', 'resumen_citas.muslo', 'resumen_citas.cadera', 'resumen_citas.pantorrilla', 'resumen_citas.muneca')
            ->where('resumen_citas.paciente_id', $paciente_id)
            ->get();
        $pliegues = DB::table('resumen_citas')
            ->select('resumen_citas.tricipital', 'resumen_citas.sespinale', 'resumen_citas.bicipital', 'resumen_citas.sescapular', 'resumen_citas.abdominal', 'resumen_citas.bicipital', 'resumen_citas.pmuslo', 'resumen_citas.sliaco', 'resumen_citas.ppantorrillas')
            ->where('resumen_citas.paciente_id', $paciente_id)
            ->get();
        $menus=DB::table('det_pac_men')
            ->select('det_pac_men.menu_id')
            ->where('det_pac_men.paciente_id', $paciente_id)
            ->get();
        $menu=[];
        foreach ($menus as $men){
            //desayunos
            $desayuno1=DB::table('det_pac_men')
                ->join('det_ali_men','det_pac_men.menu_id','=','det_ali_men.menu_id')
                ->join('alimentos','det_ali_men.alimento_id','=','alimentos.alimento_id')
                ->select('alimentos.*')
                ->where('det_pac_men.paciente_id', $paciente_id)
                ->where('alimentos.tipo','Desayuno1')
                ->where('det_pac_men.menu_id',$men->menu_id)
                ->get();
            $desayuno2=DB::table('det_pac_men')
                ->join('det_ali_men','det_pac_men.menu_id','=','det_ali_men.menu_id')
                ->join('alimentos','det_ali_men.alimento_id','=','alimentos.alimento_id')
                ->select('alimentos.*')
                ->where('det_pac_men.paciente_id', $paciente_id)
                ->where('alimentos.tipo','Desayuno2')
                ->where('det_pac_men.menu_id',$men->menu_id)
                ->get();
            $desayuno3=DB::table('det_pac_men')
                ->join('det_ali_men','det_pac_men.menu_id','=','det_ali_men.menu_id')
                ->join('alimentos','det_ali_men.alimento_id','=','alimentos.alimento_id')
                ->select('alimentos.*')
                ->where('det_pac_men.paciente_id', $paciente_id)
                ->where('alimentos.tipo','Desayuno3')
                ->where('det_pac_men.menu_id',$men->menu_id)
                ->get();
            $kcaldes1=0;
            foreach ($desayuno1 as $des){
                $kcaldes1+=$des->kcal;
            }
            $detdesayuno1=[
                "alimentos"=>$desayuno1,
                "kcaltotal"=>$kcaldes1
            ];
            $kcaldes2=0;
            foreach ($desayuno2 as $des){
                $kcaldes2+=$des->kcal;
            }
            $detdesayuno2=[
                "alimentos"=>$desayuno2,
                "kcaltotal"=>$kcaldes2
            ];
            $kcaldes3=0;
            foreach ($desayuno3 as $des){
                $kcaldes3+=$des->kcal;
            }
            $detdesayuno3=[
                "alimentos"=>$desayuno3,
                "kcaltotal"=>$kcaldes3
            ];
            $desayunos=[
                'desayuno1'=>$detdesayuno1,
                'desayuno2'=>$detdesayuno2,
                'desayuno3'=>$detdesayuno3,
            ];
            //colacionesman
            $colacionman1=DB::table('det_pac_men')
                ->join('det_ali_men','det_pac_men.menu_id','=','det_ali_men.menu_id')
                ->join('alimentos','det_ali_men.alimento_id','=','alimentos.alimento_id')
                ->select('alimentos.*')
                ->where('det_pac_men.paciente_id', $paciente_id)
                ->where('alimentos.tipo','ColacionMañana1')
                ->where('det_pac_men.menu_id',$men->menu_id)
                ->get();
            $colacionman2=DB::table('det_pac_men')
                ->join('det_ali_men','det_pac_men.menu_id','=','det_ali_men.menu_id')
                ->join('alimentos','det_ali_men.alimento_id','=','alimentos.alimento_id')
                ->select('alimentos.*')
                ->where('det_pac_men.paciente_id', $paciente_id)
                ->where('alimentos.tipo','ColacionMañana2')
                ->where('det_pac_men.menu_id',$men->menu_id)
                ->get();
            $colacionman3=DB::table('det_pac_men')
                ->join('det_ali_men','det_pac_men.menu_id','=','det_ali_men.menu_id')
                ->join('alimentos','det_ali_men.alimento_id','=','alimentos.alimento_id')
                ->select('alimentos.*')
                ->where('det_pac_men.paciente_id', $paciente_id)
                ->where('alimentos.tipo','ColacionMañana3')
                ->where('det_pac_men.menu_id',$men->menu_id)
                ->get();
            $kcalcolman1=0;
            foreach ($colacionman1 as $col){
                $kcalcolman1+=$col->kcal;
            }
            $detcolacionman1=[
                "alimentos"=>$colacionman1,
                "kcaltotal"=>$kcalcolman1
            ];
            $kcalcolman2=0;
            foreach ($colacionman2 as $col){
                $kcalcolman2+=$col->kcal;
            }
            $detcolacionman2=[
                "alimentos"=>$colacionman2,
                "kcaltotal"=>$kcalcolman2
            ];
            $kcalcolman3=0;
            foreach ($colacionman3 as $col){
                $kcalcolman3+=$col->kcal;
            }
            $detcolacionman3=[
                "alimentos"=>$colacionman3,
                "kcaltotal"=>$kcalcolman3
            ];
            $colacionesman=[
                'colacion1'=>$detcolacionman1,
                'colacion2'=>$detcolacionman2,
                'colacion3'=>$detcolacionman3,
            ];
            //comidas
            $comida1=DB::table('det_pac_men')
                ->join('det_ali_men','det_pac_men.menu_id','=','det_ali_men.menu_id')
                ->join('alimentos','det_ali_men.alimento_id','=','alimentos.alimento_id')
                ->select('alimentos.*')
                ->where('det_pac_men.paciente_id', $paciente_id)
                ->where('alimentos.tipo','Comida1')
                ->where('det_pac_men.menu_id',$men->menu_id)
                ->get();
            $comida2=DB::table('det_pac_men')
                ->join('det_ali_men','det_pac_men.menu_id','=','det_ali_men.menu_id')
                ->join('alimentos','det_ali_men.alimento_id','=','alimentos.alimento_id')
                ->select('alimentos.*')
                ->where('det_pac_men.paciente_id', $paciente_id)
                ->where('alimentos.tipo','Comida2')
                ->where('det_pac_men.menu_id',$men->menu_id)
                ->get();
            $comida3=DB::table('det_pac_men')
                ->join('det_ali_men','det_pac_men.menu_id','=','det_ali_men.menu_id')
                ->join('alimentos','det_ali_men.alimento_id','=','alimentos.alimento_id')
                ->select('alimentos.*')
                ->where('det_pac_men.paciente_id', $paciente_id)
                ->where('alimentos.tipo','Comida3')
                ->where('det_pac_men.menu_id',$men->menu_id)
                ->get();
            $kcalcom1=0;
            foreach ($comida1 as $com){
                $kcalcom1+=$com->kcal;
            }
            $detcomida1=[
                "alimentos"=>$comida1,
                "kcaltotal"=>$kcalcom1
            ];
            $kcalcom2=0;
            foreach ($comida2 as $com){
                $kcalcom2+=$com->kcal;
            }
            $detcomida2=[
                "alimentos"=>$comida2,
                "kcaltotal"=>$kcalcom2
            ];
            $kcalcom3=0;
            foreach ($comida3 as $com){
                $kcalcom3+=$com->kcal;
            }
            $detcomida3=[
                "alimentos"=>$comida3,
                "kcaltotal"=>$kcaldes3
            ];
            $comidas=[
                'comida1'=>$detcomida1,
                'comida2'=>$detcomida2,
                'comida3'=>$detcomida3,
            ];
            ///colaciones2
            $colaciontar1=DB::table('det_pac_men')
                ->join('det_ali_men','det_pac_men.menu_id','=','det_ali_men.menu_id')
                ->join('alimentos','det_ali_men.alimento_id','=','alimentos.alimento_id')
                ->select('alimentos.*')
                ->where('det_pac_men.paciente_id', $paciente_id)
                ->where('alimentos.tipo','ColacionTarde1')
                ->where('det_pac_men.menu_id',$men->menu_id)
                ->get();
            $colaciontar2=DB::table('det_pac_men')
                ->join('det_ali_men','det_pac_men.menu_id','=','det_ali_men.menu_id')
                ->join('alimentos','det_ali_men.alimento_id','=','alimentos.alimento_id')
                ->select('alimentos.*')
                ->where('det_pac_men.paciente_id', $paciente_id)
                ->where('alimentos.tipo','ColacionTarde2')
                ->where('det_pac_men.menu_id',$men->menu_id)
                ->get();
            $colaciontar3=DB::table('det_pac_men')
                ->join('det_ali_men','det_pac_men.menu_id','=','det_ali_men.menu_id')
                ->join('alimentos','det_ali_men.alimento_id','=','alimentos.alimento_id')
                ->select('alimentos.*')
                ->where('det_pac_men.paciente_id', $paciente_id)
                ->where('alimentos.tipo','ColacionTarde3')
                ->where('det_pac_men.menu_id',$men->menu_id)
                ->get();
            $kcalcoltar1=0;
            foreach ($colaciontar1 as $col){
                $kcalcoltar1+=$col->kcal;
            }
            $detcolaciontar1=[
                "alimentos"=>$colaciontar1,
                "kcaltotal"=>$kcalcoltar1
            ];
            $kcalcoltar2=0;
            foreach ($colaciontar2 as $col){
                $kcalcoltar2+=$col->kcal;
            }
            $detcolaciontar2=[
                "alimentos"=>$colaciontar2,
                "kcaltotal"=>$kcalcoltar2
            ];
            $kcalcoltar3=0;
            foreach ($colaciontar3 as $col){
                $kcalcoltar3+=$col->kcal;
            }
            $detcolaciontar3=[
                "alimentos"=>$colaciontar3,
                "kcaltotal"=>$kcalcoltar3
            ];
            $colacionestar=[
                'colacion1'=>$detcolaciontar1,
                'colacion2'=>$detcolaciontar2,
                'colacion3'=>$detcolaciontar3,
            ];
            //cenas
            $cena1=DB::table('det_pac_men')
                ->join('det_ali_men','det_pac_men.menu_id','=','det_ali_men.menu_id')
                ->join('alimentos','det_ali_men.alimento_id','=','alimentos.alimento_id')
                ->select('alimentos.*')
                ->where('det_pac_men.paciente_id', $paciente_id)
                ->where('alimentos.tipo','Cena1')
                ->where('det_pac_men.menu_id',$men->menu_id)
                ->get();
            $cena2=DB::table('det_pac_men')
                ->join('det_ali_men','det_pac_men.menu_id','=','det_ali_men.menu_id')
                ->join('alimentos','det_ali_men.alimento_id','=','alimentos.alimento_id')
                ->select('alimentos.*')
                ->where('det_pac_men.paciente_id', $paciente_id)
                ->where('alimentos.tipo','Cena2')
                ->where('det_pac_men.menu_id',$men->menu_id)
                ->get();
            $cena3=DB::table('det_pac_men')
                ->join('det_ali_men','det_pac_men.menu_id','=','det_ali_men.menu_id')
                ->join('alimentos','det_ali_men.alimento_id','=','alimentos.alimento_id')
                ->select('alimentos.*')
                ->where('det_pac_men.paciente_id', $paciente_id)
                ->where('alimentos.tipo','Cena3')
                ->where('det_pac_men.menu_id',$men->menu_id)
                ->get();
            $kcalcen1=0;
            foreach ($cena1 as $cen){
                $kcalcen1+=$cen->kcal;
            }
            $detcena1=[
                "alimentos"=>$cena1,
                "kcaltotal"=>$kcalcen1
            ];
            $kcalcen2=0;
            foreach ($cena2 as $cen){
                $kcalcen2+=$cen->kcal;
            }
            $detcena2=[
                "alimentos"=>$cena2,
                "kcaltotal"=>$kcalcen2
            ];
            $kcalcen3=0;
            foreach ($cena3 as $cen){
                $kcalcen3+=$cen->kcal;
            }
            $detcena3=[
                "alimentos"=>$cena3,
                "kcaltotal"=>$kcalcen3
            ];
            $cenas=[
                'comida1'=>$detcena1,
                'comida2'=>$detcena2,
                'comida3'=>$detcena3,
            ];
            array_push($menu,[
                'menu_id'=>$men->menu_id,
                'desayunos'=>$desayunos,
                'colacionesman'=>$colacionesman,
                'comidas'=>$comidas,
                'colacionestar'=>$colacionestar,
                'cenas'=>$cenas
            ]);
        }



        $expediente = [
            'resultados' => $resultados,
            'circunferencias' => $circunferencias,
            'pliegues' => $pliegues,
            'menus' => $menu
        ];
        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'result' => $expediente
        ], 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Content-Type', 'application/json');
    }// getResultados
}
