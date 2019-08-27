<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\Security;

class User extends ActiveRecord implements IdentityInterface{
    public $password_repeat;
    public static function tableName()
    {
         return '{{%tbl_user}}';
    }


 /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['full_name', 'username', 'email', 'password', 'password_repeat'], 'required'],
            // rememberMe must be a boolean value
            ['email', 'email'],
            // password is validated by validatePassword()
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

 


    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

   public function validatePassword($password){
    return $this->password === md5($password);
   }

  public static function findByUsername($username){
         return User::findOne(['username' => $username]);
  } 

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    public function beforeSave($insert){
    if (parent::beforeSave($insert)) {
        if ($this->isNewRecord) {
          $this->auth_key = \yii::$app->security->generateRandomString();  
        }
         if (isset($this->password)) {
           $this->password = md5($this->password);
           return parent::beforeSave($insert);
         }
        
    }
    return true;
  }


   public function getJob(){
   return $this->hasMany(Job::className(), ['user_id' => 'id']);
 }

}