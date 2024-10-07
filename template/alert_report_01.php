<?php
// กรณีต้องการตรวจสอบการแจ้ง error ให้เปิด 3 บรรทัดล่างนี้ให้ทำงาน กรณีไม่ ให้ comment ปิดไป
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_reporting(0);
include_once '../config/dbconfig.php';
 
// กรณีมีการเชื่อมต่อกับฐานข้อมูล
//require_once("dbconnect.php");

// BACKBONE FOR ME
    //61tvf8CAAxDLHurVgAokk2i4TVQkGBWrJxE78zUhM9w

    // REPAIR IT
    //2YZIPiK2drNrKEAypcUnrthXIfoGFAJRrD24oUpLsmE

    //vJAbTXJIwZc0O3zX03L3EebXM1e9mu3z0vjwBc8h7S8
 
$accToken = "2YZIPiK2drNrKEAypcUnrthXIfoGFAJRrD24oUpLsmE";
$notifyURL = "https://notify-api.line.me/api/notify";
 
$headers = array(
    'Content-Type: application/x-www-form-urlencoded',
    'Authorization: Bearer '.$accToken
);
// $data = array(
//     'message' => "รายละเอียด : https://backbone.tkn.co.th/"
// );
$stmt = $DB_con->prepare("SELECT COUNT(*) AS c FROM `rp_it` WHERE DATE(repair_time) = CURRENT_DATE()");
$stmt->execute();
$AllJob = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $DB_con->prepare("SELECT COUNT(*) AS c FROM `rp_it` WHERE repair_status = '4' AND DATE(repair_time) = CURRENT_DATE()");
$stmt->execute();
$AllJob_Success = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $DB_con->prepare("SELECT COUNT(*) AS c FROM `rp_it` WHERE repair_status != '4' AND DATE(repair_time) = CURRENT_DATE()");
$stmt->execute();
$AllJob_Unsuccess = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $DB_con->prepare("SELECT COUNT(*) AS c FROM `stock_ink_out` WHERE DATE(stock_out_ink_time) = CURRENT_DATE()");
$stmt->execute();
$AllInkOut = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $DB_con->prepare("SELECT COUNT(*) AS c FROM `stock_ink_out` WHERE stock_out_ink_new = '0' AND DATE(stock_out_ink_time) = CURRENT_DATE()");
$stmt->execute();
$AllInkOut_s = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $DB_con->prepare("SELECT COUNT(*) AS c FROM `stock_ink_out` WHERE stock_out_ink_new = '1' AND DATE(stock_out_ink_time) = CURRENT_DATE()");
$stmt->execute();
$AllInkOut_us = $stmt->fetch(PDO::FETCH_ASSOC);

$data = array(
  'message' => '**'.@date(Y).'-'.@date(m).'-'.@date(d).'**
    1. จำนวนแจ้งซ่อมทั้งหมด '.$AllJob['c'].' รายการ
        - ซ่อมเสร็จ '.$AllJob_Success['c'].' รายการ
        - ยังไม่เสร็จ '.$AllJob_Unsuccess['c'].' รายการ
    2. การเบิกหมึกทั้งหมด '.$AllInkOut['c'].' รายการ
        - ส่งมอบแล้ว '.$AllInkOut_s['c'].' รายการ
        - ยังไม่ส่งมอบ '.$AllInkOut_us['c'].' รายการ' // ต้องส่งข้อความด้วยเสมอ ถ้าไม่มี ให้เว้นเป็นช่องว่าง
//   'imageThumbnail' => 'https://backbone.tkn.co.th/img/image.jpg',
//   'imageFullsize' => 'https://backbone.tkn.co.th/img/image.jpg',
);
 
// ส่วนของการส่งการแจ้งเตือนผ่านฟังก์ชั่น cURL
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, $notifyURL);
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0); // ถ้าเว็บเรามี ssl สามารถเปลี่ยนเป้น 2
curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0); // ถ้าเว็บเรามี ssl สามารถเปลี่ยนเป้น 1
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec( $ch );
curl_close( $ch );
 
// ตรวจสอบค่าข้อมูล ว่าเป็นตัวแปร ปรเภทไหน ข้อมูลอะไร
var_dump($result);
 
// การเช็คสถานะการทำงาน 
$result = json_decode($result,TRUE);
// ดูโครงสร้าง กรณีแปลงเป็น array แล้ว
//echo "<pre>";
//print_r($result);
 
// ตรวจสอบข้อมูล ใช้เป็นเงื่อนไขในการทำงาน
if(!is_null($result) && array_key_exists('status',$result)){
    if($result['status']==200){
        echo "Pass";
    }
}
?>