<?php
	if($a == "1"){
		$user->redirect('../index');
	}
	echo $output; 

	if(isset($_POST['btn-signup'])){
    	$rand = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ23456789'),0,5);
   		$uname = trim($_POST['txtname']);
	   	$umail = trim($rand."@gmail.com");
	   	$upass = trim($_POST['txtpass']); 
 
	   	if($uname==""){
	      	$error[] = "provide username !"; 
	   	}else if($umail==""){
	      	$error[] = "provide email id !"; 
	   	}else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
	      	$error[] = 'Please enter a valid email address !';
	   	}else if($upass=="") {
	      	$error[] = "provide password !";
	   	}
	   	else if(strlen($upass) < 6){
	      	$error[] = "Password must be atleast 6 characters"; 
	   	}
	   	else{
	      	try{
	         	$stmt = $DB_con->prepare("SELECT user_name,user_email FROM users WHERE user_name=:uname OR user_email=:umail");
	         	$stmt->execute(array(':uname' => $uname, ':umail' => $umail));
	         	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	    
	         	if($row['user_name'] == $uname) {
	            	$error[] = "sorry username already taken !";
	         	}else if($row['user_email'] == $umail) {
	            	$error[] = "sorry email id already taken !";
	         	}else{
	            	if($user->register($fname,$lname,$uname,$umail,$upass)){
	                	$user->redirect('?p=setting_card_user');
	            	}
	         	}
	     	}catch(PDOException $e){
	        	echo $e->getMessage();
	     	}
	  	} 
	} 
	if(isset($_GET["d"])){
		$d = $_GET["d"];
		$deleteuser = "DELETE FROM users WHERE user_id =:uid";
    	$querydu = $user->deleteu($deleteuser,$d);
		// $stmt = $DB_con->prepare('DELETE FROM users WHERE user_id =:uid');
  // 		$stmt->bindParam(':uid',$_GET["d"]);
  // 		$stmt->execute();
	}
?>
<button type="button" name="add" id="add" data-toggle="modal" data-target="#add_user_Modal" class="btn btn-warning">เพิ่มผู้ใช้งาน</button> 

<table class = "table-status">
    <thead>
		<tr>
			<td width = "6%">#</td>
			<td width = "74%">ชื่อสถานะการซ่อม/เคลม</td>
			<td width = "23%">จัดการ</td>
		</tr>
	</thead>
	<tbody>
<?php
	$selectuser = "SELECT * FROM users ORDER BY user_id ASC";
	$queryuser = $user->selectu($selectuser);
?>
	</tbody>
</table>