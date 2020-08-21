<style type="text/css">
    hr{
        height: 1px;
        /*background: #377ab8;*/
    }
    .servicehospitalblog-item .servicehospitalblog-bottom h3 a {
      background: #033d72;
    }

    .servicehospitalblog-item .servicehospitalblog-bottom h3 a:hover {
      color: #000000;
    
        .subscriptionform-title h2{
        background: #033d72;
    }
    .subscription-btn{
        background-color: #033d72;
    }
</style>
        <!-- Service Details -->
        @if ($errors->any())
                    @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach
                    
                @endif

                @if(Session::has('phonemsg'))
                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('phonemsg') }}</p>
                @endif

                @if(Session::has('emailmsg'))
                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('emailmsg') }}</p>
                @endif

                @if(Session::has('notification'))
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('notification') }}</p>
                @endif
        <div class="privacydetails-area ptb-100" style="margin-top:30px;">
            <div class="container">

                <div class="row" style="margin-bottom:40px">
                    <!-- <div class="privacyalldetails" style="border:2px solid red;"> -->

                       <div class="col-lg-6">
                           <div class="privacydetails" style="padding-top:15px;">
                               <h2>Why TeloCure</h2>
                               <p>TeloCure utilizes machine learning and artificial intelligence to provide the best quality of care
