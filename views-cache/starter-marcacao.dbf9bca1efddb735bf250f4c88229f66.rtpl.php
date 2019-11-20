<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ponto</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/res/bootstrap/css/bootstrap.min.css">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/res/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.

  -->

  <link rel="stylesheet" href="/res/dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" style=" background: #ffffff" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini" style="color:#ccbc0c"><b>P</b></span>
      <!-- logo for regular state and mobile devices -->      
      <span class="logo-lg" style="color:#ccbc0c"><b>Ponto</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#">
              <span class="hidden-xs"><?php echo htmlspecialchars( $user["name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="/admin/logout"><i class="fa  fa-power-off"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image"> 
          <br>
        </div>
        <div class="pull-left info">
          <p>Olá, <?php echo htmlspecialchars( $user["login"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>    
        <li class="">    
       
    <!--      <a href="/admin/starter"> <i class="fa fa-cogs"></i> <span>Controle de Usuarios</span></a>
          <ul class="treeview-menu">
            <li class=""><a href="/admin/starter"><i class="fa fa-user"></i> <span>Usuários</span></a></li> 
            </ul>  -->
             <?php if( $user["inadmin"] == 1 ){ ?>

             <a href="/admin/starter"> <i class="fa fa-cogs"></i> <span>Administrativo</span></a>
          <ul class="treeview-menu">
            <li ><a href="/admin/starter"><i class="fa fa-user"></i> <span>Usuários</span></a></li> 
            </ul>
          </li>
          
            <li class="active treeview">
             <a href="/admin/starter"> <i class="fa fa-cogs"></i> <span>Controle de Horas</span></a>
             <ul class="treeview-menu">   
            <li class="active"><a href="/admin/starter/marcacao"><i class="fa fa-users"></i> <span>Marcação</span></a></li> 
            <li class=""><a href="/admin/starter/relatorios"><i class="fa fa-users"></i> <span>Relatórios</span></a></li>    
            </ul>
      </ul>
    </li>
      <!-- /.sidebar-menu -->
      <?php } ?>

    </section>
    <!-- /.sidebar -->
  </aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Horas/Dia
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="table-responsive">
      <div class="table-responsive box box-primary" > 
            <div class="box-header">
              <a href="/admin/starter/create" class="btn btn-lapin col-md-2 col-xs-4">Marcação Manual</a>
              <form role="form" action="/admin/starter" method="post">
             </form>
            </div>

              <form >
              <div class="box-footer" >
              <a href="/admin/hora/entrada" class="btn btn-sm  btn-success "> Entrada</a>  
              <a href="/admin/hora/saida_almoco" class="btn btn-sm  btn-success "> Saida Almoço</a> 
              <a href="/admin/hora/retorno_almoco" class="btn btn-sm  btn-success "> Retorno Almoço</a>
              <a href="/admin/hora/saida" class="btn btn-sm  btn-success "> Saida</a>      
            
          </div>
              </form>

            <div class="box-body no-padding">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Data</th>
                    <th>Entrada</th>
                    <th>Saída Almoço</th>
                    <th>Retorno Almoço</th>
                    <th>Saída</th>
                    <th>Total de horas/dia</th>

                    
                  </tr>
                </thead>
                <tbody>
                  
                  <tr>
                    
                    <td><?php echo htmlspecialchars( $data, ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                   
                    <td><?php echo htmlspecialchars( $horas["entrada"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $horas["saida_almoco"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $horas["volta_almoco"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $horas["saida"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $total["total_horas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    
                  </tr>
              
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- SELCT SEARCH -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<!-- jQuery 2.2.3 -->
<script src="/res/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/res/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/res/dist/js/app.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
  <script type="text/javascript">
    var largura = window.innerWidth;
    if (largura < 400) {
      document.getElementById('novo').innerHTML='Novo';
      document.getElementById('sel').style.fontSize='8pt';
      document.getElementById('novo').style.fontSize='9pt';
      document.getElementById('pesquisa').style.fontSize='8pt';
      document.getElementById('botao').style.fontSize='9pt';
    }

  </script>
</body>
</html>