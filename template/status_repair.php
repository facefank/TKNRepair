<style>
    .card {
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        border-radius: 0px;
    }
</style>
<?php

if ($_GET['p'] == 'repair_all' || $_GET['p'] == 'report') {
    // รหัสสำหรับแสดงผลลัพธ์ที่ต้องการเมื่อเงื่อนไขเป็นจริง
?>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <a href="?p=repair_all" style="width: 100%;color : #212529;">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-cube text-danger icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">ใบแจ้งซ่อมทั้งหมด</p>
                                <div class="fluid-container">
                                    <?php
                                    $call = "SELECT count(*) as c FROM rp_it";
                                    $querycall = $user->selectcall($call);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <a href="?p=repair_all" style="width: 100%;color : #212529;">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-calendar-text text-danger icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">ใบแจ้งซ่อมทั้งหมด (รายเดือน)</p>
                                <div class="fluid-container">
                                    <?php
                                    $call = "SELECT COUNT(*) as c
FROM rp_it
WHERE YEAR(repair_time) = YEAR(CURRENT_DATE)
AND MONTH(repair_time) = MONTH(CURRENT_DATE);
";
                                    $querycall = $user->selectcall($call);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-calendar-today text-warning icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">รายการส่งซ่อมวันนี้</p>
                            <div class="fluid-container">
                                <?php
                                $dall = "SELECT count(*) as d FROM rp_it WHERE repair_time >= CURDATE()";
                                $querydall = $user->selectdall($dall);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


    </div>
<?php
}
?>


