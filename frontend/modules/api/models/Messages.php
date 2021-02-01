<?php

namespace frontend\modules\api\models;
/*
use frontend\models\ChatMessages;

class Messages extends ChatMessages
{
    public function fields()
    {
        return [
          'id',
          'writer' => function ($data) {
              return $data->writer->username;
          },
          'task' => function ($data) {
              return $data->task->name;
          },
          'task_id',
          'message' => function ($data) {
              return $data->comment;
          },
          'published_at' => function ($data) {
              return $data->creation_time;
          },


        ];
    }

    public function extraFields()
    {
        return ['task', 'writer'];
    }
}*/

use yii\db\ActiveRecord;

class Messages extends ActiveRecord
{
    public static function tableName()
    {
        return 'chat_messages';
    }


}
