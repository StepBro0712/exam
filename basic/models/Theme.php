<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "theme".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property int $status
 * @property string $date
 * @property int $id_user
 *
 * @property Answer[] $answers
 * @property User $user
 */
class Theme extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'theme';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            ['id_user', 'default', 'value' => Yii::$app->user->getId()],
            [['name'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'text' => 'Текст',
            'status' => 'Статус',
            'date' => 'Дата создания',
            'id_user' => 'Id User',
        ];
    }

    /**
     * Gets query for [[Answers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::class, ['id_theme' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }

    public function getStatusText()
    {
        switch ($this->status){
            case 1: return 'Ожидание модерации';
            case 2: return 'Одобрена';
            case 3: return 'Отклонена';
        }
    }

    public function approve()
    {
        $this->status=2;
        $this->save();
    }
    public function reject()
    {
        $this->status=3;
        $this->save();
    }
}
