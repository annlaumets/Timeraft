<?php
// Just a script to go over all lines and update passwords

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

$rowsStmt = $conn->prepare("SELECT ID, Password FROM Users WHERE ID < 100");
$rowsStmt->execute();
$rows = $rowsStmt -> fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row) {
    $cpass = cryptpw($row['Password']);
    $rehashSttmt = $conn -> prepare("CALL sp_reHash_change_passw(:cpass, :id);");
    $rehashSttmt -> execute(array('cpass' => $cpass, 'id' => $row['ID']));
}

echo("done");