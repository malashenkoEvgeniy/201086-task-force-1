<?php

require_once __DIR__ . '/../vendor/autoload.php';
use app\classes\ContactsImporterGenerator;
/*//заполняет таблицу locations
$importer = new ContactsImporterGenerator("data/cities.csv", ['city','lat','long']);
try {
    $importer->import();
} catch (SourceFileException $e) {
    error_log("Не удалось обработать csv файл: " . $e->getMessage());
} catch (FileFormatException $e) {
    error_log("Неверный форма файла импорта: " . $e->getMessage());
}

$f = fopen("../docs/locations.sql", "a");
$result = "INSERT INTO `locations`(`city`, `lat`, `long`) VALUES ('','','')";
foreach ($importer->getData() as $value) {
    if(!empty($value[0]) or !empty($value[1])or!empty($value[1])) {
        $city = $value[0];
        $lat = $value[1];
        $long = $value[2];
        $result .= ",(\"$city\", \"$lat\", \"$long\")";
    }
}
fputs($f, $result);
fclose($f);*/
/*//заполняет таблицу categories
$importer = new ContactsImporterGenerator("data/categories.csv", ['name', 'icon']);
try {
    $importer->import();
} catch (SourceFileException $e) {
    error_log("Не удалось обработать csv файл: " . $e->getMessage());
} catch (FileFormatException $e) {
    error_log("Неверный форма файла импорта: " . $e->getMessage());
}

$f = fopen("../docs/categories.sql", "a");
$result = "INSERT INTO `categories`(`title`, `title_en`) VALUES ('','')";
foreach ($importer->getData() as $value) {
    if(!empty($value[0]) or !empty($value[1])or!empty($value[1])) {
        $name = $value[0];
        $icon = $value[1];
        $result .= ",(\"$name\", \"$icon\")";
    }
}
fputs($f, $result);
fclose($f);
*/
//заполняет таблицу users
$importer = new ContactsImporterGenerator("data/profiles.csv", ['address','bd','about','phone','skype']);
try {
    $importer->import();
} catch (SourceFileException $e) {
    error_log("Не удалось обработать csv файл: " . $e->getMessage());
} catch (FileFormatException $e) {
    error_log("Неверный форма файла импорта: " . $e->getMessage());
}

$f = fopen("../docs/users.sql", "a");
$result = "INSERT INTO `categories`(`title`, `title_en`) VALUES ('','')";
foreach ($importer->getData() as $value) {
    if(!empty($value[0]) or !empty($value[1])or!empty($value[1])) {
        $name = $value[0];
        $icon = $value[1];
        $result .= ",(\"$name\", \"$icon\")";
    }
}
fputs($f, $result);
fclose($f);
