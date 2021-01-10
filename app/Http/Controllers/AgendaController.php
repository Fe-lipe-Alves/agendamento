<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\AgendaInterface;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    protected $repository;

    public function __construct(AgendaInterface $agenda)
    {
        $this->repository = $agenda;
    }

    public function informacoesDia(Request $request)
    {

    }
}
