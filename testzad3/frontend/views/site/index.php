<?php

/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use frontend\models\Category;
use frontend\models\Product;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use kartik\select2\Select2;

?>

<?php
if (!empty($hits)): ?>
<?php
$i = 0;
foreach ($hits as $hit): ?>
    <?php
    $mainImg = $hit->getImage(); ?>
    <div class="vakancy-page-block company-list-search__block resume-list__block p-rel mb16">
        <div class="company-list-search__block-left">
            <div class="resume-list__block-img mb8">
                <?= Html::img($mainImg->getUrl('268x249'), ['alt' => $hit->name]) ?>
            </div>
        </div>
        <div class="company-list-search__block-right">
            <h3 class="mini-title mobile-off"><a
                        href="<?= \yii\helpers\Url::to(['product/view', 'id' => $hit->id]) ?>"><?= $hit->name ?></a>
            </h3>
            <div class="d-flex align-items-center flex-wrap mb8 ">
                <p>
                    ФИО:<?= $hit->im ?>
                    <?= $hit->fam ?> <br>
                    Возраст:<?= $hit->wozr ?> <br>
                    Дата обновления:<?= $hit->addtime ?><br>
                    Специализация: <?= $hit->spez ?><br>
                    Город проживания:<?= $hit->city ?> <br>
                    Опыт работы:<?= $hit->keywords ?><br>
                    Последнее место работы: <?= $hit->description ?><br>
                    Зарплата:<?= $hit->price ?></p>
            </div>
        </div>
        <div class="company-list-search__block-middle">
        </div>
    </div>
    <?php
    $i++ ?>
    <?php
    if ($i % 3 == 0): ?>
        <div class="clearfix"></div>
    <?php
    endif; ?>
<?php
endforeach; ?>
<div class="clearfix"></div>
<div class="content">
    <?php
    echo \yii\widgets\LinkPager::widget
    (
        [
            'pagination' => $pages,
        ]
    );
    ?>
    <?php
    else : ?>
        <h2>Здесь товаров пока нет......</h2>
    <?php
    endif; ?>
</div>
</div>
               
  
