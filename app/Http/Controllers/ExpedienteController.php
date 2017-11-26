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
        $expediente = [
            'resultados' => $resultados,
            'circunferencias' => $circunferencias,
            'pliegues' => $pliegues
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
