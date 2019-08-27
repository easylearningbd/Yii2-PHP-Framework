<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_job}}".
 *
 * @property int $id
 * @property int $category_id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $type
 * @property string $requirements
 * @property string $salary_range
 * @property string $city
 * @property string $address
 * @property string $contact_email
 * @property string $contact_phone
 * @property int $is_published
 * @property string $create_date
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_job}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'description', 'type', 'requirements', 'salary_range', 'city', 'address', 'contact_email', 'contact_phone'], 'required'],
            [['category_id', 'is_published'], 'integer'],
            [['description'], 'string'],
            [['create_date'], 'safe'],
            [['title', 'type', 'requirements', 'salary_range', 'city', 'address', 'contact_email', 'contact_phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category Name',
            'user_id' => 'User ID',
            'title' => 'Job Title',
            'description' => 'Description',
            'type' => 'Job Type',
            'requirements' => 'Requirements',
            'salary_range' => 'Salary Range',
            'city' => 'City',
            'address' => 'Address',
            'contact_email' => 'Contact Email',
            'contact_phone' => 'Contact Phone',
            'is_published' => 'Is Published',
            'create_date' => 'Create Date',
        ];
    }

    public function getCategory(){
   return $this->hasOne(Category::className(), ['id' => 'category_id']);
 }

  public function getUser(){
   return $this->hasOne(Job::className(), ['id' => 'user_id']);
 }
  
  public function beforeSave($insert){
    $this->user_id = yii::$app->user->identity->id;
    return parent::beforeSave($insert);

  }


}
