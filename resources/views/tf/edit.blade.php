@extends('layouts.app')

@section('content')
<section class="wrapper bg-light py-14 py-md-16">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Teacher Feedback</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('tf-feedback.update', $feedback->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="student_email" class="form-label">Student Email</label>
                                <input type="email" class="form-control" id="student_email" name="student_email" value="{{ old('student_email', $feedback->student_email) }}" required>
                                @error('student_email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="interest" class="form-label">Interest</label>
                                <input type="number" class="form-control" id="interest" name="interest" value="{{ old('interest', $feedback->interest) }}" required>
                                @error('interest')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="4">{{ old('message', $feedback->message) }}</textarea>
                                @error('message')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
