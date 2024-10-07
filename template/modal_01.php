        <!-- The Modal -->
        <form method="post" enctype="multipart/form-data" class="form-horizontal">
        	<div class="modal fade" id="myModal">
        		<div class="modal-dialog modal-dialog-centered">
        			<div class="modal-content">
        				<!-- Modal Header -->
        				<div class="modal-header">
        					<h4 class="modal-title">เพิ่มใบส่งซ่อม/เคลม</h4>
        					<button type="button" class="close" data-dismiss="modal">&times;</button>
        				</div>
        				<!-- Modal body -->
        				<div class="modal-body">
        					<div class="row">
        						<div class="col-6">
        							<div class="form-group">
        								<label>ผู้แจ้งซ่อม</label>
        								<input required name="txtname" type="text" class="form-control" placeholder="ชื่อผู้แจ้งซ่อม" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">สาขา</label>
        								<select required name="txtbranch" class="form-control" id="exampleFormControlSelect2">
        									<option disabled selected value="">เลือกสาขา</option>
        									<?php
											$branch = "SELECT * FROM branch";
											$querybranch = $user->selectbranch($branch);
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">แผนก</label>
        								<select required name="txtdept" class="form-control" id="exampleFormControlSelect2">
        									<option disabled selected value="">เลือกแผนก</option>
        									<?php
											$dept = "SELECT * FROM dept";
											$querydept = $user->selectdept($dept);
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">อุปกรณ์ที่ส่งซ่อม</label>
        								<select required name="txtacc" class="form-control" id="exampleFormControlSelect2">
        									<option disabled selected value="">เลือกอุปกรณ์ส่งซ่อม</option>
        									<?php
											$acc = "SELECT * FROM acc";
											$queryacc = $user->selectacc($acc);
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-12">
        							<div class="form-group">
        								<label for="exampleTextarea1">รายละเอียด/อาการเสีย</label>
        								<textarea required name="txtdesc" class="form-control" id="exampleTextarea1" rows="4"></textarea>
        							</div>
        						</div>
        						<div class="col-12">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">รูปภาพ</label>
        								<input type="file" name="user_image" accept="image/*" class="form-control file-up" placeholder="Username" aria-label="file">
        							</div>
        						</div>
        					</div>
        				</div>
        				<!-- Modal footer -->
        				<div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        					<button type="submit" name="btnsave" class="btn btn-success">บันทึก</button>
        				</div>
        			</div>
        		</div>
        	</div>
        </form>


        <form method="post" enctype="multipart/form-data" class="form-horizontal">
        	<div class="modal fade" id="add_user_Modal">
        		<div class="modal-dialog modal-dialog-centered">
        			<div class="modal-content">
        				<!-- Modal Header -->
        				<div class="modal-header">
        					<h4 class="modal-title">เพิ่มผู้ใช้งาน</h4>
        					<button type="button" class="close" data-dismiss="modal">&times;</button>
        				</div>
        				<!-- Modal body -->
        				<div class="modal-body">
        					<div class="row">
        						<div class="col-6">
        							<div class="form-group">
        								<label>แผนก</label>
        								<input required name="txtname" type="text" class="form-control" placeholder="ชื่อผู้แจ้งซ่อม" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label>รหัสผ่าน</label>
        								<input required name="txtpass" type="text" class="form-control" placeholder="ชื่อผู้แจ้งซ่อม" aria-label="Username">
        							</div>
        						</div>
        					</div>
        				</div>
        				<!-- Modal footer -->
        				<div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        					<button type="submit" name="btn-signup" class="btn btn-success">บันทึก</button>
        				</div>
        			</div>
        		</div>
        	</div>
        </form>

        <form method="post" enctype="multipart/form-data" class="form-horizontal">
        	<div class="modal fade" id="myECOM">
        		<div class="modal-dialog modal-dialog-centered modal-lg">
        			<div class="modal-content">
        				<!-- Modal Header -->
        				<div class="modal-header">
        					<h4 class="modal-title">เพิ่มคอมพิวเตอร์</h4>
        					<button type="button" class="close" data-dismiss="modal">&times;</button>
        				</div>
        				<!-- Modal body -->
        				<div class="modal-body">
        					<div class="d-flex">
        						<div>ส่วนของ User</div>
        						<hr class="flex-grow">
        					</div>
        					<div class="row">
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addtxtbranch_eq">สาขา</label>
        								<select required name="addtxtbranch_eq" id="addtxtbranch_eq" class="form-control">
        									<option disabled selected value="">เลือกสาขา</option>
        									<?php
											$branch_id = "SELECT * FROM branch";
											$querybranch_id = $user->selectbranch_id($branch_id);
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addtxtdept">แผนก</label>
        								<select required name="addtxtdept" id="addtxtdept" class="form-control">
        									<option disabled selected value="">เลือกแผนก</option>
        									<?php
											$dept_id = "SELECT * FROM dept";
											$querydept_id = $user->selectdept_id($dept_id);
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addtxtcomname">ชื่อเครื่อง</label>
        								<input name="addtxtcomname" id="addtxtcomname" type="text" class="form-control" placeholder="ชื่อเครื่อง" aria-label="NameCom">
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addtxtname">ชื่อผู้ใช้งาน</label>
        								<input required name="addtxtname" id="addtxtname" type="text" class="form-control" placeholder="ชื่อผู้ใช้งาน" aria-label="Nameuser">
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addmodel">Model เครื่อง</label>
        								<input name="addmodel" id="addmodel" type="text" class="form-control" placeholder="model เครื่อง" aria-label="model">
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addserielno">S/N</label>
        								<input name="addserielno" id="addserielno" type="text" class="form-control" placeholder="serielnumber" aria-label="serielno">
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addtype">ประเภท</label>
        								<select required name="addtype" id="addtype" class="form-control">
        									<option disabled selected value="">เลือกประเภท</option>
        									<option value="PC">PC</option>
        									<option value="allinone">AIO</option>
        									<option value="laptop">laptop</option>
        									<option value="other">อื่นๆ</option>
        								</select>
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addcpu">ประเภท CPU</label>
        								<select required name="addcpu" id="addcpu" class="form-control">
        									<option disabled selected value="">เลือกประเภท CPU</option>
        									<option value="ต่ำกว่า I3">ต่ำกว่า I3</option>
        									<option value="intel core I3">intel core I3</option>
        									<option value="intel core I5">intel core I5</option>
        									<option value="intel core I7">intel core I7</option>
        									<option value="ต่ำกว่า Ryzen 3">ต่ำกว่า Ryzen 3</option>
        									<option value="amd Ryzen 3">amd Ryzen 3</option>
        									<option value="amd Ryzen 5">amd Ryzen 5</option>
        									<option value="amd Ryzen 7">amd Ryzen 7</option>
        									<option value="allinone">intel xeon</option>
        									<option value="other">อื่นๆ</option>
        								</select>
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addGEN">GEN-CPU</label>
        								<select required name="addGEN" id="addGEN" class="form-control">
        									<option disabled selected value="">เลือกประเภท GEN-CPU</option>
        									<option value="GEN 1">GEN 1</option>
        									<option value="GEN 2">GEN 2</option>
        									<option value="GEN 3">GEN 3</option>
        									<option value="GEN 4">GEN 4</option>
        									<option value="GEN 5">GEN 5</option>
        									<option value="GEN 6">GEN 6</option>
        									<option value="GEN 7">GEN 7</option>
        									<option value="GEN 8">GEN 8</option>
        									<option value="GEN 9">GEN 9</option>
        									<option value="GEN 10">GEN 10</option>
        									<option value="GEN 11">GEN 11</option>
        									<option value="GEN 12">GEN 12</option>
        									<option value="GEN 13">GEN 13</option>
        									<option value="GEN 14">GEN 14</option>
        									<option value="other">อื่นๆ</option>
        								</select>
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addram">ขนาด RAM</label>
        								<select required name="addram" id="addram" class="form-control">
        									<option disabled selected value="">เลือกขนาดแรม</option>
        									<option value="1GB">1GB</option>
        									<option value="2GB">2GB</option>
        									<option value="4GB">4GB</option>
        									<option value="8GB">8GB</option>
        									<option value="12GB">12GB</option>
        									<option value="16GB">16GB</option>
        									<option value="32GB">32GB</option>
        									<option value="other">อื่นๆ</option>
        								</select>
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addssd">SSD</label>
        								<select required name="addssd" id="addssd" class="form-control">
        									<option disabled selected value="">เลือกขนาด SSD</option>
        									<option value="ไม่มี">ไม่มี</option>
        									<option value="120GB">120GB</option>
        									<option value="128GB">128GB</option>
        									<option value="240GB">240GB</option>
        									<option value="256GB">256GB</option>
        									<option value="480GB">480GB</option>
        									<option value="512GB">512GB</option>
        									<option value="1TB">1TB</option>
        									<option value="2TBGB">2TB</option>
        									<option value="4TB">4TB</option>
        									<option value="other">อื่นๆ</option>
        								</select>
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addhdd">HDD</label>
        								<select required name="addhdd" id="addhdd" class="form-control">
        									<option disabled selected value="">เลือกขนาด HDD</option>
        									<option value="ไม่มี">ไม่มี</option>
        									<option value="80GB">80GB</option>
        									<option value="300GB">300GB</option>
        									<option value="500GB">500GB</option>
        									<option value="1TB">1TB</option>
        									<option value="2TBGB">2TBGB</option>
        									<option value="4TB">4TB</option>
        									<option value="other">อื่นๆ</option>
        								</select>
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addos">Windows</label>
        								<select required name="addos" id="addos" class="form-control">
        									<option disabled selected value="">เลือก Windows</option>
        									<option value="Windows XP">Windows XP</option>
        									<option value="Windows 7">Windows 7</option>
        									<option value="Windows 8">Windows 8</option>
        									<option value="Windows 8.1">Windows 8.1</option>
        									<option value="Windows 10">Windows 10</option>
        									<option value="Windows 10">Windows 10 PRO</option>
        									<option value="Windows 11">Windows 11</option>
        									<option value="Windows Server 2012">Windows Server 2012</option>
        									<option value="Windows Server 2016">Windows Server 2016</option>
        									<option value="Windows Server 2019">Windows Server 2019</option>
        									<option value="other">อื่นๆ</option>
        								</select>
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addoffice">Office</label>
        								<select required name="addoffice" id="addoffice" class="form-control">
        									<option disabled selected value="">เลือกโปรแกรม Office</option>
        									<option value="Microsoft Office 2007">Microsoft Office 2007</option>
        									<option value="Microsoft Office 2010">Microsoft Office 2010</option>
        									<option value="Microsoft Office 2013">Microsoft Office 2013</option>
        									<option value="Microsoft Office 2016">Microsoft Office 2016</option>
        									<option value="Microsoft Office 2019">Microsoft Office 2019</option>
        									<option value="Microsoft Office 365">Microsoft Office 365</option>
        									<option value="WPF">WPF</option>
        									<option value="OpenOffice">OpenOffice</option>
        									<option value="other">อื่นๆ</option>
        								</select>
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addantivirus">Antivirus</label>
        								<select required name="addantivirus" id="addantivirus" class="form-control">
        									<option disabled selected value="">เลือกโปรแกรม Antivirus</option>
        									<option value="Malwarebyte">Malwarebyte</option>
        									<option value="TrendMicro">TrendMicro</option>
        									<option value="Avast">Avast</option>
        									<option value="Kaspersky">Kaspersky</option>
        									<option value="other">อื่นๆ</option>
        								</select>
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addostype">ชนิดระบบปฏิบัตการ</label>
        								<select required name="addostype" id="addostype" class="form-control">
        									<option disabled selected value="">เลือกโปรแกรม ชนิดระบบปฏิบัตการ</option>
        									<option value="32BIT">32BIT</option>
        									<option value="64BIT">64BIT</option>
        									<option value="ARM">ARM</option>
        									<option value="other">อื่นๆ</option>
        								</select>
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addip">IPv4 Address</label>
        								<input name="addip" id="addip" type="text" class="form-control" placeholder="IP เครื่อง" aria-label="IP เครื่อง">
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addusb">สถานะ USB</label>
        								<select required name="addusb" id="addusb" class="form-control">
        									<option disabled selected value="">เลือกโปรแกรม สถานะ USB</option>
        									<option value="ปิด">ปิด</option>
        									<option value="เปิด">เปิด</option>
        								</select>
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addmacaddress">MAC Address</label>
        								<input name="addmacaddress" id="addmacaddress" type="text" class="form-control" placeholder="Mac Address" aria-label="Mac Address">
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addstatus">สถานะ</label>
        								<select required name="addstatus" id="addstatus" class="form-control">
        									<option disabled selected value="">เลือกสถานะ</option>
        									<option value="ใช้งาน" class="text-success">ใช้งาน</option>
        									<option value="ใช้งานไม่ได้" class="text-info">ใช้งานไม่ได้</option>
        									<option value="ขายแล้ว" class="text-info">ว่าง</option>
        									<option value="เก็บใน Stock" class="text-warning">เก็บใน Stock</option>
        									<option value="ขายแล้ว" class="text-info">ขายแล้ว</option>
        									<option value="อื่นๆ">อื่นๆ</option>
        								</select>
        							</div>
        						</div>
        						<div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="addplace">สถานที่ตั้ง</label>
										<select required name="addplace" id="addplace" class="form-control">
        									<option disabled selected value="">เลือกสถานที่ตั้ง</option>
        									<option value="ห้อง IT">ห้อง IT</option>
											<option value="ห้อง server IT">ห้อง server IT</option>
											<option value="ห้องเก็บของ IT">ห้องเก็บของ IT</option>
        									<option value="ห้อง SA">ห้อง SA</option>
        									<option value="ห้อง BP">ห้อง BP</option>
											<option value="ห้อง CASHIER">ห้อง CASHIER</option>
											<option value="ห้อง CRL">ห้อง CRL</option>
											<option value="ห้อง CC">ห้อง CC</option>
											<option value="ห้อง HR">ห้อง HR</option>
											<option value="ห้อง MKT">ห้อง MKT</option>
											<option value="ห้อง TBR">ห้อง TBR</option>
											<option value="ห้อง CR_AM">ห้อง CR_AM</option>
											<option value="ห้อง SA_BP">ห้อง SA_BP</option>
											<option value="ห้อง SALE">ห้อง SALE</option>
											<option value="ห้อง PART">ห้อง PART</option>
											<option value="ห้อง บัญชี">ห้อง บัญชี</option>
											<option value="ห้อง vdqi">ห้อง vdqi</option>
											<option value="ห้อง ประกัน">ห้อง ประกัน</option>
        									<option value="อื่นๆ">อื่นๆ</option>
        								</select>
        							</div>
        						</div>

								<!-- <div class="col-sm-6 col-md-4 col-lg-3">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">รูปภาพ</label>
        								<input type="file" name="user_image" accept="image/*" class="form-control file-up" placeholder="Username" aria-label="file">
        							</div>
        						</div> -->

        						<div class="col-12">
        							<div class="form-group">
        								<label for="addhistoryplace">ประวัติการใช้งาน</label>
        								<textarea name="addhistoryplace" id="addhistoryplace" class="form-control" rows="2"></textarea>
        							</div>
        						</div>

        						<div class="col-12">
        							<div class="form-group">
        								<label for="addhistoryrepair">ประวัติการซ่อม</label>
        								<textarea name="addhistoryrepair" id="addhistoryrepair" class="form-control" rows="2"></textarea>
        							</div>
        						</div>
        						<div class="col-12">
        							<div class="form-group">
        								<label for="addtxtspec">รายละเอียดโปรแกรม/อื่น ๆ</label>
        								<textarea name="addtxtspec" id="addtxtspec" class="form-control" rows="4"></textarea>
        							</div>
        						</div>

        						<div class="col-6">
        							<div class="form-group">
        								<label for="addtxtwar_eq">วันที่รับประกัน</label>
        								<input name="addtxtwar_eq" id="addtxtwar_eq" type="date" class="form-control" placeholder="xx/xx/xxxx" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="addtxtbuy">วันที่ซื้อ</label>
        								<input name="addtxtbuy" id="addtxtbuy" type="date" class="form-control" placeholder="xx/xx/xxxx" aria-label="Username">
        							</div>
        						</div>
        					</div>
        				</div>
        				<!-- Modal footer -->
        				<div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        					<button type="submit" name="btnsave_eqc" class="btn btn-success">บันทึก</button>
        				</div>
        			</div>
        		</div>
        	</div>
        </form>

        <form method="post" enctype="multipart/form-data" class="form-horizontal">
        	<div class="modal fade" id="myETC">
        		<div class="modal-dialog modal-dialog-centered">
        			<div class="modal-content">
        				<!-- Modal Header -->
        				<div class="modal-header">
        					<h4 class="modal-title">เพิ่มอุปกรณ์</h4>
        					<button type="button" class="close" data-dismiss="modal">&times;</button>
        				</div>
        				<!-- Modal body -->
        				<div class="modal-body">
        					<div class="row">
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">อุปกรณ์</label>
        								<select required name="txtacc" class="form-control" id="exampleFormControlSelect2">
        									<option disabled selected value="">เลือกอุปกรณ์</option>
        									<?php
											$acc_id = "SELECT * FROM acc";
											$queryacc_id = $user->selectacc_id($acc_id);
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">สาขา</label>
        								<select required name="txtbranch" class="form-control" id="exampleFormControlSelect2">
        									<option disabled selected value="">เลือกสาขา</option>
        									<?php
											$branch_id = "SELECT * FROM branch";
											$querybranch_id = $user->selectbranch_id($branch_id);
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">รุ่น</label>
        								<input name="txtseries" type="text" class="form-control" placeholder="รุ่นอุปกรณ์" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">ซีเรียล</label>
        								<input name="txtserial" type="text" class="form-control" placeholder="ซีเรียล" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleTextarea1">ราคา</label>
        								<input name="txtprice" type="text" class="form-control" placeholder="ราคา" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleTextarea1">วันที่รับประกัน</label>
        								<input name="txtwar" type="date" class="form-control" placeholder="xx/xx/xxxx" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">

										<label for="exampleTextarea1">สถานที่ตั้ง</label>
										<select required name="txtinstall" id="exampleTextarea1" class="form-control">
        									<option disabled selected value="">เลือกสถานที่ตั้ง</option>
        									<option value="ห้อง IT">ห้อง IT</option>
											<option value="ห้อง server IT">ห้อง server IT</option>
											<option value="ห้องเก็บของ IT">ห้องเก็บของ IT</option>
        									<option value="ห้อง SA">ห้อง SA</option>
        									<option value="ห้อง BP">ห้อง BP</option>
											<option value="ห้อง CASHIER">ห้อง CASHIER</option>
											<option value="ห้อง CRL">ห้อง CRL</option>
											<option value="ห้อง CC">ห้อง CC</option>
											<option value="ห้อง HR">ห้อง HR</option>
											<option value="ห้อง MKT">ห้อง MKT</option>
											<option value="ห้อง TBR">ห้อง TBR</option>
											<option value="ห้อง CR_AM">ห้อง CR_AM</option>
											<option value="ห้อง SA_BP">ห้อง SA_BP</option>
											<option value="ห้อง SALE">ห้อง SALE</option>
											<option value="ห้อง PART">ห้อง PART</option>
											<option value="ห้อง บัญชี">ห้อง บัญชี</option>
											<option value="ห้อง vdqi">ห้อง vdqi</option>
											<option value="ห้อง ประกัน">ห้อง ประกัน</option>
        									<option value="อื่นๆ">อื่นๆ</option>
        								</select>
        							</div>
        						</div>
								<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">ผู้ใช้</label>
        								<input name="txtuser" type="text" class="form-control" placeholder="ผู้ใช้" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleTextarea1">วันที่ซื้อ</label>
        								<input name="txtdbuy" type="date" class="form-control" placeholder="วันที่ซื้อ" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleTextarea1">สถานที่ซื้อ</label>
        								<input name="txtwb" type="text" class="form-control" placeholder="สถานที่ซื้อ" aria-label="Username">
        							</div>
        						</div>
								<div class="col-12">
        							<div class="form-group">
        								<label for="exampleTextarea1">สถานะ</label>
        								<select required name="txtaccstatus" id="exampleTextarea1" class="form-control">
        									<option disabled selected value="">เลือกสถานะ</option>
        									<option value="ใช้งาน" class="text-success">ใช้งาน</option>
        									<option value="ใช้งานไม่ได้" class="text-info">ใช้งานไม่ได้</option>
        									<option value="ขายแล้ว" class="text-info">ว่าง</option>
        									<option value="เก็บใน Stock" class="text-warning">เก็บใน Stock</option>
        									<option value="ขายแล้ว" class="text-info">ขายแล้ว</option>
        									<option value="อื่นๆ">อื่นๆ</option>
        								</select>
        							</div>
        						</div>

								
        					</div>
        				</div>
        				<!-- Modal footer -->
        				<div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        					<button type="submit" name="btnsave_eqe" class="btn btn-success">บันทึก</button>
        				</div>
        			</div>
        		</div>
        	</div>
        </form>

        <form method="post" enctype="multipart/form-data" class="form-horizontal">
        	<div class="modal fade" id="add_stock">
        		<div class="modal-dialog modal-dialog-centered">
        			<div class="modal-content">
        				<!-- Modal Header -->
        				<div class="modal-header">
        					<h4 class="modal-title">เพิ่มใบส่งซ่อม/เคลม</h4>
        					<button type="button" class="close" data-dismiss="modal">&times;</button>
        				</div>
        				<!-- Modal body -->
        				<div class="modal-body">
        					<div class="row">
        						<div class="col-12">
        							<div class="form-group">
        								<label>ผู้แจ้งซ่อม</label>
        								<input required name="txtname" type="text" class="form-control" placeholder="ชื่อผู้แจ้งซ่อม" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">สาขา</label>
        								<select required name="txtbranch" class="form-control" id="exampleFormControlSelect2">
        									<option disabled selected value="">เลือกสาขา</option>
        									<?php
											$branch = "SELECT * FROM branch";
											$querybranch = $user->selectbranch($branch);
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">แผนก</label>
        								<select required name="txtdept" class="form-control" id="exampleFormControlSelect2">
        									<option disabled selected value="">เลือกแผนก</option>
        									<?php
											$dept = "SELECT * FROM dept";
											$querydept = $user->selectdept($dept);
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">อุปกรณ์ที่ส่งซ่อม</label>
        								<select required name="txtacc" class="form-control" id="exampleFormControlSelect2">
        									<option disabled selected value="">เลือกอุปกรณ์ส่งซ่อม</option>
        									<?php
											$acc = "SELECT * FROM acc";
											$queryacc = $user->selectacc($acc);
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">จำนวนที่เบิก</label>
        								<select required name="txtacc" class="form-control" id="exampleFormControlSelect2">
        									<option disabled selected value="">จำนวนที่ต้องการเบิก</option>
        									<?php
											for ($i = 1; $i <= 10; $i++) {
												echo '<option value = "' . $i . '">' . $i . '</option>';
											}
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-12">
        							<div class="form-group">
        								<label for="exampleTextarea1">รายละเอียด/อาการเสีย</label>
        								<textarea required name="txtdesc" class="form-control" id="exampleTextarea1" rows="4"></textarea>
        							</div>
        						</div>
        					</div>
        				</div>
        				<!-- Modal footer -->
        				<div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        					<button type="submit" name="btnsave" class="btn btn-success">บันทึก</button>
        				</div>
        			</div>
        		</div>
        	</div>
        </form>

        <form method="post" enctype="multipart/form-data" class="form-horizontal">
        	<div class="modal fade" id="myModal2">
        		<div class="modal-dialog modal-dialog-centered">
        			<div class="modal-content">
        				<!-- Modal Header -->
        				<div class="modal-header">
        					<h4 class="modal-title">เพิ่มอุปกรณ์ใน Stock</h4>
        					<button type="button" class="close" data-dismiss="modal">&times;</button>
        				</div>
        				<!-- Modal body -->
        				<div class="modal-body">
        					<div class="row">
        						<div class="col-6">
        							<div class="form-group">
        								<label>ชื่ออุปกรณ์</label>
        								<input required name="txtname" type="text" class="form-control" placeholder="ยี่ห้อ" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label>ยี่ห้อ</label>
        								<input required name="txtbrand" type="text" class="form-control" placeholder="ยี่ห้อ" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label>รุ่น</label>
        								<input required name="txtseries" type="text" class="form-control" placeholder="รุ่น" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label>จำนวน</label>
        								<input required name="txtincome" type="text" class="form-control" placeholder="จำนวนเริ่มแรก" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-12">
        							<div class="form-group">
        								<label for="exampleTextarea1">รายละเอียด</label>
        								<textarea name="txtdesc_st" class="form-control" id="exampleTextarea1" placeholder="เช่น S/N" rows="1"></textarea>
        							</div>
        						</div>
        					</div>
        				</div>
        				<!-- Modal footer -->
        				<div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        					<button type="submit" name="btnsave_sta" class="btn btn-success">บันทึก</button>
        				</div>
        			</div>
        		</div>
        	</div>
        </form>

        <form method="post" enctype="multipart/form-data" class="form-horizontal">
        	<div class="modal fade" id="myModal3">
        		<div class="modal-dialog modal-dialog-centered">
        			<div class="modal-content">
        				<!-- Modal Header -->
        				<div class="modal-header">
        					<h4 class="modal-title">เพิ่มหมึกใน Stock</h4>
        					<button type="button" class="close" data-dismiss="modal">&times;</button>
        				</div>
        				<!-- Modal body -->
        				<div class="modal-body">
        					<div class="row">
        						<div class="col-12">
        							<div class="form-group">
        								<label>ประเภทหมึก</label>
        								<select required name="txtinktype" class="form-control" id="exampleFormControlSelect2">
        									<option disabled selected value="">ประเภทหมึก</option>
        									<option value="INKJET">INKJET</option>
        									<option value="TONER">TONER</option>
        									<option value="DOT MATRIX">DOT MATRIX</option>
        								</select>
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label>รุ่นหมึก</label>
        								<input required name="txtbrandink" type="text" class="form-control" placeholder="Epson L210 สีดำ/HP Laserjet P1102 (85A)" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label>จำนวนที่เพิ่ม</label>
        								<input required name="txtcountink" type="text" class="form-control" placeholder="รุ่น" aria-label="Username">
        							</div>
        						</div>
        					</div>
        				</div>
        				<!-- Modal footer -->
        				<div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        					<button type="submit" name="btnsave_sti" class="btn btn-success">บันทึก</button>
        				</div>
        			</div>
        		</div>
        	</div>
        </form>

        <form method="post" enctype="multipart/form-data" class="form-horizontal">
        	<div class="modal fade" id="outstockacc">
        		<div class="modal-dialog modal-dialog-centered">
        			<div class="modal-content">
        				<!-- Modal Header -->
        				<div class="modal-header">
        					<h4 class="modal-title">เบิกอุปกรณ์</h4>
        					<button type="button" class="close" data-dismiss="modal">&times;</button>
        				</div>
        				<!-- Modal body -->
        				<div class="modal-body">
        					<div class="row">
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">อุปกรณ์ที่ต้องการเบิก</label>
        								<select required name="txtoutacc" class="form-control" id="exampleFormControlSelect2">
        									<option disabled selected value="">เลือกอุปกรณ์ที่ต้องการเบิก</option>
        									<?php
											$stockaccall = "SELECT * ,COUNT(*) AS c FROM `stock_acc`  WHERE `stock_income` != '0' GROUP BY `stock_series`";
											$querystockacc = $user->selectstockaccall($stockaccall);
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label>จำนวนที่ต้องการเบิก</label>
        								<select required name="txtoutcount" class="form-control" id="exampleFormControlSelect2">
        									<option disabled selected value="">จำนวนที่ต้องการเบิก</option>
        									<?php
											for ($i = 1; $i <= 10; $i++) {
												echo '<option value = "' . $i . '">' . $i . '</option>';
											}
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label>ชื่อผู้เบิก</label>
        								<input required name="txtoutname" type="text" class="form-control" placeholder="ยี่ห้อ" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">แผนก</label>
        								<select required name="txtoutdept" class="form-control" id="exampleFormControlSelect2">
        									<option disabled selected value="">แผนกที่ขอเบิก</option>
        									<?php
											$dept_id = "SELECT * FROM dept";
											$querydept_id = $user->selectdept_id($dept_id);
											?>
        								</select>
        							</div>
        						</div>
        					</div>
        				</div>
        				<!-- Modal footer -->
        				<div class="modal-footer">
        					<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button> -->
        					<button type="submit" name="btn_stockout" class="btn btn-success">บันทึก</button>
        				</div>
        			</div>
        		</div>
        	</div>
        </form>

        <form method="post" enctype="multipart/form-data" class="form-horizontal">
        	<div class="modal fade" id="outstockink">
        		<div class="modal-dialog modal-dialog-centered">
        			<div class="modal-content">
        				<!-- Modal Header -->
        				<div class="modal-header">
        					<h4 class="modal-title">เบิกหมึก</h4>
        					<button type="button" class="close" data-dismiss="modal">&times;</button>
        				</div>
        				<!-- Modal body -->
        				<div class="modal-body">
        					<div class="row">
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">หมึกที่ต้องการเบิก</label>
        								<select required name="txtinkoutink" class="form-control" id="exampleFormControlSelect2">
        									<option disabled selected value="">เลือกหมึกที่ต้องการเบิก</option>
        									<?php
											$stockinkall = "SELECT * FROM stock_ink";
											$querystockinkall = $user->selectstockinkall($stockinkall);
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label>จำนวนที่ต้องการเบิก</label>
        								<select required name="txtinkoutcountink" class="form-control" id="quantitySelect">
        									<option disabled selected value="">จำนวนที่ต้องการเบิก</option>
        									<?php
											for ($i = 1; $i <= 10; $i++) {
												echo '<option value="' . $i . '">' . $i . '</option>';
											}
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label>ชื่อผู้เบิก</label>
        								<input required name="txtinkoutnameink" type="text" class="form-control" placeholder="ยี่ห้อ" aria-label="Username">
        							</div>
        						</div>
        						<div class="col-6">
        							<div class="form-group">
        								<label for="exampleFormControlSelect2">แผนก</label>
        								<select required name="txtoutdeptink" class="form-control" id="exampleFormControlSelect2">
        									<option disabled selected value="">แผนกที่ขอเบิก</option>
        									<?php
											$dept_id = "SELECT * FROM dept";
											$querydept_id = $user->selectdept_id($dept_id);
											?>
        								</select>
        							</div>
        						</div>
        						<div class="col-12">
        							<div class="form-group">
        								<label for="branchSelect">สาขา</label>
        								<select required name="txtoutbranchink" class="form-control" id="branchSelect">
        									<option disabled selected value="">สาขาที่ขอเบิก</option>
        									<option value="ho">สำนักงานใหญ่</option>
        									<option value="bd">บ้านดอน</option>
        									<option value="mr">มัญจา</option>
        									<option value="nr">หนองเรือ</option>
        									<option value="np">หนองไผ่</option>
        								</select>
        							</div>
        						</div>
        					</div>
        				</div>
        				<!-- Modal footer -->
        				<div class="modal-footer">
        					<button type="submit" name="btn_stockinkout" class="btn btn-success">บันทึก</button>
        				</div>
        			</div>
        		</div>
        	</div>
        </form>

        <script>
        	document.getElementById('branchSelect').addEventListener('change', function() {
        		var branch = this.value;
        		var quantitySelect = document.getElementById('quantitySelect');

        		// Reset the quantity options
        		quantitySelect.innerHTML = '';

        		if (branch === 'ho') { // If the branch is headquarters
        			quantitySelect.innerHTML = '<option value="1">1</option>';
        		} else { // For other branches
        			for (var i = 1; i <= 10; i++) {
        				quantitySelect.innerHTML += '<option value="' + i + '">' + i + '</option>';
        			}
        		}
        	});
        </script>