<?php
// ตรวจสอบว่าค่าของพารามิเตอร์ 'p' ใน URL ตรงกับ 'equip' หรือไม่
if ($_GET['p'] === 'equip') {
    // รหัสสำหรับแสดงผลลัพธ์ที่ต้องการเมื่อเงื่อนไขเป็นจริง
?>
    <style>
        .status-indicator {
            width: 12px;
            height: 12px;
            background-color: #28a745;
            /* สีเขียว */
            border-radius: 50%;
            position: relative;
            animation: blink 3s infinite;
            /* การกระพริบ */
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
    <!-- equip&type=eqc -->
    <div class="row">
        <!-- การ์ดสำหรับเครื่องปริ๊นทั้งหมด -->
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <a href="?p=comdetail" style="width: 100%;color : #212529;">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-desktop-mac text-info icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right" style="display: inline-block;">COMPUTER (ไม่รวมห้องเก็บของ&Server)</p>
                                <div class="status-indicator" style="display: inline-block;"></div>

                                <div class="fluid-container">
                                    <?php
                                    $eqall = "SELECT COUNT(*) AS e FROM `equip`WHERE `eq_type`IN ('PC', 'allinone' ,'laptop','other') AND `eq_status` = 'ใช้งาน' AND NOT `eq_place` LIKE 'ห้องเก็บของ%' AND NOT `eq_place` LIKE '%Server%';           
";
                                    $queryeqall = $user->selecteqall($eqall);
                                    // echo $queryeqall['e']; // แสดงผลลัพธ์
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <!-- <a href="?p=printdetail" style="width: 100%;color : #212529;"> -->
            <a href="?p=printerdetail" style="width: 100%;color : #212529;">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-printer text-info icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right " style="display: inline-block;">PRINTER</p>
                                <div class="status-indicator" style="display: inline-block;"></div>
                                <div class="fluid-container">
                                    <?php
                                    $eqall = "SELECT count(*) as e FROM equip_etc WHERE acc_id = 7 AND `status` = 'ใช้งาน'";
                                    $queryeqall = $user->selecteqall($eqall);
                                    // echo $queryeqall['e']; // แสดงผลลัพธ์
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <a href="?p=equip&type=eq8" style="width: 100%;color : #212529;">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-camcorder text-info icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right " style="display: inline-block;">CCTV</p>
                                <div class="status-indicator" style="display: inline-block;"></div>
                                <div class="fluid-container">
                                    <?php
                                    $eqall = "SELECT count(*) as e FROM equip_etc WHERE acc_id = 8 AND `status` = 'ใช้งาน'";
                                    $queryeqall = $user->selecteqall($eqall);
                                    // echo $queryeqall['e']; // แสดงผลลัพธ์
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </a>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <a href="?p=equip&type=eq5" style="width: 100%;color : #212529;">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-tablet text-warning icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right" style="display: inline-block;">IPAD</p>
                                <div class="status-indicator" style="display: inline-block;"></div>
                                <div class="fluid-container">
                                    <?php
                                    $eqall = "SELECT count(*) as e FROM equip_etc WHERE acc_id = 19 AND `status` = 'ใช้งาน'";
                                    $queryeqall = $user->selecteqall($eqall);
                                    // echo $queryeqall['e']; // แสดงผลลัพธ์
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <a href="?p=equip&type=eq6" style="width: 100%;color : #212529;">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-keyboard text-warning icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right" style="display: inline-block;">KEYBOARD</p>
                                <div class="status-indicator" style="display: inline-block;"></div>
                                <div class="fluid-container">
                                    <?php
                                    $eqall = "SELECT count(*) as e FROM equip_etc WHERE acc_id = 6 AND `status` = 'ใช้งาน'";
                                    $queryeqall = $user->selecteqall($eqall);
                                    // echo $queryeqall['e']; // แสดงผลลัพธ์
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <a href="?p=equip&type=eq9" style="width: 100%;color : #212529;">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-phone text-warning icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right" style="display: inline-block;">TELEPHONE</p>
                                <div class="status-indicator" style="display: inline-block;"></div>
                                <div class="fluid-container">
                                    <?php
                                    $eqall = "SELECT count(*) as e FROM equip_etc WHERE acc_id = 9 AND `status` = 'ใช้งาน'";
                                    $queryeqall = $user->selecteqall($eqall);
                                    // echo $queryeqall['e']; // แสดงผลลัพธ์
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
<?php
}
?>


<?php

if ($_GET['p'] == 'stock') {
    // รหัสสำหรับแสดงผลลัพธ์ที่ต้องการเมื่อเงื่อนไขเป็นจริง
?>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <a href="?p=stock" style="width: 100%;color : #212529;">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-cube text-danger icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">คลัง Stock</p>
                                <div class="fluid-container">
                                    <?php
                                    $call = "SELECT count(*) as c FROM stock_acc";
                                    $querycall = $user->selectcall($call);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-mouse text-warning icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Mouse</p>
                            <div class="fluid-container">
                                <?php
                                $dall = "SELECT SUM(stock_income) as total_income FROM stock_acc WHERE stock_name = 'Mouse';";
                                $querydall = $user->selectdalll($dall);
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-keyboard text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Keyboard</p>
                            <div class="fluid-container">
                                <?php
                                $dall = "SELECT SUM(stock_income) as total_income FROM stock_acc WHERE stock_name = 'Keyboard';";
                                $querydall = $user->selectdalll($dall);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-disk text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">HDD SSD</p>
                            <div class="fluid-container">
                                <?php
                                $dall = "SELECT SUM(stock_income) as total_income FROM stock_acc WHERE stock_name = 'HDD SSD';";
                                $querydall = $user->selectdalll($dall);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-printer text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">ปริ้นเตอร์</p>
                            <div class="fluid-container">
                                <?php
                                $dall = "SELECT SUM(stock_income) as total_income FROM stock_acc WHERE stock_name = 'ปริ้นเตอร์';";
                                $querydall = $user->selectdalll($dall);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-switch text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Switch</p>
                            <div class="fluid-container">
                                <?php
                                $dall = "SELECT SUM(stock_income) as total_income FROM stock_acc WHERE stock_name = 'Switch';";
                                $querydall = $user->selectdalll($dall);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
}
?>


<?php

if ($_GET['p'] == 'reportink') {
    // รหัสสำหรับแสดงผลลัพธ์ที่ต้องการเมื่อเงื่อนไขเป็นจริง
?>

    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <a onclick="showChart('chart2')" style="width: 100%;color : #212529;">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-printer text-danger icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">TONER</p>
                                <div class="fluid-container">
                                    <?php
                                    $call = " SELECT SUM(stock_ink_income) AS c FROM stock_ink WHERE stock_inktype = 'TONER';";
                                    $querycall = $user->selectcall($call);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $eqalll = "SELECT stock_ink_series AS e, stock_ink_income AS d FROM stock_ink WHERE stock_inktype = 'TONER'; ";
                        $querycall = $user->selecteqalll($eqalll);

                        ?>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <a onclick="showChart('chart3')" style="width: 100%;color : #212529;">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-printer text-warning icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">DOT MATRIX</p>
                                <div class="fluid-container">
                                    <?php
                                    $dall = " SELECT SUM(stock_ink_income) AS d FROM stock_ink WHERE stock_inktype = 'DOT MATRIX';";
                                    $querydall = $user->selectdall($dall);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $eqalll = "SELECT stock_ink_series AS e, stock_ink_income AS d FROM stock_ink WHERE stock_inktype = 'DOT MATRIX'; ";
                        $querycall = $user->selecteqalll($eqalll);

                        ?>
                    </div>
            </div>
            </a>
        </div>


        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <a onclick="showChart('chart4')" style="width: 100%;color : #212529;">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-printer text-success icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">INKJET</p>
                                <div class="fluid-container">
                                    <?php
                                    $dall = " SELECT SUM(stock_ink_income) AS d FROM stock_ink WHERE stock_inktype = 'INKJET';";
                                    $querydall = $user->selectdall($dall);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $eqalll = "SELECT stock_ink_series AS e, stock_ink_income AS d FROM stock_ink WHERE stock_inktype = 'INKJET'; ";
                        $querycall = $user->selecteqalll($eqalll);

                        ?>
                    </div>
            </div>
            </a>
        </div>



    </div>
<?php
}
?>






<?php

if (!isset($_GET['p'])) {
    // รหัสสำหรับแสดงผลลัพธ์ที่ต้องการเมื่อเงื่อนไขเป็นจริง
?>
    <div class="row">

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <a href="?p=repair_all" style="width: 100%;color : #212529;">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-calendar-text text-danger icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">ใบแจ้งซ่อมทั้งหมด (รายเดือน)</p>
                                <div class="fluid-container">
                                    <?php
                                    $call = "SELECT COUNT(*) as c
FROM rp_it
WHERE YEAR(repair_time) = YEAR(CURRENT_DATE)
AND MONTH(repair_time) = MONTH(CURRENT_DATE);
";
                                    $querycall = $user->selectcall($call);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-calendar-today text-warning icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">รายการส่งซ่อมวันนี้</p>
                            <div class="fluid-container">
                                <?php
                                $dall = "SELECT count(*) as d FROM rp_it WHERE repair_time >= CURDATE()";
                                $querydall = $user->selectdall($dall);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <a href="?p=repair_all" style="width: 100%;color : #212529;">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-wrench text-success icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">การซ่อมเสร็จเรียบร้อย (รายวัน)</p>
                                <div class="fluid-container">
                                    <?php
                                    $call = "SELECT COUNT(*) AS c
FROM rp_it
WHERE repair_status = 4
  AND DATE(repair_time) = CURDATE();
 ";
                                    $querycall = $user->selectcall($call);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <a href="?p=repair_all" style="width: 100%;color : #212529;">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-wrench text-danger icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">การซ่อมยังไม่เรียบร้อย (รายวัน)</p>
                                <div class="fluid-container">
                                    <?php
                                    $call = "SELECT COUNT(*) AS c
FROM rp_it
WHERE repair_status = 4
  AND DATE(repair_time) = CURDATE();
 ";
                                    $querycall = $user->selectcall($call);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
<?php
}
?>