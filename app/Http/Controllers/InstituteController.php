<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use Illuminate\Http\Request;

class InstituteController extends Controller
{
    public function index() {
        return view('backend.institutes.index');
    }

    public function apiIndex()
    {
        
        return response()->json(Institute::all(), 200);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'InstShort' => 'required|string|max:15|unique:institutes,InstShort',
            'InstLong'  => 'nullable|string|max:60',
            'InstPlace' => 'nullable|string|max:20',
        ]);

        $institute = Institute::create($validated);

        return response()->json($institute, 201);
    }

    public function apiShow($id)
    {
        $institute = Institute::findOrFail($id);
        return response()->json($institute);
    }

    public function apiUpdate(Request $request, $id)
    {
        $institute = Institute::findOrFail($id);

        $validated = $request->validate([
            'InstLong'  => 'nullable|string|max:60',
            'InstPlace' => 'nullable|string|max:20',
        ]);

        $institute->update($validated);

        return response()->json($institute);
    }

    public function apiDestroy($id)
    {
        $institute = Institute::findOrFail($id);
        $institute->delete();

        return response()->json(['message' => 'Institute deleted successfully.']);
    }
}
