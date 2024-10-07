<?php
$q = @$_GET["q"];
// echo $q;
$a = $userRow['user_class'];

$u = $userRow['user_name'];
if ($a == "1") {
	$user->redirect('../index');
}

if (isset($_POST["btnsave_eqc"])) {

	//////////////////////////////////////////////////////////////////////////////////
	$branch = $_POST["addtxtbranch_eq"];
	$dept = $_POST["addtxtdept"];
	$namecom = $_POST["addtxtcomname"];
	$nameuser = $_POST["addtxtname"];
	$model = $_POST["addmodel"];
	$serielno = $_POST["addserielno"];
	$type = $_POST["addtype"];
	$cpu = $_POST["addcpu"];
	$gen = $_POST["addGEN"];
	$ram = $_POST["addram"];
	$ssd = $_POST["addssd"];
	$hdd = $_POST["addhdd"];
	$os = $_POST["addos"];
	$office = $_POST["addoffice"];
	$antivirus = $_POST["addantivirus"];
	$ostype = $_POST["addostype"];
	$ip = $_POST["addip"];
	$usb = $_POST["addusb"];
	$macaddress = $_POST["addmacaddress"];
	$status = $_POST["status"];
	$place = $_POST["addplace"];
	$historyplace = $_POST["addhistoryplace"];
	$historyrepair = $_POST["addhistoryrepair"];
	$txtspec = $_POST["addtxtspec"];
	$txtwar_eq = $_POST["addtxtwar_eq"];
	$txtbuy = $_POST["addtxtbuy"];
	$updatetime = date('Y-m-d H:i');


	////////////////////////////////////////////////////////////////////////////////////


	$stmt = $DB_con->prepare("INSERT INTO equip(serial_num,name_user,dept_id,branch_id,name_com,eq_model,eq_type,eq_cpu,eq_cpugen,eq_ram,eq_ssd,eq_hdd,eq_os,eq_office,eq_antivirus,eq_ostype,eq_ip,eq_usb,eq_macaddress,eq_place,eq_historyplace,eq_historyrepair,eq_updatetime,spec,warranty,day_buy) 
	VALUES (:serial_num,:name_user,:dept_id,:branch_id,:name_com,:eq_model,:eq_type,:eq_cpu,:eq_cpugen,:eq_ram,:eq_ssd,:eq_hdd,:eq_os,:eq_office,:eq_antivirus,:eq_ostype,:eq_ip,:eq_usb,:eq_macaddress,:eq_place,:eq_historyplace,:eq_historyrepair,:eq_updatetime,:spec,:warranty,:day_buy)");
	$stmt->bindParam(':serial_num', $serielno);
	$stmt->bindParam(':name_user', $nameuser);
	$stmt->bindParam(':dept_id', $dept);
	$stmt->bindParam(':branch_id', $branch);
	$stmt->bindParam(':name_com', $namecom);
	$stmt->bindParam(':eq_model', $model);
	$stmt->bindParam(':eq_type', $type);
	$stmt->bindParam(':eq_cpu', $cpu);
	$stmt->bindParam(':eq_cpugen', $gen);
	$stmt->bindParam(':eq_ram', $ram);
	$stmt->bindParam(':eq_ssd', $ssd);
	$stmt->bindParam(':eq_hdd', $hdd);
	$stmt->bindParam(':eq_os', $os);
	$stmt->bindParam(':eq_office', $office);
	$stmt->bindParam(':eq_antivirus', $antivirus);
	$stmt->bindParam(':eq_ostype', $ostype);
	$stmt->bindParam(':eq_ip', $ip);
	$stmt->bindParam(':eq_usb', $usb);
	$stmt->bindParam(':eq_macaddress', $macaddress);
	$stmt->bindParam(':eq_place', $place);
	$stmt->bindParam(':eq_historyplace', $historyplace);
	$stmt->bindParam(':eq_historyrepair', $historyrepair);
	$stmt->bindParam(':eq_updatetime', $updatetime);

	$stmt->bindParam(':spec', $txtspec);
	$stmt->bindParam(':warranty', $txtwar_eq);
	$stmt->bindParam(':day_buy', $txtbuy);
	// $stmt->bindParam(':age_used',$ybuy);

	if ($stmt->execute()) {
		$successMSG = "NEW record succesfully inserted ...";
		header('Location:' . $actual_link . '&st=success');
	} else {
		$errMSG = "error while inserting ...";
		header('Location:' . $actual_link . '&st=fail');
	}
}






if (isset($_POST["btnsave_eqe"])) {
	$acc = $_POST["txtacc"];
	$series = $_POST["txtseries"];
	$branch_eqe = $_POST["txtbranch"];
	$serial = $_POST["txtserial"];
	$price = $_POST["txtprice"];
	$war = $_POST["txtwar"];
	$install = $_POST["txtinstall"];
	$user = $_POST["txtuser"];
	$wb = $_POST["txtwb"];
	$dbuy = $_POST["txtdbuy"];
	$statusacc = $_POST["txtaccstatus"];
	// $buy = substr($_POST["txtdbuy"],6,4);
	// $ybuy = @date("Y") - $buy;

	$stmt = $DB_con->prepare("INSERT INTO equip_etc(acc_id,eq_series,branch_id,eq_serial,eq_price,eq_warranty,eq_install,eq_user,eq_wb,eq_buy,status) 
		VALUES (:acc_id,:eq_series,:eq_branch,:eq_serial,:eq_price,:eq_warranty,:eq_install,:eq_user,:eq_wb,:eq_buy,:status)");
	$stmt->bindParam(':acc_id', $acc);
	$stmt->bindParam(':eq_series', $series);
	$stmt->bindParam(':eq_branch', $branch_eqe);
	$stmt->bindParam(':eq_serial', $serial);
	$stmt->bindParam(':eq_price', $price);
	$stmt->bindParam(':eq_warranty', $war);
	$stmt->bindParam(':eq_install', $install);
	$stmt->bindParam(':eq_user', $user);
	$stmt->bindParam(':eq_wb', $wb);
	$stmt->bindParam(':eq_buy', $dbuy);
	$stmt->bindParam(':status', $statusacc);
	// $stmt->bindParam(':eq_age',$ybuy);

	if ($stmt->execute()) {
		$successMSG = "NEW record succesfully inserted ...";
		header('Location:' . $actual_link . '&st=success');
	} else {
		$errMSG = "error while inserting ...";
		header('Location:' . $actual_link . '&st=fail');
	}
}

if (@$_GET["eqc_id"] != "") {
	$sql = "UPDATE equip SET status_eq = '1'  
            WHERE equip_id = :eqc_id";
	$stmt = $DB_con->prepare($sql);
	$stmt->bindParam(':eqc_id', $_GET["eqc_id"], PDO::PARAM_STR);
	$stmt->execute();
}
if (@$_GET["eqe_id"] != "") {
	$sql = "UPDATE equip_etc SET status = '1'  
            WHERE eq_id = :eqe_id";
	$stmt = $DB_con->prepare($sql);
	$stmt->bindParam(':eqe_id', $_GET["eqe_id"], PDO::PARAM_STR);
	$stmt->execute();
}
?>
<div class="row flex-grow">
	<div class="col-6 stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row flex-grow">
					<div class="col-xl-6 col-md-12 stretch-card">
						<button class="btn btn-info btn-block set-w-btn-25" data-toggle="modal" data-target="#myECOM">เพิ่มคอมพิวเตอร์
							<i class="mdi mdi-plus"></i>
						</button>
					</div>
					<div class="col-xl-6 col-md-12 stretch-card">
						<button class="btn btn-primary btn-block set-w-btn-25" data-toggle="modal" data-target="#myETC">เพิ่มอุปกรณ์อื่นๆ
							<i class="mdi mdi-plus"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-6 stretch-card">
		<div class="card">
			<div class="card-body">
				<form method="get" role="search" class="search-page">
					<div class="row flex-grow">
						<div class="col-xl-6 col-md-12 stretch-card">
							<input type="hidden" name="p" id="p" value="equip">
							<select required="" name="type" class="form-control" id="exampleFormControlSelect2">
								<option disabled="" selected="" value="">เลือกประเภท</option>
								<option value="eqc">คอมพิวเตอร์</option>
								<option value="eq7">ปริ๊นเตอร์</option>
								<option value="eq6">คีย์บอร์ด</option>
								<option value="eq5">เมาส์</option>
								<option value="eq4">จอคอมพิวเตอร์</option>
								<option value="eq2">เครื่องสำรองไฟ</option>
								<option value="eq8">กล้องวงจรปิด</option>
								<option value="eq9">โทรศัพท์</option>
								<option value="eq19">IPAD</option>
								<option value="eq16">เครื่องเสียง</option>
								<option value="eq18">โปรเจคเตอร์</option>
								<option value="eq12">HDD-SSD</option>
								<option value="eqe">อุปกรณ์อื่นๆ</option>
							</select>
						</div>
						<div class="col-xl-6 col-md-12 stretch-card">
							<button class="btn btn-success btn-block set-w-btn-25" type="submit">ค้นหา
								<i class="mdi mdi-plus"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="mg-table">
	<?php


	if (@$_GET["type"] == "") {
	?>
		<table id="example" class="table table-striped table-bordered table-responsive " style="width:100%; ">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">#</td>
					<td scope="col">ชื่อผู้ใช้</td>
					<td scope="col">ชื่อเครื่อง</td>
					<td scope="col">แผนก</td>
					<td scope="col">สาขา</td>
					<td scope="col">IP</td>
					<td scope="col">Type</td>
					<td scope="col">CPU</td>
					<td scope="col">CPU Gen</td>
					<td scope="col">RAM</td>
					<td scope="col">SSD</td>
					<td scope="col">HDD</td>
					<td scope="col">OS</td>
					<td scope="col">OS Type</td>
					<td scope="col">Office</td>
					<td scope="col">Antivirus</td>
					<td scope="col">USB</td>
					<td scope="col">MAC Address</td>
					<td scope="col">สถานะ</td>
					<td scope="col">สถานที่ตั้ง</td>
					<td scope="col">ประวัติการใช้งาน</td>
					<td scope="col">ประวัตการซ่อม</td>
					<td scope="col">วันที่อัพเดทข้อมูล</td>
					<td scope="col">รายละเอียดโปรแกรมและอื่น ๆ</td>
					<td scope="col">วันที่ประกัน</td>
					<td scope="col">วันที่ซื้อ</td>
					<!-- <td scope="col">อายุการใช้งาน</td> -->
					<td scope="col">Model</td>
					<td scope="col">S/N</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($userRow['user_superclass'] == "2") {
					$spu = $userRow['user_superclass'];
					$selecteqc = "SELECT * FROM equip,dept,branch WHERE equip.dept_id = dept.dept_id AND equip.branch_id = branch.branch_id";
					$queryselecteqc = $user->seqc($selecteqc, $spu);
				} else {
					$spu = $userRow['user_superclass'];
					$selecteqc = "SELECT * FROM equip,dept,branch WHERE equip.dept_id = dept.dept_id AND equip.branch_id = branch.branch_id";
					$queryselecteqc = $user->seqc($selecteqc, $spu);
				}
				?>
			</tbody>
		</table>
	<?php
	}
	if (@$_GET["type"] == "eqc") {
		?>
			<table id="example" class="table table-striped table-bordered table-responsive " style="width:100%; ">
				<thead>
					<tr style="color:#FFF; text-align:center; background:#303030;">
						<td scope="col">#</td>
						<td scope="col">ชื่อผู้ใช้</td>
						<td scope="col">ชื่อเครื่อง</td>
						<td scope="col">แผนก</td>
						<td scope="col">สาขา</td>
						<td scope="col">IP</td>
						<td scope="col">Type</td>
						<td scope="col">CPU</td>
						<td scope="col">CPU Gen</td>
						<td scope="col">RAM</td>
						<td scope="col">SSD</td>
						<td scope="col">HDD</td>
						<td scope="col">OS</td>
						<td scope="col">OS Type</td>
						<td scope="col">Office</td>
						<td scope="col">Antivirus</td>
						<td scope="col">USB</td>
						<td scope="col">MAC Address</td>
						<td scope="col">สถานะ</td>
						<td scope="col">สถานที่ตั้ง</td>
						<td scope="col">ประวัติการใช้งาน</td>
						<td scope="col">ประวัตการซ่อม</td>
						<td scope="col">วันที่อัพเดทข้อมูล</td>
						<td scope="col">รายละเอียดโปรแกรมและอื่น ๆ</td>
						<td scope="col">วันที่ประกัน</td>
						<td scope="col">วันที่ซื้อ</td>
						<!-- <td scope="col">อายุการใช้งาน</td> -->
						<td scope="col">Model</td>
						<td scope="col">S/N</td>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($userRow['user_superclass'] == "2") {
						$spu = $userRow['user_superclass'];
						$selecteqc = "SELECT * FROM equip,dept,branch WHERE equip.dept_id = dept.dept_id AND equip.branch_id = branch.branch_id";
						$queryselecteqc = $user->seqc($selecteqc, $spu);
					} else {
						$spu = $userRow['user_superclass'];
						$selecteqc = "SELECT * FROM equip,dept,branch WHERE equip.dept_id = dept.dept_id AND equip.branch_id = branch.branch_id";
						$queryselecteqc = $user->seqc($selecteqc, $spu);
					}
					?>
				</tbody>
			</table>
		<?php
		}

	if (@$_GET["type"] == "eq7") {
	?>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">#</td>
					<td scope="col">อุปกรณ์</td>
					<td scope="col">รุ่น</td>
					<td scope="col">สาขา</td>
					<td scope="col">ซีเรียล</td>
					<td scope="col">สถานะ</td>
					<td scope="col">ราคา</td>
					<td scope="col">วันที่ประกัน</td>
					<td scope="col">ติดตั้ง</td>
					<td scope="col">ผู้ใช้</td>
					<td scope="col">สถานที่ซื้อ</td>
					<td scope="col">วันที่ซื้อ</td>
					<td scope="col">อายุการใช้งาน</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($userRow['user_superclass'] == "2") {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 7";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				} else {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 7";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				}
				?>

			</tbody>
		</table>
	<?php
	}

	if (@$_GET["type"] == "eq6") {
	?>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">#</td>
					<td scope="col">อุปกรณ์</td>
					<td scope="col">รุ่น</td>
					<td scope="col">สาขา</td>
					<td scope="col">ซีเรียล</td>
					<td scope="col">สถานะ</td>
					<td scope="col">ราคา</td>
					<td scope="col">วันที่ประกัน</td>
					<td scope="col">ติดตั้ง</td>
					<td scope="col">ผู้ใช้</td>
					<td scope="col">สถานที่ซื้อ</td>
					<td scope="col">วันที่ซื้อ</td>
					<td scope="col">อายุการใช้งาน</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($userRow['user_superclass'] == "2") {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 6";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				} else {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 6";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				}
				?>

			</tbody>
		</table>
	<?php
	}
	if (@$_GET["type"] == "eq19") {
	?>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">#</td>
					<td scope="col">อุปกรณ์</td>
					<td scope="col">รุ่น</td>
					<td scope="col">สาขา</td>
					<td scope="col">ซีเรียล</td>
					<td scope="col">สถานะ</td>
					<td scope="col">ราคา</td>
					<td scope="col">วันที่ประกัน</td>
					<td scope="col">ติดตั้ง</td>
					<td scope="col">ผู้ใช้</td>
					<td scope="col">สถานที่ซื้อ</td>
					<td scope="col">วันที่ซื้อ</td>
					<td scope="col">อายุการใช้งาน</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($userRow['user_superclass'] == "2") {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 19";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				} else {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 19";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				}
				?>

			</tbody>
		</table>
	<?php
	}

	if (@$_GET["type"] == "eq5") {
	?>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">#</td>
					<td scope="col">อุปกรณ์</td>
					<td scope="col">รุ่น</td>
					<td scope="col">สาขา</td>
					<td scope="col">ซีเรียล</td>
					<td scope="col">สถานะ</td>
					<td scope="col">ราคา</td>
					<td scope="col">วันที่ประกัน</td>
					<td scope="col">ติดตั้ง</td>
					<td scope="col">ผู้ใช้</td>
					<td scope="col">สถานที่ซื้อ</td>
					<td scope="col">วันที่ซื้อ</td>
					<td scope="col">อายุการใช้งาน</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($userRow['user_superclass'] == "2") {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 5";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				} else {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 5	";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				}
				?>

			</tbody>
		</table>
	<?php
	}

	if (@$_GET["type"] == "eq4") {
	?>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">#</td>
					<td scope="col">อุปกรณ์</td>
					<td scope="col">รุ่น</td>
					<td scope="col">สาขา</td>
					<td scope="col">ซีเรียล</td>
					<td scope="col">สถานะ</td>
					<td scope="col">ราคา</td>
					<td scope="col">วันที่ประกัน</td>
					<td scope="col">ติดตั้ง</td>
					<td scope="col">ผู้ใช้</td>
					<td scope="col">สถานที่ซื้อ</td>
					<td scope="col">วันที่ซื้อ</td>
					<td scope="col">อายุการใช้งาน</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($userRow['user_superclass'] == "2") {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 4";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				} else {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 4";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				}
				?>

			</tbody>
		</table>
	<?php
	}
	if (@$_GET["type"] == "eq3") {
	?>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">#</td>
					<td scope="col">อุปกรณ์</td>
					<td scope="col">รุ่น</td>
					<td scope="col">สาขา</td>
					<td scope="col">ซีเรียล</td>
					<td scope="col">สถานะ</td>
					<td scope="col">ราคา</td>
					<td scope="col">วันที่ประกัน</td>
					<td scope="col">ติดตั้ง</td>
					<td scope="col">ผู้ใช้</td>
					<td scope="col">สถานที่ซื้อ</td>
					<td scope="col">วันที่ซื้อ</td>
					<td scope="col">อายุการใช้งาน</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($userRow['user_superclass'] == "2") {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 3";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				} else {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 3";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				}
				?>

			</tbody>
		</table>
	<?php
	}
	if (@$_GET["type"] == "eq2") {
	?>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">#</td>
					<td scope="col">อุปกรณ์</td>
					<td scope="col">รุ่น</td>
					<td scope="col">สาขา</td>
					<td scope="col">ซีเรียล</td>
					<td scope="col">สถานะ</td>
					<td scope="col">ราคา</td>
					<td scope="col">วันที่ประกัน</td>
					<td scope="col">ติดตั้ง</td>
					<td scope="col">ผู้ใช้</td>
					<td scope="col">สถานที่ซื้อ</td>
					<td scope="col">วันที่ซื้อ</td>
					<td scope="col">อายุการใช้งาน</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($userRow['user_superclass'] == "2") {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 2";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				} else {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 2";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				}
				?>

			</tbody>
		</table>
	<?php
	}
	if (@$_GET["type"] == "eq8") {
	?>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">#</td>
					<td scope="col">อุปกรณ์</td>
					<td scope="col">รุ่น</td>
					<td scope="col">สาขา</td>
					<td scope="col">ซีเรียล</td>
					<td scope="col">สถานะ</td>
					<td scope="col">ราคา</td>
					<td scope="col">วันที่ประกัน</td>
					<td scope="col">ติดตั้ง</td>
					<td scope="col">ผู้ใช้</td>
					<td scope="col">สถานที่ซื้อ</td>
					<td scope="col">วันที่ซื้อ</td>
					<td scope="col">อายุการใช้งาน</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($userRow['user_superclass'] == "2") {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 8";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				} else {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 8";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				}
				?>

			</tbody>
		</table>
	<?php
	}
	if (@$_GET["type"] == "eq9") {
	?>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">#</td>
					<td scope="col">อุปกรณ์</td>
					<td scope="col">รุ่น</td>
					<td scope="col">สาขา</td>
					<td scope="col">ซีเรียล</td>
					<td scope="col">สถานะ</td>
					<td scope="col">ราคา</td>
					<td scope="col">วันที่ประกัน</td>
					<td scope="col">ติดตั้ง</td>
					<td scope="col">ผู้ใช้</td>
					<td scope="col">สถานที่ซื้อ</td>
					<td scope="col">วันที่ซื้อ</td>
					<td scope="col">อายุการใช้งาน</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($userRow['user_superclass'] == "2") {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 9";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				} else {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 9";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				}
				?>

			</tbody>
		</table>
	<?php
	}
	if (@$_GET["type"] == "eq13") {
	?>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">#</td>
					<td scope="col">อุปกรณ์</td>
					<td scope="col">รุ่น</td>
					<td scope="col">สาขา</td>
					<td scope="col">ซีเรียล</td>
					<td scope="col">สถานะ</td>
					<td scope="col">ราคา</td>
					<td scope="col">วันที่ประกัน</td>
					<td scope="col">ติดตั้ง</td>
					<td scope="col">ผู้ใช้</td>
					<td scope="col">สถานที่ซื้อ</td>
					<td scope="col">วันที่ซื้อ</td>
					<td scope="col">อายุการใช้งาน</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($userRow['user_superclass'] == "2") {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 13";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				} else {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 13";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				}
				?>

			</tbody>
		</table>
	<?php
	}

	if (@$_GET["type"] == "eq16") {
	?>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">#</td>
					<td scope="col">อุปกรณ์</td>
					<td scope="col">รุ่น</td>
					<td scope="col">สาขา</td>
					<td scope="col">ซีเรียล</td>
					<td scope="col">สถานะ</td>
					<td scope="col">ราคา</td>
					<td scope="col">วันที่ประกัน</td>
					<td scope="col">ติดตั้ง</td>
					<td scope="col">ผู้ใช้</td>
					<td scope="col">สถานที่ซื้อ</td>
					<td scope="col">วันที่ซื้อ</td>
					<td scope="col">อายุการใช้งาน</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($userRow['user_superclass'] == "2") {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 16";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				} else {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 16";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				}
				?>

			</tbody>
		</table>
	<?php
	}

	if (@$_GET["type"] == "eq18") {
	?>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">#</td>
					<td scope="col">อุปกรณ์</td>
					<td scope="col">รุ่น</td>
					<td scope="col">สาขา</td>
					<td scope="col">ซีเรียล</td>
					<td scope="col">สถานะ</td>
					<td scope="col">ราคา</td>
					<td scope="col">วันที่ประกัน</td>
					<td scope="col">ติดตั้ง</td>
					<td scope="col">ผู้ใช้</td>
					<td scope="col">สถานที่ซื้อ</td>
					<td scope="col">วันที่ซื้อ</td>
					<td scope="col">อายุการใช้งาน</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($userRow['user_superclass'] == "2") {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 18";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				} else {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 18";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				}
				?>

			</tbody>
		</table>
	<?php
	}



	if (@$_GET["type"] == "eq12") {
	?>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">#</td>
					<td scope="col">อุปกรณ์</td>
					<td scope="col">รุ่น</td>
					<td scope="col">สาขา</td>
					<td scope="col">ซีเรียล</td>
					<td scope="col">สถานะ</td>
					<td scope="col">ราคา</td>
					<td scope="col">วันที่ประกัน</td>
					<td scope="col">ติดตั้ง</td>
					<td scope="col">ผู้ใช้</td>
					<td scope="col">สถานที่ซื้อ</td>
					<td scope="col">วันที่ซื้อ</td>
					<td scope="col">อายุการใช้งาน</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($userRow['user_superclass'] == "2") {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 12";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				} else {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc, acc, branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id AND equip_etc.acc_id = 12";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				}
				?>

			</tbody>
		</table>
	<?php
	}



	if (@$_GET["type"] == "eqe" && $_GET["type"] != "") {
	?>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">#</td>
					<td scope="col">อุปกรณ์</td>
					<td scope="col">รุ่น</td>
					<td scope="col">สาขา</td>
					<td scope="col">ซีเรียล</td>
					<td scope="col">สถานะ</td>
					<td scope="col">ราคา</td>
					<td scope="col">วันที่ประกัน</td>
					<td scope="col">ติดตั้ง</td>
					<td scope="col">ผู้ใช้</td>
					<td scope="col">สถานที่ซื้อ</td>
					<td scope="col">วันที่ซื้อ</td>
					<td scope="col">อายุการใช้งาน</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($userRow['user_superclass'] == "2") {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc,acc,branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				} else {
					$spu = $userRow['user_superclass'];
					$selecteqe = "SELECT * FROM equip_etc,acc,branch WHERE equip_etc.acc_id = acc.acc_id AND equip_etc.branch_id = branch.branch_id";
					$queryselecteqe = $user->seqe($selecteqe, $spu);
				}
				?>
			</tbody>
		</table>
	<?php
	} 
	?>
</div>