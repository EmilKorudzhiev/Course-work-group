<?php
require('database_connection.inc.php');

$email = $_POST["email"];
$password = hash("sha256",$_POST["password"]);

$sqlSelectUser = '
SELECT * FROM users WHERE email = (?) AND password = (?);
';

$result = $connection -> prepare($sqlSelectUser);
$result -> execute([$email, $password]);
$userInfo = $result -> fetchAll();
if($userInfo){
    echo "Log in successful";
    $_SESSION["USER"] = [$userInfo[0]["first_name"], $userInfo[0]["last_name"], $userInfo[0]["phone"], $userInfo[0]["email"], $userInfo[0]["picture"] ];
}else{
    echo "Password or Email is incorrect";
}
?> 