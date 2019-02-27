<?php
require 'phpQuery.php';
for($p=1; $p <= 10; $p++) {
    $url = 'https://www.webcamrips.com/page/' . $p;
    $file = file_get_contents($url);
    $doc = phpQuery::newDocument($file);
    foreach ($doc->find('.pst-cn h3') as $sec) {
        $sec = pq($sec);
        $link = $sec->find('a')->attr('href');
        $fr = file_get_contents($link);
        $inner = phpQuery::newDocument($fr);
        $video = $inner->find('iframe')->attr('src');
        echo "$video <br>";
    };
};
// $p - page***** грабим со 1 по 10 стр по умолчанию
// clma06c04d03