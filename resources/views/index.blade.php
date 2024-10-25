@extends('layouts.app')

@section('content')
<style>
    .hero {
      background-color: #f8f9fa;
      padding: 100px 0;
      text-align: center;
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: bold;
    }

    .hero p {
      font-size: 1.5rem;
    }

    .section-heading {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 1rem;
    }

    .features, .team, .impact, .get-started {
      padding: 80px 0;
    }

    .get-started {
      background-color: #343a40;
      color: #fff;
    }
  </style>

<section class="hero">
    <div class="container">
      <h1>Empowering Women in STEM with AI</h1>
      <p>Our AI Agent system is designed to assist, mentor, and inspire women in STEM fields, making it easier to access knowledge, resources, and support.</p>
      <a href="#features" class="btn btn-primary btn-lg mt-4">Learn More</a>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="features">
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <h2 class="section-heading">Key Features</h2>
          <p class="lead">Explore how our AI agent system can enhance learning, mentorship, and collaboration in the STEM field.</p>
        </div>
      </div>
      <div class="row text-center mt-5">
        <div class="col-md-4">
          <i class="bi bi-robot" style="font-size: 3rem;"></i>
          <h4 class="mt-3">Personalized Mentorship</h4>
          <p>Our AI connects women to experienced mentors in STEM, offering tailored advice and career guidance.</p>
        </div>
        <div class="col-md-4">
          <i class="bi bi-lightbulb" style="font-size: 3rem;"></i>
          <h4 class="mt-3">STEM Resources</h4>
          <p>Access a wide array of STEM resources curated by the AI agent, from learning materials to project ideas.</p>
        </div>
        <div class="col-md-4">
          <i class="bi bi-people" style="font-size: 3rem;"></i>
          <h4 class="mt-3">Collaboration Tools</h4>
          <p>Find collaborators for projects, research, or startups in STEM through our intelligent networking features.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Impact Section -->
  <section id="impact" class="impact">
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <h2 class="section-heading">Our Impact</h2>
          <p class="lead">See how our AI agent is helping women break barriers in STEM and achieve their career goals.</p>
        </div>
      </div>
      <div class="row text-center mt-5">
        <div class="col-md-4">
          <h4>NA</h4>
          <p>Mentorship connections made</p>
        </div>
        <div class="col-md-4">
          <h4>NA</h4>
          <p>STEM resources curated</p>
        </div>
        <div class="col-md-4">
          <h4>NA</h4>
          <p>Women-led STEM projects supported</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Get Started Section -->
  <section id="get-started" class="get-started">
    <div class="container text-center">
      <h2 class="section-heading text-primary">Get Started with AI Agent</h2>
      <p class="lead">Join the community of women in STEM leveraging AI to achieve more. Sign up today and take your career to the next level.</p>
      <a href="#" class="btn btn-light btn-lg mt-4 text-primary">Sign Up Now</a>
    </div>
  </section>

<!-- /section -->
@endsection
