<?php $kantin = Query::builder("SELECT * FROM kantin WHERE STATUS_KANTIN=1");
$now = date("Y-m-d");
 $laporan = Query::builder("SELECT count(*) as total_laporan from laporan WHERE TGL='$now'");
 //print_r($laporan);
 ?>
 <?php if ($laporan[0]["total_laporan"] >0) { ?>
       <script>
 $('#date_1').datepicker({
                    format: "yyyy-mm-dd"
                }); 
                $('#date_2').datepicker({
                    format: "yyyy-mm-dd"
                });
      </script>
	<div onclick="laporan()" style="margin-top:20px;" role="alert" class="pointer alert alert-success alert-dismissible fade in"><strong><center>Lihat <span class="badge"><?php echo $laporan[0]["total_laporan"];?></span> Laporan Hari Ini !</center></strong></div>
 <?php } ?>


<div class="box box-solid box-primary" style="margin-top:20px;" >

        <div class="box-header">
          <h3 class="box-title"><i class="fa fa-book"></i> Lihat Laporan Penjualan Kantin</h3>
        </div><!-- /.box-header -->
        <div class="box-body" style="margin-top:15px;">
          <div class="form-group">
               
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="date_1" class="form-control pull-right" placeholder="Tanggal Awal" onchange="cek_tgl_awal()">
                </div>
                
                <!-- /.input group -->
              </div>
        </div><!-- /.box-body -->
        <div class="box-body">
          <div class="form-group">
                
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="date_2" class="form-control pull-right" placeholder="Tanggal Akhir" onchange="cek_tgl_akhir()">
                </div>
                
                <!-- /.input group -->
              </div>

        </div><!-- /.box-body -->
         <div class="box-body">
          <div class="form-group">
                
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-angle-double-down "></i>
                  </div>
                  <select class="form-control" id="id_kantin">
                  	<option value="all">Lihat semua laporan kantin</option>
                    <?php if ($kantin) {
                    	foreach ($kantin as $kantin) {
                    		echo "<option value='".$kantin["ID_KANTIN"]."'>".$kantin["NAMA_KANTIN"]."</option>";
                    	}
                    }?>
                  </select>
                </div>
                
                <!-- /.input group -->
              </div>

        </div><!-- /.box-body -->
        <div class="box-body">
	           <button class="btn btn-danger btn-flat" id="btn-laporan" disabled="disabled"><span class="fa fa-eye"></span> Lihat</button>
	        	
	          
        </div>

      </div>

      
      <div id="report"></div>

      