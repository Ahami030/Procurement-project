<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

// เชื่อมต่อกับ MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["save"])) {
    $company_name = $_POST['company_name'];
    $price = $_POST['price'];
    $bill_No = $_POST['billNo'];

    $check_company_query = "SELECT * FROM db_checker WHERE company_name = '$company_name'";
    $result = $conn->query($check_company_query);

    if ($result && $result->num_rows > 0) {
        // มีชื่อบริษัทที่ตรงกันใน my_table_name ให้ดึงข้อมูล date_start, date_end, id จาก my_table_name และทำการ insert ลงใน bill_records
        $row = $result->fetch_assoc();
        $date_start = $row['date_start'];
        $date_end = $row['date_end'];
        $id_from_my_table = $row['id'];
        $dateNow = date('Y-m-d H:i:s');

        $date_combined = $date_start . ' - ' . $date_end;

        $insert_query = "INSERT INTO bill_records (company_name, price, date, date_upload, id_bill, bill_No) VALUES ('$company_name', '$price', '$date_combined', '$dateNow', '$id_from_my_table', '$bill_No')";
        if ($conn->query($insert_query) === TRUE) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'บิลถูกเพิ่มเรียบร้อยแล้ว',
               
            });
          </script>";

        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'ไม่มีข้อมูลในระบบ',
                text: 'กรุณาสร้างหรือกรอกใหม่ด้วย',
            });
          </script>";
        echo '<script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    document.getElementById("openModal").click();
                                });
                              </script>';
    }
}

$conn->close();
?>
<!-- Modal content goes here -->

<form action="" method="post" onsubmit="return submitForm()">
    <input type="hidden" id="ID_member" name="ID_member" value="<?php echo $submittedID_member ?>">
    <label for="company_name" class="form-label">ชื่อบริษัท:</label>
    <input type="text" class="form-control" id="company_name" name="company_name">
    <div class="col">
        <ul class="list-group" id="searchResults"></ul>
    </div>
    <label for="company_name" class="form-label">จำนวนเงิน:</label>
    <input type="text" class="form-control" id="price" name="price" placeholder="จำนวนเงิน">
    <label for="company_name" class="form-label">เลขที่บิล:</label>
    <input type="text" class="form-control" id="billNo" name="billNo" placeholder="เลขที่บิล">

    <div class="modal-footer mt-4">
        <input type="submit" name="save" class="btn btn-primary" value="เพิ่มบิล">
    </div>
</form>