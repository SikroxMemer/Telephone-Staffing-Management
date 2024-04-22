<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("utilisateur.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("utilisateur.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            User::create([
                "nom" => $request->nom,
                "prenom" => $request->prenom,

                "username" => $request->username,
                "password" => Hash::make($request->password),

                "email" => $request->email,
                "type" => $request->type,
            ]);

            return redirect()
                ->route("utilisateur.index")
                ->with("success", "Vous avez ajouté une nouvelle utilisateur");
                
        } catch (Exception $error) {
            return redirect()
                ->route("utilisateur.create")
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
        return view("utilisateur.edit" , ['utilisateur' => User::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if ($request->check == false)
            return redirect()
                ->route("utilisateur.edit", ['utilisateur' => User::find($id)])
                ->with("danger", "Vous devez confirmer avant de mettre à jour les champs");

        try {

            User::find($id)->update([
                "nom" => $request->nom,
                "prenom" => $request->prenom,

                "username" => $request->username,
                "password" => Hash::make($request->password),

                "email" => $request->email,
                "type" => $request->type,
            ]);

            return redirect()
                ->route("utilisateur.index")
                ->with("success", "Vous avez modifié la ligne #$id");
                
        } catch (Exception $error) {
            return redirect()
                ->route("utilisateur.create")
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
