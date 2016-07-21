$(document).on("pjax:timeout", function(event) {
  // Prevent default timeout redirection behavior
  event.preventDefault()
});

//Call Pjax
$("document").ready(function(){
	// No connection lost
	HideLostConnection();
    
    setInterval(function(){
        if(!$("modal").is(':visible')){
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

// Pjax success
$(document).on('pjax:success', function() {
	HideLostConnection();
    event.preventDefault();
});

// Lost server connection
$('#pjax').on('pjax:error', function (event, error) {
	ShowLostConnection();
    event.preventDefault();
});

// Show / Hide lost connection
function ShowLostConnection(){$('#lost_connection_text').show();}
function HideLostConnection(){$('#lost_connection_text').hide();}

//New JS after refresh
$(document).on("pjax:end", function() {
  // tooltips
  $("[data-toggle=tooltip]").tooltip();

  // popover
  $("[data-toggle=popover]").popover();
});

// function used to show Modals
function ShowModalLoading(args){ShowModal();UpdateModalTitle(args);$("#modal-view").find("#modal-view-Content").html(config["text"]["modal_loading_content"]);}
function UpdateModalTitle(args){if(args['title_with_land_name']){args['title'] = args['land_name'] + " " + args['title'];}$(".modal-header-title").html("<center><h4>"+args['title']+"</h4></center>");}
function UpdateModalContent(args){actionObjectFade($("#modal-view").find("#modal-view-Content"), "html", args['content']);}
function UpdateModalError(){UpdateModalContent({'content': config["text"]["modal_error_content"]});}
function ShowModal(){actionObjectFade($("#modal-view"), "modal", "show", 100);}
function HideModal(){actionObjectFade($("#modal-view"), "modal", "hide", 100);}
function ModalInfo(){$("#modal-view").addClass("modal modal-info");}
function ModalError(){$("#modal-view").addClass("modal modal-danger");}

// Animations
function actionObjectFade(object, action, params="", speed=null){if(speed == null)speed = 'slow';$(object).fadeOut(speed, function() {$(object)[action](params);$(object).fadeIn(speed);});}

// Popover
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

// Land
function getLandData(land){
	var land_name 		= $("img[i="+land+"]").attr("alt");
	var land_position 	= $("img[i="+land+"]").position();
	
	return {"land_id":land, "land_name":land_name, "land_position":land_position};
}

// Function used to call PHP Ajax function 
function CallAjaxMethod(action, args, modal=null, land=null) {
	// URL
	var url = config["url"]["ajax"] + "/"+action+"&args="+ JSON.stringify(args);
	
	// Land
	if(land != null){
		var land = getLandData(land);
		modal["land_name"] = land["land_name"];
	}
			
	// Popover
    
	// Ajax call
	$.ajax({
        url: url,
        dataType : "html",  
        mimeType: "application/json",
        beforeSend:function(){
        	// Modal
        	if(modal != null){ShowModalLoading(modal);}

        },
        success: function(data) {
        	// If no error
        	if(data != config["ajax"]["error"]){
        		// Modal
            	if(modal != null){modal['content'] = data;UpdateModalContent(modal);ModalInfo();}
            	          
            	reloadMap();
            	reloadHeader();
        	}else{
        		// Modal
        		if(modal != null){UpdateModalError();ModalError();}
        	}
        },
        error: function(){    
        	alert("error : " + url);
        	// Modal
        	if(modal != null){UpdateModalError();ModalError();}
        	
        }
    });
}

// Land interaction
$(document).on("click", ".land_content", function(){
    var land_id = $(this).attr("i");
    CallAjaxMethod("landinfo", {"land_id":land_id}, {'title': "", 'title_with_land_name' : true}, land_id);
});

// New turn
$(document).on("click", "#end_of_turn_link", function(){
    $("#end_of_turn_link").html("<font color=white> " + config["text"]["turn_finished"] + " !</font>");
    $("#end_of_turn_link").attr("origin", "");
	CallAjaxMethod("newturn", new Array(), null);
    $(".modal-dialog ").css({"top" : "75px"});
});