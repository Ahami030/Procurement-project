<?php
// Check if session is not started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// ข้อมูลสำหรับการเชื่อมต่อกับ MySQL Database
$servername = "localhost"; // เชื่อมต่อกับ localhost
$username = "root"; // ชื่อผู้ใช้งานฐานข้อมูล
$password = ""; // รหัสผ่านฐานข้อมูล
$dbname = "user_registration"; // ชื่อฐานข้อมูล

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// เช็คว่ามี session ของ member_id หรือไม่
if (isset($_SESSION['member_id'])) {
    // ดึงค่า member_id จาก session
    $member_id = $_SESSION['member_id'];

    // คำสั่ง SQL สำหรับดึงข้อมูล ID_member และ state_1, state_2, state_3 จากตาราง state
    // โดยเชื่อมตาราง state และ images ด้วยคอลัมน์ ID_member
    $sql = "SELECT state_po.ID_member, state_po.state_1, state_po.state_2, state_po.state_3
    FROM state_po
    LEFT JOIN po ON state_po.ID_member = po.ID_member
    WHERE state_po.ID_member = $member_id";


    // ทำคำสั่ง SQL
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // แสดงข้อมูลทีละแถว
        while ($row = $result->fetch_assoc()) {
            
            // ตรวจสอบค่า state_1
            if ($row["state_1"] == 1) {
                // ถ้า state_1 เป็น 1 ให้ตั้งค่า style ของ progress bar 1 ใน JavaScript
                ?>
                <script>
                    document.getElementById('progressBar1_po').style.width = '100%';
                    var myElement = document.querySelector('.card1_po');
                    myElement.classList.add('alert-warning');
                    var myElement = document.querySelector('.bar1_po');
                    myElement.classList.add('progress-bar-striped', 'bg-warning', 'progress-bar-animated');

                    var spanElement = document.getElementById('span1_po');
                    if (spanElement) {
                        spanElement.innerText = 'กำลังตรวจสอบ';

                        // Use the id "span1_po" instead of the class ".badge"
                        spanElement.classList.add('text-black', 'bg-warning');
                    }
                </script>
                <?php
            } elseif ($row["state_1"] == 2) {
                // ถ้า state_1 เป็น 2 ให้ตั้งค่า style ของ progress bar 1 ใน JavaScript ตามเงื่อนไขที่ต้องการ
                ?>
                <script>
                    document.getElementById('progressBar1_po').style.width = '100%';
                    var myElement = document.querySelector('.card1_po');
                    myElement.classList.add('alert-success');
                    var myElement = document.querySelector('.bar1_po');
                    myElement.classList.add('progress-bar-striped', 'bg-success');

                    var spanElement = document.getElementById('span1_po');
                    if (spanElement) {
                        spanElement.innerText = 'สำเร็จ';

                        // Use the id "span1_po" instead of the class ".badge"
                        spanElement.classList.add('text-white', 'bg-success');
                    }
                </script>
                <?php
            }







            // ตรวจสอบค่า state_2
            if ($row["state_2"] == 1) {
                // ถ้า state_2 เป็น 1 ให้ตั้งค่า style ของ progress bar 1 ใน JavaScript
                ?>
                <script>
                    document.getElementById('progressBar2_po').style.width = '100%';
                    var myElement = document.querySelector('.card2_po');
                    myElement.classList.add('alert-warning');
                    var myElement = document.querySelector('.bar2_po');
                    myElement.classList.add('progress-bar-striped', 'bg-warning', 'progress-bar-animated');

                    var spanElement = document.getElementById('span2_po');
                    if (spanElement) {
                        spanElement.innerText = 'กำลังตรวจสอบ';

                        // Use the id "span1_po" instead of the class ".badge"
                        spanElement.classList.add('text-black', 'bg-warning');
                    }
                </script>

                <?php
            } elseif ($row["state_2"] == 2) {
                // ถ้า state_1 เป็น 2 ให้ตั้งค่า style ของ progress bar 1 ใน JavaScript ตามเงื่อนไขที่ต้องการ
                ?>
                <script>
                    document.getElementById('progressBar2_po').style.width = '100%';
                    var myElement = document.querySelector('.card2_po');
                    myElement.classList.add('alert-success');
                    var myElement = document.querySelector('.bar2_po');
                    myElement.classList.add('progress-bar-striped', 'bg-success');


                    var spanElement = document.getElementById('span2_po');
                    if (spanElement) {
                        spanElement.innerText = 'สำเร็จ';

                        // Use the id "span1_po" instead of the class ".badge"
                        spanElement.classList.add('text-white', 'bg-success');
                    }
                </script>
                <?php
            }




            // ตรวจสอบค่า state_3
            if ($row["state_3"] == 1) {
                // ถ้า state_1 เป็น 1 ให้ตั้งค่า style ของ progress bar 1 ใน JavaScript
                ?>

                <script>
                    document.getElementById('progressBar3_po').style.width = '100%';
                    var myElement = document.querySelector('.card3_po');
                    myElement.classList.add('alert-warning');
                    var myElement = document.querySelector('.bar3_po');
                    myElement.classList.add('progress-bar-striped', 'bg-warning', 'progress-bar-animated');

                    var spanElement = document.getElementById('span3_po');
                    if (spanElement) {
                        spanElement.innerText = 'กำลังตรวจสอบ';

                        // Use the id "span1_po" instead of the class ".badge"
                        spanElement.classList.add('text-black', 'bg-warning');


                        document.getElementById('preview_bill').style.display = 'none';
                    }
                </script>


                <?php
            } elseif ($row["state_3"] == 2) {
                // ถ้า state_1 เป็น 2 ให้ตั้งค่า style ของ progress bar 1 ใน JavaScript ตามเงื่อนไขที่ต้องการ
                ?>

                <script>
                    document.getElementById('progressBar3_po').style.width = '100%';
                    var myElement = document.querySelector('.card3_po');
                    myElement.classList.add('alert-success');
                    var myElement = document.querySelector('.bar3_po');
                    myElement.classList.add('progress-bar-striped', 'bg-success');


                    document.getElementById('openModalBtn_PO').style.display = 'block';


                    var spanElement = document.getElementById('span3_po');
                    if (spanElement) {
                        spanElement.innerText = 'สำเร็จ';

                        // Use the id "span1_po" instead of the class ".badge"
                        spanElement.classList.add('text-white', 'bg-success');
                    }
                   
                    // Get the button element by its ID
                    var moneyButton = document.getElementById("openModalBtn_money");

                    // Remove the 'disabled' attribute
                    moneyButton.removeAttribute("disabled");

                    document.getElementById('preview_bill').style.display = 'block';

                </script>
                <?php
            }

            // ตั้งค่า style อื่น ๆ ตามที่คุณต้องการ
            ?>
            <script>
                document.getElementById('additionalCards_po').style.display = 'block';
                document.getElementById('outerCardList_po').style.display = 'block';
                document.getElementById('openModalBtn_PO').style.display = 'none';
            </script>
            <?php
        }
    } else {
        echo "ไม่พบข้อมูลสมาชิก";
    }
} else {
    echo "Session ของ member_id ไม่พบ";
}

// ปิดการเชื่อมต่อ
$conn->close();
?>


