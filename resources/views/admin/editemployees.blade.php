@extends('layouts.admin')
@section('main')
    <div>
        <h2>Edit Employee</h2>
        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name"
                    value="{{ old('first_name', $employee->first_name) }}" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name"
                    value="{{ old('last_name', $employee->last_name) }}" required>
            </div>
            <div class="mb-3">
                <label for="company_id" class="form-label">Company</label>
                <select class="form-select" id="company_id" name="company_id" required>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}"
                            {{ old('company_id', $employee->company_id) == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $employee->email) }}">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    value="{{ old('phone', $employee->phone) }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Employee</button>
        </form>
    </div>
@endsection
