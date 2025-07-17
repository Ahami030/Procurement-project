<!DOCTYPE html>
<html>

<head>
    <title>Preview ข้อมูล Company Name</title>
    <!-- เรียกใช้ Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- เรียกใช้ Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="container">
        <h2>ข้อมูล Company Name จาก db_checker</h2>
        <div class="row">
            <?php
             $servername = "localhost";
             $username = "root";
             $password = "";
             $dbname = "user_registration";

            $conn = new mysqli($servername, $username, $password, $dbname);
            

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT company_name , date_start , date_end FROM db_checker";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $date_start = date("j M Y", strtotime($row['date_start']));
                    $date_end = date("j M Y", strtotime($row['date_end']));
                    ?>
            <!-- แสดงแต่ละข้อมูลในรูปแบบของ Card -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <span data-toggle="tooltip" data-placement="right"
                            title="<?php echo $date_start; ?> - <?php echo $date_end; ?>">
                            <?php echo $row["company_name"]; ?>
                            <i class="fas fa-info-circle ml-2"></i>
                        </span>
                    </div>
                </div>
            </div>
            <?php
    }
} else {
    echo "0 results";
}

$conn->close();
?>
            <!-- เรียกใช้ Bootstrap JS และ Popper.js -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <!-- Script สำหรับกำหนด Tooltip -->
            <script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
            </script>
</body>

</html>