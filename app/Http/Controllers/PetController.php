<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    protected $baseUrl = 'https://petstore.swagger.io/v2';

    public function dashboard(Request $request)
    {
        // fetch pets by status
        $status = $request->get('status', 'available,pending,sold');
        $response = Http::get("{$this->baseUrl}/pet/findByStatus", [
            'status' => $status
        ]);

        $pets = $response->ok() ? $response->json() : [];
        return view('dashboard', compact('pets', 'status'));
    }

    public function createPet()
    {
        return view('pet.form');
    }

    public function storePet(Request $request)
    {
        $data = $request->validate([
            'id'     => 'required|integer',
            'name'   => 'required|string',
            'status' => 'required|in:available,pending,sold',
        ]);

        Http::post("{$this->baseUrl}/pet", $data);

        return redirect()->route('pet.store')->with('success', 'Pet added');
    }

    public function updatePetForm($id)
    {
        $response = Http::get("{$this->baseUrl}/pet/{$id}");
        $pet = $response->json();

        return view('pet.update', compact('pet'));
    }

    public function updatePet(Request $request, $id)
    {
        $data = $request->validate([
            'id'     => 'required|integer',
            'name'   => 'required|string',
            'status' => 'required|in:available,pending,sold',
        ]);

        Http::put("{$this->baseUrl}/pet", $data);
        return redirect()->route('dashboard')->with('success', 'Pet updated');
    }

    public function destroyPet($id)
    {
        Http::delete("{$this->baseUrl}/pet/{$id}");
        return redirect()->route('dashboard')->with('success', 'Pet deleted');
    }
}
