<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('admin.home', compact('companies'));
    }

    public function create()
    {
        return view('admin.createcompanies');
    }
    public function store(CompanyRequest $request)
    {
        $company = Company::create($request->validated());
        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }


    public function show($id)
    {
        //
    }


    public function edit(Company $company)
    {
        return view('admin.editcompanies', compact('company'));
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());
        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
