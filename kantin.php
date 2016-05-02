<?php require_once("php/include/Class.php");

$pesanan1 = Query::builder("SELECT * FROM view_pesanan WHERE STATUS=0");
if ($pesanan1) {
    foreach ($pesanan1 as $data ) { 
        $date1=date_create($data["TGL"]);
        $date2=date_create(date("Y-m-d"));
        $cek = date_diff($date1, $date2);
        if ($cek->format("%a") >=1) {
        $i = $data["ID_USER"];
        $j = $data["ID"];
        Query::builder("UPDATE user SET STATUS=0 WHERE ID_USER='$i'");
        Query::builder("UPDATE pesanan SET STATUS=100 WHERE ID='$j'");
        }
    }    
}

if (isset($_SESSION["ID_LEVEL"])) {
    if ($_SESSION["ID_LEVEL"]==2) {
      $id_user = $_SESSION["ID_USER"];
      $data = Query::builder("SELECT * FROM user WHERE ID_USER=$id_user");
      set_li_active("kantin");
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
  <title>Kantin Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="assets/css/index.css">

  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap.css">
 
  

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



  <!-- Date Picker -->

</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a class="pointer logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>K</b>LTE</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Kantin</b>LTE</span>
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
              <span class="hidden-xs">  <?php echo str_replace("_", " ", ucwords($data[0]["USERNAME"])); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="assets/img/admin.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo str_replace("_", " ", ucwords($data[0]["USERNAME"])); ?>
                  
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
          <p><?php echo str_replace("_", " ", ucwords($data[0]["USERNAME"])); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"></li>
        <li<?php li_active("dashboard"); ?>>
          <a href="<?php echo base_url("kantin.php");?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
          </a>
          
        </li>
        <li<?php li_active("manage_kantin"); ?>>
          <a href="<?php echo base_url("kantin.php?page=manage_kantin");?>">
            <i class="fa fa-cog"></i> <span>Manage Menu Kantin</span> 
          </a>
          
        </li>
        <li<?php li_active("manage_kantin_data"); ?>>
          <a href="<?php echo base_url("kantin.php?page=manage_kantin_data");?>">
            <i class="fa fa-cog"></i> <span>Manage Kantin</span> 
          </a>
          
        </li>   
        <li<?php li_active("pesanan"); ?>>
          <a href="<?php echo base_url("kantin.php?page=pesanan");?>">
            <i class="fa fa-suitcase"></i> <span>Pesanan</span> 
          </a>
          
        </li>
        <li<?php li_active("pesanan_error"); ?>>
          <a href="<?php echo base_url("kantin.php?page=pesanan_error");?>">
            <i class="fa fa-times-circle"></i> <span>Pesanan Tidak Di Ambil</span> 
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
        <li><a href="<?php echo base_url("kantin.php");?>">
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
        
        <div id="total_pesan"></div>
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
           $file = "php/view/kantin/".Input::get("page", true).".php";
           if (file_exists($file)) {
             require_once($file);
           }else{
            require_once("php/view/error/404.php");
           }
         }else{
          if (file_exists("php/view/kantin/dashboard.php")) {
            require_once("php/view/kantin/dashboard.php");
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
<div class="modal fade modal-danger" id="modalError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Error Edit</h4>
      </div>
      <div class="modal-body" id="mes">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
<div class="modal fade modal-default" id="modalEditKantin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Kantin</h4>
      </div>
      <div class="modal-body" id="mes">
       <div class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="inputEmail3">Nama Kantin</label>

                  <div class="col-sm-10">
                    <input type="text" placeholder="Nama Kantin" id="nama_kantin" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="inputPassword3">No Stand</label>

                  <div class="col-sm-10">
                  <div id="editno_stand"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="inputEmail3">No Hp</label>

                  <div class="col-sm-10">
                    <input type="text" placeholder="No Hp" id="no_hp" class="only-number form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="inputEmail3">Max Pesanan</label>

                  <div class="col-sm-10">
                    <input type="text" placeholder="Maximal melayani pesanan" id="max_pesan" class="only-number form-control">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              
              <!-- /.box-footer -->
            </div>
      </div>
      <div class="modal-footer">
      <input type="hidden" id="id_kantin">
        <button class="btn bg-olive btn-flat" onclick="save_kantin()" type="submit">Save</button>

      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-default" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail Pesanan <span id="username_pemesan"></span></h4>
      </div>
      <div class="modal-body" id="detail_pesanan">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
<div class="modal fade modal-default" id="modalError2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="headerLabel"></h4>
      </div>
      <div class="modal-body" id="message">
        ...
      </div>
      <div class="modal-footer">
        <div id="btn-href"></div>
      </div>
    </div>
  </div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="assets/js/jQuery-2.1.4.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>

<!-- Bootstrap 3.3.5 -->
<script src="assets/js/bootstrap.min.js"></script>
<!--<script src="assets/js/moment.js"></script>-->



<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap.min.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/js/bootstrap-timepicker.js"></script>
<script>
 $(document).ready(function() {
 	<?php if (isset($_SESSION["li_active"])) {
    if ($_SESSION["li_active"] == "dashboard") { ?>
 	get_pesanan_baru();
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
});
 function save_kantin(){
 	var id_kantin = $("#id_kantin").val();
 	var nama_kantin = $("#nama_kantin").val();
 	var no_stand = $("#no_stand").val();
 	var no_hp = $("#no_hp").val();
  	var max_pesan = $("#max_pesan").val();
 	$.ajax({
 		url:"ajax/post/save_kantin.php",
 		type:"POST",
 		data:"id_kantin="+id_kantin+"&nama_kantin="+nama_kantin+"&no_stand="+no_stand+"&no_hp="+no_hp+"&max_pesan="+max_pesan,
 		success:function(data){
 			if (data == 0) {
 				document.location.href= 'kantin.php?page=manage_kantin_data&&update=true';
 			}else{
 				alert(data);
 			}
 		}
 	})
 }
 function show_modal_update(id){
 	
  $.ajax({
    url:"ajax/post/kantin_json.php",
    type:"POST",
    dataType:"JSON",
    data:"id_kantin="+id,
    success:function(data){
      console.log(data);
      $("#id_kantin").val(data["ID_KANTIN"]);
      $("#nama_kantin").val(data["NAMA_KANTIN"]);
      $("#no_stand").val(data["NO_STAND"]);
      $("#no_hp").val(data["NO_TELP"]);
      $("#max_pesan").val(data["max_pesan"]);
      $("#modalEditKantin").modal("show");
      $.ajax({
    		url:"ajax/post/no_stand.php",
		    type:"POST",
		    data:"id_kantin="+id,
		    success:function(a){
		    	$("#editno_stand").html(a).show();
		    }
    	})
    }
  })
 }
 <?php if (isset($_SESSION["li_active"])) {
    if ($_SESSION["li_active"] == "dashboard") { ?>
 function get_pesanan_baru(){
 	$.ajax({
 		type:"GET",
 		url:"ajax/get/total_pesan.php",
 		success:function(data){
 			$("#total_pesan").html(data).show();
 		}
 	})
 }
setInterval(function() {
	get_pesanan_baru();
  }, 3000);
<?php }} ?>
function onlynum(){
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
}
  function show_confirm_dialog(identified, href, mes){
      if (identified == 'reset') {
        $("#message").html(mes);
        $("#headerLabel").html("Reset jumlah layanan pesan semua kantin");
        $("#btn-href").html("<a class='btn btn-warning btn-flat' href='kantin.php?page=manage_kantin_data&&"+href+"'>Reset</a>");
      }else if (identified == 'delete') {
        $("#message").html(mes);
        $("#headerLabel").html("Delete kantin");
        $("#btn-href").html("<a class='btn btn-danger btn-flat' href='kantin.php?page=manage_kantin_data&&"+href+"'>Delete</a>");
      }else if (identified == 'non_aktif') {
        $("#message").html(mes);
        $("#headerLabel").html("Non Aktifkan kantin");
        $("#btn-href").html("<a class='btn btn-danger btn-flat' href='kantin.php?page=manage_kantin_data&&"+href+"'>Non Aktifkan</a>");
      }else if (identified == 'aktif') {
        $("#message").html(mes);
        $("#headerLabel").html("Aktifkan kantin");
        $("#btn-href").html("<a class='btn btn-success btn-flat' href='kantin.php?page=manage_kantin_data&&"+href+"'>Aktifkan</a>");
      }
      
      $("#modalError2").modal('show');
  }
 function show_detail(id, username_pemesan){
  $.ajax({
    url:"ajax/post/detail_pesanan.php",
    type:"POST",
    data:"id_pesanan="+id,
    success:function(data){
      $("#detail_pesanan").html(data);
    }
  })
  $("#username_pemesan").html(username_pemesan);
  $("#modalDetail").modal("show");
 }
 function modal_error(alert){
 	$("#mes").html(alert).show();
 	$("#modalError").modal("show");
 }	
 function show_update(id_menu){
 	$.ajax({
 		type:"POST",
 		url:"ajax/post/json_menu.php",
    dataType:"JSON",
 		data:"id_menu="+id_menu,
 		success:function(data){
      $("#nama_menu_edit").val(data["NAMA_MENU"]);
      $("#harga_edit").val(data["HARGA"]);
      $("#harga_edit").addClass("only-number");
      $("#jenis_edit").val(data["JENIS"]);
      $("#kantin_edit").val(data["ID_KANTIN"]);
      $("#id_edit").val(data["ID_MENU"]);
 			console.log(data);
 		}
 	})
 	$("#modalEdit").modal("show");
 }	
 <?php
if (isset($_SESSION["buka"])) { 
  ?>
  select_kantin(<?php echo $_SESSION['buka']; ?>)
  <?php
$_SESSION["buka"] = null;
}
  ?>

 function select_kantin(id_kantin2){
      var id_kantin = $("#id_kantin").val();
      if (id_kantin !="") {
        
            $("#data_kantin").html("<center><img style='margin-top:20px;' src='upload/icon/ajax-loader.gif'></center>");
            setTimeout(function() {
                $.ajax({
                url:"ajax/post/data_kantin.php",
                type:"POST",
                data:"ID_KANTIN="+id_kantin,

                success:function(data){

                    $("#data_kantin").html(data).show();
                },
                error:function(XMLHttpRequest, textStatus, errorThrown){
                  modal_error(textStatus+" "+errorThrown); 
                  
                }
            });
            }, 1500);
         
      }else if(id_kantin =="" && id_kantin2 !=""){
              $("#data_kantin").html("<center><img style='margin-top:20px;' src='upload/icon/ajax-loader.gif'></center>");
            setTimeout(function() {
                $.ajax({
                url:"ajax/post/data_kantin.php",
                type:"POST",
                data:"ID_KANTIN="+id_kantin2,

                success:function(data){
                   $("#id_kantin").val(id_kantin2);
                    $("#data_kantin").html(data).show();
                },
                error:function(XMLHttpRequest, textStatus, errorThrown){
                  modal_error(textStatus+" "+errorThrown); 
                  
                }
            });
            }, 1500);
      } 
    }
    function hapus(id_menu){
      if (id_menu !="") {
      $.ajax({
        url:"ajax/post/hapus_menu.php",
        type:"POST",
        data:"ID_MENU="+id_menu,
        success:function(data){
        	var res = data.split("##");
          $("#ganti"+id_menu).html(res[0]).show();
          $("#ganti_edit"+id_menu).html(res[1]).show();

        },
         error:function(XMLHttpRequest, textStatus, errorThrown){
          	modal_error(textStatus+" "+errorThrown); 
        }
      })
    }
    }
    function aktifkan(id_menu){
      if (id_menu !="") {
      $.ajax({
        url:"ajax/post/aktif_menu.php",
        type:"POST",
        data:"ID_MENU="+id_menu,
        success:function(data){
 		 $("#ganti_edit"+id_menu).html('<button onclick="show_update('+id_menu+')" aria-hidden="true" class="edit btn btn-warning glyphicon glyphicon-edit "></button>').show();
          $("#ganti"+id_menu).html(data).show();
         
        },
         error:function(XMLHttpRequest, textStatus, errorThrown){
          	modal_error(textStatus+" "+errorThrown);  
        }
      })
    }

    }
     $(function () {
    $('#example2').DataTable({
      responsive: true

    });
        $('#kantin_data').DataTable({
      responsive: true

    });


  });
     function pesanan_nol(){
     	$.ajax({
     		type:"GET",
     		url:"ajax/get/pesanan_nol.php",
     		success:function(data){
     			$("#pesanan").html(data).show();
     			 $('#example2').DataTable({
				      responsive: true

				    });
     		},
         error:function(XMLHttpRequest, textStatus, errorThrown){
          	modal_error(textStatus+" "+errorThrown); 
        }
     	})

     }
     function pesanan_seratus(){
      $.ajax({
        type:"GET",
        url:"ajax/get/pesanan_seratus.php",
        success:function(data){
          $("#pesanan_seratus").html(data).show();
           $('#example2').DataTable({
              responsive: true

            });
        },
         error:function(XMLHttpRequest, textStatus, errorThrown){
            modal_error(textStatus+" "+errorThrown); 
        }
      })

     }
     function update_pesanan(id){
     	if (id!="") {
     		$.ajax({
     			
     			url:"ajax/post/update_pesanan.php",
     			type:"POST",
     			data:"ID_PESANAN="+id,
     			success:function(data){
     				$("#pesan").html("<center><img src='upload/icon/ajax-loader.gif'></center>");
     				setTimeout(function(){
     					$("#pesan").html(data).show();
     					pesanan_nol();
     				}, 1000);
     				
     			},
         error:function(XMLHttpRequest, textStatus, errorThrown){
         	modal_error(textStatus+" "+errorThrown); 
        }
     		})
     	}
     }
 
</script>
