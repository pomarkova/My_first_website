var count = 0;
document.getElementById("myButton").onclick = function() 
{
    count ++;
    if (count % 2 == 0)
    {
        document.getElementById("demo").innerHTML = "";
    }
    else
    {
        var img = document.createElement("img"); // создаём новый элемент img
        img.src = "https://ph0.qna.center/storage/photos/tolan/2558387.jpg" // устанавливаем источник изображения
        document.getElementById("demo").appendChild(img); // добавляем изображение в параграф
    }
}