<?php
    // SELECT count(*) as d,repair_name as a,repair_acc as b FROM rp_it WHERE repair_time >= CURDATE()
?>
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style=" box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" >
        <a class="navbar-brand brand-logo" href="../index.php">
            <img src="../images/logo.png" alt="logo" style = "height:100%;width: 100% !important;"/>
        </a>
        <a class="navbar-brand brand-logo-mini" href="../index.php">
            <img src="../images/logo-mini.svg" alt="logo" />
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
            <li class="nav-item">
                <a href="?p=report" class="nav-link">
                <i class="mdi mdi-elevation-rise"></i>Reports</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
<?php
    $selectupdatecounth = "SELECT count(*) as c FROM rp_it WHERE repair_time >= CURDATE() AND repair_new = 'YES'";
    $queryupdatecounth = $user->selectupcounth($selectupdatecounth);

    $selectupdate = "SELECT x.countt, repair_id, repair_name, repair_acc FROM rp_it, (select count(*) as countt FROM rp_it WHERE repair_time >= CURDATE()) as x WHERE repair_time >= CURDATE() AND repair_new = 'YES'";
    $queryupdate = $user->selectup($selectupdate);
?>
                </div>
<?php
    $selectupdatecount = "SELECT count(*) as c FROM rp_it WHERE repair_time >= CURDATE() AND repair_new = 'YES'";
    $queryupdatecount = $user->selectupcount($selectupdatecount);
    function TimeDiff($strTime1,$strTime2){
                return (@strtotime($strTime2) - @strtotime($strTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
    }
    // if(TimeDiff("00:00","00:20") <= 10){
    //     echo "เมื่อไม่กี่นาทีที่ผ่านมา";
    // }else if(TimeDiff("00:00","00:20") > 10){
    //     echo "1 ชั่วโมงที่ผ่านมา";
    // }
     // echo "Time Diff = ".@TimeDiff("00:00","00:20")."<br>";
    
?>                
            </li>
            <li class="nav-item dropdown">
            
<?php
    $notistock = "SELECT count(*) as c FROM stock_ink_out WHERE stock_out_ink_time >= CURDATE() AND stock_out_ink_new = '1'";
    $querynotistock = $user->selectnotistock($notistock);
?>
              
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
<?php
    $selectupdatestock = "SELECT count(*) as c FROM stock_ink_out WHERE stock_out_ink_time >= CURDATE() AND stock_out_ink_new = '1'";
    $queryupdatestock = $user->selectupstock($selectupdatestock);
?>                
              </a>
<?php
    $selectustock = "SELECT x.countt, stock_ioid, stock_out_ink_name, stock_out_ink_dept,stock_inkid,stock_ink_series FROM stock_ink_out,stock_ink, (select count(*) as countt FROM stock_ink_out WHERE stock_out_ink_time >= CURDATE()) as x WHERE 1 AND stock_ink.stock_inkid = stock_ink_out.stock_out_ink_dept AND stock_out_ink_time >= CURDATE() AND stock_out_ink_new = '1'";
    $queryustock = $user->selectupstockout($selectustock);
?>
            </div>
          </li>
            <li class="nav-item dropdown d-none d-xl-inline-block">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <span class="profile-text"><?php echo $userRow["user_name"] ?></span>
                    <img class="img-xs rounded-circle" src="../images/faces-clipart/pic-4.png" alt="Profile image">
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <a class="dropdown-item p-0">
                        <div class="d-flex border-bottom">
                            <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                            </div>
                            <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                                <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                            </div>
                            <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                            </div>
                        </div>
                    </a>
                    <a href = "logout" class="dropdown-item">Sign Out</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>