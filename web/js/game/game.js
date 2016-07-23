$("document").on("pjax:timeout", function(event) {
  // Prevent default timeout redirection behavior
  event.preventDefault()
});

//Call Pjax
$("document").ready(function(){
	// No connection lost
	HideLostConnection();
    setInterval(function(){      
        reloadMap();
		reloadHeader();
    }, config["refresh_time"]); //Reload map
});

// Call Pjax Functions
function reloadMap(){
	if($("#map_content").length > 0 && !$("modal").is(':visible')){
		$.pjax.reload({container:"#map_content", async:true});
	}
}
function reloadHeader(){
	// URL
	var url = config["url"]["ajax"] + "/" + "header";
	
	if($("#navbar-menu-game:hover").length == 0){
		// Ajax call
		$.ajax({
	        url: url,
	        dataType : "html",  
	        success: function(data) {
	        	$.pjax.reload({container:"#navbar-menu-game-data", async:true});
	        },
	        error: function(){    
	        	ShowLostConnection();
	        }
	    });
	}
}

// Pjax success
$(document).on('pjax:success', function() {
	HideLostConnection();
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