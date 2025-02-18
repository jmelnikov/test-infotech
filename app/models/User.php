<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property mixed|null $id
 * @property string $username
 * @property string $password_hash
 * @property string $auth_key
 * @property int $created_at
 *
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName(): string
    {
        return 'user';
    }

    public static function findIdentity($id): User|IdentityInterface|null
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): null
    {
        return null;
    }

    public static function findByUsername($username): ?User
    {
        return self::findOne(['username' => $username]);
    }

    public function rules(): array
    {
        return [
            [['username', 'password_hash', 'auth_key'], 'required'],
            [['username'], 'string', 'max' => 255],
            [['password_hash', 'auth_key'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'username' => 'Имя пользователя',
            'password_hash' => 'Пароль',
            'auth_key' => 'Ключ аутентификации',
            'created_at' => 'Дата создания',
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey(): ?string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password): void
    {
        try {
            $this->password_hash = Yii::$app->security->generatePasswordHash($password);
        } catch (Exception $e) {
            Yii::error($e->getMessage());
        }
    }

    public function generateAuthKey(): void
    {
        try {
            $this->auth_key = Yii::$app->security->generateRandomString();
        } catch (Exception $e) {
            Yii::error($e->getMessage());
        }
    }
}
