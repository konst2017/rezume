<?php

/* @var $this yii\web\View */

$this->title = 'Админпанель';
?>
<div class="site-index">

    <div class="mainmenu hidden-sm hidden-xs">


        <ul id="navbar">
            <li><a href="#">Главная</a></li>


            <li><a href="#">Резюме</a>

                <ul>
                    <li><a href="<?= \yii\helpers\Url::to(['product/index']) ?>">Просмотр</a></li>

                </ul>


            </li>


        </ul>


    </div>

</div>
</div>
