<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\ActualizarCotizacionesDolar; // 👈 AGREGAR ESTA LÍNEA

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ActualizarCotizacionesDolar::class, // 👈 AGREGAR ESTA LÍNEA
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        
        // 👇 AGREGAR ESTAS LÍNEAS
        $schedule->command('dolar:actualizar')
                 ->dailyAt('09:00') // Todos los días a las 9 AM
                 ->timezone('America/Argentina/Buenos_Aires');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}