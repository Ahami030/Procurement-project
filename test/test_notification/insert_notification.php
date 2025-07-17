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

// คำสั่ง SQL เพื่อ insert ข้อมูลด้วยค่าวันเวลาปัจจุบันจาก MySQL
$sql = "INSERT INTO notification (qt_seen, datetime) VALUES ('unseen', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "บันทึกข้อมูลเรียบร้อยแล้ว";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
