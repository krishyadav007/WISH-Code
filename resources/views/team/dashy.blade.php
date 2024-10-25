@extends('layouts.app')

@section('content')
<section class="wrapper bg-light py-14 py-md-16">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard team member</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{route('team.c.g')}}" class="btn btn-primary mb-4">Create</a>

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" colspan="2">Name</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($team as $mteam)
                                <tr>
                                    <th scope="row">{{ $mteam['id'] }}</th>
                                    <td colspan="2">{{ $mteam['name'] }}</td>
                                    <td><a href="{{route('team.u.g', $mteam['id'])}}"><i class="uil uil-edit"></i></a></td>
                                    <td><a href="{{route('team.d', $mteam['id'])}}"><i class="uil uil-glass-tea"></i></a></td>
                                </tr>
                                @empty
                                <td colspan="5" class="bg-warning">No team members</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
