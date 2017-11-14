<?php
namespace app\rbac;

use yii\rbac\Rule;

class CartRule extends Rule
{
    public $name = 'myCart'; // Имя правила

    /**
     * @param int|string $user_id
     * @param \yii\rbac\Item $item
     * @param array $params ожидается ключ - модель.
     * @return bool*
     */
    public function execute($user_id, $item, $params)
    {
        return isset($params['model']) ? $params['model']->user_id == $user_id : false;
    }
}