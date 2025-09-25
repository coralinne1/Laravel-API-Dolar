<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CotizacionDolar;

class PromedioDolarController extends Controller
{
    public function promedioMensual(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|in:official,blue,bolsa,turista',
            'campo' => 'required|string|in:compra,venta',
            'mes' => 'required|integer|between:1,12',
            'año' => 'required|integer|min:2020'
        ]);

        $promedio = CotizacionDolar::promedioMensual(
            $request->tipo,
            $request->campo,
            $request->mes,
            $request->año
        );

        return response()->json([
            'tipo' => $request->tipo,
            'campo' => $request->campo,
            'mes' => $request->mes,
            'año' => $request->año,
            'promedio' => round($promedio, 2),
            'moneda' => 'ARS'
        ]);
    }

    public function historico(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|in:official,blue,bolsa,turista',
            'campo' => 'required|string|in:compra,venta',
            'limite' => 'sometimes|integer|min:1|max:100'
        ]);

        $cotizaciones = CotizacionDolar::where('tipo', $request->tipo)
            ->orderBy('fecha', 'desc')
            ->limit($request->limite ?? 30)
            ->get(['fecha', $request->campo]);

        return response()->json($cotizaciones);
    }
}