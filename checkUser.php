<?php
const SOL = "gbg789gbg";

function createDbConnectLink() {
    $upFolder = dirname(__DIR__);
    $dbFilePath = $upFolder . '/' . "dbconnect.txt";
    $connectData = file($dbFilePath, FILE_IGNORE_NEW_LINES);
    $dbip = $connectData[0];
    $dblogin = $connectData[1];
    $dbpass = $connectData[2];
    $dbname = $connectData[3];
    $link = mysqli_connect($dbip, $dblogin, $dbpass, $dbname);
    return $link;
}

function readDB($login)
{
    $link = createDbConnectLink();
    $sql = "SELECT id, login, password FROM users WHERE login = '$login'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row;
}

function checkUserExists($login)
{
    $row = readDB($login);
    if (empty($row)) {
        return false;
    }
    return true;
}

function checkUserPassword($login, $password)
{
    $cryptPass = crypt($password, SOL);
    $row = readDB($login);
    if ($row['password'] == $cryptPass) {
        return true;
    }
    return false;
}
function addUser($login, $password)
{
    $cryptPass = crypt($password, SOL);
    try {
        $link = createDbConnectLink();
        $queryInsertClient = "INSERT INTO `users` (login,password) VALUES ('$login', '$cryptPass');";
        mysqli_query($link, $queryInsertClient) or die("DB ERROR " . mysqli_error($link));
        return true;
    } catch (Exception $e) {
        return $e->getMessage();
    }
    return false;
}


