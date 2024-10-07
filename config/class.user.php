<?php
class USER
{
	private $db;

	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

	public function register($fname, $lname, $uname, $umail, $upass)
	{
		try {
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			$stmt = $this->db->prepare("INSERT INTO users(user_name,user_email,user_pass) 
	                    VALUES(:uname, :umail, :upass)");

			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);
			$stmt->execute();

			return $stmt;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function login($uname, $umail, $upass, $ucheck)
	{
		try {
			$stmt = $this->db->prepare("SELECT * FROM users WHERE user_name=:uname OR user_email=:umail LIMIT 1");
			$stmt->execute(array(':uname' => $uname, ':umail' => $umail));
			$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($stmt->rowCount() > 0) {
				if (password_verify($upass, $userRow['user_pass'])) {
					$_SESSION['user_session'] = $userRow['user_id'];
					if ($ucheck == "1") {
						setcookie("userid", $userRow['user_name'], time() + 3600 * 24 * 356);
						setcookie("userpass", $upass, time() + 3600 * 24 * 356);
					}
					return true;
				} else {
					return false;
				}
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function is_loggedin()
	{
		if (isset($_SESSION['user_session'])) {
			return true;
		}
	}

	public function redirect($url)
	{
		header("Location: $url");
	}

	public function logout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}

	public function menu($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			// echo $query;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
				<li class="nav-item">
					<a class="nav-link" href="?p=<?php echo $row["menu_link"]; ?>">
						<i class="menu-icon mdi <?php echo $row["menu_icon"]; ?>"></i>
						<span class="menu-title" style="color: #f4f7f6; font-size: 15px;"><?php echo $row["menu_name"]; ?></span>
					</a>
				</li>
			<?php
			}
		}
	}

	public function selectbranch($branch)
	{
		$stmt = $this->db->prepare($branch);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<option value="<?php echo $row["branch_name"] ?>"><?php echo $row["branch_name"] ?></option>
			<?php
			}
		}
	}

