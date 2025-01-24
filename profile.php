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

    $title = strip_tags($_POST['title']);
    $main_text = strip_tags($_POST['text']);

    $title = mysqli_real_escape_string($link, $_POST['title']);
    $main_text = mysqli_real_escape_string($link, $_POST['text']);

    if (!$title || !$main_text) die ("Заполните все поля");

    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $main_text = htmlspecialchars($main_text, ENT_QUOTES, 'UTF-8');
    
    $sql = "INSERT INTO posts (title, main_text) VALUES ('$title', '$main_text')";

    if (!mysqli_query($link, $sql)) die("не удалось добавить пост");
}    
    if(!empty($_FILES["file"]))
    {
        $errors = [];
        $allowedtypes = ['image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png'];

        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Произошла ошибка при загрузке файла.';
        }
        $maxFileSize = 102400;
    $realFileSize = filesize($_FILES['file']['tmp_name']);
    if ($realFileSize > $maxFileSize) {
        $errors[] = 'Файл слишком большой.';
    }
    $fileType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['file']['tmp_name']);
      
      if (!in_array($fileType, $allowedTypes)) {
      $errors[] = 'Недопустимый тип файла.';
  }
  if(empty($errors)) {
    $tempPath = $_FILES['file']['tmp_name'];
    $destinationPath = 'upload/' . uniqid() . '_' . basename($_FILES['file']['name']);

    if (move_upload_file($tempPath, $destinationPath)) {
        echo "Файл загружен успешно: " . $destinationPath;
        } else {
            $errors[] = 'Не удалось переместить загруженный файл.';
        }
    } else {
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
}
?>