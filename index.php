<?php
header('Content-Type: text/html; charset=utf-8');
require 'phpQuery.php';
require_once __DIR__ . '/Get.php';
require_once __DIR__ . '/Parser.php';

//$start_time = microtime(true);

$url = 'https://www.webcamrips.com/page/1';
$start = 500;
$end = 550;

file_put_contents("file.txt",'Дата ' . date('Y-m-d h:i:sa'), FILE_APPEND);
$parser = new Parser();
$parser->pars($url,$start, $end);
file_put_contents("file.txt",PHP_EOL, FILE_APPEND);

$repeat = file('file.txt');
$norepeat = array_unique($repeat, SORT_STRING);
file_put_contents("file-clear.txt",$norepeat, FILE_APPEND);

/*$end_time = microtime(true);
$runtime = $end_time - $start_time;
echo "Время выполнения скрипта в мс: " . $runtime;
*/


//если мы хотим скачать только 1ю страницу, то start=0 end=1
//не нравится - перепиши условее в Parser.php в строке 6 на <=
//Дата в file.txt - строка 13 и 16
//Проверка скорости выполнения - строка 7, 22-24