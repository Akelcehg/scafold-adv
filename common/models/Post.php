<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $text
 * @property string $theme
 * @property string $author
 * @property integer $publisher_id
 */
class Post extends \yii\db\ActiveRecord
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
            'text' => 'Text',
            'theme' => 'Theme',
            'author' => 'Author',
            'publisher_id' => 'Publisher ID',
        ];
    }
}
