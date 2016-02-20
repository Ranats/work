#!/usr/bin/php
<?php
require_once "./app.php";
require_once "./Item.php";
require_once "./Feed.php";
require_once "./RSS1.php";

use \FeedWriter\RSS1;

$feed = new RSS1;

$feed->setTitle("");
$feed->setLink("");
$feed->setDescription("");
$feed->setChannelAbout("");

$arr = scrap();

foreach ($arr as $contents) {
    $item = $feed->createNewItem();
    $item->setTitle($contents['title']);
    $item->setLink($contents['url']);
    $date = $contents['date'];
    $item->setDate(strtotime($date));
    $feed->addItem($item);
}

$xml = $feed->generateFeed();

$file = "./rss1.xml";

@file_put_contents($file, $xml);
?>
