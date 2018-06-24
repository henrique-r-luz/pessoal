<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "titulos".
 *
 * @property int $id
 * @property string $ativo
 * @property string $emissor
 * @property double $quantidade
 * @property double $tributos
 * @property double $valor_compra
 * @property double $valor_venda
 * @property int $atualizacao_id
 * @property int $categoria_id
 *
 * @property Atualizacao $atualizacao
 * @property Categorias $categoria
 */
class Titulos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'titulos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ativo', 'emissor','taxa','quantidade', 'tributos', 'valor_compra', 'valor_venda','atualizacao_id', 'categoria_id'],'required'],
            [['ativo', 'emissor','taxa'], 'string'],
            [['quantidade', 'tributos', 'valor_compra', 'valor_venda'], 'number'],
            [['atualizacao_id', 'categoria_id'], 'default', 'value' => null],
            [['atualizacao_id', 'categoria_id'], 'integer'],
            [['atualizacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Atualizacao::className(), 'targetAttribute' => ['atualizacao_id' => 'id']],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::className(), 'targetAttribute' => ['categoria_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ativo' => 'Ativo',
            'taxa'=>'Taxa',
            'emissor' => 'Emissor',
            'quantidade' => 'Quantidade',
            'tributos' => 'Tributos',
            'valor_compra' => 'Valor Compra',
            'valor_venda' => 'Valor Venda',
            'atualizacao_id' => 'Atualizacao ID',
            'categoria_id' => 'Categoria ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtualizacao()
    {
        return $this->hasOne(Atualizacao::className(), ['id' => 'atualizacao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::className(), ['id' => 'categoria_id']);
    }
}
