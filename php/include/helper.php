<?php
function cek_time1($time1, $time2){
    $awal = explode(":",$time1);
    $akhir = explode(":",$time2);
    if ($awal[0] <= $akhir[0]) {
        if ($awal[0] == $akhir[0]) {
            if ($awal[1] <= $akhir[1]) {
                if ($awal[1] == $akhir[1]) {
                    if ($awal[2] <= $akhir[2]) {
                        return 1;
                    }
                }else{
                    return 1;
                }
            }
        }else{
            return 1;
        }
    }else{
        return false;
    }
}
function cek_time2($time1, $time2){
    $awal = explode(":",$time1);
    $akhir = explode(":",$time2);
        if ($awal[0] >= $akhir[0]) {
        if ($awal[0] == $akhir[0]) {
            if ($awal[1] >= $akhir[1]) {
                if ($awal[1] == $akhir[1]) {
                    if ($awal[2] >= $akhir[2]) {
                        return 1;
                    }
                }else{
                    return 1;
                }
            }
        }else{
            return 1;
        }
    }else{
        return 0;
    }
}
function cek_allowed_time(){
	$allowed_time = Query::builder("SELECT * FROM pengaturan_sistem");
    $satu = cek_time1($allowed_time[0]["WAKTU1"], date("H:i:s"));
    $dua =  cek_time2($allowed_time[0]["WAKTU2"], date("H:i:s")); 
       if ($satu AND $dua) {
         return true;
       }else{
        return false;
       }
}
function convert_time($time){
	$pecah = explode(" ", $time);
	 if ($pecah[1]=="AM") {
	 	return $pecah[0]; 
	 }else{
	 	$waktu = explode(":", $pecah[0]);
	 	$waktu_akhir = ($waktu[0]+12) ;
	 	return $waktu_akhir.":".$waktu[1];
	 }
	
}
function set_status_user()
{
	if (Input::get("page")) {
        if (Input::get("page", true) == "delete") {
            if (Input::get("id")) {
                $id = Input::get("id", true);
                Query::builder("UPDATE user SET STATUS = 0 WHERE ID_USER=$id");
                $_SESSION["pesan"] = "<div class='alert alert-success alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>User berhasil di Non aktifkan !</strong></div>";
                header("location:admin.php?page=user");
            }
        }elseif (Input::get("page", true) == "active") {
          if (Input::get("id")) {
                $id = Input::get("id", true);
                Query::builder("UPDATE user SET STATUS = 1 WHERE ID_USER=$id");
                $_SESSION["pesan"] = "<div class='alert alert-success alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>User berhasil di aktifkan !</strong></div>";
                header("location:admin.php?page=user");
            }
        }elseif (Input::get("page", true) == "reset") {
        	if (Input::get("id")) {

                $id = Input::get("id", true);
                $data = Query::builder("SELECT * FROM user WHERE ID_USER=$id");
                $new_pass = md5($data[0]["USERNAME"]);
                Query::builder("UPDATE user SET PASSWORD = '$new_pass' WHERE ID_USER=$id");
                $_SESSION["pesan"] = "<div class='alert alert-success alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>Reset password berhasil !</strong></div>";
                header("location:admin.php?page=user");
            }
        }elseif (Input::get("page", true) == "hapus") {
          if (Input::get("id")) {
                $id = Input::get("id", true);
                Query::builder("UPDATE user SET STATUS = 100 WHERE ID_USER=$id");
                $_SESSION["pesan"] = "<div class='alert alert-success alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>Hapus user berhasil!</strong></div>";
                header("location:admin.php?page=user");
            }
        }
      }
}
 
