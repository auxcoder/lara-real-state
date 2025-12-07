@extends('frontend.layout.app')
@section('title', 'Leadership Team | The H Real Estate UAE')
@section('description', 'Meet our experienced leadership team at The H Real Estate. Our experts bring years of knowledge and dedication to provide exceptional real estate services in UAE.')
@section('content')

<style>
ul {
    color: white;
    list-style: none;
}

/* @import "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"; */
/* @import "https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"; */
@import "https://fonts.googleapis.com/css?family=Raleway:100,600";
@import "https://fonts.googleapis.com/css?family=Open+Sans:300";

.gray {
  color: #a5a5a5;
}


.team-member figure {
  position: relative;
  overflow: hidden;
  padding: 0;
  margin: 0;
}

.team-member figcaption p {
  font-size: 16px;
}

.team-member figcaption ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

.team-member figcaption ul {
  visibility: visible;
  -webkit-transition: all 0.1s ease-in-out;
  -moz-transition: all 0.1s ease-in-out;
  -o-transition: all 0.1s ease-in-out;
  transition: all 0.1s ease-in-out;
}

.team-member figcaption ul li {
  display: inline-block;
  padding: 10px;
}

.team-member h4 {
  margin: 10px 0 0;
  padding: 0;
}

.team-member figcaption {
  padding: 50px;
  color: transparent;
  background-color: transparent;
  position: absolute;
  z-index: 996;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 0;
  overflow: hidden;
  visibility: hidden;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}




</style>
	<!-- Bread Crumb End -->
   <section class="banner">
        <div class="container">
            <h2 class="bannerh2">Leadership</h2>
        </div>
    </section>

<section id="team" class="about-main team content-section pt-5">
  <div class="container">
    <div class="row text-center">
      <div class="col-md-12">
        <h2>Our Team</h2>
        <h3 class="caption gray">Meet the people who make awesome stuffs</h3>
      </div><!-- /.col-md-12 -->

      <div class="container">
        <div class="row">

		@foreach($teammembers as $team)
          <div class="col-md-4">
		   <a href="{{route('leadership.detail',$team->slug)}}">
            <div class="team-member">
              <figure>
                <img src="{{ asset('/uploads/'.$team->image ) }}" alt="" class="img-fluid h-100">
                <!--<figcaption>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae asperiores mollitia.</p>
                  <ul>
                    <li><a href=""><i class="fa fa-facebook fa-2x"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter fa-2x"></i></a></li>
                    <li><a href=""><i class="fa fa-linkedin fa-2x"></i></a></li>
                  </ul>
                </figcaption>-->
              </figure>
              <h4 class="text-white">{{ $team->name }}</h4>
              <p class="text-white">{{ $team->position }}r</p>
             </div><!-- /.team-member-->
			</a>
		   </div><!-- /.col-md-4 -->
		  @endforeach



        </div><!-- /.row -->
      </div><!-- /.container -->

    </div><!-- /.row -->
  </div><!-- /.container -->
</section><!-- /.our-team -->
@endsection
