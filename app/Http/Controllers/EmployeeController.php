<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        // Check if the request is an AJAX request from DataTables
        if ($request->ajax()) {
            return DataTables::of(Employee::with('company')->get())
                ->addColumn('action', function ($employee) {
                    return '<a href="' . route('employees.edit', $employee->id) . '" class="btn btn-warning" style="margin-right: 5px;">Edit</a>' .
                        '<form action="' . route('employees.destroy', $employee->id) . '" method="POST" class="d-inline">' .
                        csrf_field() .
                        '<input type="hidden" name="_method" value="DELETE">' .
                        '<button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>' .
                        '</form>';
                })
                ->make(true);
        }

        // If it's not an AJAX request, fetch the employees and render the Blade view
        $employees = Employee::with('company')->get();
        return view('admin.employees', compact('employees'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('admin.createemployees', compact('companies'));
    }
    public function store(EmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show($id)
    {
        //
    }
    
    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('admin.editemployees', compact('employee', 'companies'));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
