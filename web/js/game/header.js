// New turn
$(document).on("click", "#end_of_turn_link", function(){
    $("#end_of_turn_link").html("<font color=white> " + config["text"]["turn_finished"] + " !</font>");
    $("#end_of_turn_link").attr("origin", "");
    CallAjaxMethodModal("newturn", new Array(), null);
});

// Last buy
$(document).on("click", "#current_gold_link", function(){
	CallAjaxMethodHeader("lastgold", new Array(), {'id': "#current_gold_content"});
});