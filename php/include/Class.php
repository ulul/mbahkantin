<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once("helper.php");
error_reporting(0);
/**
 * Database connection
 */

class DB
{
    static function connection()
    {
        $hostname = 'localhost';
        $username = 'root';
        $password = 'mysql';
        $database = 'si_kantin';
        try {
           $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e->getMessage();exit();
        }
        return $conn;
    }
}

/**
* Input process
*/
class Input
{

	static function post($input = NULL,$a=NULL) {
		if (strtolower($a) == true) {
			return  addslashes(htmlspecialchars(trim($_POST[$input])));
		}else{
			return isset($_POST[$input]);
		}
	}
	static function request($input = NULL,$a = NULL) {
		if (strtolower($a) == true) {
			return  addslashes(htmlspecialchars(trim($_REQUEST[$input])));
		}else{
			return isset($_REQUEST[$input]);
		}
	}
	static function get($input = NULL, $a = NULL) {
		if (strtolower($a) == true) {
			return  addslashes(htmlspecialchars(trim($_GET[$input])));
		}else{
			return isset($_GET[$input]);
		}
	}

} 
/**
* Query processing
*/
class Query
{
	static function builder($sql = NULL){
		if ($sql != '') {
			$data = explode(" ", $sql);
			$ext = strtolower($data[0]);
				if ($ext == "insert" || $ext == "update" || $ext == "delete") {
						try {
						$conn = DB::connection();
						$query = $conn->prepare($sql);
						$query->execute();
					  		return $query->rowCount();
						} catch (Exception $e) {
							echo $e->getMessage();exit();
						}
				}elseif($ext == "select") {
						try {
						$conn = DB::connection();
						$query = $conn->prepare($sql);
						$query->execute();
						if ($query->rowCount()) {
							return $query->fetchAll();
						}else {
							return FALSE;
						}
						} catch (Exception $e) {
							echo $e->getMessage();exit();
						}
				}else{
					echo '<font color="red">Cannot find Query " '.$sql.' " </font>';
				}
		}else{
			echo "Query Is Empty";exit();
		}
		function __destruct(){
			$conn = NULL;
		}
	}
	static function get_json($sql = NULL){
		if ($sql !='') {
			$data = explode(" ", $sql);
			$ext = strtolower($data[0]);
				if ($ext == "select") {
					try {
					$conn = DB::connection();
					$query = $conn->prepare($sql);
					$query->execute();
					if ($query->rowCount()) {
						$result = $query->fetch(PDO::FETCH_ASSOC);
						return json_encode($result);
					}else {
						return FALSE;
					}
					$conn = NULL;
					} catch (Exception $e) {
						echo $e->getMessage();exit();
					}
				}else {
					echo "Query is incorect";exit();
				}
		}else {
			echo "Query Is Empty";exit();
		}
	}
}
/**
* Paginate data
*/
$per_halaman = 6;
class Pagination
{
  static function paging($sql,$per_halaman,$limit_ajax=null)
  {
  		if ($limit_ajax != null AND $limit_ajax>0) {
  			$limit = ($limit_ajax-1)*$per_halaman;
  		}else{
        $limit=0;
    	}

        $query = $sql." LIMIT $limit,$per_halaman";
  		return $query;
  }
  static function show_page($query,$per_halaman,$page_ajax=null)
  {
        
        $conn = DB::connection();
        $base_url = $_SERVER['PHP_SELF'];
        $query = $conn->prepare($query);
        $query->execute();
        $total_record = $query->rowCount();
        if($total_record > 0)
        {
            echo '<ul class="pagination">';
            $total_halaman = ceil($total_record/$per_halaman);
            $nomer=1;
            if ($page_ajax !=null AND $page_ajax>1) {
            	$prev = ($page_ajax-1);
            	echo "<li><a onclick='paging($prev)' href='#page-$prev'><</a></li>";
            }else{
            	echo "<li class='disabled'><a><</a></li>";
            }
            if ($page_ajax !=null AND $page_ajax>0 AND $page_ajax<=$total_halaman) {
                $awal = $page_ajax;
                $range = $awal + 4;
                if ($range > $total_halaman) {
                    if (($total_halaman -4)!=0 AND ($total_halaman -4)>0) {
                        $awal = $total_halaman-4;
                        $akhir = $total_halaman; 
                    }else{
                      $awal = 1;
                      $akhir = $total_halaman;
                    }
                 }elseif($range <=$total_halaman){
                    if (($range -4) !=0) {
                      $akhir = $range;
                      $awal = $range-4;
                    }else{
                      $awal = 1;
                      $akhir = $total_halaman;
                    }
                 }
            }else{
              $awal =1;
              $range = $awal+4;
              if (($awal +4)<=$total_halaman) {
                  $akhir = ($awal+4);
              }else{
                $akhir = $total_halaman;
              }
            }
            for($i=$awal;$i<=$akhir;$i++)
            {
            if ($page_ajax !=null AND $page_ajax>0 AND $page_ajax<=$total_halaman) {
            	$nomer = $page_ajax;
            }else{
            	$nomer = $nomer;
            }
            if($i==$nomer)
            {
                echo "<li class='active'><a onclick='paging($i)' href='#page-$i'>".$i."</a></li>";
            }
            else
            {
                echo "<li><a onclick='paging($i)' href='#page-$i'>".$i."</a></li>";
            }
   			}
   			if ($page_ajax<$total_halaman) {
            	$prev = ($page_ajax+1);

            	echo "<li><a onclick='paging($prev)' href='#page-$prev'>></a></li>";
            }else{
            	echo "<li class='disabled'><a>></a></li>";
            }
   			echo '</ul>';
  }
 }
}

// Akhir dari file Class.php
