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
        include 'header.php';
        showHeader(5);
        echo "<h2>Галерея</h2>";

        if (!isset($_POST["add"])) {
            echo '<form action = "gallery.php" method = "post">
            <div class="ext-filter">';

            function isChecked($v) {
                if (!$_POST["choose"]) return true;
                else if ((!$_POST["extensions"]) || (!in_array($v, $_POST["extensions"])))
                    return false;
                else return true;
            }

            define("IMAGE_PATH", "../image/Gallery/");
            if ($dir = opendir(IMAGE_PATH)) {
                $ext_array = [];

                while (($file = readdir($dir)) !== false)
                {
                    $filename = IMAGE_PATH.$file;
                    $pos = strrpos($filename,'.');
                    $ext = substr($filename, $pos+1);
                    $ext = strtolower($ext);
                    if ((!in_array($ext, $ext_array)) && $ext !='') {
                        $ext_array[] = $ext;
                        echo '<label><input type = "checkbox" name="extensions[]" value="'.$ext.'" '.(isChecked($ext) ? checked : "").' />'.$ext.'</label>';
                    }
                }
            }
            echo '</div> <input type = "submit" class="task-button" name="choose" value="Отобрать"/>
            <input type = "submit" class="task-button" name="add" value="Добавить"/>  </form>';
        }

        if (isset($_POST["add"])) {
            include ("upload.php");
        }

        if (!isset($_POST["choose"])) {
            $exts = '{jpg,png,gif,bmp}';
        }
        else if ($_POST['extensions']) {
            $exts = '{';
            foreach ($_POST['extensions'] as $extension)
            {
                $exts = $exts.','.$extension;
            }
            $exts = $exts.'}';
        }

        echo '<div class = "gallery">';
        $files_array = glob(IMAGE_PATH."*.".$exts, GLOB_BRACE);
        foreach ($files_array as $image) {
            echo '<a href="'.$image.'" target="_blank"><img src="'.$image.'" height="200px" class="img-polaroid" alt="text"></img></a>';
        }
        echo '</div>';
    ?>
</body>
</html>