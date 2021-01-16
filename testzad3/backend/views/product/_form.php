<?php

use yii\helpers\ArrayHelper;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

mihaildev\elfinder\Assets::noConflict($this);

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
use backend\assets\ltAppAsset;
use backend\models\City;
use yii\bootstrap4\Modal;

//use kartikForm\ActiveForm;
use kartik\datecontrol\DateControl;

// use yii\jui\DatePicker;
use kartik\date\DatePicker;
use kartik\select2\Select2;

AppAsset::register($this);
ltAppAsset::register($this);
$this->title = 'My Yii Application';
/* @var $this yii\web\View */
/* @var $model backend\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php
    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'im')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'fam')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'wozr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pol')->dropDownList(
        ['Выбирете пол' => 'Выберите пол', 'мужчина' => 'мужчина', 'женщина' => 'женщина']
    ) ?>






    <?= $form->field($model, 'spez')->dropDownList(
        [
            'Выбирете специализацию' => 'Выберите специализацию',
            'адм' => 'Администратор баз данных',
            'Аналитик' => 'Аналитик',

            'Арт-директор' => 'Арт-директор',
            'Инженер' => 'Инженер',
            'Компьютерная безопасность' => 'Компьютерная безопасность',
            'Контент' => 'Контент',
            'Маркетинг' => 'Маркетинг',
            'Мультимедиа' => 'Мультимедиа',
            'Оптимизация сайта (SEO)' => 'Оптимизация сайта (SEO)',
            'Передача' => 'Передача данных и доступ в интернет',
            'Программирование, Разработка' => 'Программирование, Разработка',
            'Продажи' => 'Продажи',
            'Продюсер' => 'Продюсер',
            'Развитие бизнеса' => 'Развитие бизнеса',


            'Системный администратор' => 'Системный администратор',
            'Системы управления предприятием (ERP)' => 'Системы управления предприятием (ERP)',
            'Сотовые, Беспроводные технологии' => 'Сотовые, Беспроводные технологии',
            'Стартапы' => 'Стартапы',
            'Телекоммуникации' => 'Телекоммуникации',
            'Тестирование' => 'Тестирование',
            'Технический писатель' => 'Технический писатель',
            'Управление проектами' => 'Управление проектами',
            'Электронная коммерция' => 'Электронная коммерция',
            'CRM системы' => 'CRM системы',
            'Web инженер' => 'Web инженер',
            'Web мастер' => 'Web мастер'


        ]
    ) ?>







    <?= $form->field($model, 'grafrab')->dropDownList(
        [
            'Выбирете работы' => 'Выберите график работы',
            'Полный день' => 'Полный день',
            'Сменный график' => 'Сменный график',

            'Гибкий график' => 'Гибкий график',
            'Удалённая работа' => 'Удалённая работа',
            'Вахтовый метод' => 'Вахтовый метод'
        ]
    ) ?>
    <?= $form->field($model, 'zan')->dropDownList(
        [
            'Выбирете занятость' => 'Выберите занятость',
            'Полная занятость' => 'Полная занятость',
            'Частичная занятость' => 'Частичная занятость',
            'Проектная/Временная работа' => 'Проектная/Временная работа',
            ' Волонтёрство' => 'Волонтёрство',
            'Стажировка' => 'Стажировка'
        ]
    ) ?>
    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>
    <?php
    echo $form->field($model, 'content')->widget(
        CKEditor::className(),
        [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder', [])
        ]
    );
    ?>





    <?= $form->field($model, 'keywords')->dropDownList(
        [
            'Опыт работы' => 'Опыт работы',
            'Без опыта' => 'Без опыта',
            'От 1 года до 3 лет' => 'От 1 года до 3лет',
            'От 3 лет до 6 лет' => 'От 3 лет до 6 лет',
            'Более 6 лет' => 'Более 6 лет'
        ]
    ) ?>
















    <?php

    echo $form->field($model, 'city')
        ->widget(
            kartik\select2\Select2::className(),
            [
                'data' => \yii\helpers\ArrayHelper::map(
                    \backend\models\City::find()->groupBY('name')->All(),
                    'name',
                    'name'
                )
            ]
        );

    ?>


    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'image')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php
    ActiveForm::end(); ?>

</div>
