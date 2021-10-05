<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="utf-8">
   <title>PHP 1. Циклы</title>
   <link rel="stylesheet" href="../css/style.css">
</head>

<?php
    function showTaskList() {
    echo $_SESSION['password'];
        echo '
        <form action="cycles.php" method="POST" id="form1">
            <button class="task-button" type="submit" name="do-it" value="1">Десять чётных чисел</button>
            <button class="task-button" type="submit" name="choose" value="2">Проверка числа на простоту</button>
            <button class="task-button" type="submit" name="do-it" value="3">Постоение эллипсов</button>
            <button class="task-button" type="submit" name="do-it" value="4">Четырёхзначные числа</button>
            <button class="task-button" type="submit" name="choose" value="5">Перевод числа в двоичную систему</button>
            <button class="task-button" type="submit" name="do-it" value="6">Шахматная доска</button>
        </form>';
    }

    function isInteger($v1) {
        if (ctype_digit($v1) || (ctype_digit(substr($v1, 1)) && ((mb_substr($v1, $i, 1) == '-') || (mb_substr($v1, $i, 1) == '+')))) {
            return true;
        }
        return false;
    }

    function task1() {
        $kol = 1;
        $tmp = 2;
        $sum = 0;
        $zap = ", ";
        $result = '';
        echo '<h3>Первые 10 чётных чисел:</h3>';
        while ($kol <= 10) {
            if ($kol===10) {
                $zap = ";";
            }
            $result = $result."<span style='font-size: ".($kol*5)."px; color: green;'>".$tmp.$zap."</span>";
            $sum += $tmp;
            $tmp += 2;
            $kol++;
        }
        return $result."<br><br>Сумма: ".$sum."<br>Среднее: ".($sum/10).'<br><br>
        <input class="task-button" type="button" value="Назад" onClick="document.location=\'cycles.php\'">
        ';
    }

    function task2($v1) {
        echo '
            <h3>Проверка числа на простоту</h3>
            <form action="cycles.php" method="POST">
            <input class="variable" type="text" name = "var1" placeholder="Введите число">
            <button class="task-button" type="submit" name="do-it" value="2">Выполнить</button>
            <input class="task-button" type="button" value="Назад" onClick="document.location=\'cycles.php\'">
            </form>
            ';
        if (!is_numeric($v1)) return $v1 ." - вообще не число!";
        else if ($v1 == 1) return $v1 ." - ни простое, ни составное число";
        else if (!isInteger($v1) || $v1 < 1) return $v1 ." - не натуральное число!";
        else {
            $j = 0;
            for ($i=1; $i<=$v1; $i++) {
                if ($v1%$i == 0) $j++;
                if ($j > 2) return $v1 ." - составное число";
            }
            return $v1 ." - простое число";
        }
    }

    function task3() {
        $diam = 20;
        echo '
            <style>
            .circle {
                position:absolute;
                display:block;
                top: 50px;
                left: 46%;
                border-radius: 50%;
                border: 1px solid #5656DF;
            }
            </style>
            <h3>Постоение эллипсов разных диаметров</h3>
            <div class="result" style="position: relative; height: 250px;">';
        for ($i = 0; $i < 10; $i++) {
            echo'<div class="circle" style="width: '.($diam+15*$i).'px; height: '.($diam+15*$i).'px;"></div>';
        }
        echo '</div>';
        echo '<input class="task-button" style="display:block; margin: 0 auto;" type="button" value="Назад" onClick="document.location=\'cycles.php\'">';
    }

    function task4() {
        $f1 = 0;
        $f2 = 0;
        echo '<h3>Четырёхзначные числа</h3>';
        for ($i = 1000; $i < 10000; $i++) {
            $symbols = str_split(strval($i));
            if (($symbols[0] == $symbols[1]) && ($symbols[0] == $symbols[2]) && ($symbols[0] == $symbols[3])) {
                $f2++;
                continue;
            }
            $k = 0;
            for ($j = 0; $j < 3; $j++) {
                if (substr_count(strval($i), $symbols[$j]) > 1) break;
                $k++;
            }
            if ($k == 3) $f1++;
        }
        return "<br>со всеми разными цифрами: ".$f1."<br><br>со всеми одинаковыми цифрами: ".$f2.'<br><br>
        <input class="task-button" type="button" value="Назад" onClick="document.location=\'cycles.php\'">
        ';
    }

    function reverse($num, $bit) {
        for ($i = 0; $i < $bit; $i++) {
            if ($num[$i] == '0') $num[$i] = '1';
            else $num[$i] = '0';
        }
        return $num;
    }

    function task5($v1) {
        echo '
            <h3>Перевод числа в двоичную систему</h3>
            <form action="cycles.php" method="POST">
            <input class="variable" type="text" name = "var1" placeholder="Введите число">
            <button class="task-button" type="submit" name="do-it" value="5">Выполнить</button>
            <input class="task-button" type="button" value="Назад" onClick="document.location=\'cycles.php\'">
            </form>
            ';
        if (!is_numeric($v1)) return $v1 ." - не число!";
        else {
            $bit = 16;
            $a = abs($v1);
            for ($i = 0; $i < $bit; $i++) {
                $result[$i] = '0';
            }

            $i = $bit-1;
            while ($a > 1) {
                $result[$i] = strval($a%2);
                $a = floor($a/2);
                $i--;
            }
            $result[$i] = $a;
        }
        if ($v1 < 0) {
            $obr = reverse($result, $bit);
            $d = '1';
            for ($i = ($bit-1); $i >= 0; $i--) {
                if ($obr[$i] == '0') {
                    $obr[$i] = $d;
                    $d = '0';
                }
                else {
                    if ($d == '1') $obr[$i] = '0';
                }
            }
            $result = $obr;
        }
        return $v1."<sub>10</sub> = ".join('',$result)."<sub>2</sub>";
    }

    function task6() {
        $white = true;
        echo '
            <h3>Шахматы</h3>
            <table class="chess">';
            for ($i = 0; $i < 8; $i++)
            {
                echo '<tr>';
                for ($j = 0; $j < 8; $j++) {
                    if ($white) $boxColor = '#E4BE8E';
                    else $boxColor = '#000000';
                    if ($i == 0) {
                        switch ($j) {
                            case 0:
                            case 7:
                                $figure = "w_l";
                                break;
                            case 1:
                            case 6:
                                $figure = "w_h";
                                break;
                            case 2:
                            case 5:
                                $figure = "w_s";
                                break;
                            case 3:
                                $figure = "w_q";
                                break;
                            case 4:
                                $figure = "w_f";
                                break;
                        }
                    }
                    else if ($i == 1) $figure = "w_p";
                    else if ($i == 6) $figure = "b_p";
                    else if ($i == 7) {
                        switch ($j) {
                            case 0:
                            case 7:
                                $figure = "b_l";
                                break;
                            case 1:
                            case 6:
                                $figure = "b_h";
                                break;
                            case 2:
                            case 5:
                                $figure = "b_s";
                                break;
                            case 3:
                                $figure = "b_q";
                                break;
                            case 4:
                                $figure = "b_f";
                                break;
                        }
                    }
                    else $figure = "";
                    echo '<td class="chess-box figure '.$figure.'" style = "background-color:'.$boxColor.';"></td>';
                    $white = (!$white);
                }
                $white = (!$white);
            }
            echo '</table>
        ';
        echo '<input class="task-button" style="display:block; margin: 0 auto;" type="button" value="Назад" onClick="document.location=\'cycles.php\'">';
    }
?>

<body>
    <?php
        include 'header.php';
        showHeader(2);
        echo "<h2>ЦИКЛЫ</h2>";
        if (empty($_POST)) {
            showTaskList();
        }
        if (isset($_POST["choose"])) {
            echo '<script> document.getElementById("form1").style.display = "none"; </script>';
            switch ($_POST['choose']) {
                case 2:
                    task2(0);
                    break;
                case 4:
                    task4();
                    break;
                case 5:
                    task5(1);
                    break;
            }
        }
        if (isset($_POST["do-it"])) {
            $data1 = $_POST['var1'];

            switch ($_POST["do-it"]) {
                case 1:
                    echo '<p class="result">'.task1().'</p>';
                    break;
                case 2:
                    echo '<p class="result">'.task2($data1).'</p>';
                    break;
                case 3:
                    task3();
                    break;
                case 4:
                    echo '<p class="result">'.task4().'</p>';
                    break;
                case 5:
                    echo '<p class="result">'.task5($data1).'</p>';
                    break;
                case 6:
                    task6();
                    break;
            }
        }
    ?>
</body>
</html>