	public function selectdept($dept)
	{
		$stmt = $this->db->prepare($dept);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<option value="<?php echo $row["dept_name"] ?>"><?php echo $row["dept_name"] ?></option>
			<?php
			}
		}
	}

	public function selectbranch_id($branch_id)
	{
		$stmt = $this->db->prepare($branch_id);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<option value="<?php echo $row["branch_id"] ?>"><?php echo $row["branch_name"] ?></option>
			<?php
			}
		}
	}

	public function selectdept_id($dept_id)
	{
		$stmt = $this->db->prepare($dept_id);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<option value="<?php echo $row["dept_id"] ?>"><?php echo $row["dept_name"] ?></option>
			<?php
			}
		}
	}

	public function selectacc($acc)
	{
		$stmt = $this->db->prepare($acc);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<option value="<?php echo $row["acc_name"] ?>"><?php echo $row["acc_name"] ?></option>
			<?php
			}
		}
	}

	public function selectacc_id($acc_id)
	{
		$stmt = $this->db->prepare($acc_id);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<option value="<?php echo $row["acc_id"] ?>"><?php echo $row["acc_name"] ?></option>
			<?php
			}
		}
	}

	public function selectall($all)
	{
		$stmt = $this->db->prepare($all);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr>
					<td scope="row" data-label="รหัสการส่งซ่อม"><a href="?q=<?php echo $row["repair_id"] ?>&p=search"><?php echo $row["repair_id"] ?></a></td>
					<td data-label="อุปกรณ์"><?php echo $row["repair_acc"] ?></td>
					<td data-label="ชื่อผู้แจ้ง"><?php echo $row["repair_name"] ?></td>
					<td data-label="สถานะ">
						<p class="status-border" style="background-color:<?php echo $row["card_color"] ?>;">
							<?php echo $row["card_name"] ?>
						</p>
					</td>
					<td data-label="เวลา"><?php echo $row["repair_time"] ?></td>
				</tr>
			<?php
			}
		}
	}

	public function selectcall($call)
	{
		$stmt = $this->db->prepare($call);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<h3 class="font-weight-medium text-right mb-0"><?php echo $row["c"] ?></h3>
			<?php
			}
		}
	}

	public function selectdall($dall)
	{
		$stmt = $this->db->prepare($dall);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<h3 class="font-weight-medium text-right mb-0"><?php echo $row["d"] ?></h3>
			<?php
			}
		}
	}

	public function selectdalll($dall)
	{
		$stmt = $this->db->prepare($dall);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<h3 class="font-weight-medium text-right mb-0"><?php echo $row["total_income"] ?></h3>
			<?php
			}
		}
	}

	public function selectuall($uall, $username)
	{
		$stmt = $this->db->prepare($uall);
		$stmt->bindParam(':uwarning', $username);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<h3 class="font-weight-medium text-right mb-0"><?php echo $row["u"] ?></h3>
			<?php
			}
		}
	}

	public function selecteqall($eqall)
	{
		$stmt = $this->db->prepare($eqall);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<h3 class="font-weight-medium text-right mb-0"><?php echo $row["e"] ?></h3>
			<?php
			}
		}
	}

	public function selecteqalll($eqalll)
	{
		$stmt = $this->db->prepare($eqalll);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<a class="font-weight-medium text-right mb-0 " style="font-size: small;"><?php echo $row["e"] ?></a>
				<a class="font-weight-medium text-right mb-0"><?php echo $row["d"] ?></a>
				<br>
			<?php
			}
		}
	}



	public function selectsearch($searchall, $q, $a)
	{
		$stmt = $this->db->prepare($searchall);
		$stmt->bindParam(':urpid', $q);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr style="font-weight:bold;" id="<?php echo $row["repair_id"] ?>">
					<td data-label="เวลา" align="center"><?php echo $row["repair_time"] ?></td>
					<td scope="row" data-label="รหัสการส่งซ่อม" align="center"><a href="?q=<?php echo $row["repair_id"] ?>&p=search"><?php echo $row["repair_id"] ?></a></td>
					<td data-label="ชื่อผู้แจ้ง"><?php echo $row["repair_name"] ?></td>
					<td data-label="อุปกรณ์"><?php echo $row["repair_acc"] ?></td>
					<td data-label="สถานะ" align="center">
						<p class="status-border" style="background-color:<?php echo $row["card_color"] ?>;">
							<?php echo $row["card_name"] ?>
						</p>
					</td>
					<?php
					if ($a == "2") {
					?>
						<td data-label="จัดการ" align="right">
							<input type="button" name="edit" value="Edit" id="<?php echo $row["repair_id"]; ?>" class="btn btn-info btn-xs edit_data" />
							<a href="?p=card_all_status&amp;key=<?php echo $row["repair_id"]; ?>" class="btn btn-xs btn-success" title="ประวัติ">
								รายละเอียด<i class="fa fa-history"></i>
							</a>
							<a href="card/print_card.php?key=<?php echo $row["repair_id"]; ?>" target="_blank" class="btn btn-xs btn-warning" title="พิมพ์">
								<i class="fa fa-print"></i>
							</a>
						</td>
					<?php
					} else if ($a == "1") {
						echo '<td data-label="รายละเอียดการซ่อม">' . $row["repair_comment"] . '</td>';
					}
					?>
				</tr>
			<?php
			}
		} else {
			echo "ไม่พบข้อมูล ....";
		}
	}

	public function selectallsee($allsee, $key)
	{
		$stmt = $this->db->prepare($allsee);
		$stmt->bindParam(':ukey', $key);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<style>
					/* Style for the entire container */
					.all-s1 {
						border: 1px solid #ddd;
						border-radius: 8px;
						padding: 20px;
						background-color: #f9f9f9;
						margin: 20px 0;
						font-size: 19px;
					}

					/* Header style */
						.all-shead1 {
							font-size: 1.5em;
							color: white;
							padding-bottom: 10px;
							margin-bottom: 20px;
							background-color: #303030;
							text-align: center;					
						}

					/* Panel body style */
					.panel-body {
						padding: 15px;
						background-color: #f4f4f4;
						border-radius: 8px;
					}

					/* Row style for form groups */
					.row.form-group {
						margin-bottom: 10px;
					}

					/* Column style */
					.col-md-3 {
						padding-right: 10px;
					}

					/* Strong tag styling */
					strong {
						color: #333;
					}

					/* Image styling */
					img {
						border-radius: 8px;
						box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
						margin-top: 10px;
					}

					/* Style for images */
					img.fixed-size {
						
						width: 80%;
						height: 80%;
						object-fit: cover;
						/* ทำให้ภาพไม่ผิดสัดส่วน */
						border-radius: 8px;
						/* ทำให้มุมของภาพโค้งมน */
						box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
						/* เพิ่มเงาให้ภาพ */
						margin-top: 10px;
						/* ระยะห่างด้านบนของภาพ */
					}


					/* Responsive adjustments */
					@media (max-width: 768px) {
						.col-md-3 {
							width: 100%;
							padding-right: 0;
							margin-bottom: 10px;
						}

						.col-md-9 {
							width: 100%;
							padding-right: 0;
						}

						.img {
							width: 100%;
						}
					}
				</style>
				<div class="all-s1">
					<div class="all-shead1" >
						รายละเอียดผู้ส่งซ่อม/เคลม
					</div>
					<div class="panel-body">
						<div class="row form-group">
							<div class="col-md-3"><strong>รหัสการส่งซ่อม/เคลม :</strong></div>
							<div class="col-md-3"><?php echo $row["repair_id"] ?></div>
							<div class="col-md-3"><strong>วันที่ :</strong></div>
							<div class="col-md-3"><?php echo $row["repair_time"] ?></div>
						</div>
						<div class="row form-group">
							<div class="col-md-3"><strong>ชื่อผู้ส่งซ่อม :</strong></div>
							<div class="col-md-3"><?php echo $row["repair_name"] ?></div>
							<div class="col-md-3"><strong>สาขา :</strong></div>
							<div class="col-md-3"><?php echo $row["repair_branch"] ?></div>
						</div>
						<div class="row form-group">
							<div class="col-md-3"><strong>แผนก :</strong></div>
							<div class="col-md-3"><?php echo $row["repair_dept"] ?></div>
							<div class="col-md-3"><strong>เครื่องที่แจ้งซ่อม :</strong></div>
							<div class="col-md-3"><?php echo $row["repair_acc"] ?></div>
						</div>
						<div class="row form-group">
							<div class="col-md-3"><strong>รายละเอียด :</strong></div>
							<div class="col-md-3" style="color:#00BB32"><strong><?php echo $row["repair_desc"] ?></strong></div>
							<div class="col-md-3"><strong>รายละเอียดการซ่อม :</strong></div>
							<div class="col-md-3"><?php echo $row["repair_comment"] ?></div>
						</div><br><br>
						<div class="row form-group">
							<div class="col-md-12"style="text-align: center; " ><strong>รูปภาพ</strong></div>
							<br>
							<div class="col-md-12" style="text-align: center; ">
								<?php
								if ($row["repair_img"] == "no_image_file") {
									echo "ไม่มีรูปภาพ";
								} else {
								?>
									<img class="fixed-size" src="../upload_images/<?php echo $row["repair_img"] ?>" alt="Repair Image">
							</div>
						<?php
								}
						?>
						</div>
					</div>

				</div>
			<?php
			}
		}
	}

	public function selectsearchu($searchu, $a, $u)
	{
		$stmt = $this->db->prepare($searchu);
		// $stmt->bindParam(':urpid',$q);
		$stmt->bindParam(':uu', $u);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr style="font-weight:bold;" id="<?php echo $row["repair_id"] ?>">
					<td scope="row" data-label="รหัสการส่งซ่อม" align="center"><?php echo $row["repair_id"] ?></td>
					<td data-label="เวลา" align="center"><?php echo $row["repair_time"] ?></td>
					<td data-label="ชื่อผู้แจ้ง"><?php echo $row["repair_name"] ?></td>
					<td data-label="อุปกรณ์"><?php echo $row["repair_acc"] ?></td>
					<td data-label="สถานะ" align="center">
						<p class="status-border" style="background-color:<?php echo $row["card_color"] ?>;">
							<?php echo $row["card_name"] ?>
						</p>
					</td>
					<?php
					if ($a == 2) {
					?>
						<td data-label="สถานะ" align="right">
							<input type="button" name="edit" value="Edit" id="<?php echo $row["repair_id"]; ?>" class="btn btn-info btn-xs edit_data" />
							<a href="?p=card_all_status&amp;key=<?php echo $row["repair_id"] ?>" class="btn btn-xs btn-success" title="ประวัติ">
								รายละเอียด<i class="fa fa-history"></i>
							</a>
							<a href="card/print_card.php?key=<?php echo $row["repair_id"] ?>" target="_blank" class="btn btn-xs btn-warning" title="พิมพ์">
								<i class="fa fa-print"></i>
							</a>
						</td>
					<?php
					} else if ($a == 1) {
						echo '<td data-label="รายละเอียดการซ่อม">' . $row["repair_comment"] . '</td>';
					}
					?>
				</tr>
			<?php
			}
		} else {
			echo "ไม่พบข้อมูล ....";
		}
	}

	public function selectss($selectstatus)
	{
		$stmt = $this->db->prepare($selectstatus);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr style="font-weight:bold;" id="<?php echo $row["card_id"] ?>">
					<td scope="row" data-label="Account" align="center">
						<?php echo $row["card_id"] ?>
					</td>
					<td data-label="Due Date" align="center">
						<p style="color:<?php echo $row["card_color"] ?>;">
							<?php echo $row["card_name"] ?>
						</p>
					</td>
					<td data-label="Name">
						<input type="button" name="edit" value="Edit" id="<?php echo $row["card_id"] ?>" class="btn btn-info btn-xs edit_status" />
						<a href="?p=setting_card_status&d=<?php echo $row["card_id"] ?>" class="btn btn-danger btn-xs">ลบ</a>
					</td>
				</tr>
			<?php
			}
		} else {
			echo "ไม่พบข้อมูล ....";
		}
	}

	public function selectcd($selectcard)
	{
		$stmt = $this->db->prepare($selectcard);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<option value="<?php echo $row["card_id"] ?>"><?php echo $row["card_name"] ?></option>
			<?php
			}
		} else {
			echo "ไม่พบข้อมูล ....";
		}
	}

	public function selectup($selectupdate)
	{
		$stmt = $this->db->prepare($selectupdate);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<div class="dropdown-divider"></div>
				<a href="?p=search&q=<?php echo $row["repair_id"] ?>&n=set_default" class="dropdown-item preview-item">
					<div class="preview-thumbnail">
						<img src="../images/faces-clipart/pic-1.png" alt="image" class="profile-pic">
					</div>
					<div class="preview-item-content flex-grow">
						<h6 class="preview-subject ellipsis font-weight-medium text-dark">
							<?php echo $row["repair_name"] ?>
							<!-- <span class="float-right font-weight-light small-text">1 Minutes ago</span> -->
						</h6>
						<p class="font-weight-light small-text"><?php echo $row["repair_acc"] ?></p>
					</div>
				</a>

			<?php
			}
		} else {
			echo "";
		}
	}

	public function selectupcount($selectupdatecount)
	{
		$stmt = $this->db->prepare($selectupdatecount);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" data-toggle="dropdown" aria-expanded="false">
					<i class="mdi mdi-file-document-box"></i>
					<span class="count"><?php echo $row["c"] ?></span>
				</a>
			<?php
			}
		} else {
			echo "";
		}
	}

	public function selectupcounth($selectupdatecounth)
	{
		$stmt = $this->db->prepare($selectupdatecounth);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<div class="dropdown-item">
					<p class="mb-0 font-weight-normal float-left">มีแจ้งซ่อมใหม่</p>
					<span class="badge badge-info badge-pill float-right"><?php echo $row["c"] ?></span>
				</div>
			<?php
			}
		} else {
			echo "";
		}
	}

	public function selectu($selectuser)
	{
		$stmt = $this->db->prepare($selectuser);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr style="font-weight:bold;" id="<?php echo $row["user_id"] ?>">
					<td scope="row" data-label="Account" align="center">
						<?php echo $row["user_id"] ?>
					</td>
					<td data-label="Due Date" align="center">
						<p>
							<?php echo $row["user_name"] ?>
						</p>
					</td>
					<td data-label="Name">
						<a href="?p=edit_user&key=<?php echo $row["user_id"] ?>" name="edit" value="Edit" class="btn btn-info btn-xs edit_user" />Edit</a>
						<a href="?p=setting_card_user&d=<?php echo $row["user_id"] ?>" class="btn btn-danger btn-xs delete_user">ลบ</a>
					</td>
				</tr>
			<?php
			}
		} else {
			echo "ไม่พบข้อมูล ....";
		}
	}

	public function deleteu($deleteuser, $d)
	{
		$stmt = $this->db->prepare($deleteuser);
		$stmt->bindparam(":uid", $d);
		$stmt->execute();
		return true;
	}

	public function deleteus($deletestatus, $d)
	{
		$stmt = $this->db->prepare($deletestatus);
		$stmt->bindParam(":uid", $d);
		$stmt->execute();
		return true;
	}

	public function seditu($seuser, $key)
	{
		$stmt = $this->db->prepare($seuser);
		$stmt->bindParam(":uid", $key);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr>
					<td width="28%">ชื่อผู้ใช้งาน</td>
					<td width="72%">
						<div class="form-group">
							<input name="edit_username" type="text" disabled="disabled" id="edit_username" value="<?php echo $row["user_name"] ?>" class="form-control">
						</div>
					</td>
				</tr>
			<?php
			}
		} else {
			echo "ไม่พบข้อมูล ....";
		}
	}

	public function updateu($newpass, $key)
	{
		try {
			$new_password = password_hash($newpass, PASSWORD_DEFAULT);
			$stmt = $this->db->prepare("UPDATE users 
	           			SET user_pass = :upass
	           			WHERE user_id = :uid");

			$stmt->bindparam(":uid", $key);
			$stmt->bindparam(":upass", $new_password);
			$stmt->execute();

			return $stmt;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function selectallacc($sallacc)
	{
		$stmt = $this->db->prepare($sallacc);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($GraphRow = $stmt->fetch(PDO::FETCH_ASSOC)) {
				echo "'" . $GraphRow["no_of"] . "',";
			}
		}
	}

	public function selectallacc2($sallacc2)
	{
		$stmt = $this->db->prepare($sallacc2);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($GraphRow2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
				echo $GraphRow2["no_of_attempts"] . ",";
			}
		}
	}

	public function selecttableu($tableu)
	{
		$stmt = $this->db->prepare($tableu);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr>
					<td><?php echo $row["b"] ?></td>
					<td><?php echo $row["a"] ?></td>
				</tr>
			<?php
			}
		}
	}
	public function selecttableuu($tableu, $params = [])
	{
		try {
			$stmt = $this->db->prepare($tableu);

			// Bind parameters if any
			foreach ($params as $key => $value) {
				$stmt->bindValue(":$key", $value);
			}

			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
			return []; // Return an empty array or handle the error as needed
		}
	}




	public function selecttableu_graph($tableu)
	{
		$stmt = $this->db->prepare($tableu);
		$stmt->execute();

		$result = [];

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$result[] = $row;
			}
		}

		return $result;
	}

	public function selecttableu_graph_detail($tableu)
	{
		$stmt = $this->db->prepare($tableu);
		$stmt->execute();

		$result = [];

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$result[] = $row;
			}
		}

		return $result;
	}

	public function selecttableu_graph_detail_ink($tableu)
	{
		$stmt = $this->db->prepare($tableu);
		$stmt->execute();

		$result = [];

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$result[] = $row;
			}
		}

		return $result;
	}

	public function upnew($updatenew, $q)
	{
		try {
			// $new_password = password_hash($newpass, PASSWORD_DEFAULT);	   
			$stmt = $this->db->prepare($updatenew);
			$stmt->bindparam(":uid", $q);
			// $stmt->bindparam(":upass", $new_password);            
			$stmt->execute();

			return $stmt;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function selectsearcrpall($searcrpall, $a)
	{
		$stmt = $this->db->prepare($searcrpall);
		// $stmt->bindParam(':urpid',$q);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr style="font-weight:bold;" id="<?php echo $row["repair_id"] ?>">
					<td scope="row" data-label="รหัสการส่งซ่อม" align="center"><a href="?q=<?php echo $row["repair_id"] ?>&p=search"><?php echo $row["repair_id"] ?></a></td>
					<td data-label="เวลา" align="center"><?php echo $row["repair_time"] ?></td>
					<td data-label="ชื่อผู้แจ้ง"><?php echo $row["repair_name"] ?></td>
					<td data-label="อุปกรณ์"><?php echo $row["repair_acc"] ?></td>
					<td data-label="รายละเอียด"><?php echo $row["repair_desc"] ?></td>
					<td data-label="แผนก"><?php echo $row["repair_dept"] ?></td>
					<td data-label="สถานะ" align="center">
						<p class="status-border" style="background-color:<?php echo $row["card_color"] ?>;">
							<?php echo $row["card_name"] ?>
						</p>
					</td>
					<td data-label="รายละเอียดการซ่อม"><?php echo $row["repair_comment"] ?></td>
					<td data-label="คนปิดงานซ่อม"><?php echo $row["repair_itemp"] ?></td>
					<td data-label="คนปิดงานซ่อม"><?php echo $row["repair_branch"] ?></td>
					<?php
					if ($a == 2) {
					?>
						<td data-label="จัดการ" align="right">
							<input type="button" name="edit" value="Edit" id="<?php echo $row["repair_id"]; ?>" class="btn btn-info btn-xs edit_data" />
							<a href="?p=card_all_status&amp;key=<?php echo $row["repair_id"] ?>" class="btn btn-xs btn-success" title="ประวัติ">
								รายละเอียด<i class="fa fa-history"></i>
							</a>
						</td>
					<?php
					} else {
						echo "";
					}
					?>
				</tr>
			<?php
			}
		} else {
			echo "ไม่พบข้อมูล ....";
		}
	}

	public function seqe($selecteqe, $spu)
	{
		$stmt = $this->db->prepare($selecteqe);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr>
					<td scope="row" data-label="#">
						<?php
						if ($spu == "2" && $row["status"] == "0") {
						?>
							<a href="?p=equip&type=eqe&eqe_id=<?php echo $row["eq_id"]; ?>" class="btn btn-success btn-xs edit_eqc">Submit</a>
						<?php
						}
						?>
						<style>
							.custom-btn-size {
								width: 100px;
								/* ขนาดที่คุณต้องการ */
								text-align: center;
								display: inline-block;
								margin: 5px;
								/* ขนาดระยะห่างระหว่างปุ่ม */
								padding: 10px;
								/* ขนาดของ padding ในปุ่ม */
								box-sizing: border-box;
								/* ทำให้ขนาดรวมของปุ่มไม่เปลี่ยนแปลง */
							}
						</style>
						<input type="button" name="edit" value="Edit" id="<?php echo $row["eq_id"]; ?>" class="btn btn-info custom-btn-size  edit_eqe" />
						<a href="qrcode.php?type=all-<?php echo $row["eq_id"]; ?>" class="btn btn-success custom-btn-size">QRCODE</a>
						<a href="" name="deletedata" id="<?php echo $row["eq_id"]; ?>" class="btn btn-danger deleq1 custom-btn-size">Delete</a>
					</td>
					<td data-label="อุปกรณ์"><?php echo $row["acc_name"] ?></td>
					<td data-label="รุ่น"><?php echo $row["eq_series"] ?></td>
					<td data-label="สาขา"><?php echo $row["branch_name"] ?></td>
					<td data-label="ซีเรียล"><?php echo $row["eq_serial"] ?></td>
					<td data-label="สถานะ"
						<?php
						if ($row["status"] == "ใช้งาน") {
							echo 'style="color: green;"';
						}
						if ($row["status"] == "เก็บใน Stock") {
							echo 'style="color:	#CCCC00;"';
						} else {
							echo 'style="color: red;"';
						}
						?>>
						<?php echo $row["status"]; ?>
					</td>

					<td data-label="ราคา"><?php echo $row["eq_price"] ?></td>
					<td data-label="วันที่ประกัน"><?php echo $row["eq_warranty"] ?></td>
					<td data-label="ติดตั้ง"><?php echo $row["eq_install"] ?></td>
					<td data-label="ผู้ใช้"><?php echo $row["eq_user"] ?></td>
					<td data-label="สถานที่ซื้อ"><?php echo $row["eq_wb"] ?></td>
					<td data-label="วันที่ซื้อ"><?php echo $row["eq_buy"] ?></td>
					<td data-label="อายุการใช้งาน">
						<?php
						$buy = substr($row["eq_buy"], 6, 4); // Extracts the year as a string
						if ($buy) {
							$buy = (int)$buy; // Convert the extracted year to an integer
							$currentYear = (int)date("Y"); // Convert the current year to an integer
							$ybuy = $currentYear - $buy; // Calculates the years of use
							echo "อายุการใช้งาน " . $ybuy . " ปี";
						} else {
							echo "ไม่มีข้อมูล";
						}
						?>
					</td>
				</tr>
			<?php
			}
		}
	}


	public function seqc($selecteqc, $spu)
	{
		$stmt = $this->db->prepare($selecteqc);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr>
					<td scope="row" data-label="#">
						<?php
						if ($spu == "2" and $row["status_eq"] == "0") {
						?>
							<a href="?p=equip&type=eqc&eqc_id=<?php echo $row["equip_id"]; ?>" class="btn btn-success btn-xs edit_eqc">Submit</a>
						<?php
						}
						?>
						<style>
							.custom-btn-size {
								width: 100px;
								/* ขนาดที่คุณต้องการ */
								text-align: center;
								display: inline-block;
								margin: 5px;
								/* ขนาดระยะห่างระหว่างปุ่ม */
								padding: 10px;
								/* ขนาดของ padding ในปุ่ม */
								box-sizing: border-box;
								/* ทำให้ขนาดรวมของปุ่มไม่เปลี่ยนแปลง */
							}
						</style>


						<input type="button" name="edit" value="Edit" id="<?php echo $row["equip_id"]; ?>" class="btn btn-warning custom-btn-size edit_eqc" />
						<a href="qrcode.php?type=pc-<?php echo $row["equip_id"]; ?>" class="btn btn-success custom-btn-size">QRCODE</a>
						<a href="" name="deletedata" id="<?php echo $row["equip_id"]; ?>" class="btn btn-danger custom-btn-size deleq">Delete</a>
					</td>
					<td data-label="ชื่อผู้ใช้"><?php echo $row["name_user"] ?></td>
					<td data-label="ชื่อเครื่อง"><?php echo $row["name_com"] ?></td>
					<td data-label="แผนก"><?php echo $row["dept_name"] ?></td>
					<td data-label="สาขา"><?php echo $row["branch_name"] ?></td>
					<td data-label="IP"><?php echo $row["eq_ip"] ?></td>
					<td data-label="Type"><?php echo $row["eq_type"] ?></td>
					<td data-label="CPU"><?php echo $row["eq_cpu"] ?>
						<?php
						// $buy = substr($row["day_buy"],6,4);
						// echo $buy;
						// $ybuy = @date("Y") - $buy;
						// echo @date('Y') - $buy;
						// echo "อายุการใช้งาน".$ybuy."ปี"; 

						?>
					</td>
					<td data-label="CPU Gen"><?php echo $row["eq_cpugen"] ?></td>
					<td data-label="RAM"><?php echo $row["eq_ram"] ?></td>
					<td data-label="SSD"><?php echo $row["eq_ssd"] ?></td>
					<td data-label="HDD"><?php echo $row["eq_hdd"] ?></td>
					<td data-label="OS"><?php echo $row["eq_os"] ?></td>
					<td data-label="OS Type"><?php echo $row["eq_ostype"] ?></td>
					<td data-label="Office"><?php echo $row["eq_office"] ?></td>
					<td data-label="Antivirus"><?php echo $row["eq_antivirus"] ?></td>

					<td data-label="USB"><?php echo $row["eq_usb"] ?></td>
					<td data-label="MAC Address"><?php echo $row["eq_macaddress"] ?></td>
					<!-- <td data-label="สถานะ"><?php echo $row["eq_status"] ?></td> -->
					<td data-label="สถานะ"
						<?php
						if ($row["eq_status"] == "ใช้งาน") {
							echo 'style="color: green;"';
						}
						if ($row["eq_status"] == "เก็บใน Stock") {
							echo 'style="color:	#CCCC00;"';
						} else {
							echo 'style="color: red;"';
						}
						?>>
						<?php echo $row["eq_status"]; ?>
					</td>

					<td data-label="ที่ตั้ง"><?php echo $row["eq_place"] ?></td>

					<td data-label="ประวัติการใช้งาน"><?php echo $row["eq_historyplace"] ?></td>
					<td data-label="ประวัติการซ่อม"><?php echo $row["eq_historyrepair"] ?></td>
					<td data-label="วันที่อัพเดทข้อมูล"><?php echo $row["eq_updatetime"] ?></td>

					<td data-label="หมายเหตุ"><?php echo $row["spec"] ?></td>
					<td data-label="วันที่ประกัน"><?php echo $row["warranty"] ?></td>
					<td data-label="วันที่ซื้อ"><?php echo $row["day_buy"] ?></td>
					<!-- <td data-label="อายุการใช้งาน"><?php echo "nodata" ?></td> -->
					<td data-label="Model"><?php echo $row["eq_model"] ?></td>
					<td data-label="S/N"><?php echo $row["serial_num"] ?></td>



				</tr>
			<?php
			}
		}
	}

	public function seeho($selecteqc, $spu)
	{
		$stmt = $this->db->prepare($selecteqc);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr>
					<td scope="row" data-label="#">
						<?php
						if ($spu == "2" && $row["eq_status"] == "0") {
						?>
							<a href="?p=equip&type=eqc&eqc_id=<?php echo $row["equip_id"]; ?>" class="btn btn-success btn-xs edit_eqc">Submit</a>
						<?php
						}
						?>
						<style>
							.custom-btn-size {
								width: 100px;
								/* ขนาดที่คุณต้องการ */
								text-align: center;
								display: inline-block;
								margin: 5px;
								/* ขนาดระยะห่างระหว่างปุ่ม */
								padding: 10px;
								/* ขนาดของ padding ในปุ่ม */
								box-sizing: border-box;
								/* ทำให้ขนาดรวมของปุ่มไม่เปลี่ยนแปลง */
							}
						</style>
						<input type="button" name="edit" value="Edit" id="<?php echo $row["equip_id"]; ?>" class="btn btn-warning custom-btn-size edit_eqc" />
						<a href="qrcode.php?type=pc-<?php echo $row["equip_id"]; ?>" class="btn btn-success custom-btn-size">QRCODE</a>
						<a href="" name="deletedata" id="<?php echo $row["equip_id"]; ?>" class="btn btn-danger custom-btn-size deleq">Delete</a>

					</td>
					<td data-label="ชื่อผู้ใช้"><?php echo $row["name_user"] ?></td>
					<td data-label="ชื่อเครื่อง"><?php echo $row["name_com"] ?></td>
					<td data-label="แผนก"><?php echo $row["dept_name"] ?></td>
					<td data-label="สาขา"><?php echo $row["branch_name"] ?></td>
					<td data-label="IP"><?php echo $row["eq_ip"] ?></td>
					<td data-label="Model"><?php echo $row["eq_model"] ?></td>
					<td data-label="Type"><?php echo $row["eq_type"] ?></td>
					<td data-label="CPU"><?php echo $row["eq_cpu"] ?></td>
					<td data-label="CPU Gen"><?php echo $row["eq_cpugen"] ?></td>
					<td data-label="RAM"><?php echo $row["eq_ram"] ?></td>
					<td data-label="SSD"><?php echo $row["eq_ssd"] ?></td>
					<td data-label="HDD"><?php echo $row["eq_hdd"] ?></td>
					<td data-label="OS"><?php echo $row["eq_os"] ?></td>
					<!-- <td data-label="OS Type"><?php echo $row["eq_ostype"] ?></td> -->
					<!-- <td data-label="Office"><?php echo $row["eq_office"] ?></td>
                <td data-label="Antivirus"><?php echo $row["eq_antivirus"] ?></td>
                <td data-label="USB"><?php echo $row["eq_usb"] ?></td>
                <td data-label="MAC Address"><?php echo $row["eq_macaddress"] ?></td> -->
					<!-- <td data-label="สถานะ"><?php echo $row["eq_status"] ?></td> -->
					<td data-label="สถานะ"
						<?php
						if ($row["eq_status"] == "ใช้งาน") {
							echo 'style="color: green;"';
						}
						if ($row["eq_status"] == "เก็บใน Stock") {
							echo 'style="color:	#CCCC00;"';
						} else {
							echo 'style="color: red;"';
						}
						?>>
						<?php echo $row["eq_status"]; ?>
					</td>
					<td data-label="สถานที่ตั้ง"><?php echo $row["eq_place"] ?></td>
					<!-- <td data-label="ประวัติการใช้งาน"><?php echo $row["eq_historyplace"] ?></td>
                <td data-label="ประวัติการซ่อม"><?php echo $row["eq_historyrepair"] ?></td> -->
					<td data-label="วันที่อัพเดทข้อมูล"><?php echo $row["eq_updatetime"] ?></td>
					<!-- <td data-label="รายละเอียดโปรแกรมและอื่น ๆ"><?php echo $row["spec"] ?></td> -->
					<td data-label="วันที่ประกัน"><?php echo $row["warranty"] ?></td>
					<td data-label="วันที่ซื้อ"><?php echo $row["day_buy"] ?></td>
					<!-- <td data-label="อายุการใช้งาน"><?php echo "nodata" ?></td> -->

					<!-- <td data-label="S/N"><?php echo $row["serial_num"] ?></td> -->
				</tr>
			<?php
			}
		}
	}


	public function seeprint($selecteqc, $spu)
	{
		$stmt = $this->db->prepare($selecteqc);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr>
					<td scope="row" data-label="#">
						<?php
						if ($spu == "2" && $row["status"] == "0") {
						?>
							<a href="?p=equip&type=eqe&eqe_id=<?php echo $row["eq_id"]; ?>" class="btn btn-success btn-xs edit_eqc">Submit</a>
						<?php
						}
						?>
						<style>
							.custom-btn-size {
								width: 100px;
								/* ขนาดที่คุณต้องการ */
								text-align: center;
								display: inline-block;
								margin: 5px;
								/* ขนาดระยะห่างระหว่างปุ่ม */
								padding: 10px;
								/* ขนาดของ padding ในปุ่ม */
								box-sizing: border-box;
								/* ทำให้ขนาดรวมของปุ่มไม่เปลี่ยนแปลง */
							}
						</style>
						<input type="button" name="edit" value="Edit" id="<?php echo $row["eq_id"]; ?>" class="btn btn-info custom-btn-size  edit_eqe" />
						<a href="qrcode.php?type=all-<?php echo $row["eq_id"]; ?>" class="btn btn-success custom-btn-size">QRCODE</a>
						<a href="" name="deletedata" id="<?php echo $row["eq_id"]; ?>" class="btn btn-danger deleq1 custom-btn-size">Delete</a>
					</td>
					<td data-label="อุปกรณ์"><?php echo $row["acc_name"] ?></td>
					<td data-label="รุ่น"><?php echo $row["eq_series"] ?></td>
					<td data-label="สาขา"><?php echo $row["branch_name"] ?></td>
					<td data-label="ซีเรียล"><?php echo $row["eq_serial"] ?></td>
					<td data-label="สถานะ"
						<?php
						if ($row["status"] == "ใช้งาน") {
							echo 'style="color: green;"';
						}
						if ($row["status"] == "เก็บใน Stock") {
							echo 'style="color:	#CCCC00;"';
						} else {
							echo 'style="color: red;"';
						}
						?>>
						<?php echo $row["status"]; ?>
					</td>

					<td data-label="ราคา"><?php echo $row["eq_price"] ?></td>
					<td data-label="วันที่ประกัน"><?php echo $row["eq_warranty"] ?></td>
					<td data-label="ติดตั้ง"><?php echo $row["eq_install"] ?></td>
					<td data-label="ผู้ใช้"><?php echo $row["eq_user"] ?></td>
					<td data-label="สถานที่ซื้อ"><?php echo $row["eq_wb"] ?></td>
					<td data-label="วันที่ซื้อ"><?php echo $row["eq_buy"] ?></td>
					<td data-label="อายุการใช้งาน">
						<?php
						$buy = substr($row["eq_buy"], 6, 4); // Extracts the year as a string
						if ($buy) {
							$buy = (int)$buy; // Convert the extracted year to an integer
							$currentYear = (int)date("Y"); // Convert the current year to an integer
							$ybuy = $currentYear - $buy; // Calculates the years of use
							echo "อายุการใช้งาน " . $ybuy . " ปี";
						} else {
							echo "ไม่มีข้อมูล";
						}
						?>
					</td>
				</tr>
			<?php
			}
		}
	}




	public function selectstockacc($selectsta)
	{
		$stmt = $this->db->prepare($selectsta);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr style="font-weight:bold;" id="<?php echo $row["stock_id"] ?>">
					<td scope="row" data-label="Account" align="center">
						<?php echo $row["stock_date"] ?>
					</td>
					<td data-label="Due Date" align="center">
						<?php echo $row["stock_brand"] ?>
					</td>
					<td data-label="Due Date" align="center">
						<?php echo $row["stock_series"] ?>
					</td>
					<td data-label="Due Date" align="center">
						<?php echo $row["stock_desc"] ?>
					</td>
					<td data-label="Due Date" align="center">
						<?php echo $row["stock_income"] ?>
					</td>
					<td data-label="Due Date" align="center">
						<?php echo $row["stock_name"] ?>
					</td>
					<td data-label="Name">
						<input type="button" name="edit" value="Edit" id="<?php echo $row["stock_id"] ?>" class="btn btn-info btn-xs edit_stock" />
					</td>
				</tr>
			<?php
			}
		} else {
			echo "ไม่พบข้อมูล ....";
		}
	}

	public function selectstockink($selectsti)
	{
		$stmt = $this->db->prepare($selectsti);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr style="font-weight:bold;" id="<?php echo $row["stock_inkid"] ?>">
					<!-- <td data-label="Due Date" align="center">
						<?php echo $row["stock_ink_date"] ?>
					</td> -->
					<td scope="row" data-label="Account" align="center">
						<?php echo $row["stock_inktype"] ?>
					</td>
					<td data-label="Due Date" align="center">
						<?php echo $row["stock_ink_series"] ?>
					</td>
					<td data-label="Due Date" align="center">
						<?php echo $row["stock_ink_income"] ?>
					</td>

					<td data-label="Name">
						<input type="button" name="edit" value="Edit" id="<?php echo $row["stock_inkid"] ?>" class="btn btn-info btn-xs edit_stock_ink" />

					</td>
				</tr>
				<?php
			}
		} else {
			echo "ไม่พบข้อมูล ....";
		}
	}

	public function selectstockaccall($stockaccall)
	{
		$stmt = $this->db->prepare($stockaccall);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				if ($row["stock_income"] == '0') {
				?>
					<option disabled value="<?php echo $row["stock_id"] ?>,<?php echo $row["stock_name"] ?>">
						<?php echo $row["stock_name"] ?> / หมด
					</option>
				<?php
				} else {
				?>
					<option value="<?php echo $row["stock_id"] ?>,<?php echo $row["stock_name"] ?>">
						<?php echo $row["stock_name"] ?> / เหลือ
						<?php
						if ($row["stock_desc"] == '') {
							echo $row["stock_income"];
						} else {
							echo $row["c"];
						}
						?>
					</option>
				<?php
				}
			}
		}
	}

	public function selectstockinkall($stockinkall)
	{
		$stmt = $this->db->prepare($stockinkall);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
				<option value="<?php echo htmlspecialchars($row["stock_inkid"]); ?>"
					<?php echo $row["stock_ink_income"] == '0' ? 'disabled' : ''; ?>>
					<?php echo htmlspecialchars($row["stock_ink_series"]); ?> / เหลือ <?php echo $row["stock_ink_income"] == '0' ? 'หมด' : htmlspecialchars($row["stock_ink_income"]); ?>
				</option>

				<?php
			}
		}
	}



	public function selectstockaccink($selectstockio, $stock_io)
	{
		$stmt = $this->db->prepare($selectstockio);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				if ($stock_io == "stock_acc_income") {
				?>
					<tr style="font-weight:bold;" id="<?php echo $row["stock_acc_incomid"] ?>">
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_acc_incomid"] ?>
						</td>
						<td scope="row" data-label="Account" align="center">
							<?php echo $row["stock_name"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_brand"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_series"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_desc"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_newincome"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_date"] ?>
						</td>
					</tr>
				<?php
				} else if ($stock_io == "stock_ink_income") {
				?>
					<tr style="font-weight:bold;" id="<?php echo $row["stock_ink_incomeid"] ?>">
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_ink_incomeid"] ?>
						</td>
						<td scope="row" data-label="Account" align="center">
							<?php echo $row["stock_inktype"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_ink_series"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_ink_income"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_ink_date"] ?>
						</td>
					</tr>
				<?php
				} else if ($stock_io == "stock_acc,stock_acc_out,dept") {
				?>
					<tr style="font-weight:bold;" id="<?php echo $row["stock_aoid"] ?>">
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_aoid"] ?>
						</td>
						<td scope="row" data-label="Account" align="center">
							<?php echo $row["stock_name"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_out_num"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_out_name"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["dept_name"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_out_time"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_out_desc"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php
							if ($row["stock_out_new"] == "1") {
							?>
								<a href="?<?php echo $_SERVER['QUERY_STRING'] ?>&statusaccout=1&stock_income=<?php echo $row["stock_out_num"] ?>&stock_id=<?php echo $row["stock_id"] ?>&stock_aoid=<?php echo $row["stock_aoid"] ?>&sn_acc=<?php echo $row["stock_out_desc"] ?>" class="btn btn-warning btn-sm">
									<i class="mdi mdi-alert-outline"></i>Waiting
								</a>
							<?php
							} else {
							?>
								<a href="#" class="btn btn-success btn-fw">
									<i class="mdi mdi-check"></i>Success
								</a>
							<?php
							}
							?>
						</td>
					</tr>
				<?php
				} else if ($stock_io == "stock_ink,stock_ink_out,dept") {
				?>
					<tr style="font-weight:bold;" id="<?php echo $row["stock_ioid"] ?>">
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_ioid"] ?>
						</td>
						<td scope="row" data-label="Account" align="center">
							<?php echo $row["stock_ink_series"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_out_ink_num"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_out_ink_name"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["dept_name"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_out_ink_branch"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php echo $row["stock_out_ink_time"] ?>
						</td>
						<td data-label="Due Date" align="center">
							<?php
							if ($row["stock_out_ink_new"] == "1") {
							?>
								<a href="?<?php echo $_SERVER['QUERY_STRING'] ?>&statusinkout=1&stock_ink_income=<?php echo $row["stock_out_ink_num"] ?>&stock_inkid=<?php echo $row["stock_inkid"] ?>&stock_ioid=<?php echo $row["stock_ioid"] ?>" class="btn btn-warning btn-sm">
									<i class="mdi mdi-alert-outline"></i>Waiting
								</a>
							<?php
							} else {
							?>
								<a href="#" class="btn btn-success btn-fw">
									<i class="mdi mdi-check"></i>Success
								</a>
							<?php
							}
							?>
						</td>
					</tr>
				<?php
				}
			}
		} else {
			echo "ไม่พบข้อมูล ....";
		}
	}

	public function selectupstock($selectupdatestock)
	{
		$stmt = $this->db->prepare($selectupdatestock);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
				<p class="mb-0 font-weight-normal float-left">
					รายการเบิกหมึก <?php echo $row["c"] ?>
				</p>
			<?php
			}
		} else {
			echo "";
		}
	}

	public function selectupstockout($selectustock)
	{
		$stmt = $this->db->prepare($selectustock);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<div class="dropdown-divider"></div>
				<a href="?p=search&q=<?php echo $row["stock_ioid"] ?>&n=set_default" class="dropdown-item preview-item">
					<div class="preview-thumbnail">
						<img src="../images/faces-clipart/pic-1.png" alt="image" class="profile-pic">
					</div>
					<div class="preview-item-content flex-grow">
						<h6 class="preview-subject ellipsis font-weight-medium text-dark">
							<?php echo $row["stock_out_ink_name"] ?>
							<!-- <span class="float-right font-weight-light small-text">1 Minutes ago</span> -->
						</h6>
						<p class="font-weight-light small-text"><?php echo $row["stock_ink_series"] ?></p>
					</div>
				</a>

			<?php
			}
		} else {
			echo "";
		}
	}

	public function selectnotistock($notistock)
	{
		$stmt = $this->db->prepare($notistock);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
				<a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" data-toggle="dropdown" aria-expanded="false">
					<i class="mdi mdi-bell"></i>
					<span class="count"><?php echo $row["c"] ?></span>
				</a>
				<?php
			}
		} else {
			echo "";
		}
	}

	public function insertrepair($ran, $name, $branch, $dept, $acc, $desc, $userpic, $warning)
	{
		try {
			$stmt = $this->db->prepare("INSERT INTO rp_it(repair_id,repair_name,repair_branch,repair_dept,repair_acc,repair_desc,repair_img,repair_warning) 
				VALUES (:uran,:uname,:ubranch,:udept,:uacc,:udesc,:upic,:uwarning)");

			$stmt->bindParam(':uran', $ran);
			$stmt->bindParam(':uname', $name);
			$stmt->bindParam(':ubranch', $branch);
			$stmt->bindParam(':udept', $dept);
			$stmt->bindParam(':uacc', $acc);
			$stmt->bindParam(':udesc', $desc);
			$stmt->bindParam(':upic', $userpic);
			$stmt->bindParam(':uwarning', $warning);
			$stmt->execute();

			return $stmt;
		} catch (PDOException $e) {
			echo '<script>console.log("Debug Objects: ' . $e->getMessage() . '" );</script>';
		}
	}

	public function selectAllQrcodeDetails($selectAllQuery, $eqe_id)
	{
		try {
			$stmt = $this->db->prepare($selectAllQuery);
			$stmt->bindParam(':eqe_id', $eqe_id, PDO::PARAM_INT);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>

					<head>

						<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
						<style>
							body {
								font-family: Arial, sans-serif;
								background-color: #f4f7f6;
								color: #333;
							}

							.all-s {
								margin: 20px;
							}

							.all-shead {
								background-color: #007bff;
								color: white;
								padding: 15px;
								border-radius: 5px;
								font-size: 1.5em;
								font-weight: bold;
								text-align: center;
							}

							.panel-body {
								background-color: white;
								padding: 20px;
								border-radius: 8px;
								box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
							}

							.row.form-group {
								border-bottom: 1px solid #e0e0e0;
								padding: 10px 0;
							}

							.row.form-group:last-child {
								border-bottom: none;
							}

							.col-md-3 strong {
								color: #007bff;
							}

							.img-thumbnail {
								border: 0;
								box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
							}

							.btn-warning {
								background-color: #ffc107;
								border: none;
								color: #333;
								font-weight: bold;
							}

							.btn-warning:hover {
								background-color: #e0a800;
								color: white;
							}

							.qr-code {
								display: flex;
								align-items: center;
								justify-content: center;
							}
						</style>
					</head>
					<div class="all-s">
						<div class="all-shead">รายละเอียด</div>
						<div class="panel-body">
							<div class="row form-group">
								<div class="col-md-3"><strong>รหัสสินค้า (serial number)</strong></div>
								<div class="col-md-3"><?php echo htmlspecialchars($row["eq_serial"]); ?></div>
								<div class="col-md-3"><strong>วันที่เพิ่มข้อมูล</strong></div>
								<div class="col-md-3"><?php echo htmlspecialchars($row["eq_time"]); ?></div>
							</div>
							<div class="row form-group">
								<div class="col-md-3"><strong>แผนก</strong></div>
								<div class="col-md-3"><?php echo htmlspecialchars($row["eq_install"]); ?></div>
							</div>
							<div class="row form-group">
								<div class="col-md-3"><strong>ชื่อเครื่อง</strong></div>
								<div class="col-md-3"><?php echo htmlspecialchars($row["eq_series"]); ?></div>
							</div>
							<div class="row form-group">
								<div class="col-md-3"><strong>วันที่อัพเดทล่าสุด</strong></div>
								<div class="col-md-3" style="color:#00BB32"><strong><?php echo htmlspecialchars($row["eq_time"]); ?></strong></div>
								<div class="col-md-3"><strong>ประกัน / วันที่ซื่อ</strong></div>
								<div class="col-md-3"><?php echo htmlspecialchars($row["eq_warranty"]) . ' ## ' . htmlspecialchars($row["eq_buy"]); ?></div>
							</div>
							<div class="row form-group">
								<div class="col-md-3"><strong>QRCODE</strong></div>
								<div class="col-md-3">
									<img class="img-thumbnail"
										src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=https://repairit.tkn.co.th/template/qrcode.php?type=all-<?php echo htmlspecialchars($eqe_id); ?>"
										title="<?php echo htmlspecialchars($row["eq_series"]); ?>" />
								</div>

								<div class="col-md-3"><strong>จัดการ</strong></div>
								<div class="col-md-3">
									<input type="button" name="edit" value="Edit" id="<?php echo $row["eq_id"]; ?>" class="btn btn-info btn-xs edit_eqe" />
								</div>
							</div>
						</div>
					</div>
				<?php
				}
			} else {
				echo "<p>No details found for the given ID.</p>";
			}
		} catch (PDOException $e) {
			echo "<p>Error: " . $e->getMessage() . "</p>";
		}
	}

	public function selectQrcodeDetial($selectQreqc, $eqc_id)
	{
		$stmt = $this->db->prepare($selectQreqc);
		$stmt->bindParam(':eqc_id', $eqc_id);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>

				<head>

					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
					<style>
						body {
							font-family: Arial, sans-serif;
							background-color: #f4f7f6;
							color: #333;
						}

						.all-s {
							margin: 20px;
						}

						.all-shead {
							background-color: #007bff;
							color: white;
							padding: 15px;
							border-radius: 5px;
							font-size: 1.5em;
							font-weight: bold;
							text-align: center;
						}

						.panel-body {
							background-color: white;
							padding: 20px;
							border-radius: 8px;
							box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
						}

						.row.form-group {
							border-bottom: 1px solid #e0e0e0;
							padding: 10px 0;
						}

						.row.form-group:last-child {
							border-bottom: none;
						}

						.col-md-3 strong {
							color: #007bff;
						}

						.img-thumbnail {
							border: 0;
							box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
						}

						.btn-warning {
							background-color: #ffc107;
							border: none;
							color: #333;
							font-weight: bold;
						}

						.btn-warning:hover {
							background-color: #e0a800;
							color: white;
						}

						.qr-code {
							display: flex;
							align-items: center;
							justify-content: center;
						}
					</style>
				</head>

				<body>
					<div class="all-s">
						<div class="all-shead">
							รายละเอียดคอมพิวเตอร์
						</div>
						<div class="panel-body">
							<!-- ข้อมูลพื้นฐาน -->
							<div class="row form-group">
								<div class="col-md-3"><strong>รหัสสินค้า (serial number)</strong></div>
								<div class="col-md-3"><?php echo htmlspecialchars($row["serial_num"], ENT_QUOTES, 'UTF-8'); ?></div>
								<div class="col-md-3"><strong>วันที่เพิ่มข้อมูล</strong></div>
								<div class="col-md-3"><?php echo htmlspecialchars($row["equip_time"], ENT_QUOTES, 'UTF-8'); ?></div>
							</div>
							<!-- ข้อมูลผู้ใช้และแผนก -->
							<div class="row form-group">
								<div class="col-md-3"><strong>ชื่อผู้ใช้</strong></div>
								<div class="col-md-3"><?php echo htmlspecialchars($row["name_user"], ENT_QUOTES, 'UTF-8'); ?></div>
								<div class="col-md-3"><strong>แผนก</strong></div>
								<div class="col-md-3"><?php echo htmlspecialchars($row["dept_name"], ENT_QUOTES, 'UTF-8'); ?></div>
							</div>
							<!-- ข้อมูลสาขาและชื่อเครื่อง -->
							<div class="row form-group">
								<div class="col-md-3"><strong>สาขา</strong></div>
								<div class="col-md-3"><?php echo htmlspecialchars($row["branch_name"], ENT_QUOTES, 'UTF-8'); ?></div>
								<div class="col-md-3"><strong>ชื่อเครื่อง</strong></div>
								<div class="col-md-3"><?php echo htmlspecialchars($row["name_com"], ENT_QUOTES, 'UTF-8'); ?></div>
							</div>
							<!-- ข้อมูลการอัพเดทล่าสุดและประกัน -->
							<div class="row form-group">
								<div class="col-md-3"><strong>วันที่อัพเดทล่าสุด</strong></div>
								<div class="col-md-3" style="color:#00BB32"><strong><?php echo htmlspecialchars($row["eq_updatetime"], ENT_QUOTES, 'UTF-8'); ?></strong></div>
								<div class="col-md-3"><strong>ประกัน || วันที่ซื้อ</strong></div>
								<div class="col-md-3"><?php echo htmlspecialchars($row["warranty"], ENT_QUOTES, 'UTF-8') . ' || ' . htmlspecialchars($row["day_buy"], ENT_QUOTES, 'UTF-8'); ?></div>
							</div>
							<!-- ข้อมูล CPU, RAM, OS และ IP address -->
							<div class="row form-group">
								<div class="col-md-3"><strong>CPU || RAM || WINDOWS</strong></div>
								<div class="col-md-3" style="color:#00BB32"><?php echo htmlspecialchars($row["eq_cpu"], ENT_QUOTES, 'UTF-8') . " || " . htmlspecialchars($row["eq_ram"], ENT_QUOTES, 'UTF-8') . " || " . htmlspecialchars($row["eq_os"], ENT_QUOTES, 'UTF-8'); ?></div>
								<div class="col-md-3"><strong>IP address</strong></div>
								<div class="col-md-3"><?php echo htmlspecialchars($row["eq_ip"], ENT_QUOTES, 'UTF-8'); ?></div>
							</div>
							<!-- QRCODE และปุ่มจัดการ -->
							<div class="row form-group">
								<div class="col-md-3"><strong>QRCODE</strong></div>
								<div class="col-md-3 qr-code">
									<img class="img-thumbnail" src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=https://repairit.tkn.co.th/template/qrcode.php?type=pc-<?php echo htmlspecialchars($eqc_id, ENT_QUOTES, 'UTF-8'); ?>" title="<?php echo htmlspecialchars($row["name_com"], ENT_QUOTES, 'UTF-8'); ?>" />
								</div>
								<div class="col-md-3"><strong>จัดการ</strong></div>
								<div class="col-md-3">
									<button type="button" name="edit" value="Edit" id="<?php echo htmlspecialchars($eqc_id, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-warning edit_eqc">Edit Data</button>
								</div>
							</div>
						</div>
					</div>

					<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
					<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
				</body>

<?php
			}
		}
	}
}
?>