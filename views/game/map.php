<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Progress;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Map');
$refresh_time = $RefreshTime;


/* Reload map JS */
$this->registerJs('$(document).on("pjax:timeout", function(event) {
  // Prevent default timeout redirection behavior
  event.preventDefault()
});');

$this->registerJs(
		'$("document").ready(function(){
        setInterval(function(){
            if($("modal:hover").length == 0){
                $.pjax.reload({container:"#map_content", async:false});
            }
			if($("#navbar-menu-game:hover").length == 0){
				$.pjax.reload({container:"#navbar-menu-game-data", async:false});
			}
        }, '.$refresh_time.'); //Reload map
    });
	// New JS after refresh
    $(document).on("pjax:end", function() {
      // tooltips
      $("[data-toggle=tooltip]").tooltip();

      // popover
      $("[data-toggle=popover]").popover();

	});	');

// Show Modal
$this->registerJs('
	function ShowModal(){
		
	/* popover */
	// Functions
	function close_popover(id){$(id).popover("hide");}
	
	// Init
	var land_position = $("img[i="+land_id+"]").position();
	var land_name = $("img[i="+land_id+"]").attr("alt");
	var top = land_position.top + 130;
	var left = land_position.left + 200;
	var popover_name = "#popover-view-"+land_id;
	$(popover_name).popover({
		"trigger": "manual",
		"placement": "right",
		"html" : true,
	}).popover("show");
	var popover_id = "#"+$(popover_name).attr("aria-describedby");
	$(popover_id).css("top", top+"px");
	$(popover_id).css("left", left+"px");
		
}');

// Function Ajax
$this->registerJs('
    function CallAjaxMethod(action, args, modal) {
		var url = "'.Yii::$app->urlManager->createUrl(['ajax']).'/"+action+"&args="+args;
		$.ajax({
            url: url,
            dataType : "html",          
            beforeSend:function(){
                switch (modal[0]) {
                    case 2:
                        $("#modal-view").modal("show").find("#modal-view-Content").html("<center><font size=3>'.Yii::t('map', 'Modal_Loading').'...</font><br><img src=img/loading.gif></center>");
                        break;

                     case 1:
                        $("#modal-view").modal("hide");                        
                        $(popover_id+" .popover-content").html("<center><font size=3>'.Yii::t('map', 'Modal_Loading').'...</font><br><img src=img/loading.gif></center>")
                        break;
                    
                    default:
                        $.pjax.reload({container:"#map"});
                        break;
                }
            },
            success: function(data) {
                switch (show_modal) {
                    case 2:
                        $("#modal-view").modal("show").find("#modal-view-Content").html(data);
                        break;

                     case 1:
                        $(popover_id+" .popover-content").html(data);
                        break;
                    
                    default:
                        $.pjax.reload({container:"#map"});
                        break;
                }
            },
            error: function(){    
                switch (show_modal) {
                    case 2:
                        alert(url);
                        $("#modal-view").modal("show").find("#modal-view-Content").html("Erreur lors de la connexion au serveur");
                        break;

                     case 1:
                        $(popover_id+" .popover-content").html("Erreur lors de la connexion au serveur");
                        break;
                    
                    default:
                        $.pjax.reload({container:"#map"});
                        break;
                }
            }
        });
	}
');
// New turn
$this->registerJs(
		'$(document).on("click", "#end_of_turn_link", function(){
        $("#end_of_turn_link").html("<font color=white>'.Yii::t('map', 'Text_Turn_Finished').' !</font>");
        $("#end_of_turn_link").attr("origin", "");
		CallAjaxMethod("newturn", new Array(), new Array(1));
        $(".modal-dialog ").css({"top" : "75px"});
    });'
		);
?>

<div class="map-show">
	<!-- Modals Js -->
    <?php
        Modal::begin(['id' => 'modal-view','header' => '<div class="modal-header-title"></div>',]);
        echo "<div id='modal-view-Content'></div>";
        Modal::end();
    ?>
    <!-- End Modal Js -->

	<?php Pjax::begin(['id' => 'map_content']); ?>
	<div id='map_content'>
		<?php $user_units = 0; ?>
		
		<?php foreach ($GameData as $data): ?>
			
			<?php $land = $Land[$data->getGameDataLandId()]; ?>    
			<div class="land_content" i=<?= "'".$land->getLandId()."'"; ?>>
	              <a href=<?= "'#".str_replace("'", "-", $land->getLandName())."'"; ?> class="link_land_img" style=<?= "'top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;text-decoration: none;'"; ?>>
	                    <img src=<?= "'".$land->getLandImageUrl($Color[$GamePlayer[$data->getGameDataUserId()]->getGamePlayerColorId()]->getColorName2())."'"; ?> i=<?= "'".$land->getLandId()."'"; ?> alt=<?= "'".$land->getLandName()."'"; ?> class="land_img" 
	                    style=<?= "'top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;'"; ?>> 
	                    <!--<div class="building" style=<?= "'position:absolute;top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;'"; ?>>
	                        <?php //if($value['land_harbor']): ?>
	                            <img src='img/harbor.png' height='20px' width='20px' style='position:relative;top:24px;left:10px;'>
	                        <?php //endif; ?>
	                    </div>-->
	                </a>
	               <div class="land_title" style=<?= "'top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;'"; ?>>
                        <font color=<?= "'".$Color[$GamePlayer[$data->getGameDataUserId()]->getGamePlayerColorId()]->getColorName()."'"; ?>>
                            <?= $land->getLandName(); ?>
                            <?php //if(isset($user_frontier_array[$value['land_id']])){echo "(".$data->getGameDataUnits().")";} ?>
                            <?php if($data->getGameDataCapital() >= 1): ?>
                                <?= "<img src='img/star.png' height='20px' width='20px'>"; ?>
                            <?php endif; ?>
                            <?php if($data->getGameDataRessourceId() > 0 && $Ressource[$data->getGameDataRessourceId()]->getRessourceImage() != ""): ?>
                                <?= "<img src='".$Ressource[$data->getGameDataRessourceId()]->getRessourceImageUrl()."' height='20px' width='20px'>"; ?>
                            <?php endif; ?>
                        </font>
	                  <?php //if(isset($user_frontier_array[$value['land_id']])): ?>
	                     <?php if($data->getGameDataUserId() == $User->getUserID()){$user_units+=$data->getGameDataUnits();} ?><br>
	                    	<?php $nb_canon = (int)($data->getGameDataUnits()/10);$nb_horseman = (int)(fmod($data->getGameDataUnits(), 10)/5);$nb_soldier = (int)(fmod(fmod($data->getGameDataUnits(), 10), 5)); ?>
	                    	<?php for($i=1; $i <= $nb_canon; $i++): ?>
	                       		<img src='img/canon.png' class='land_canon' style=<?= "'left:".$i."px;'"; ?>>
	                   		<?php endfor; ?>
	                    	<?php for($i=1; $i <= $nb_horseman; $i++): ?>
	                        	<img src='img/horseman.png' class='land_horseman' style=<?= "'left:".$i."px;'"; ?>>
	                    	<?php endfor; ?>
	                    	<?php for($i=1; $i <= $nb_soldier; $i++): ?>
	                    		<img src='img/soldier.png' class='land_soldier' style=<?= "'left:".$i."px;'"; ?>>
	                  		<?php endfor; ?>
	                  <?php //endif; ?>
                  </div>
	        </div>
		<?php endforeach; ?>
	
	</div>
	<?php Pjax::end(); ?>
</div>
						