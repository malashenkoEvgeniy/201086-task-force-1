<?php


namespace app\classes\sqlFileCreater;


use app\classes\ContactsImporterGenerator;


class ProfilesSqlFileCreater
{
    public $path;

    const DB_FIELDS = 'id, location_id, birthday, info, phone, skype';
    const CSV_FILELD = ['address', 'bd', 'about', 'phone', 'skype'];

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function execute()
    {
        $arr = [];
        $tab = new ContactsImporterGenerator($this->path, self::CSV_FILELD);
        foreach($tab->getArrayFromFile() as $value) {
            $arr[] =  array_combine(explode(', ', self::DB_FIELDS), array_values($value));
        }
        return $arr;
    }
}
