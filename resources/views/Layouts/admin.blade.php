<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lectura | www.club.com</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="/Libro" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>C</b>L</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Club de Lectura </b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
           <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <small class="bg-red">Online</small>
                  <span class="hidden-xs">admin</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Adiministracion</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li> 
                        <li class="treeview">
                            <a href="#">
                              <i class="fa fa-laptop"></i>
                              <span>Libro</span>
                              <i class="fa fa-angle-left pull-right"></i>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="{{url('Libro')}}"><i class="fa fa-circle-o"></i>Libros </a></li>
                            <li><a href="{{url('Editorial')}}"><i class="fa fa-circle-o"></i>Editoriales</a></li>
                            <li><a href="{{url('Clase')}}"><i class="fa fa-circle-o"></i>Clases</a></li>
                          </ul>
                      </li>
              </li>
              <li>
                          <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Miembros</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                          <ul class="treeview-menu">
                              <li><a href="{{url('Lector')}}"><i class="fa fa-circle-o"></i>Lectores </a></li>
                              <li><a href="{{url('Representante')}}"><i class="fa fa-circle-o"></i>Representantes </a></li>
                          </ul>
                          
                          </li>
                
                </li>
                <li> 
                         <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Instituciones</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                          <ul class="treeview-menu">
                              <li><a href="{{url('Club')}}"><i class="fa fa-circle-o"></i>Clubes </a></li>
                              <li><a href="{{url('Institucion')}}"><i class="fa fa-circle-o"></i> Institucion </a></li>
                          </ul>
                          
                          </li>
                </li>
              </ul>
            </li>

            
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Eventos</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('Obra')}}"><i class="fa fa-circle-o"></i>Obras</a></li>
                <li><a href="{{url('Reunion')}}"><i class="fa fa-circle-o"></i> Reuniones</a></li>
              </ul>
            </li>


                       
           
       
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                 
                  <div class="box-tools pull-right">
                  
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                          <!--Contenido-->
                              @include('flash-message')

                              @yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>

      </footer>

      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    
  </body>
</html>
