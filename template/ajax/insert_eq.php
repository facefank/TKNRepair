<?php 
    date_default_timezone_set("Asia/Bangkok"); 
    $connect = mysqli_connect("localhost", "root", "", "tkncoth_repair");   
    if(!empty($_POST)){  
        $output = '';  
        $message = '';  

        $acc = mysqli_real_escape_string($connect, $_POST["txtacc"]);
        $branch = mysqli_real_escape_string($connect, $_POST["txtbranch"]);
        $series = mysqli_real_escape_string($connect, $_POST["txtseries"]);
        $serial = mysqli_real_escape_string($connect, $_POST["txtserial"]); 
        $price = mysqli_real_escape_string($connect, $_POST["txtprice"]);
        $war = mysqli_real_escape_string($connect, $_POST["txtwar"]);
        $install = mysqli_real_escape_string($connect, $_POST["txtinstall"]);
        $user = mysqli_real_escape_string($connect, $_POST["txtuser"]);
        $dbuy = mysqli_real_escape_string($connect, $_POST["txtdbuy"]); 
        $wb = mysqli_real_escape_string($connect, $_POST["txtwb"]);
        $accstatus = mysqli_real_escape_string($connect, $_POST["txtaccstatus"]);


        // $name = mysqli_real_escape_string($connect, $_POST["txtname"]);
        // $branch_eq = mysqli_real_escape_string($connect, $_POST["txtbranch_eq"]);
        // $dept = mysqli_real_escape_string($connect, $_POST["txtdept"]);
        // $comname = mysqli_real_escape_string($connect, $_POST["txtcomname"]); 



        $serielno = mysqli_real_escape_string($connect, $_POST["serielno"]);
        $name = mysqli_real_escape_string($connect, $_POST["txtname"]);
        $dept = mysqli_real_escape_string($connect, $_POST["txtdept"]);
        $comname = mysqli_real_escape_string($connect, $_POST["txtcomname"]); 
        $branch_eq = mysqli_real_escape_string($connect, $_POST["txtbranch_eq"]);
        
        $model = mysqli_real_escape_string($connect, $_POST["model"]);
        
        $type = mysqli_real_escape_string($connect, $_POST["type"]);
        $cpu = mysqli_real_escape_string($connect, $_POST["cpu"]);
        $GEN = mysqli_real_escape_string($connect, $_POST["GEN"]);
        $ram = mysqli_real_escape_string($connect, $_POST["ram"]);
        $ssd = mysqli_real_escape_string($connect, $_POST["ssd"]);
        $hdd = mysqli_real_escape_string($connect, $_POST["hdd"]);
        $os = mysqli_real_escape_string($connect, $_POST["os"]);
        $office = mysqli_real_escape_string($connect, $_POST["office"]);
        $antivirus = mysqli_real_escape_string($connect, $_POST["antivirus"]);
        $ostype = mysqli_real_escape_string($connect, $_POST["ostype"]);
        $ip = mysqli_real_escape_string($connect, $_POST["ip"]);
        $usb = mysqli_real_escape_string($connect, $_POST["usb"]);
        $macaddress = mysqli_real_escape_string($connect, $_POST["macaddress"]);
        $status = mysqli_real_escape_string($connect, $_POST["status"]);
        $place = mysqli_real_escape_string($connect, $_POST["place"]);

        $historyplace = mysqli_real_escape_string($connect, $_POST["historyplace"]);
        $historyrepair = mysqli_real_escape_string($connect, $_POST["historyrepair"]);
        $updatetime = date('Y-m-d H:i');


        $spec = mysqli_real_escape_string($connect, $_POST["txtspec"]);
        $war_eq = mysqli_real_escape_string($connect, $_POST["txtwar_eq"]);
        $buy = mysqli_real_escape_string($connect, $_POST["txtbuy"]);
        /////////// 
        if($_POST["eq_id"] != ''){  
            $query = "  
            UPDATE equip_etc SET 	
            acc_id = '$acc',
            eq_series = '$series',
            branch_id = '$branch',
            eq_serial = '$serial',
            eq_price = '$price',
            eq_warranty = '$war',
            eq_install = '$install',
            eq_user = '$user',
            eq_wb = '$wb',
            eq_buy = '$dbuy',
            status = '$accstatus'    
            WHERE eq_id = '".$_POST["eq_id"]."'";  
            $message = 'Data Updated'; 
            // header("Refresh:0"); 
        }else if($_POST["eq_id"] == ''){ 
            $query = "  
            INSERT INTO equip_etc(acc_id)  
            VALUES('0');  
            ";  
            $message = 'Data Inserted';   
        }if(mysqli_query($connect, $query)){  
            header('Location: '.$_SERVER['REQUEST_URI']);
            echo $message;  
        }  



        if($_POST["equip_id"] != ''){            
            $query2 = "
            UPDATE equip SET
            serial_num = '$serielno',
            name_user = '$name', 
            dept_id = '$dept', 
            branch_id = '$branch_eq', 
            name_com = '$comname',
            eq_model = '$model',
            eq_type = '$type',
            eq_cpu = '$cpu',
            eq_cpugen = '$GEN',
            eq_ram = '$ram',
            eq_ssd = '$ssd',
            eq_hdd = '$hdd',
            eq_os = '$os',
            eq_office = '$office',
            eq_antivirus = '$antivirus',
            eq_ostype = '$ostype',
            eq_ip = '$ip',
            eq_usb = '$usb',
            eq_macaddress = '$macaddress',
            eq_status = '$status',
            eq_place = '$place',

            eq_historyplace = '$historyplace',
            eq_historyrepair = '$historyrepair',
            eq_updatetime = '$updatetime',

            spec = '$spec', 
            warranty = '$war_eq', 
            day_buy = '$buy'
            WHERE equip_id = '".$_POST["equip_id"]."' ";
            $message2 = 'Status Update';
        }else if($_POST["equip_id"] == ''){
            $query2 = "  
            INSERT INTO equip(usercom)  
            VALUES('0');  
            ";  
            $message2 = 'Data Inserted';  
        }if(mysqli_query($connect, $query2)){  
            header('Location: '.$_SERVER['REQUEST_URI']);
            echo $message;  
        } 
        echo $message;
    }  
?>