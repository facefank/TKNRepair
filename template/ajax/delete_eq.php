<?php
//fetch.php  
$connect = mysqli_connect("localhost", "root", "", "tkncoth_repair");
// if(isset($_POST["employee_id"])){  
//   	$query = "SELECT rp_it.*,card_type.* FROM rp_it,card_type WHERE card_id = repair_status AND repair_id = '".$_POST["employee_id"]."'";  
//   	$result = mysqli_query($connect, $query);  
//  	$row = mysqli_fetch_array($result);  
//   	echo json_encode($row);  
// }  
// if(isset($_POST["status_id"])){  
//   	$query = "SELECT * FROM card_type WHERE card_id = '".$_POST["status_id"]."'";  
//   	$result = mysqli_query($connect, $query);  
//  	$row = mysqli_fetch_array($result);  
//   	echo json_encode($row);  
//  } 
// if(isset($_POST["eq_id"])){  
// 	$query = "SELECT * FROM equip_etc WHERE eq_id = '".$_POST["eq_id"]."'";  
// 	$result = mysqli_query($connect, $query);  
//    	$row = mysqli_fetch_array($result);  
// 	echo json_encode($row);  
// }
if (isset($_POST["equip_id"])) {
	$equip_id = mysqli_real_escape_string($connect, $_POST["equip_id"]);
	$query = "DELETE FROM `equip` WHERE equip_id = '$equip_id'";
	$result = mysqli_query($connect, $query);
	if ($result) {
		$res = array(
			"message" => "Deleted",
			"status" => "success"
		);
	} else {
		$res = array(
			"message" => "Error deleting record",
			"status" => "error"
		);
	}
	echo json_encode($res);
}

// การลบข้อมูลจากตาราง `equip_etc`
if (isset($_POST["eq_id"])) {
	$eq_id = mysqli_real_escape_string($connect, $_POST["eq_id"]);
	$query = "DELETE FROM `equip_etc` WHERE eq_id = '$eq_id'";
	$result = mysqli_query($connect, $query);
	if ($result) {
		$res = array(
			"message" => "Deleted",
			"status" => "success"
		);
	} else {
		$res = array(
			"message" => "Error deleting record",
			"status" => "error"
		);
	}
	echo json_encode($res);
}
// if(isset($_POST["stock_id"])){  
// 	$query = "SELECT * FROM stock_acc WHERE stock_id = '".$_POST["stock_id"]."'";  
// 	$result = mysqli_query($connect, $query);  
//    	$row = mysqli_fetch_array($result);  
// 	echo json_encode($row);  
// }
// if(isset($_POST["stock_inkid"])){  
// 	$query = "SELECT * FROM stock_ink WHERE stock_inkid = '".$_POST["stock_inkid"]."'";  
// 	$result = mysqli_query($connect, $query);  
//    	$row = mysqli_fetch_array($result);  
// 	echo json_encode($row);  
// }
