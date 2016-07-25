// Land interaction
$(document).on("click", ".land_content", function(){
    var land_id = $(this).attr("i");
    CallAjaxMethod("landinfo", {"land_id":land_id}, {'title': "", 'title_with_land_name' : true}, land_id);
});

//Buy
//begin
$(document).on("click", ".buy_link", function(){
	$(".buy_link").html("...");
	var land_id = $(this).attr("i");
	CallAjaxMethod("buybegin", {"land_id":land_id}, {'title': " Acheter", 'title_with_land_name' : true}, land_id);
});

