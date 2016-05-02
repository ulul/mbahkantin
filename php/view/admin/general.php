<?php $pengaturan_sistem = Query::builder("SELECT * FROM pengaturan_sistem "); 
if ($pengaturan_sistem) {
  $jumlah_stand = $pengaturan_sistem[0]["JUMLAH_STAND"];
}else{
  $jumlah_stand = 1;
  }?>
<div id="alert" style="margin-top:20px;"></div>
              <div style="margin-top:20px;" class="box box-solid box-primary" >

        <div class="box-header">
          <h3 class="box-title"><i class="fa fa-book"></i> Pengaturan Waktu Pesan</h3>
        </div><!-- /.box-header -->
         <div class="box-body">
                       <div class="bootstrap-timepicker">
                <div class="form-group">

                  <div class="input-group">
                    <input type="text" class="form-control timepicker1" id="time1" placeholder="Waktu Awal" onchange="set_time1()">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              <div class="bootstrap-timepicker">
                <div class="form-group">

                  <div class="input-group">
                    <input type="text" class="form-control timepicker2" id="time2" placeholder="Waktu Akhir" onchange="set_time2()">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>


        </div><!-- /.box-body -->
        <div class="box-body">
        	<button class="btn btn-danger btn-flat" id="btn-waktu" disabled="disabled"><span class="fa fa-clock-o"></span> Set Waktu</button>
            
        </div>

      </div>


              <div style="margin-top:20px;" class="box box-solid box-primary">

        <div class="box-header" >
          <h3 class="box-title"><i class="fa fa-book"></i> Pengaturan Jumlah Stand</h3>
        </div><!-- /.box-header -->
         <div class="box-body">
              <div id="error"></div>
              <div class="bootstrap-timepicker">
                <div class="form-group">


                  <div class="input-group" style="margin-top:20px;">
                  <div id='jml_stand'>
                    <input type="number" class="form-control " id="jumlah_stand" onchange="jumlah_stand()" placeholder="Jumlah Stand" <?php echo "value='".$jumlah_stand."'";?> >
                    </div>
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>


        </div><!-- /.box-body -->
        <div class="box-body">
        	<button class="btn btn-success btn-flat" id="save_jml"><span class="fa fa-check"></span> Set Jumlah Stand</button>
            
        </div>

      </div>