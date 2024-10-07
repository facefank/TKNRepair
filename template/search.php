<?php
	$q = $_GET["q"];
	// echo $q;
	// $a = $userRow['user_class'];

    $u = $_GET["u"];
    $n = $_GET["n"];
    if($n == "set_default"){
    	$updatenew = "UPDATE rp_it SET repair_new = 'NO' WHERE repair_new = 'YES' AND repair_id = :uid";
    	$querynew = $user->upnew($updatenew,$q);
    }
?>
<div class = "row flex-grow">
	<div class = "col-12 stretch-card">
		<div class = "card">
			<div class = "card-body">
                <div class="input-group">
                	<form method = "get" role = "search" class = "search-page">
                		<input type="hidden" name="p" id="p" value="search">
                    	<input type="text" class="form-control" name = "q" placeholder="ใส่หมายเลขแจ้งซ่อม" aria-label="Username" aria-describedby="colored-addon3">
    					<button type="submit" class = "btn-trans">
                            <i class="mdi mdi-fingerprint text-white"></i>
    					</button>
                	</form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mg-table">
  	<table width="100%" border="0" class="table table-bordered">
    	<thead>
		  	<tr style="color:#FFF; text-align:center; background:#303030;">
			    <td scope="col">รหัสส่งซ่อม/เคลม</td>
			    <td scope="col">วันที่</td>
			    <td scope="col">ชื่อผู้ส่งซ่อม/เคลม</td>
			    <td scope="col">เครื่องส่งซ่อม</td>
			    <td scope="col">สถานะ</td>
<?php
	if($a == "2"){
?>
			    <td scope="col">จัดการ</td>
<?php
	}else if($a == "1"){
?>
				<td scope="col">รายละเอียดการซ่อม</td>
<?php
	}else{
		echo "";
	}
?>
		  	</tr>
	  	</thead>
	  	<tbody style="background:#ff7709;">
<?php
        $searchall = "SELECT rp_it.*,card_type.* FROM rp_it,card_type WHERE card_id = repair_status AND repair_id = :urpid ORDER BY rp_it.repair_time DESC LIMIT 10";
        $querysearch = $user->selectsearch($searchall,$q,$a);  	
?>		    
	    </tbody>
	</table>
</div>