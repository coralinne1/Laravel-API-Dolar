<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CotizacionDolar extends Model
{
    protected $fillable = [
        'tipo',
        'compra', 
        'venta',
        'fecha'
    ];

    protected $casts = [
        'compra' => 'decimal:2',
        'venta' => 'decimal:2',
        'fecha' => 'date'
    ];

    // Scope para filtrar por tipo
    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    // Scope para filtrar por mes y año
    public function scopePorMes($query, $mes, $año)
    {
        return $query->whereMonth('fecha', $mes)
                    ->whereYear('fecha', $año);
    }

    // Método para calcular promedio mensual (FALTABA ESTE MÉTODO)
    public static function promedioMensual($tipo, $campo, $mes, $año)
    {
        return self::porTipo($tipo)
                    ->porMes($mes, $año)
                    ->avg($campo);
    }
}