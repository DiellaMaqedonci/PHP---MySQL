<?php

//$my_file = fopen("file1.txt", "w");

//fclose($my_file);





//fread

$filename = "file1.txt";
$file = fopen($filename, "r");

$filesize = filesize($filename);

$my_filedata = fread($file, $filesize);
echo $my_filedata . "<br>";
fclose($file);



$file1 = fopen("myfile.txt", "r");
while (!feof($file1)) {
    echo fgets($file1) . "<br>";
}




//fwrite

$file2 = fopen("example.txt", "w");

$text = "computer programming";

fwrite($file2, $text);




//w+ (read and write only)

$file3 = fopen("data.txt", "w+");
fwrite($file3, "My name is Diella. ");




//a+
$file4 = fopen("data.txt", "a+");
fwrite($file4, "My name is Diella. ");









?>