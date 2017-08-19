<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $firstName;
    public $status;
    public $email;
    public $password;
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

        	['firstName', 'filter', 'filter' => 'trim'],
        	['firstName', 'required'],
        	['firstName', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This firstName  has already been taken.'],
        	['firstName', 'string', 'min' => 2, 'max' => 255],
        		
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

        	['status', 'required'],
        	
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        
            $user = new User();
            $user->username = $this->username;
            $user->firstName = $this->firstName;
            $user->email = $this->email;
            $user->status =  User::STATUS_ACTIVE;
            $user->position = User::position_customer;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if($user->save()){
            	return $user;
            }
            return null;

    }
}
