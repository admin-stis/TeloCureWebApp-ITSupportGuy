

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
               <li class="breadcrumb-item active">Transaction</li>
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
                     <div class="chart tab-pane active" id="" style="position: relative;">
                        <div class="row">
                           <input id="search" type="text" class="col-md-6 col-lg-6 form-control"  placeholder="Search..."/>
                        </div>
                        <table class="table">
                           <thead>
                              <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Doctor Reg No.</th>
                                 <th scope="col">Doctor</th>
                                 <th scope="col">Patient ID</th>
                                 <th scope="col">Patient</th>
                                 <th scope="col">Total</th>
                                 <th scope="col">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 //dd($visited);
                                 $i = 0;
                                 foreach ($visited as $key => $value){

                                 ?>

                                 <?php if(isset($value['transactionHistory']) && !empty($value['transactionHistory'])) {
                                    ?>
                                    <tr>
                                 <td scope="col"><?php echo $key+1 ; ?></td>
                                 <td scope="col"><?php echo $value['doctor']['regNo']; ?></td>
                                 <td scope="col"><?php echo $value['doctor']['name']; ?></td>
                                 <td scope="col"><?php echo $value['patient']['uid']; ?></td>
                                 <td scope="col"><?php echo $value['patient']['name']; ?></td>
                                 <td scope="col"><?php echo $value['transactionHistory']['subTotalRounded'].'Tk'; ?></td>
                                 <td scope="col"><a class="btn btn-primary btn-sm" href="{{url('admin/transaction/'.$visited[$key]['visitId'].'')}}">View</a></td>
                                </tr>
                                 <?php } ?>

                              <?php
                                $i++;
                            } ?>
                           </tbody>
                        </table>
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

