<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
$sql = "SELECT product_po.*, users.username AS user_name, users.email, users.company_name 
FROM product_po 
INNER JOIN users ON product_po.ID_member = users.id 
WHERE product_po.created_at = '$createAt'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // Output data of the selected row
    $row = $result->fetch_assoc();
    $Name = $row['user_name'];
    $company = $row['company_name'];
   

    echo "</table>";
} else {
    echo "0 results";
}


?>



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
        <h2>ใบส่งของ/ใบกำกับภาษี</h2>
    </div>
    <p>เรียน <?php echo  $company;?></p>
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
$sql = "SELECT product_po.*, users.username AS user_name, users.email, users.company_name 
FROM product_po 
INNER JOIN users ON product_po.ID_member = users.id 
WHERE product_po.created_at = '$createAt'";
$result = $conn->query($sql);
$company = $row['company_name'];


if ($result->num_rows > 0) {
    // Output data of the selected row
    $row = $result->fetch_assoc();
    $Name = $row['user_name'];
    $company = $row['company_name'];
    echo "<table border='1'>";
    echo "<tr><th>ลำดับที่</th><th>Name</th><th>Price</th></tr>";
    echo "<tr>";
    echo "<td>1</td>"; // Starting with row number 1 for the first row
    echo "<td>" . $row["Name"] . "</td>"; // Display user name
    echo "<td>" . $row["Price"] . "</td>"; // Display initial price
    
    echo "</tr>";

    // Calculate and display the total price for the first row
    $totalPrice = $row["Price"];

    // Check for other rows with the same created_at
    $similarRowsSql = "SELECT * FROM product_po WHERE created_at = '$createAt' AND ID != " . $row["ID"];
    $similarRowsResult = $conn->query($similarRowsSql);

    if ($similarRowsResult->num_rows > 0) {
        $order = 2; // Starting with row number 2 for the next rows
        while ($similarRow = $similarRowsResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $order . "</td>"; // Display the row number
            echo "<td>" . $similarRow["Name"] . "</td>"; // Display user name
            echo "<td>" . $similarRow["Price"] . "</td>"; // Display price for this row
            
            echo "</tr>";
            $totalPrice += $similarRow["Price"]; // Calculate total price
            $order++; // Increment row number for the next row
        }
    }

    // Display the total price in a new row after all rows
    echo "<tr><td colspan='2'>Total:</td><td>$totalPrice</td></tr>";
    echo "</table>";
} else {
    echo "0 results";
}
?>

    </center>
    <p>ซึ่งเป็นราคาที่รวมภาษีมูลค่าเพิ่ม รวมทั้งภาษีอากรอื่น และค่าใช้จ่ายทั้งปวไว้ด้วยแล้ว</p>
    <div class="intro">
        <p>3.คำเสนอนี้จะยืนอยู่ราะยะเวลา 15วัน นับตั้งแต่วันที่ยื่นใบเสนอราคา</p>
        <p>4.กำหนดส่งมอบพัสดุตามรายละเอียดรายการข้างต้น ภายใน 15 วัน นับถัดจากวันลงนาม</p>
        <p>(/)ซื้อ ( )จ้าง</p>
        <p>เสนอ ณ <?php echo  $createAt;?></p>
        <div class="signature">
            <div class="sig1">
                <p>(ลงชื่อ)................................ผู้ต่อรองราคา</p>
                <div class="si1">
                    <p>(<?php echo  $Name;?>)</p>
                </div>
            </div>
            <div class="sig2">
                <p>(ลงชื่อ)................................ผู้เสนอราคา</p>
                <div class="si1">
                    <p>(<?php echo  $Name;?>)</p>
                </div>
            </div>
        </div>

    </div>
</body>

</html>