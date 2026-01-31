@extends('frontend.layout.app')
@section('title', $teammember->name . ' - ' . $teammember->position . ' | {{ config('company.name') }}')
@section('description', 'Learn more about ' . $teammember->name . ', ' . $teammember->position . ' at {{ config('company.name') }}. ' . \Illuminate\Support\Str::limit(strip_tags($teammember->description), 140))

@section('content')
<style>
    .profile-card {
        max-width: 900px;
        margin: auto;
        background: transparent;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }
    .profile-img {
        width: 100%;
        height: auto;
    }
    .info-section {
        padding: 20px;
        color:#fff;
    }
    .info-section h2 {
        font-size: 24px;
        margin-bottom: 10px;
        color:#fff;
    }
    .info-section p {
        margin-bottom: 8px;
        color:#fff;
    }
    .info-section a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
        color:#fff;
    }
    .info-section a:hover {
        text-decoration: underline;
    }
</style>
<!-- Bread Crumb End -->
<section class="banner">
    <div class="container">
        <h2 class="bannerh2">{{ $teammember->name }}</h2>
    </div>
</section>

<section id="team" class="pb-5 pt-5 about-main">
		<div class="container">
			<div class="row profile-card">
				<div class="col-md-4 p-0">
					<img src="{{ asset('/uploads/'.$teammember->image ) }}" alt="Profile Image" class="profile-img">
				</div>
				<div class="col-md-8 text-white info-section">

			        <h2 class="bannerh2 fs-1 fw-bold">{{ $teammember->name }}</h2>
      			    <h2>{{ $teammember->position }}</h2>
					<p>{{ $teammember->description }}</p>
					<p><strong>ID:</strong> {{ $teammember->NID }}</p>
					<p><strong>Specialties:</strong> {{ $teammember->specialties }}</p>
					<p><strong>Languages:</strong> {{ $teammember->languages }}</p>
					<p><strong>Email:</strong> {{ $teammember->email }}</p>
					<p><strong>Experience:</strong> {{ $teammember->experience }}</p>
				</div>
			</div>
		</div>
</section><!-- /.our-team -->
@endsection
