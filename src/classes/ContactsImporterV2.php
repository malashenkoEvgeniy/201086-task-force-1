<?php


namespace app\classes;
use app\classes\exceptions\FileFormatException;
use app\classes\exceptions\SourceFileException;


class ContactsImporterV2
{
    public $filename;
    public $columns;
    private $fp;
    private $result = [];
    //private $error = null;
    /**
     * ContactsImporter constructor.
     * @param $filename
     * @param $columns
     */
    public function __construct($filename, $columns)
    {
        $this->filename = $filename;
        $this->columns = $columns;
    }

    /**
     * @throws FileFormatException
     * @throws SourceFileException
     */
    public function import()
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
        while ($line = $this->getNextLine()) {
            $this->result[] = $line;
        }
    }
    public function getData() {
        return $this->result;
    }
    private function getHeaderData() {
        rewind($this->fp);
        $data = fgetcsv($this->fp);
        return $data;
    }
    private function getNextLine() {
        $result = false;
        if (!feof($this->fp)) {
            $result = fgetcsv($this->fp);
        }
        return $result;
    }
    private function validateColumns($columns)
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
}

