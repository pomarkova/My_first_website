<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Помаркова Виктория Юрьевна</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="me">
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css” />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container nav_bar">
        <div class="row">
            <div class="row"> 
            <div class="col-3 nav_logo"></div>
            <div class="col-9"></div>
                <div class="nav_text">Привет! Коротко обо мне)</div>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-8">
                <h2> Меня зовут Помаркова Виктория, я студентка ДВФУ 2 курса, 
                    учусь на специальности Информационная безопасность Б9123-10.03.01отзи
                </h2>
                <h3>Мне нужно написать здесь побольше текста, поэтому рассказываю)))
                    С 4 до 18 лет я занималась танцами и пару лет гимнастикой, также несколько лет ходила на квиллинг, 
                    а ещё я занималась спортивным туризмом (тоже недолго). Это там, где надо по верёвкам и скалам лазить, а ещё в походы ходить... 
                    Никогда этого не любила... Мне 19, и сейчас я делаю этот сайт). 
                    Если бы в начале 11 класса мне сказали, что я поступлю на специальность, связанную с IT, я бы точно не поверила в это. Но мне нравится!=)
                </h3>
            </div>       
                <div class="col-4">
                <div class="row photo"> </div>
                <div class="row title_photo"><p>Помаркова Виктория</p>
            </div>
        </div>
        <div class="col-12 button_js">
            <button id="myButton">Нажми на меня!</button>
            <p id="demo"></p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="hello" align="center">
                    Привет, <?php echo $_COOKIE['User']; ?>
                </h1>
            </div>
            <div class="col-12 vertical-form" align="center">
                <form method="POST" action="profile.php" enctype="multipart/form-data" name="upload">
                    <input type="text" class="form" type="text" name="title" cols="30" rows="10" placeholder="Заголовок вашего поста "></input>
                    <textarea name="text" cols="30" rows="10" placeholder="Введите текст вашего поста ..."></textarea>
                    <input type="file" name="file" /><br>
                    <button type="submit" class="btn_red" name="submit">Сохранить пост!</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/button.js"></script>
</body>
</html>

<?php
require_once('db.php');

$link = mysqli_connect('127.0.0.1', 'root', 'vika', 'first');

if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $main_text = $_POST['text'];

    if (!$title || !$main_text) die ("Заполните все поля");

    $sql = "INSERT INTO posts (title, main_text) VALUES ('$title', '$main_text')";

    if (!mysqli_query($link, $sql)) die("не удалось добавить пост");
}    
    if(!empty($_FILES["file"]))
    {
        if (((@$_FILES["file"]["type"] == "image/gif") || (@$_FILES["file"]["type"] == "image/jpeg")
        || (@$_FILES["file"]["type"] == "image/jpg") || (@$_FILES["file"]["type"] == "image/pjpeg")
        || (@$_FILES["file"]["type"] == "image/x-png") || (@$_FILES["file"]["type"] == "image/png"))
        && (@$_FILES["file"]["size"] < 102400))
        {
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
            echo "Load in:  " . "upload/" . $_FILES["file"]["name"];
        }
        else
        {
            echo "upload failed!";
        }
    }
?>