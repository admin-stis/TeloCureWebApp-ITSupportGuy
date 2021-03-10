

{{-- new --}}
@extends('admin.layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
               <li class="breadcrumb-item active">Manage Payments</li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- Left col -->
         <section class="col-lg-12">
            <div class="card">
               <div class="card-header">
                  <div class="col-md-12">
                     <span class=""><i class="fas fa-list mr-1"></i> Transaction List</span>
                  </div>
                  <div class="col-md-6">
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <div class="tab-content p-0">
                     <!-- Morris chart - Sales -->
                     <div class="chart tab-pane active" id="" style="position: relative; overflow-x: auto;">
                        <div class="row">
                           <input id="search" type="text" class="col-md-4 col-lg-4 form-control"  placeholder="Search..."/>
                           <div id="reportrange" class="" style="background: #fff; cursor: pointer; padding: 5px 10px; margin:0 5px 0 5px; border: 1px solid #ccc;" ><i class="fa fa-calendar"></i>&nbsp;
                           <span>Select Date Range</span> <i class="fa fa-caret-down"></i></div>
                        </div>
                        <table class="table">
                           <thead>
                              <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Doctor ID</th>
                                 <th scope="col">Hospital</th>
                                 <th scope="col">Doctor</th>  
                                 <th scope="col">Total*</th>
                                 <th scope="col">Service fee</th>
                                 <th scope="col">Transaction Date</th>                                 
                                 <th scope="col">Bank Name</th>
                                 <th scope="col">Account Number</th>
                                 <th scope="col">Swift Code</th>
                                 <th scope="col">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 //dd($visited);
                                 $i = 0; $frb_tz = new \DateTimeZone('Asia/Dhaka');                                

                                 foreach ($visited as $key => $value){
                                     
                                     ////02-10-20 mridul set bank account details
                                     $bank_account = "N/A"; $bank_name = "N/A"; $bank_swift = "N/A";
                                     
                                     if(isset($value['doctor']['hospitalized']) && $value['doctor']['hospitalized'] == false)
                                     {
                                         if(isset($bankData[$value["doctor"]['uid']]))
                                         {
                                             $bank_account = $bankData[$value["doctor"]['uid']]["accountNumber"];
                                             $bank_name = $bankData[$value["doctor"]['uid']]["bankName"];
                                             $bank_swift = $bankData[$value["doctor"]['uid']]["swiftCode"];
                                         }
                                         
                                     } else {
                                         if(isset($value["doctor"]["hospitalized"]) && $value["doctor"]["hospitalized"]==true)
                                         {
                                             if(isset($bankData[$value["doctor"]['hospitalUid']]))
                                             {
                                                 $bank_account = $bankData[$value["doctor"]['hospitalUid']]["accountNumber"];
                                                 $bank_name = $bankData[$value["doctor"]['hospitalUid']]["bankName"];
                                                 $bank_swift = $bankData[$value["doctor"]['hospitalUid']]["swiftCode"];
                                             }
                                         }
                                     }
                                 ?>

                                 <?php if(isset($value['transactionHistory']) && !empty($value['transactionHistory'])) {
                                    ?>
                                    <tr>
                                 <td scope="col"><?php echo $key+1 ; ?></td>
                                 <td scope="col"><?php echo $value['doctor']['uid']; ?></td>
                                 <td scope="col">
                                 @if(isset($value['doctor']['hospitalized']) && $value['doctor']['hospitalized'] == true)
                                    {{ $value['doctor']['hospitalName'] }} 
                                 @else N/A  @endif</td>
                                 <td scope="col"><?php echo $value['doctor']['name']; ?></td>             
                                 <td scope="col"><?php echo (int)$value['transactionHistory']['subTotalRounded'] - (int)$value['transactionHistory']['serviceFee']; ?></td>
                                 <td scope="col"><?php echo $value['transactionHistory']['serviceFee']; ?></td>
                                 <td scope="col">
                                {{-- mridul 12-9-20 --}}
                                     @if(isset($value['transactionHistory']['createdDate']))                                                      
                                     @php                            
                                      $frb_date = new \DateTime($value['transactionHistory']['createdDate']);
                                      $frb_date->setTimezone($frb_tz);
                                      echo $frb_date->format('d-m-y  h:i:s A'); 
                                     @endphp   
                                     <input type="hidden" class="date_val" value="{{ $frb_date->format('d/m/Y') }}"/>                                                     
                                     @endif
                                 </td>
                                 <td scope="col">{{ $bank_name }}</td> 
                                 <td scope="col">{{ $bank_account }}</td>                                  
                                 <td scope="col">{{ $bank_swift }}</td> 
                                 <td scope="col"><a class="btn btn-primary btn-sm" href="{{url('admin/transaction/'.$visited[$key]['visitId'].'')}}">View</a></td>
                                </tr>
                                 <?php } ?>

                              <?php
                                $i++;
                            } ?>
                           </tbody>
                        </table>
                        <div class="col-md-6 col-lg-6"><b>* total amount without service fee</b></div>
                        <div class="col-md-6 col-lg-6 jquery-script-clear"></div>
                     </div>
                  </div>
               </div>
               <!-- /.card-body -->
            </div>
         </section>
      </div>
   </div>
</section>
@endsection

