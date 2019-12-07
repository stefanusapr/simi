<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $nama_pengguna
 * @property string $authKey
 * @property string $kata_sandi
 * @property string $email
 * @property string $accessToken
 * @property string $role
 * @property string $kata_sandi_lama
 * @property string $kata_sandi_baru
 * @property string $ulangi_kata_sandi
 */
class User extends \yii\db\ActiveRecord {

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
            [['nama_pengguna', 'authKey', 'kata_sandi', 'email', 'accessToken', 'role', 'kata_sandi_lama', 'kata_sandi_baru', 'ulangi_kata_sandi'], 'required'],
            [['nama_pengguna', 'kata_sandi', 'email', 'role', 'kata_sandi_lama', 'kata_sandi_baru', 'ulangi_kata_sandi'], 'string', 'max' => 255],
            [['authKey', 'accessToken'], 'string', 'max' => 32],
            [['nama_pengguna'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nama_pengguna' => 'Nama Pengguna',
            'authKey' => 'Auth Key',
            'kata_sandi' => 'Kata Sandi',
            'email' => 'Email',
            'accessToken' => 'Access Token',
            'role' => 'Role',
            'kata_sandi_lama' => 'Kata Sandi Lama',
            'kata_sandi_baru' => 'Kata Sandi Baru',
            'ulangi_kata_sandi' => 'Ulangi Kata Sandi',
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
                    'username' => Yii::$app->user->identity->nama_pengguna
                ])->one();
        $password = $user->kata_sandi;
        if ($password != $this->kata_sandi_baru)
            $this->addError($attribute, 'Kata sandi lama salah');
    }

    /**
     * Changes password.
     *
     * @return boolean if password was changed.
     */
    public function changePassword() {
        $user = $this->_user;
        $user->setPassword($this->kata_sandi);

        return $user->save(false);
    }

}
