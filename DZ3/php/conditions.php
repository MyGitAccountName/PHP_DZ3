<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="utf-8">
   <title>PHP 1. Условия</title>
   <link rel="stylesheet" href="../css/style.css">
</head>

<?php
    function showTaskList() {
        echo '
        <form action="conditions.php" method="POST" id="form1">
            <button class="task-button" type="submit" name="choose" value="1">Проверка на чётность</button>
            <button class="task-button" type="submit" name="choose" value="2">Большее из двух чисел</button>
            <button class="task-button" type="submit" name="choose" value="3">Модуль числа</button>
            <button class="task-button" type="submit" name="choose" value="4">Квадрат числа из диапазона</button>
            <button class="task-button" type="submit" name="choose" value="5">Вывод заголовка</button>
            <button class="task-button" type="submit" name="choose" value="6">Время года</button>
            <button class="task-button" type="submit" name="choose" value="7">Конвертер единиц памяти</button>
        </form>';
    }

    function isInteger($v1) {
        if (ctype_digit($v1) || (ctype_digit(substr($v1, 1)) && ((mb_substr($v1, $i, 1) == '-') || (mb_substr($v1, $i, 1) == '+')))) {
            return true;
        }
        return false;
    }

    function task1($v1) {
        echo '
            <h3>Проверка переменной на чётность</h3>
            <form action="conditions.php" method="POST">   
            <input class="variable" type="text" name = "var1" placeholder="Введите число">
            <button class="task-button" type="submit" name="do-it" value="1">Выполнить</button>
            <input class="task-button" type="button" value="Назад" onClick="document.location=\'conditions.php\'">
            </form>
            ';       
        if (!is_numeric($v1)) return $v1 ." - вообще не число!";
        else if (!isInteger($v1)) return $v1 ." - не целое число!";
        else if (substr($v1, -1) % 2 === 0) return $v1 ." - чётное число";
        else return $v1 ." - нечётное число";
    }

    function task2($v1,$v2) {
        echo '
            <h3>Большее из двух чисел</h3>
            <form action="conditions.php" method="POST">   
            <input class="variable" type="text" name = "var1" placeholder="Введите первое число">
            <input class="variable" type="text" name = "var2" placeholder="Введите второе число">
            <button class="task-button" type="submit" name="do-it" value="2">Выполнить</button>
            <input class="task-button" type="button" value="Назад" onClick="document.location=\'conditions.php\'">
            </form>
            ';       
        if (!(is_numeric($v1) && is_numeric($v2))) return "Ошибка в данных!";
        else if ($v1 > $v2) return $v1." больше ".$v2;
        else if ($v1 < $v2) return $v2." больше ".$v1;
        else return "числа равны";
    }
    
    function task3($v1) {
        echo '
            <h3>Модуль числа</h3>
            <form action="conditions.php" method="POST">   
            <input class="variable" type="text" name = "var1" placeholder="Введите число">
            <button class="task-button" type="submit" name="do-it" value="3">Выполнить</button>
            <input class="task-button" type="button" value="Назад" onClick="document.location=\'conditions.php\'">
            </form>
            ';
        if (!is_numeric($v1)) return $v1 ." - не число!";
        else if ($v1 > 0) return "| ".$v1." | = ".$v1;
        else return "| ".$v1." | = ".$v1*(-1);
    }
    
    function task4($v1,$v2,$v3) {
        echo '
            <h3>Квадрат числа из диапазона</h3>
            <form action="conditions.php" method="POST">
            <h4>Число для возведения в квадрат:</h4>
            <input class="variable" type="text" name = "var1" placeholder="Введите число">
            <h4>Границы диапазона:</h4>
            <label>Начало: <input class="variable" type="text" name = "var2"></label>
            <label>Конец:  <input class="variable" type="text" name = "var3"></label>
            <button class="task-button" type="submit" name="do-it" value="4">Выполнить</button>
            <input class="task-button" type="button" value="Назад" onClick="document.location=\'conditions.php\'">
            </form>
            ';
        if (!(is_numeric($v1) && is_numeric($v2) && is_numeric($v3))) return "Ошибка в данных!";
        else if ($v2 < $v3) {
            if ($v1 < $v2) return $v1." меньше ".$v2." на ".($v2-$v1);
            else if ($v1 > $v3) return $v1." больше ".$v3." на ".($v1-$v3);
            else return $v1."<sup>2</sup> = ".pow($v1,2);
        }
        else if ($v2 >= $v3) {
            if ($v1 < $v3) return $v1." меньше ".$v3." на ".($v3-$v1);
            else if ($v1 > $v2) return $v1." больше ".$v2." на ".($v1-$v2);
            else return $v1."<sup>2</sup> = ".pow($v1,2);
        }
    }

    function task5($v1) {
        echo '
            <h3>Вывод заголовка</h3>
            <form action="conditions.php" method="POST">
            <input class="variable" type="text" name = "var1" placeholder="Введите номер заголовка">
            <button class="task-button" type="submit" name="do-it" value="5">Выполнить</button>
            <input class="task-button" type="button" value="Назад" onClick="document.location=\'conditions.php\'">
            </form>
            ';
        if (!is_numeric($v1)) echo '<p class="result">'.$v1.' - не число!';
        else if (!isInteger($v1)) echo '<p class="result">'.$v1 .' - не целое число!';
        else if ($v1 < 1 || $v1 > 6) echo '<p class="result">Нельзя построить тег '.htmlspecialchars('<h'.$v1.'>');
        else echo '<div class="resTask5"><h'.$v1.'>Заголовок '.$v1.'</h'.$v1.'></div>';
    }

    function task6($v1,$v2) {
        $dayInMonth = 30;
        $season = "Лето. ";
        $half = "Середина";
        $names = ["января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря"];
        echo '
            <h3>Время года</h3>
            <form action="conditions.php" method="POST">
            <input class="variable" type="text" name = "var1" placeholder="Введите день (число)">
            <input class="variable" type="text" name = "var2" placeholder="Введите номер месяца">
            <button class="task-button" type="submit" name="do-it" value="6">Выполнить</button>
            <input class="task-button" type="button" value="Назад" onClick="document.location=\'conditions.php\'">
            </form>
            ';
        if (!isInteger($v1) || !isInteger($v2) || $v1 < 1 || $v2 < 1) return "Ошибка в данных!";
        else if ($v2 > 12) return "Нет такого месяца!";
        else {
            switch ($v2) {
                case 1:
                case 3:
                case 5:
                case 7:
                case 8:
                case 10:
                case 12:
                    $dayInMonth=31;
                    break;
                case 2:
                    $dayInMonth=29;
                    break;
            }
            if ($v1 > $dayInMonth) return $v1." - многовато дней для ".$names[--$v2]."!";
            else {
                switch ($v2) {
                    case 12:
                    case 1:
                    case 2:
                        $season = "Зима. ";
                        break;
                    case 3:
                    case 4:
                    case 5:
                        $season = "Весна. ";
                        break;
                    case 9:
                    case 10:
                    case 11:
                        $season = "Осень. ";
                        break;
                }
                if ($v1 < $dayInMonth/2) $half = "Первая половина";
                else if ($v1 > $dayInMonth/2) $half = "Втовая половина";
                return $v1." ".$names[--$v2].". ".$season.$half." месяца.";
            }
        }
    }

    function memory($num) {
        echo '
            <select class="variable" size="1" name="var'.$num.'">
            <option value="0">бит (б)</option>
            <option value="1">байт (Б)</option>
            <option value="2">килобайт (КБ)</option>
            <option value="3">мегабайт (МБ)</option>
            <option value="4">гигабайт (ГБ)</option>
            <option value="5">терабайт (ТБ)</option>
            <option value="6">петабайт (ПБ)</option>
            <option value="7">экзабайт (ЭБ)</option>
            <option value="8">зеттабайт (ЗБ)</option>
            <option value="9">йоттабайт (ЙБ)</option>
            </select>
        ';
    }
    function task7($v1,$v2,$v3) {
        $degrees = [-2,1,10,20,30,40,50,60,70,80];
        $names = ["б","Б","КБ","МБ","ГБ","ТБ","ПБ","ЭБ","ЗБ","ЙБ"];
        echo '
            <h3>Конвертер единиц памяти</h3>
            <form action="conditions.php" method="POST">
            <input class="variable" type="text" name = "var1" placeholder="Объём памяти">
            <h4>Перевод:</h4>
            <label>Из: ';
            memory(2);
            echo '</label>
            <label>В: ';
            memory(3);
            echo '</label>
            <button class="task-button" type="submit" name="do-it" value="7">Выполнить</button>
            <input class="task-button" type="button" value="Назад" onClick="document.location=\'conditions.php\'">
            </form>
        ';
        if (!is_numeric($v1)) return $v1 ." - не число!";
        else if ($v1 < 0) return $v1 ." - отрицательное число!";
        else return $v1." ".$names[$v2]." = ".$v1*pow(2,($degrees[$v2]-$degrees[$v3]))." ".$names[$v3];
    }
