<?php
/*
function get_hundred(){
    for($i = 1; $i <= 100; $i++){
        yield $i;
    }
}
foreach (get_hundred()as$v){
    print($v);
    echo '<br>';
}
*/
require_once __DIR__ . '/../vendor/autoload.php';
use app\classes\ContactsImporterV2;

$importer = new ContactsImporterV2("data/cities.csv", ['city','lat','long']);
try {
    $importer->import();
} catch (SourceFileException $e) {
    error_log("Не удалось обработать csv файл: " . $e->getMessage());
} catch (FileFormatException $e) {
    error_log("Неверный форма файла импорта: " . $e->getMessage());
}


