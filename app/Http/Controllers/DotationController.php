<?php

namespace App\Http\Controllers;

use App\Models\Dotation;
use App\Models\Puce;
use Exception;
use Illuminate\Http\Request;

class DotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dotation.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dotation.add" , ["puce" => Puce::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Dotation::create(["type" => $request->type,"puce" => $request->telephone,"is_active" => true,]);
            return redirect()
                ->route("dotation.index")
                ->with("success", "Vous avez ajouté une nouvelle dotation");
                
        } catch (Exception $error) {
            return redirect()
                ->route("dotation.create")
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
        $puce = Puce::all()->where("is_active" , "=" , "1");
        return view("dotation.edit" , 
            [
                'puce' => $puce ,
                'dotation' => Dotation::find($id)
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->check == false)
            return redirect()
                ->route("dotation.edit", ['dotation' => $id])
                ->with("danger", "Vous devez confirmer avant de mettre à jour les champs");

        try {
            Dotation::find($id)->update([
                "type" => $request->type,
                "puce" => $request->telephone,
                "is_active" => $request->is_active,
            ]);
            return redirect()
                ->route("dotation.index")
                ->with("success", "Vous avez modifié la ligne #$id");
        } catch (Exception $error) {
            return redirect()
                ->route("dotation.edit", ['dotation' => $id])
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
