<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada kesalahan',
                'data' => $validator->errors()
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;

        return response()->json([
            'success' => true,
            'message' => 'Sukses register',
            'data' => $success
        ]);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            $success['name'] = $auth->name;
            $success['email'] = $auth->email;

            return response()->json([
                'success' => true,
                'message' => 'Login Sukses',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cek email dan password lagi',
                'data' => null
            ]);
        }
    }


    public function getCompany()
    {
        $companies = Company::all();

        return response()->json([
            'success' => true,
            'message' => 'Data Company sukses ditampilkan',
            'data' => $companies
        ]);
    }

    public function getEmployee()
    {
        $employees = Employee::with('company:id,name')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data Employee sukses ditampilkan',
            'data' => $employees->map->only(['id', 'first_name', 'last_name', 'email', 'phone', 'company_name', 'created_at', 'updated_at'])
        ]);
    }

    public function storeCompany(CompanyRequest $request)
    {
        $company = Company::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Company berhasil dibuat',
            'data' => $company
        ]);
    }

    public function showCompany($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Company berhasil ditampilkan',
            'data' => $company
        ]);
    }

    public function updateCompany(CompanyRequest $request, $id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company tidak ditemukan',
                'data' => null
            ], 404);
        }

        $company->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Company berhasil diupdate',
            'data' => $company
        ]);
    }

    public function destroyCompany($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company tidak ditemukan',
                'data' => null
            ], 404);
        }

        $company->delete();

        return response()->json([
            'success' => true,
            'message' => 'Company berhasil dihapus',
            'data' => null
        ]);
    }

    public function createEmployee(EmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Employee berhasil dibuat',
            'data' => $employee
        ]);
    }

    public function showEmployee($id)
    {
        $employee = Employee::with('company:id,name')->find($id);

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => 'Employee tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Employee berhasil ditampilkan',
            'data' => $employee->only(['id', 'first_name', 'last_name', 'email', 'phone', 'company_name', 'created_at', 'updated_at'])
        ]);
    }

    public function updateEmployee(EmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => 'Employee tidak ditemukan',
                'data' => null
            ], 404);
        }

        $employee->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Employee berhasil diupdate',
            'data' => $employee
        ]);
    }

    public function destroyEmployee($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => 'Employee tidak ditemukan',
                'data' => null
            ], 404);
        }

        $employee->delete();

        return response()->json([
            'success' => true,
            'message' => 'Employee berhasil dihapus',
            'data' => null
        ]);
    }
}
