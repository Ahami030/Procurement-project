<!DOCTYPE html>
<html>

<head>
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
    <form action="table/insert_PO.php" method="post">
    <input type="hidden" id="ID_member" name="ID_member" value="<?php echo $submittedID_member?>">
        <table id="myTable">

            <tr>

                <th>เลขที่</th>
                <th>ชื่อ</th>
                <th>ราคา</th>
            </tr>
            <tr>
                <td>1</td>
                <td><input type="text" name="B[]" value="Data 1B"></td>
                <td><input type="text" name="C[]" value="1"></td>
            </tr>
        </table>

        <button type="button" id="addRowBtn" onclick="addRow()">Add Row</button>
        <button type="submit">Insert to IndexedDB</button>
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




        cell1.innerHTML = `${rowCount}`;
        cell2.innerHTML = `<input type="text" name="B[]" value="Data ${rowCount}B">`;
        cell3.innerHTML = `<input type="text" name="C[]" value=" ${rowCount}">`;
        if (usernames.length >= rowCount) {
            const usernameCell = newRow.insertCell();
            usernameCell.innerHTML = usernames[rowCount - 1]; // Assign the username from the array
        }
    }
    </script>
</body>

</html>