?>

<body>
    <?php
        include 'header.php';
        showHeader(1);
        echo "<h2>УСЛОВИЯ</h2>";
        if (empty($_POST)) {
            showTaskList();
        }
        if (isset($_POST["choose"])) {
            switch ($_POST['choose']) {
                case 1:
                    task1(0);
                    break;
                case 2:
                    task2(0,0);
                    break;
                case 3:
                    task3(0);
                    break;
                case 4:
                    task4(0,0,0,0);
                    break;
                case 5:
                    task5('1');
                    break;
                case 6:
                    task6(1,1);
                    break;
                case 7:
                    task7(1,1,1);
                    break;
            }
        }
        if (isset($_POST["do-it"])) {
            $data1 = $_POST['var1'];
            $data2 = $_POST['var2'];
            $data3 = $_POST['var3'];

            switch ($_POST["do-it"]) {
                case 1:
                    echo '<p class="result">'.task1($data1).'</p>';
                    break;
                case 2:
                    echo '<p class="result">'.task2($data1, $data2).'</p>';
                    break;
                case 3:
                    echo '<p class="result">'.task3($data1).'</p>';
                    break;
                case 4:
                    echo '<p class="result">'.task4($data1, $data2, $data3).'</p>';
                    break;
                case 5:
                    task5($data1);
                    break;
                case 6:
                    echo '<p class="result">'.task6($data1, $data2).'</p>';
                    break;
                case 7:
                    echo '<p class="result">'.task7($data1, $data2, $data3).'</p>';
                    break;
            }
        }
    ?>

</body>
</html>