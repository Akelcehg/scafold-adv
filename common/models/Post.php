<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $text
 * @property string $theme
 * @property string $author
 * @property integer $publisher_id
 */
class Post extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'theme', 'author', 'publisher_id'], 'required'],
            [['text'], 'string'],
            [['publisher_id'], 'integer'],
            [['theme', 'author'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Текст',
            'theme' => 'Тема',
            'author' => 'Автор',
            'publisher_id' => 'Публикатор',
        ];
    }

    public function extraFields()
    {
        return ['users'];
    }

    public function getUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'publisher_id']);
    }
}
