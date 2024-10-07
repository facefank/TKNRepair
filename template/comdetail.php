<?php
if ($a == "1") {
    $user->redirect('../index');
}
// Define arrays of Windows versions and CPU types to count
$windows_versions = ['Windows 11', 'Windows 10', 'Windows 8.1', 'Windows 8', 'Windows 7', 'Windows XP',  'Windows Vista', 'Windows Server 2012', 'other'];
$cpu_types = ['Intel Core i9', 'Intel Core i7', 'Intel Core i5', 'Intel Core i3', 'ต่ำกว่า I3', 'AMD Ryzen 9', 'amd Ryzen 7', 'amd Ryzen 5', 'amd Ryzen 3', 'ต่ำกว่า Ryzen 3', 'other'];
$ram_sizes = ['1GB', '2GB', '4GB', '8GB', '12GB', '16GB', '32GB', 'other'];
$computer_types = ['PC', 'Laptop', 'Allinone', 'other'];
// Generate SQL query dynamically for Windows versions
$case_statements = [];
foreach ($windows_versions as $version) {
    $case_statements[] = "COUNT(CASE WHEN e.eq_os = '$version' THEN 1 END) AS `" . str_replace(' ', '_', strtolower($version)) . "_count`";
}

// Generate SQL query dynamically for CPU types
$cpu_case_statements = [];
foreach ($cpu_types as $cpu) {
    $cpu_case_statements[] = "COUNT(CASE WHEN e.eq_cpu = '$cpu' THEN 1 END) AS `" . str_replace(' ', '_', strtolower($cpu)) . "_count`";
}

$ram_case_statements = [];
foreach ($ram_sizes as $size) {
    $ram_case_statements[] = "COUNT(CASE WHEN e.eq_ram = '$size' THEN 1 END) AS " . str_replace(' ', '_', strtolower($size)) . "_count";
}
$computer_case_statements = [];
foreach ($computer_types as $type) {
    $computer_case_statements[] = "COUNT(CASE WHEN e.eq_type = '$type' THEN 1 END) AS `" . str_replace(' ', '_', strtolower($type)) . "_count`";
}
// Combine SQL query parts
$query_all_branches = "
    SELECT d.branch_name, 
           " . implode(', ', $case_statements) . ",
           " . implode(', ', $cpu_case_statements) . ",
           " . implode(', ', $ram_case_statements) . ",
           " . implode(', ', $computer_case_statements) . ",
           COUNT(e.equip_id) AS count_in_use
    FROM branch d
    LEFT JOIN equip e ON d.branch_id = e.branch_id AND e.eq_status = 'ใช้งาน'
    GROUP BY d.branch_name
    ORDER BY count_in_use DESC
";

