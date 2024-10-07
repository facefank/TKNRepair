<?php
$q = $_GET["q"];
// echo $q;
$a = $userRow['user_class'];

$u = $userRow['user_name'];
if ($a == "1") {
	$user->redirect('../index');
}
?>
<div class="row flex-grow">
	<div class="col-4 stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row flex-grow">
					<div class="col-xl-6 col-md-12 stretch-card">
						<button class="btn btn-info btn-block set-w-btn-25" data-toggle="modal" data-target="#myModal2">เพิ่มเพิ่มอุปกรณ์
							<i class="mdi mdi-plus"></i>
						</button>
					</div>
					<div class="col-xl-6 col-md-12 stretch-card">
						<button class="btn btn-primary btn-block set-w-btn-25" data-toggle="modal" data-target="#myModal3">เพิ่มหมึกปริ้นเตอร์
							<i class="mdi mdi-plus"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-8 stretch-card">
		<div class="card">
			<div class="card-body">
				<form method="get" role="search" class="search-page">
					<div class="row flex-grow">
						<div class="col-xl-4 col-md-12 stretch-card">
							<input type="hidden" name="p" id="p" value="stock">
							<select required="" name="type" class="form-control" id="exampleFormControlSelect2">
								<option disabled="" selected="" value="">เลือกประเภท</option>
								<option value="stock_acc">อุปกรณ์อื่น</option>
								<option value="stock_ink">หมึกปริ้นเตอร์</option>
							</select>
						</div>
						<div class="col-xl-4 col-md-12 stretch-card">
							<select required="" name="type_see" class="form-control" id="exampleFormControlSelect2">
								<option disabled="" selected="" value="">รับเข้า/เบิก</option>
								<option value="stock_in">รับเข้า</option>
								<option value="stock_out">เบิก</option>
							</select>
						</div>
						<div class="col-xl-4 col-md-12 stretch-card">
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
	if ($_GET["type"] == "") {
	?>

		<h3>Stock หมึกปริ้นเตอร์</h3>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<!-- <td scope="col">วันที่อัพเดท</td> -->
					<td scope="col">ประเภท</td>
					<td scope="col">รุ่น</td>
					<td scope="col">จำนวน</td>
					<td scope="col">แก้ไข</td>
				</tr>
			</thead>
			<tbody style="background:#ff7709;">
				<?php
				$selectsti = "SELECT * FROM stock_ink";
				$querystatus = $user->selectstockink($selectsti);
				?>
			</tbody>
		</table>
		<br>
		<table id="example2" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<td scope="col">stock_date</td>
					<td scope="col">stock_brand</td>
					<td scope="col">stock_series</td>
					<td scope="col">stock_desc</td>
					<td scope="col">stock_income</td>
					<td scope="col">stock_name</td>
					<td scope="col">manage</td>
				</tr>
			</thead>
			<tbody style="background:#ff7709;">
				<?php
				$selectsta = "SELECT * FROM stock_acc";
				$querystatus = $user->selectstockacc($selectsta);
				?>
			</tbody>
		</table>
		<br>

	<?php
	} else {
		if ($_GET["type"] == "stock_acc") {
			$stock_type = "stock_acc";
		} else if ($_GET["type"] == "stock_ink") {
			$stock_type = "stock_ink";
		}

		if ($_GET["type"] == "stock_acc" && $_GET["type_see"] == "stock_in") {
			$stock_io = "stock_acc_income";
		} else if ($_GET["type"] == "stock_acc" && $_GET["type_see"] == "stock_out") {
			$stock_io = "stock_acc,stock_acc_out,dept";
			$stock_wio = "AND stock_acc.stock_id = stock_acc_out.stock_out_acc AND dept.dept_id = stock_acc_out.stock_out_dept";
		} else if ($_GET["type"] == "stock_ink" && $_GET["type_see"] == "stock_in") {
			$stock_io = "stock_ink_income";
		} else if ($_GET["type"] == "stock_ink" && $_GET["type_see"] == "stock_out") {
			$stock_io = "stock_ink,stock_ink_out,dept";
			$stock_wio = "AND stock_ink.stock_inkid = stock_ink_out.stock_out_ink AND dept.dept_id = stock_ink_out.stock_out_ink_dept";
		}
	?>
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="color:#FFF; text-align:center; background:#303030;">
					<?php
					if ($stock_io == "stock_acc_income") {
					?>
						<td scope="col">#</td>
						<td scope="col">ชื่อ</td>
						<td scope="col">ยี่ห้อ</td>
						<td scope="col">รุ่น</td>
						<td scope="col">คำอธิบาย</td>
						<td scope="col">จำนวน</td>
						<td scope="col">วันที่รับเข้า</td>
					<?php
					} else if ($stock_io == "stock_ink_income") {
					?>
						<td scope="col">#</td>
						<td scope="col">ประเภท</td>
						<td scope="col">รุ่น</td>
						<td scope="col">จำนวนรับเข้า</td>
						<td scope="col">วันที่รับเข้า</td>
					<?php
					} else if ($stock_io == "stock_acc,stock_acc_out,dept") {
					?>
						<td scope="col">#</td>
						<td scope="col">ชื่อ</td>
						<td scope="col">จำนวนที่เบิก</td>
						<td scope="col">ผู้เบิก</td>
						<td scope="col">แผนก</td>
						<td scope="col">วันที่เบิก</td>
						<td scope="col">S/N</td>
						<td scope="col">จัดการ</td>
					<?php
					} else if ($stock_io == "stock_ink,stock_ink_out,dept") {
					?>
						<td scope="col">#</td>
						<td scope="col">ชื่อ</td>
						<td scope="col">จำนวนที่เบิก</td>
						<td scope="col">ผู้เบิก</td>
						<td scope="col">แผนก</td>
						<td scope="col">สาขา</td>
						<td scope="col">วันที่เบิก</td>
						<td scope="col">จัดการ</td>
					<?php
					}
					?>
				</tr>
			</thead>
			<tbody style="background:#ff7709;">
				<?php
				$selectstockio = "SELECT * FROM $stock_io WHERE 1 $stock_wio";
				$querystockio = $user->selectstockaccink($selectstockio, $stock_io, $stock_wio);
				// echo $selectstockio;
				?>
			</tbody>
		</table>
	<?php
	}
	?>
</div>