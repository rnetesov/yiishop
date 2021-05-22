<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Customer extends ActiveRecord implements IdentityInterface
{
    public $password;
    public $oldPassword;
    public $newPassword;
    public $repeatPassword;

    const SCENARIO_REGISTER = 'register';
    const SCENARIO_CHECKOUT = 'checkout';
    const SCENARIO_PROFILE = 'profile';

    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->getSecurity()->generateRandomString();
                $this->hash = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
            } else {
                if (!empty($this->oldPassword)) {
                    $this->hash = \Yii::$app->getSecurity()->generatePasswordHash($this->newPassword);
                }
            }
            return true;
        }
        return false;
    }


    public static function tableName()
    {
        return '{{customers}}';
    }

    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customerNumber' => 'customerNumber']);
    }

    public static function findCustomerByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getId()
    {
        return $this->customerNumber;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function rules()
    {
        return [
            [['login', 'email', 'password'], 'required'],
            [[
                'contactLastName',
                'contactFirstName',
                'phone',
                'addressLine1',
                'country',
                'city',
                'postalCode',
            ],'required'],
            ['login', 'string', 'length' => [3, 100]],
            ['password', 'string', 'length' => [3, 20]],
            ['email', 'email'],
            [['login', 'email'], 'unique'],
            [['contactLastName', 'contactFirstName', 'addressLine1', 'country', 'city', 'state'], 'string', 'length' => [3, 100]],
            [['phone', 'postalCode'], 'number'],
            ['oldPassword', function ($attribute) {
                if (!\Yii::$app->security->validatePassword($this->$attribute, $this->hash)) {
                    $this->addError($attribute, 'The old password was entered incorrectly');
                }
            }],
            ['newPassword', 'compare', 'compareAttribute' => 'repeatPassword', 'when' => function ($model) {
                return !empty($model->oldPassword) && \Yii::$app->security->validatePassword($this->oldPassword, $this->hash);
            }],
            [['newPassword', 'repeatPassword'], 'required', 'when' => function ($model) {
                return !empty($model->oldPassword);
            }],
            [['newPassword', 'repeatPassword'], function ($attribute) {
                if (empty($this->oldPassword)) {
                    $this->addError($attribute, 'Field Old Password must by filled');
                }
            }, 'when' => function ($model) {
                return empty($model->oldPassword);
            }],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios [self::SCENARIO_REGISTER] = [
            'login',
            'email',
            'password'
        ];

        $scenarios[self::SCENARIO_CHECKOUT] = [
            'contactLastName',
            'contactFirstName',
            'phone',
            'addressLine1',
            'country',
            'city',
            'state',
            'postalCode'
        ];

        $scenarios[self::SCENARIO_PROFILE] = [
            'login',
            'email',
            'oldPassword',
            'newPassword',
            'repeatPassword',
            'contactLastName',
            'contactFirstName',
            'phone',
            'addressLine1',
            'country',
            'city',
            'state',
            'postalCode'
        ];

        return $scenarios;
    }
}