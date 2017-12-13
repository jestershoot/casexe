<?php
/**
 * Created by PhpStorm.
 * User: Aleksey
 * Date: 13.12.17
 * Time: 21:46
 */

namespace frontend\models;

use yii\db\ActiveRecord;

class Address extends ActiveRecord
{

    // yii migrate/create create_address_table --fields="user_id:integer:notNull:foreignKey(user),prize_id:integer:notNull:foreignKey(prize),reciever:string(255),zip:integer,country:string(64),state:string(64),address:string(255)"

    // id
    // user_id
    // prize_id
    // reciever
    // zip
    // country
    // state
    // city
    // address


    public static function prizeSent($id) {
        Address::updateAll(['status' => 1], 'id =' .$id);
    }

    public function attributeLabels()
    {
        return [
            'reciever' => 'Reciever Name',
            'zip' => 'Zip',
            'country' => 'Country',
            'state' => 'State or Province',
            'city' => 'City',
            'address' => 'Address'

        ];
    }

    public function rules()
    {
        return [
            [['reciever', 'zip', 'country', 'address', 'city'], 'required'],
            ['zip', 'myRule'],
            ['state', 'safe']
        ];
    }


    public static function sendStatus($id = null) {
        $types = [
            0 => 'New',
            1 => 'Sent'
        ];

        if ($id !== null) {
            return isset($types[$id]) ? $types[$id] : 'Undefined';
        }
        else {
            return $types;
        }
    }

    public function myRule($attribute, $params) {
        if (!preg_match('/[0-9]+/', $this->$attribute)) {
            $this->addError($attribute, 'Zip must contain only digits');
        }
    }

}