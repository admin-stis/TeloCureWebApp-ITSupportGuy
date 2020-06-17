@extends('admin.layout')

@section('content')

<style>
    #search1,#search2,#search3 {
        border: 1px solid !important;
        padding: 10px;
        margin-left: 17px;
    }
</style>


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
               <li class="breadcrumb-item active">Dashboard</li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- Left col -->
         <section class="col-lg-7">
            <div class="card">
               <div class="card-header">
                  <div class="col-md-12">
                     <span class=""><i class="fas fa-list mr-1"></i>Service Duration of Transaction </span>
                  </div>
                  <div class="col-md-6">
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <div class="tab-content p-0">
                     <!-- Morris chart - Sales -->
                     <div class="chart tab-pane active" id="revenue-chart"
                        style="position: relative;min-height:550px;">
                        <div class="row">
                           <input id="search1" type="text" class="col-md-4 col-lg-4 form-control"  placeholder="Search..."/>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Doctor</th>
                                    <th>Phone</th>
                                    <th>Hospital</th>
                                    <th>Duration</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($newArr2 as $item)
                                    <tr class="table1">
                                        <td>{{$item['dName']}}</td>
                                        <td>{{$item['phone']}}</td>
                                        <td>{{$item['hosName']}}</td>
                                        <td>{{$item['timeInterVal']}}</td>
                                        <td>{{$item['date']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-md-6 col-lg-6 jquery-script-clear"></div>
                     </div>
                  </div>
               </div>
               <!-- /.card-body -->
            </div>

         </section>


         <section class="col-lg-5">
            <div class="card">
               <div class="card-header">
                  <div class="col-md-12">
                     <span class=""><i class="fas fa-list mr-1"></i> Doctorwise Service Duration</span>
                  </div>
                  <div class="col-md-6">
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <div class="tab-content p-0">
                     <!-- Morris chart - Sales -->
                     <div class="chart tab-pane active" id="revenue-chart"
                        style="position: relative;min-height:550px;">
                        <div class="row">
                           <input id="search2" type="text" class="col-md-4 col-lg-4 form-control"  placeholder="Search..."/>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Doctor</th>
                                    <th>Phone</th>
                                    {{-- <th>Category</th>
                                    <th>Hospital</th> --}}
                                    <th>Calls</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($newArr1 as $item)
                                    <tr class="table2">
                                        <td>{{$item['doctorName']}}</td>
                                        <td>{{$item['doctorPhone']}}</td>
                                        {{-- <td>{{$item['doctorType']}}</td> --}}
                                        <td>{{$item['noOfCall']}}</td>
                                        <td>{{$item['duration']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-md-6 col-lg-6 jquery-script-clear"></div>
                     </div>
                  </div>
               </div>
               <!-- /.card-body -->
            </div>

         </section>

         <section class="col-lg-7">
            <div class="card">
               <div class="card-header">
                  <div class="col-md-12">
                     <span class=""><i class="fas fa-list mr-1"></i> Doctor Type wise Call Counter</span>
                  </div>
                  <div class="col-md-12">
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <div class="tab-content p-0">
                     <!-- Morris chart - Sales -->
                     <div class="chart tab-pane active" id="revenue-chart"
                        style="position: relative;">
                        <div class="row">
                           <input id="search" type="text" class="col-md-4 col-lg-4 form-control"  placeholder="Search..."/>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>No. of calls</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>General</td>
                                    <td>
                                        @foreach ($general as $item)
                                            {{$item}}
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pediatric</td>
                                    <td>
                                        @foreach ($pediatric as $item)
                                            {{$item}}
                                        @endforeach
                                    </td>
                                </tr>
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

<script type="text/javascript">
    $(document).ready(function(){
        $("#search1").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("tbody tr.table1").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    $(document).ready(function(){
        $("#search2").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("tbody tr.table2").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

@endsection


