// Turn length
 $("document").ready(
	function(){
	  setInterval(
         function(){
		    var current_time_split = $("#turn_length").html().split(':');
		    if(current_time_split.length == 3){ var hour = current_time_split[0] + ":";var minute = current_time_split[1] + ":";var second = current_time_split[2];}
		    if(current_time_split.length == 2){ var minute = current_time_split[0] + ":";var second = current_time_split[1];}
		    if(current_time_split.length == 1){ var second = current_time_split[0];}
		    if(parseInt(second) < 10) second = "0"+second;
		    var new_time = hour+minute+(parseInt(second) + 1);
		    $("#turn_length").html(new_time);
         }
	 , 1000); 
});
 
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