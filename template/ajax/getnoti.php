<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tkncoth_repair";

    $cona = new mysqli($servername,$username,$password,$dbname);
    if($cona->connect_error){
        die("Connection failed : ".$cona->connect_error);
    }
    $sql = "SELECT repair_id,repair_acc FROM rp_it WHERE repair_new = 'YES'";
    $result = $cona->query($sql);

    $resultStr = "[";

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $resultStr .= "{\"id\":".$row["repair_id"].",\"value\":\"".$row["repair_acc"]."\"},";
        }
        $resultStr = substr($resultStr,0,strlen($resultStr)-1)."]";
        echo $resultStr;
    }else{
        echo "0 result";
    }
?>