@extends('frontend.layouts.app')

@section('content')

    
        <!-- Service Details -->
        <div class="privacydetails-area ptb-100" style="margin-top:30px;">
            <div class="container">
                
                <div class="row" style="margin-bottom:40px">
                    <!-- <div class="privacyalldetails" style="border:2px solid red;"> -->
                       <div class="col-lg-6">
                           <div class="privacydetails" style="padding-top:15px;">
                               <!-- <h2>How is patient privacy protected?</h2> -->
                               <h2>Patient privacy protection</h2>
                               <!-- <a href="{{url('service/hospital')}}" class="more nav-link" style="padding:0px;">More information</a> -->
                               <p>Any information regarding your health is personal, because of this, we strive to maintain full confidentiality of your health records. Through varied means such as administrative, technical and physical means, we continuously safeguard your information.</p> 
                               <!-- <a href="{{url('patientprivacy')}}" class="more nav-link" style="padding:0px;">More information</a> -->
                           </div>
                       </div>

                       <div class="col-lg-6">
                           <div class="privacydetails-inner-left">
                               <img src="{{asset('assets/img/privacy/1.jpg')}}" width="100%" style="padding-top:20px;" alt="Service">
                           </div>
                       </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
        <!-- End Service Details -->
@endsection
