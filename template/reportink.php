<?php include_once '../template/update_charts.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .chart-container {
            display: none;
            /* Hide all charts by default */
        }

        .active {
            display: block;
            /* Show the active chart */
        }

        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-warning {
            background-color: #ffc107;
        }

        .btn:hover {
            opacity: 0.8;
        }

        .btn i {
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <div class="row flex-grow">
        <div class="col-xl-12 col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <?php
                    if (isset($_GET['a'])) {
                        include 'alert_report.php';
                    }
                    ?>
                    <a href="?p=report&a=alert" class="btn btn-success btn-block">ส่งรายงานประจำวัน</a>
                    <br>
                    <div class="all-user">
                        <p>แผนกที่แจ้งซ่อม</p>
                        <a href="?p=repair_all">ทั้งหมด</a>
                    </div>

                    <label for="deptSelect">เลือกแผนก:</label>
                    <select id="deptSelect">
                        <option value="">ทั้งหมด</option>
                        <?php foreach ($deptResult as $dept) {
                            echo '<option value="' . htmlspecialchars($dept['dept_name']) . '">' . htmlspecialchars($dept['dept_name']) . '</option>';
                        } ?>
                    </select>

                    <script>
                        function updateCharts() {
                            var select = document.getElementById('deptSelect');
                            var selectedValue = select.value;

                            // Call your function to update the charts here
                            // For example:
                            console.log('Selected department:', selectedValue);

                            // You can use AJAX to fetch new data based on the selected department
                            // and update your charts accordingly.
                        }
                    </script>


                    <button onclick="showChart('chart1')" class="btn btn-primary">
                        ภาพรวม
                    </button>
                    <button onclick="showChart('chart2')" class="btn btn-secondary">
                    TONER
                    </button>
                    <button onclick="showChart('chart3')" class="btn btn-success">
                    DOT MATRIX
                    </button>
                    <button onclick="showChart('chart4')" class="btn btn-warning">
                    INKJET
                    </button>
                    <button id="searchDeptBtn" class="btn btn-primary" onclick="updateCharts()">
                        ค้นหาแผนก
                    </button>



                    <!-- Container for Chart 1 -->
                    <div class="chart-container" id="chart1">
                        <canvas id="myChart1" width="400" height="200"></canvas>
                    </div>

                    <!-- Container for Chart 2 -->
                    <div class="chart-container" id="chart2">
                        <canvas id="myChart2" width="400" height="200"></canvas>
                    </div>

                    <!-- Container for Chart 3 -->
                    <div class="chart-container" id="chart3">
                        <canvas id="myChart3" width="400" height="200"></canvas>
                    </div>

                    <!-- Container for Chart 3 -->
                    <div class="chart-container" id="chart4">
                        <canvas id="myChart4" width="400" height="200"></canvas>
                    </div>




                    <script>
                        var ctx1 = document.getElementById('myChart1').getContext('2d');
                        var ctx2 = document.getElementById('myChart2').getContext('2d');
                        var ctx3 = document.getElementById('myChart3').getContext('2d');
                        var ctx4 = document.getElementById('myChart4').getContext('2d');
                        var backgroundColors = [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                            'rgba(255, 159, 64, 0.8)',
                            'rgba(201, 203, 207, 0.8)',
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                            'rgba(255, 159, 64, 0.8)',
                            'rgba(201, 203, 207, 0.8)',
                            'rgba(54, 162, 235, 0.8)'
                        ];

                        var borderColors = [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(201, 203, 207, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(201, 203, 207, 1)',
                            'rgba(54, 162, 235, 1)'
                        ];

                        var myChart1 = new Chart(ctx1, {
                            type: 'bar',
                            data: {
                                labels: <?php echo json_encode(json_decode($chartData, true)['dept_names5']); ?>,
                                datasets: [{
                                    label: 'จำนวน',
                                    data: <?php echo json_encode(json_decode($chartData, true)['dept_counts5']); ?>,
                                    backgroundColor: backgroundColors,
                                    borderColor: borderColors,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });

                        var myChart2 = new Chart(ctx2, {
                            type: 'bar',
                            data: {
                                labels: <?php echo json_encode(json_decode($chartData, true)['dept_names6']); ?>,
                                datasets: [{
                                    label: 'จำนวน',
                                    data: <?php echo json_encode(json_decode($chartData, true)['category_counts6']); ?>,
                                    backgroundColor: backgroundColors,
                                    borderColor: borderColors,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });


                        var myChart3 = new Chart(ctx3, {
                            type: 'bar',
                            data: {
                                labels: <?php echo json_encode(json_decode($chartData, true)['dept_names7']); ?>,
                                datasets: [{
                                    label: 'จำนวน',
                                    data: <?php echo json_encode(json_decode($chartData, true)['category_counts7']); ?>,
                                    backgroundColor: backgroundColors,
                                    borderColor: borderColors,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });

                        var myChart4 = new Chart(ctx4, {
                            type: 'bar',
                            data: {
                                labels: <?php echo json_encode(json_decode($chartData, true)['dept_names8']); ?>,
                                datasets: [{
                                    label: 'จำนวน',
                                    data: <?php echo json_encode(json_decode($chartData, true)['category_counts8']); ?>,
                                    backgroundColor: backgroundColors,
                                    borderColor: borderColors,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                        
                        
                        function showChart(chartId) {
                            document.querySelectorAll('.chart-container').forEach(function(container) {
                                container.classList.remove('active');
                            });
                            document.getElementById(chartId).classList.add('active');
                        }

                        // Show the first chart by default
                        showChart('chart1');
                    </script>
                </div>
            </div>
        </div>
    </div>
</body>

</html>








<?php
if ($a == "1") {
    $user->redirect('../index');
}
?>
<div class="row flex-grow">
    <div class="col-xl-12 col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <?php
                if (isset($_GET['a'])) {
                    include 'alert_report.php';
                }
                ?>
                <a href="?p=report&a=alert" class="btn btn-success btn-block">ส่งรายงานประจำวัน</a>
                <br>
                <div class="all-user">
                    <p>แผนกที่แจ้งซ่อม</p>
                    <a href="?p=repair_all">ทั้งหมด</a>
                </div>
                <table class="tableu">
                    <thead>
                        <tr>
                            <td>แผนก</td>
                            <td>จำนวน</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tableu = "SELECT 
                        COUNT(*) AS a, 
                            dept.dept_name AS b 
                                    FROM 
                                        stock_ink_out
                                    INNER JOIN 
                                        dept 
                                    ON 
                                        stock_ink_out.stock_out_ink_dept = dept.dept_id
                                    GROUP BY 
                                        stock_ink_out.stock_out_ink_dept, dept.dept_name
                                    ORDER BY 
                                        a DESC
                                    ;

                                     ";  
                        $querytableu = $user->selecttableu($tableu);
                        ?>



                        <tr>
                            <td>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>