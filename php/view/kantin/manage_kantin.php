<?php 
$kantin = Query::builder("SELECT * from kantin WHERE STATUS_KANTIN !=0 ");
?>
<div id="pesan" style="margin-top:20px;"><?php get_flashdata("pesan"); ?>
</div> 
 <div style="float:right; margin-right:15px; margin-bottom:20px;">
<button type="button" class="btn bg-olive btn-flat" data-toggle="modal" data-target="#modalAddMenu" >
  Tambah Menu
</button>
</div>              
           
         <div class="modal fade" id="modalAddMenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Menu</h4>
              </div>
              <form enctype="multipart/form-data" method="post" action="<?php echo base_url("add_menu.php")?>">
              <div class="modal-body">
                 
             
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
              <div class="box-body">
              <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputEmail3"><font color="red">*</font>Gambar</label>

                  <div class="col-sm-9">
                    <input type="file"  name="uploaded_file" id="gambar" accept="image/*">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputEmail3">Nama Menu</label>

                  <div class="col-sm-9">
                    <input type="text" name="nama_menu"  id="nama_menu" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputPassword3">Jenis</label>

                  <div class="col-sm-9">
                   <select class="form-control" name="jenis">
                      <option value="Makanan">Makanan</option>
                      <option value="Minuman">Minuman</option>
                   </select> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputPassword3">Harga</label>

                  <div class="col-sm-9">
                    <input type="text"  name="harga"  id="harga" class="only-number form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputPassword3">Kantin</label>

                  <div class="col-sm-9">
                   <select class="form-control" name="kantin">
                      <?php if ($kantin) {
                          foreach ($kantin as $key) {
                              echo "<option value=".$key["ID_KANTIN"].">".$key["NAMA_KANTIN"]."</option>";
                          }
                      }?>
                   </select> 
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              
              <!-- /.box-footer -->
            </div>
           
              </div>
              <div class="modal-footer">
              <input type="hidden" value="tambah" name="cek">
              <input type="hidden" value="<?php echo $key["ID_KANTIN"] ?>" name="kantin">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <input type="submit" class="btn bg-purple btn-flat" name="submit_menu" value="Simpan">
              </div>
              </form>
            </div>
          </div>
        </div>            
<select class="form-control" style="margin-top:20px" id="id_kantin" onchange="select_kantin()">
<option value="">Pilih Kantin</option>
	<?php 
	if ($kantin) {
		foreach ($kantin as $key) {
			echo "<option value='".$key["ID_KANTIN"]."'>".$key["NAMA_KANTIN"]."</option>";
		}
	}
	?>
</select>
<div id="data_kantin" style="margin-top:20px;">
</div>