<?php

$adm = $_SESSION["ID_USER"];
$user = Query::builder("SELECT * from user WHERE ID_USER != $adm AND STATUS !=100 ORDER BY ID_USER ASC");
$level = Query::builder("SELECT * FROM user_level");
if ($user) {
  $no = 1;
  
   ?>


<div class="box-body" style="margin-top:20px;">
<div class="box-body">

<div class="dropdown" style="float:right; margin-right:15px;">
              <a aria-expanded="false" role="button" aria-haspopup="true" data-toggle="dropdown" class="btn bg-olive btn-flat dropdown-toggle" href="#" id="drop1">
                <span class="fa fa-user-plus"></span>
                Tambah User
                <span class="caret"></span>
              </a>
              <ul aria-labelledby="drop1" role="menu" class="dropdown-menu">
                <li role="presentation"><a data-toggle="modal" href="#" data-target="#modalAdd" style="float:right;">Tambah User Manual</a></li>
                <li role="presentation"><a href="#"  data-toggle="modal" data-target="#modalExcel" role="menuitem">Import Excel</a></li>

              </ul>
            </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalExcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Import Excel <font color="red">*</font>Kusus untuk user siswa</h4>
      </div>
      <form action="import.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
          <input  type="file" name="excel_user" accept="application/vnd.ms-excel" >
               
      </div>
      <div class="modal-footer">
   <div id="footer-import" style="float:left;"></div>
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary btn-flat" name="submit" id="save_import" value="Import">
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah User</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <div id="error_username">
                  <input type="text"  placeholder="Username" class="form-control" id="username_add" onkeyup="cek_username()">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-lock"></i>
                  </div>
                  <input type="password"  placeholder="Password" class="form-control" id="password_add">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-angle-double-down "></i>
                  </div>

                  <select id="id_level" class="form-control" onchange="cek_level()">
                  <option> Level </option>
                    <?php if ($level) {
                      foreach ($level as $level) {
                        echo "<option value='".$level["ID_LEVEL"]."'>".$level["LEVEL"]."</option>";
                      }
                    }?>
                    </select>
                </div>
              </div>
               
      </div>
      <div class="modal-footer">
   <div id="footer" style="float:left;"></div>
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary btn-flat" id="save_add" value="Save changes">
      </div>
    </div>
  </div>
</div>
<div id="pesan_add"><?php  get_flashdata("pesan"); ?></div>

              <table id="example2" class="table  table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Level</th>     
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($user as $key) {
                  if ($key["ID_LEVEL"] == 3) {
                    $level = "<label class='label label-primary'>Siswa</label>";
                  }elseif ($key["ID_LEVEL"] == 2) {
                    $level = "<label class='label label-success'>Petugas Kantin</label>";
                  }elseif ($key["ID_LEVEL"] == 1) {
                    $level = "<label class='label label-info'>Admin</label>";
                  }else{
                    $level = "<label class='label label-danger'>Error Level</label>";
                  }
                  if ($key["STATUS"] == 1) {
                    $status = "<label class='label label-success'>Aktif</label>";

                  }elseif ($key["STATUS"] == 0) {
                    $status = "<label class='label label-danger'>Tidak Aktif</label>";
                  }

                  echo "<tr>";
                  echo "<td>".$no."</td>";
                  echo "<td>".$key["USERNAME"]."</td>";
                  echo "<td>".$level."</td>";
                  echo "<td>".$status."</td>"; ?>
                  <td>| <?php if ($key["STATUS"] == 1) {?> <a data-toggle="tooltip" data-placement="top" title="Non Aktifkan User" onclick="confirm_modal(<?php echo $key["ID_USER"];?>, 'delete','<?php echo $key["USERNAME"];?>')"    class='pointer fa fa-close'></a> 
                  <?php }elseif ($key["STATUS"] == 0){ ?><a data-toggle="tooltip" data-placement="top" title="Aktifkan User"  onclick="confirm_modal(<?php echo $key["ID_USER"];?>, 'active', '<?php echo $key["USERNAME"];?>')" class='pointer fa  fa-check'></a>
                  <?php } ?>
                  |
                   <a data-toggle="tooltip" data-placement="top" title="Reset Password"  onclick="confirm_modal(<?php echo $key["ID_USER"];?>, 'reset', '<?php echo $key["USERNAME"];?>')"  class='pointer fa  fa-rotate-left'></a> | 

                  <a data-toggle="tooltip" data-placement="top" title="Hapus User"  onclick="confirm_modal(<?php echo $key["ID_USER"];?>, 'hapus', '<?php echo $key["USERNAME"];?>')" class='pointer fa   fa-trash'></a> |</td>
                  <?php
               $no++; }?>
                  
                </tbody>
                
              </table>
 
            </div>
            <?php } ?>
            <!-- /.box-body -->

         
