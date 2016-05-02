<?php require_once("../../php/include/Class.php");
if (Input::post("time1") AND Input::post("time2")) {
	$time1 = convert_time(Input::post("time1", true)).":00";
	$time2 = convert_time(Input::post("time2", true)).":00";
	 //echo $time2;exit();
	//echo "UPDATE pengaturan_sistem SET WAKTU1='$time1' WAKTU2='$time2'";exit();
	Query::builder("UPDATE pengaturan_sistem SET WAKTU1='$time1', WAKTU2='$time2'");
	echo '<div role="alert" class="alert alert-success alert-dismissible fade in"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">×</span></button><strong>Set waktu berhasil !</strong></div>';
}
?>