to patients with the highest level of convenience. With TeloCure hospitals will be able to take
care of patients across the entire country making medical aid available anywhere, at any time and in the most cost-efficient way possible.</p>
                            <br>
                                <div class="row">
                                    <div class="col-md-4" style="margin-bottom:10px;">

                                          <div class="text-left">
                                              <a href="#hospital-add" class="btn drop-btn"><span>JOIN NOW</span></a>
                                              <!-- <button type="submit" class="btn service-doctor-btn">JOIN NOW</button> -->
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                           <div class="text-left">
                                              <a class="btn drop-btn" href="{{url('login/hospital')}}"><span>SIGN IN</span></a>

                                              <!-- <button type="submit" class="btn service-doctor-btn">SIGN IN</button> -->
                                           </div>
                                    </div>
                                </div>
                           </div>
                       </div>
                       <div class="col-lg-6">
                           <div class="privacydetails-inner-left">
                               <img src="{{asset('assets/img/service-hospital/service-hospital-1.jpg')}}" width="100%" style="padding-top:20px;" alt="Service">
                           </div>
                       </div>
                    <!-- </div> -->
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="privacydetails" style="padding-top:15px;">
                            <h2>Benefits of TeloCure</h2>
                            <p><b>Provide quality service: </b>Improve quality and help prevent costly downstream events, such as hospital admissions or readmissions as patients are taken care of at their own home</p>
                            <p><b>Safe consultancy: </b>Reduce the spread of infections in a clinical setting. It eliminates the risk of patient spreading germs to the primary care provider or other patients</p>
                            <p><b>A more cost-effective approach: </b>providing service virtually is more cost-efficient as hospital infrastructure is not required, take care of patients all over Bangladesh virtually.</p>
                            <p id="hospital-add" ><b>Keep track of hospital analytics: </b>With TeloCure keep track of your analytics and generated revenue more</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="privacydetails-inner-left">
                            <!-- <img src="assets/img/privacy/UberIM_010182_3x2.jpg" alt="Service"> -->
                            <img src="{{asset('assets/img/service-hospital/service-hospital-2.jpg')}}" width="100%" style="padding-top:20px;" alt="Service">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Service Details -->

        <!-- Privacy Blog -->
        <section  class="servicehospital-area">
            <div class="container">
                <div class="servicehospital-title">
                    <h2>Subscription Plans For Hospitals</h2>
                    <p>Use TeloCure as a platform to provide quality health care to patients across the country. Subscribe to one of our annual plans.</p>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay=".3s">
                        <div class="servicehospitalblog-item">

                            <div class="servicehospitalblog-bottom">
                                <h3>
                                    <a href="javascript:void()">Basic</a>
                                </h3>
                                <p style="font-size:9px; font-weight:700;text-align:center;color:#033d72 !important">(One year trial plan for new clients only)</p>
                                <hr>
                                <div class="package-content">
                                    <li>1 Hospital only</li>
                                    <li>100 doctors maximum</li>
                                    <li>Maximum 500 call per month</li>
                                    <li>Revenue share per transaction on doctor fee will be 80%(hospital)/20%(TeloCure)</li>
                                    <li>Web analytics dashboard, Web access, Doctors Access control</li>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay=".3s">
                        <div class="servicehospitalblog-item">
                            <div class="servicehospitalblog-bottom">
                                <h3>
                                    <a href="javascript:void()">Silver</a>
                                </h3>
                                <p style="font-size:9px; font-weight:700;text-align:center;color:#033d72 !important">(BDT 25,000 Tk Only/Month)</p>

                                <!-- <small class="font-bold" style="font-size:9px; font-weight:700;">(25,000 Tk Only/Month 12 months contract)</small> -->
                                <hr>
                                <div class="package-content">
                                    <li>Up To 50 Hospital only</li>
                                    <li>100 doctors maximum</li>
                                    <li>Maximum 3000 call per month</li>
                                    <li>Revenue share per transaction on doctor fee 80%(hospital)/20%(TeloCure)</li>
                                    <li>Web analytics dashboard,Web access, Doctors Access control</li>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay=".3s">
                        <div class="servicehospitalblog-item">
                            <div class="servicehospitalblog-bottom">
                                <h3>
                                    <a href="javascript:void()">Gold</a>
                                </h3>
                                <p style="font-size:9px; font-weight:700;text-align:center;color:#033d72 !important">(BDT 50,000 Tk Only/Month)</p>

                                <!-- <small class="font-bold" style="font-size:9px; font-weight:700;">(50,000 Tk Only/Month – 12 months contract)</small> -->
                                <hr>
                                <div class="package-content">
                                    <li>Up To 100 Hospital only</li>
                                    <li>Up to 5000 doctors maximum</li>
                                    <li>Up to Maximum 10000 call per month</li>
                                    <li>Revenue share per transaction on doctor fee 80%(hospital)/20%(TeloCure)</li>
                                    <li>Web analytics dashboard, Web access, Doctors Access control</li>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay=".3s">
                        <div class="servicehospitalblog-item">
                            <div class="servicehospitalblog-bottom">
                                <h3>
                                    <a href="javascript:void()">Platinum</a>
                                </h3>
                                <p style="font-size:9px; font-weight:700;text-align:center;color:#033d72 !important">(1,00,000 Tk Only/Month)</p>

                                <!-- <small class="font-bold" style="font-size:9px; font-weight:700">(1,00,000 Tk Only/Month – 12 months contract)</small> -->
                                <hr>
                                <div class="package-content">
                                    <li>Call priority</li>
                                    <li>Unlimited Hospitals</li>
                                    <li>Unlimited Doctors</li>
                                    <li>Unlimited Calls</li>
                                    <li>Revenue share per transaction on doctor fee 80%(hospital)/20%(TeloCure)</li>
                                    <li>Web analytics dashboard, Web access, Doctors Access control</li>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- End subscription plan  -->
        {{--<div  id="hospital-add"  class="text-center">
            <button type="submit" class="btn service-hospital-btn">GET STARTED</button>
        </div>--}}


        <!-- Privacy Blog -->
        <section class="subscriptionform-area">
            <div class="container" style="background-color: aliceblue;  padding-top: 25px;   ">
                <div class="subscriptionform-title">
                    <h2>SUBSCRIPTION FORM</h2>
                </div>
                {{--@if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <p class="alert-danger">{{ $error }}</p>
                        @endforeach
                    </ul>
                @endif

                @if(Session::has('msg'))
                    <ul><p class="{{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('msg') }}</p></ul>
                @endif

                @if(Session::has('notification'))
                    <ul><p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('notification') }}</p></ul>
                @endif
                --}}

                <form method="POST" action="{{url('sethospitaluser')}}">
                  @csrf
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="fname">Representative Name <i class="icofont-star-alt-2" style="color:red;font-size: :10px;font-weight: 600"></i></label>
                      <input type="text" class="form-control" id="fname" placeholder="" name="name" value="{{old('name')}}">
                    </div>
                    {{-- <div class="form-group col-md-6">
                      <label for="lname">Last Name</label>
                      <input type="text" class="form-control" id="lname" placeholder="">
                    </div> --}}
                  </div>


                  <div class="form-row">
                    {{-- <div class="form-group col-md-6">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" value="+880" name="phone" placeholder="">
                    </div> --}}
                    <div class="form-group col-md-6 row">
                        <label for="phone" class="col-sm-12" style="
              padding: 0;
                 ">Phone <i class="icofont-star-alt-2" style="color:red;font-size: :10px;font-weight: 600"></i></label>
               <input type="text" class="form-control" id="phone" value="+88" style="width:10%;" placeholder="" readonly="">
                            <input type="text" class="form-control" id="phone" style="width:87%;" value="{{old('phone')}}" name="phone" placeholder="" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lname">Email <i class="icofont-star-alt-2" style="color:red;font-size: :10px;font-weight: 600"></i></label>
                        <input type="text" class="form-control" id="lname" name="email" placeholder="" value="{{old('email')}}">
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="hname">Hospital Name <i class="icofont-star-alt-2" style="color:red;font-size: :10px;font-weight: 600"></i></label>
                    <input type="text" class="form-control" id="hospitalName" name="hospitalName" placeholder="" value="{{old('hospitalName')}}">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="haddress">Hospital Corporate Address <i class="icofont-star-alt-2" style="color:red;font-size: :10px;font-weight: 600"></i></label>
                      <input type="text" class="form-control" id="hospitalAddress" name="hospitalAddress" placeholder="" value="{{old('hospitalAddress')}}">
                    </div>

                    {{-- <div class="form-group col-md-4">
                      <label for="hname">Subscription</label>
                    <input type="text" class="form-control" id="subscription" placeholder="">
                    </div> --}}

                    <div class="form-group col-md-4">
                        <label for="hname">Subscription <i class="icofont-star-alt-2" style="color:red;font-size: :10px;font-weight: 600"></i></label>
                        <select name="plan" type="text" class="form-control" id="subscription" value="{{old('plan')}}" placeholder="" required>
                            <option value="">Select subscription plan</option>
                            <option value="basic">Basic</option>
                            <option value="silver">Silver</option>
                            <option value="gold">Gold</option>
                            <option value="platinum">Platinum</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-row">

                    <div class="form-group col-md-12">
                      <label for="comment">Comment Please  <i class="icofont-star-alt-2" style="color:red;font-size: :10px;font-weight: 600"></i></label>
                      <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn service-hospital-btn">Submit</button>
            </form>
            </div>
        </section>

        <!-- Privacy Blog -->
        <section class="hospitalclient-area">
            <div class="container">
                <div class="hospitalclient-title">
                    <h2>Hospital Network</h2>
                    <p>Coming soon.......</p>
                </div>
                <!-- <div class="row">
                    <p>test</p>
                </div> -->
                <!-- <div class="row">
                    <div class="col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay=".3s">
                        <div class="hospitalclientblog-item">
                            <div class="hospitalclientblog-top">
                                <a href="javascript:void()">
                                    <img src="{{asset('assets/img/service-hospital/client-logo-1.png')}}" alt="Blog">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay=".3s">
                        <div class="hospitalclientblog-item">
                            <div class="hospitalclientblog-top">
                                <a href="javascript:void()">
                                    <img src="{{asset('assets/img/service-hospital/client-logo-2.png')}}" alt="Blog">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay=".3s">
                        <div class="hospitalclientblog-item">
                            <div class="hospitalclientblog-top">
                                <a href="javascript:void()">
                                    <img src="{{asset('assets/img/service-hospital/client-logo-3.png')}}" alt="Blog">

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay=".3s">
                        <div class="hospitalclientblog-item">
                            <div class="hospitalclientblog-top">
                                <a href="javascript:void()">
                                    <img src="{{asset('assets/img/service-hospital/client-logo-4.png')}}" alt="Blog">

                                </a>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </section>
        <!-- End Privacy Blog -->

        <!-- Service Details -->
        <!-- <div class="privacydetails-area ptb-100">
            <div class="container">

                <div class="row" style="margin-bottom:40px">

                       <div class="col-lg-6">
                           <div class="privacydetails-inner-left">
                               <img src="assets/img/privacy/default.jpg" alt="Service">
                           </div>
                       </div>

                       <div class="col-lg-6">
                           <div class="privacydetails-inner">
                               <h2>Partnering to make a difference</h2>
                               <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto blanditiis obcaecati veritatis magnam pariatur molestiae in maxime. Animi quae vitae in inventore. Totam mollitia aspernatur provident veniam aperiam placeat impedit! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe rem natus nobis, dolorum nam excepturi iure autem nemo ducimus temporibus facere, est eum voluptatem, culpa optio fugit assumenda quod? Praesentium.</p>
                               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, laudantium ullam, iure distinctio officia libero voluptatem obcaecati vero deleniti minima nemo itaque alias nisi eveniet soluta architecto quae laboriosam unde.</p>
                           </div>
                       </div>

                </div>
            </div>
        </div> -->
        <!-- End Service Details -->

        <!-- Privacy Blog -->
        <!-- <section class="privacydriverrider-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="privacydriverriderblog-item">
                            <div class="privacydriverriderblog-top">
                                <a href="javascript:void()">
                                    <img src="assets/img/privacy/driver-icon.png" alt="Blog">
                                </a>
                            </div>
                            <div class="privacydriverriderblog-bottom">
                                <h3>
                                    <a href="javascript:void()">Driver safety</a>
                                </h3>
                                <p>Drive when and where you want with confidence.</p>
                                <ul>
                                    <li>
                                        <a href="javascript:void()">
                                            Read More
                                            <i class="icofont-long-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="privacydriverriderblog-item">
                            <div class="privacydriverriderblog-top">
                                <a href="javascript:void()">
                                    <img src="assets/img/privacy/car-icon.png" alt="Blog">

                                </a>
                            </div>
                            <div class="privacydriverriderblog-bottom">
                                <h3>
                                    <a href="javascript:void()">Rider safety</a>
                                </h3>
                                <p>Go anytime and get there comfortably.</p>
                                <ul>
                                    <li>
                                        <a href="javascript:void()">
                                            Read More
                                            <i class="icofont-long-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End Privacy Blog -->

