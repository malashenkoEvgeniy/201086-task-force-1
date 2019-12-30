<?php


namespace app\classes;
use app\classes\exceptions\FileFormatException;
use app\classes\exceptions\SourceFileException;


class ContactsImporterGenerator
{
  private  $filename;
  private  $columns;
  private $fp;
  private  $result = [];
  //private ?string $error = null;
  /**
   * ContactsImporter constructor.
   * @param $filename
   * @param $columns
   */
  public function __construct(string $filename, array $columns)
  {
      $this->filename = $filename;
      $this->columns = $columns;
  }

  /**
   * @throws FileFormatException
   * @throws SourceFileException
   */
  public function import():void
  {
      if (!$this->validateColumns($this->columns)) {
          throw new FileFormatException("Заданы неверные заголовки столбцов");
      }
      if (!file_exists($this->filename)) {
          throw new SourceFileException("Файл не существует");
      }
      $this->fp = fopen($this->filename, 'r');
      if (!$this->fp) {
          throw new SourceFileException("Не удалось открыть файл на чтение");
      }
      $header_data = $this->getHeaderData();
      if ($header_data !== $this->columns) {
          throw new FileFormatException("Исходный файл не содержит необходимых столбцов");
      }
      foreach ($this->getNextLine() as $line) {
          $this->result[] = $line;
      }
  }
  public function getData():array {
      return $this->result;
  }
  private function getHeaderData():?array {
      rewind($this->fp);
      $data = fgetcsv($this->fp);
      return $data;
  }
  private function getNextLine():?iterable {
      $result = null;
      while (!feof($this->fp)) {
          yield fgetcsv($this->fp);
      }
      return $result;
  }
  private function validateColumns(array $columns):bool
  {
    $result = true;
    if (count($columns)) {
        foreach ($columns as $column) {
            if (!is_string($column)) {
                $result = false;
            }
        }
    }
    else {
        $result = false;
    }
    return $result;
  }
  public function getArrayFromFile(){
    try {
        $this->import();
    } catch (SourceFileException $e) {
        error_log("Не удалось обработать csv файл: " . $e->getMessage());
    } catch (FileFormatException $e) {
        error_log("Неверный форма файла импорта: " . $e->getMessage());
    }
    for ($i = 0; $i < count($this->getData()); $i++) {
        if(!empty($this->getData()[$i][0])) {
            $newArray[$i]['id'] = $i + 1;
            $k = 0;
            foreach ($this->columns as $value){
                $newArray[$i][$value] = $this->getData()[$i][$k];
                $k++;
            }
        }
    }
    return $newArray;
  }
}
