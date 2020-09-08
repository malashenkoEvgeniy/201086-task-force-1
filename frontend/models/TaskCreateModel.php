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
      ['name', 'trim'],
      [['name'], 'required', 'message' => 'Имя не может быть пустым.'],
      [
        ['name'],
        'string',
        'length' => [4, 128],
        'tooShort' => 'Имя не может быть меньше 4 символов.',
        'tooLong' => 'Имя не может быть больше 128 символов.'
      ],
      [
        ['customer_id'],
        'exist',
        'skipOnError' => true,
        'targetClass' => User::class,
        'targetAttribute' => ['customer_id' => 'id']
      ],

      [['category_id'], 'integer'],
      [
        ['category_id'],
        'required',
        'message' => "Это поле должно быть выбрано. Задание должно принадлежать одной из категорий"
      ],
      [
        ['category_id'],
        'exist',
        'skipOnError' => true,
        'targetClass' => Categories::class,
        'targetAttribute' => ['category_id' => 'id']
      ],

      ['deadlineTime', 'date', 'format' => 'php:Y-m-d', 'min' => date('Y-m-d')],
        //нужно найти правильный валидатор

      [['deadline'], 'required', 'message' => "Это поле должно быть выбрано."],

      [['customer_id', 'created_at'], 'required'],
      [['customer_id', 'created_at'], 'integer'],

      [['location_id'], 'integer'],
      [
        ['location_id'],
        'exist',
        'skipOnError' => true,
        'targetClass' => Locations::class,
        'targetAttribute' => ['location_id' => 'id']
      ],

      [
        ['budget'],
        'integer',
        'min' => 0,
        'tooSmall' => 'Бюджет не может быть отрицательным числом',
        'max' => 1000000,
        'tooBig' => 'Бюджет не может превышать милион'
      ],
      [['description'], 'string'],


      [['file'], 'file', 'skipOnEmpty' => true]
    ];

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