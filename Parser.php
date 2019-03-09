<?php

class Parser{
    function pars($url, $start, $end)
    {
        if ($start < $end) {
            $file = new Get();
            $file = $file -> get_content($url);
            $doc = phpQuery::newDocument($file);
            foreach ($doc->find('.pst-cn h3') as $sec) {
                $sec = pq($sec);
                $link = $sec->find('a')->attr('href');
                $fr = file_get_contents($link);
                $inner = phpQuery::newDocument($fr);
                $video = $inner->find('iframe')->attr('src');
                echo $video . "<br>";
                file_put_contents("file.txt", PHP_EOL . $video, FILE_APPEND);
            }
            $next = $doc->find('.wp-pagenavi .current')->next()->attr('href');
            if (!empty($next)) {
                $start++;
                $this->pars($next, $start, $end);
            }

        }

    }
}
