// JavaScript Document
/*
弹出窗口函数说明
	例：pageUI.PopupWindow(arg)
		arg参数说明：
		{width:'200',height:'300',title:'写文章',src:'1.html',id:'new_popup1'}}
		width窗口宽度   height窗口高度  title窗口标题 src框架路径 id弹出层id




*/
$(document).ready(function(e) {
    $(".se_main_page").find(".left_menu").find("div").click(function() {
        $(this).parent().find("div").removeClass("divBG");
        $(this).addClass("divBG");
    });
});

function SetContent_frameH(h) {
    document.getElementById("content_frame").style.height = h + "px";
    $(".se_main_page_divs").css("height", h + 170);
};
(function(window, $, undefined) {
    div_switch = {};
    pageHeadBtn = {};
    pageUI = {}
    $.fn.DivSwitch = function(obj) {

            var id = obj.id;

            $("#" + id).css({
                "overflow": "hidden",
                "z-index": "3"
            });

            var w = $("#" + id).css("width");

            $("#" + id).find("." + obj.btn + ":eq(0)").addClass(obj.btn_class1);

            $("#" + id).find("." + obj.btn + ":gt(0)").addClass(obj.btn_class1);

            $("#" + id).find("." + obj.btn + ":eq(0)").addClass(obj.btn_class0);

            $("#" + id).find("." + obj.detailed + ":gt(0)").css({
                "left": w
            });

            div_switch.hoverfunction(obj);

        }
        //选择顶部按钮
        /*	pageHeadBtn.choicebutton=function(n){
        		$(".page_head").find(".ph_btn_hover").removeClass("ph_btn_hover");
        		$(".page_head").find("._btn").removeClass("_btn");
        		$(".page_head").find("._btn_text").removeClass("_btn_text");
        		$(".page_head").find(".ph_btn :eq("+n+")").parent().addClass("_btn");
        		$(".page_head").find(".ph_btn :gt("+n+")").parent().addClass("ph_btn_hover");
        		$(".page_head").find(".ph_btn :lt("+n+")").parent().addClass("ph_btn_hover");
        		$(".page_head").find(".btn_text:eq("+n+")").addClass("_btn_text");
        	}	*/
        //元素逐渐渐显
    pageUI.fadein = function(id, time, div) {

            $("#" + id).stop(false, true);

            $("#" + id).find("." + div).click(function(event) {
                pageUI.stopBubble(event);
            });

            $("#" + id).css({
                "display": "block"
            });

            $("#" + id).animate({
                opacity: '1'
            }, time);

        }
        //元素逐渐消失
    pageUI.fadeout = function(id, time) {

            $("#" + id).stop(false, true);

            $("#" + id).animate({
                opacity: '0'
            }, time, function() {
                $("#" + id).css({
                    "display": "none"
                });
            });
        }
        //弹出窗口
    pageUI.PopupWindow = function(arg) {

            $("#" + arg.id).stop(false, true);

            var left = pageUI.getPageAttribute().w * 0.5 - arg.width * 0.5;

            var top = pageUI.getPageAttribute().h * 0.5 - arg.height * 0.5;
            $("#" + arg.id).find(".title").text(arg.title);

            $("#" + arg.id).find("iframe").attr({
                "src": arg.src,
                "height": arg.height - 30
            });


            $("#" + arg.id).css({
                "width": arg.width,
                "height": arg.height,
                "left": left,
                "top": top,
                "display": "block"
            });

            $("#" + arg.id).animate({
                opacity: 1
            }, 300);

        }
        //关闭弹窗
    pageUI.close_PopupWindow = function(id) {


            $("#" + id).animate({
                opacity: 0
            }, 300, function() {
                $("#" + id).css({
                    "display": "none"
                });
                $("#" + arg.id).find("iframe").attr({
                    "src": arg.src
                });
                $("#" + id).find(".title").text("");
            });
        }
        //获取页面属性
    pageUI.getPageAttribute = function() {
            return {
                w: $(window).width(),
                h: $(window).height()
            }
        }
        //阻止事件冒泡
    pageUI.stopBubble = function(e) {

        if (e && e.stopPropagation)

            e.stopPropagation();

        else

            window.event.cancelBubble = true;

    }

    div_switch.hoverfunction = function(obj) {
        $("#" + obj.id).find("." + obj.btn).mouseover(function() {
            $(this).siblings().removeClass(obj.btn_class0)
            $(this).addClass(obj.btn_class0);
            var divs = $("#" + obj.id);
            var w = $("#" + obj.id)[0].offsetWidth;
            var lt = $(divs).find("." + obj.detailed + ":lt(" + $(this).index() + ")");
            var gt = $(divs).find("." + obj.detailed + ":gt(" + $(this).index() + ")")
            var now = $(divs).find("." + obj.detailed + ":eq(" + $(this).index() + ")");
            $(now).stop(true, false);
            $(lt).stop(true, false);
            $(gt).stop(true, false);
            $(now).animate({
                left: 0
            }, Number(obj.time));
            $(lt).animate({
                left: -w
            });
            $(gt).animate({
                left: w
            })
        })
    }

    pageHeadBtn.onclickEvent = function(el) {
        $(el).click(function() {
            $(el).removeClass("_btn")
            $(el).removeClass("ph_btn_hover")
            $(el).find(".btn_text").removeClass("_btn_text");
            $(this).addClass("_btn");
            $(this).prevAll().addClass("ph_btn_hover");
            $(this).nextAll().addClass("ph_btn_hover");
            $(this).find(".btn_text").addClass("_btn_text");
        });
    }
    pageUI.reloadIframe = function() {

        window.parent.list.location.reload()

    }
    window.onload = function() {

        var iframe = document.getElementById("content_frame");
        if (iframe != null && iframe != undefined) {
            if (iframe.attachEvent) {
                iframe.attachEvent("onload", function() {
                    var h = iframe.contentWindow.document.body.offsetHeight;
                    iframe.style.height = h + "px";
                    $(".se_main_page_divs").css("height", h + 170);
                })
            } else {
                iframe.onload = function() {

                    var h = iframe.contentWindow.document.body.offsetHeight;
                    iframe.style.height = h + "px";
                    $(".se_main_page_divs").css("height", h + 170);
                }
            }
        }
    };
    $(document).ready(function() {
        var fastoperate = $(".fastoperate")[0];
        if (fastoperate != null) {
            var f = new FastOperate(fastoperate);
            f.init();
        };
    });

    function FastOperate(element) {
        this.el = element;
        this.right = 20;
        this.top = null;
        this.w=null;
        this.init = function() {
            var w = document.body.offsetWidth;
            this.w=w;               
            var el = this.el;
            var t = getElTop(el);         
            el.style.top = t + "px";
            this.top = t;
            var swDivs=$(el).find('.switch');
            var l=swDivs.length;
            var hei=[];
            for (var i = 0; i <l; i++) {
                hei.push($(swDivs[i]).height())
            };
            hei.sort();
            hei=hei[hei.length-1]+30+"px";
            el.style.height=hei;
            el.onclick=function(e){
                var thisel=e.target
                var tag=thisel.tagName.toLocaleLowerCase()
                if(tag=="li")
                    fn.openModeWin(thisel.delTextNode().childNodes[0])
                else if(tag=="span")
                    fn.openModeWin(thisel)
            }
            fn.move_init(this);
        };
        var fn = {
            beg: null,
            openModeWin:function(el){
                if(el.getAttribute("data-ModeWin")!=null)
                {
                    var t=el.getAttribute("data-tit");
                    var u=el.getAttribute("data-url");
                    var w=el.getAttribute("data-w");
                    w?w:w=650
                    fastoperateOpen(t,u,w);
                }

            },
            move_init: function(obj) {
                var el = obj.el;
                var holdPoint = $(el).find('.headtitle')[0];
                holdPoint.onmousedown = function(e) {
                    var h=document.documentElement.clientHeight -$(el).height()-3;
                    var w=document.body.offsetWidth-133
                    fn.beg=getMousePos(e);
                    $("body").addClass('no_select');
                    document.onmouseup = function(e) {
                        var last = getMousePos(e);
                        obj.top=getElTop(holdPoint);
                        obj.right=obj.el.style.right.pxtonum();
                        $("body").removeClass('no_select');
                        $(document).unbind('mousemove');
                    }
                    $(document).mousemove(function(e) {
                        var last =getMousePos(e);
                        var r =obj.right+fn.beg.x- last.x;
                        var t =obj.top+ last.y - fn.beg.y;
                        if(t>3&&t<h)
                            el.style.top = t + "px";
                        if(r>0&&r<w)
                            el.style.right = r+ "px";
                    });
                }               
            }
        }
    }

    function getElTop(e) {
        var t = e.offsetTop;
        if (e.offsetParent != null) t += getElTop(e.offsetParent);
        return t;
    }

    function getElLeft(e) {
        var l = e.offsetLeft;
        if (e.offsetParent != null) l += getElLeft(e.offsetParent);
        return l;
    }

    function getMousePos(event) {
        var e = event || window.event;
        var scrollX = document.documentElement.scrollLeft || document.body.scrollLeft;
        var scrollY = document.documentElement.scrollTop || document.body.scrollTop;
        var x = e.pageX || e.clientX + scrollX;
        var y = e.pageY || e.clientY + scrollY;
        return {
            'x': x,
            'y': y
        };
    }
    String.prototype.pxtonum=function(){
        /*
        * 像素转数字 ***px 转为***
        */
        return Number(this.substr(0,this.length-2))
    }    
})(window, jQuery)
//显示模块详细信息；module_name为模块名称,module_value为字段字符串,用逗号分隔开;module_ch_name为模块中文名
function showDetails(module_name, module_field, module_ch_name, id, title, create_user, date) {
        if (title == undefined || title == "") {
            title = "";
        }

        if (create_user == undefined || create_user == "") {
            create_user = "";
        }

        if (date == undefined || date == "") {
            date = "";
        }
        var url = '/edu_inc/details.php?module_name=' + module_name + '&module_field=' + module_field + "&module_ch_name=" + module_ch_name + "&id=" + id + "&title=" + title + "&create_user=" + create_user + "&date=" + date;
        window.open(url, module_ch_name, 'menubar=0,toolbar=0,status=1,left=200,top=30,scrollbars=1,resizable=1,width=900,height=600');
    }
    (function(window, o, undefined) {

        window.open = function(url, name, features, repl) {

            var w = features.match(/width=([0-9]{1,})/);

            if (w != undefined)

                w = w[1];

            var h = features.match(/height=([0-9]{1,})/);

            if (h != undefined)

                h = h[1];

            var iTop = (window.screen.availHeight - 30 - h) / 2;

            var iLeft = (window.screen.availWidth - 10 - w) / 2;

            if (features.match(/left/) == null) {

                features += ",left=0";

            }

            if (features.match(/top/) == null) {

                features += ",top=0";

            }

            features = features.replace(/left=[0-9]{1,}/g, 'left=' + iLeft);

            features = features.replace(/top=[0-9]{1,}/g, 'top=' + iTop);

            o(url, name, features, repl);

        };

    })(window, window.open);

