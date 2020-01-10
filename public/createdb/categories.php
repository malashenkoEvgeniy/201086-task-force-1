<?php
$result = "INSERT INTO"." `categories`(`id`, `title`, `title_en`) VALUES";

foreach ($categories as $category){
    $result .= " ('".implode('\', \'', $category)."'),";
}

$result = substr($result, 0, strlen($result) - 1);

file_put_contents("../docs/categories.sql", $result);
