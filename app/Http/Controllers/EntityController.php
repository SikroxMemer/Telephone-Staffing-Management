<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Exception;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("entity.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("entity.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Entity::create(
                [
                    'nom' => $request->nom
                ]
            );
            return redirect()->route('entity.index')->with('success', 'Vous avez ajouté une nouvelle entité');

        } catch (Exception $error) {

            return redirect()->route('entity.create')->with('error', '' . $error->getMessage());

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
        return view("entity.edit" , ['entity' => Entity::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if ($request->check == false) {
            return redirect()->route("entity.edit", ['entity' => $id])
                ->with("danger", "Vous devez confirmer avant de mettre à jour les champs");
        }

        try {
            Entity::find($id)->update(
                [
                    'nom' => $request->nom
                ]
            );
            return redirect()->route('entity.index')->with('success', 'Vous avez modifié la ligne #$id');

        } catch (Exception $error) {

            return redirect()->route('entity.create' , ['entity' => $id])->with('error', '' . $error->getMessage());
            
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
