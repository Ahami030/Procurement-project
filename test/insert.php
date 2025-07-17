<?php
// เชื่อมต่อกับ MySQL Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับข้อมูลจากฟอร์ม
$name = $_POST['name'];
$date_start = date('Y-m-d'); // ตั้งค่า date_start เป็นวันที่ปัจจุบัน

// คำนวณวันที่ date_end โดยเพิ่ม 30 วันจากวันปัจจุบัน
$date_end = date('Y-m-d', strtotime('+30 days'));

$company_name = $_POST['company_name'];

// เตรียมคำสั่ง SQL เพื่อเพิ่มข้อมูล
$sql = "INSERT INTO db_checker (name, date_start, date_end, company_name) VALUES ('$name', '$date_start', '$date_end', '$company_name')";

if ($conn->query($sql) === TRUE) {
    echo "เพิ่มข้อมูลสำเร็จ";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>