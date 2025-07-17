<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
@media print {


    .pdf-preview,
    #viewer,
    .no-print {
        display: none;

    }
}

@page {
    size: A4;
    margin: 0;
}

body {

    font-family: Arial, sans-serif;
}


.header {
    margin-top: 45px;
    text-align: center;
}

.intro {
    margin-left: 35px;
}

.tableDB {
    margin-left: auto;
    margin-right: auto;
}

.signature {
    justify-content: space-between;
    display: flex;
}
.si1{
    margin-left: 50px;
}
</style>

<body>
    <div class="header">
        <h2>ใบเสนอราคา</h2>
    </div>
    <p>เรียน **echo name company**</p>
    <div class="intro">
        <p>1.ข้าพเจ้า หจก.แพร่สงวนพาณิชย์ โทรศัพท์ 054-533578
            ข้าพเจ้าเป็นผู้มีคุณสมบัติครบถ้สนตามที่กำหนดและเป็นผู้ไม่ทิ้งงานของทางราชการ</p>
        <p>2.ข้าพเจ้าขอเสนอพัสดุ รวมทั้งบริการและกำหนดเวลาส่งมอบดังต่อไปนี้</p>
    </div>
    <center>
        <?php
// Replace these variables with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get created_at value from URL parameter
$createAt = $_GET['created_at'];

// Select data based on created_at
$sql = "SELECT * FROM product WHERE created_at = '$createAt'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the selected row
    $row = $result->fetch_assoc();
    echo "<table border='1'>";
    echo "<tr><th>ลำดับที่</th><th>Name</th><th>Price</th></tr>";
    echo "<tr>";
    echo "<td>1</td>"; // เริ่มลำดับที่ 1 สำหรับแถวแรก
    echo "<td>" . $row["Name"] . "</td>";
    echo "<td>" . $row["Price"] . "</td>";
    
    echo "</tr>";

    // Check for other rows with the same created_at
    $similarRowsSql = "SELECT * FROM product WHERE created_at = '$createAt' AND ID != " . $row["ID"];
    $similarRowsResult = $conn->query($similarRowsSql);

    if ($similarRowsResult->num_rows > 0) {
        $order = 2; // เริ่มลำดับที่ 2 สำหรับแถวถัดไป
        while ($similarRow = $similarRowsResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $order . "</td>"; // แสดงลำดับของแถว
            echo "<td>" . $similarRow["Name"] . "</td>";
            echo "<td>" . $similarRow["Price"] . "</td>";
           
            echo "</tr>";
            $order++; // เพิ่มลำดับสำหรับแถวถัดไป
        }
    }

    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

    </center>
    <p>ซึ่งเป็นราคาที่รวมภาษีมูลค่าเพิ่ม รวมทั้งภาษีอากรอื่น และค่าใช้จ่ายทั้งปวไว้ด้วยแล้ว</p>
    <div class="intro">
        <p>3.คำเสนอนี้จะยืนอยู่ราะยะเวลา 15วัน นับตั้งแต่วันที่ยื่นใบเสนอราคา</p>
        <p>4.กำหนดส่งมอบพัสดุตามรายละเอียดรายการข้างต้น ภายใน 15 วัน นับถัดจากวันลงนาม</p>
        <p>(/)ซื้อ ( )จ้าง</p>
        <p>เสนอ ณ **echo date**</p>
        <div class="signature">
            <div class="sig1">
                <p>(ลงชื่อ)................................ผู้ต่อรองราคา</p>
                <div class="si1">
                    <p>(**echo name user**)</p>
                </div>
            </div>
            <div class="sig2">
                <p>(ลงชื่อ)................................ผู้เสนอราคา</p>
                <div class="si1">
                    <p>(**echo name user**)</p>
                </div>
            </div>
        </div>

    </div>
</body>

</html>