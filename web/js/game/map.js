// Land interaction
$(document).on("click", ".land_content", function(){
    var land_id = $(this).attr("i");
    CallAjaxMethod("landinfo", {"land_id":land_id}, {'title': "", 'title_with_land_name' : true}, land_id);
});

// Buy
// begin
$(document).on("click", ".buy_link", function(){
	$(".buy_link").html("...");
	var land_id = $(this).attr("i");
	CallAjaxMethod("buybegin", {"land_id":land_id}, {'title': " Acheter", 'title_with_land_name' : true}, land_id);
});
// action
$(document).on("click", ".buy_action_link", function(){
	$(".buy_action_link").html("...");
	var land_id = $(this).attr("i");
	var units = $("#input_select_unit_number").val();
	CallAjaxMethod("buyaction", {"land_id":land_id, 'units':units}, {'title': " Recrutement en cours...", 'title_with_land_name' : true}, land_id);
});

// Build
// begin
$(document).on("click", ".build_link", function(){
	$(".build_link").html("...");
	var land_id = $(this).attr("i");
	CallAjaxMethod("buildbegin", {"land_id":land_id}, {'title': " Construire", 'title_with_land_name' : true}, land_id);
});
// action
$(document).on("click", ".build_action_link", function(){
	$(".build_action_link").html("...");
	var land_id = $(this).attr("i");
	var building_id = $(this).attr("building_i");
	CallAjaxMethod("buildaction", {"land_id":land_id, 'building_id':building_id}, {'title': " Construction en cours...", 'title_with_land_name' : true}, land_id);
});

// Move
// begin
$(document).on("click", ".move_link", function(){
	$(".move_link").html("...");
	var land_id = $(this).attr("i");
	CallAjaxMethod("movebegin", {"land_id":land_id}, {'title': " Déplacer des troupes", 'title_with_land_name' : true}, land_id);
});
// action
$(document).on("click", ".move_action_link", function(){
	$(".build_action_link").html("...");
	var land_id = $(this).attr("i");
	var land_id_to = $(this).attr("to_i");
	var units = $("#input_select_unit_number").val();
	CallAjaxMethod("moveaction", {"land_id":land_id, 'land_id_to':land_id_to, 'units':units}, {'title': " Déplacement en cours...", 'title_with_land_name' : true}, land_id);
});

