<?php
ini_set('memory_limit', '-1');
ini_set('display_errors', 'On');
require_once("simple_html_dom.php");
mb_language("Japanese");

function scrap()
{
    $arr = [];
    $domain = "";
    $url = "";

    $source = file_get_html($url);
    $source = mb_convert_encoding($source, 'utf8', 'auto');

    $html = str_get_html($source);

    $pattern = '/<span>(.*)<\/span>/';
    $rep = '';

    foreach ($html->find('ul.list-a') as $element) {
        foreach ($element->find('a') as $child) {
            $url = $domain . $child->href;
            foreach ($child->find('p') as $p) {
                $title = $p->innertext;
                preg_match($pattern, $title, $date);
                preg_match('/(\d+)年(\d+)月(\d+)日/',$date[1],$date);
                $date = $date[1] . str_pad($date[2],2,0,STR_PAD_LEFT) . str_pad($date[3],2,0,STR_PAD_LEFT);
                $title = preg_replace($pattern, $rep, $title);

                $sample = array('title' => $title, 'date' => $date, 'url'=> $url);
                array_push($arr, $sample);
            }
        }
    }

    $html->clear();

    return($arr);
}

?>