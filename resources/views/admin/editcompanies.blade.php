@extends('layouts.admin')
@section('main')
<div>
    <h2>Edit Company</h2>
    <form action="{{ route('companies.update', $company->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $company->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $company->address) }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $company->email) }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Company</button>
    </form>
</div>
@endsection