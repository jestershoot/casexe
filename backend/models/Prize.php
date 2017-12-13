<?php
/**
 * Created by PhpStorm.
 * User: Aleksey
 * Date: 12.12.17
 * Time: 15:19
 */
namespace backend\models;

use yii\db\ActiveRecord;

class Prize extends ActiveRecord
{
//    public $name;
//    public $type;
//    public $amount;
//    public $cnt;

    public function attributeLabels()
    {
        return ['name' => 'Prize name',
                'type' => 'Prize type',
                'amount' => 'Money or Bonus amount',
                'cnt' => 'Prizes available'
            ];
    }

    public function rules()
    {
        return [ [['name', 'type', 'cnt'], 'required'],
                    ['amount', 'required', 'when' => function($model) {
                        return in_array($model->type, [1,2]);
                    }],
                  [['type', 'amount', 'cnt'], 'integer', 'integerOnly' => true, 'min' => 0],
            ];
    }

    public static function prizeType($id = null) {
        $types = [1 => 'Money',
            2 => 'Bonus',
            3 => 'Thing'
        ];

        if ($id) {
            return isset($types[$id]) ? $types[$id] : 'Undefined';
        }
        else {
            return $types;
        }
    }

    public static function prizeName($id) {
        $prize = Prize::find()->where(['=', 'id', $id])->one();

        return $prize->name;
    }

    // reduce number of prizes
    public static function acceptPrize($prize) {
        Prize::updateAll(['cnt' => $prize->cnt -1], 'id =' .$prize->id);
    }
}