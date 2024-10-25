@extends('layouts.app')

@section('content')
<section class="wrapper bg-light py-14 py-md-16">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add track</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('track.c.p') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="cover" class="form-label">Cover</label>
                                <input type="text" class="form-control" id="cover" name="cover" required>
                                @error('cover')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" required>
                                @error('slug')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="subtitle" class="form-label">Subtitle</label>
                                <input type="text" class="form-control" id="subtitle" name="subtitle" required>
                                @error('subtitle')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="about" class="form-label">About</label>
                                <textarea class="form-control" id="about" name="about" rows="4" required></textarea>
                                @error('about')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="pictures" class="form-label">Pictures</label>
                                <textarea class="form-control" id="pictures" name="pictures" rows="4" required></textarea>
                                @error('pictures')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="chair" class="form-label">Chair</label>
                                <textarea class="form-control" id="chair" name="chair" rows="4" required></textarea>
                                @error('chair')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="members" class="form-label">Members</label>
                                <textarea class="form-control" id="members" name="members" rows="4" required></textarea>
                                @error('members')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="reports" class="form-label">Reports</label>
                                <textarea class="form-control" id="reports" name="reports" rows="4" required></textarea>
                                @error('reports')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="events" class="form-label">Events</label>
                                <textarea class="form-control" id="events" name="events" rows="4" required></textarea>
                                @error('events')
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
