<?php
	error_reporting(0);

	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	error_reporting(E_ALL);

	ini_set("error_reporting", E_ALL);

	error_reporting(E_ALL & ~E_NOTICE);
	ob_start();
	include_once '../config/dbconfig.php';
	if(!$user->is_loggedin() && $_GET["p"] != 'qrcode'){
 		$user->redirect('../index?'.$_SERVER['QUERY_STRING'].'');
	}

	$user_id = $_SESSION['user_session'];
	$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	// print($userRow['user_name']);

	$a = $userRow['user_class'];

	if(isset($_POST["btnsave"])){
		$name = $_POST["txtname"];
		$branch = $_POST["txtbranch"];
		$dept = $_POST["txtdept"];
		$acc = $_POST["txtacc"];
		$desc = $_POST["txtdesc"];
		$warning = $userRow["user_name"];

		$imgFile = $_FILES["user_image"]["name"];
		$tmp_dir = $_FILES["user_image"]["tmp_name"];
		$imgSize = $_FILES["user_image"]["size"];

		function generateRandomString($length = 8){
			return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuwvxyzABCDEFGHIJKLMNOPQRSTUVWXVZ',ceil($length/strlen($x)) )),1,$length);
		}
		$ran = generateRandomString();
		echo $ran;
echo $name;
echo $branch;
echo $dept;
echo $acc;
echo $desc;
echo $warning;

		if(empty($imgFile)){
			//$errMSG = "Please Select Image File.";
			$userpic = "NO_IMG_FILE";			

			if($user->insertrepair($ran,$name,$branch,$dept,$acc,$desc,$userpic,$warning)){
				header('Location:https://repairit.tkn.co.th/line.php?key='.$ran.'&u='.$name.'&acc='.$acc.'');
				// header('Location:?p=np&s=success');
				//echo "success";
			}else{
				// header("refresh;home.php?s=fail");
				header('Location:?s=failaa');
				//echo "fail";
			}
        }else{
            $upload_dir = '../upload_images/';
            $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));

            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

            $userpic = rand(1000,1000000).".".$imgExt;

            if(in_array($imgExt, $valid_extensions)){
                if($imgSize < 50000000){
                    if(move_uploaded_file($tmp_dir, $upload_dir.$userpic)){
                        if($user->insertrepair($ran,$name,$branch,$dept,$acc,$desc,$userpic,$warning)){
							header('Location:https://tkn.co.th/line.php?key='.$ran.'&u='.$name.'&acc='.$acc.'');
							// header('Location:?p=np&s=success');
                            echo "success";
                        }else{
							// header("refresh;home.php?s=fail");
                            header('Location:?s=failss');
                            echo "fail";
                        }
                    }
                        
                }else{
                    $errMSG = "Sorry, Your File is too large.";
                }
            }else{
                $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        }
		// if($errMSG == ""){
		// 	$stmt = $DB_con->prepare("INSERT INTO rp_it(repair_id,repair_name,repair_branch,repair_dept,repair_acc,repair_desc,repair_img,repair_warning) 
		// 	VALUES (:uran,:uname,:ubranch,:udept,:uacc,:udesc,:upic,:uwarning)");
		// 	$stmt->bindParam(':uran',$ran);
		// 	$stmt->bindParam(':uname',$name);
		// 	$stmt->bindParam(':ubranch',$branch);
		// 	$stmt->bindParam(':udept',$dept);
		// 	$stmt->bindParam(':uacc',$acc);
		// 	$stmt->bindParam(':udesc',$desc);
		// 	$stmt->bindParam(':upic',$userpic);
		// 	$stmt->bindParam(':uwarning',$warning);
		// 	if($stmt->execute()){
		// 		$successMSG = "NEW record succesfully inserted ...";
		// 		header('Location:http://tkn.co.th/line.php?key='.$ran.'&u='.$name.'&acc='.$acc.'');
		// 	}else{
		// 		$errMSG = "error while inserting ...";
		// 		header("refresh;home.php?s=fail");
		// 	}
		// }
	}
	if(isset($_POST["btnsave_sta"])){
		$name = $_POST["txtname"];
		$brand = $_POST["txtbrand"];
		$series = $_POST["txtseries"];
		$income = $_POST["txtincome"];
		$desc_st = $_POST["txtdesc_st"];

		$stmt = $DB_con->prepare("INSERT INTO stock_acc(stock_name,stock_brand,stock_series,stock_income,stock_desc) 
		VALUES (:txtname,:brand,:series,:income,:desc_st)");
		$stmt->bindParam(':txtname',$name);
		$stmt->bindParam(':brand',$brand);
		$stmt->bindParam(':series',$series);
		$stmt->bindParam(':income',$income);
		$stmt->bindParam(':desc_st',$desc_st);
		// $stmt->bindParam(':age_used',$ybuy);

		if($stmt->execute()){
			$successMSG = "NEW record succesfully inserted ...";
			header('Location:'.$actual_link.'?st=success');
		}else{
			$errMSG = "error while inserting ...";
			header('Location:'.$actual_link.'?st=fail');
		}
	}

	if(isset($_POST["btnsave_sti"])){
		$inktype = $_POST["txtinktype"];
		$inkseries = $_POST["txtbrandink"];
		$inincome = $_POST["txtcountink"];

		$stmt = $DB_con->prepare("INSERT INTO stock_ink(stock_inktype,stock_ink_series,stock_ink_income) 
		VALUES (:stock_inktype,:stock_ink_series,:stock_ink_income)");
		$stmt->bindParam(':stock_inktype',$inktype);
		$stmt->bindParam(':stock_ink_series',$inkseries);
		$stmt->bindParam(':stock_ink_income',$inincome);

		if($stmt->execute()){
			$successMSG = "NEW record succesfully inserted ...";
			header('Location:'.$actual_link.'?st=success');
		}else{
			$errMSG = "error while inserting ...";
			header('Location:'.$actual_link.'?st=fail');
		}
	}
	
	if(isset($_POST["btn_stockout"])){
		// $rest = substr($_POST["txtoutacc"], -1);
		// if($_POST["txtoutcount"] > $rest){
		// 	echo "<script type='text/javascript'>alert('ไม่สามารถเบิกของเกิน Stock ได้');</script>";
		// }else{
			$so_acc = $_POST["txtoutacc"];
			$so_count = $_POST["txtoutcount"];
			$so_name = $_POST["txtoutname"];
			$so_dept = $_POST["txtoutdept"];

			$acc_select_name = substr($so_acc,4);  
			$acc_select_id = substr($so_acc,0,3);        
			$stmt2 = $DB_con->prepare("SELECT * FROM stock_acc WHERE stock_name = '".$acc_select_name."' AND stock_income != '0' LIMIT ".$so_count."");
			$stmt2->execute();
			if($stmt2->rowCount() > 0){
				$x = $so_count;
				while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					if($row2["stock_desc"] != ""){
						$x = ($x - $x) + 1;
					}
					$stmt = $DB_con->prepare("INSERT INTO stock_acc_out(stock_out_acc,stock_out_num,stock_out_name,stock_out_dept,stock_out_desc) 
						VALUES (:stock_out_acc,:stock_out_num,:stock_out_name,:stock_out_dept,:stock_out_desc)");
					$stmt->bindParam(':stock_out_acc',$acc_select_id);
					$stmt->bindParam(':stock_out_num',$x);
					$stmt->bindParam(':stock_out_name',$so_name);
					$stmt->bindParam(':stock_out_dept',$so_dept);
					$stmt->bindParam(':stock_out_desc',$row2["stock_desc"]);
					if($stmt->execute()){
						$successMSG = "NEW record succesfully inserted ...";
						echo $successMSG;
						header('Location:http://tkn.co.th/line.php?key='.$ran.'&u='.$name.'&acc='.$acc.'&stock=มีการเบิกอุปกรณ์');
					}else{
						$errMSG = "error while inserting ...";
						echo $errMSG;
						header('Location:'.$actual_link.'&st=fail');
					}	
				}
			}
		// }
	}

	if(isset($_POST["btn_stockinkout"])){
		// $rest = substr($_POST["txtinkoutink"], -1);
		// if($_POST["txtinkoutcountink"] > $rest){
		// 	echo "<script type='text/javascript'>alert('ไม่สามารถเบิกของเกิน Stock ได้');</script>";
		// }else{
			$si_acc = $_POST["txtinkoutink"];
			$si_count = $_POST["txtinkoutcountink"];
			$si_name = $_POST["txtinkoutnameink"];
			$si_dept = $_POST["txtoutdeptink"];
            $si_branch = $_POST["txtoutbranchink"];

			$stmt = $DB_con->prepare("INSERT INTO stock_ink_out(stock_out_ink,stock_out_ink_num,stock_out_ink_name,stock_out_ink_dept,stock_out_ink_branch) 
			VALUES (:stock_out_ink,:stock_out_ink_num,:stock_out_ink_name,:stock_out_ink_dept,:stock_out_ink_branch)");
			$stmt->bindParam(':stock_out_ink',$si_acc);
			$stmt->bindParam(':stock_out_ink_num',$si_count);
			$stmt->bindParam(':stock_out_ink_name',$si_name);
			$stmt->bindParam(':stock_out_ink_dept',$si_dept);
            $stmt->bindParam(':stock_out_ink_branch',$si_branch);

			if($stmt->execute()){
				$successMSG = "NEW record succesfully inserted ...";
				echo $successMSG;
				header('Location:https://repairit.tkn.co.th/line.php?key='.$ran.'&u='.$name.'&acc='.$acc.'&stock=มีการเบิกหมึก');
			}else{
				$errMSG = "error while inserting ...";
				echo $errMSG;
				header('Location:'.$actual_link.'&st=fail');
			}
		// }
	}

	if($_GET["statusinkout"] == "1"){
		$sql = "UPDATE stock_ink SET stock_ink_income = stock_ink_income - :stock_ink_income  
        WHERE stock_inkid = :stock_inkid";
		$stmt = $DB_con->prepare($sql);                                  
		$stmt->bindParam(':stock_ink_income', $_GET["stock_ink_income"], PDO::PARAM_STR);       
		$stmt->bindParam(':stock_inkid', $_GET["stock_inkid"], PDO::PARAM_STR);       

		if($stmt->execute()){
			$sql2 = "UPDATE stock_ink_out SET stock_out_ink_new = '0'  
            WHERE stock_ioid = :stock_ioid";
			$stmt = $DB_con->prepare($sql2);                                  
			$stmt->bindParam(':stock_ioid', $_GET["stock_ioid"], PDO::PARAM_STR);             
			$stmt->execute(); 
			header('Location:?p=stock&type=stock_ink&type_see=stock_out&st=success');
		}
	}

	if($_GET["statusaccout"] == "1" && $_GET["sn_acc"] != ""){
		$sql = "UPDATE stock_acc SET stock_income = stock_income - :stock_income  
		WHERE stock_desc = :stock_desc";

		$stmt = $DB_con->prepare($sql);                                  
		$stmt->bindParam(':stock_income', $_GET["stock_income"], PDO::PARAM_STR);         
		$stmt->bindParam(':stock_desc', $_GET["sn_acc"]);      

		if($stmt->execute()){
			$sql2 = "UPDATE stock_acc_out SET stock_out_new = '0'  
            WHERE stock_aoid = :stock_aoid";
			$stmt = $DB_con->prepare($sql2);                                  
			$stmt->bindParam(':stock_aoid', $_GET["stock_aoid"], PDO::PARAM_STR);             
			$stmt->execute(); 
			header('Location:?p=stock&type=stock_acc&type_see=stock_out&st=success');
		}
	}else if($_GET["statusaccout"] == "1" && $_GET["sn_acc"] == ""){
		$sql = "UPDATE stock_acc SET stock_income = stock_income - :stock_income  
		WHERE stock_id = :stock_id";

		$stmt = $DB_con->prepare($sql);                                  
		$stmt->bindParam(':stock_income', $_GET["stock_income"], PDO::PARAM_STR);       
		$stmt->bindParam(':stock_id', $_GET["stock_id"], PDO::PARAM_STR);     

		if($stmt->execute()){
			$sql2 = "UPDATE stock_acc_out SET stock_out_new = '0'  
			WHERE stock_aoid = :stock_aoid";
			$stmt = $DB_con->prepare($sql2);                                  
			$stmt->bindParam(':stock_aoid', $_GET["stock_aoid"], PDO::PARAM_STR);             
			$stmt->execute(); 
			header('Location:?p=stock&type=stock_acc&type_see=stock_out&st=success');
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<?php
	include_once "header.php";
?>

<body>
  	<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
<?php
	include_once "leftmenu.php";
?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
<?php
	include_once "topmenu.php";
?>
      <!-- partial -->
      	<div class="main-panel">
        	<div class="content-wrapper">
<?php
	include_once "status_repair.php";
?>
<?php
	$status_add = $_GET["s"];
	if($status_add == "success"){
?>
		<div class = "status-add-suc"><p>กรุณาจดเลขแจ้งซ่อมที่ขึ้นอยู่บนตารางล่าสุด อัพโหลดข้อมูลเรียบร้อย</p></div>
<?php
	}else if($status_add == ""){
		echo "";
	}else{
?>
		<div class = "status-add-f"><p>แจ้งเตือนไปยัง IT ไม่สำเร็จ</p></div>
<?php
	}
?>
<?php
	switch ($_GET["p"]) {
    case "search":
        include "search.php";
        break;
    case "card":
        include "card.php";
        break;
    case "card_all_status":
        include "card_all.php";
        break;
    case "setting":
    	include "setting.php";
    	break;
    case "setting_card_status";
    	include "status.php";
    	break;
    case "setting_card_user";
    	include "user.php";
    	break;
    case "edit_user";
    	include "edit_u.php";
    	break;
    case "report";
    	include "report.php";
    	break;
    case "repair_all";
    	include "report_all.php";
		break;
	case "stock";
    	include "stock_all.php";
		break;
	case "equip";
		include "equip.php";
		break;
    case "qrcode";
        include "qrcode.php";
        break;
    default:
?>
        <h3 class = "header-p">10 รายการส่งซ่อมล่าสุด</h3>
		<table width="100%" border="0" id="myTable" class="table table-bordered">
    	<thead>
		  	<tr style="color:#FFF; text-align:center; background:#00ce68;">
			  	<td scope="col">วันที่</td>
			    <td scope="col">รหัสส่งซ่อม/เคลม</td>			    
			    <td scope="col">ชื่อผู้ส่งซ่อม/เคลม</td>
			    <td scope="col">เครื่องส่งซ่อม</td>
			    <td scope="col">สถานะ</td>
<?php
	if($a == "2"){
?>
			    <td scope="col">จัดการ</td>
<?php
	}else if($a == "1"){
?>
				<td scope="col">รายละเอียดการซ่อม</td>
<?php
	}else{
		echo "";
	}
?>
		  	</tr>
	  	</thead>
	  	<tbody style="background:#ff7709;">
<?php
        $searchall = "SELECT rp_it.*,card_type.* FROM rp_it,card_type WHERE card_id = repair_status ORDER BY rp_it.repair_time DESC LIMIT 10";
        $querysearch = $user->selectsearch($searchall,$q,$a);  	
?>		    
	    </tbody>
	</table>
<?php
}
?>	
        	</div>

<?php
	include_once "modal.php";
?>  
<?php
	include_once "data/adddata.php";
?>
<?php
    require "ajax/ajax.php";
?>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
			    <footer class="footer">
			        <div class="container-fluid clearfix">
			            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 ระบบนี้ถูกพัฒนาโดย
			              	<a href="#" target="_blank">Perapat Pongsuwan</a>. (พี IT).</span>
			        </div>
			    </footer>
        <!-- partial -->
   		</div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  	</div>
  	<!-- container-scroller -->

<?php
	include_once "footer.php";
	if($a == "2"){
		include "ajax/noti.php";
		// setInterval(5000);
	}
?>
</body>

</html>