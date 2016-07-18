$(document).on("pjax:timeout", function(event) {
  // Prevent default timeout redirection behavior
  event.preventDefault()
});

//Call Pjax
$("document").ready(function(){
    setInterval(function(){
        if($("modal:hover").length == 0){
        	reloadMap();
        }
		if($("#navbar-menu-game:hover").length == 0){
			reloadHeader();
		}
    }, config["refresh_time"]); //Reload map
});

// Call Pjax Functions
function reloadMap(){
	$.pjax.reload({container:"#map_content", async:false});
}
function reloadHeader(){
	$.pjax.reload({container:"#navbar-menu-game-data", async:false});
}

// New JS after refresh
$(document).on("pjax:end", function() {
  // tooltips
  $("[data-toggle=tooltip]").tooltip();

  // popover
  $("[data-toggle=popover]").popover();

});

// function used to show Modals
function ShowModal(content){$("#modal-view").modal("show").find("#modal-view-Content").html(content);}
function HideModal(content){$("#modal-view").modal("hide");}

// Popover
function close_popover(id){$(id).popover("hide");}
function getPopover(object){
	var land_position = object.position();
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
    
    var returned = {popover_id:popover_id, popover_name:popover_name};
    return returned;
}

// Function used to call PHP Ajax function 
function CallAjaxMethod(action, args, modal) {
	// URL
	var url = config["url"]["ajax"] + "/"+action+"&args="+args;
    
	// Land
	//var land_name = $("img[i="+land_id+"]").attr("alt");
	
	// Popover
	//var popover = getPopover($("img[i="+land_id+"]"));
    
	$.ajax({
        url: url,
        dataType : "html",          
        beforeSend:function(){
            /*switch (modal[0]) {
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
            }*/
        	//ShowModal();
     },
        success: function(data) {
            /*switch (show_modal) {
                case 2:
                    $("#modal-view").modal("show").find("#modal-view-Content").html(data);
                    break;

                 case 1:
                    $(popover_id+" .popover-content").html(data);
                    break;
                
                default:
                    $.pjax.reload({container:"#map"});
                    break;
            }*/
        	alert("OK");
        	reloadMap();
        	reloadHeader();
        },
        error: function(){    
        	alert("error : " + url);
            /*switch (show_modal) {
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
            }*/
        }
    });
}

// New turn
$(document).on("click", "#end_of_turn_link", function(){
    $("#end_of_turn_link").html("<font color=white> " + config["text"]["turn_finished"] + " !</font>");
    $("#end_of_turn_link").attr("origin", "");
	CallAjaxMethod("newturn", new Array(), new Array());
    $(".modal-dialog ").css({"top" : "75px"});
});