<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\Entity;
use Exception;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function index()
    {
        return view("personnel.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("personnel.add" , ['entity' => Entity::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Personnel::create(
                [
                    "nom" => $request->nom,
                    "prenom" => $request->prenom,
                    "matricule" => $request->matricule,
                    "entity" => $request->entity,
                ]
            );

            return redirect()->route("personnel.index")
                ->with("success", "Vous avez ajouté une nouvelle personnel");
                
        } catch (Exception $error) {
            return redirect()->route("personnel.create")
                ->with("danger", "" . $error->getMessage());
        }
    }
    public function show($id) {
        
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("personnel.edit" , [
            'personnel' => Personnel::find($id) , 
            'entity' => Entity::all() ,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->check == false)
            return redirect()->route("personnel.edit", ['personnel' => $id])
                ->with("danger", "Vous devez confirmer avant de mettre à jour les champs");
        try {
            Personnel::find($id)->update(
            [
                    "nom" => $request->nom,
                    "prenom" => $request->prenom,
                    "matricule" => $request->matricule,
                    "entity" => $request->entity,
                ]
            );

            return redirect()
                ->route("personnel.index")
                ->with("success", "Vous avez modifié la ligne #$id");

        } catch (Exception $error) {
            return redirect()
                ->route("personnel.edit", ['personnel' => $id])
                ->with("danger", "" . $error->getMessage());
        }
    }
}
