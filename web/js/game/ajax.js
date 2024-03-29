// $(".modal-dialog ").css({"top" : "75px"});

// Land
function getLandData(land){
	var land_name 		= $("img[i="+land+"]").attr("alt");
	var land_position 	= $("img[i="+land+"]").position();
	
	return {"land_id":land, "land_name":land_name, "land_position":land_position};
}

// Function used to call PHP Ajax function to show Modal 
function CallAjaxMethodModal(action, args, modal=null, land=null) {
	// URL
	var url = config["url"]["ajax"] + "/"+action+"&args="+ JSON.stringify(args);
	
	// Land
	if(land != null){
		var land = getLandData(land);
		modal["land_name"] = land["land_name"];
	}
    
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
            	          
            	reloadPjax();
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

//Function used to call PHP Ajax function to update header info
function CallAjaxMethodHeader(action, args, focus=null) {
	// URL
	var url = config["url"]["ajax"] + "/"+action+"&args="+ JSON.stringify(args);
    
	// Ajax call
	$.ajax({
        url: url,
        dataType : "html",  
        mimeType: "application/json",
        beforeSend:function(){
        	if(focus != null){ShowDropdownLoading(focus);}
        },
        success: function(data) {
        	// If no error
        	if(data != config["ajax"]["error"]){
            	if(focus != null){focus['content'] = data;UpdateDropdownContent(focus);}
        	}else{
        		if(focus != null){UpdateDropdownError(focus);}
        	}
        },
        error: function(){    
        	alert("error : " + url);
        	if(focus != null){UpdateDropdownError(focus);}
        }
    });
}
