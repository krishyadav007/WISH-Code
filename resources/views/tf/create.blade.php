@extends('layouts.app')

@section('content')
<section class="wrapper bg-light py-14 py-md-16">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Teacher Feedback</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('tf.store') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="student_email" class="form-label">Student Email</label>
                                <input type="email" class="form-control" id="student_email" name="student_email" required>
                                @error('student_email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="interest" class="form-label">Interest</label>
                                <input type="number" class="form-control" id="interest" name="interest" required>
                                @error('interest')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                                @error('message')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
