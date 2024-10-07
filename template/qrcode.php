<?php
error_reporting(0);

error_reporting(E_ERROR | E_WARNING | E_PARSE);

error_reporting(E_ALL);

ini_set("error_reporting", E_ALL);

error_reporting(E_ALL & ~E_NOTICE);
ob_start();
include_once '../config/dbconfig.php';
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
			<div style="margin-left: -15px;">
			<?php
			include_once "topmenu.php";
			?>
			</div>
			<!-- partial -->
			<div class="main-panel">
				<div class="content-wrapper">
					<?php
					include_once "status_repair.php";
					?>
					<?php
					$status_add = $_GET["s"] ?? '';

					if ($status_add === "success") {
						echo '<div class="status-add-suc"><p>กรุณาจดเลขแจ้งซ่อมที่ขึ้นอยู่บนตารางล่าสุด อัพโหลดข้อมูลเรียบร้อย</p></div>';
					} elseif ($status_add !== '') {
						echo '<div class="status-add-f"><p>แจ้งเตือนไปยัง IT ไม่สำเร็จ</p></div>';
					}

					$typeQueryString = $_GET["type"] ?? '';
					$subQueryString = explode('-', $typeQueryString);
					$type = $subQueryString[0] ?? '';
					$eqc_id = $subQueryString[1] ?? '';
					$eqe_id = $subQueryString[1] ?? '';
					

					if ($type === 'pc') {
						$selectQreqc = "SELECT * FROM equip, dept, branch WHERE equip.dept_id = dept.dept_id AND equip.branch_id = branch.branch_id AND equip_id = :eqc_id";
						$queryselectQreqc = $user->selectQrcodeDetial($selectQreqc, $eqc_id);
					} elseif ($type === 'all') {
						// Query สำหรับการเลือกข้อมูลทั้งหมด
						$selectAllQuery = "SELECT * FROM equip_etc WHERE eq_id = :eqe_id";
						$queryselectAll = $user->selectAllQrcodeDetails($selectAllQuery, $eqe_id);
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
						<a href="#" target="_blank">IT Support</a>. (หัวหน้าฝ่าย IT).</span>
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
	?>
</body>

</html>