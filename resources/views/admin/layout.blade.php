<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TeloCure | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--Favicon-->
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/favicon.png')}}">
  <!--End-->
  <!-- Font Awesome -->
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  {{-- DataTables --}}
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables/jquery.dataTables.css') }}"/>
  {{-- End --}}

  {{-- custom css --}}
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  {{-- end --}}

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="{{ asset('js/tost/src/jquery.toast.css') }}">

  <script src="{{asset('js/tost/src/jquery.toast.js')}}"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->



  {{-- table css design --}}
  <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('table_res/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
        {{-- <link rel="stylesheet" type="text/css" href="{{url('table_res/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}"> --}}
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{url('table_res/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{url('table_res/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{url('table_res/vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{url('table_res/css/util.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('table_res/css/main.css')}}">
  {{-- end --}}

  {{-- paging --}}
  <link href="{{asset('backend/paginator/jquery.paginate.css')}}" rel="stylesheet" type="text/css">

</head>
<style>
    body{
        margin: 0;
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif !important;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
    }
    .show{
        background: #dee6ef;
        min-height: 460px;
        padding: 1px;
    }
    .pro li .active {
        background: #001f3f;
        color: #fff;
        padding: 8px;
        height: auto;
        width: 100%;
    }
    .userIcon{
        margin: 0 auto;
        display: table;
        font-size: 150px;
    }
    .paginateList{
        float: right;
    }
    table td, table th {
        text-align: center;
    }
</style>
<?php 
    $admin = Session::get('user');
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="{{url('/admin')}}"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/admin')}}" class="nav-link">Home</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <!-- <ul class="navbar-nav ml-auto">-->
      <!-- Messages Dropdown Menu -->
      <!--<li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start
            <div class="media">
              <img src="{{ asset('backend/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start
            <div class="media">
              <img src="{{ asset('backend/dist/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start
            <div class="media">
              <img src="{{ asset('backend/dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul> -->
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/admin')}}" class="brand-link">
      <img src="{{ asset('backend/dist/img/logo.png') }}" alt="TeloCure" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">TeloCure</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('backend/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        {{-- <a href="#" class="d-block">{{auth::user()->name}}</a> --}}
        <a href="#" class="d-block">{{$admin[0]['email']}}</a>
        </div>
      </div>

       
      <!-- Sidebar Menu -->
      @include('admin.sidebar')
      <!-- /.sidebar-menu -->
       




    </div>
    <!-- /.sidebar -->
  </aside>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    @yield('content') 
    <!-- /.content-header -->
    

  </div>



  
  <!-- /.content-wrapper -->
  <footer class="main-footer text-center">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="https://stis.com.bd/">Smart Tech Solution</a></strong>
    All rights reserved.
    {{-- <div class="float-right d-none d-sm-inline-block"> <b>Version</b> 4.0 </div> --}}
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->

{{-- DataTables --}}
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.js') }}"></script>
{{-- End --}}

  {{-- custom js --}}
  <script src="{{asset('backend/dist/js/custom.js')}}"></script>

<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>

<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('backend/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
{{-- Paginator --}}
<script src="{{asset('backend/paginator/jquery.paginate.js')}}"></script>

<script>
    $(document).ready(function(){

    	 $('#incompleteTrans').change(function() {
    	        if(this.checked) {
        	        console.log('test');        	        
                    //var value = "0 TK";
                    $("tbody tr").filter(function() {
                       var toggle = false; 
                       if($(this).find('.totalInput').length)
                       {
                    	  console.log("exists"); toggle = true;                     	  
                       }
                       $(this).toggle(toggle);
                       //$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    }); 
    	        } else { 
        	        console.log('uncheckedd');
    	        }        
    	    });
 	    
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $(document).ready(function () {
        $('table').paginate({
            'elemsPerPage': 15,
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
    //dropDown box
    $(document).ready(function(){
      	 $("select#disId").change(function() {
      	  var val = $(this).children(":selected").attr("value");
      	  $(this).parent("div").children("div").hide(); 
      	  $(this).parent("div").find("div input#discount"+val).parent().show(); 
      	  $(this).parent("div").find("div input#service"+val).parent().show(); 
      	});
// start for calender date time
      	var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        $('#reportrange2').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        //cb(start, end); //it shows date when page loaded at first 
        
          $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          //alert(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
          
          var dateFrom = picker.startDate.format('DD/MM/YYYY'); //"02/05/2013";
    var dateTo = picker.endDate.format('DD/MM/YYYY');//"02/09/2013";
    //var dateCheck = "04/10/2020";

    var d1 = dateFrom.split("/");
    var d2 = dateTo.split("/");
    //var c = dateCheck.split("/");

    var from_date = new Date(d1[2], parseInt(d1[1])-1, d1[0]);  // -1 because months are from 0 to 11
    var to_date   = new Date(d2[2], parseInt(d2[1])-1, d2[0]);
    //var check = new Date(c[2], parseInt(c[1])-1, c[0]);

    $("table.table tbody tr").filter(function() {
      var date_now = $(this).find("td input.date_val").val(); //console.log(date_now);
      var c = date_now.split("/"); var check = new Date(c[2], parseInt(c[1])-1, c[0]);
      var show_row = false;
      if(check >= from_date && check <= to_date) {  show_row = true; } 
      $(this).toggle(show_row);
    });
                
    //console.log(check > from && check < to)
          
          });
          
      	});
</script>
</body>
</html>
