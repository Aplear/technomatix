<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User as CommonUser;

/**
 * Signup form
 */
class CreateForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $status;
    public $role;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['role', 'string'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['status', 'in', 'range' => [CommonUser::STATUS_ACTIVE, CommonUser::STATUS_INACTIVE, CommonUser::STATUS_DELETED]],
        ];
    }

    /**
     * Create user.
     *
     * @return CommonUser|null
     */
    public function createUser()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new CommonUser();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->setPassword($this->password);
        $user->role = \Yii::$app->params['rolesArray'][$this->role];
        $user->generateAuthKey();

        if($user->save()) {
            // add the role for new user
            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole($user->role);
            $auth->assign($authorRole, $user->getId());
            return $user;
        }
        return null;
    }
}
