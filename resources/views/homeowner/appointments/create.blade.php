
@extends('layouts.app')

@section('title', 'Schedule Security Audit')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="mb-0">Schedule Your Security Audit</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('homeowner.appointments.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="home_id">Select Property</label>
                                    <select class="form-control @error('home_id') is-invalid @enderror" name="home_id" required>
                                        <option value="">Choose a property...</option>
                                        @foreach($homes as $home)
                                            <option value="{{ $home->id }}" {{ old('home_id') == $home->id ? 'selected' : '' }}>
                                                {{ $home->address }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('home_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="scheduled_date">Preferred Date</label>
                                    <select class="form-control @error('scheduled_date') is-invalid @enderror" name="scheduled_date" required>
                                        <option value="">Select date...</option>
                                        @foreach($availableDates as $date)
                                            <option value="{{ $date->format('Y-m-d') }}" {{ old('scheduled_date') == $date->format('Y-m-d') ? 'selected' : '' }}>
                                                {{ $date->format('l, M d, Y') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('scheduled_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="scheduled_time">Preferred Time</label>
                                    <select class="form-control @error('scheduled_time') is-invalid @enderror" name="scheduled_time" required>
                                        <option value="">Select time...</option>
                                        <option value="09:00" {{ old('scheduled_time') == '09:00' ? 'selected' : '' }}>9:00 AM</option>
                                        <option value="11:00" {{ old('scheduled_time') == '11:00' ? 'selected' : '' }}>11:00 AM</option>
                                        <option value="13:00" {{ old('scheduled_time') == '13:00' ? 'selected' : '' }}>1:00 PM</option>
                                        <option value="15:00" {{ old('scheduled_time') == '15:00' ? 'selected' : '' }}>3:00 PM</option>
                                        <option value="17:00" {{ old('scheduled_time') == '17:00' ? 'selected' : '' }}>5:00 PM</option>
                                    </select>
                                    @error('scheduled_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="notes">Special Instructions (Optional)</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" rows="3" placeholder="Any special access instructions, gate codes, or specific areas of concern...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('homeowner.appointments.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Schedule Appointment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
