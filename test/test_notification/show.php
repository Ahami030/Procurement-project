<!DOCTYPE html>
<html>
<head>
    <title>แสดงข้อมูลและปุ่มเปลี่ยนสถานะ</title>
</head>
<body>

<h1>ข้อมูลการเห็น</h1>

<?php
// เชื่อมต่อกับฐานข้อมูล (MySQL)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// คำสั่ง SQL เพื่อนับจำนวนแถวที่มี qt_seen เท่ากับ "unseen"
$sqlCount = "SELECT COUNT(*) AS unseen_count FROM notification WHERE qt_seen = 'unseen'";
$resultCount = $conn->query($sqlCount);

if ($resultCount && $resultCount->num_rows > 0) {
    // ดึงข้อมูล
    $row = $resultCount->fetch_assoc();
    $unseenCount = $row["unseen_count"];
    echo "จำนวนการเห็นที่ยังไม่ได้เปิดอ่าน: " . $unseenCount;
} else {
    echo "ไม่พบข้อมูลการเห็นที่ยังไม่ได้เปิดอ่าน";
}

// ปิดการเชื่อมต่อ
$conn->close();
?>

<form action="update_notification.php" method="post">
    <input type="submit" name="update" value="เปลี่ยนสถานะเห็นทั้งหมดเป็นเห็นแล้ว">
</form>


</body>
</html>
