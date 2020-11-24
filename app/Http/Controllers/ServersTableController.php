<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia;
use App\Models\Server;

class ServersTableController extends Controller
{

    public function index(){
        return Server::all();
    }
}
