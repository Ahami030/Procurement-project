<?php
// foreach($_POST as $test)
// {
//     if(is_array($test))
//     {
//         foreach ($test as $test2) {
            
//             $sql = "INSERT INTO product (Name, ID_member) VALUES ('$test2', '$id')";
//             $result = mysqli_query($conn, $sql);

//             if ($result) {
//                 echo "Data inserted successfully: $test2, $id<br>";
//             } else {
//                 echo "Error: " . mysqli_error($conn);
//             }
//         }
//     }
// }

include 'table_connect.php';
session_start();
$id = $_POST['ID_member'];

foreach ($_POST['B'] as $key => $value) {
    $value;
    $value2 = $_POST['C'][$key];
    $value3 = $_POST['D'][$key];

    
    // Get the current date and time
    $currentDateTime = date('Y-m-d H:i:s');

    // Modify the SQL query to include the current timestamp
    $sql = "INSERT INTO product (Name, quantity, Price, ID_member, created_at) VALUES ('$value', '$value2', '$value3', '$id', '$currentDateTime')";
    
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Error inserting data: " . mysqli_error($conn);
        exit();
    }

    // Update the state table
    $updateState = mysqli_query($conn, "UPDATE state SET state_1 = '2', state_2 = '2', state_3 = '2' WHERE ID_member = '$id'");

  

    if (!$updateState) {
        echo "Error updating state: " . mysqli_error($conn);
        exit();
    }

    $updateStatus1 = mysqli_query($conn, "UPDATE images SET STATUS = '1' WHERE ID_member = '$id'");

    // Correct the variable name in the if condition
    if (!$updateStatus1) {
        echo "Error updating state: " . mysqli_error($conn);
        exit();
    }
}

header('Location: /pj%20main/pricing.php?g=B2');
exit();
?>
