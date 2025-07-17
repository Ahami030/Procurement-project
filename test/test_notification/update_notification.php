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

// คำสั่ง SQL เพื่ออัปเดตค่า qt_seen เป็น "seen" ทั้งหมด
$sql = "UPDATE notification SET qt_seen = 'seen' WHERE qt_seen = 'unseen'";

if ($conn->query($sql) === TRUE) {
    echo "อัปเดตสถานะเห็นแล้วทั้งหมดเรียบร้อยแล้ว";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
