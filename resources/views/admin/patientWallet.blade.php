{{-- new --}}
@extends('admin.layout')
@section('content')


@php 
    //for roles and security 
    $perm_role = Session::get('user_roles');
    $all_perms = $perm_role["perms"]; 
    $editPermission = false; 
    $deletePermission = false; 
    $approvePermission = false; 
    for($i=0; $i<count($all_perms); $i++)
    {
      if($all_perms[$i]=="Edit") { $editPermission = true; }
      if($all_perms[$i]=="Delete") { $deletePermission = true; }
      if($all_perms[$i]=="Approve") { $approvePermission = true; }    
    }
@endphp 




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
                    <li class="breadcrumb-item active">Wallet</li>
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
                            {{-- <span class=""><i class="fas fa-list mr-1"></i> Patient List</span> --}}
                            <span class=""><i class="fas fa-list mr-1"></i> Patients' wallets (Transactions List)</span>
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
                                    <input id="search" type="text" class="col-md-6 col-lg-6 form-control"
                                        placeholder="Search..." />
                                </div>
                                <div class="row">
                                    <span style="margin:8px 0 0 17px;">Following transactions list filtered when refund amount > 0 or < 0  </span>
                                    <span style="margin:8px 0 0 17px; color:rgb(255, 0, 64);">This data comes from Firebase.  </span>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sl No</th>
                                            <th scope="col">Patient (User Id & Visit Id)</th>
                                            <th scope="col">Patient Name</th>
                                            <th scope="col">Patient Phone</th>
                                            <th scope="col">Total</th>
                                            {{-- <th scope="col">Balance</th> --}}
                                            <th scope="col">Refund</th>
                                            <th scope="col">Patient Balance</th>
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
 
                                          $patient = $value['patient'];
                                          $transactionHistory = $value['transactionHistory'];
                                 ?>
                                        <tr>
                                            <td scope="col"><?php echo $key+1 ; ?></td>
                                            <!-- /.card-body -->
                                           <td scope="col">
                                               <?php echo $patient['uid']."   &nbsp;&nbsp;&nbsp;  ".$value['visitId']; ?>
                                            </td>
                                            
                                            <td scope="col"><?php echo $patient['name']; ?></td>
                                            <td scope="col"><?php echo $patient['phone']; ?></td>
                                            <td scope="col"><?php echo $transactionHistory['subTotalRounded'].'Tk'; ?></td>
                                            <td scope="col"><?php echo $transactionHistory['refundAmount'].'Tk'; ?></td>
                                            <td scope="col"><?php echo $balances[$patient['uid']]; ?></td></td> 
                                           
                                            
                                            <td scope="col"><a class="btn btn-primary btn-sm"
                                                    href="{{url('admin/transaction/'.$visited[$key]['visitId'].'')}}">View</a>
                                                    @if($editPermission) 
                                                    <a class="btn btn-primary btn-sm"
                                                    href="{{url('admin/pwalletEdit/'.$patient['uid'].'/'.$patient['name'].'')}}">Update Wallet</a>
                                                    @endif
                                            </td>
                                            

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