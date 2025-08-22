
@extends('layouts.app')

@section('title', 'Document Item')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="mb-0">Document New Item</h4>
                    <small class="text-muted">Appointment: {{ $appointment->home->address }}</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('officer.items.store', $appointment) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">Item Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="category">Category *</label>
                                    <select class="form-control @error('category') is-invalid @enderror" name="category" required>
                                        <option value="">Select category...</option>
                                        <option value="electronics" {{ old('category') == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                        <option value="jewelry" {{ old('category') == 'jewelry' ? 'selected' : '' }}>Jewelry</option>
                                        <option value="furniture" {{ old('category') == 'furniture' ? 'selected' : '' }}>Furniture</option>
                                        <option value="appliances" {{ old('category') == 'appliances' ? 'selected' : '' }}>Appliances</option>
                                        <option value="collectibles" {{ old('category') == 'collectibles' ? 'selected' : '' }}>Collectibles</option>
                                        <option value="documents" {{ old('category') == 'documents' ? 'selected' : '' }}>Important Documents</option>
                                        <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" placeholder="Detailed description of the item...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="estimated_value">Estimated Value ($)</label>
                            <input type="number" step="0.01" min="0" class="form-control @error('estimated_value') is-invalid @enderror" name="estimated_value" value="{{ old('estimated_value') }}">
                            @error('estimated_value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="photos">Photos</label>
                            <input type="file" class="form-control @error('photos.*') is-invalid @enderror" name="photos[]" multiple accept="image/*">
                            <small class="form-text text-muted">You can upload multiple photos. Max 5MB per file.</small>
                            @error('photos.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('officer.appointments.document', $appointment) }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Save Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
