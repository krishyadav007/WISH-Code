@extends('layouts.app')

@section('content')
<section class="wrapper bg-light py-14 py-md-16">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-white">
                        <h4 class="mb-0">Edit Intervention</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('i.update', $intervention->id) }}">
                            @csrf
                            @method('PUT')
                            
                            <!-- Type -->
                            <div class="form-group mb-4">
                                <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type', $intervention->type) }}" required>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Content -->
                            <div class="form-group mb-4">
                                <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content', $intervention->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Strength -->
                            <div class="form-group mb-4">
                                <label for="strength" class="form-label">Strength <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('strength') is-invalid @enderror" id="strength" name="strength" value="{{ old('strength', $intervention->strength) }}" required>
                                @error('strength')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Update Intervention</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
