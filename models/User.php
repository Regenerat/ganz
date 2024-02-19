<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $fio
 * @property string $number
 * @property string $email
 * @property string $login
 * @property string $password
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'number', 'email', 'login', 'password'], 'required'],
            [['fio', 'email', 'login', 'password'], 'string', 'max' => 255],
            [['number'], 'string', 'max' => 11],
        ];
    }

    /** 
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'number' => 'Number',
            'email' => 'Email',
            'login' => 'Login',
            'password' => 'Password',
        ];
    }

    /**
     * Gets query for [[Reports]].
     *
     * @return \yii\db\ActiveQuery
     */
    
    /**
     * Функция поиска пользователя по логину и паролю
     * @param string $login Логин пользователя
     * @param string $password Пароль пользователя
     * @return User|null Возвращает пользователя или null, если соответствующего пользователя нет
     */
    public static function login($login, $password) {
        // метод find() возвращает Query-объект (объект построения запроса в бд)
        // метод where([{column} => {value}]) добавляет условие и возвращает Query-объект (объект построения запроса в бд)
        // метод one() возвращает экземпляр соответствующего класса, либо null, если не найдено ни одной записи
        // Может быть заменено на метод findOne([{column} => {value}]), который является alias для find()->where([{column} => {value}])->one()
        // Происходит поиск пользователя по его логину
        $user = static::find()->where(['login' => $login])->one();

        // Проверка на пользователя и на совпадение его пароля
        if ($user && $user->validatePassword($password)) {
            return $user;
        }

        // Иначе возвращать null
        return null;
    }

    /**
     * Скопировано из User.php.dist
     * В будущем будет изменено для сравнения пароля по хешу
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

     /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        // Поиск пользователя по id. Может быть заменено на alias static::findOne(['id' => $id]);
        return static::find()->where(['id' => $id])->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return null;
    }
}
