// function used to show Modals
function ShowModalLoading(args){ShowModal();UpdateModalTitle(args);$("#modal-view").find("#modal-view-Content").html(config["text"]["modal_loading_content"]);}
function UpdateModalTitle(args){if(args['title_with_land_name']){args['title'] = args['land_name'] + " : " + args['title'];}$(".modal-header-title").html("<center><h4>"+args['title']+"</h4></center>");}
function UpdateModalContent(args){actionObjectFade($("#modal-view").find("#modal-view-Content"), "html", args['content']);}
function UpdateModalError(){UpdateModalContent({'content': config["text"]["modal_error_content"]});}
function ShowModal(){actionObjectFade($("#modal-view"), "modal", "show", 100);}
function HideModal(){actionObjectFade($("#modal-view"), "modal", "hide", 100);}
function ModalInfo(){$("#modal-view").addClass("modal modal-info");}
function ModalError(){$("#modal-view").addClass("modal modal-danger");}
