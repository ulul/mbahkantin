<?php
require_once("../../php/include/Class.php");
$user = Query::builder("SELECT count(*) as total_user from user WHERE ID_LEVEL != 1 AND STATUS!=100");
      $now = date("Y-m-d");
      $laporan = Query::builder("SELECT count(*) as total_laporan from laporan WHERE TGL='$now'");
?>
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="pointer small-box bg-yellow" onclick="document.location.href='http://localhost/ta/admin.php?page=user'">
            <div class="inner">
              <h3><?php echo $user[0]["total_user"];?></h3>

              <p>User Terdaftar</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="<?php echo base_url("admin.php?page=user");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="pointer col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green" onclick="document.location.href='http://localhost/ta/admin.php?page=laporan'">
            <div class="inner">
             <h3><?php echo $laporan[0]["total_laporan"];?></h3>

              <p>Laporan Hari Ini</p>
            </div>
            <div class="icon">
              <i class="ion-ios-list"></i>
            </div>
            <a href="<?php echo base_url("admin.php?page=laporan");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>