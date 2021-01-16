<?php

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



    

     
     
        
<?php if( !empty($products) ): ?>
					 <?php $i = 0;	 foreach($products as $product): ?>
					  <?php $mainImg = $product->getImage();?>
                    <div class="vakancy-page-block company-list-search__block resume-list__block p-rel mb16">
                        <div class="company-list-search__block-left">
						 <div class="resume-list__block-img mb8">
                           <?= Html::img($mainImg->getUrl('268x249'), ['alt' => $product->name])?>  
						   </div>
                        </div>
						
						
                        <div class="company-list-search__block-right">
						
                           
                      
							
							 <h3 class="mini-title mobile-off"><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $product->id]) ?>"><?= $product->name?></a></h3>
                            <div class="d-flex align-items-center flex-wrap mb8 ">
							
							 <p>  
                             ФИО:<?= $product->im?> 
                                 <?= $product->fam?> <br>
							Возраст:<?= $product->wozr?> <br>	 
							 Дата обновления:<?= $product->addtime?><br>
							 Специализация: <?= $product->spez?><br>
							 Город проживания:<?= $product->city?> <br>
                            	Опыт работы:<?=$product->keywords?><br>
								Последнее место работы: <?=$product->description?><br>   
							Зарплата:<?= $product->price?></p>
							
  
                            </div>
                           
                        </div>
                        <div class="company-list-search__block-middle">
                         
                        </div>
                    </div>
					
		  <?php $i++?>
            <?php if($i % 3 == 0): ?>
                <div class="clearfix"></div>
            <?php endif;?>
            <?php endforeach;?>
        <div class="clearfix"></div>
		 <div class="content">
        <?php
        echo \yii\widgets\LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
        <?php else :?>
        <h2>Здесь товаров пока нет......</h2>
    <?php endif;?>			


   
			   
                </div> 
                </div>