<?php
	if($a == "1"){
		$user->redirect('../index');
	}
	$key = $_GET["key"];
	// echo $key;
	//SELECT count(*) as cnt, sum(repair_acc = 'สายพ่วง') as c1,sum(repair_acc = 'เมาส์') as c2 FROM (SELECT 'สายพ่วง' as repair_acc UNION ALL SELECT 'เมาส์' UNION ALL SELECT 'สายพ่วง') AS tmp

	// select repair_acc,count(repair_acc) as no_of_attempts from rp_it group by repair_acc
	// select count(repair_acc) as no_of_attempts, acc_name as no_of from rp_it,acc WHERE repair_acc = acc_name group by repair_acc
	$allsee = "SELECT * FROM rp_it WHERE repair_id = :ukey";
	$queryallsee = $user->selectallsee($allsee,$key);
?>