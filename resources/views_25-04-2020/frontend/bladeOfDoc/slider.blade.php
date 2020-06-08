<div id="demo" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      {{-- <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
      <li data-target="#demo" data-slide-to="3"></li>
      <li data-target="#demo" data-slide-to="4"></li> --}}
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">

      {{-- <div class="carousel-item active">
        <img src="{{asset('images/slider/heloDoc.png')}}" alt="HeloDoc"> --}}
        {{-- <div class="carousel-caption d-none d-md-block centered">
            <h5>First slide label</h5>
            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
        </div> --}}
      {{-- </div> --}}
      <div class="carousel-item active">
        <img src="{{asset('images/slideshow/1st.jpeg')}}" alt="Patient" style="width:1400px;height:550px;">
        <div class="carousel-caption d-none d-md-block right-position">
            <h3>For only 200 taka,
            see a doctor from home and get the medical attention you need.</h3>
        </div>
      </div>
      <div class="carousel-item ">
        <img src="{{asset('images/slideshow/2nd.jpg')}}" alt="Doctor" style="width:1400px;height:550px;">
        <div class="carousel-caption d-none d-md-block right-position">
            <h3>Due to COVID-19 we encourage social-distancing.
                 For any medical aid use HeloDoc and consult a doctor virtually</h3>
        </div>
      </div>
      {{-- <div class="carousel-item">
        <img src="{{asset('images/slider/03.png')}}" alt="Hospital">
        <div class="carousel-caption d-none d-md-block left-position">
            <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h5>
            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            <p><a href="#">More information</a></p>
        </div>
      </div> --}}
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
