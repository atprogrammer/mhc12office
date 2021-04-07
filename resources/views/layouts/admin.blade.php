<?php use App\Models\BookBook; //ใช้ Query มือ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- fullcalendar-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  
  <!-- datepicker -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script src="{{asset('datepicker/js/messages.th-TH.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> <!-- sweetalert โหลดเพิ่ม-->
    <script src="{{ asset('js/bonus.js') }}"></script> <!-- สร้างเพิ่มใน public/js-->

    
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">หน้าแรก</a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-shopping-cart"></i>
          <?php 
          $count = DB::table('book_books')->where('user_id', Auth::user()->id)->count();
          if($count>0){
             $book_ch = 1;
          }else{
             $book_ch = 0;
          }
          ?>
          <span class="badge <?php if($book_ch==1){?> badge-danger <?php }else{?> badge-warning <?php }?> navbar-badge">{{$book_ch}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header bg-success">{{$book_ch}} การแจ้งเตือน</span>
          <div class="dropdown-divider"></div>
          @if($book_ch==1)
          <a href="{{route('bookstores.action_book_form',Auth::user()->id)}}" class="dropdown-item bg-warning">
            <i class="fas fa-shopping-cart mr-2 "></i>สื่อที่ยังไม่ได้ส่งเบิก {{$count}} รายการ
          </a>
          @endif
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">0 Notifications</span>
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
      
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}


        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
            <a class="nav-link" href="">login</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
    </ul>
  </nav>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">ผู้ใช้ : {{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <li class="nav-item has-treeview menu-close">
                <a href="#" class="nav-link active bg-success">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                  <p>
                    ระบบวันลา
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./index.html" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>ปฏิทินของฉัน</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./index2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>ยื่นวันลา</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview menu-close">
                <a href="#" class="nav-link active bg-info">
                  <i class="nav-icon fas fa-car"></i>
                  <p>
                    ระบบขอใช้รถราชการ
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./index.html" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>ปฏิทินของฉัน</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./index2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>ยื่นขอใช้รถ</p>
                    </a>
                  </li>
                </ul>
              </li>



          <li class="{{ Request::is('risk*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview menu-close' }}">
            <a href="#" class="nav-link active bg-danger">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                ระบบบริหารความเสี่ยง
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('risk.index') }}" class="{{ Request::is('risk') ? 'nav-link active' : 'nav-link' }}" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>ประวัติการรายงานความเสี่ยง</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('risk.create') }}" class="{{ Request::is('risk/create') ? 'nav-link active' : 'nav-link' }}" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>รายงานความเสี่ยง</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active bg-primary">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                ระบบจัดการตัวชี้วัด
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>############</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>############</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>############</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="{{ Request::is('bookstores*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview menu-close' }}">
            <a href="#" class="nav-link active bg-warning">
              <i class="nav-icon fas fa-book"></i>
              <p>
                ระบบจัดการสื่อฯ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('bookstores.create') }}" class="{{ Request::is('bookstores/create*') ? 'nav-link active' : 'nav-link' }}" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>เพิ่มรายการสื่อสิ่งพิมพ์</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('bookstores.index') }}"  class="{{ Request::is('bookstores') ? 'nav-link active' : 'nav-link' }}" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>รายการสื่อสิ่งพิมพ์</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="{{ Request::is('bookstores*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview menu-close' }}">
            <a href="#" class="nav-link active bg-warning">
              <i class="nav-icon fas fa-book"></i>
              <p>
                ระบบเบิกสื่อฯ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('bookstores.action') }}" class="{{ Request::is('bookstores/action') ? 'nav-link active' : 'nav-link' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>เบิกสื่อสิ่งพิมพ์</p>
                </a>
              </li>
              <li class="nav-item"> 
                <a href="{{ route('bookstores.old_order')}}" class="{{ Request::is('bookstores/old_order*') ? 'nav-link active' : 'nav-link' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ประวัติการเบิก</p>
                </a>
              </li>

              
    
            </ul>
          </li>


         
          <li class="nav-header">ระบบอื่นๆ</li>
          <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                ปฏิทินหน่วยงาน
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="http://mhc12.go.th/PHP_CODE/borrow/" target="_blank" class="nav-link">
              <i class="nav-icon fas fa-laptop-house"></i>
              <p>
                ระบบยืม-คืนอุปกรณ์
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="http://mhc12.go.th/finalcial/" target="_blank" class="nav-link">
              <i class="nav-icon fas fa-calculator"></i>
              <p>
                ระบบออกเลขหนังสือ
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                ฐานข้อมูลเขตสุขภาพ
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="https://datastudio.google.com/u/0/reporting/5ef489be-7e2a-49b3-b63b-8df43aba1c3d/page/oVv5B" target="_blank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูล จังหวัด-อำเภอ-ตำบล</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="https://datastudio.google.com/u/0/reporting/5ef489be-7e2a-49b3-b63b-8df43aba1c3d/page/zuv5B" target="_blank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลโรงเรียนในเขตสุขภาพ</p>
                </a>
              </li>    
            </li>
            <li class="nav-item">
              <a href="https://datastudio.google.com/u/0/reporting/5ef489be-7e2a-49b3-b63b-8df43aba1c3d/page/r4v5B" target="_blank" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>สถานบริการสุขภาพ</p>
              </a>
            </li>    
            </ul>
          </li>
        
          <li class="nav-header">Logout</li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">ออกจากระบบ</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <br>
  
   @yield('content')
  
  </div>
  <!-- /.content-wrapper -->
  <footer id="sticky-footer" class="py-3 bg-dark text-white-50">
    <div class="container text-center">
      <small>Copyright &copy; Mentalhealth Center 12th</small>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>

<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
</body>
</html>
