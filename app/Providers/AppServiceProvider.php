<?php

namespace App\Providers;

use App\Repositories\AgendaRepository;
use App\Repositories\ConsultaRepository;
use App\Repositories\Contracts\AgendaInterface;
use App\Repositories\Contracts\ConsultaInterface;
use App\Repositories\Contracts\DiaSemanaInterface;
use App\Repositories\Contracts\EventoInterface;
use App\Repositories\Contracts\HorarioInterface;
use App\Repositories\DiaSemanaRepository;
use App\Repositories\EventoRepository;
use App\Repositories\HorarioRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(AgendaInterface::class, AgendaRepository::class);
        $this->app->bind(ConsultaInterface::class, ConsultaRepository::class);
        $this->app->bind(DiaSemanaInterface::class, DiaSemanaRepository::class);
        $this->app->bind(EventoInterface::class, EventoRepository::class);
        $this->app->bind(HorarioInterface::class, HorarioRepository::class);
    }
}
