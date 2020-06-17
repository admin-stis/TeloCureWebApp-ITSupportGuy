@extends('patient.layout')

@section('content')
<!-- Content Header (Page header) -->


    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"  style="float:left;">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('patient')}}">Home</a></li>
              <li class="breadcrumb-item active">Help</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">

        <!-- Main row -->
        <div class="row" style="">


          <section class="col-lg-12 " style="margin-top: 10px;">
            <!-- TO DO List -->
            <div class="card">
              <div class="row card-header">
                <div class="col">
                  <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Help
                  </h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <ul class="todo-list" data-widget="todo-list" style="width: 100%; float: left;">

                  <li>
                    <span class="text  col-md-7 col-sm-12">Email</span>
                    <span class="">:</span>
                    <span class="text  col-md-4 col-sm-12">support@telocure.com
                    </span>
                  </li>
                  <li>
                    <span class="text  col-md-7 col-sm-12">Mobile</span>
                    <span class="">:</span>
                    <span class="text  col-md-4 col-sm-12">09614501100

                    </span>
                  </li>

                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>

          <!-- /.Left col -->


        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script type="text/javascript">
      $(document).ready(function(){
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $(document).ready(function () {
        $('table').paginate({
            'elemsPerPage': 10,
                'maxButtons': 6
        });
    });

    $(document).ready(function(){
        $('.dp li a').click(function(){
            let v = $(this).attr('href');
            $('v').addClasses('btn-success');
            $('v').removeClass('btn-success');

        });
    });
    </script>


     @endsection