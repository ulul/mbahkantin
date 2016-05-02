<!--Navbar -->
  <div class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url();?>">Home</a>
    </div>
    <div class="navbar-collapse collapse navbar-inverse-collapse">
      
      
      <ul class="nav navbar-nav navbar-right">
      <li> <?php
        if(isset($_SESSION["compare"])){
          $badge =  count($_SESSION["compare"]);
        }else{
          $badge ="0";
        }
       if (isset($_SESSION['ID_LEVEL'])) {
        if ($_SESSION['ID_LEVEL'] == 3) {
          $id_user = $_SESSION['ID_USER'];
          $data = Query::builder("SELECT * FROM user WHERE ID_USER=$id_user");
          $cek_username = Query::builder("SELECT * FROM view_users WHERE ID_USER='$id_user'");
          if ($cek_username) {
            $user_nama = $cek_username[0]["NAMA"];
          }else{
            $user_nama = $data[0]['USERNAME'];
          }
        ?>
        <li id="compare-menu" role="presentation" style="background-color:#ff9800;"><a href="<?php echo base_url("compare.php"); ?>"><font color="white">Bandingkan</font> <span class="badge" ><div id="compare"><?php echo $badge; ?></div></span></a></li>
        <li class="dropdown">
          <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown"><font color="white"><?php echo $user_nama ?></font>
            <b class="caret"></b></a>
          <ul class="dropdown-menu">
            
            <li><a href="profile.php" >Profile</a></li>
            <li><a href="logout.php">Logout</a></li>

          </ul>

        </li>
          
        <?php
        }else{
          echo '<li id="compare-menu" role="presentation" style="background-color:#ff9800;"><a href="'.base_url("compare.php").'"><font color="white">Bandingkan</font> <span class="badge" ><div id="compare">'.$badge.'</div></span></a></li>';
          echo '<li role="presentation" style="background-color:#F6372F;" ><a href="login.php"><font color="white">Login </font><span class="glyphicon glyphicon-log-in"></span></a></li>';
          echo "<div class='clearfix'></div>";
        }
      }else{ ?>
      <li id="compare-menu" role="presentation" style="background-color:#ff9800;"><a href=<?php echo base_url("compare.php"); ?>><font color="white">Bandingkan</font> <span class="badge" id='compare'><?php echo $badge; ?></span></a></li>
      <?php
        echo '<li role="presentation" style="background-color:#F6372F;" ><a href="login.php"><font color="white">Login </font><span class="glyphicon glyphicon-log-in"></span></a></li>';
          echo "<div class='clearfix'></div>";
        } ?>

      </li>
      <li></li>
      </ul>
    </div>
  </div>
</div>
<!--End Navbar -->