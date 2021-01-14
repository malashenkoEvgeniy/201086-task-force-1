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
use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

class Messages extends ActiveRecord implements Linkable
{
    public static function tableName()
    {
        return 'chat_messages';
    }

    public function getLinks()
    {
        return [
          Link::REL_SELF => Url::to(['messages/', 'id' => $this->id], true),
        ];
    }

}
