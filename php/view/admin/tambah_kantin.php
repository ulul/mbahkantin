<div id="pesan" style="margin-top:20px;"> <?php get_flashdata("pesan"); ?></div>
<div class="col-md-9" style="margin-top:20px;">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Kantin</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="inputEmail3">Nama Kantin</label>

                  <div class="col-sm-10">
                    <input type="text" placeholder="Nama Kantin" id="nama_kantin" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="inputPassword3">No Stand</label>

                  <div class="col-sm-10">
                  <select class="form-control" id="no_stand">
                    <?php
                    $q = Query::builder("SELECT * FROM pengaturan_sistem");
                    $jumlah_stand = $q[0]["JUMLAH_STAND"];
                    for($i=1; $i<=$jumlah_stand; $i++){
                      $cek = Query::builder("SELECT * FROM kantin WHERE NO_STAND=$i AND STATUS_KANTIN=1");
                      if (!$cek) {
                        echo "<option value='{$i}'>{$i}</option>";
                      }
                    }
                    ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="inputEmail3">No Hp</label>

                  <div class="col-sm-10">
                    <input type="text" placeholder="No Hp" id="no_hp" class="only-number form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="inputEmail3">Max Pesanan</label>

                  <div class="col-sm-10">
                    <input type="text" placeholder="Maximal melayani pesanan" id="max_pesan" class="only-number form-control">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">

                <button class="btn bg-olive btn-flat" type="submit" onclick="add_kantin()">Save</button>
              </div>
              <!-- /.box-footer -->
            </div>
          </div>
          
          <!-- /.box -->
        </div>