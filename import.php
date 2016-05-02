<?php
require_once("php/include/Class.php");
require_once("php/include/PHPExcel/Classes/PHPExcel.php");
require_once("php/include/PHPExcel/Classes/PHPExcel/IOFactory.php");

if (isset($_POST["submit"])) {
  if(!$_FILES["excel_user"]["error"]>0){
  $target_dir = "upload/excel/";
  $target_file = $target_dir . basename($_FILES["excel_user"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      if($imageFileType != "xls") {
        $pesan = "Maaf, File harus berformat xls atau excel 2007";
        $uploadOk = 0;
      }else{
      if (file_exists($target_file)) {
      $snama = $_FILES["excel_user"]["name"];  
      $pesan = "Maaf, file dengan nama {$snama} yang sama sudah pernah di import.";
      $uploadOk = 0;
      }else{      
        if (move_uploaded_file($_FILES["excel_user"]["tmp_name"], $target_file)) {
        
         $objPHPExcel = PHPExcel_IOFactory::load("upload/excel/".$_FILES["excel_user"]["name"]);
          foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $worksheetTitle     = $worksheet->getTitle();
            $highestRow         = $worksheet->getHighestRow(); // e.g. 10
            $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
            $nrColumns = ord($highestColumn) - 64;
            for ($row = 1; $row <= $highestRow; ++ $row) {
                for ($col = 0; $col < $highestColumnIndex; ++ $col) {
                  $data = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                  if ($data =="No. INDUK SISWA" ) {
                  	for ($row = 1; $row <= $highestRow; ++ $row) { 
                  		$kolom = $col;
                  		$data = $worksheet->getCellByColumnAndRow( $kolom , $row)->getValue();
                  		$data2 = $worksheet->getCellByColumnAndRow( ($kolom+2) , $row)->getValue();
                  		$data3 = $worksheet->getCellByColumnAndRow( ($kolom+4) , $row)->getValue();
                  		$nama = $worksheet->getCellByColumnAndRow( ($kolom-2) , $row)->getValue();
                  		if ($data != "No. INDUK SISWA" AND $data != "") {
                  			$username = addslashes($data.$data2.$data3);
                  			$pass = md5(addslashes($username));
                  			$cek_akun = Query::builder("SELECT * FROM user WHERE USERNAME='$username'");
                  			if ($cek_akun) {
                  				$id = $cek_akun[0]["ID_USER"];
                  				Query::builder("UPDATE user SET USERNAME='$username', PASSWORD='$pass' WHERE ID_USER='$id'");
                  				$cek_nama = Query::builder("SELECT * FROM user_nama WHERE ID_USER='$id'");
                  				if ($cek_nama) {
                  					Query::builder("UPDATE user_nama SET NAMA='$nama' WHERE ID_USER='$id'");
                  				}else{
                  					Query::builder("INSERT INTO user_nama (`ID_USER`,`NAMA`) VALUES ($id, '$nama')");
                  				}
                  			}else{
                  				Query::builder("INSERT INTO user (`STATUS`, `ID_LEVEL`, `USERNAME`, `PASSWORD`, `STATUS_PESAN`) VALUES ('1', '3', '$username', '$pass','0')");
                  				$lastInsert = Query::builder("SELECT * FROM user WHERE USERNAME='$user_nama'");
                  				$id_user_nama = $lastInsert[0]["ID_USER"];
                  				Query::builder("INSERT INTO user_nama (`ID_USER`, `NAMA`) VALUES ('$id_user_nama', '$nama')");
                  			}
                  		}
                  		
                  	}
                  	
                  	//exit();
                  }else{
                  	//echo "No induk tidak di temukan";
                  }
                  
                  //if ($data !="") {
                                    
                  //$cek = Query::builder("SELECT * FROM user WHERE USERNAME='$data'");
                  //echo "<br>";
                  //if($cek){
                    //$pass = addslashes(md5($data));
                    //Query::builder("UPDATE user SET USERNAME='$data', PASSWORD='$pass' WHERE USERNAME='$data'");
                    //$uploadOk = 1;
                    //$pesan = "Import Data Sukses";
                  //}else{
                    //$pass = addslashes(md5($data));
                    //Query::builder("INSERT INTO `si_kantin`.`user` (`ID_USER`, `STATUS`, `ID_LEVEL`, `USERNAME`, `PASSWORD`, `STATUS_PESAN`) VALUES (NULL, '1', '3', '$data', '$pass', '0')");
                    //$uploadOk = 1;
                    //$pesan = "Import Data Sukses";
                  //}
               // }
                }

            }
            }
        }else {
            $pesan = "Maaf, terjadi error saat upload file.";
        }

        } 
      }
    
}else{
  $pesan = "Pilih file dahulu sebelum import !";
  $uploadOk = 0;
}
if ($uploadOk == 0) {
  $_SESSION["pesan"] = "<div class='alert alert-danger alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>{$pesan}</strong></div>";
  echo $pesan;
  header("location:admin.php?page=user");
}elseif ($uploadOk == 1) {
  $_SESSION["pesan"] = "<div class='alert alert-success alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>Import user berhasil</strong></div>";
  echo $pesan;
  header("location:admin.php?page=user");
}
}
?>