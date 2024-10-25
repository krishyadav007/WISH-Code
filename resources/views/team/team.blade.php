@extends('layouts.app')

@section('content')
<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <div class="row mb-3">
            <div class="col-md-10 col-xl-9 col-xxl-7 mx-auto text-center">
                <img src="{{ asset('/img/icons/lineal/team.svg') }}"
                    class="svg-inject icon-svg icon-svg-md mb-4" alt="" />
                <h2 class="display-4 mb-3 px-lg-14">Meet the hard working minds behind CSIF </h2>
            </div>
            <!--/column -->
        </div>
        <!--/.row -->

        @forelse($team as $mteam)
            <div class="row">
                <div class="item-inner">
                    <div class="card">
                        <div class="">
                            <div class="row no-gutters">
                                <div class="col-md-4 my-custom-class">
                                    <picture>
                                        <img class="img-fluid w-100 rounded"
                                            style="object-fit: cover; object-position: center; height: 40vh;"
                                            src="{{ $mteam['pic'] }}"
                                            alt="person">
                                            
                                    </picture>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body py-1">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="mb-1">{{ $mteam['name'] }}</h4>
                                                <div class="meta mb-2">{{ $mteam['title'] }}
                                                </div>
                                                <p class="mb-2">{{ $mteam['about'] }}</p>
                                                <nav class="nav social mb-0">
                                                    @php
                                                        $socials = json_decode($mteam['social']);
                                                    @endphp
                                                    @forelse(get_object_vars($socials) as $key => $value)
                                                    <a href="{{$value}}"><i class="uil uil-{{$key}}"></i></a>
                                                    @empty
                                                        <span class="bg-warning">No social media provided</span>
                                                    @endforelse
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <span class="bg-warning">No team members</span>
        @endforelse
</section>
@endsection
