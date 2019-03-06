<?php
header('Content-Type: text/html; charset=utf-8');
require 'phpQuery.php';

function get_content($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

function parser($url, $start, $end){
    if($start < $end){
        $file = get_content($url);
        $doc = phpQuery::newDocument($file);

        foreach($doc->find('.pst-cn h3') as $sec){
            $sec = pq($sec);
            $link = $sec->find('a')->attr('href');
            $fr = file_get_contents($link);
            $inner = phpQuery::newDocument($fr);
            $video = $inner->find('iframe')->attr('src');
            echo $video . "<br>";
            file_put_contents("file.txt",PHP_EOL . $video, FILE_APPEND);
        }
        $next = $doc->find('.wp-pagenavi .current')->next()->attr('href');
        if(!empty($next)){
            $start++;
            parser($next, $start, $end);
        }

    }

}

$url = 'https://www.webcamrips.com/page/1';
$start = 0;
$end = 2;
parser($url, $start, $end);

//если мы хотим скачать только 1ю страницу, то start=0 end=1
//не нравится - перепиши условее в строке 15 на <=