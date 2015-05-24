<?php

session_start();
require("db_connection.php");
include "login.php";

function updateUserInfo($conn, $userID, $newName, $newPassword, $newBio, $fileLoc) {
    $delete = $conn->prepare("CALL sp_updateUserInfo(:userId, :newName, :newPw, :newBio)");
    $delete->execute(array('userId' => $userID, 'newName' => $newName, 'newPw' => $newPassword, 'newBio' => $newBio));
}

function uploadFile($file) {
    // Praegu toetame ainult png faile. Lisaks määrame nimeks userid + .png
    // Peab uurima, kas see turvaline või mitte -> Eeldus, et pigem on
    file_put_contents("file.txt", $file["name"], FILE_APPEND);
    $target_dir = "/var/www/uploads/";
    $target_file = $target_dir . $_SESSION['UserID'].'png';
    $uploadOk = 1;
    $imageFileType = pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(!empty($_FILES["uploaded_file"]) && ($_FILES['uploaded_file']['error'] == 0)) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $check2 = is_image($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false && $check2 !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size - 1million Byte on siis limiit hetkel
    if ($_FILES["fileToUpload"]["size"] > 1000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats, doublecheck, but its ok
    if($imageFileType != "png") {
        echo "Sorry, only PNG files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            return $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

function is_image($path) {
    // imageInfo[0] annab width ja imageInfo[1] annab height
    $imageInfo = getimagesize($path);
    $image_type = $imageInfo[2];
    // Lisa siia veel tüüpe vajadusel - näiteks: IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP
    if(in_array($image_type , array(IMAGETYPE_PNG))) {
        return true;
    }
    return false;
}

if (isset($_POST)) {
    $loginStmt = $conn->prepare("SELECT Password, Filepath FROM Users WHERE ID = :uid");
    $loginStmt->execute(array('uid' => $_SESSION['UserID']));
    $result = $loginStmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($_POST['oldpw'], $result['Password'])){
        if ($_POST['newpw1']=="") {
            $cpass = $result['Password'];
        } else {
            if ($_POST['newpw1']===$_POST['newpw2']){
                $cpass = cryptpw($_POST['newpw1']);
            } else {
                die("newPassword1 and newPassword2 are not equal.");
            }
        }
        $user_ID = $_SESSION['UserID'];
        if (isset($_FILES)) {
            $newFile = uploadFile($_FILES["fileToUpload"]);
        } else {
            $newFile = $result["Filepath"];
        }
        updateUserInfo($conn, $user_ID, $_POST['nameChange'], $cpass, $_POST['bioChange'], $newFile);
    } else {
        die("Old password was wrong");
    }
} else {
    die("Need error handling here - updateUserInfo.php");
}
