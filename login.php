<?php require_once("php/include/Class.php"); 
if (isset($_SESSION["ID_LEVEL"])) {
    if ($_SESSION["ID_LEVEL"]==1) { 
      header("location:admin.php");
    }elseif ($_SESSION["ID_LEVEL"]==2) {
    	header("location:kantin.php");
    }elseif ($_SESSION['ID_LEVEL']==3) {
    	header("location:index.php");
    }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">

  <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
<div id="pesan"><?php get_flashdata("belum_login");?></div>
  <div class="login-logo">

    <b>Login </b>SI.Kantin
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg" >Login to start your session</p>

    <form  method="post">
      <div class="form-group has-feedback">
        <div id="error_username"><input type="text" class="form-control" id="username" autofocus="" placeholder="Username" onkeyup="cek_username()" ></div>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <div id="error_password"><input type="password" class="form-control" id="password" placeholder="Password"  onkeyup="cek_password()" ></div>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
       
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="login(); return false;">Login</button>
          
        </div>
        <div class="col-xs-6">
        	<a class="btn btn-warning btn-block btn-flat" href="<?php echo base_url();?>">Back</a>
        </div>
        <!-- /.col -->
      </div>
    </form>

   

  </div>
  <!-- /.login-box-body -->
</div>
                    

</body>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script>
	function cek_username(){
		if ($("#username").val() !="") {
			$("#error_username").removeClass("has-error");
		}
	}
	function cek_password(){
		if ($("#password").val() !="") {
			$("#error_password").removeClass("has-error");
		}
	}
	function login() {
		username = $("#username").val();
		password = $("#password").val();
		$("#pesan").html("<center><img src='upload/icon/ajax-loader.gif'></center>");
		
		if (username=='' && password=='') {
			
			$("#error_username").addClass("has-error");
			$("#error_password").addClass("has-error");
			$("#pesan").html("<center><img src='upload/icon/ajax-loader.gif'></center>");
			setTimeout(function(){
				$("#pesan").html("<div class='alert alert-danger alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>Username dan Password kosong</strong></div>");
			},1000)
			
			return false;
		}else if (password=='') {
			
			$("#error_password").addClass("has-error");
			$("#pesan").html("<center><img src='upload/icon/ajax-loader.gif'></center>");
			setTimeout(function(){
				$("#pesan").html("<div class='alert alert-danger alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>Password masih kosong!</strong></div>"); 
			},1000)
			 
			return false;
		}else if (username=='') {
			
			$("#error_username").addClass("has-error");
			$("#pesan").html("<center><img src='upload/icon/ajax-loader.gif'></center>");
			setTimeout(function(){
					$("#pesan").html("<div class='alert alert-danger alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>Username masih kosong!</strong></div>");
			},1000)
			
			return false;
		}else {
		setTimeout(function() {
			$.ajax({
				url: "ajax/post/cek_login.php",
				type:"POST",
				data: "username="+$("#username").val()+"&password="+$("#password").val(),
				success: function(msg){
					console.log(msg);
					if (msg==2) {
						document.location.href="<?php echo base_url('kantin.php');?>";
						return true;
					}else if (msg==1) {
						document.location.href="<?php echo base_url('admin.php');?>";
						return true;
					}else if(msg==3){
						document.location.href="<?php echo base_url('index.php');?>";
						$("#kosong").html("").show();
						return true;
					}else if(msg==31){
						document.location.href="<?php echo base_url('checkout.php');?>";
						return true;
					}else if(msg==5){

						var pesan = "<div class='alert alert-danger alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>Akun dalam keadaan tidak aktif !</strong></div>";
						$("#error_password").addClass("has-error");
						$("#error_username").addClass("has-error");
						$("#pesan").html(pesan);
					}
					else{
						$("#error_password").removeClass("has-success");
						$("#error_username").removeClass("has-success");
						$("#error_password").addClass("has-error");
						$("#error_username").addClass("has-error");
						var pesan = "<div class='alert alert-danger alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>Error Username atau Password!</strong></div>";
						$("#pesan").html(pesan);
						return false;
					}
				},
                error:function(XMLHttpRequest, textStatus, errorThrown){
                	alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }

			})
		},1000);
	}
	console.clear();
	}

</script>
</html>