<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="utf-8">
   <title>PHP 1. Массивы</title>
   <link rel="stylesheet" href="../css/style.css">
</head>

<?php
    function showTaskList() {
        echo '
        <form action="arrays.php" method="POST" id="form1">
            <button class="task-button" type="submit" name="choose" value="1">Основы работы с массивами</button>
            <button class="task-button" type="submit" name="choose" value="2">Количества повторов элементов массива</button>
            <button class="task-button" type="submit" name="do-it" value="3">Многомерные / ассоциативные массивы</button>
            <button class="task-button" type="submit" name="choose" value="4">Список стран</button>
            <button class="task-button" type="submit" name="do-it" value="5">Интернет-ресурсы</button>
        </form>';
    }

    function task1($v1) {
        echo '
            <h3>Основы работы с массивами</h3>
            <form action="arrays.php" method="POST">
            <input class="variable" type="text" name = "var1" placeholder="Введите 10 чисел через запятую">
            <button class="task-button" type="submit" name="do-it" value="1">Выполнить</button>
            <input class="task-button" type="button" value="Назад" onClick="document.location=\'arrays.php\'">
            </form>
            ';
        $numbers = explode(',',$v1);
        if (count($numbers) != 10) return "Количество элементов не равно 10!";
        foreach ($numbers as $i) {
            if (!is_numeric($i)) return "Некоторые элементы - не числа!";
        }
        $result = '';
        foreach ($numbers as $i) {
            if ($i%2 == 0) {
                if ($result == '') $result = "Чётные числа из массива: ".$i;
                else $result = $result.', '.$i;
            }
        }
        if ($result != '') $result = $result.';';
        else $result = "В массиве нет чётных чисел.";
        $result = "Исходный массив: [".join(', ',$numbers)."];<br><br>".$result;
        sort($numbers);
        $result = $result."<br>Максимальное значение: ".max($numbers).";";
        $result = $result."<br>Минимальное значение: ".min($numbers).";";
        $result = $result."<br><br>Массив после сортировки: [".join(', ',$numbers)."];";
        return $result;
    }

    function task2($v1) {
        echo '
            <h3>Количества повторов элементов массива</h3>
            <form action="arrays.php" method="POST">
            <input class="variable" type="text" name = "var1" placeholder="Введите 10 чисел через запятую">
            <button class="task-button" type="submit" name="do-it" value="2">Выполнить</button>
            <input class="task-button" type="button" value="Назад" onClick="document.location=\'arrays.php\'">
            </form>
        ';
        $numbers = explode(',',$v1);
        if (count($numbers) != 10) return "Количество элементов не равно 10!";
        foreach ($numbers as $i) {
            if (!is_numeric($i)) return "Некоторые элементы - не числа!";
        }
        $result = "Исходный массив: [".join(', ',$numbers)."];<br>";
        $uniqNumbers = array_unique($numbers);
        foreach ($uniqNumbers as $i) {
            $kol = 0;
            foreach ($numbers as $j) {
                if ($i == $j) $kol++;
            }
            switch ($kol) {
                case 2:
                case 3:
                case 4:
                    $end = 'а';
                    break;
                default: $end = '';
            }
            if ($kol == 1) $color = 'red';
            else $color = 'blue';
            $result = $result.'<span style="font-size: 20px; color: '.$color.'">
            Число <span style="font-weight: bold">'.$i.'</span> повторяется '.$kol.' раз'.$end.';
            <br></span>';
        }
        return $result;
    }

    function task3() {
        echo '<h3>Многомерные / ассоциативные массивы</h3><p class="result">Список фруктов:</p>';
        $fruits = [
            ["name" => "Персик", "type" => "Косточковые", "price" => 221.49, "weight"  => 1.2],
            ["name" => "Груша", "type" => "Семечковые", "price" => 149.99, "weight"  => 2.49],
            ["name" => "Банан", "type" => "Тропические", "price" => 109.99, "weight"  => 4.12],
            ["name" => "Помело", "type" => "Цитрусовые", "price" => 219.99, "weight"  => 1.44],
            ["name" => "Апельсин", "type" => "Цитрусовые", "price" => 136.89, "weight"  => 3.33],
            ["name" => "Манго", "type" => "Тропические", "price" => 189.99, "weight"  => 0.95],
            ["name" => "Яблоко", "type" => "Семечковые", "price" => 99.99, "weight"  => 5.23],
            ["name" => "Слива", "type" => "Косточковые", "price" => 149.99, "weight"  => 3.19],
            ["name" => "Грейпфрут", "type" => "Цитрусовые", "price" => 199, "weight"  => 4.61],
            ["name" => "Ананас", "type" => "Тропические", "price" => 252.69, "weight"  => 2.13]
        ];
        echo '
            <table class="fruits">
                <tr>
                    <th>Название</th>
                    <th>Тип</th>
                    <th>Цена за кг (руб)</th>
                    <th>Масса (кг)</th>
                    <th>Общая стоимость (руб)</th>
                </tr>';
        $total = 0;
        foreach ($fruits as $fruit) {
            switch ($fruit["type"]) {
                case "Косточковые":
                    $className = "fr-k";
                    break;
                case "Цитрусовые":
                    $className = "fr-c";
                    break;
                case "Тропические":
                    $className = "fr-t";
                    break;
                case "Семечковые":
                    $className = "fr-s";
                    break;
            }
            echo '
                <tr class="'.$className.'">
                    <td>'.$fruit["name"].'</td>
                    <td>'.$fruit["type"].'</td>
                    <td>'.$fruit["price"].'</td>
                    <td>'.$fruit["weight"].'</td>
                    <td>'.round(($fruit["price"]*$fruit["weight"]),2).'</td>
                </tr>';
            $total += round(($fruit["price"]*$fruit["weight"]),2);
        }
        echo '<tr class="total"><td colspan=4>ИТОГО:</td><td>'.$total.'</td></tr></table>

        <p class="result">из них цитрусовые:</p>
            <table class="fruits">
                <tr>
                    <th>Название</th>
                    <th>Тип</th>
                    <th>Цена за кг (руб)</th>
                    <th>Масса (кг)</th>
                    <th>Общая стоимость (руб)</th>
                </tr>';
        $total = 0;
        foreach ($fruits as $fruit) {
            if ($fruit["type"] == "Цитрусовые") {
                $className = "fr-c";
                echo '
                    <tr class="'.$className.'">
                        <td>'.$fruit["name"].'</td>
                        <td>'.$fruit["type"].'</td>
                        <td>'.$fruit["price"].'</td>
                        <td>'.$fruit["weight"].'</td>
                        <td>'.round(($fruit["price"]*$fruit["weight"]),2).'</td>
                    </tr>';
                $total += round(($fruit["price"]*$fruit["weight"]),2);
            }
        }
        echo '<tr class="total"><td colspan=4>ИТОГО:</td><td>'.$total.'</td></tr></table>';
        echo '<input class="task-button" style="display:block; margin: 20px auto 0;" type="button" value="Назад" onClick="document.location=\'arrays.php\'">';
    }

    function task4($v1) {
        $countries = [
            ["name" => "Острова Питкэрн", "population" => 49],
            ["name" => "Ватикан", "population" => 605],
            ["name" => "Токелау", "population" => 1499],
            ["name" => "Ниуэ", "population" => 1618],
            ["name" => "Монтсеррат", "population" => 2074],
            ["name" => "Фолклендские острова", "population" => 3380],
            ["name" => "Сен-Пьер и Микелон", "population" => 6301],
            ["name" => "Остров Святой Елены", "population" => 8987],
            ["name" => "Уоллис и Футуна", "population" => 10445],
            ["name" => "Тувалу", "population" => 10927],
            ["name" => "Науру", "population" => 11086],
            ["name" => "Ангилья", "population" => 15800],
            ["name" => "Сен-Бартелеми", "population" => 16183],
            ["name" => "Острова Кука", "population" => 17325],
            ["name" => "Палау", "population" => 21507]
        ];
        echo '
            <h3>Самые "густонаселённые" страны</h3>
            <form action="arrays.php" method="POST">
            <select class="variable" size="1" name="var1">';
        foreach($countries as $country) {
            if ($country["population"] == $v1) {
                $show = $country["name"];
                $select = 'selected = "selected"';
            }
            else $select = '';
            echo '<option '.$select.' value='.$country["population"].'>'.$country["name"].'</option>';
        }
        echo '
            </select>
            <button class="task-button" type="submit" name="do-it" value="4">Узнать население</button>
            <input class="task-button" type="button" value="Назад" onClick="document.location=\'arrays.php\'">
            </form>
        ';
        return "Население страны ".$show." ".$v1." человек.";
    }

    function task5() {
        $socialSources = [
            ["name" => "YouTube", "logo" => "Youtube.png", "href" => "https://www.youtube.com"],
            ["name" => "Facebook", "logo" => "facebook.png", "href" => "https://www.facebook.com"],
            ["name" => "Google", "logo" => "google.png", "href" => "https://www.google.com"],
            ["name" => "GMail", "logo" => "GMail.png", "href" => "https://www.gmail.com"],
        ];
        echo '
            <h3>Интернет-ресурсы</h3>
            <div class = "socialSources">';
        foreach($socialSources as $source) {
            echo '<a href="'.$source["href"].'"><img src="/DZ1/image/Social/'.$source["logo"].'" alt="'.$source["name"].'" title="'.$source["name"].'"></a>';
        }
        echo '</div>
        <input class="task-button" style="display:block; margin: 20px auto 0;" type="button" value="Назад" onClick="document.location=\'arrays.php\'">';
    }

?>

<body>
    <?php
        include 'header.php';
        showHeader(3);
        echo "<h2>МАССИВЫ</h2>";

        if (empty($_POST)) {
            showTaskList();
        }
        if (isset($_POST["choose"])) {
            echo '<script> document.getElementById("form1").style.display = "none"; </script>';
            switch ($_POST['choose']) {
                case 1:
                    task1(0);
                    break;
                case 2:
                    task2(0);
                    break;
                case 4:
                    echo '<p class="result">'.task4(49).'</p>';
                    break;
            }
        }
        if (isset($_POST["do-it"])) {
            $data1 = $_POST['var1'];
            switch ($_POST["do-it"]) {
                case 1:
                    echo '<p class="result">'.task1($data1).'</p>';
                    break;
                case 2:
                    echo '<p class="result">'.task2($data1).'</p>';
                    break;
                case 3:
                    task3();
                    break;
                case 4:
                    echo '<p class="result">'.task4($data1).'</p>';
                    break;
                case 5:
                    echo '<p class="result">'.task5($data1).'</p>';
                    break;
            }
        }
    ?>

</body>
</html>