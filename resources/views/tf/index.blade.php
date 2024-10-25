@extends('layouts.app')

@section('content')
<section class="wrapper bg-light py-14 py-md-16">
    <div class="container">
        <h1 class="mb-4">Teacher Feedback</h1>
        <a href="{{ route('tf.create') }}" class="btn btn-primary mb-3">Add Feedback</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Student Email</th>
                    <th>Interest</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->student_email }}</td>
                        <td>{{ $feedback->interest }}</td>
                        <td>{{ $feedback->message }}</td>
                        <td>
                            <a href="{{ route('tf.edit', $feedback->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('tf.destroy', $feedback->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this feedback?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection