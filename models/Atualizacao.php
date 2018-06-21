<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "atualizacao".
 *
 * @property int $id
 * @property string $data
 * @property double $valor_total
 *
 * @property Titulos[] $titulos
 */
class Atualizacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'atualizacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data'], 'safe'],
            [['valor_total'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'valor_total' => 'Valor Total',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitulos()
    {
        return $this->hasMany(Titulos::className(), ['atualizacao_id' => 'id']);
    }
}
