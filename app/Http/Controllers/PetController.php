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
        return view('pet_form');
    }

    public function storePet(Request $request)
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'status' => 'required|in:available,pending,sold',
        ], [
            'name.required'   => 'Pole "Imię" jest wymagane.',
            'name.max'        => 'Imię może mieć maksymalnie :max znaków.',
            'status.required' => 'Wybierz proszę status.',
            'status.in'       => 'Nieprawidłowy status. Wybierz z listy.',
        ]);

        $addPet = Http::post("{$this->baseUrl}/pet", $data);

        if (!$addPet->ok()) {
            return redirect()->route('pet.form')->with('error', 'Nie udało się dodać zwierzaka. Spróbuj ponownie.');
        }
        return redirect()->route('dashboard')->with('success', 'Zwierzak ' . $data['name'] . ' dodany pomyślnie');
    }

    public function updatePetForm($id)
    {
        $response = Http::get("{$this->baseUrl}/pet/{$id}");
        if (!$response->ok()) {
            return redirect()->route('dashboard')->with('error', 'Zwierzak o ID: ' . $id . ' już nie istnieje.');
        }
        $pet = $response->json();

        return view('pet_update', compact('pet'));
    }

    public function updatePet(Request $request, $id)
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'status' => 'required|in:available,pending,sold',
        ], [
            'name.required'   => 'Pole "Imię" jest wymagane.',
            'name.max'        => 'Imię może mieć maksymalnie :max znaków.',
            'status.required' => 'Wybierz proszę status.',
            'status.in'       => 'Nieprawidłowy status. Wybierz z listy.',
        ]);

        $updatePet = Http::asForm()->post("{$this->baseUrl}/pet/{$id}", $data);

        if (! $updatePet->successful()) {
            return redirect()->route('pet.edit', $id)->with('error', 'Nie udało się zaktualizować zwierzaka. Spróbuj ponownie.');
        }
        return redirect()->route('dashboard')->with('success', 'Zwierzak ' . ($data['name'] ?? '') . ' zaktualizowany pomyślnie.');
    }

    public function destroyPet($id)
    {
        $response = Http::delete("{$this->baseUrl}/pet/{$id}");
        return redirect()->route('dashboard')->with('success', 'Zwierzak z ID:' . $id . ' usunięty pomyślnie.');
    }
}
