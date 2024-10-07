<?php  
    $connect = mysqli_connect("localhost", "root", "", "tkncoth_repair");   
    if(!empty($_POST)){  
        $output = '';  
        $message = '';  
        $name = mysqli_real_escape_string($connect, $_POST["name"]);
        $comment = mysqli_real_escape_string($connect, $_POST["txt_comment"]);
        $statuss = mysqli_real_escape_string($connect, $_POST["txt_tus"]);
        $repair_itemp = mysqli_real_escape_string($connect, $_POST["repair_itemp"]);
        $color = mysqli_real_escape_string($connect, $_POST["txt_color"]); 

        /////////// 
        if($_POST["employee_id"] != ''){  
            $query = "  
            UPDATE rp_it SET 
            repair_status = '$name',
            repair_comment = '$comment',
            repair_itemp = '$repair_itemp'
            WHERE repair_id = '".$_POST["employee_id"]."'";  
            $message = 'Data Updated'; 
            // header("Refresh:0"); 
        }else if($_POST["employee_id"] == ''){ 
            $query = "  
            INSERT INTO rp_it(repair_status)  
            VALUES('0');  
            ";  
            $message = 'Data Inserted';   
        }if(mysqli_query($connect, $query)){  
            header('Location: '.$_SERVER['REQUEST_URI']);
            echo $message;  
        }  
        if($_POST["status_id"] != ''){            
            $query2 = "
            UPDATE card_type SET 
            card_name = '$statuss', 
            card_color = '$color'
            WHERE card_id = '".$_POST["status_id"]."' ";
            $message2 = 'Status Update';
        }else if($_POST["status_id"] == '' AND $statuss != ''){
            $query2 = "  
            INSERT INTO card_type(card_name,card_color)  
            VALUES('$statuss','$color');  
            ";  
            $message2 = 'Data Inserted';  
        }if(mysqli_query($connect, $query2)){  
            header('Location: '.$_SERVER['REQUEST_URI']);
            echo $message;  
        } 
        echo $message;
    }  
?>