<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     // Método que se llama cuando accedes a /admin
    public function index()
    {
        return view('admin.dashboard'); // ✔ correcto
    }
}
