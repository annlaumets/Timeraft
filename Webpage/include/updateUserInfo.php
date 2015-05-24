<?php

session_start();
require("db_connection.php");

function cryptpw($password) {
    // Change these options for more security, right now generating new salt automatically
    $options = [
        // 'salt' => custom_function_for_salt(), //write your own code to generate a suitable salt
        'cost' => 11 // the default cost is 10
    ];
    return $hash = password_hash($password, PASSWORD_DEFAULT, $options);
}

function updateUserInfo($conn, $userID, $newName, $newPassword, $newBio, $filePath) {
    $updateStmt = $conn->prepare("CALL sp_updateUserInfo(:userId, :newName, :newPw, :newBio, :filepath)");
    $updateStmt->execute(array('userId' => $userID, 'newName' => $newName, 'newPw' => $newPassword, 'newBio' => $newBio, 'filepath' => $filePath));
    file_put_contents("file4.txt", $filePath, FILE_APPEND);
}

function uploadFile($file) {
    // Praegu toetame ainult png faile. Lisaks määrame nimeks userid + .png
    // Peab uurima, kas see turvaline või mitte -> Eeldus, et pigem on
    file_put_contents("file.txt", $file["name"], FILE_APPEND);
    $target_dir = "/var/www/html/timeraft/Webpage/images/uploads/";
    $target_file = $target_dir . $_SESSION['UserID'].'.png';
    $uploadOk = 1;
    $imageFileType = pathinfo($_FILES["fileChange"]["name"],PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(!empty($_FILES["fileChange"]) && ($_FILES['fileChange']['error'] == 0)) {
        $check = getimagesize($_FILES["fileChange"]["tmp_name"]);
        $check2 = is_image($_FILES["fileChange"]["tmp_name"]);
        if($check !== false && $check2 !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size - 1million Byte on siis limiit hetkel
    if ($_FILES["fileChange"]["size"] > 1000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats, doublecheck, but its ok
    if($imageFileType != "png" && $imageFileType != "PNG") {
        file_put_contents("file3.txt", "imagefiletype: ". $imageFileType, FILE_APPEND);
        echo "Sorry, only PNG files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileChange"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileChange"]["name"]). " has been uploaded.";
            file_put_contents("file3.txt", $target_file, FILE_APPEND);
            return $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
            die();
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
        file_put_contents("file2.txt", $_FILES["fileChange"]["name"], FILE_APPEND);
        $user_ID = $_SESSION['UserID'];
        if ($_FILES["fileChange"]["name"] !== "") {
            echo $_FILES["fileChange"]["name"];
            $newFile = uploadFile($_FILES["fileChange"]);
        } else {
            $newFile = $result["Filepath"];
        }
        updateUserInfo($conn, $user_ID, $_POST['nameChange'], $cpass, $_POST['bioChange'], $newFile);
        header("Location: /settings.php");
        exit;
    } else {
        die("Old password was wrong");
    }
} else {
    die("Need error handling here - updateUserInfo.php");
}
