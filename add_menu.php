<?php
require_once("php/include/Class.php");
function ak_img_resize($target, $newcopy, $w, $h, $ext) {
	list($w_orig, $h_orig) = getimagesize($target);
	$scale_ratio = $w_orig / $h_orig;
	if (($w / $h) > $scale_ratio) {
		$w = $h * $scale_ratio;
	}else{
		$h = $w / $scale_ratio;
	}
	$img = "";
	$ext = strtolower($ext);
	if($ext =="png"){ 
		$img = imagecreatefrompng($target);
	}else{ 
		$img = imagecreatefromjpeg($target);
	}
	$tci = imagecreatetruecolor($w, $h);
	imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
	imagejpeg($tci, $newcopy, 80);
	unlink($target);
}
if (Input::post("nama_menu") AND Input::post("harga") AND Input::post("kantin")) {
if (Input::post("nama_menu", true) != "" AND Input::post("harga", true) != "" AND Input::post("kantin", true) != "") {
$fileName = $_FILES["uploaded_file"]["name"]; 
$fileTmpLoc = $_FILES["uploaded_file"]["tmp_name"]; 
$fileType = $_FILES["uploaded_file"]["type"]; 
$fileSize = $_FILES["uploaded_file"]["size"];
$fileErrorMsg = $_FILES["uploaded_file"]["error"]; 
$kaboom = explode(".", $fileName);
$fileExt = end($kaboom);

if (!$fileTmpLoc) { 
    $pesan = "ERROR: Please browse for a file before clicking the upload button.";
    $err = 1;
} else if($fileSize > 5242880) { 
    $pesan = "ERROR: Your file was larger than 5 Megabytes in size.";
    unlink($fileTmpLoc); 
    $err = 1;
} else if (!preg_match("/.(jpeg|jpg|png)$/i", $fileName) ) {   
     $pesan ="ERROR: Your image was not .gif, .jpg, or .png.";
     unlink($fileTmpLoc); 
     $err = 1;
} else if ($fileErrorMsg == 1) { 
    $pesan = "ERROR: An error occured while processing the file. Try again."; 
    $err = 1;
}
 
$moveResult = move_uploaded_file($fileTmpLoc, "upload/$fileName");
		if ($moveResult != true) {
		    $pesan = $pesan;
		    unlink($fileTmpLoc); 
			$err = 1;
		}

$ext = explode(".", $fileName);
unlink($_FILES["uploaded_file"]["tmp_name"]); 
$ak = Query::builder("SELECT COUNT(ID_USER) AS tot FROM user")[0]["tot"];
$new_name =  ($ak+1).date("YmdHis").".".end($ext);
$target_file = "upload/$fileName";
$resized_file = "upload/$new_name";
$wmax = 360;
$hmax = 250;
ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt); 
$nama_menu = Input::post("nama_menu", true);
$harga = Input::post("harga", true);
$kantin = Input::post("kantin", true);
$jenis = Input::post("jenis", true);
$gambar = $new_name;
if ($fileErrorMsg>0) {
	$gambar = null;
}
$ad = Query::builder("INSERT INTO menu (`NAMA_MENU`,`JENIS`,`HARGA`,`ID_KANTIN`,`GAMBAR`,`STATUS_MENU`) VALUES ('$nama_menu','$jenis','$harga','$kantin','$gambar','1')");
 
if ($ad) {
$err = 0;
$pesan = "Tambah menu berhasil";
}else{
$err = 1;
$pesan = "ERROR tambah menu";
}
 
}else{
$pesan = "Isi data dengan benar !";
$err = 1;
}
}else{
$pesan = "Isi data dengan benar !";
$err = 1;
}
if ($err == 1) {
$_SESSION["buka"] = Input::post("kantin", true);	
$_SESSION["pesan"] = "<div class='alert alert-danger alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>{$pesan}</strong></div>";
header("location:kantin.php?page=manage_kantin");
}elseif ($err == 0) {
$_SESSION["buka"] = Input::post("kantin", true);	
$_SESSION["pesan"] = "<div class='alert alert-success alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>{$pesan}</strong></div>";
header("location:kantin.php?page=manage_kantin");
}
?>