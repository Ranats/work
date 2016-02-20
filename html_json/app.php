<?php
ini_set('memory_limit', '-1');
ini_set('display_errors', 'On');
require_once("simple_html_dom.php");
mb_language("Japanese");

$arr = [];
$url = "";

$source = file_get_html($url);
$source = mb_convert_encoding($source,'utf8','auto');

$html = str_get_html($source);
array_push($arr,array('url' => $url));

$title = $html->find('div.title-section h1');
$sample = array('title' => $title[0]->plaintext);
array_push($arr,$sample);

foreach($html->find('div.recipe-body') as $element){
    foreach($element->find('h2,h3,p,div.message,img,li') as $child){
        if(($child->tag == 'li' && strpos($child->parent->outertext,'ad-list')) || strpos($child->outertext,'image-block')) {
            continue;
        }
        if($child->tag == 'img') {
            $sample = array($child->tag => $child->src);
        }
        else{
            $sample = array($child->tag => $child->innertext);
        }
        array_push($arr,$sample);
    }
}

//echo print_r($arr);
header('Content-type: application/json');
echo json_encode($arr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

?>