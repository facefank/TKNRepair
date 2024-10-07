<?php
include"database.class.php";

//create object
$process = new Database();

	//Add_user
	if(isset($_POST['send_name'])){
		//รับข้อมูลจาก FORM ส่งไปที่ Method add_user
		$process->add_user($_POST);
	}
	
	//show edit data form
	if(isset($_POST['show_user_id'])){
		
		$edit_user = $process->get_user($_POST['show_user_id']);

		echo'<form id="edit_user_form">
			  <div class="form-group">
				<label >ชื่อ - สกุล</label>
				<input type="text" class="form-control" name="edit_name" value="'.$edit_user['name'].'">
			  </div>
			  <div class="form-group">
				<label >เบอร์โทรศัพท์</label>
				<input type="text" class="form-control" name="edit_tel" value="'.$edit_user['tel'].'">
			  </div>
			  <input type="hidden" name="edit_user_id" value="'.$edit_user['id'].'" >
			</form>';
	}
	
	//edit user 
	if(isset($_POST['edit_user_id'])){
		
		$process->edit_user($_POST);
		
	}
	
	//delete user
	if(isset($_POST['delete_user_id'])){
		
		$process->delete_user($_POST['delete_user_id']);
	}
	

?>