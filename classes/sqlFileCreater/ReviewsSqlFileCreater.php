<?php


namespace app\classes\sqlFileCreater;


use app\classes\ContactsImporterGenerator;
use app\classes\QueryBuilder;

class ReviewsSqlFileCreater
{
    public $path;

    const DB_FIELDS = 'id, creation_time, assessment, comment';
    const CSV_FILELD = ['dt_add', 'rate', 'description'];

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

    public function createReviewsFile( $count_user, $count_task)
    {
        $arrReviews = $this->execute();
        for ($i = 0; $i < count($arrReviews); $i++){
            $arrReviews[$i]['executor_id'] = mt_rand(1, $count_user);
            $rand = mt_rand(1, $count_user);
            while ($arrReviews[$i]['executor_id'] == $rand) {
                $rand = mt_rand(1, $count_user);
            }
                $arrReviews[$i]['customer_id'] = $rand;
                $arrReviews[$i]['task_id'] = mt_rand(1, $count_task);
        }

        $queryBuilder = new QueryBuilder('reviews');
        $result = $queryBuilder->getInsertQuery($arrReviews);
        file_put_contents("../docs/reviews.sql", $result);
        return $arrReviews;
    }
}
