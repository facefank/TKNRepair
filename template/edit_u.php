<?php
	if($a == "1"){
		$user->redirect('../index');
	}
	echo $output;  
	$key = $_GET["key"];
	if(isset($_POST['btn-updateu'])){
		$newpass = $_POST["edit_password"];
		$passcon = $_POST["edit_repassword"];
		if($newpass != $passcon){
			$confirm_pass = "รหัสผ่านไม่ตรงกัน";
		}else if(strlen($newpass) < 6){
			$confirm_le = "รหัสผ่านน้อยกว่า 6 ตัว";
		}else{
			if($user->updateu($newpass,$key)){
				$confirm_s = "แก้ไขข้อมูลสำเร็จ";
			}
		}
	}
?>
<div class = "box-user">
	<div class = "bu-head">
		<p>แก้ไขข้อมูลผู้ใช้งาน</p>
	</div>
	<div class = "bu-body">
		<form method="post" enctype="multipart/form-data" class="form-horizontal">
			<table width="100%" border="0">
		  		<tbody>
<?php
	$seuser = "SELECT * FROM users WHERE user_id = :uid";
	$querydse = $user->seditu($seuser,$key);
?>		  			
		  			<tr>
		    			<td colspan="2"><hr></td>
		    		</tr>
		  			<tr>
		    			<td>รหัสผ่านใหม่</td>
		    			<td> 
		    				<div class="form-group">
		      					<input type="password" name="edit_password" id="edit_password" class="form-control">
		      				</div>
		      			</td>
		  			</tr>
		  			<tr>
					    <td>ยืนยันรหัสผ่านใหม่</td>
					    <td> 
					    	<div class="form-group">
					      		<input type="password" name="edit_repassword" id="edit_repassword" class="form-control">
					      	</div>
					    </td>
					</tr>
					<p style = "color:red;"><?php echo $confirm_pass; ?></p>
					<p style = "color:red;"><?php echo $confirm_le; ?></p>
					<p style = "color:#00ce68;"><?php echo $confirm_s; ?></p>
				  	<tr>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
				  	</tr>
		        </tbody>
		    </table>
		    <button type="submit" name="btn-updateu" id="add" class="btn btn-warning">อัพเดทผู้ใช้งาน</button> 
		</form>
	</div>
</div>