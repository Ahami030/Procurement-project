<!DOCTYPE html>
<html>

<head>
    <title>แสดงข้อมูลบริษัท</title>
    <!-- เรียกใช้ Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>ข้อมูลบริษัท</h2>
        <div class="row">
            <div class="col-md-12">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "user_registration";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // รับค่า parameter ชื่อบริษัทจาก URL
                if (isset($_GET['company_name'])) {
                    $company_name = $_GET['company_name'];

                    // สร้าง query สำหรับดึงข้อมูลบริษัท
                    $sql = "SELECT * FROM bill_records WHERE company_name = '$company_name'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo '<table class="table">';
                        echo '<thead><tr><th style="text-align:center;">ลำดับที่</th><th style="text-align:center;">ใบส่งของชั่วคราวบิลเล่มที่/เลขที่</th><th style="text-align:center;">วันที่</th><th style="text-align:center;">จำนวนเงิน</th></tr></thead>';
                        echo '<tbody>';
                        $counter = 1; // เพิ่มตัวแปรนับลำดับที่
                
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td style="text-align:center;">' . $counter++ . '</td>'; // แสดงลำดับที่และเพิ่มค่าลำดับที่
                            echo '<td style="text-align:center;">' . $row["bill_No"] . '</td>';
                            echo '<td style="text-align:center;">' . $row["date_upload"] . '</td>';
                            echo '<td style="text-align:center;">' . $row["price"] . '</td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo "ไม่พบข้อมูลบริษัท";
                    }
                } else {
                    echo "ไม่มีข้อมูลบริษัทที่ระบุ";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <!-- เรียกใช้ Bootstrap JS และ Popper.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>