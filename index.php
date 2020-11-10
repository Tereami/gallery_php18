<?php
session_start();

if (isset($_GET['exit'])) {
    session_destroy();
    header('location: /');
}

$curFolder = __DIR__;
$imagesFolder = $curFolder . '/uploads';
$previewsFolder = $imagesFolder . '/preview/';
$allFiles = scandir($previewsFolder);
$previewImages = array_diff($allFiles, array('.', '..'));
//var_dump($previewImages);
?>

<html>

<head>
    <title>Галерея</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>



<body>
    <header>
        <div class="logo">Галерея</div>
        <div class="userinfo">Пользователь:
            <?php if (empty($_SESSION['auth'])) : ?>
                Нет (<a href="loginform.php">Вход</a> <a href="reg.php">Регистрация</a>)  
            <?php else : ?>
                <?php echo $_SESSION['username']; ?>
                <a href="?exit=1"> Выйти </a>
            <?php endif; ?>
        </div>
    </header>
    <div class="gallery">
        <?php foreach ($previewImages as $previewImage) : ?>
            <div class="previewImageDiv">
                <a href="view.php?id=<?php echo $previewImage ?>">
                    <img class="previewImageImg" src="<?php echo "\uploads\\preview\\" . $previewImage ?>">
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <center>
        <a href="add.php">Добавить картинки</a>
    </center>

</body>

</html>