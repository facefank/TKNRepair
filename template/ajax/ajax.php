 <div id="dataModal" class="modal fade">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Employee Details</h4>
             </div>
             <div class="modal-body" id="employee_detail"></div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
 <div id="add_data_Modal" class="modal fade">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">อัพเดทสถานะการซ่อม</h4>
             </div>
             <div class="modal-body">
                 <form method="post" id="insert_form">
                     <!-- <label>Enter Employee Name</label>  
                        <input type="text" name="name"  class="form-control" />  
                        <br /> -->
                     <label>สถานะการซ่อม</label>
                     <select name="name" id="repair_status" class="form-control">
                         <?php
                            $selectcard = "SELECT * FROM card_type";
                            $querycard = $user->selectcd($selectcard);
                            ?>
                     </select>
                     <br>
                     <div class="row">
                         <div class="col-12">
                             <div class="form-group">
                                 <label>หมายเหตุ</label>
                                 <textarea class="form-control" name="txt_comment" id="repair_comment"></textarea>
                             </div>
                         </div>
                         <div class="col-12">
                             <div class="form-group">
                                 <label>เลือกคนแก้ไข</label>
                                 <select name="repair_itemp" id="repair_itemp" class="form-control">
                                     <option disaled selected>เลือกคนแก้ไข</option>
                                     <option value="พี่ทิว">พี่ทิว</option>
                                     <option value="พี่เอส">พี่เอส</option>
                                     <option value="นนท์">นนท์</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <input type="hidden" name="employee_id" id="employee_id" />
                     <?php echo $message; ?>
                     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>



 <div id="add_status_Modal" class="modal fade">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">เพิ่มสถานะการซ่อม</h4>
             </div>
             <div class="modal-body">
                 <form method="post" id="insert_form_status">
                     <div class="row">
                         <div class="col-12">
                             <div class="form-group">
                                 <label>สถานะการซ่อม</label>
                                 <input class="form-control" type="text" name="txt_tus" id="txt_status" placeholder="เพิ่มสถานะการซ่อม">
                                 <br>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-12">
                             <div class="form-group">
                                 <label>เลือกสีสถานะการซ่อม</label>
                                 <input style="width: 100%;border: none;background-color: #fff;" type="color" id="txt_body" name="txt_color" value="#f6b73c">
                             </div>
                         </div>
                     </div>
                     <input type="hidden" name="status_id" id="status_id" />
                     <?php echo $message; ?>
                     <input type="submit" name="insert_card" id="insert_card" value="Insert" class="btn btn-success" />
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>


 <div id="edit_eqe" class="modal fade">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">แก้ไขอุปกรณ์</h4>
             </div>
             <div class="modal-body">
                 <form method="post" id="form_edit_eqe">
                     <div class="row">
                         <div class="col-6">
                             <div class="form-group">
                                 <label for="txtacc">อุปกรณ์</label>
                                 <select required name="txtacc" id="txtacc" class="form-control">
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
                                 <label for="txtbranch">สาขา</label>
                                 <select required name="txtbranch" id="txtbranch" class="form-control">
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
                                 <input name="txtseries" id="txtseries" type="text" class="form-control" placeholder="รุ่นอุปกรณ์" aria-label="Username">
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="form-group">
                                 <label for="exampleFormControlSelect2">ซีเรียล</label>
                                 <input name="txtserial" id="txtserial" type="text" class="form-control" placeholder="ซีเรียล" aria-label="Username">
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="form-group">
                                 <label for="exampleTextarea1">ราคา</label>
                                 <input name="txtprice" id="txtprice" type="text" class="form-control" placeholder="ราคา" aria-label="Username">
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="form-group">
                                 <label for="exampleTextarea1">วันที่รับประกัน</label>
                                 <input name="txtwar" id="txtwar" type="date" class="form-control" placeholder="xx/xx/xxxx" aria-label="Username">
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="form-group">
                                <!-- เพิ่มสถานที่ด้วย -->
                                 <label for="exampleTextarea1">ที่ติดตั้ง</label>
                                 <select required name="txtinstall" id="txtinstall" class="form-control">
                                     <option disabled selected value="">เลือกสถานที่ติดตั้ง</option>
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
                                     <option value="ห้อง ประชุม">ห้อง ประชุม</option>
                                     <option value="อื่นๆ">อื่นๆ</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-6">
        							<div class="form-group">
        								<label for="exampleTextarea1">ผู้ใช้</label>
        								<input name="txtuser"id="txtuser"  type="text" class="form-control" placeholder="ผู้ใช้" aria-label="Username">
        							</div>
        						</div>
                         <div class="col-6">
                             <div class="form-group">
                                 <label for="exampleTextarea1">วันที่ซื้อ</label>
                                 <input name="txtdbuy" id="txtdbuy" type="date" class="form-control" placeholder="วันที่ซื้อ" aria-label="Username">
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="form-group">
                                 <label for="exampleTextarea1">สถานที่ซื้อ</label>
                                 <input name="txtwb" id="txtwb" type="text" class="form-control" placeholder="สถานที่ซื้อ" aria-label="Username">
                             </div>
                         </div>

                         <div class="col-12">
                             <div class="form-group">
                                 <label for="exampleTextarea1">สถานะ</label>
                                 <select required name="txtaccstatus" id="txtaccstatus" class="form-control">
                                     <option disabled selected value="">เลือกสถานะ</option>
                                     <option value="ใช้งาน" class="text-success">ใช้งาน</option>
                                     <option value="ใช้งานไม่ได้" class="text-info">ใช้งานไม่ได้</option>
                                     <option value="ว่าง" class="text-info">ว่าง</option>
                                     <option value="เก็บใน Stock" class="text-warning">เก็บใน Stock</option>
                                     <option value="ขายแล้ว" class="text-info">ขายแล้ว</option>
                                     <option value="อื่นๆ">อื่นๆ</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <input type="hidden" name="eq_id" id="eq_id" />
                     <?php echo $message; ?>
                     <input type="submit" name="eๆ_card" id="eq_card" value="Insert" class="btn btn-success" />
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>

 <div id="edit_eqc" class="modal fade">
     <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">แก้ไขคอมพิวเตอร์</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">
                 <form method="post" id="form_edit_eqc">
                     <!-- <div class="row">
                         <div class="col-6">
                             <div class="form-group">
                                 <label>ชื่อผู้ใช้งาน</label>
                                 <input required name="txtname" id="txtname" type="text" class="form-control" placeholder="ชื่อผู้ใช้งาน" aria-label="Username">
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="form-group">
                                 <label for="exampleFormControlSelect2">สาขา</label>
                                 <select required name="txtbranch_eq" id="txtbranch_eq" class="form-control">
                                     <option disabled selected value="">เลือกสาขา</option>
                                     <?php
                                        // $branch_id = "SELECT * FROM branch";
                                        // $querybranch_id = $user->selectbranch_id($branch_id);
                                        ?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="form-group">
                                 <label for="exampleFormControlSelect2">แผนก</label>
                                 <select required name="txtdept" id="txtdept" class="form-control">
                                     <option disabled selected value="">เลือกแผนก</option>
                                     <?php
                                        // $dept_id = "SELECT * FROM dept";
                                        // $querydept_id = $user->selectdept_id($dept_id);
                                        ?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="form-group">
                                 <label for="exampleFormControlSelect2">ชื่อเครื่อง</label>
                                 <input name="txtcomname" id="txtcomname" type="text" class="form-control" placeholder="ชื่อเครื่อง" aria-label="Username">
                             </div>
                         </div>
                         <div class="col-12">
                             <div class="form-group">
                                 <label for="exampleTextarea1">สเปคเครื่อง</label>
                                 <textarea name="txtspec" id="txtspec" class="form-control" rows="4"></textarea>
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="form-group">
                                 <label for="exampleTextarea1">วันที่รับประกัน</label>
                                 <input name="txtwar_eq" id="txtwar_eq" type="text" class="form-control" placeholder="xx/xx/xxxx" aria-label="Username">
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="form-group">
                                 <label for="exampleTextarea1">วันที่ซื้อ</label>
                                 <input name="txtbuy" id="txtbuy" type="text" class="form-control" placeholder="xx/xx/xxxx" aria-label="Username">
                             </div>
                         </div>
                     </div> -->
                     <div class="d-flex">
                         <hr class="flex-grow">
                         <div>ส่วนของ User</div>
                         <hr class="flex-grow">
                     </div>

                     <div class="row">
                         <div class="col-sm-3">
                             <div class="form-group">
                                 <label for="txtbranch_eq">สาขา</label>
                                 <select required name="txtbranch_eq" id="txtbranch_eq" class="form-control">
                                     <option disabled selected value="">เลือกสาขา</option>
                                     <?php
                                        $branch_id = "SELECT * FROM branch";
                                        $querybranch_id = $user->selectbranch_id($branch_id);
                                        ?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-3">
                             <div class="form-group">
                                 <label for="txtdept">แผนก</label>
                                 <select required name="txtdept" id="txtdept" class="form-control">
                                     <option disabled selected value="">เลือกแผนก</option>
                                     <?php
                                        $dept_id = "SELECT * FROM dept";
                                        $querydept_id = $user->selectdept_id($dept_id);
                                        ?>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-3">
                             <div class="form-group">
                                 <label for="txtcomname">ชื่อเครื่อง</label>
                                 <input name="txtcomname" id="txtcomname" type="text" class="form-control" placeholder="ชื่อเครื่อง" aria-label="NameCom">
                             </div>
                         </div>
                         <div class="col-sm-3">
                             <div class="form-group">
                                 <label for="txtname">ชื่อผู้ใช้งาน</label>
                                 <input required name="txtname" id="txtname" type="text" class="form-control" placeholder="ชื่อผู้ใช้งาน" aria-label="Nameuser">
                             </div>
                         </div>
                         <div class="col-sm-4">
                             <div class="form-group">
                                 <label for="model">Model เครื่อง</label>
                                 <input name="model" id="model" type="text" class="form-control" placeholder="model เครื่อง" aria-label="model">
                             </div>
                         </div>
                         <div class="col-sm-4">
                             <div class="form-group">
                                 <label for="serielno">S/N</label>
                                 <input name="serielno" id="serielno" type="text" class="form-control" placeholder="serielnumber" aria-label="serielno">
                             </div>
                         </div>
                         <div class="col-sm-4">
                             <div class="form-group">
                                 <label for="type">ประเภท</label>
                                 <select required name="type" id="type" class="form-control">
                                     <option disabled selected value="">เลือกประเภท</option>
                                     <option value="PC">PC</option>
                                     <option value="allinone">AIO</option>
                                     <option value="laptop">laptop</option>
                                     <option value="ตู้โทรศัพท์">ตู้โทรศัพท์</option>
                                     <option value="other">อื่นๆ</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-2">
                             <div class="form-group">
                                 <label for="cpu">ประเภท CPU</label>
                                 <select required name="cpu" id="cpu" class="form-control">
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
                         <div class="col-sm-2">
                             <div class="form-group">
                                 <label for="GEN">GEN-CPU</label>
                                 <select required name="GEN" id="GEN" class="form-control">
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
                         <div class="col-sm-2">
                             <div class="form-group">
                                 <label for="ram">ขนาด RAM</label>
                                 <select required name="ram" id="ram" class="form-control">
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
                         <div class="col-sm-2">
                             <div class="form-group">
                                 <label for="ssd">SSD</label>
                                 <select required name="ssd" id="ssd" class="form-control">
                                     <option disabled selected value="">เลือกขนาด SSD</option>
                                     <option value="ไม่มี">ไม่มี</option>
                                     <option value="120GB">120GB</option>
                                     <option value="128GB">128GB</option>
                                     <option value="240GB">240GB</option>
                                     <option value="256GB">256GB</option>
                                     <option value="480GB">480GB</option>
                                     <option value="512GB">512GB</option>
                                     <option value="1TB">1TB</option>
                                     <option value="2TBGB">2TBGB</option>
                                     <option value="4TB">4TB</option>
                                     <option value="other">อื่นๆ</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-2">
                             <div class="form-group">
                                 <label for="hdd">HDD</label>
                                 <select required name="hdd" id="hdd" class="form-control">
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
                         <div class="col-sm-2">
                             <div class="form-group">
                                 <label for="os">Windows</label>
                                 <select required name="os" id="os" class="form-control">
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
                         <div class="col-sm-3">
                             <div class="form-group">
                                 <label for="office">Office</label>
                                 <select required name="office" id="office" class="form-control">
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
                         <div class="col-sm-3">
                             <div class="form-group">
                                 <label for="antivirus">Antivirus</label>
                                 <select required name="antivirus" id="antivirus" class="form-control">
                                     <option disabled selected value="">เลือกโปรแกรม Antivirus</option>
                                     <option value="Malwarebyte">Malwarebyte</option>
                                     <option value="TrendMicro">TrendMicro</option>
                                     <option value="Avast">Avast</option>
                                     <option value="Kaspersky">Kaspersky</option>
                                     <option value="other">อื่นๆ</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-3">
                             <div class="form-group">
                                 <label for="ostype">ชนิดระบบปฏิบัตการ</label>
                                 <select required name="ostype" id="ostype" class="form-control">
                                     <option disabled selected value="">เลือกโปรแกรม ชนิดระบบปฏิบัตการ</option>
                                     <option value="32BIT">32BIT</option>
                                     <option value="64BIT">64BIT</option>
                                     <option value="ARM">ARM</option>
                                     <option value="other">อื่นๆ</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-3">
                             <div class="form-group">
                                 <label for="ip">IPv4 Address</label>
                                 <input name="ip" id="ip" type="text" class="form-control" placeholder="IP เครื่อง" aria-label="IP เครื่อง">
                             </div>
                         </div>
                         <div class="col-sm-3">
                             <div class="form-group">
                                 <label for="usb">สถานะ USB</label>
                                 <select required name="usb" id="usb" class="form-control">
                                     <option disabled selected value="">เลือกโปรแกรม สถานะ USB</option>
                                     <option value="ปิด">ปิด</option>
                                     <option value="เปิด">เปิด</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-sm-3">
                             <div class="form-group">
                                 <label for="macaddress">MAC Address</label>
                                 <input name="macaddress" id="macaddress" type="text" class="form-control" placeholder="Mac Address" aria-label="Mac Address">
                             </div>
                         </div>
                         <div class="col-sm-3">
                             <div class="form-group">
                                 <label for="status">สถานะ</label>
                                 <select required name="status" id="status" class="form-control">
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
                         <div class="col-sm-3">
                             <div class="form-group">
                                 <label for="place">สถานที่ตั้ง</label>
                                 <input name="place" id="place" type="text" class="form-control" placeholder="สถานที่ตั้ง" aria-label="สถานที่ตั้ง">

                             </div>
                         </div>

                         <div class="col-12">
                             <div class="form-group">
                                 <label for="historyplace">ประวัติการใช้งาน</label>
                                 <textarea name="historyplace" id="historyplace" class="form-control" rows="2"></textarea>
                             </div>
                         </div>

                         <div class="col-12">
                             <div class="form-group">
                                 <label for="historyrepair">ประวัติการซ่อม</label>
                                 <textarea name="historyrepair" id="historyrepair" class="form-control" rows="2"></textarea>
                             </div>
                         </div>

                         <div class="col-sm-3">
                             <div class="form-group">
                                 <label for="updatetime">วันที่อัพเดทข้อมูลล่าสุด</label>
                                 <input disabled name="updatetime" id="updatetime" type="text" class="form-control" placeholder="วันที่อัพเดท" aria-label="วันที่อัพเดท">
                             </div>
                         </div>

                         <div class="col-12">
                             <div class="form-group">
                                 <label for="exampleTextarea1">รายละเอียดโปรแกรม/อื่น ๆ</label>
                                 <textarea name="txtspec" id="txtspec" class="form-control" rows="4"></textarea>
                             </div>
                         </div>

                         <div class="col-sm-6">
                             <div class="form-group">
                                 <label for="exampleTextarea1">วันที่รับประกัน</label>
                                 <input name="txtwar_eq" id="txtwar_eq" type="text" class="form-control" placeholder="xx/xx/xxxx" aria-label="Username">
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="form-group">
                                 <label for="exampleTextarea1">วันที่ซื้อ</label>
                                 <input name="txtbuy" id="txtbuy" type="text" class="form-control" placeholder="xx/xx/xxxx" aria-label="Username">
                             </div>
                         </div>
                     </div>

                     <input type="hidden" name="equip_id" id="equip_id" />
                     <?php echo $message; ?>
                     <input type="submit" name="equip_card" id="equip_card" value="Insert" class="btn btn-success" />
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
 <div id="edit_stock" class="modal fade">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">แก้ไขคอมพิวเตอร์</h4>
             </div>
             <div class="modal-body">
                 <form method="post" id="form_edit_stock">
                     <div class="row">
                         <div class="col-6">
                             <div class="form-group">
                                 <label>ชื่ออุปกรณ์</label>
                                 <input required name="txtnames" id="txtnames" type="text" class="form-control" placeholder="ยี่ห้อ" aria-label="Username">
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="form-group">
                                 <label>ยี่ห้อ</label>
                                 <input required name="txtbrand" id="txtbrand" type="text" class="form-control" placeholder="ยี่ห้อ" aria-label="Username">
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="form-group">
                                 <label>รุ่น</label>
                                 <input required name="txtseriess" id="txtseriess" type="text" class="form-control" placeholder="รุ่น" aria-label="Username">
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="form-group">
                                 <label>จำนวน</label>
                                 <input required name="txtincome" id="txtincome" type="text" class="form-control" placeholder="จำนวนเริ่มแรก" aria-label="Username">
                             </div>
                         </div>
                         <div class="col-12">
                             <div class="form-group">
                                 <label for="exampleTextarea1">รายละเอียด</label>
                                 <textarea name="txtdesc_st" id="txtdesc_st" class="form-control" id="exampleTextarea1" placeholder="เช่น S/N" rows="1"></textarea>
                             </div>
                         </div>
                     </div>
                     <input type="hidden" name="stock_id" id="stock_id" />
                     <?php echo $message; ?>
                     <input type="submit" name="stock_card" id="stock_card" value="Insert" class="btn btn-success" />
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
 <div id="edit_stock_ink" class="modal fade">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">เพิ่ม Stock หมึก</h4>
             </div>
             <div class="modal-body">
                 <form method="post" id="form_edit_stock_ink">
                     <div class="row">
                         <div class="col-6">
                             <div class="form-group">
                                 <label>ประเภท</label>
                                 <input required name="txtnamesink" id="txtnamesink" type="text" class="form-control" placeholder="ยี่ห้อ" aria-label="Username">
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="form-group">
                                 <label>รุ่น</label>
                                 <input required name="txtseriesink" id="txtseriesink" type="text" class="form-control" placeholder="ยี่ห้อ" aria-label="Username">
                             </div>
                         </div>
                         <div class="col-6">
                             <div class="form-group">
                                 <label>จำนวน</label>
                                 <input required name="txtinkcount" id="txtinkcount" type="text" class="form-control" placeholder="รุ่น" aria-label="Username">
                             </div>
                         </div>
                     </div>
                     <input type="hidden" name="stock_inkid" id="stock_inkid" />
                     <?php echo $message; ?>
                     <input type="submit" name="stock_inkcard" id="stock_inkcard" value="Insert" class="btn btn-success" />
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
 <script>
     $(document).ready(function() {
         $('#add').click(function() {
             $('#insert').val("Insert");
             $('#insert_form')[0].reset();
         });

         //////////////// EDIT DATA REPAIR ///////////////
         $(document).on('click', '.edit_data', function() {
             var employee_id = $(this).attr("id");
             $.ajax({
                 url: "ajax/fetch.php",
                 method: "POST",
                 data: {
                     employee_id: employee_id
                 },
                 dataType: "json",
                 success: function(data) {
                     $('#repair_status').val(data.repair_status);
                     $('#repair_comment').val(data.repair_comment);
                     $('#employee_id').val(data.repair_id);
                     $('#insert').val("Update");
                     $('#add_data_Modal').modal('show');
                 }
             });
         });
         $('#insert_form').on("submit", function(event) {
             event.preventDefault();
             if ($('#name').val() == "") {
                 alert("Name is required");
             } else {
                 $.ajax({
                     url: "ajax/insert.php",
                     method: "POST",
                     data: $('#insert_form').serialize(),
                     beforeSend: function() {
                         $('#insert').val("Inserting");
                     },
                     success: function(data) {
                         $('#insert_form')[0].reset();
                         $('#add_data_Modal').modal('hide');
                         $('#employee_table').html(data);
                         location.reload();
                     }
                 });
             }
         });
         $(document).on('click', '.view_data', function() {
             var employee_id = $(this).attr("id");
             if (employee_id != '') {
                 $.ajax({
                     url: "select.php",
                     method: "POST",
                     data: {
                         employee_id: employee_id
                     },
                     success: function(data) {
                         $('#employee_detail').html(data);
                         $('#dataModal').modal('show');
                     }
                 });
             }
         });
         //////////////// EDIT DATA REPAIR ///////////////


         //////////////// EDIT STATUS REPAIR ///////////////
         $(document).on('click', '.edit_status', function() {
             var status_id = $(this).attr("id");
             $.ajax({
                 url: "ajax/fetch.php",
                 method: "POST",
                 data: {
                     status_id: status_id
                 },
                 dataType: "json",
                 success: function(data) {
                     $('#txt_status').val(data.card_name);
                     $('#txt_body').val(data.card_color);
                     $('#status_id').val(data.card_id);
                     $('#insert_card').val("Update");
                     $('#add_status_Modal').modal('show');
                 }
             });
         });
         $('#insert_form_status').on("submit", function(event) {
             event.preventDefault();
             if ($('#txt_status').val() == "") {
                 alert("Name is required");
             } else {
                 $.ajax({
                     url: "ajax/insert.php",
                     method: "POST",
                     data: $('#insert_form_status').serialize(),
                     beforeSend: function() {
                         $('#insert_card').val("Inserting");
                     },
                     success: function(data) {
                         $('#insert_form_status')[0].reset();
                         $('#add_status_Modal').modal('hide');
                         $('#employee_table').html(data);
                         location.reload();
                     }
                 });
             }
         });
         //////////////// EDIT STATUS REPAIR /////////////// 

         //////////////// EDIT EQE /////////////// 
         $(document).on('click', '.edit_eqe', function() {
             var eq_id = $(this).attr("id");
             $.ajax({
                 url: "ajax/fetch.php",
                 method: "POST",
                 data: {
                     eq_id: eq_id
                 },
                 dataType: "json",
                 success: function(data) {
                     $('#txtacc').val(data.acc_id);
                     $('#txtbranch').val(data.branch_id);
                     $('#txtseries').val(data.eq_series);
                     $('#txtserial').val(data.eq_serial);
                     $('#txtuser').val(data.eq_user);
                     $('#txtprice').val(data.eq_price);
                     $('#txtwar').val(data.eq_warranty);
                     $('#txtinstall').val(data.eq_install);
                     $('#txtdbuy').val(data.eq_buy);
                     $('#txtwb').val(data.eq_wb);
                     $('#txtaccstatus').val(data.status);
                     $('#eq_id').val(data.eq_id);
                     $('#eq_card').val("Update");
                     $('#edit_eqe').modal('show');


                 }
             });
         });
         $('#form_edit_eqe').on("submit", function(event) {
             event.preventDefault();
             if ($('#txtacc').val() == "") {
                 alert("Name is required");
             } else {
                 $.ajax({
                     url: "ajax/insert_eq.php",
                     method: "POST",
                     data: $('#form_edit_eqe').serialize(),
                     beforeSend: function() {
                         $('#eq_card').val("Inserting");
                     },
                     success: function(data) {
                         $('#form_edit_eqe')[0].reset();
                         $('#edit_eqe').modal('hide');
                         $('#employee_table').html(data);
                         location.reload();
                     }
                 });
             }
         });
         //////////////// EDIT EQE /////////////// 


         //////////////// EDIT EQC /////////////// 
         $(document).on('click', '.edit_eqc', function() {
             var equip_id = $(this).attr("id");
             $.ajax({
                 url: "ajax/fetch.php",
                 method: "POST",
                 data: {
                     equip_id: equip_id
                 },
                 dataType: "json",
                 success: function(data) {

                     console.log(data);

                     $('#txtbranch_eq').val(data.branch_id);
                     $('#txtdept').val(data.dept_id);
                     $('#txtcomname').val(data.name_com);
                     $('#txtname').val(data.name_user);
                     $('#model').val(data.eq_model);
                     $('#serielno').val(data.serial_num);
                     $('#type').val(data.eq_type);
                     $('#cpu').val(data.eq_cpu);
                     $('#GEN').val(data.eq_cpugen);
                     $('#ram').val(data.eq_ram);
                     $('#ssd').val(data.eq_ssd);
                     $('#hdd').val(data.eq_hdd);
                     $('#os').val(data.eq_os);
                     $('#office').val(data.eq_office);
                     $('#antivirus').val(data.eq_antivirus);
                     $('#ostype').val(data.eq_ostype);
                     $('#ip').val(data.eq_ip);
                     $('#usb').val(data.eq_usb);
                     $('#macaddress').val(data.eq_macaddress);
                     $('#status').val(data.eq_status);
                     $('#place').val(data.eq_place);

                     $('#historyrepair').val(data.eq_historyrepair);
                     $('#historyplace').val(data.eq_historyplace);
                     $('#updatetime').val(data.eq_updatetime);

                     $('#txtspec').val(data.spec);
                     $('#txtwar_eq').val(data.warranty);
                     $('#txtbuy').val(data.day_buy);
                     $('#equip_id').val(data.equip_id);
                     $('#equip_card').val("Update");
                     $('#edit_eqc').modal('show');
                 }
             });
         });


         $(document).on('click', '.deleq', function(event) {
             let getid = $(this).attr("id");

             event.preventDefault();
             Swal.fire({
                 title: 'Are you sure?',
                 text: "You won't be able to revert this!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Yes, delete it!'
             }).then((result) => {
                 if (result.isConfirmed) {
                     $.ajax({
                         url: "ajax/delete_eq.php",
                         method: "POST",
                         data: {
                             equip_id: getid
                         },
                         dataType: "json",
                         success: function(data) {
                             Swal.fire(
                                 'Deleted!',
                                 'Your data has been deleted.',
                                 'success'
                             ).then(() => {
                                 location.reload();
                             });
                         }
                     });
                 }
             });
         });


         $(document).on('click', '.deleq1', function(event) {
             let getid = $(this).attr("id");

             event.preventDefault();
             Swal.fire({
                 title: 'Are you sure?',
                 text: "You won't be able to revert this!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Yes, delete it!'
             }).then((result) => {
                 if (result.isConfirmed) {
                     $.ajax({
                         url: "ajax/delete_eq.php",
                         method: "POST",
                         data: {
                             eq_id: getid
                         },
                         dataType: "json",
                         success: function(data) {
                             Swal.fire(
                                 'Deleted!',
                                 'Your data has been deleted.',
                                 'success'
                             ).then(() => {
                                 location.reload();
                             });
                         }
                     });
                 }
             });
         });






         $('#form_edit_eqc').on("submit", function(event) {
             event.preventDefault();
             if ($('#txtname').val() == "") {
                 alert("Name is required");
             } else {
                 $.ajax({
                     url: "ajax/insert_eq.php",
                     method: "POST",
                     data: $('#form_edit_eqc').serialize(),
                     beforeSend: function() {
                         $('#equip_card').val("Inserting");
                     },
                     success: function(data) {
                         $('#form_edit_eqc')[0].reset();
                         $('#edit_eqc').modal('hide');
                         $('#employee_table').html(data);
                         location.reload();
                     }
                 });
             }
         });




         //////////////// EDIT EQC ///////////////

         //////////////// EDIT STOCK /////////////// 
         $(document).on('click', '.edit_stock', function() {
             var stock_id = $(this).attr("id");
             $.ajax({
                 url: "ajax/fetch.php",
                 method: "POST",
                 data: {
                     stock_id: stock_id
                 },
                 dataType: "json",
                 success: function(data) {
                     $('#txtnames').val(data.stock_name);
                     $('#txtbrand').val(data.stock_brand);
                     $('#txtseriess').val(data.stock_series);
                     $('#txtincome').val(data.stock_income);
                     $('#txtdesc_st').val(data.stock_desc);
                     $('#stock_id').val(data.stock_id);
                     $('#stock_card').val("Update");
                     $('#edit_stock').modal('show');
                 }
             });
         });
         $('#form_edit_stock').on("submit", function(event) {
             event.preventDefault();
             if ($('#txtnames').val() == "") {
                 alert("Name is required");
             } else {
                 $.ajax({
                     url: "ajax/insert_stock.php",
                     method: "POST",
                     data: $('#form_edit_stock').serialize(),
                     beforeSend: function() {
                         $('#stock_card').val("Inserting");
                     },
                     success: function(data) {
                         $('#form_edit_stock')[0].reset();
                         $('#edit_stock').modal('hide');
                         $('#employee_table').html(data);
                         location.reload();
                     }
                 });
             }
         });
         //////////////// EDIT STOCK ///////////////

         //////////////// EDIT STOCK INK /////////////// 
         $(document).on('click', '.edit_stock_ink', function() {
             var stock_inkid = $(this).attr("id");
             $.ajax({
                 url: "ajax/fetch.php",
                 method: "POST",
                 data: {
                     stock_inkid: stock_inkid
                 },
                 dataType: "json",
                 success: function(data) {
                     $('#txtnamesink').val(data.stock_inktype);
                     $('#txtseriesink').val(data.stock_ink_series);
                     $('#txtinkcount').val(data.stock_ink_income);
                     $('#stock_inkid').val(data.stock_inkid);
                     $('#stock_inkcard').val("Update");
                     $('#edit_stock_ink').modal('show');
                 }
             });
         });
         $('#form_edit_stock_ink').on("submit", function(event) {
             event.preventDefault();
             if ($('#txtnamesink').val() == "") {
                 alert("Name is required");
             } else {
                 $.ajax({
                     url: "ajax/insert_stock.php",
                     method: "POST",
                     data: $('#form_edit_stock_ink').serialize(),
                     beforeSend: function() {
                         $('#stock_inkcard').val("Inserting");
                     },
                     success: function(data) {
                         $('#form_edit_stock_ink')[0].reset();
                         $('#edit_stock_ink').modal('hide');
                         $('#employee_table').html(data);
                         location.reload();
                     }
                 });
             }
         });
         //////////////// EDIT STOCK INK ///////////////
     });
 </script>