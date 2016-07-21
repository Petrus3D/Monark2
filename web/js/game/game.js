$("document").on("pjax:timeout", function(event) {
  // Prevent default timeout redirection behavior
  event.preventDefault()
});

//Call Pjax
$("document").ready(function(){
	// No connection lost
	HideLostConnection();
    
    setInterval(function(){
        if($("#map_content").length > 0 && !$("modal").is(':visible')){
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