<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\web\UploadedFile;

?>





    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
           
           
            
            <img src="/images/product-details/rating.png" alt="" />
								<span>
								
													  <?php $mainImg = $product->getImage();?>
													  	 <?= Html::img($mainImg->getUrl('268x249'), ['alt' => $hit->name])?>
                            <h2><?= $product->name?></h2>
							 <h2><?=   $product->im?></h2>
							 <h4><?=   $product->wozr?></h4>
							  <h4><?=   $product->zan?></h4>
							    <h4><?=   $product->grafrab?></h4>
								 <h4><?=   $product->city?></h4>
								  <h4><?=   $product->tel?></h4>
								   <h4><?=   $product->pohta?></h4>
								  
									<h4>Зарплата<?= $product->price?></h4>
									  <h4>Опыт работы:<?=$product->keywords?></h4>
								<h4>Последнее место работы: <?=$product->description?></h4>   
									
				<h4>Обязанности, функции, достижения:</h4>					
			
            <a href=""><img src="/images/product-details/share.png" class="share img-responsive"  alt="" /></a>
            <?= $product->content?>
			
			<a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $product->id])?>" data-id="<?= $product->id?>" class="btn btn-fefault add-to-cart cart">
                                     Договориться 
                                    </a>
			
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->


<br><br>
    <br>
<br><br>
    <br>



