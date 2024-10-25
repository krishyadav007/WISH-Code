@extends('layouts.app')

@section('content')
<section class="wrapper image-wrapper bg-image bg-overlay text-white" data-image-src="{{ $track['cover'] }}" style="background-image: url('{{ $track['cover'] }}');">
      <div class="container pt-17 pb-12 pt-md-19 pb-md-16 text-center">
        <div class="row">
          <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            <div class="post-header">
              <div class="post-category text-line text-white">
                <a href="#" class="text-reset" rel="category">Track</a>
              </div>
              <!-- /.post-category -->
              <h1 class="display-1 mb-3 text-white">{{ $track['title'] }}</h1>
              <p class="lead px-md-12 px-lg-12 px-xl-15 px-xxl-18">{{ $track['subtitle'] }}</p>
            </div>
            <!-- /.post-header -->
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    
    <section class="wrapper bg-light wrapper-border">
      <div class="container pt-14 pt-md-16 pb-13 pb-md-15">
        <div class="row">
          <div class="col-lg-10 offset-lg-1">
            <article>
              <h2 class="display-6 mb-4">About the track</h2>
              <div class="row gx-0">
                <div class="col-md-9 text-justify">
                  <p>{{ $track['about'] }}</p>
                </div>
                <!--/column -->
                <div class="col-md-2 ms-auto">
                  <ul class="list-unstyled">
                    <li class="mb-2">
                      <h5 class="mb-1">Last updated</h5>
                        <p class="mb-1 hover">{{@$track['updated_at']}} UTC</a>
                    </li>
                    <li>
                      <h5 class="mb-1">Track members</h5>
                      <ul>
                        @forelse(get_object_vars(json_decode($track['members'])) as $member_name => $member_link)
                        <a href="{{$member_link}}"><li>{{$member_name}}</li></a>
                        @empty
                        <p>Details are locked</p>
                        @endforelse
                      </ul>
                    </li>
                  </ul>
                </div>
                <!--/column -->
              </div>
              <!--/.row -->
            </article>
            <!-- /.project -->
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
      <div class="container-fluid px-md-6">
        <h3>Themes of focus</h3>
        <div class="swiper-container blog grid-view mb-17 mb-md-19 swiper-container-0" data-margin="30" data-nav="true" data-dots="true" data-items-xxl="3" data-items-md="2" data-items-xs="1">
          <div class="swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
            <div class="swiper-wrapper" id="swiper-wrapper-fe1466c2ff4cef42" aria-live="off" style="cursor: grab; transform: translate3d(-2385px, 0px, 0px); transition-duration: 0ms; transition-delay: 0ms;">
            @forelse(get_object_vars(json_decode($track['pictures'])) as $subfocus_name => $subfocus_pic)
            <div class="swiper-slide" role="group" aria-label="1 / 7" style="width: 447px; margin-right: 30px;">
                <figure class="rounded"><img src="{{$subfocus_pic}}" alt=""></figure>
              </div>            
            @empty
                        <p>Details are locked</p>
            @endforelse  

            </div>
            <!--/.swiper-wrapper -->
          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
          <!-- /.swiper -->
        <div class="swiper-controls"><div class="swiper-navigation"><div class="swiper-button swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-fe1466c2ff4cef42" aria-disabled="false"></div><div class="swiper-button swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-fe1466c2ff4cef42" aria-disabled="false"></div></div><div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 5"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 6" aria-current="true"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 7"></span></div></div></div>
        <!-- /.swiper-container -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /section -->

    <section class="wrapper bg-light">
      <div class="container py-14 py-md-16">
        <div class="row text-center">
          <div class="col-xl-10 mx-auto">
            <h2 class="fs-15 text-uppercase text-muted mb-3">Our work</h2>
            <h3 class="display-4 mb-10 px-xxl-15">Check out the latest updates and events</h3>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-xl-10 mx-auto">
            <!-- <form class="filter-form mb-10">
              <div class="row">
                <div class="col-md-4 mb-3">
                  <div class="form-select-wrapper">
                    <select class="form-select" aria-label="">
                      <option selected>Position</option>
                      <option value="position1">Business</option>
                      <option value="position2">Design</option>
                      <option value="position3">Development</option>
                      <option value="position4">Engineering</option>
                      <option value="position5">Finance</option>
                      <option value="position6">Marketing</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <div class="form-select-wrapper">
                    <select class="form-select" aria-label="">
                      <option selected>Type</option>
                      <option value="type1">Full-time</option>
                      <option value="type3">Part-time</option>
                      <option value="type4">Remote</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <div class="form-select-wrapper">
                    <select class="form-select" aria-label="">
                      <option selected>Location</option>
                      <option value="location1">Chicago, US</option>
                      <option value="location3">Michigan, US</option>
                      <option value="location2">New York, US</option>
                      <option value="location4">Los Angles, US</option>
                      <option value="location5">Moscow, Russia</option>
                      <option value="location6">Sydney, Australia</option>
                      <option value="location7">Birmingham, UK</option>
                      <option value="location8">Manchester, UK</option>
                      <option value="location9">Beijing, China</option>
                    </select>
                  </div>
                </div>
              </div>
            </form> -->
            <div class="job-list mb-10">
              <h3 class="mb-4">Reports</h3>
              @forelse(get_object_vars(json_decode($track['reports'])) as $report_name => $details)
              <a href="{{$details->link}}" class="card mb-4 lift">
                <div class="card-body p-5">
                  <span class="row justify-content-between align-items-center">
                    <span class="col-md-5 mb-2 mb-md-0 d-flex align-items-center text-body">
                      <span class="text-truncate">{{$details->title}}</span> </span>
                    <span class="col-5 col-md-3 text-body d-flex align-items-center">
                      <i class="uil uil-clock me-1"></i> {{$details->date}} </span>
                    <span class="col-7 col-md-4 col-lg-3 text-body d-flex align-items-center">
                      <i class="uil uil-location-arrow me-1"></i> Link to document</span>
                    <span class="d-none d-lg-block col-1 text-center text-body">
                      <i class="uil uil-angle-right-b"></i>
                    </span>
                  </span>
                </div>
              </a>          
            @empty
                        <p>Details are locked</p>
            @endforelse
            </div>
            <div class="job-list">
              <h3 class="mb-4">Events</h3>
              @forelse(get_object_vars(json_decode($track['events'])) as $event_name => $details)
              <a href="{{$details->link}}" class="card mb-4 lift">
                <div class="card-body p-5">
                  <span class="row justify-content-between align-items-center">
                    <span class="col-md-5 mb-2 mb-md-0 d-flex align-items-center text-body">
                      <span class="text-truncate">{{$details->title}}</span> </span>
                    <span class="col-5 col-md-3 text-body d-flex align-items-center">
                      <i class="uil uil-clock me-1"></i> {{$details->date}} </span>
                    <span class="col-7 col-md-4 col-lg-3 text-body d-flex align-items-center">
                      <i class="uil uil-location-arrow me-1"></i> {{$details->mode}}</span>
                    <span class="d-none d-lg-block col-1 text-center text-body">
                      <i class="uil uil-angle-right-b"></i>
                    </span>
                  </span>
                </div>
              </a>          
            @empty
                        <p>Details are locked</p>
            @endforelse
            </div>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
                    
    <section class="wrapper bg-light">
      <div class="container py-10">
        <div class="row gx-md-6 gy-3 gy-md-0">
          <div class="col-md-8 align-self-center text-center text-md-start navigation">
            <!-- <a href="" class="btn btn-soft-ash rounded-pill btn-icon btn-icon-start mb-0 me-1"><i class="uil uil-arrow-left"></i> Prev Post</a>
            <a href="" class="btn btn-soft-ash rounded-pill btn-icon btn-icon-end mb-0">Next Post <i class="uil uil-arrow-right"></i></a> -->
          </div>
          <!--/column -->
          <aside class="col-md-4 sidebar text-center text-md-end">
            <div class="dropdown share-dropdown btn-group">
              <button class="btn btn-red rounded-pill btn-icon btn-icon-start dropdown-toggle mb-0 me-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="uil uil-share-alt"></i> Share </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#"><i class="uil uil-twitter"></i>Twitter</a>
                <a class="dropdown-item" href="#"><i class="uil uil-facebook-f"></i>Facebook</a>
                <a class="dropdown-item" href="#"><i class="uil uil-linkedin"></i>Linkedin</a>
              </div>
              <!--/.dropdown-menu -->
            </div>
            <!--/.share-dropdown -->
          </aside>
          <!-- /column .sidebar -->
        </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
@endsection
