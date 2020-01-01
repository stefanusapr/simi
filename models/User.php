<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $authKey
 * @property string $password
 * @property string $email
 * @property string $accessToken
 * @property string $role
 * @property string $password_old
 * @property string $password_new
 * @property string $password_repeat
 * @property string $email_new
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'user';
    }

    public $old_password;
    public $repeat_password;
    
    
    public $new_password;
    public $new_email;
    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['new_email', 'old_password'], 'required', 'on' => 'change-mail'],
            [['new_password','old_password', 'repeat_password'], 'required', 'on' => 'akun'],
            [['username', 'password', 'email', 'role', 'old_password', 'new_password', 'repeat_password'], 'string', 'max' => 255],
            [['authKey', 'accessToken'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Nama pengguna',
            'authKey' => 'Auth Key',
            'password' => 'Kata sandi',
            'email' => 'Email',
            'accessToken' => 'Access Token',
            'role' => 'Role',
            'new_password' => 'Kata sandi baru',
            'new_email' => 'Email baru',
            'old_password' => 'Kata sandi lama',
            'repeat_password' => 'Ulangi kata sandi baru',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id) {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null) {
//        foreach (self::$users as $user) {
//            if ($user['accessToken'] === $token) {
//                return new static($user);
//            }
//        }

        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
//        foreach (self::$users as $user) {
//            if (strcasecmp($user['username'], $username) === 0) {
//                return new static($user);
//            }
//        }

        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {

        return $this->password === md5($password);
    }

    public function setPassword($password) {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

    /**
     * Changes password.
     *
     * @return boolean if password was changed.
     */
    public function changePassword() {
        $user = $this->_user;
        $user->setPassword($this->password);

        return $user->save(false);
    }

}
