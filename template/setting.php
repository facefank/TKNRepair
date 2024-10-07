<?php
	$q = $_GET["q"];
	// echo $q;
	$a = $userRow['user_class'];

    $u = $userRow['user_name'];
?>
<div class = "settingall">
	<div class = "row flex-grow">
		<div class = "col-12 stretch-card">
			<div class = "card">
				<!-- <div class = "card-body"> -->
					<div class = "setting-box">
						<div class = "setting-head">
							<p>การตั้งค่าการใช้งาน</p>
						</div>
						<a href="?p=setting_card_status">
							<div class = "setting-select">
								<i class="mdi mdi-pin"></i>
								<p>สถานะการซ่อม/เคลม</p>
							</div>
						</a>
						<a href="?p=setting_card_user">
							<div class = "setting-select">
								<i class="mdi mdi-nature-people"></i>
								<p>ตั้งค่าผู้ใช้งาน</p>
							</div>
						</a>
					</div>
				<!-- </div> -->
			</div>
		</div>
	</div>
</div>