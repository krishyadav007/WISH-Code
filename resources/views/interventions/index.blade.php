@extends('layouts.app')

@section('content')
<section class="wrapper bg-light py-14 py-md-16">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Intervention List</h2>
                    <a href="{{ route('i.create') }}" class="btn btn-primary">Add New Intervention</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Content</th>
                                <th>Strength</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($interventions as $intervention)
                                <tr>
                                    <td>{{ $intervention->id }}</td>
                                    <td>{{ $intervention->type }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($intervention->content, 50) }}</td>
                                    <td>{{ $intervention->strength }}</td>
                                    <td>
                                        <a href="{{ route('i.edit', $intervention->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        
                                        <form action="{{ route('i.destroy', $intervention->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this intervention?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No interventions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
