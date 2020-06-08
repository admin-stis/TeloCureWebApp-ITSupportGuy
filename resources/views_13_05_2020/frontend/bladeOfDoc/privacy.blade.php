@extends('frontend.layouts.app')

@section('content')

    <div class="container privacy-policy" >
        <div class="row col-md-12 col-sm-12">
            <div class="col-md-6 col-sm-12">
                <h3>How is patient privacy protected?</h3>
                <p class="text-justify">
                    Any information regarding your health is personal, because of this,
                    we strive to maintain full confidentiality of your health records.
                    Through varied means such as administrative, technical and physical means,
                    we continuously safeguard your information.
                </p>
            </div>

            <div class="col-md-6 col-sm-12">
                <img  class="img-responsive img-thumbnail" src="{{asset('/images/homeSection/doctor.png')}}" />
            </div>
        </div>
        <div class="common"></div>
        <div class="row col-md-12 col-sm-12">

            <div class="col-md-6 col-sm-12">
                <h3>How is health information used and disclosed?</h3>
                <p class="text-justify">
                    Health information is disclosed and used only for normal business activities
                    the law sees as treatment, healthcare operations, and payment.  We keep a record
                    of all the health information you provide us and may disclose them to other
                    doctors and medical entities so that we can meet your health care needs.
                </p>
            </div>

            <div class="col-md-6 col-sm-12">
                <img  class="img-responsive img-thumbnail" src="{{asset('/images/homeSection/doctor.png')}}" />
            </div>



        </div>
        {{-- <div class="row col-md-12 col-sm-12">
            <h3 style="font-weight: 600;font-size: 2em;color: #3776bd;">Doctor</h3>
            <div class="common"></div>
            <img class="img-responsive img-thumbnail" src="{{asset('/images/slider/08.png')}}"/>

            <p style="margin-top:20px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
        </div>
        <div class="col-md-12 col-sm-12">
            <h5>1. Collection of Information:</h5>
            <p></p>
            <hr>
            <ul>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>

            </ul>
        </div>
        <div class="col-md-12 col-sm-12">
            <h5>2.  Cookies, beacons, tags, pixels  :</h5>
            <p></p>
            <hr>
            <ul>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>

            </ul>
        </div>
        <div class="col-md-12 col-sm-12">
            <h5>3. How we share your personal information and who we share it with:</h5>
            <p></p>
            <hr>
            <ul>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>

            </ul>
        </div> --}}
        <div class="common"></div>
        <div class="row col-md-12 col-sm-12">
            <div class="col-md-4 col-sm-12 privacy">
                <h4><p class="text-center">Video not recorded</p></h4>
                <div class="common"></div>
                <div class="common"></div>
                <img class="img-responsive img-thumbnail" src="{{url('images/privacy/no_video.png')}}" />
            </div>
            <div class="col-md-4 col-sm-12 privacy">
                <h4><p class="text-center">Certified Doctors</p></h4>
                <div class="common"></div>
                <div class="common"></div>
                <img class="img-responsive img-thumbnail" src="{{url('images/privacy/certified.jpeg')}}" />
            </div>
            <div class="col-md-4 col-sm-12 privacy">
                <h4><p class="text-center">Women Doctors also available for Women</p></h4>
                <div class="common"></div>
                <img class="img-responsive img-thumbnail" src="{{url('images/privacy/women_doctor.jpeg')}}" />
            </div>
        </div>

    </div>
@endsection
