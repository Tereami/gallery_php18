<?php

$errors = [];

if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password2'])) {
    require_once("checkUser.php");
    if (checkUserExists($_POST['login'])) {
        $errors[] = "Такой пользователь уже зарегистрирован! Выберите другой логин";
    } else if ($_POST['password'] !== $_POST['password2']) {
        $errors[] = "Пароли не совпадают!";
    } else {
        //var_dump($_POST);
        $addResult = addUser($_POST['login'], $_POST['password']);
        var_dump($addResult);
        if ($addResult === true) {
            header('location: loginform.php');
        } else {
            $errors[] = $addResult;
        }
    }
}

?>

<html>

<head>
    <title>Регистрация</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>



<body>
    <div class="container">
        <div class="formblock">
            <h2>Регистрация</h2>
            <?php foreach ($errors as $error) {
                echo "<div class=\"alert\">$error</div>";
            } ?>

            <form method="POST" action="reg.php">
                <input type="text" name="login" placeholder="Ваш логин">
                <input type="password" name="password" placeholder="Ваш пароль">
                <input type="password" name="password2" placeholder="Повторите пароль">
                <input type="submit" value="Зарегистрироваться">
            </form>
        </div>
    </div>
</body>

</html>