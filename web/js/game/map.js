// Land interaction
$(document).on("click", ".land_content", function (){
    var land_id = $(this).attr("i");
    showLandInfo(land_id);
});

// Buy
// begin
$(document).on("click", ".buy_link", function (){
	$(".buy_link").html("...");
	var land_id = $(this).attr("i");
	showBuyBegin(land_id);
});
// action
$(document).on("click", ".buy_action_link", function showBuyAction(){
	$(".buy_action_link").html("...");
	var land_id = $(this).attr("i");
	var units = $("#input_select_unit_number").val();
	CallAjaxMethodModal("buyaction", {"land_id":land_id, 'units':units}, {'title': " Recrutement en cours...", 'title_with_land_name' : true}, land_id);
});

// Build
// begin
$(document).on("click", ".build_link", function showBuildBegin(){
	$(".build_link").html("...");
	var land_id = $(this).attr("i");
	CallAjaxMethodModal("buildbegin", {"land_id":land_id}, {'title': " Construire", 'title_with_land_name' : true}, land_id);
});
// action
$(document).on("click", ".build_action_link", function showBuildAction(){
	$(".build_action_link").html("...");
	var land_id = $(this).attr("i");
	var building_id = $(this).attr("building_i");
	CallAjaxMethodModal("buildaction", {"land_id":land_id, 'building_id':building_id}, {'title': " Construction en cours...", 'title_with_land_name' : true}, land_id);
});

// Move
// begin
$(document).on("click", ".move_link", function(){
	$(".move_link").html("...");
	var land_id = $(this).attr("i");
	CallAjaxMethodModal("movebegin", {"land_id":land_id}, {'title': " Déplacer des troupes", 'title_with_land_name' : true}, land_id);
});
// action
$(document).on("click", ".move_action_link", function (){
	var land_id = $(this).attr("i");
	var land_id_to = $(this).attr("to_i");
	var units = $("#input_select_unit_number").val();
	$(".build_action_link").html("...");
	showMoveAction(land_id, land_id_to, units);
});


// ATK
// begin
$(document).on("click", ".atk_link", function(){
	$(".atk_link").html("...");
	var land_id = $(this).attr("i");
	showAtkBegin(land_id);
});
// action
$(document).on("click", ".atk_action_link", function (){
	$(".atk_action_link").html("...");
	var land_id = $(this).attr("i");
	var land_atk_id = $(this).attr("to_i");
	var units = $("#input_select_unit_number").val();
	showAtkAction(land_id, land_atk_id, units);
});

// Functions
function showLandInfo(land_id){CallAjaxMethodModal("landinfo", {"land_id":land_id}, {'title': "", 'title_with_land_name' : true}, land_id);}
function showBuyBegin(land_id){CallAjaxMethodModal("buybegin", {"land_id":land_id}, {'title': " Acheter", 'title_with_land_name' : true}, land_id);}
function showBuyAction(){CallAjaxMethodModal("moveaction", {"land_id":land_id, 'land_id_to':land_id_to, 'units':units}, {'title': " Déplacement en cours...", 'title_with_land_name' : true}, land_id);}
function showBuildBegin(land_id){CallAjaxMethodModal("moveaction", {"land_id":land_id, 'land_id_to':land_id_to, 'units':units}, {'title': " Déplacement en cours...", 'title_with_land_name' : true}, land_id);}
function showBuildAction(){CallAjaxMethodModal("moveaction", {"land_id":land_id, 'land_id_to':land_id_to, 'units':units}, {'title': " Déplacement en cours...", 'title_with_land_name' : true}, land_id);}
function showMoveBegin(land_id){CallAjaxMethodModal("moveaction", {"land_id":land_id, 'land_id_to':land_id_to, 'units':units}, {'title': " Déplacement en cours...", 'title_with_land_name' : true}, land_id);}
function showMoveAction(land_id, land_id_to, units){CallAjaxMethodModal("moveaction", {"land_id":land_id, 'land_id_to':land_id_to, 'units':units}, {'title': " Déplacement en cours...", 'title_with_land_name' : true}, land_id);}
function showAtkBegin(land_id){CallAjaxMethodModal("attackbegin", {"land_id":land_id}, {'title': " Attaquer", 'title_with_land_name' : true}, land_id);}
function showAtkAction(land_id, land_atk_id, units){CallAjaxMethodModal("attackaction", {"land_id":land_id, 'atk_id':land_atk_id, 'units':units}, {'title': " Attaque en cours...", 'title_with_land_name' : true}, land_id);}

//
$(function() {
    $.contextMenu({
        selector: '.land_content', 
        callback: function(key, options) {
            var m = "clicked: " + key;
            switch (key){
            	case "atk":
            		showAtkBegin();
            		break;
            	case "buy":
            		showBuyBegin();
            		break;
            	case "build":
            		showBuildBegin();
            		break;
            	case "move":
            		showMoveBegin();
            		break;
            	default:break;
            }
            window.console && console.log(m) || alert(m); 
        },
        items: {
            "atk": {name: "Atk", icon: "fa fa-truck"},
	        "sep1": "---------",
	        "buy": {name: "Buy", icon: "fa fa-truck"},
	        "sep2": "---------",
	        "build": {name: "Build", icon: "fa fa-truck"},
	        "sep3": "---------",
	        "move": {name: "Move", icon: "fa fa-truck"},
        }
    });
});

