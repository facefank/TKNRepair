<?php
	if($a == "1"){
		$user->redirect('../index');
	}
	echo $output;  
	if(isset($_GET["d"])){
		$d = $_GET["d"];
		$deletestatus = "DELETE FROM card_type WHERE card_id = :uid";
		$querydstatus = $user->deleteus($deletestatus,$d);
	}
?>
<button type="button" name="add" id="add" data-toggle="modal" data-target="#add_status_Modal" class="btn btn-warning">Add</button>

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
	$selectstatus = "SELECT * FROM card_type";
	$querystatus = $user->selectss($selectstatus);
?>
	</tbody>
</table>