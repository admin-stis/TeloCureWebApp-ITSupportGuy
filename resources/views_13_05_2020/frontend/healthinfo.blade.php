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
                               <h2>Use of health information</h2>
                               <!-- <a href="{{url('service/hospital')}}" class="more nav-link" style="padding:0px;">More information</a> -->
                               <p>Health information is disclosed and used only for normal business activities the law sees as treatment, healthcare operations, and payment. We only keep a record of all the health information you provide us and may disclose them to other doctors and medical entities so that we can meet your health care needs. No videos of consultations/ visits are recorded.</p> 
                               <!-- <a href="{{url('patientprivacy')}}" class="more nav-link" style="padding:0px;">More information</a> -->
                           </div>
                       </div>

                       <div class="col-lg-6">
                           <div class="privacydetails-inner-left">
                               <img src="{{asset('assets/img/privacy/2.png')}}" width="100%" style="padding-top:20px;" alt="Service">
                           </div>
                       </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
        <!-- End Service Details -->
@endsection
