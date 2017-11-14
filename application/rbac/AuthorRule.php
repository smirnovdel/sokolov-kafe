<?php
namespace app\rbac;

use yii\rbac\Rule;

class AuthorRule extends Rule
{
    public $name = 'isAuthor'; // Имя правила

    /**
     * @param int|string $user_id
     * @param \yii\rbac\Item $item
     * @param array $params ожидается ключ - модель.
     * @return bool*
     */
    public function execute($user_id, $item, $params)
    {
        return isset($params['model']) ? $params['model']->created_by == $user_id : false;
    }
}