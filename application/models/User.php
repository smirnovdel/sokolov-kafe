<?php
namespace app\models;

use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{
    /** @inheritdoc */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = static::findOne(['access_token' => $token]);
        if (!$user->isBlocked && $user->isConfirmed) {
            return $user;
        }
        return null;
    }
}