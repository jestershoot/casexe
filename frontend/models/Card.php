<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class Card extends ActiveRecord
{

    // yii migrate/create create_card_table --fields="user_id:integer:notNull:foreignKey(user),prize_id:integer:notNull:foreignKey(prize),cardType:integer:defaultValue(1),cardNumber:string(16),amount:integer:defaultValue(0),status:defaultValue(0)"

    // id
    // user_id
    // prize_id
    // cardType
    // cardNumber
    // amount
    // status

    public static function paymentDone($id) {
        Card::updateAll(['status' => 1], 'id =' .$id);
    }

    public function attributeLabels()
    {
        return ['cardType' => 'Card Type',
                'cardNumber' => 'Card Number'
        ];
    }

    public function rules()
    {
        return [
            ['cardNumber', 'required'],
            ['cardNumber', 'myRule'],
        ];
    }

    public static function cardType($id = null) {
        $types = [
            1 => 'Visa',
            2 => 'MasterCard'
        ];

        if ($id) {
            return isset($types[$id]) ? $types[$id] : 'Undefined';
        }
        else {
            return $types;
        }
    }


    public static function cardStatus($id = null) {
        $types = [
            0 => 'New',
            1 => 'Paid'
        ];

        if ($id !== null) {
            return isset($types[$id]) ? $types[$id] : 'Undefined';
        }
        else {
            return $types;
        }
    }

    public function myRule($attribute, $params) {
        if (!preg_match('/^[0-9]{16}$/', $this->$attribute)) {
            $this->addError($attribute, 'Card number must be 16 digits');
        }
    }
}