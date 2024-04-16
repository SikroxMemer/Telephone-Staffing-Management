<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use App\Models\Personnel;
use App\Models\Puce;
use Exception;
use Illuminate\Http\Request;

class AffectationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("affectation.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $puces = Puce::all();
        $personnels = Personnel::all();
        return view("affectation.add", [
            "puceList" => $puces,
            "personnelList" => $personnels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Affectation::create([
                "puce" => $request->puce,
                "personnel" => $request->personnel,
                "observation" => $request->observation,
                "date_affectation" => $request->date_affectation
            ]);
            return redirect()
                ->route("affectation.index")
                ->with("success", "Vous avez ajouté une nouvelle affectation");
                
        } catch (Exception $error) {
            return redirect()
                ->route("affectation.create")
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
    public function edit(int $id)
    {
        $puces = Puce::all();
        $personnels = Personnel::all();
        $affectation = Affectation::find($id);
        return view("affectation.edit", [
            "affectation" => $affectation,
            "puceList" => $puces,
            "personnelList" => $personnels
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        if ($request->check == false)
            return redirect()
                ->route("affectation.edit", ['affectation' => $id])
                ->with("danger", "Vous devez confirmer avant de mettre à jour les champs");

        try {
            Affectation::find($id)->update([
                "puce" => $request->puce,
                "personnel" => $request->personnel,
                "observation" => $request->observation,
                "date_affectation" => $request->date_affectation
            ]);
            return redirect()
                ->route("affectation.index")
                ->with("success", "Vous avez modifié la ligne #$id");
        } catch (Exception $error) {
            return redirect()
                ->route("affectation.edit", ['affectation' => $id])
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
