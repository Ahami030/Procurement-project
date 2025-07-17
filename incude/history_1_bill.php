<!DOCTYPE html>
<html>
<head>
    <title>Preview ข้อมูล Company Name</title>
    <!-- เรียกใช้ Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- เรียกใช้ Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- สร้างไฟล์ CSS เพื่อกำหนดรูปแบบสำหรับลิงค์ -->
    <style>
        .card-link {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>ข้อมูล Company Name จาก db_checker</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Date Start</th>
                    <th scope="col">Date End</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 $servername = "localhost";
                 $username = "root";
                 $password = "";
                 $dbname = "user_registration";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT br.company_name, dc.date_start, dc.date_end FROM bill_records br INNER JOIN db_checker dc ON br.company_name = dc.company_name GROUP BY br.company_name";
                $result = $conn->query($sql);
                $counter = 1;

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $counter; ?></th>
                            <td>
                                <a href="show_company_info.php?company_name=<?php echo urlencode($row["company_name"]); ?>" class="card-link">
                                    <?php echo $row["company_name"]; ?>
                                </a>
                            </td>
                            <td><?php echo $row["date_start"]; ?></td>
                            <td><?php echo $row["date_end"]; ?></td>
                        </tr>
                        <?php
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='4'>0 results</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- เรียกใช้ Bootstrap JS และ Popper.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script สำหรับ redirect เมื่อ Card ถูกคลิก -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cardLinks = document.querySelectorAll('.card-link');
            cardLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });
        });
    </script>
</body>
</html>
