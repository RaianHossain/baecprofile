<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index() 
    {
        return view('backend.designations.index');
    }

    // GET /api/designations
    public function apiIndex()
    {
        return response()->json(Designation::all(), 200);
    }

    // GET /api/designations/{id}
    public function apiShow($id)
    {
        $designation = Designation::find($id);

        if (!$designation) {
            return response()->json(['message' => 'Designation not found.'], 404);
        }

        return response()->json($designation, 200);
    }

    // POST /api/designations
    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'DesigShort' => 'required|string|max:30|unique:designations,DesigShort',
            'DesigLong' => 'nullable|string|max:50',
            'DesigWeight' => 'nullable|numeric|min:0|max:9999.99',
        ]);

        $designation = Designation::create($validated);

        return response()->json($designation, 201);
    }

    // PUT /api/designations/{id}
    public function apiUpdate(Request $request, $id)
    {
        $designation = Designation::find($id);

        if (!$designation) {
            return response()->json(['message' => 'Designation not found.'], 404);
        }

        $validated = $request->validate([
            'DesigLong' => 'nullable|string|max:50',
            'DesigWeight' => 'nullable|numeric|min:0|max:9999.99',
        ]);

        $designation->update($validated);

        return response()->json($designation, 200);
    }

    // DELETE /api/designations/{id}
    public function apiDestroy($id)
    {
        $designation = Designation::find($id);

        if (!$designation) {
            return response()->json(['message' => 'Designation not found.'], 404);
        }

        $designation->delete();

        return response()->json(['message' => 'Designation deleted successfully.'], 200);
    }
}
