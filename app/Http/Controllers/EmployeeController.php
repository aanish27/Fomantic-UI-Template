<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('dashboard.employee');
    }

    public function draw(Request $request)
    {
        $search = $request->query('search')['value'];
        $draw = $request->query('draw', 1);
        $start = $request->query('start', 0);
        $length = $request->query('length', 10);
        $employeeQuery = Employee::query();
        $totalEmployees = $employeeQuery->count();

        $employeeQuery->where('name', 'like', "%" . $search . "%")
            ->orWhere('position', 'like', "%" . $search . "%")
            ->orWhere('email', 'like', "%" . $search . "%")
            ->orWhere('address', 'like', "%" . $search . "%")
            ->orWhere('dob', 'like', "%" . $search . "%")
            ->orWhere('phone', 'like', "%" . $search . "%");

        if ($order = $request->query('order')[0] ?? null) {
            $orderDir = $order['dir'] ?? 'asc';
            $employeeQuery->orderBy($mapping[$order['name']] ?? $order['name'], $orderDir);
        }

        $filteredEmployees = $search ? $employeeQuery->count() : $totalEmployees;
        $employees = $employeeQuery->skip($start)
            ->take($length)
            ->get();

        return Response::json([
            'draw' => intval($draw),
            'recordsTotal' => intval($totalEmployees),
            'recordsFiltered' => $filteredEmployees,
            'data' => $employees
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         try {
            $employeeValidated = $request->validate([
                'name' => 'required|max:50|',
                'position' => 'required|max:50|',
                'dob' => 'required|date',
                'email' => 'required|unique:employees|email',
                'phone' => 'required|max:13',
                'address' => 'required|max:255',
            ]);
            $employee = Employee::create($employeeValidated);
            return Response::json('New Employee '. $employee->name . ' Added');
        } catch (ValidationException $e) {
            return Response::json($e->errors(), 422);
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
        $employee = Employee::where('id',$id)->get();
        return Response::json($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $employeeValidated = $request->validate([
                'name' => 'required|max:50',
                'position' => 'required|max:50',
                'dob' => 'required|date',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('employees', 'email')->ignore($id),
                ],
                'phone' => 'required|max:13',
                'address' => 'required|max:255',
            ]);

            Employee::find($id)->update( $employeeValidated);
            return Response::json('Employee '  . $employeeValidated['name'] . ' Details Updated');
        } catch (ValidationException $e) {
            return Response::json($e->errors(), 422);
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
