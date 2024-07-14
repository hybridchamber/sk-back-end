<?php

namespace App\Http\Controllers;
use App\Models\Demographic;
use Illuminate\Http\Request;
use Termwind\Components\Raw;

class DemographicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getDemographic()
    {
        // Get all records from the demographic table
        $demographics = Demographic::all();
        return response()->json($demographics);
    }

    /**
     * Display the specified resource.
     */
    public function demographicID($id)
    {
        // Get a specific record from the demographic table
        $demographic = Demographic::find($id);
        if ($demographic) {
            return response()->json($demographic);
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }


    public function addDemographic (Request $request) 
    {
        $demographic = Demographic::create($request->all());
        return response($demographic,201);
        
    }

    public function updateDemographic(Request $request, $id)
    {
        $demographic = Demographic::find($id);
        if(is_null($demographic)) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $demographic->update($request->all());
        return response($demographic,200);
        
    }

    public function deleteDemographic($id)
     {
        $demographic = Demographic::find($id);
        if(is_null($demographic)) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $demographic->delete();
        return response()->json(null,204);
        
    }
}
