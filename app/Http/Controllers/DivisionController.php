<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        return view('backend.divisions.index');
    }


    // GET /api/divisions
    public function apiIndex()
    {
        return response()->json(
            Division::with('institute')->get(),
            200
        );
    }

    // GET /api/divisions/{id}
    public function apiShow($id)
    {
        $division = Division::with('institute')->find($id);

        if (!$division) {
            return response()->json(['message' => 'Division not found.'], 404);
        }

        return response()->json($division, 200);
    }

    // POST /api/divisions
    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'DivShort' => 'required|string|max:7|unique:divisions,DivShort',
            'DivLong' => 'nullable|string|max:55',
            'InstShort' => 'nullable|string|exists:institutes,InstShort',
        ]);

        $division = Division::create($validated);

        return response()->json($division, 201);
    }

    // PUT /api/divisions/{id}
    public function apiUpdate(Request $request, $id)
    {
        $division = Division::find($id);

        if (!$division) {
            return response()->json(['message' => 'Division not found.'], 404);
        }

        $validated = $request->validate([
            'DivLong' => 'nullable|string|max:55',
            'InstShort' => 'nullable|string|exists:institutes,InstShort',
        ]);

        $division->update($validated);

        return response()->json($division, 200);
    }

    // DELETE /api/divisions/{id}
    public function apiDestroy($id)
    {
        $division = Division::find($id);

        if (!$division) {
            return response()->json(['message' => 'Division not found.'], 404);
        }

        $division->delete();

        return response()->json(['message' => 'Division deleted successfully.'], 200);
    }

}
