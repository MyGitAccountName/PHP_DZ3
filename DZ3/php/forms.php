<?php
   session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="utf-8">
   <title>PHP 1. Формы</title>
   <link rel="stylesheet" href="../css/style.css">
</head>

<?php
    function login() {
        echo '
        <form action="forms.php" method="POST" id="login">
            <h2>Авторизация</h2>
            <label><input class="variable" type="text" name = "var1" placeholder="Логин:" title = "Правильный: login"></label>
            <label><input class="variable" type="password" name = "var2" placeholder="Пароль:" title = "Правильный: password"></label>
            <button class="task-button" type="submit" name="login" value="1">Войти</button>
            <button class="task-button" type="submit" name="login" value="2">Зарегистрироваться</button>
        </form>';
    }

    function logout() {
        echo '
        <form action="forms.php" method="POST" id="logout">
            <h2>Авторизация</h2>
            <h1 class="userName">'.$_SESSION["login"].'</h1>
            <button class="task-button" type="submit" name="logout" value="1">Выйти</button>
        </form>';
    }

    function showFormReg($errors) {
        if ($errors == 'ok') {
            echo '<h1 class="userName">'.$_SESSION["login"].'</h1>';
            echo '<p class="result"><br>Добро пожаловать на сайт!</p>
            <input class="task-button" style="display:block; margin: 20px auto 0;" type="button" value="Назад" onClick="document.location=\'../index.php\'">';
        }
        else {

        $names = [['login','text','Логин'],['password','password','Пароль'],['confirm','password','Подтвердите пароль'],['email','text','Email'],['phone','text','Телефон']];
        echo '
        <form action="forms.php" method="POST" id="register">
            <h2>Регистрация</h2>';

        for ($i=0; $i<5; $i++) {
            if ($errors[$i+1] != '') $errClass = ' err';
            else $errClass = '';
            echo '<label class="v'.($i+1).'"><input class="variable reg-'.$names[$i][0].$errClass.'" type="'.$names[$i][1].'" name = "var'.($i+1).'" placeholder="'.$names[$i][2].':">'.$errors[$i+1].'</label>';
        }

        echo '<button class="task-button" type="submit" name="register" value="1">Зарегистрироваться</button>
            <input class="task-button" type="button" value="Назад" onClick="document.location=\'forms.php\'">';
            echo '<p class="result" style = "color: red !important;"><br>'.$errors[0].'</p>
        </form>';
        }
    }

    function register($login, $password, $confirm, $email, $phone)
    {
        $errList = [];
        $login = trim(htmlspecialchars($login));
        $password = trim(htmlspecialchars($password));
        $confirm = trim(htmlspecialchars($confirm));
        $email = trim(htmlspecialchars($email));
        $phone = str_replace(['-','(',')',' '],'',$phone);

        if ($login == '' || $password == '' || $confirm == '' || $email == '' || $email == '') {
            $errList[0] = 'Заполните все поля!';
        }
        if (strlen($login) < 3 || strlen($login) > 30) {
            $errList[1] = 'Длина логина от 3 до 30 символов!';
        }
        if (strlen($password) < 6 || strlen($password) > 25) {
            $errList[2] = 'Длина пароля от 6 до 25 символов!';
        }
        if ($password != $confirm) {
            $errList[3] = 'Неверный пароль!';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errList[4] = 'Некорректный адрес!';
        }
        if (!is_numeric($phone) || strlen($phone) != 10) $errList[5] = 'Некорректный номер!';

        $file = fopen("data.txt", "a+"); //a+ открыть файл для записи в конец.
        // $file - дескриптор файла
        if (array_filter($errList, function ($v) { return $v !== null; } ) == false) {
            while($string = fgets($file))
            {
                $dataLogin = substr($string, 0, strpos($string,":"));
                if ($dataLogin == $login) {
                    $errList[1] = 'Пользователь с таким именем зарегистрирован!';
                    return $errList;
                }
            }
            $dataString = $login.":".md5($password).":".$email."\n";
            fputs($file, $dataString);
            $_SESSION['authorization'] = true;
            $_SESSION['login'] = $login;
            return 'ok';
        }
        return $errList;
    }

    function checkLP($login, $password) {
        $login = trim(htmlspecialchars($login));
        $password = md5(trim(htmlspecialchars($password)));
        $file = fopen("data.txt", "r");
        while($string = fgets($file))
        {
            $dataLogin = substr($string, 0, strpos($string,":"));
            if ($dataLogin == $login) {
                $dataPassword = substr($string, strlen($dataLogin)+1, strpos($string,":",strlen($dataLogin)+1)-(strlen($dataLogin)+1));
                if ($dataPassword == $password) return true;
            }
        }
        return false;
    }
?>

<body>
    <?php
        include 'header.php';
        showHeader(4);
        $goodLogin = "login";
        $goodPass = "password";
        if (empty($_POST)) {
            if (!$_SESSION['authorization']) login();
            else logout();
        }
        else if ($_POST['logout'] == 1)
        {
            login();
            $_SESSION = array();
        }
        else if ($_POST['login'] == 1)
        {
            if (($_POST['var1'] == $goodLogin && $_POST['var2'] == $goodPass) ||
            checkLP($_POST['var1'],$_POST['var2'])) {
                $_SESSION['login'] = $_POST['var1'];
                $_SESSION['authorization'] = true;
                echo '<h1 class="userName">'.$_SESSION["login"].'</h1>';
                echo '<p class="result"><br>Добро пожаловать на сайт!</p>
                <input class="task-button" style="display:block; margin: 20px auto 0;" type="button" value="Назад" onClick="document.location=\'../index.php\'">';
            }
            else {
                login();
                $_SESSION['authorization'] = false;
                echo '<p class="result" style = "color: red !important;"><br>Неверные данные!</p>
                <form action="forms.php" method="POST" id="login2">
                <p class="result" style = "font-size: 20px !important;">Повторите попытку или пройдите
                <button class="a-button" type="submit" name="login" value="2">регистрацию</button>.</p>
                </form>';
            }
        }
        else if ($_POST['register'] == 1) {
            $login = $_POST['var1'];
            $password = $_POST['var2'];
            $confirm = $_POST['var3'];
            $email = $_POST['var4'];
            $phone = $_POST['var5'];
            showFormReg(register($login, $password, $confirm, $email, $phone));
        }
        else showFormReg([]);
    ?>
</body>
</html>