(function(window, $, undefined) {

    $(document).ready(function(e) {
        var navs = $(".my_nav"),
            l = navs.length;
        for (var i = 0; i < l; i++) {
            var o = new nav(navs[i]);
            o.init();
        }
    });

    function nav(el) {
        this.el = el;
        this.sel = null;
        this.init = function() {

            this.sel = $(this.el).next()[0].delTextNode().childNodes;

            fn.init(this);

        };

        var fn = {
            btn: null,
            act: null,
            sel: null,
            init: function(obj) {

                this.sel = obj.sel;

                this.btn = obj.el.delTextNode().childNodes;

                this.addEvent();

            },
            addEvent: function() {

                var b = this.btn,
                    l = b.length;

                for (var i = 0; i < l; i++) {

                    var itm = b[i];

                    if ($(itm).hasClass("active"))

                        this.act = i;

                    itm.onclick = (function(index) {

                        return function() {

                            if (fn.act != index);

                            fn.show(index);

                        };

                    })(i);

                }

            },
            show: function(index) {

                var sel = this.sel,
                    now = index,
                    old = this.act;

                $(this.btn[old]).removeClass("active");

                $(this.btn[now]).addClass("active");

                this.act = index;

                if (now > old) {

                    $(sel[old]).stop(true, false);

                    $(sel[now]).stop(true, false);

                    $(sel[old]).animate({
                        left: "-100%"
                    }, 400, function() {

                        $(this).removeClass("on")

                    });

                    sel[now].style.left = "100%";

                    $(sel[now]).addClass("on");

                    $(sel[now]).animate({
                        left: "0%"
                    }, 400);

                } else if (now < old) {

                    $(sel[old]).stop(true, false);

                    $(sel[now]).stop(true, false);

                    $(sel[old]).animate({
                        left: "100%"
                    }, 400, function() {

                        $(this).removeClass("on");

                    });

                    sel[now].style.left = "-100%";

                    $(sel[now]).addClass("on");

                    $(sel[now]).animate({
                        left: "0%"
                    }, 400);

                }

            }

        };

    };


    Element.prototype.delTextNode = function() {

        var elem_child = this.childNodes;

        for (var i = 0; i < elem_child.length; i++) {

            if (elem_child[i].nodeName == "#text" && !/\s/.test(elem_child.nodeValue)) {

                this.removeChild(this.childNodes[i])
            }

        }

        return this;

    };
})(window, jQuery);