<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $limit = min($request->query('limit', 16), 256);

        $employees = Employee::paginate($limit, ['*'], 'page', $page);

        return response($employees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'user_id' => 'required|exists:users,id',
            'joining_date' => 'required|date',
            'role' => 'required|string|in:admin,manager,employee'
        ]);

        return response(Employee::create($fields), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);

        if ($employee === null) {
            return response([
                'message' => 'Employee not found.'
            ], 404);
        }

        return response($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            'user_id' => 'exists:users,id',
            'joining_date' => 'date',
            'role' => 'string|in:admin,manager,employee'
        ]);

        $employee = Employee::find($id);

        if ($employee === null) {
            return response([
                'message' => 'Employee not found.'
            ], 404);
        }

        $employee->update($fields);

        return response($employee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