function breadcrumb()
{
	if (isset($_SESSION["li_active"])) {
        	if ($_SESSION["li_active"] == "dashboard") {
        		return '<i class="fa fa-dashboard"></i>Home</a></li>
        				<li class="active">Dashboard</li>';
        	}elseif ($_SESSION["li_active"] == "user") {
        		return '<i class="fa fa-user"></i>Home</a></li>
        				<li class="active">Manage User</li>';
        	}elseif ($_SESSION["li_active"] == "laporan") {
        		return '<i class="fa fa-book"></i>Home</a></li>
        				<li class="active">Lihat Laporan</li>';
        	}elseif ($_SESSION["li_active"] == "general") {
        		return '<i class="fa fa-cog"></i>Home</a></li>
        				<li class="active">Pengaturan Sistem</li>';
        	}elseif ($_SESSION["li_active"] == "manage_kantin") {
        		return '<i class="fa fa-cog"></i>Home</a></li>
        				<li class="active">Manage Menu Kantin</li>';
        	}elseif ($_SESSION["li_active"] == "pesanan") {
        		return '<i class="fa fa-suitcase"></i> Home</a></li>
        				<li class="active">Pesanan</li>';
        	}elseif ($_SESSION["li_active"] == "tambah_kantin") {
        		return '<i class="fa fa-plus"></i> Home</a></li>
        				<li class="active">Tambah Kantin</li>';
        	}elseif ($_SESSION["li_active"] == "pesanan_error") {
        		return '<i class="fa fa-times-circle"></i> Home</a></li>
        				<li class="active">Pesanan Tidak Di Ambil</li>';
        	}elseif ($_SESSION["li_active"] == "manage_kantin_data") {
                return '<i class="fa fa-times-circle"></i> Home</a></li>
                        <li class="active">Manage Kantin</li>';
            }


        }
}
function set_li_active($user){
	if ($user == "admin") {
		if (Input::get("page")) {
        $file = "php/view/admin/".Input::get("page", true).".php";
        if (file_exists($file)) {
          $_SESSION["li_active"] = Input::get("page", true);
        }
        
      }else{
        $_SESSION["li_active"] = "dashboard";
      }
	}elseif ($user == "kantin") {
		if (Input::get("page")) {
        $file = "php/view/kantin/".Input::get("page", true).".php";
        if (file_exists($file)) {
          $_SESSION["li_active"] = Input::get("page", true);
        }
        
      }else{
        $_SESSION["li_active"] = "dashboard";
      }
	}
}
function li_active($session){
	if (isset($_SESSION["li_active"])) {
		if ($_SESSION["li_active"] == $session) {
			echo " class='active' ";
		}
	}else{
		return false;
	}
}
function format_rupiah($a){
  	return "Rp ".number_format($a, 0, ".", ".");
}
function base_url($url = null){
	if ($url != "") {
		return "http://$_SERVER[HTTP_HOST]/ta/".$url;
	}else{
		return "http://$_SERVER[HTTP_HOST]/ta/";
	}
	
}
function get_flashdata($name = null){
		if ($name != '') {
			if (isset($_SESSION[$name])) {
			echo $_SESSION[$name];
			$_SESSION[$name] = null;
			unset($_SESSION[$name]);
			}
		}else{
			echo "Unknow session name";exit();
		}
}
function tgl_sql($tgl){
	$tgl_sql = explode("/",$tgl);
	return $tgl_sql[2]."-".$tgl_sql[1]."-".$tgl_sql[0];
}
function tgl_indo($tgl){
	
	$data = explode("-", $tgl);
	$bulan = $data[1];
	if ($bulan == 01) {
		$bln = "Januari";
	}elseif ($bulan == 02) {
		$bln = "Februari";
	}elseif ($bulan == 03) {
		$bln = "Maret";
	}elseif ($bulan == 04) {
		$bln = "April";
	}elseif ($bulan == 05) {
		$bln = "Mei";
	}elseif ($bulan == 06) {
		$bln = "Juni";
	}elseif ($bulan == 07) {
		$bln = "Juli";
	}elseif ($bulan == 08) {
		$bln = "Agustus";
	}elseif ($bulan == 09) {
		$bln = "September";
	}elseif ($bulan == 10) {
		$bln = "Oktober";
	}elseif ($bulan == 11) {
		$bln = "November";
	}elseif ($bulan == 12) {
		$bln = "Desember";
	}else{
		$bln = "Out Off Range";
	}
		return $data[2]." - ".$bln." - ".$data[0];
	}
?>