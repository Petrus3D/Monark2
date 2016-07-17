$(document).on("pjax:timeout", function(event) {
  // Prevent default timeout redirection behavior
  event.preventDefault()
});

// New JS after refresh
$(document).on("pjax:end", function() {
  // tooltips
  $("[data-toggle=tooltip]").tooltip();

  // popover
  $("[data-toggle=popover]").popover();

});

// function used to show Modals
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
		
}

// Function used to call PHP Ajax function 
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

// New turn
$(document).on("click", "#end_of_turn_link", function(){
    $("#end_of_turn_link").html("<font color=white>'.Yii::t('map', 'Text_Turn_Finished').' !</font>");
    $("#end_of_turn_link").attr("origin", "");
	CallAjaxMethod("newturn", new Array(), new Array(1));
    $(".modal-dialog ").css({"top" : "75px"});
});