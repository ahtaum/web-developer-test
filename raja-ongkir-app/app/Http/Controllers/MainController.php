<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MainController extends Controller
{
    public function index() {
        return Inertia::render("Main");
    }

    public function cekOngkir(Request $request) {
        $request->validate([
            'destination' => 'required',
        ]);

        $destination = $request->input('destination');
        
        $response = Http::withHeaders([
            'key' => 'ea2e3cd4f01033afef7118669f77ff02',
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => '501',
            'destination' => $destination,
            'weight' => 1000,
            'courier' => 'jne',
        ]);

        $data = $response->json();
        $results = $data['rajaongkir']['results'];

        return Inertia::render('Main', compact('results'));
    }
}
