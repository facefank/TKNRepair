<?php
include_once '../template/update_charts.php';

// Check if user needs to be redirected
if ($a == "1") {
    $user->redirect('../index');
}

// Initialize arrays for chart data
$labels = [];
$datasets = [
    'label' => 'จำนวนการแจ้งซ่อม',
    'data' => [],
    'backgroundColor' => [], // Initialize as an empty array
    'borderColor' => 'rgba(0, 0, 0, 0.5)', // Optional, set a border color
    'borderWidth' => 1
];

// Array of colors for each bar
$colors = [
    'rgba(0, 102, 204, 0.8)', // Dark Blue
    'rgba(0, 153, 76, 0.8)',  // Dark Green
    'rgba(255, 204, 102, 0.8)', // Light Gold
    'rgba(102, 102, 102, 0.8)', // Dark Gray
    'rgba(102, 51, 153, 0.8)',  // Dark Purple
    'rgba(204, 102, 0, 0.8)',   // Dark Orange
    'rgba(0, 102, 204, 0.8)',   // Dark Blue
    'rgba(0, 153, 76, 0.8)',    // Dark Green
    'rgba(255, 204, 102, 0.8)', // Light Gold
    'rgba(102, 102, 102, 0.8)', // Dark Gray
    'rgba(102, 51, 153, 0.8)',  // Dark Purple
    'rgba(204, 102, 0, 0.8)',   // Dark Orange
    'rgba(0, 102, 204, 0.8)',   // Dark Blue
    'rgba(0, 153, 76, 0.8)'     // Dark Green
];

// Thai month names array
$thaiMonths = [
    '01' => 'มกราคม',
    '02' => 'กุมภาพันธ์',
    '03' => 'มีนาคม',
    '04' => 'เมษายน',
    '05' => 'พฤษภาคม',
    '06' => 'มิถุนายน',
    '07' => 'กรกฎาคม',
    '08' => 'สิงหาคม',
    '09' => 'กันยายน',
    '10' => 'ตุลาคม',
    '11' => 'พฤศจิกายน',
    '12' => 'ธันวาคม',
];

// Retrieve the selected year and month from GET parameters
$selectedYear = isset($_GET['year']) ? $_GET['year'] : date('Y');
$selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('m');

// Define SQL queries for summary and details
$summaryQuery = "
    SELECT 
        DATE_FORMAT(repair_time, '%m') AS month_num,
        DATE_FORMAT(repair_time, '%Y') AS year,
        repair_dept, 
        COUNT(*) AS total_repairs
    FROM 
        rp_it
    WHERE 
        DATE_FORMAT(repair_time, '%Y') = '$selectedYear' " . ($selectedMonth ? "AND DATE_FORMAT(repair_time, '%m') = '$selectedMonth'" : '') . "
    GROUP BY 
        year, 
        month_num,
        repair_dept
    ORDER BY 
        total_repairs DESC
    LIMIT 15
";

$detailsQuery = "
    SELECT 
        DATE_FORMAT(repair_time, '%m') AS month_num,
        DATE_FORMAT(repair_time, '%Y') AS year,
        repair_dept, 
        repair_acc,
        COUNT(*) AS total_repairs
    FROM 
        rp_it
    WHERE 
        DATE_FORMAT(repair_time, '%Y') = '$selectedYear' " . ($selectedMonth ? "AND DATE_FORMAT(repair_time, '%m') = '$selectedMonth'" : '') . "
    GROUP BY 
        year, 
        month_num,
        repair_dept,
        repair_acc
    ORDER BY 
        repair_dept, 
        total_repairs DESC
";

$totalRepairsQuery = "
    SELECT 
        COUNT(*) AS total_repairs
    FROM 
        rp_it
    WHERE 
        DATE_FORMAT(repair_time, '%Y') = '$selectedYear' " . ($selectedMonth ? "AND DATE_FORMAT(repair_time, '%m') = '$selectedMonth'" : '') . "
";

// Define SQL queries for repair status
$repairStatusQuery = "
    SELECT repair_status, COUNT(*) as total_repairs 
    FROM rp_it 
    WHERE DATE_FORMAT(repair_time, '%Y') = '$selectedYear' " . ($selectedMonth ? "AND DATE_FORMAT(repair_time, '%m') = '$selectedMonth'" : '') . " 
    GROUP BY repair_status 
";

$repairTypesQuery = "
    SELECT repair_acc, COUNT(*) as total_repairs
FROM rp_it
WHERE DATE_FORMAT(repair_time, '%Y') = '$selectedYear' " . ($selectedMonth ? "AND DATE_FORMAT(repair_time, '%m') = '$selectedMonth'" : '') . "
GROUP BY repair_acc 
ORDER BY total_repairs DESC

