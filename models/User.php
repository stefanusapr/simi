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

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['password_old', 'password_new', 'password_repeat'], 'required'],
            [['username', 'password', 'email', 'role', 'password_old', 'password_new', 'password_repeat'], 'string', 'max' => 255],
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
            'password_old' => 'Kata sandi lama',
            'password_new' => 'Kata sandi baru',
            'password_repeat' => 'Ulangi kata sandi baru',
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
        //return $this->password === $password;

        return $this->password === $password;
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

    public function findPasswords($attribute, $params) {
        $user = User::find()->where([
                    'username' => Yii::$app->user->identity->username
                ])->one();
        $password = $user->password;
        if ($password != $this->password_old)
            $this->addError($attribute, 'Kata sandi lama salah');
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
