<body>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
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

                $sql = "SELECT company_name , date_start , date_end FROM db_checker ORDER BY id DESC LIMIT 5";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $date_start = date("j M Y", strtotime($row['date_start']));
                        $date_end = date("j M Y", strtotime($row['date_end']));
                        ?>
            <tr>
                <td><?php echo $row["company_name"]; ?></td>
                <td><?php echo $date_start; ?></td>
                <td><?php echo $date_end; ?></td>
            </tr>
            <?php
            }
        } else {
            echo "<tr><td colspan='3'>0 results</td></tr>";
        }

        $conn->close();
        ?>
        </tbody>
    </table>
</div>
  
</body>




