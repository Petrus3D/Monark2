// function used to show header 
function ShowDropdownLoading(args){$(args['id']).find(".dropdown-menu").find(".menu").html(config["text"]["dropdown_loading_content"]);}
function UpdateDropdownContent(args){actionObjectFade($(args['id']).find(".dropdown-menu").find(".menu"), "html", args['content']);}
function UpdateDropdownError(args){UpdateDropdownContent({'id': args['id'],'content': config["text"]["dropdown_error_content"]});}