<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>
    <title>Table with IndexedDB</title>
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    button {
        margin-top: 10px;
    }

    <?php include 'table_connect.php';


    ?>
    </style>
</head>

<body>
    <div class="text-center mb-5">
        <h1 class="fw-bolder">กรอกหน้าใบตอบรับ</h1>
        <!-- <p class="lead fw-normal text-muted mb-0">With our no hassle pricing plans</p> -->
    </div>
    <?php
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the submitted ID_member
        if (isset($_POST['ID_member'])) {
            $submittedID_member = $_POST['ID_member'];

            // Perform actions with the submitted ID_member (for demonstration, just displaying it)
            echo "Submitted ID_member: " . $submittedID_member;

            // You can insert this username into a database, perform validation, or any other necessary processing here
        } else {
            echo "ID_member was not submitted!";
        }
    }
    ?>
    <form action="table/insert.php" method="post">
        <input type="hidden" id="ID_member" name="ID_member" value="<?php echo $submittedID_member?>">
        <div class="table-responsive-sm">
            <table class="table" id="myTable">
                <thead class="table-dark">
                    <tr>
                        <th>เลขที่</th>
                        <th>ชื่อ</th>
                        <th>จำนวน</th>
                        <th>ราคา</th>
                        <!--<th>รวม</th>-->
                    </tr>
                </thead>
                <tr>
                    <td>1</td>
                    <td><input type="text" name="B[]" value="Data 1B"></td>
                    <td><input id="a1" type="text" name="C[]" value="1"></td>
                    <td><input id="b1" type="text" name="D[]" value="1"></td>
                    <!--<td><input id="c1" type="text" name="E[]" value=""></td> -->
                </tr>
            </table>
        </div>
        <button type="button" id="addRowBtn" class="btn btn-primary" onclick="addRow()">Add Row</button>
        <button type="submit" class="btn btn-success">Insert to IndexedDB</button>
    </form>
    <script>
    let rowCount = 1; // Initial number of rows (change this if needed)

    function addRow() {
        rowCount++;
        <?php
    // Fetch the usernames from the database
    $usernames = []; // Assuming you fetched usernames from the database into this array
    ?>

        const usernames = <?php echo json_encode($usernames); ?>;
        const table = document.getElementById('myTable');
        const newRow = table.insertRow();

        const cell1 = newRow.insertCell();
        const cell2 = newRow.insertCell();
        const cell3 = newRow.insertCell();
        const cell4 = newRow.insertCell();
        // const cell5 = newRow.insertCell();




        cell1.innerHTML = `${rowCount}`;
        cell2.innerHTML = `<input type="text" name="B[]" value="Data ${rowCount}B">`;
        cell3.innerHTML = `<input type="text" id="a${rowCount}" name="C[]" value="1">`;
        cell4.innerHTML = `<input type="text" id="b${rowCount}" name="D[]" value="1">`;
        //cell5.innerHTML = `<input type="text" id="c${rowCount}"  name="E[]" value="">`;

        if (usernames.length >= rowCount) {
            const usernameCell = newRow.insertCell();
            usernameCell.innerHTML = usernames[rowCount - 1]; // Assign the username from the array
        }
    }
    </script>
    <!-- <script>
    $(document).ready(function() {
        $("input").keyup(function() {
            var suma = 0;
            var sumb = 4;
            $(this).parents("tr").children("td").children().each(function() {
                var enteredval = $(this).val();
                suma += parseInt($(this).children('#a').eq(2).text());
                sumb += parseInt(enteredval[0]);
            });
            $(this).parent().parent().children(":last").text($("#a").val() * $("#b").val());
            //$("#c").val($(this).children("#a").text())
        });
    });
    </script> -->

</body>

</html>