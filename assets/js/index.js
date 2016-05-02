
function save(){
  var user_nama = $("#user_nama").val();
  var username = $("#username").val();
  var password = $("#password").val();
  console.log(user_nama,username,password);
  $.ajax({
    type:"POST",
    url:"ajax/post/edit_profile.php",
    data:"user_nama="+user_nama+"&username="+username+"&password="+password,
    success:function(data){
      console.log(data);
     if(data == 10){
        $("#notifikasi").html('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Display nama tidak boleh kosong !</strong></div>');
     }else{
       document.location.href = "profile.php";
     }
    }
  })
}
function update_profile(a){
  if (a == "form") {
    $("#profil").fadeOut(-1000);
    $("#form-edit").fadeIn();
  }else{
    $("#form-edit").fadeOut(-1000);
    $("#profil").fadeIn();
    
  }
  
}
function chart(id_menu){
          $.ajax({
            url:"ajax/post/add_to_chart.php",
            type:"POST",
            data:"id_menu="+id_menu,
            success:function(data){
              var cek = data.split("#");
              //alert(cek[1]);
              if (cek[0]==1) {
                $("#ganti"+id_menu).html(cek[1]).show();
                $("#jumlah_chart").html(cek[2]).show();
              }else{
                $("#kosong").html('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Maaf kantin telah melayani batas maksimal pesanan !</strong></div>');
              } 
              
            },
                error:function(XMLHttpRequest, textStatus, errorThrown){
                	alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }
          })
        }
function hapus(id_menu){
          $.ajax({
            url:"ajax/post/hapus_chart.php",
            type:"POST",
            data:"id_menu="+id_menu,
            success:function(data){
              var cek = data.split("#");
              $("#ganti"+id_menu).html(cek[0]).show();
              $("#jumlah_chart").html(cek[1]).show();
            },
                error:function(XMLHttpRequest, textStatus, errorThrown){
                  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }
          })
        }
function lihat_chart(){
         $.ajax({
            url:"ajax/get/lihat_chart.php",
            type:"GET",
            success:function(data){
                
                $("#myModal").modal("show");
                $("#modal-body").html("<center><img src='upload/icon/ajax-loader2.gif'></center>");
                setTimeout(function(){
                    $("#modal-body").html(data).show();
                },1000)
            },
                error:function(XMLHttpRequest, textStatus, errorThrown){
                  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }
          }) 
        }
function bandingkan(id_menu){
        $.ajax({
          url:"ajax/post/bandingkan.php",
          type:"POST",
          data:"id_menu="+id_menu,
          success:function(data){
          var pecah = data.split("##");
          var html = pecah[0];
          var jml = pecah[1];
          $("#compare").html(jml).show();
              $("#compare"+id_menu).html(html).show();
          },
                error:function(XMLHttpRequest, textStatus, errorThrown){
                  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }
          })
        }
function hapus_compare(id_menu){
        $.ajax({
          url:"ajax/post/hapus_compare.php",
          type:"POST",
          data:"id_menu="+id_menu,
          success:function(data){
          var pecah = data.split("##");
          var html = pecah[0];
          var jml = pecah[1];
          $("#compare").html(jml).show();
            $("#compare"+id_menu).html(html).show();
          },
                error:function(XMLHttpRequest, textStatus, errorThrown){
                  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }
          })  
        }
function cari(){
          var cari = $("#cari").val();

          if (cari !="") {
               $("#search").html("<center><img src='upload/icon/ajax-loader.gif'></center>");
            setTimeout(function() {
                $.ajax({
                url:"ajax/post/search.php",
                type:"POST",
                data:"cari="+cari,
                success:function(data){
                    $("#search").html(data).show();
                },
                error:function(XMLHttpRequest, textStatus, errorThrown){
                  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }
            });
            }, 1500);
          }else{
            paging(0);
          }
          }



