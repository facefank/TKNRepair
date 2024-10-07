<?php
	$subkey = substr($_GET["key"],0,8);
	$uname = $_GET["u"];
	$uacc = $_GET["acc"];
	$stock = $_GET["stock"];
	$desc = $_GET["desc"];
	$ran = $_GET["ran"]; 
	// ubuoGxRRogSMd3f7j0UYf4rGyvfDgx9STRdLVWPsM43
	//oqKtU3zjMDCRnN5pESjOAQjSYkIMkkcGBkAtNhTZVQL
	define('LINE_API', "https://notify-api.line.me/api/notify");
	$Token = "kqVDPGEV0Wp5FwpyZqBFW396EHmm4KAdXODC4KFxyH9";
	$currentDateTime = date('Y-m-d H:i:s'); // Format: YYYY-MM-DD HH:MM:SS
	if($stock == ""){
		$message = "วันที่และเวลา: " . $currentDateTime ."
		ชื่อผู้แจ้ง:  ".$uname." 
		แจ้งซ่อม:  ".$uacc."  
		รายละเอียด:  ".$desc." 
		ดูรายละเอียดเพิ่มเติมได้ที่: http://repairit.tkn.co.th";
	}else{
		$message = $stock;
	}
	// echo $message;

	line_notify($Token, $message);

	function line_notify($Token, $message){
        $lineapi = "kqVDPGEV0Wp5FwpyZqBFW396EHmm4KAdXODC4KFxyH9"; // ใส่ token key ที่ได้มา
		$mms =  trim($message); // ข้อความที่ต้องการส่ง
		date_default_timezone_set("Asia/Bangkok");
		$chOne = curl_init(); 
		curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
		curl_setopt($chOne, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
		// SSL USE 

		curl_setopt($chOne, CURLOPT_HEADER, 1);
		curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($chOne, CURLOPT_HTTPGET, 1);
		curl_setopt($chOne, CURLOPT_URL, 'https://notify-api.line.me/api/notify' );
		curl_setopt($chOne, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
		curl_setopt($chOne, CURLOPT_DNS_CACHE_TIMEOUT, 2 );

		var_dump(curl_exec($chOne));
		var_dump(curl_getinfo($chOne));
		var_dump(curl_error($chOne)); 
		
		curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
		curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
		//POST 
		curl_setopt( $chOne, CURLOPT_POST, 1); 
		curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms"); 
		curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
		$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', );
		curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, FALSE); 
		curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
		$result = curl_exec( $chOne ); 
		//Check error 
		if(curl_error($chOne)){ 
	           echo 'error:' . curl_error($chOne); 
	           header('Location:http://repairit.tkn.co.th/?s=fail');
		} 
		else{ 
		$result_ = json_decode($result, true); 
		   echo "status : ".$result_['status']; echo "message : ". $result_['message'];
		   header('Location:http://repairit.tkn.co.th/?s=success');
		//    header('Location:index?s=fail');
	    } 
		curl_close( $chOne );   
	}
?>