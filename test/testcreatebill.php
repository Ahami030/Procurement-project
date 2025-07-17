<!DOCTYPE html>
<html>
<head>
    <title>เพิ่มข้อมูล</title>
    <script>
        // ฟังก์ชันสำหรับตั้งค่าวันที่ใน input date_start เป็นวันปัจจุบัน
        function setStartDate() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('date_start').value = today;
        }

        // ฟังก์ชันสำหรับตั้งค่าวันที่ใน input date_end เป็นวันปัจจุบัน + 30 วัน
        function setEndDate() {
            var today = new Date();
            today.setDate(today.getDate() + 30);
            var endDate = today.toISOString().split('T')[0];
            document.getElementById('date_end').value = endDate;
        }
    </script>
</head>
<body onload="setStartDate(); setEndDate();">
    <h2>เพิ่มข้อมูลใหม่</h2>
    <form action="insert.php" method="post">
        <label for="name">ชื่อ:</label>
        <input type="text" id="name" name="name"><br><br>

        <label for="date_start">วันที่เริ่มต้น:</label>
        <input type="date" id="date_start" name="date_start"><br><br>

        <label for="date_end">วันที่สิ้นสุด:</label>
        <input type="date" id="date_end" name="date_end"><br><br>

        <label for="company_name">ชื่อบริษัท:</label>
        <input type="text" id="company_name" name="company_name"><br><br>

        <input type="submit" value="เพิ่มข้อมูล">
    </form>
</body>
</html>
