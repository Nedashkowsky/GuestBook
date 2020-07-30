<?php
$db = 'gbook';
$link = mysqli_connect('localhost','root','', $db) or die(mysqli_error($link));
mysqli_query($link,"SET NAMES utf8");

$comments = "SELECT * FROM comments";
$res = mysqli_query($link, $comments) or die(mysqli_error($link));
if($res){
    $rows = mysqli_num_rows($res);
    echo "<table cellspacing='0' width='50%' cellpadding='2''>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($res);
        echo "<tr align='right' >";
        for ($j = 1 ; $j < 3 ; ++$j)
            echo "<td width='25%' style='border: 1px solid black; border-bottom: 0; padding: 5px'>$row[$j]</td>";
        echo "</tr>";
        echo "<tr >";
        echo "<td colspan='2' style=' width=100%; border: 1px solid black; border-top: 0; padding: 5px'>$row[3]</td>";
        echo "<td></td>";
        echo "</tr>";
        echo "<tr style='height: 15px'><td> </td></tr>";
    }
    echo "</table>";
    mysqli_free_result($res);
}

if (isset($_POST['name']) && isset($_POST['text']) && !empty($_POST['text'])){
    $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
    $text = htmlentities(mysqli_real_escape_string($link, $_POST['text']));
    if($name = ' '){
        $name = "Анонимно";
    }
    $query = "INSERT INTO comments VALUES(NULL, NOW(),'$name','$text')";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if(!$result) {
     echo "Произошла ошибка отправки";
    }
}

mysqli_close($link);
?>

<form method="post">
    <input type="text" name="name" placeholder="Имя"><br><br>
    <textarea style="width: 300px; height: 150px" type="text" name="text" placeholder="Введите сообщение"></textarea>
    <br><br>
    <input style="margin-left: 100px; padding-left: 25px; padding-right: 25px" type="submit" value="Отправить">
</form>