// JavaScript Document
$(document).ready(function(e) {
	
    pageHeadBtn.onclickEvent($(".ph_btn"));
    /*$(".page_head").find(".ph_btn :eq(0)").parent().addClass("_btn");
	$(".page_head").find(".ph_btn :gt(0)").parent().addClass("ph_btn_hover");
	$(".page_head").find(".btn_text:eq(0)").addClass("_btn_text");*/
	
	
	$(".showUserInfo").click(function(event){
		pageUI.fadein("_showUserInfo","500","point");
		pageUI.stopBubble(event)
	})	
	$(document).click(function(){
		pageUI.fadeout("_showUserInfo","500")
	});	
	$("#switchdiv1").DivSwitch({id:"switchdiv1",btn:"switch_btn",btn_class0:"divBG1",btn_class1:"divBG2",detailed:"switch_",time:"500"});
		

});