try {
    $stmt_all_branches = $DB_con->prepare($query_all_branches);
    $stmt_all_branches->execute();
    $branches = $stmt_all_branches->fetchAll(PDO::FETCH_ASSOC);

    // Calculate the total count of equipment in use
    $total_count = array_sum(array_column($branches, 'count_in_use'));
} catch (PDOException $e) {
    // Log the error message in a file or monitoring system
    error_log($e->getMessage(), 3, '/path/to/error.log');
    $branches = []; // Set branches to empty array if there's an error
    $total_count = 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Equipment Status</title>
    <link rel="stylesheet" href="../css/detailcom.css">

    <style>
        .highlight {
            animation: colorToggle 1s infinite;
        }

        @keyframes colorToggle {
            0% {
                color: red;
            }

            50% {
                color: green;
            }

            100% {
                color: red;
            }
        }

        .card-statistics {
            border: 2px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #f7f7f7, #e0e0e0);
            /* สีไล่ระดับ */
            overflow: hidden;
            
        }


        .card-body {
            padding: 20px;
            position: relative;
        }

        .branch-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* border-bottom: 2px solid #f1f1f1; */
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .branch-info h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .branch-info .branch-name {
            font-weight: bold;
        }

        .branch-info .branch-count {
            font-size: 24px;
            color: #009688;
            font-weight: bold;
        }

        .card-details {
            display: none;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 12px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-height: 400px;
            overflow-y: auto;
        }

        .card-details h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #009688;
            background-color: #f1f8f4;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-details p {
            margin: 10px 0;
            font-size: 15px;
            color: #555;
            line-height: 1.6;
        }

        .branch-count1 {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 70px;
            /* Adjust width as needed */
            height: 70px;
            /* Adjust height as needed */

            border: 8px solid #4caf50;
            /* Darker green color for the border */
            border-radius: 40%;
            /* Makes the container a circle */
            text-align: center;
            line-height: 90px;
            /* Adjust to ensure the text is centered vertically */
            font-size: 2em;
            /* Adjust font size as needed */
            color: #333;
            /* Text color */

            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Computer <span style="color: green;">ใช้งาน</span>ทั้งหมด: <span id="total-count" class="highlight"><?php echo htmlspecialchars($total_count); ?></span> เครื่อง</h2>
        <br>
        <div class="row">
            <?php foreach ($branches as $index => $branch): ?>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                    <div class="card card-statistics" id="card-<?php echo $index; ?>">
                        <div class="card-body">
                            <div class="branch-info">
                                <div class="branch-name">
                                    <h1 style="font-size: 35px;"> <?php echo htmlspecialchars($branch['branch_name']); ?></h1>
                                </div>
                                <div class="branch-count1">
                                    <h1><?php echo htmlspecialchars($branch['count_in_use']); ?></h1>
                                </div>
                            </div>
                            <div class="fluid-container">
                                <!-- Details section with headers for each category -->
                                <div class="card-details" id="details-<?php echo $index; ?>">
                                    <?php if (array_filter($branch, fn($value, $key) => strpos($key, '_count') !== false, ARRAY_FILTER_USE_BOTH)): ?>
                                        <h3>Windows Versions</h3>
                                        <?php foreach ($windows_versions as $version): ?>
                                            <?php $version_key = str_replace(' ', '_', strtolower($version)) . '_count'; ?>
                                            <?php if ($branch[$version_key] > 0): ?>
                                                <p style="margin-left: 5px;"><?php echo htmlspecialchars($version); ?>: <?php echo htmlspecialchars($branch[$version_key]); ?> เครื่อง</p>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <br>
                                        <h3>CPU Types</h3>
                                        <?php foreach ($cpu_types as $cpu): ?>
                                            <?php $cpu_key = str_replace(' ', '_', strtolower($cpu)) . '_count'; ?>
                                            <?php if ($branch[$cpu_key] > 0): ?>
                                                <p style="margin-left: 5px;"><?php echo htmlspecialchars($cpu); ?>: <?php echo htmlspecialchars($branch[$cpu_key]); ?> เครื่อง</p>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <br>
                                        <h3>RAM Sizes</h3>
                                        <?php foreach ($ram_sizes as $size): ?>
                                            <?php $ram_key = str_replace(' ', '_', strtolower($size)) . '_count'; ?>
                                            <?php if ($branch[$ram_key] > 0): ?>
                                                <p style="margin-left: 5px;"><?php echo htmlspecialchars($size); ?>: <?php echo htmlspecialchars($branch[$ram_key]); ?> เครื่อง</p>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <br>
                                        <h3>Computer Types</h3>
                                        <?php foreach ($computer_types as $type): ?>
                                            <?php $type_key = str_replace(' ', '_', strtolower($type)) . '_count'; ?>
                                            <?php if ($branch[$type_key] > 0): ?>
                                                <p style="margin-left: 5px;"><?php echo htmlspecialchars($type); ?>: <?php echo htmlspecialchars($branch[$type_key]); ?> เครื่อง</p>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>No detailed data available.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
                &nbsp;&nbsp;&nbsp;
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        // Add event listeners to each card
        document.querySelectorAll('.card-statistics').forEach((card, index) => {
            card.addEventListener('click', () => {
                const details = document.getElementById(`details-${index}`);
                if (details.style.display === 'none' || details.style.display === '') {
                    details.style.display = 'block';
                    card.parentElement.classList.add('col-xl-12', 'col-lg-12', 'col-md-12', 'col-sm-12');
                } else {
                    details.style.display = 'none';
                    card.parentElement.classList.remove('col-xl-12', 'col-lg-12', 'col-md-12', 'col-sm-12');
                }
            });
        });
    </script>
</body>

</html>






<?php
$q = @$_GET["q"];
// echo $q;
$a = $userRow['user_class'];

$u = $userRow['user_name'];


if (isset($_POST["btnsave_eqc"])) {


    // $name = $_POST["txtname"];
    // $serial = $_POST["txtserial"];
    // $branch = $_POST["txtbranch"];
    // $dept = $_POST["txtdept"];
    // $comname = $_POST["txtcomname"];
    // $spec = $_POST["txtspec"];
    // $war = $_POST["txtwar"];
    // $dbuy = $_POST["txtbuy"];
    // $buy = substr($_POST["txtbuy"],6,4);
    // $ybuy = @date("Y") - $buy;

    //////////////////////////////////////////////////////////////////////////////////
    $branch = $_POST["addtxtbranch_eq"];
    $dept = $_POST["addtxtdept"];
    $namecom = $_POST["addtxtcomname"];
    $nameuser = $_POST["addtxtname"];
    $model = $_POST["addmodel"];
    $serielno = $_POST["addserielno"];
    $type = $_POST["addtype"];
    $cpu = $_POST["addcpu"];
    $gen = $_POST["addGEN"];
    $ram = $_POST["addram"];
    $ssd = $_POST["addssd"];
    $hdd = $_POST["addhdd"];
    $os = $_POST["addos"];
    $office = $_POST["addoffice"];
    $antivirus = $_POST["addantivirus"];
    $ostype = $_POST["addostype"];
    $ip = $_POST["addip"];
    $usb = $_POST["addusb"];
    $macaddress = $_POST["addmacaddress"];
    // $status = $_POST["status"];
    $place = $_POST["addplace"];
    $historyplace = $_POST["addhistoryplace"];
    $historyrepair = $_POST["addhistoryrepair"];
    $txtspec = $_POST["addtxtspec"];
    $txtwar_eq = $_POST["addtxtwar_eq"];
    $txtbuy = $_POST["addtxtbuy"];
    $updatetime = date('Y-m-d H:i');





    if ($stmt->execute()) {
        $successMSG = "NEW record succesfully inserted ...";
        header('Location:' . $actual_link . '&st=success');
    } else {
        $errMSG = "error while inserting ...";
        header('Location:' . $actual_link . '&st=fail');
    }
}


if (@$_GET["eqc_id"] != "") {
	$sql = "UPDATE equip SET status_eq = '1'  
            WHERE equip_id = :eqc_id";
	$stmt = $DB_con->prepare($sql);
	$stmt->bindParam(':eqc_id', $_GET["eqc_id"], PDO::PARAM_STR);
	$stmt->execute();
}


?>

<div class="mg-table">

    <table id="example" class="table table-striped table-bordered table-responsive " style="width:100%">
        <thead>
            <tr style="color:#FFF; text-align:center; background:#303030;">
                <td scope="col">#</td>
                <td scope="col">ชื่อผู้ใช้</td>
                <td scope="col">ชื่อเครื่อง</td>
                <td scope="col">แผนก</td>
                <td scope="col">สาขา</td>
                <td scope="col">IP</td>
                <td scope="col">Model</td>
                <td scope="col">Type</td>
                <td scope="col">CPU</td>
                <td scope="col">CPU Gen</td>
                <td scope="col">RAM</td>
                <td scope="col">SSD</td>
                <td scope="col">HDD</td>
                <td scope="col">OS</td>
                <!-- <td scope="col">OS Type</td> -->
                <!-- <td scope="col">Office</td>
                <td scope="col">Antivirus</td>
                <td scope="col">USB</td>
                <td scope="col">MAC Address</td> -->
                <td scope="col">สถานะ</td>
                <td scope="col">สถานที่ตั้ง</td>
                <!-- <td scope="col">ประวัติการใช้งาน</td>
                <td scope="col">ประวัตการซ่อม</td> -->
                <td scope="col">วันที่อัพเดทข้อมูล</td>
                <!-- <td scope="col">รายละเอียดโปรแกรมและอื่น ๆ</td> -->
                <td scope="col">วันที่ประกัน</td>
                <td scope="col">วันที่ซื้อ</td>
                <!-- <td scope="col">อายุการใช้งาน</td> -->

                <!-- <td scope="col">S/N</td> -->
            </tr>
        </thead>
        <tbody>
            <?php
            $spu = $userRow['user_superclass'];
            $selecteqc = "SELECT * FROM equip
          JOIN dept ON equip.dept_id = dept.dept_id
          JOIN branch ON equip.branch_id = branch.branch_id
          WHERE equip.eq_status = 'ใช้งาน'";

            $queryselecteqc = $user->seeho($selecteqc, $spu);
            ?>
        </tbody>

    </table>
    
    <?php

    ?>
</div>