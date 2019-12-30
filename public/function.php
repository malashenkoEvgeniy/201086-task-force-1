<?php
use app\classes\ContactsImporterGenerator;
use app\classes\exceptions\SourceFileException;
use app\classes\exceptions\FileFormatException;
function getArrayFromFile($file, $arr){
    $newClass = new ContactsImporterGenerator($file, $arr);
    try {
        $newClass->import();
    } catch (SourceFileException $e) {
        error_log("Не удалось обработать csv файл: " . $e->getMessage());
    } catch (FileFormatException $e) {
        error_log("Неверный форма файла импорта: " . $e->getMessage());
    }
    for ($i = 0; $i < count($newClass->getData()); $i++) {
        if(!empty($newClass->getData()[$i][0])) {
            $newArray[$i]['id'] = $i + 1;
            $k = 0;
            foreach ($arr as $value){
                $newArray[$i][$value] = $newClass->getData()[$i][$k];
                $k++;
            }
        }
    }
    return $newArray;
}
function debug($arr){
  echo '<pre>';
  print_r($arr);
  echo '</pre>';
}
function createUserArray($profiles, $users){
  
  return $user;
}