@extends('layouts.app')

@section('content')
<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <h2 class="fs-15 text-uppercase text-muted mb-3">Tracks</h2>
        <div class="row gx-lg-8 mb-10 gy-5">
            <div class="col-lg-6">
                <h3 class="display-5 mb-0">Checkout case studies, events, networking opportunities and more. Head on to tracks that interest you.</h3>
            </div>
            <!-- /column -->
            <div class="col-lg-6">
                <p class="lead mb-0">At CSIF, resources and opportunities are systematically organized into distinct tracks. The organizational structure of each track is determined collaboratively by its members and may vary across tracks. Should you wish to recommend a particular track, please contact us at csiftechtank@gmail.com.</p>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-xl-5 gx-lg-6 gy-6 justify-content-center">
            @forelse($tracks as $track)
                <div class="col">
                    <div class="card shadow-lg">
                        <figure class="card-img-top overlay overlay-1">
                            <a href="{{ route('track',$track['slug']) }}"><img
                                    class="img-fluid" src="{{ $track['cover'] }}"
                                    srcset="{{ $track['cover'] }}" alt=""><span
                                    class="bg"></span></a>
                            <figcaption>
                                <h5 class="from-top mb-0">View Track</h5>
                            </figcaption>
                        </figure>
                        <div class="card-body p-6">
                            <h3 class="fs-21 mb-1">{{ $track['title'] }}</h3>
                            <ul class="post-meta fs-16 mb-0">

                                <li>{{ count(get_object_vars(json_decode($track['reports']))) }}
                                    Documents</li>
                                <li>{{ count(get_object_vars(json_decode($track['events']))) }}
                                    Events</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="card shadow-lg">
                        <figure class="card-img-top overlay overlay-1">
                            <a href="#"><img class="img-fluid"
                                    src="https://images.unsplash.com/photo-1560732488-6b0df240254a?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3DD"
                                    srcset="https://images.unsplash.com/photo-1560732488-6b0df240254a?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt=""><span class="bg"></span></a>
                            <figcaption>
                                <h5 class="from-top mb-0">View Track</h5>
                            </figcaption>
                        </figure>
                        <div class="card-body p-6">
                            <h3 class="fs-21 mb-1">No track available</h3>
                            <ul class="post-meta fs-16 mb-0">
                                <li>Server under maintaince</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforelse
            <!--/.row -->
        </div>
        <!-- /.container -->
</section>
<!-- /section -->
@endsection
