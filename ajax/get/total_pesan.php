<?php
require_once("../../php/include/Class.php");
$kantin = Query::builder("SELECT count(*) as total_kantin from kantin WHERE STATUS_KANTIN !=0");
 $pesanan = Query::builder("SELECT count(*) as total_pesanan from pesanan WHERE STATUS=0 "); ?>
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="pointer small-box bg-yellow" onclick="document.location.href='http://localhost/ta/kantin.php?page=manage_kantin_data'">
            <div class="inner">
              <h3><?php echo $kantin[0]["total_kantin"];?></h3>

              <p>Kantin Terdaftar</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="<?php echo base_url("kantin.php?page=manage_kantin_data");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> 
<div class="pointer col-lg-3 col-xs-6">
          <!-- small box -->
          <!-- small box -->
          <div class="pointer small-box bg-green" onclick="document.location.href='http://localhost/ta/kantin.php?page=pesanan'">
            <div class="inner">
              <h3><?php echo $pesanan[0]["total_pesanan"];?></h3>

              <p>Pesanan </p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url("kantin.php?page=manage_kantin");?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>