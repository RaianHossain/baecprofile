<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index() {
        return view('backend.employees.index');
    }

    public function apiIndex()
    {
        // Include related models (eager load)
        $employees = Employee::with(['designation', 'institute', 'division', 'user'])->get();
        return response()->json($employees, 200);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'EmpID'                 => 'nullable|string|max:5',
            'EmpTitle'              => 'nullable|string|max:5',
            'EmpFname'              => 'nullable|string|max:30',
            'EmpLname'              => 'nullable|string|max:15',
            'EmpShortDegree'        => 'nullable|string',
            'EmpRank'               => 'nullable|numeric|between:0,999.999',
            'EmpPhone'              => 'nullable|string|max:15',
            'EmpEmail'              => 'nullable|email|max:40',
            'EmpStatus'             => 'nullable|string',
            'EmpSpecialAssignment'  => 'nullable|string',
            'JoiningDate'           => 'nullable|date',
            'BatchMerit'            => 'nullable|string|max:50',
            'DivShort'              => 'nullable|string|exists:divisions,DivShort',
            'InstShort'             => 'nullable|string|exists:institutes,InstShort',
            'DesigShort'            => 'nullable|string|exists:designations,DesigShort',
            'user_id'               => 'nullable|exists:users,id',
        ]);

        $employee = Employee::create($validated);

        return response()->json($employee, 201);
    }

    public function apiShow($id)
    {
        $employee = Employee::with(['designation', 'institute', 'division', 'user'])->findOrFail($id);
        return response()->json($employee, 200);
    }

    public function apiUpdate(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'EmpID'                 => 'nullable|string|max:5',
            'EmpTitle'              => 'nullable|string|max:5',
            'EmpFname'              => 'nullable|string|max:30',
            'EmpLname'              => 'nullable|string|max:15',
            'EmpShortDegree'        => 'nullable|string',
            'EmpRank'               => 'nullable|numeric|between:0,999.999',
            'EmpPhone'              => 'nullable|string|max:15',
            'EmpEmail'              => 'nullable|email|max:40',
            'EmpStatus'             => 'nullable|string',
            'EmpSpecialAssignment'  => 'nullable|string',
            'JoiningDate'           => 'nullable|date',
            'BatchMerit'            => 'nullable|string|max:50',
            'DivShort'              => 'nullable|string|exists:divisions,DivShort',
            'InstShort'             => 'nullable|string|exists:institutes,InstShort',
            'DesigShort'            => 'nullable|string|exists:designations,DesigShort',
            'user_id'               => 'nullable|exists:users,id',
        ]);

        $employee->update($validated);

        return response()->json($employee, 200);
    }

    public function apiDestroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully.'], 200);
    }
}
