<?php

namespace frontend\models\forms;

use RuntimeException;
use yii\base\Model;

class UploadForm extends Model
{
  public $file;

  public function rules()
  {
    return [
      [['file'], 'file', 'extensions' => 'png, jpg, txt']];
  }

  public function upload()
  {
    if ($this->validate()) {
      $this->file->saveAs('img/uploads/' . $this->file->baseName . '.' . $this->file->extension);
      return true;
    } else {
        throw new RuntimeException('Не получилось загрузить файл');
    }
  }
}