<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Progress;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Map');
?>

<?php //Pjax::begin(['id' => 'map', 'timeout' => 5000]); ?>
<div id='map_content'>
	<?php $user_units = 0; ?>
	
	<?php foreach ($GameData as $data): ?>
		
		<?php $land = $Land[$data->getGameDataLandId()]; ?>    
		<div class="land_content" i=<?= "'".$land->getLandId()."'"; ?>>
              <a href=<?= "'#".str_replace("'", "-", $land->getLandName())."'"; ?> class="link_land_img" style=<?= "'top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;text-decoration: none;'"; ?>>
                    <img src=<?= "'".$land->getLandImageTempUrl($GamePlayer[$data->gameDataUserId()])."'"; ?> i=<?= "'".$value['land_id']."'"; ?> alt=<?= "'".$value['landname']."'"; ?> class="land_img" style=<?= "'top:".$value['position_top']."em;left:".$value['position_left']."em;'"; ?>> 
                    <!--<div class="building" style=<?= "'position:absolute;top:".$value['position_top']."em;left:".$value['position_left']."em;'"; ?>>
                        <?php //if($value['land_harbor']): ?>
                            <img src='img/harbor.png' height='20px' width='20px' style='position:relative;top:24px;left:10px;'>
                        <?php //endif; ?>
                    </div>-->
                </a> 
        </div>
        
	<?php endforeach; ?>

</div>
<?php //Pjax::end(); ?>