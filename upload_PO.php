<?php
include_once 'connect.php';
session_start();

$targetDir = "upload_PO/";
$e = $_POST['email2'];
$id = $_SESSION['member_id'];

if (isset($_POST['submit2'])) {
    if (!empty($_FILES["file2"]["name"])) {  // Corrected file input name
        $fileType = pathinfo($_FILES["file2"]["name"], PATHINFO_EXTENSION);  // Corrected file input name
        $fileName = date('Y-m-d-H-i-s') . '.' . $fileType;
        $targetFilePath = $targetDir . $fileName;

        $allowType = array('pdf');
        if (in_array($fileType, $allowType)) {
            if (move_uploaded_file($_FILES['file2']['tmp_name'], $targetFilePath)) {  // Corrected file input name
                $insertNotificationPO = $db->query("INSERT INTO notification_po(qt_seen, ID_member) VALUES ('unseen', '$id')");
                $insertstate = $db->query("INSERT INTO state_po(state_1, state_2, state_3, ID_member) VALUES ('2','1','0', '$id')");
                $insertImage = $db->query("INSERT INTO po(file_name, upload_on, email, ID_member, STATUS) VALUES ('$fileName', NOW(), '$e', '$id','0')");

                if ($insertImage) {
                    echo "<script>alert('The file $fileName has been uploaded.');</script>";
                    header("location: main clienttest.php");
                    exit();  // Added exit to stop script execution after header redirect
                } else {
                    echo "<script>alert('The file $fileName failed to upload.');</script>";
                    header("location: main clienttest.php");
                    exit();  // Added exit to stop script execution after header redirect
                }
            } else {
                echo "<script>alert('There was an error uploading your file.');</script>";
                header("location: main clienttest.php");
                exit();  // Added exit to stop script execution after header redirect
            }
        } else {
            echo "<script>alert('Please upload only PDF files.');</script>";
            header("location: main clienttest.php");
            exit();  // Added exit to stop script execution after header redirect
        }
    } else {
        echo "<script>alert('Please choose a file to upload.');</script>";
        header("location: main clienttest.php");
        exit();  // Added exit to stop script execution after header redirect
    }
}
?>
