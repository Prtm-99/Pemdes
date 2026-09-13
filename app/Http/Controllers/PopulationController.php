<?php

namespace App\Http\Controllers;

use App\Population;
use Illuminate\Http\Request;

class PopulationController extends Controller
{
    public function index()
    {
        $populations = Population::all();
        return view('populations.index', compact('populations'));
    }

    public function create()
    {
        return view('populations.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'male' => 'required|integer',
            'female' => 'required|integer',
            'deaths' => 'required|integer',
            'births' => 'required|integer',
            'islam' => 'required|integer',
            'christian' => 'required|integer',
            'catholic' => 'required|integer',
            'hindu' => 'required|integer',
            'buddha' => 'required|integer',
            'confucianism' => 'required|integer',
            'employed' => 'required|integer',
            'unemployed' => 'required|integer',
            'housewife' => 'required|integer',
            'student' => 'required|integer',
            'migration_in' => 'required|integer',
            'migration_out' => 'required|integer'
        ]);

        Population::create($validatedData);
        
        return redirect()->route('populations.index')->with('success', 'Data penduduk berhasil ditambahkan');
    }

    public function show(Population $population)
    {
        return view('populations.show', compact('population'));
    }

    public function edit(Population $population)
    {
        return view('populations.edit', compact('population'));
    }

    public function update(Request $request, Population $population)
    {
        $validatedData = $request->validate([
            'male' => 'required|integer',
            'female' => 'required|integer',
            'deaths' => 'required|integer',
            'births' => 'required|integer',
            'islam' => 'required|integer',
            'christian' => 'required|integer',
            'catholic' => 'required|integer',
            'hindu' => 'required|integer',
            'buddha' => 'required|integer',
            'confucianism' => 'required|integer',
            'employed' => 'required|integer',
            'unemployed' => 'required|integer',
            'housewife' => 'required|integer',
            'student' => 'required|integer',
            'migration_in' => 'required|integer',
            'migration_out' => 'required|integer'
        ]);

        $population->update($validatedData);
        
        return redirect()->route('populations.index')->with('success', 'Data penduduk berhasil diperbarui');
    }

    public function destroy(Population $population)
    {
        $population->delete();
        return redirect()->route('populations.index')->with('success', 'Data penduduk berhasil dihapus');
    }
}