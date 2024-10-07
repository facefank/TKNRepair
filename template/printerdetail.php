<?php

if ($a == "1") {
    $user->redirect('../index');
}
include_once '../config/dbconfig.php';
// Define arrays of Windows versions and CPU types to count
$printer_series = ['Epson L1300',
'Brother HL-1110',
'Brother HL-2360DN',
'BROTHER FAX-2840',
'Brother HL-1210W',
'Brother HL-22400',
'Brother HL-L2360DN',
'Brother MFC-7360',
'Brother MFC-1815',
'Epson L3110',
'Epson L120',
'Epson L200',
'Epson L220',
'Epson L310',
'Epson L3150',
'Epson L3210',
'Epson L3250',
'Epson L360',
'Epson L405',
'Epson L565',
'Epson LQ-300',
'Epson LQ-310',
'Epson TM-T82',
'HITI CS-200e',
'HP 415',
'HP Laser MFP 137fnw',
'HP LaserJet P1102',
'OKI 391',
'Oki Microline 391 TURBO',
'Oki Microline 791 Plus'];

// Generate SQL query dynamically for Windows versions
$series_statements = [];
foreach ($printer_series as $version) {
    $series_statements[] = "COUNT(CASE WHEN e.eq_series = '$version' THEN 1 END) AS `" . str_replace(' ', '_', strtolower($version)) . "_count`";
}

// Combine SQL query parts
$query_all_branches = "
    SELECT d.branch_name, 
       " . implode(', ', $series_statements) . ",
       COUNT(e.eq_id) AS count_in_use
FROM branch d
LEFT JOIN equip_etc e ON d.branch_id = e.branch_id 
                        AND e.status = 'ใช้งาน'
                        AND e.acc_id = 7
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
        <h2>Printer<span style="color: green;">ใช้งาน</span>ทั้งหมด: <span id="total-count" class="highlight"><?php echo htmlspecialchars($total_count); ?></span> เครื่อง</h2>
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
                                        <h3>Printer Series</h3>
                                        <?php foreach ($printer_series as $version): ?>
                                            <?php $version_key = str_replace(' ', '_', strtolower($version)) . '_count'; ?>
                                            <?php if ($branch[$version_key] > 0): ?>
                                                <p style="margin-left: 5px;"><?php echo htmlspecialchars($version); ?>: <?php echo htmlspecialchars($branch[$version_key]); ?> เครื่อง</p>
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

if (isset($_POST["btnsave_eqe"])) {
	$acc = $_POST["txtacc"];
	$series = $_POST["txtseries"];
	$branch_eqe = $_POST["txtbranch"];
	$serial = $_POST["txtserial"];
	$price = $_POST["txtprice"];
	$war = $_POST["txtwar"];
	$install = $_POST["txtinstall"];
	$user = $_POST["txtuser"];
	$wb = $_POST["txtwb"];
	$dbuy = $_POST["txtdbuy"];
	$statusacc = $_POST["txtaccstatus"];
	// $buy = substr($_POST["txtdbuy"],6,4);
	// $ybuy = @date("Y") - $buy;

	$stmt = $DB_con->prepare("INSERT INTO equip_etc(acc_id,eq_series,branch_id,eq_serial,eq_price,eq_warranty,eq_install,eq_user,eq_wb,eq_buy,status) 
		VALUES (:acc_id,:eq_series,:eq_branch,:eq_serial,:eq_price,:eq_warranty,:eq_install,:eq_user,:eq_wb,:eq_buy,:status)");
	$stmt->bindParam(':acc_id', $acc);
	$stmt->bindParam(':eq_series', $series);
	$stmt->bindParam(':eq_branch', $branch_eqe);
	$stmt->bindParam(':eq_serial', $serial);
	$stmt->bindParam(':eq_price', $price);
	$stmt->bindParam(':eq_warranty', $war);
	$stmt->bindParam(':eq_install', $install);
	$stmt->bindParam(':eq_user', $user);
	$stmt->bindParam(':eq_wb', $wb);
	$stmt->bindParam(':eq_buy', $dbuy);
	$stmt->bindParam(':status', $statusacc);
	// $stmt->bindParam(':eq_age',$ybuy);

	if ($stmt->execute()) {
		$successMSG = "NEW record succesfully inserted ...";
		header('Location:' . $actual_link . '&st=success');
	} else {
		$errMSG = "error while inserting ...";
		header('Location:' . $actual_link . '&st=fail');
	}
}


if (@$_GET["eqe_id"] != "") {
	$sql = "UPDATE equip_etc SET status = '1'  
            WHERE eq_id = :eqe_id";
	$stmt = $DB_con->prepare($sql);
	$stmt->bindParam(':eqe_id', $_GET["eqe_id"], PDO::PARAM_STR);
	$stmt->execute();
}


?>

<div class="mg-table">

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr style="color:#FFF; text-align:center; background:#303030;">
                <td scope="col">#</td>
                <td scope="col">อุปกรณ์</td>
                <td scope="col">รุ่น</td>
                <td scope="col">สาขา</td>
                <td scope="col">ซีเรียล</td>
                <td scope="col">สถานะ</td>
                <td scope="col">ราคา</td>
                <td scope="col">วันที่ประกัน</td>
                <td scope="col">ติดตั้ง</td>
                <td scope="col">ผู้ใช้</td>
                <td scope="col">สถานที่ซื้อ</td>
                <td scope="col">วันที่ซื้อ</td>
                <td scope="col">อายุการใช้งาน</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $spu = $userRow['user_superclass'];
            $selecteqc = "SELECT * FROM equip_etc JOIN acc ON equip_etc.acc_id = acc.acc_id JOIN branch ON equip_etc.branch_id = branch.branch_id WHERE equip_etc.acc_id = 7 AND equip_etc.status = 'ใช้งาน';

";


            $queryselecteqc = $user->seeprint($selecteqc, $spu);
            ?>


        </tbody>
    </table>
    <?php

    ?>
</div>