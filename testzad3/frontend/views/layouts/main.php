<!DOCTYPE html>
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
use frontend\assets\AppAsset;
use frontend\assets\ltAppAsset;
use frontend\models\City;
use yii\bootstrap4\Modal;
use kartik\datecontrol\DateControl;
use yii\jui\DatePicker;
use kartik\select2\Select2;

AppAsset::register($this);

use frontend\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

AppAsset::register($this);

use yii\data\Pagination;

?>
<?php
$this->beginPage() ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Список резюме</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/a4e584b747.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
    <?php
    $this->head() ?>
</head>
<body>

<?php
$this->beginBody() ?>
<div class="main-wrapper">
    <header class="header">
        <div class="container">
            <nav class="navbar navigation">
                <a href=".." class="navbar-brand" href="#"><img src="images/logo.svg" alt="Logo">
                </a>
                <div class="header__login header__login-mobile">
                </div>
                <ul class="navigation-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Резюме</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="#">Мои резюме</a>
                    </li>

                    <li><a class="drop" href="#">Пользователи</a>
                        <ul>
                            <?php
                            if (Yii::$app->user->isGuest) {
                                ?>

                                <li><a href="<?= \yii\helpers\Url::to(['/site/signup']) ?>">Регистрация</a></li>
                                <li><a href="<?= \yii\helpers\Url::to(
                                        ['http://localhost/testzad3/backend/web/index.php'],
                                        'https'
                                    ) ?>">Вход</a></li>


                                <?
                            } else {
                                ?>
                                <li><a href="<?= \yii\helpers\Url::to(['/site/logout']) ?>">Выход</a></li>


                                <?php
                            } ?>
                        </ul>
                    </li>


                </ul>
                <div class="navigation-menu__mobile">
                    <ul class="navigation-menu__mobile-nav">
                        <div class="navigation-menu__mobile-nav-top">
                            <li class="navigation-menu__mobile-nav-item active">
                                <a class="nav-link" href="#">Резюме</a>
                            </li>
                            <li class="navigation-menu__mobile-nav-item">
                                <a class="nav-link" href="#">Мои резюме</a>
                            </li>

                            <li><a class="drop" href="#">Пользователи</a>
                                <ul>
                                    <?php
                                    if (Yii::$app->user->isGuest) {
                                        ?>

                                        <li><a href="<?= \yii\helpers\Url::to(['/site/signup']) ?>">Регистрация</a></li>
                                        <li><a href="<?= \yii\helpers\Url::to(
                                                ['http://localhost/testzad3/backend/web/index.php'],
                                                'https'
                                            ) ?>">Вход</a></li>


                                        <?
                                    } else {
                                        ?>
                                        <li><a href="<?= \yii\helpers\Url::to(['/site/logout']) ?>">Выход</a></li>


                                        <?php
                                    } ?>
                                </ul>
                            </li>
                        </div>
                    </ul>
                </div>
                <div class="navigation-toggler">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </nav>
        </div>
    </header>


    <div class="header-search">
        <div class="container">
            <div class="header-search__wrap">
                <form class="header-search__form" method="get"
                      action="<?= \yii\helpers\Url::to(['category/search']) ?>">
                    <a href="#"><img src="images/dark-search.svg" alt="search"
                                     class="dark-search-icon header-search__icon"></a>
                    <input class="header-search__input" type="text" name="q" placeholder="Поиск по резюме и навыкам">
                    <button type="submit" class="blue-btn header-search__btn">Найти</button>
                </form>


            </div>
        </div>
    </div>


    <div class="content">
        <div class="container">

            <button class="vacancy-filter-btn">Фильтр</button>
            <div class="row">
                <div class="col-lg-9 desctop-992-pr-16">
                    <div class="d-flex align-items-center flex-wrap mb8">

                        <div class="vakancy-page-header-dropdowns">


                            <div class="vakancy">


                                <nav>
                                    <ul>

                                        <li><a href="#">Поиск по критериям</a>

                                            <!-- первый уровень выпадающего списка -->
                                            <ul>
                                                <li><a href="<?= \yii\helpers\Url::to(['/poisk/new']) ?>">По новизне</a>
                                                </li>
                                                <li><a href="<?= \yii\helpers\Url::to(['/poisk/wozzap']) ?>">По
                                                        возрастанию цены</a></li>
                                                <li><a href="<?= \yii\helpers\Url::to(['/poisk/ubzap']) ?>">По убыванию
                                                        цены</a></li>

                                            </ul>

                                        </li>

                                    </ul>
                                </nav>
                                <br> <br>
                            </div>
                        </div>


                    </div>


                    <?= $content ?>

                    <div class="col-lg-3 desctop-992-pl-16 d-flex flex-column vakancy-page-filter-block vakancy-page-filter-block-dnone">
                        <div
                                class="vakancy-page-filter-block__row mobile-flex-992 mb24 d-flex justify-content-between align-items-center">
                            <div class="heading">Фильтр</div>
                            <img class="cursor-p" src="images/big-cancel.svg" alt="cancel">
                        </div>
                        <div class="signin-modal__switch-btns-wrap resume-list__switch-btns-wrap mb16">
                            <a href="#" class="signin-modal__switch-btn active">Все</a>


                            <a href="<?= \yii\helpers\Url::to(['/poisk/muh']) ?>" class="signin-modal__switch-btn ">Мужчины</a>
                            <a href="<?= \yii\helpers\Url::to(['/poisk/zen']) ?>" class="signin-modal__switch-btn ">Женщины</a>
                        </div>


                        <div class="vakancy-page-filter-block__row mb24">

                            <div class="citizenship-select">


                                <form class="header-search__form" method="get"
                                      action="<?= \yii\helpers\Url::to(['site/index']) ?>">

                                    <div class="block3">
                                        <?php
                                        $price = trim(Yii::$app->request->get('price'));
                                        $city = trim(Yii::$app->request->get('city[]'));
                                        $spez = trim(Yii::$app->request->get('spez'));
                                        $nahzap = trim(Yii::$app->request->get('nahzap'));
                                        $konzap = trim(Yii::$app->request->get('konzap'));
                                        $nahwoz = trim(Yii::$app->request->get('nahwoz'));
                                        $konwoz = trim(Yii::$app->request->get('konwoz'));
                                        $polz = trim(Yii::$app->request->get('polz'));
                                        $hasz = trim(Yii::$app->request->get('hasz'));
                                        $prz = trim(Yii::$app->request->get('prz'));
                                        $wol = trim(Yii::$app->request->get('wol'));
                                        $staz = trim(Yii::$app->request->get('staz'));

                                        $pold = trim(Yii::$app->request->get('pold'));
                                        $smeng = trim(Yii::$app->request->get('smeng'));
                                        $udal = trim(Yii::$app->request->get('udal'));
                                        $waht = trim(Yii::$app->request->get('waht'));


                                        $bez = trim(Yii::$app->request->get('bez'));
                                        $per1 = trim(Yii::$app->request->get('per1'));
                                        $per2 = trim(Yii::$app->request->get('per2'));
                                        $per3 = trim(Yii::$app->request->get('per3'));

                                        ?>

                                        <label class="control-label" for="product-price">Зарплата</label>
                                        <input class="" type="text" name="price" value='<?= Html::encode($price) ?>'
                                               placeholder="Поиск зарплата">

                                        <br>
                                        <label class="control-label" for="product-price">Город</label>
                                        <?php
                                        echo Select2::widget(
                                            [
                                                'name' => 'city',
                                                'data' => \yii\helpers\ArrayHelper::map(
                                                    \backend\models\City::find()->groupBY('name')->All(),
                                                    'name',
                                                    'name'
                                                ),
                                                'options' => [
                                                    'placeholder' => 'Выберете город',
                                                    'multiple' => true
                                                ],
                                            ]
                                        );
                                        ?>
                                        <label class="control-label" for="product-price">Специализация</label>
                                        <?php
                                        echo Select2::widget(
                                            [
                                                'name' => 'spez',
                                                'data' => [
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
                                                ],
                                                'options' => [
                                                    'placeholder' => 'Выбирете специализацию',
                                                    'options' => [
                                                        3 => ['disabled' => true],
                                                        4 => ['disabled' => true],
                                                    ]
                                                ],
                                            ]
                                        );
                                        ?>


                                        <label class="control-label" for="product-price">Нач зарплата</label>
                                        <input class="" type="text" name="nahzap" value='<?= Html::encode($nahzap) ?>'
                                               placeholder="Поиск начзарпалты">
                                        <label class="control-label" for="product-price">Кон зарплата</label>
                                        <input class="" type="text" name="konzap" value='<?= Html::encode($konzap) ?>'
                                               placeholder="Конзарплата">


                                        <label class="control-label" for="product-price">Нач возраст</label>
                                        <input class="" type="text" name="nahwoz" value='<?= Html::encode($nahwoz) ?> '
                                               placeholder="Нач возраст">
                                        <label class="control-label" for="product-price">Кон возраст</label>
                                        <input class="" type="text" name="konwoz" value='<?= Html::encode($konwoz) ?> '
                                               placeholder="Кон возраст">

                                        <label class="control-label" for="product-price">Занятость</label>
                                        <?php
                                        if ($polz != "") { ?>
                                            <p><input type="checkbox" name="polz" checked value="Полная занятость">Полная
                                                занятость</p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($polz == "") { ?>
                                            <p><input type="checkbox" name="polz" value="Полная занятость">Полная
                                                занятость</p>
                                            <?php
                                        } ?>



                                        <?php
                                        if ($hasz != "") { ?>
                                            <p><input type="checkbox" name="hasz" checked value="Частичная занятость">Частичная
                                                занятость</p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($hasz == "") { ?>
                                            <p><input type="checkbox" name="hasz" value="Частичная занятость">Частичная
                                                занятость</p>
                                            <?php
                                        } ?>



                                        <?php
                                        if ($prz != "") { ?>
                                            <p><input type="checkbox" name="prz" checked
                                                      value="Проектная/Временная работа">Проектная/Временная работа</p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($prz == "") { ?>
                                            <p><input type="checkbox" name="prz" value="Проектная/Временная работа">Проектная/Временная
                                                работа</p>
                                            <?php
                                        } ?>



                                        <?php
                                        if ($wol != "") { ?>
                                            <p><input type="checkbox" name="wol" checked value="Волонтёрство">Волонтёрство
                                            </p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($wol == "") { ?>
                                            <p><input type="checkbox" name="wol" value="Полная занятость">Волонтёрство
                                            </p>
                                            <?php
                                        } ?>



                                        <?php
                                        if ($staz != "") { ?>
                                            <p><input type="checkbox" name="staz" checked value="Стажировка">Стажировка
                                            </p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($staz == "") { ?>
                                            <p><input type="checkbox" name="staz" value="Стажировка">Стажировка</p>
                                            <?php
                                        } ?>

                                        <label class="control-label" for="product-price">График работы</label>


                                        <?php
                                        if ($pold != "") { ?>
                                            <p><input type="checkbox" name="pold" checked value="Полный день">Полный
                                                день</p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($pold == "") { ?>
                                            <p><input type="checkbox" name="pold" value="Полный день">Полный день</p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($smeng != "") { ?>
                                            <p><input type="checkbox" name="smeng" checked value="Сменный график">Сменный
                                                график</p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($smeng == "") { ?>
                                            <p><input type="checkbox" name="smeng" value="Сменный график">Сменный график
                                            </p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($udal != "") { ?>
                                            <p><input type="checkbox" name="udal" checked value="Удалённая работа">Удалённая
                                                работа</p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($udal == "") { ?>
                                            <p><input type="checkbox" name="udal" value="Удалённая работа">Удалённая
                                                работа</p>
                                            <?php
                                        } ?>


                                        <?php
                                        if ($waht != "") { ?>
                                            <p><input type="checkbox" name="waht" checked value="Вахтовый метод">Вахтовый
                                                метод</p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($waht == "") { ?>
                                            <p><input type="checkbox" name="waht" value="Вахтовый метод">Вахтовый метод
                                            </p>
                                            <?php
                                        } ?>

                                        <label class="control-label" for="product-price">Опыт работы</label>


                                        <?php
                                        if ($bez != "") { ?>
                                            <p><input type="checkbox" name="bez" checked value="Без опыта">Без опыта</p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($bez == "") { ?>
                                            <p><input type="checkbox" name="bez" value="Без опыта">Без опыта</p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($per1 != "") { ?>
                                            <p><input type="checkbox" name="per1" checked value="От 1 года до 3 лет">От
                                                1 года до 3 лет</p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($per1 == "") { ?>
                                            <p><input type="checkbox" name="per1" value="От 1 года до 3 лет">От 1 года
                                                до 3 лет</p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($per2 != "") { ?>
                                            <p><input type="checkbox" name="per2" checked value="От 3 года до 6 лет">От
                                                3 года до 6 лет</p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($per2 == "") { ?>
                                            <p><input type="checkbox" name="per2" value="От 3 года до 6 лет">От 3 года
                                                до 6 лет</p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($per3 != "") { ?>
                                            <p><input type="checkbox" name="per3" checked value="Более 6 лет">Более 6
                                                лет</p>
                                            <?php
                                        } ?>

                                        <?php
                                        if ($per3 == "") { ?>
                                            <p><input type="checkbox" name="per3" value="Более 6 лет">Более 6 лет</p>
                                            <?php
                                        } ?>


                                        <button type="submit" class="blue-btn header-search__btn">Поиск с условием
                                        </button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="container">
                        <div class="footer__wrap">
                            <div class="row">
                                <div class="footer__col footer__policy col-lg-3 col-md-12 p-rel">
                                    <a class="footer__logo" href="#"><img src="images/logo.svg" alt="Logo"></a>
                                    <div class="footer__soc-icon">
                                        <a href="#"><img src="images/vk.png" alt="vk"></a>
                                        <a href="#"><img src="images/facebook.png" alt="facebook"></a>
                                        <a href="#"><img src="images/twitter.png" alt="twitter"></a>
                                        <a href="#"><img src="images/instagram.png" alt="instagram"></a>
                                    </div>
                                    <ul class="footer__ul-policy">
                                        <li><a href="#">Все права защищены</a></li>
                                        <li><a href="#">Политика конфиденциальности</a></li>
                                        <li><a href="#">Правила и условия</a></li>
                                    </ul>
                                </div>
                                <div class="footer__col col-lg-3 col-md-12">
                                    <ul class="footer__ul">
                                        <li><a href="#">Компаниям</a></li>
                                        <li><a href="#">О компании</a></li>
                                        <li><a href="#">Наши вакансии</a></li>
                                        <li><a href="#">Защита персональных данных</a></li>
                                        <li><a href="#">Контакты</a></li>
                                        <li><a href="#">Помощь</a></li>
                                        <li><a href="#">Инвесторам</a></li>
                                        <li><a href="#">Партнерам</a></li>
                                    </ul>
                                </div>
                                <div class="footer__col col-lg-3 col-md-12">
                                    <ul class="footer__ul">
                                        <li><a href="#">Соискателям</a></li>
                                        <li><a href="#">Готовое резюме</a></li>
                                        <li><a href="#">Продвижение резюме</a></li>
                                        <li><a href="#">Карьерный консультант</a></li>
                                        <li><a href="#">Автоподнятие резюме</a></li>
                                        <li><a href="#">Профориентация</a></li>
                                        <li><a href="#">Рассылка в агенства</a></li>
                                    </ul>
                                </div>
                                <div class="footer__col col-lg-3 col-md-12">
                                    <ul class="footer__ul">
                                        <li><a href="#">Работодателям</a></li>
                                        <li><a href="#">База резюме</a></li>
                                        <li><a href="#">Кабинет для работодателя</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <?php
            $this->endBody() ?>
</body>
<?php
$this->endPage() ?>
</html>