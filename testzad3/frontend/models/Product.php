<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string|null $content
 * @property int $price
 * @property string|null $keywords
 * @property string|null $description
 * @property string|null $img
 * @property string $hit
 * @property string $new
 * @property string $sale
 * @property string|null $im
 * @property int|null $wozr
 * @property string|null $zan
 * @property string|null $grafrab
 * @property string|null $kontakt
 * @property string|null $pohta
 * @property int|null $tel
 * @property string|null $city
 * @property string|null $fam
 * @property string|null $pol
 * @property string|null $addtime
 * @property string|null $spez
 * @property int|null $nahzap
 * @property int|null $konzap
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $phone;
    public $image;
    public $gallery;

    public function behaviors()
    {
        return [

            [


                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['addtime'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['addtime']
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],

            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ],


        ];
    }

    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name'], 'required'],
            [['category_id', 'price', 'wozr', 'tel', 'nahzap', 'konzap', 'nahwoz', 'konwoz'], 'integer'],
            [['content', 'hit', 'new', 'sale'], 'string'],

            [
                [
                    'name',
                    'keywords',
                    'description',
                    'img',
                    'im',
                    'zan',
                    'grafrab',
                    'kontakt',
                    'pohta',
                    'city',
                    'fam',
                    'pol',
                    'spez'
                ],
                'string',
                'max' => 255
            ],
            [['addtime', 'price'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'content' => 'Content',
            'price' => 'Зарплата',
            'keywords' => 'Опыт работы',
            'description' => 'Description',
            'img' => 'Img',
            'hit' => 'Hit',
            'new' => 'New',
            'sale' => 'Sale',
            'im' => 'Имя',
            'wozr' => 'Возраст',
            'zan' => 'Занятость',
            'grafrab' => 'График работы',
            'kontakt' => 'Kонтакты',
            'pohta' => 'Почта',
            'tel' => 'Телефон',
            'city' => 'Город',
            'fam' => 'Фамилия',
            'pol' => 'Pol',
            'addtime' => 'Addtime',
            'spez' => 'Специализация',
            'nahzap' => 'Начальная зарплата',
            'konzap' => 'Конечная зарплата',
            'nahwoz' => 'Начальный возраст',
            'konwoz' => 'Конечный возраст'
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $path = '../../frontend/web/upload/store/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);
            return true;
        } else {
            return false;
        }
    }

    public function uploadGallery()
    {
        if ($this->validate()) {
            foreach ($this->gallery as $file) {
                $path = '../../frontend/web/upload/store/' . $file->baseName . '.' . $file->extension;
                $file->saveAs($path);
                $this->attachImage($path);
                @unlink($path);
            }
            return true;
        } else {
            return false;
        }
    }

}


