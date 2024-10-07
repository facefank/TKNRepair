<?php  
    $connect = mysqli_connect("localhost", "root", "", "tkncoth_repair");   
    if(!empty($_POST)){  
        $output = '';  
        $message = '';  
        $name = mysqli_real_escape_string($connect, $_POST["txtnames"]);
        $brand = mysqli_real_escape_string($connect, $_POST["txtbrand"]);
        $series = mysqli_real_escape_string($connect, $_POST["txtseriess"]);
        $income = mysqli_real_escape_string($connect, $_POST["txtincome"]); 
        $desc_st = mysqli_real_escape_string($connect, $_POST["txtdesc_st"]);


        $nameink = mysqli_real_escape_string($connect, $_POST["txtnamesink"]);
        $seriesink = mysqli_real_escape_string($connect, $_POST["txtseriesink"]);
        $inkcount = mysqli_real_escape_string($connect, $_POST["txtinkcount"]);

        /////////// 
        if($_POST["stock_id"] != ''){  
            $query = "  
            UPDATE stock_acc SET 	
            stock_name = '$name',
            stock_brand = '$brand',
            stock_series = '$series',
            stock_desc = '$desc_st',
            stock_income = stock_income + '$income'  
            WHERE stock_id = '".$_POST["stock_id"]."'";  
            $message = 'Data Updated'; 
            // header("Refresh:0"); 
            $query2 = "
            INSERT INTO stock_acc_income(stock_id,stock_name,stock_brand,stock_series,stock_desc,stock_newincome)  
            VALUES('".$_POST["stock_id"]."','".$name."','".$brand."','".$series."','".$desc_st."','".$income."');
            ";
        }else if($_POST["stock_id"] == '' && $_POST["stock_inkid"] == ''){ 
            $query = "  
            INSERT INTO stock_acc(stock_id)  
            VALUES('0');  
            ";  
            $message = 'Data Inserted';   
        }if(mysqli_query($connect, $query)){  
            header('Location: '.$_SERVER['REQUEST_URI']);
            echo $message;  
        }  
        if(mysqli_query($connect, $query2)){  
            header('Location: '.$_SERVER['REQUEST_URI']);
            echo $message;  
        } 


        if($_POST["stock_inkid"] != ''){  
            $query3 = "  
            UPDATE stock_ink SET 	
            stock_inktype = '$nameink',
            stock_ink_series = '$seriesink',
            stock_ink_income = stock_ink_income + '$inkcount'  
            WHERE stock_inkid = '".$_POST["stock_inkid"]."'";  
            $message3 = 'Data Updated'; 
            // header("Refresh:0"); 
            $query4 = "
            INSERT INTO stock_ink_income(stock_inkid,stock_inktype,stock_ink_series,stock_ink_income)  
            VALUES('".$_POST["stock_inkid"]."','".$nameink."','".$seriesink."','".$inkcount."');
            ";
        }else if($_POST["stock_inkid"] == '' && $_POST["stock_id"] == ''){ 
            $query3 = "  
            INSERT INTO stock_ink_income(stock_inkid)  
            VALUES('0');  
            ";  
            $message3 = 'Data Inserted';   
        }if(mysqli_query($connect, $query3)){  
            header('Location: '.$_SERVER['REQUEST_URI']);
            echo $message3;  
        }  
        if(mysqli_query($connect, $query4)){  
            header('Location: '.$_SERVER['REQUEST_URI']);
            echo $message;  
        } 
        echo $message;
    }  
?>