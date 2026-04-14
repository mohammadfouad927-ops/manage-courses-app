<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>@yield('title','Course Management')</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('admin-dashboard/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('admin-dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin-dashboard/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
        /* Add a subtle hover effect to rows */
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.02);
            transition: background-color 0.2s ease;
        }

        .table thead th {
          letter-spacing: 0.05em;
          font-size: 0.75rem;
        }

        /* Soft Badge Colors */
        .bg-soft-success { background-color: rgba(40, 167, 69, 0.1) !important; color: #28a745 !important; }
        .bg-soft-warning { background-color: rgba(255, 193, 7, 0.1) !important; color: #ffc107 !important; }
        .bg-soft-info { background-color: rgba(23, 162, 184, 0.1) !important; color: #17a2b8 !important; }
        .bg-soft-danger { background-color: rgba(220, 53, 69, 0.1) !important; color: #dc3545 !important; border: 1px solid rgba(220, 53, 69, 0.2); /* Optional: adds a thin subtle border */}
        /* Vertical Alignment for clean spacing */
        .align-middle { vertical-align: middle !important; }
         /* 2. Soft Badge Styling */
        .badge-soft-info {
            background-color: rgba(23, 162, 184, 0.1) !important;
            color: #17a2b8 !important;
            font-weight: 500;
            border-radius: 4px;
        }
        
        /* Soft Badges */
      .badge-soft-success {
          background-color: rgba(40, 167, 69, 0.12);
          color: #28a745;
          border: 1px solid rgba(40, 167, 69, 0.2);
      }

      .badge-soft-secondary {
          background-color: rgba(108, 117, 125, 0.1);
          color: #6c757d;
          border: 1px solid rgba(108, 117, 125, 0.2);
      }

      .border-2 { border-width: 2px !important; }
    
      /* Make the switches look more modern */
      .custom-control-label::before {
          background-color: #dee2e6;
          border: none;
      }
      
      .custom-switch .custom-control-input:checked ~ .custom-control-label::before {
          background-color: #28a745;
      }

      .form-control:focus {
          border-color: #007bff;
          box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.05);
      }

        /* 3. Button Group Look */
        .btn-white {
            background-color: #ffffff;
            border-color: #dee2e6;
        }
        .btn-white:hover {
            background-color: #f8f9fa;
        }
        
        .btn-group .btn {
          padding: 0.375rem 0.75rem;
        }

        .gap-1 { gap: 0.25rem; } /* Helpful for spacing out badges */

        /* 5. Modal Refinement */
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .modal-header {
            border-bottom: 1px solid #f8f9fa;
        }
        /* 1. Improved Modal Radius */
        .modal-content {
            border-radius: 15px !important;
            overflow: hidden;
        }

        /* 2. Soft Danger Button (for the X) */
        .btn-soft-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: none;
            transition: all 0.2s;
        }
        .btn-soft-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }

        /* 3. Focus effect for inputs */
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.1);
        }

        /* 4. Align the close button properly in BS4 */
        .modal-header .close {
            padding: 1rem;
            margin: -1rem -1rem -1rem auto;
        }

        /* 5. Custom select arrow fix (prevents ::after bug) */
        .custom-select::after {
            display: none !important;
            content: none !important;
        }

        .invalid-feedback {
        font-size: 85%;
        color: #dc3545;
        margin-top: 0.4rem;
        }

        /* Highlight the input border more clearly */
        .form-control.is-invalid {
            border-color: #dc3545 !important;
            background-image: none; /* Removes the default Bootstrap checkmark/X */
        }

        /* Keep the input group icons red if there's an error */
        .is-invalid ~ .input-group-append .input-group-text,
        .border-danger {
            border-color: #dc3545 !important;
        }
        
      </style>
        @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('admin-dashboard/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('admin-dashboard/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('admin-dashboard/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
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
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('admin-dashboard/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin-dashboard/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('courses.index')}}" class="nav-link @if(request()->routeIs('courses.*'))active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Courses
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('students.index')}}" class="nav-link @if(request()->routeIs('students.*'))active @endif">
            <i class="far fa-circle nav-icon"></i>
              <p>
                Students
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                enrollments
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('programs.index')}}" class="nav-link @if(request()->routeIs('programs.*'))active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Programs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('program-sessions.index')}}" class="nav-link @if(request()->routeIs('program-sessions.*'))active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Program Sessions
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('branches.index')}}" class="nav-link @if(request()->routeIs('branches.*'))active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Branches
              </p>
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('title','Course Management')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">@yield('path','')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      @yield('content')<!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0-rc.1
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('admin-dashboard/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('admin-dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('admin-dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin-dashboard/dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('admin-dashboard/dist/js/demo.js')}}"></script>
@stack('scripts')


<!-- PAGE SCRIPTS -->
<script src="{{asset('admin-dashboard/dist/js/pages/dashboard2.js')}}"></script>
</body>
</html>
