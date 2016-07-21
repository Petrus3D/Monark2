// Fade
function actionObjectFade(object, action, params="", speed=null){if(speed == null)speed = 'slow';$(object).fadeOut(speed, function() {$(object)[action](params);$(object).fadeIn(speed);});}

//Popover
function close_popover(id){$(id).popover("hide");}
function getPopover(position){
	var top = position.top + 130;
	var left = position.left + 200;
	var popover_name = "#popover-view-"+land_id;
	
    $(popover_name).popover({
        "trigger": "manual",
        "placement": "right",
        "html" : true,
    }).popover("show");
    
    var popover_id = "#"+$(popover_name).attr("aria-describedby");
    $(popover_id).css("top", top+"px");
    $(popover_id).css("left", left+"px");
    
    return {"popover_id":popover_id, "popover_name":popover_name};
}