<?php


namespace frontend\models;


use common\models\User;
use yii\base\Model;

class TaskCreateModel extends Model
{
  public $name;
  public $description;
  public $category_id;
  public $location_id;
  public $budget;
  public $deadline;

  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'name' => 'Name',
      'category_id' => 'Category ID',
      'description' => 'Description',
      'location' => 'Location',
      'budget' => 'Budget',
      'deadline' => 'Deadline',
      'customer_id' => 'Customer ID',
      'created_at' => 'Created At',
    ];
  }

  public function rules()
  {
    return [
      [['name', 'category_id',  'deadline', 'customer_id', 'created_at'], 'required'],
      [['category_id', 'location_id', 'budget', 'customer_id', 'created_at'], 'integer'],
      [['description'], 'string'],
      [['deadline'], 'safe'],
      [['name'], 'string', 'max' => 128],
      [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category_id' => 'id']],
      [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['customer_id' => 'id']],
      [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::class, 'targetAttribute' => ['location_id' => 'id']],

      [['file'], 'file', 'skipOnEmpty' => true]];
  }

  public function creatTask($path)
  {
    if (!$this->validate()) {
      return null;
    }

    $task = new Task();
    $task->name = $this->name;
    $task->description = $this->description;
    $task->location_id = $this->location_id;
    $task->category_id = $this->category_id;
    $task->files->task_id = $task->id;
    $task->files->path = $path;
    return $task->save();
  }
}