";

$repairBranchQuery = "
    SELECT repair_branch, COUNT(*) as total_repairs
FROM rp_it
WHERE DATE_FORMAT(repair_time, '%Y') = '$selectedYear' " . ($selectedMonth ? "AND DATE_FORMAT(repair_time, '%m') = '$selectedMonth'" : '') . "
GROUP BY repair_branch 
ORDER BY total_repairs DESC

";


$summaryResults = $user->selecttableuu($summaryQuery);
$detailsResults = $user->selecttableuu($detailsQuery);
$totalRepairsResult = $user->selecttableuu($totalRepairsQuery);
$totalRepairs = !empty($totalRepairsResult) ? $totalRepairsResult[0]['total_repairs'] : 0;
$repairStatusResults = $user->selecttableuu($repairStatusQuery);
$repairTypesResults = $user->selecttableuu($repairTypesQuery);
$repairBranchResults = $user->selecttableuu($repairBranchQuery);

// Define a mapping of status IDs to status names
$statusMapping = [
    1 => 'รับงานแจ้งซ่อม',
    3 => 'กำลังดำเนินการ',
    5 => 'ซ่อมไม่ได้/เปลี่ยนอุปกรณ์',
    4 => 'การซ่อมเสร็จเรียบร้อย',
    7 => 'อยู่ระหว่างเสนอซื้ออุปกรณ์ ',
    24 => 'นำเข้าใบแจ้งซ่อม (รอ IT ตรวจสอบ) ',
    25 => 'อยู่ระหว่างการซ่อม '
];

// Prepare data for Pie Chart
$statusLabels = [];
$statusData = [];
$statusColors = [
    'rgba(0, 102, 204, 0.8)',   // Dark Blue
    'rgba(0, 153, 76, 0.8)',    // Dark Green
    'rgba(255, 204, 102, 0.8)', // Light Gold
    'rgba(102, 102, 102, 0.8)', // Dark Gray
    'rgba(204, 102, 0, 0.8)'    // Dark Orange
];

foreach ($repairStatusResults as $index => $row) {
    $statusId = (int)$row['repair_status'];
    $statusLabels[] = htmlspecialchars($statusMapping[$statusId] ?? 'Unknown');
    $statusData[] = (int)$row['total_repairs'];
}

$repairTypeLabels = [];
$repairTypeData = [];
$repairTypeColors = [
    'rgba(255, 99, 132, 1)', // Red
    'rgba(54, 162, 235, 1)', // Blue
    'rgba(255, 206, 86, 1)', // Yellow
    'rgba(75, 192, 192, 1)', // Green
    'rgba(153, 102, 255, 1)'  // Purple
];

foreach ($repairTypesResults as $index => $row) {
    $repairTypeLabels[] = htmlspecialchars($row['repair_acc']);
    $repairTypeData[] = (int)$row['total_repairs'];
}


$repairBranchLabels = [];
$repairBranchData = [];
$repairBranchColors = [
    'rgba(255, 99, 132, 1)', // Red
    'rgba(54, 162, 235, 1)', // Blue
    'rgba(255, 206, 86, 1)', // Yellow
    'rgba(75, 192, 192, 1)', // Green
    'rgba(153, 102, 255, 1)'  // Purple
];

foreach ($repairBranchResults as $index => $row) {
    $repairBranchLabels[] = htmlspecialchars($row['repair_branch']);
    $repairBranchData[] = (int)$row['total_repairs'];
}


// Convert data to JSON format
$statusChartLabels = json_encode($statusLabels);
$statusChartData = json_encode($statusData);
$statusChartColors = json_encode($statusColors);

// Convert data to JSON format
$repairTypeChartLabels = json_encode($repairTypeLabels);
$repairTypeChartData = json_encode($repairTypeData);
$repairTypeChartColors = json_encode($repairTypeColors);

// Convert data to JSON format
$repairBranchChartLabels = json_encode($repairBranchLabels);
$repairBranchChartData = json_encode($repairBranchData);
$repairBranchChartColors = json_encode($repairBranchColors);

// Prepare data for the chart
foreach ($summaryResults as $index => $row) {
    $labels[] = htmlspecialchars($row['repair_dept']);
    $datasets['data'][] = (int)htmlspecialchars($row['total_repairs']);
    $datasets['backgroundColor'][] = $colors[$index % count($colors)]; // Assign color
}

$chartLabels = json_encode($labels);
$chartData = json_encode($datasets);

// Initialize an array to store the top 3 departments
$topDepartments = array_slice($summaryResults, 0, 5);

