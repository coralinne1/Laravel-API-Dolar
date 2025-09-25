<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\CotizacionDolar;
use Exception;

class ActualizarCotizacionesDolar extends Command
{
    protected $signature = 'dolar:actualizar';
    protected $description = 'Actualiza las cotizaciones del dólar desde la API';

    public function handle()
    {
        $url = config('services.dolarapi.url', 'https://dolarapi.com/v1/dolares');
        $tipos = ['official', 'blue', 'bolsa', 'turista'];

        foreach ($tipos as $tipo) {
            try {
                $response = Http::withoutVerifying()->get("{$url}/{$tipo}");

                if ($response->successful()) {
                    $data = $response->json();

                    CotizacionDolar::create([
                        'tipo' => $tipo,
                        'compra' => $data['compra'] ?? 0,
                        'venta' => $data['venta'] ?? 0,
                        'fecha' => now()->format('Y-m-d')
                    ]);

                    $this->info("Cotización {$tipo} actualizada: {$data['venta']}");
                }
            } catch (Exception $e) {
                $this->error("Error obteniendo {$tipo}: " . $e->getMessage());
            }
        }
    }
}