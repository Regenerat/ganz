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
class User extends \yii\db\ActiveRecord
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
            [['fio', 'email', 'login', 'password'], 'string', 'max' => 50],
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
}
