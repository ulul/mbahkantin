<?php require_once("php/include/Class.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SI.Kantin</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Nuzulul Huda">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.css" rel="stylesheet">
  <link href="assets/css/index.css" rel="stylesheet">
</head>
<body class="cbp-spmenu-push">
<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
      <h4>Register Kantin Baru <span title="close" style="float:right; margin-right:20px; margin-top:3px;" class="pointer fa  fa-close" id="close-collapse"> </span></h4>
     

      <p><input type="text" class="form-control" placeholder="Email"></p>
      <p> <button class="btn btn-primary">Register</button> </p>
    </nav>
<!--Include file header -->
<?php if (file_exists("php/view/header.php")) {
	require_once("php/view/header.php");
}else{
	echo "Oops file header.php tidak dapat di temukan";
	}?>
<!-- /Include file header -->

<!--Container -->
<div class="container" id="master">
	<div class="col-lg-3" ></div>
<!--flashdata -->	
	<div class="col-lg-6" style="  margin-top:80px;" id="kosong">
		<?php get_flashdata("error_akun");
		 ?>
	</div>
<!--/flashdata -->

<!--Search -->		
	<div class="col-lg-12" style="margin-bottom:20px;">
		<input id="cari" type="text" class="form-control" placeholder="Cari menu" onkeyup="cari()" autocomplete="off">
	</div>
<!--/Search -->	


<!--Content -->
         <div id="loop"></div>
<!--/Content -->

 <!--cart -->    
    <div class="chart" onclick="lihat_chart()">
      <img src="<?php echo base_url("upload/icon/cart-icon.png");?>">
    </div>

    <span class="badge-cart badge" id="jumlah_chart"><?php if(isset($_SESSION["keranjang"])){ echo count($_SESSION["keranjang"]);}else{ echo "0"; }?></span>
 
<!--/cart -->  
    
<!-- Modal -->
  <?php if (file_exists("php/view/modal_chart.php")) {
  require_once("php/view/modal_chart.php");
}else{
  echo "Oops file modal_chart.php tidak dapat di temukan";
  }?>
<!--/Modal -->
</div>
<!--/Container -->

</body>
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/index.js"></script>
<script type="text/javascript" src="assets/js/classie.js"></script>
<script>
var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
body = document.body;
        $(document).ready(function() {
            var hash = window.location.hash;
            if (hash !="") {
                var res = hash.split("-");
                var url = res[1];
                if (url>0) {
                    paging(url);
                }else{
                    paging(1);
                }
            }else{
                paging(1);
            }
            setTimeout(function() {
        classie.toggle( menuLeft, 'cbp-spmenu-open' );
      }, 3000);
        
        });
        $("#close-collapse").click(function(){
          classie.toggle( menuLeft, 'cbp-spmenu-open' );
        })
        function paging(limit){
            $("#loop").html("<center><img src='upload/icon/ajax-loader.gif'></center>");
            setTimeout(function() {
                $.ajax({
                url:"ajax/post/paging.php",
                type:"POST",
                data:"limit="+limit,

                success:function(data){
                    $("#loop").html(data).show();
                },
                error:function(XMLHttpRequest, textStatus, errorThrown){
                	alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }
            });
            }, 1500);
        }
        
        
       
    </script>

</html>