$('#scroll-msg').animate({ scrollTop: $('#scroll-msg').prop("scrollHeight")}, 800);

//Function used to call PHP Ajax function to update header info
function CallAjaxMethodHeader(action, args, div) {
	// URL
	var url = config["url"]["ajax"] + "/"+action+"&args="+ JSON.stringify(args);
    
	// Ajax call
	$.ajax({
        url: url,
        dataType : "html",  
        mimeType: "application/json",
        beforeSend:function(){
        	$(div).html(config["text"]["ajax"]);
        },
        success: function(data) {
        	$(div).html(data);
        },
        error: function(){    
        	alert("error : " + url);
        	$(div).html(data);
        }
    });
}

// Send
$(document).on("click", "#button_send_chat", function(){
	var msg = $("#chat_msg_content").val();
	$("#chat_msg_content").val($("#chat_msg_content").attr("placeholder"));
	CallAjaxMethodHeader("sendchat", {'message': msg}, "#ajax-send-chat-return");
});