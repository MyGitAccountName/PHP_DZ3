<?php
    function showHeader($page) {
        echo '<div class="header">
                <a href="/DZ3/"><img class="logoPHP" src="/DZ3/image/PHP.png" alt="PHP"></a>
                <a href="/DZ3/"><h1 data-text="Домашняя работа №3">Домашняя работа №3</h1></a>
                <ul class="themes">
                    <li><a class="pages" href="/DZ3/php/conditions.php">Условия</a></li>
                    <li><a class="pages" href="/DZ3/php/cycles.php">Циклы</a></li>
                    <li><a class="pages" href="/DZ3/php/arrays.php">Массивы</a></li>
                    <li><a class="pages" href="/DZ3/php/forms.php">Авторизация</a></li>
                    <li><a class="pages" href="/DZ3/php/gallery.php">Галерея</a></li>
                </ul>
            </div>';
        echo '<script>
            document.querySelector(".themes li:nth-of-type('.$page.') a").classList.add("chosenPage");
        </script>';
    }
?>