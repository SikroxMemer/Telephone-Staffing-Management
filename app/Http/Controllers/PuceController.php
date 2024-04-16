<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Puce;

class PuceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("puce.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("puce.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Puce::create([
                "type" => $request->type,
                "fourniseur" => $request->fourniseur,
                "telephone" => $request->telephone,
                "is_active" => $request->is_active
            ]);
            return redirect()
                ->route("puce.index")
                ->with("success", "Vous avez ajouté une nouvelle puce");
                
        } catch (Exception $error) {
            return redirect()
                ->route("puce.create")
                ->with("danger", "" . $error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("puce.edit" , ['puce' => Puce::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->check == false)
            return redirect()
                ->route("puce.edit", ['puce' => $id])
                ->with("danger", "Vous devez confirmer avant de mettre à jour les champs");

        try {
            Puce::find($id)->update([
                "type" => $request->type,
                "fourniseur" => $request->fourniseur,
                "telephone" => $request->telephone,
                "is_active" => $request->is_active
            ]);
            return redirect()
                ->route("puce.index")
                ->with("success", "Vous avez modifié la ligne #$id");
        } catch (Exception $error) {
            return redirect()
                ->route("puce.edit", ['puce' => $id])
                ->with("danger", "" . $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
