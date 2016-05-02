<?php 
require_once("php/include/Class.php");
require_once("php/include/PHPExcel/Classes/PHPExcel.php");
require_once("php/include/PHPExcel/Classes/PHPExcel/IOFactory.php");
if (isset($_SESSION["ID_LEVEL"])) {
    if ($_SESSION["ID_LEVEL"]==1) {
      $id_user = $_SESSION["ID_USER"];
      $data = Query::builder("SELECT * FROM user WHERE ID_USER=$id_user");
      
      set_li_active("admin");
      set_status_user();
    }else{
      header("location:index.php");
    }
}else{
  header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="assets/css/index.css">

  <link rel="stylesheet" href="assets/css/dataTables.bootstrap.css">
 
  <link rel="stylesheet" href="assets/css/bootstrap.css">

  <link rel="stylesheet" href="assets/css/datepicker.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/css/font-awesome.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/css/_all-skins.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-timepicker.css">

</head>
<body class="hold-transition skin-blue sidebar-mini fixed" <?php if($_SESSION['li_active'] == "laporan"){?> onload="buka_tgl()" <?php } ?>>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a class="pointer logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LTE</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

         
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="assets/img/admin.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo ucwords($data[0]["USERNAME"]);?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="assets/img/admin.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo ucwords($data[0]["USERNAME"]);?>
                  
                </p>
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
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

      <div class="user-panel">
        <div class="pull-left image">
          <img src="assets/img/admin.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ucwords($data[0]["USERNAME"]);?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"></li>
        <li<?php li_active("dashboard"); ?>>
          <a href="<?php echo base_url("admin.php");?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
          </a>
          
        </li>
        <li<?php li_active("user"); ?>>
          <a href="<?php echo base_url("admin.php?page=user");?>">
            <i class="fa fa-user"></i> <span>Manage User</span> 
          </a>
          
        </li>
        <li<?php li_active("tambah_kantin"); ?>>
          <a href="<?php echo base_url("admin.php?page=tambah_kantin");?>">
            <i class="fa fa-plus"></i> <span>Tambah Kantin</span> 
          </a>
          
        </li>
        <li<?php li_active("laporan"); ?>>
          <a href="<?php echo base_url("admin.php?page=laporan");?>">
            <i class="fa fa-book"></i> <span>Laporan</span> 
          </a>
          
        </li>
        <li<?php li_active("general"); ?>>
          <a href="<?php echo base_url("admin.php?page=general");?>">
            <i class="fa fa-cog"></i> <span>Pengaturan Sistem</span> 
          </a>
          
        </li>

       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("admin.php");?>">
        <?php echo breadcrumb();?>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
       
         <?php if (isset($_SESSION["li_active"])) {
    if ($_SESSION["li_active"] == "dashboard") {
      ?>
        <!-- ./col -->
        <div id="admin_get"></div>
        <?php } } ?>
        <!-- ./col -->
       
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-12 connectedSortable">

         <?php if (Input::get("page")) {
           $file = "php/view/admin/".Input::get("page", true).".php";
           if (file_exists($file)) {
             require_once($file);
           }else{
            require_once("php/view/error/404.php");
           }
         }else{
          if (file_exists("php/view/admin/dashboard.php")) {
            require_once("php/view/admin/dashboard.php");
          }else{
            require_once("php/view/error/404.php");
          }
          }?>

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Sistem Informasi Kantin</strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<div class="modal fade modal-default" id="modalError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="labelHeader"></h4>
      </div>
      <div class="modal-body" id="mes">
        ...
      </div>
      <div class="modal-footer">
        <div id="btn-href"></div>
      </div>
    </div>
  </div>
</div>
<!-- jQuery 2.1.4 -->
<script src="assets/js/jQuery-2.1.4.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>

<!-- Bootstrap 3.3.5 -->
<script src="assets/js/bootstrap.min.js"></script>
<!--<script src="assets/js/moment.js"></script>-->

<?php
if ($_SESSION["li_active"] == "laporan") {
  echo '<script src="assets/js/datepicker.js"></script>';
}
 ?>


<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap.min.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/js/bootstrap-timepicker.js"></script>

<script>
$(document).ready(function () {
       <?php if (isset($_SESSION["li_active"])) {
    if ($_SESSION["li_active"] == "dashboard") { ?>
      admin_get();
      <?php }} ?>
        $(".only-number").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) ||
            (e.keyCode == 67 && e.ctrlKey === true) ||
            (e.keyCode == 88 && e.ctrlKey === true) ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
        });
        enableBSToppltip: true 
            });
 <?php if (isset($_SESSION["li_active"])) {
    if ($_SESSION["li_active"] == "dashboard") { ?>
 function admin_get(){
  $.ajax({
    type:"GET",
    url:"ajax/get/admin_get.php",
    success:function(data){
      $("#admin_get").html(data).show();
    }
  })
 }
setInterval(function() {
  admin_get();
  }, 3000);
<?php }} ?>
function buka_tgl(){
 $('#date_1').datepicker({
                    format: "yyyy-mm-dd"
                }); 
                $('#date_2').datepicker({
                    format: "yyyy-mm-dd"
                });
}
  function add_kantin(){
    var nama_kantin = $("#nama_kantin").val();
    var no_stand = $("#no_stand").val();
    var no_hp = $("#no_hp").val();
    var max_pesan = $("#max_pesan").val();
    if (nama_kantin != "" && no_hp !="" && no_stand !="") {
      $.ajax({
        type:"POST",
        url:"ajax/post/add_kantin.php",
        data:"nama_kantin="+nama_kantin+"&no_stand="+no_stand+"&no_hp="+no_hp+"&max_pesan="+max_pesan,
        success:function(data){
          if (data =="0") {
            $("#pesan").html('<div role="alert" class="alert alert-danger alert-dismissible fade in"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">×</span></button><strong>Nama Kantin Sudah Ada !</strong></div>').show();
          }else{
            document.location.href="admin.php?page=tambah_kantin";
          }
        }
      })
    }else{
      $("#pesan").html('<div role="alert" class="alert alert-danger alert-dismissible fade in"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">×</span></button><strong>Isi data  lengkap terlebih dahulu !</strong></div>').show();
    }

  }
  function cek_tgl_awal() {
    var tgl_1 = $("#date_1").val();
    var tgl_2 = $("#date_2").val();
    if(tgl_1 != "" && tgl_2 == ""){
      $("#btn-laporan").removeClass("btn");
      $("#btn-laporan").removeClass("btn-danger");
      $("#btn-laporan").removeClass("btn-success");      
      $("#btn-laporan").addClass("btn btn-warning");
    }
     if(tgl_1 != "" && tgl_2 !=""){
      $("#btn-laporan").removeClass("btn");
      $("#btn-laporan").removeClass("btn-danger");
      $("#btn-laporan").removeClass("btn btn-warning");
      $("#btn-laporan").addClass("btn btn-success");
      $("#btn-laporan").removeAttr("disabled");
    }if (tgl_1 =="" && tgl_2 ==""){
      $("#btn-laporan").removeClass("btn");
      $("#btn-laporan").removeClass("btn-success");
      $("#btn-laporan").removeClass("btn-warning");
      $("#btn-laporan").addClass("btn btn-danger");
    }


  }
  function cek_username(){
    $.ajax({
       type:"POST",
      url:"ajax/post/cek_username.php",     
      data:"username="+$("#username_add").val(),
      success:function(data){
        console.log(data);
        if (data==0) {
          $("#save_add").attr("disabled", true);
          $("#error_username").addClass("has-error");
          $("#footer").html('<div role="alert" class="btn  alert-danger alert-dismissible"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">×</span></button><strong>Username sudah ada!</strong></div>').show();
        }else{
          $("#save_add").removeAttr("disabled");
          $("#error_username").removeClass("has-error");
          $("#footer").html("");
        }
      },error:function(XMLHttpRequest, textStatus, errorThrown){
                  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }
    })
  }

  $(function () {
    $('#example2').DataTable({
      responsive: true

    });


  });
  function cek_tgl_akhir(){
     var tgl_1 = $("#date_1").val();
    var tgl_2 = $("#date_2").val();
    if(tgl_2 != "" && tgl_1 == ""){
      $("#btn-laporan").removeClass("btn");
      $("#btn-laporan").removeClass("btn-danger");
      $("#btn-laporan").removeClass("btn-success");
      $("#btn-laporan").addClass("btn btn-warning");
    }
     if(tgl_1 != "" && tgl_2 !=""){
      $("#btn-laporan").removeClass("btn");
      $("#btn-laporan").removeClass("btn-danger");
      $("#btn-laporan").removeClass("btn-warning");
      $("#btn-laporan").addClass("btn btn-success");
      $("#btn-laporan").removeAttr("disabled");

    }if (tgl_1 =="" && tgl_2 ==""){
      $("#btn-laporan").removeClass("btn");
      $("#btn-laporan").removeClass("btn-success");
      $("#btn-laporan").removeClass("btn-warning");
      $("#btn-laporan").addClass("btn btn-danger");
  }
}
   $("#btn-laporan").click(function(){
    var tgl_1 = $("#date_1").val();
    var tgl_2 = $("#date_2").val();
    var id_kantin = $("#id_kantin").val();
      $.ajax({
        type:"POST",
        url:"ajax/post/report.php",
        data:"tgl_1="+tgl_1+"&tgl_2="+tgl_2+"&id_kantin="+id_kantin,
        success:function(data){
          $("#report").html(data).show();
          $('#table-report').DataTable({
              
            });
          $('html, body').animate({
            scrollTop: $("#report").offset().top
        }, 2000);
        },error:function(XMLHttpRequest, textStatus, errorThrown){
                  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }
      });
   })

   $("#save_add").click(function(){

    if ($("#username_add").val()=="" || $("#password_add").val()=="" || $("#id_level").val()=="Level") {
     
          
          $("#footer").html('<div role="alert" class="btn  alert-danger alert-dismissible"><strong>Isi data denngan benar!</strong></div>').show();

    }else{
    $.ajax({
      url:"ajax/post/add_user.php",
      type:"POST",
      data:"username="+$("#username_add").val()+"&password="+$("#password_add").val()+"&level="+$("#id_level").val(),
      success:function(data){
        if (data == 1) {
          document.location.href = "admin.php?page=user"; 
        }else{
          $("#save_add").attr("disabled", true);
          $("#error_username").addClass("has-error");
          $("#footer").html('<div role="alert" class="btn  alert-danger alert-dismissible"><strong>Username sudah ada!</strong></div>').show();

        }
      },error:function(XMLHttpRequest, textStatus, errorThrown){
                  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }
    });
    }
   })
   function laporan(){
    $.ajax({
      url:"ajax/post/report.php",
      type:"POST",
      data:"tgl_1="+""+"&tgl_2="+""+"&id_kantin="+"",
      success:function(data){
        $("#report").html(data).show();
        $('#table-report').DataTable({
              
        });
         $('html, body').animate({
            scrollTop: $("#report").offset().top
        }, 2000);
      },error:function(XMLHttpRequest, textStatus, errorThrown){
                  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }
    });
    
   }
   $(".timepicker1").click(function(){
    $('.timepicker1').timepicker({ 
        showInputs : false,
        defaultTime: '10:00 AM'
    });

   })
      $(".timepicker2").click(function(){
    $('.timepicker2').timepicker({ 
        showInputs : false,
        defaultTime: '10:30 AM'
    });

   })
      function jumlah_stand(){
        var jumlah_stand = $("#jumlah_stand").val();
        if (jumlah_stand <=0) {
          $("#jumlah_stand").val("1");
          $("#jml_stand").addClass("has-error");
          $("#error").html("<div class='alert alert-danger alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>Jumlah Stand harus lebih dari 0!</strong></div>"); 
          $("#save_jml").attr("disabled", true);
          $("#save_jml").removeClass("btn-success");
          $("#save_jml").addClass("btn-danger");
        }else{
          $("#save_jml").addClass("btn-success");
          $("#save_jml").removeClass("btn-danger");
          $("#save_jml").removeAttr("disabled");
          $("#error").html("").show();
          $("#jml_stand").removeClass("has-error");
          $("#jumlah_stand").val(jumlah_stand);
        }
      }
    $("#save_jml").click(function(){
      $.ajax({
        type:"POST",
        url:"ajax/post/jml_stand.php",
        data:"jml_stand="+$("#jumlah_stand").val(),
        success:function(data){
          console.log(data);
          if (data == 1) {
            $("#alert").html("<div class='alert alert-success alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>Jumlah Stand telah di perbaharui !</strong></div>"); 
          }
        },error:function(XMLHttpRequest, textStatus, errorThrown){
                  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }
      })
    })
    function cek_level(){
      var level = $("#id_level").val();
      if (level == 2) {
        
      }
    }
    function set_time1(){
      var time1 = $("#time1").val();
      var time2 = $("#time2").val();
      if (time1 != "" && time2 =="") {
        $("#btn-waktu").removeClass("btn-success");
        $("#btn-waktu").removeClass("btn-danger");
        $("#btn-waktu").addClass("btn-warning");
        $("#btn-waktu").attr("disabled", true);
      }else if(time1 !="" && time2 !=""){
        $("#btn-waktu").removeAttr("disabled");
        $("#btn-waktu").addClass("btn-success");
        $("#btn-waktu").removeClass("btn-danger");
        $("#btn-waktu").removeClass("btn-warning");
      }else if(time1 =="" && time2 ==""){
        $("#btn-waktu").attr("disabled", true);
        $("#btn-waktu").removeClass("btn-success");
        $("#btn-waktu").addClass("btn-danger");
        $("#btn-waktu").removeClass("btn-warning");
      }
    }
    function set_time2(){
      var time1 = $("#time1").val();
      var time2 = $("#time2").val();
      if (time2 != "" && time1 =="") {
        $("#btn-waktu").removeClass("btn-success");
        $("#btn-waktu").removeClass("btn-danger");
        $("#btn-waktu").addClass("btn-warning");
        $("#btn-waktu").attr("disabled", true);
      }else if(time2 !="" && time1 !=""){
        $("#btn-waktu").addClass("btn-success");
        $("#btn-waktu").removeClass("btn-danger");
        $("#btn-waktu").removeClass("btn-warning");
        $("#btn-waktu").removeAttr("disabled");
      }else if(time2 =="" && time1 ==""){
        $("#btn-waktu").attr("disabled", true);
        $("#btn-waktu").removeClass("btn-success");
        $("#btn-waktu").addClass("btn-danger");
        $("#btn-waktu").removeClass("btn-warning");
      }
    }
    $("#btn-waktu").click(function(){
      //alert($("#time2").val());
      $.ajax({
        type:"POST",
        url:"ajax/post/set_waktu.php",
        data:"time1="+$("#time1").val()+"&time2="+$("#time2").val(),
        success:function(data){
          $("#alert").html(data).show();
        }
      })
    })
    function confirm_modal(id, act, username){
      if (act == "delete") {
        btn = "danger";
        href = "Non Aktifkan";
        header = "Non Aktifkan";
        mes = "Apakah anda yakin untuk menonaktifkan user "+username;
      }else if(act == "reset") {
        btn = "danger";
        href = "Reset Password";
        header = "Reset Password User";
        mes = "Apakah anda yakin untuk mereset password user "+username;
      }else if(act == "active"){
        btn = "success";
        href = "Aktifkan";
        header = "Aktifkan User ";
        mes = "Apakah anda yakin untuk mengaktifkan user "+username;
      }else if(act == "hapus"){
        btn = "danger";
        href = "Hapus ";
        header = "Hapus User ";
        mes = "Apakah anda yakin untuk menghapus user "+username;
      }
      $("#btn-href").html("<a class='btn btn-"+btn+" btn-flat'  href='http://localhost/ta/admin.php?page="+act+"&&id="+id+"'>"+href+"</a>");
      
      $("#labelHeader").html(header).show();
      $("#mes").html(mes).show();
      $("#modalError").modal("show");
      
    }
</script>
</body>
</html>
