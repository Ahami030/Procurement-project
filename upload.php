<?php 
include_once 'connect.php';
session_start();
$targetDir = "upload/";
$e = $_POST['email'];
$id = $_SESSION['member_id'];

if(isset($_POST['submit'])){
    if(!empty($_FILES["file"]["name"])){
        $fileType = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $fileName = date('Y-m-d-H-i-s') . '.' . $fileType;
        $targetFilePath = $targetDir . $fileName;

        $allowType = array('pdf');
        if(in_array($fileType, $allowType)){
            if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){

                // เพิ่ม query สำหรับการ insert ข้อมูล unseen เข้าไปในตาราง notification
                $insertNotification = $db->query("INSERT INTO notification(qt_seen, ID_member) VALUES ('unseen', '$id')");

                $insertstate = $db->query("INSERT INTO state(state_1, state_2, state_3, ID_member) VALUES ('2','1','0', '$id')");

                $insertImage = $db->query("INSERT INTO images(file_name, upload_on, email , ID_member , STATUS) VALUES ('".$fileName."', NOW(), '$e' ,'$id' ,'0')");

                if($insertImage && $insertNotification&& $insertState){
                    echo "<script>alert('The file ".$fileName." has been uploaded.');</script>";
                    header("location:main%20clienttest.php");
                } else {
                    echo "<script>alert('The file ".$fileName." failed to upload.');</script>";
                    header("location:main%20clienttest.php");
                }
            } else {
                echo "<script>alert('There was an error uploading your file.');</script>";
                header("location:main%20clienttest.php");
            }
        } else {
            echo "<script>alert('Please upload only PDF files.');</script>";
            header("location:main%20clienttest.php");
        }
    } else {
        echo "<script>alert('Please choose a file to upload.');</script>";
        header("location:main%20clienttest.php");
    }
}
?>
