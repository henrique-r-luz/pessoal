<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categorias".
 *
 * @property int $id
 * @property string $nome
 *
 * @property Titulos[] $titulos
 */
class Categorias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categorias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'string'],
            [['id', 'nome'],'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitulos()
    {
        return $this->hasMany(Titulos::className(), ['categoria_id' => 'id']);
    }
    
    /*
     * popula categória com dados pré-definidos
     */
    public static function popula(){
        //verifica se exite dados
        //1-> renda fixa
        if(!Categorias::find()->where(['id' =>1])->exists()){
            $categoria = new Categorias();
            $categoria->id = 1;
            $categoria->nome = "Renda Fixa";
            $categoria->save();
        }
        //2-> Fundos de Investimentos
         if(!Categorias::find()->where(['id' =>2])->exists()){
            $categoria = new Categorias();
            $categoria->id = 2;
            $categoria->nome = "Fundos de Investimentos";
            $categoria->save();
        }
    }
}
