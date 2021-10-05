<?php
   session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="utf-8">
   <title>PHP 1. Галерея</title>
   <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
        if (!$_SESSION['authorization']) {
            echo '<p class="result" style="color: red !important;">Для добавления изображений необходима
            <a href="forms.php" class="register-a">авторизация</a>!</p>';
        }
        else {
            if (isset($_POST['upd_button'])) {
                if ($_FILES['image']['error'] != 0)
                {
                    echo '<p class="result" style="color: red !important;">Ошибка '.$_FILES['image']['error'].' при чтении файла</p>';
                }
                if (is_uploaded_file($_FILES['image']['tmp_name']))
                {
                    move_uploaded_file($_FILES['image']['tmp_name'], '../image/Gallery/'.$_FILES['image']['name']);
                    echo '<p class="result">Файл успешно загружен</p>';
                }
            }
            echo'
                <form action = "upload.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="image" id="uploadFile">
                    <button type="submit" class="task-button" name="upd_button" value="1">
                        Отправить файл
                    </button>
                    <input class="task-button" type="button" value="Назад" onClick="document.location=\'gallery.php\'">
                </form>
            ';
        }
    ?>
</body>
</html>