?>


<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <style>
        <?php include_once '../css/report.css';
        ?>
    </style>
</head>


<div class="row flex-grow">
    <div class="col-xl-12 col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <a href="?p=report&a=alert" class="background:#303030; padding: 8px">ส่งรายงานประจำวัน</a>
                <?php if (isset($_GET['a'])) include 'alert_report.php'; ?>
                <form id="chartForm" method="GET" action="">
                    <label for="chartTypeSelect1">เลือกประเภทของกราฟ:</label>
                    <select id="chartTypeSelect1">
                        <option value="bar">Bar</option>
                        <option value="line">Line</option>
                        <option value="radar">Radar</option>
                    </select>
                    <input type="hidden" name="p" value="report">
                    <label for="year">ปี:</label>
                    <select name="year" id="year">
                        <?php
                        $currentYear = date('Y');
                        for ($year = $currentYear; $year >= 2000; $year--) {
                            echo "<option value=\"$year\"" . ($selectedYear == $year ? ' selected' : '') . ">$year</option>";
                        }
                        ?>
                    </select>
                    <label for="month">เดือน:</label>
                    <select name="month" id="month">
                        <?php
                        foreach ($thaiMonths as $key => $value) {
                            echo "<option value=\"$key\"" . ($selectedMonth == $key ? ' selected' : '') . ">$value</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-primary">แสดงกราฟ</button>
                    <a href="?p=repair_all" style="background: #303030; color: white; padding: 8px 16px; border-radius: 4px; text-align: center; float: right;">ทั้งหมด</a>

                </form>

                <!-- <div style="margin-left: 20px;">
                    <h3>รายละเอียดการแจ้งซ่อม</h3>
                    <h3>จำนวนการแจ้งซ่อมของเดือน <?php echo $thaiMonths[$selectedMonth]; ?> ปี <?php echo $selectedYear; ?> ทั้งหมด: <?php echo $totalRepairs; ?> ครั้ง</h3>
                </div> -->


                <!-- Chart containers placed in the same row -->
                <div id="chartsRow" style="display: flex; justify-content: space-between;">

                    <div id="repairBranchChartContainer" class="chart-container1">
                        <canvas id="repairBranchChart"></canvas>
                    </div>


                    <div id="chartContainer" class="chart-container">
                        <canvas id="repairChart"></canvas>
                    </div>

                </div>

                <div id="chartsRow" style="display: flex; justify-content: space-between;">
                    <div id="repairTypeChartContainer" class="chart-container">
                        <canvas id="repairTypeChart"></canvas>
                    </div>

                    <div id="statusChartContainer" class="chart-container1">
                        <canvas id="statusChart"></canvas>
                    </div>

                </div>



                <table id="example" class="tableu" style="margin-top: 5px;">
                    <thead>
                        <tr style="background:#303030;">
                            <th>ปี</th>
                            <th>เดือน</th>
                            <th>แผนก</th>
                            <th>ประเภทการซ่อม</th>
                            <th>จำนวนการแจ้งซ่อม</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detailsResults as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['year']); ?></td>
                                <td><?php echo $thaiMonths[$row['month_num']]; ?></td>
                                <td><?php echo htmlspecialchars($row['repair_dept']); ?></td>
                                <td><?php echo htmlspecialchars($row['repair_acc']); ?></td>
                                <td><?php echo htmlspecialchars($row['total_repairs']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

<script>
    // Chart.js Initialization
    const ctx = document.getElementById('repairChart').getContext('2d');
    const chartType = document.getElementById('chartTypeSelect1').value;
    const chartData = <?php echo $chartData; ?>;

    let myChart = new Chart(ctx, {
        type: chartType,
        data: {
            labels: <?php echo $chartLabels; ?>,
            datasets: [chartData]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'จำนวนการแจ้งซ่อมตามแผนก', // เปลี่ยนหัวข้อตามที่ต้องการ
                    font: {
                        size: 18 // ขนาดตัวอักษรของหัวข้อ
                    }
                }
            },

            text: 'จำนวนการแจ้งซ่อมตามแผนก',
            font: {
                size: 20,
                weight: 'bold'

            },
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Change chart type on selection
    document.getElementById('chartTypeSelect1').addEventListener('change', function() {
        const newType = this.value;
        myChart.destroy(); // Destroy the previous chart instance
        myChart = new Chart(ctx, {
            type: newType,
            data: {
                labels: <?php echo $chartLabels; ?>,
                datasets: [chartData]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'จำนวนการแจ้งซ่อมตามแผนก', // เปลี่ยนหัวข้อตามที่ต้องการ
                        font: {
                            size: 18 // ขนาดตัวอักษรของหัวข้อ
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

    const ctxStatus = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(ctxStatus, {
        type: 'pie',
        data: {
            labels: <?php echo $statusChartLabels; ?>,
            datasets: [{
                label: 'จำนวน',
                data: <?php echo $statusChartData; ?>,
                backgroundColor: <?php echo $statusChartColors; ?>,
                borderColor: 'rgba(255, 255, 255, 0.8)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'สรุปสถานะงานซ่อม',
                    font: {
                        size: 20,
                        weight: 'bold'

                    },
                    padding: {
                        top: 10,
                        bottom: 20
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom', // หรือ 'top', 'left', 'right' ตามที่คุณต้องการ
                    labels: {
                        font: {
                            size: 16
                        },
                        padding: 20,
                        // ปรับระยะห่างของเลเจนด์
                        boxWidth: 20,
                        // การปรับความกว้างของกล่องเลเจนด์
                        padding: 10,
                    },
                    // ปรับตำแหน่งของเลเจนด์ให้แน่ใจว่าอยู่ในบรรทัดเดียวกัน
                    align: 'start', // ใช้ 'start', 'center', 'end' ขึ้นอยู่กับความต้องการ
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            const dataset = tooltipItem.dataset;
                            const label = dataset.label || '';
                            const value = tooltipItem.raw;
                            return `${label}: ${value}`;
                        }
                    },
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: {
                        size: 16,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 16
                    }
                },
                // Add a shadow to simulate 3D effect
                datalabels: {
                    color: '#fff',
                    display: true,
                    formatter: (value, context) => {
                        return `${value}%`;
                    },
                    font: {
                        size: 14,
                        weight: 'bold'
                    },
                    offset: 10,
                    anchor: 'end',
                    backgroundColor: 'rgba(0, 0, 0, 0.5)',
                    borderRadius: 3,
                    padding: 4
                }
            },
            // Add a shadow effect to the chart
            elements: {
                arc: {
                    // Shadow effect
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                    shadowBlur: 10,
                    shadowColor: 'rgba(0, 0, 0, 0.3)'
                }
            }
        }
    });

    // Repair Types Chart
    const ctxRepairType = document.getElementById('repairTypeChart').getContext('2d');
    const repairTypeChart = new Chart(ctxRepairType, {
        type: 'bar',
        data: {
            labels: <?php echo $repairTypeChartLabels; ?>,
            datasets: [{
                label: 'จำนวน',
                data: <?php echo $repairTypeChartData; ?>,
                backgroundColor: <?php echo $repairTypeChartColors; ?>,
                borderColor: 'rgba(255, 255, 255, 0.8)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'สรุปประเภทงานซ่อม', // เปลี่ยนหัวข้อตามที่ต้องการ
                    font: {
                        size: 18 // ขนาดตัวอักษรของหัวข้อ
                    }
                }
            },

            text: 'สรุปประเภทงานซ่อม',
            font: {
                size: 20,
                weight: 'bold'

            },
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    // Repair Types Chart
    const ctxRepairBranch = document.getElementById('repairBranchChart').getContext('2d');
    const repairBranchChart = new Chart(ctxRepairBranch, {
        type: 'pie',
        data: {
            labels: <?php echo $repairBranchChartLabels; ?>,
            datasets: [{
                label: 'จำนวน',
                data: <?php echo $repairBranchChartData; ?>,
                backgroundColor: <?php echo $repairBranchChartColors; ?>,
                borderColor: 'rgba(255, 255, 255, 0.8)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'สรุปงานซ่อมสาขา',
                    font: {
                        size: 20,
                        weight: 'bold'
                    },
                    padding: {
                        top: 10,
                        bottom: 20
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 16
                        },
                        padding: 20
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            const dataset = tooltipItem.dataset;
                            const label = dataset.label || '';
                            const value = tooltipItem.raw;
                            return `${label}: ${value}`;
                        }
                    },
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: {
                        size: 16,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 16
                    }
                },
                datalabels: {
                    color: '#fff',
                    display: true,
                    formatter: (value, context) => {
                        return `${value}`;
                    },
                    font: {
                        size: 14,
                        weight: 'bold'
                    },
                    offset: 10,
                    anchor: 'end',
                    backgroundColor: 'rgba(0, 0, 0, 0.5)',
                    borderRadius: 3,
                    padding: 4
                }
            },
            elements: {
                arc: {
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                    shadowBlur: 10,
                    shadowColor: 'rgba(0, 0, 0, 0.3)'
                }
            }
        }
    });
</script>

</body>

</html>