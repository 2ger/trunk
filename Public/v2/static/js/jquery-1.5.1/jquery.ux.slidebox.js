(function($) {
		$.fn.slideBox = function(opts) {
			
			$.fn.slideBox.defaults = {
				fullScreen: true,
				count: 4,
				pageUpBtn: null,
				pageDownBtn: null,
				active: 0,
				width: 800,
				height: 600,
				cancel: "",
				speed: "normal",
				obstacle: 100,
				control: null,
				listeners: {
					afterScroll: $.noop,
					beforeScroll: $.noop
			    }
			};
			var c = $.extend(true, $.fn.slideBox.defaults, opts);
			var self = this;
			
			var cursor = 0;
			
			for (var i = 0; i < c.count; i ++) {
				addScreenDom(i);
			}
			
			if (c.fullScreen) {
				c.width = $(window).width();
				c.height = $(window).height();
				$(window).resize(function() {
					c.width = $(window).width();
					c.height = $(window).height();
					sizePanel();
				});
			}
		
			
			function sizePanel() {
				$(self).css({
					height: c.height,
					width: c.width,
					position: "relative"
				});
				
				$(self).children(".screen").each(function(i, e) {
					$(e).css({
						left: c.width * i,
						top: 0,
						position: "absolute",
						width: '100%',
						height: '100%'
					});
				});
				$(self).css({
					left: -cursor * c.width
				});
			}
			sizePanel();
			
			function scroll (index, callback) {
				if (index > c.count - 1 || index < 0) {
					$(self).animate({
						marginLeft: 0
					}, c.speed, function() {
						callback && callback();
				    });
					return;
				}
				cursor = index;
				c.listeners.beforeScroll(cursor);
				var left = - index * c.width;
				c.control && $(c.control).find(".active").removeClass("active");
				c.control && $(c.control).find(".btn").eq(cursor).addClass("active");
				$(self).stop().animate({
					left: left,
					marginLeft: 0
				}, c.speed, function() {
					callback && callback();
					c.listeners.afterScroll(cursor);
			    });
			
			}

			$(this).bind("mousedown", function(e) {
				//不响应事件
				if (typeof c.cancel == "string" ? $(e.target).parents().add(e.target).filter(c.cancel).length : false) {
					return;
				}
				var s = e.clientX;

				$(this).bind("mousemove", function(evt) {
					var clientX = evt.clientX;

					if (clientX % 5) {
						return;
					}
					var left = clientX - s;

					$(this).css({
						'margin-left': left
					});
					return false;
				});
				return false;
			});
			$(document).bind("mouseup", slide);
			
			function slide() {
				var left = parseInt($(self).css("margin-left"));
				var obstacle;
				if (typeof c.obstacle === "string" && /^[0-9]{1,2}%$/.test(c.obstacle)) {
					obstacle = parseInt(c.obstacle) * c.width / 100;
				}
				else {
					obstacle = 	c.obstacle;
				}
				
				if (left < -obstacle) {
					scroll(cursor + 1);
				}
				else if (left > obstacle) {
					scroll(cursor - 1);
				}
				else {
					$(self).animate({
						"margin-left": "0"
					}, "fast");
				}
				$(self).unbind("mousemove");
				$(self).unbind("mouseup");
				return false;
			}
			
			function addScreenDom(index, id) {
				var a = $("<a class=\"btn\" hidefocus=\"hidefocus\" href=\"javascript:void(0)\"></a>");
				if (index == c.active) {
					a.addClass("active");	
				}
				
				c.control && $(c.control).append(a);
				
				a.click(function() {
					//动态获取index,处理删除屏幕时的情况
					scroll(a.prevAll(".btn").length);
				});
				
				var div = $("<div class=\"screen\"></div>");
				div.attr("id", id);
				$(self).append(div);
			}
			
			function addScreen(index, id) {
				index = index || c.count;
				addScreenDom(index, id)
				c.count += 1;
				sizePanel();
			}
			
			function getScreen(index) {
				return $(self).find(".screen").eq(index);
			}
			
			function removeScreen(index) {
				if (typeof index === "undefined") {
					index = c.count - 1;
				}
				if (index < c.count && index >= 0) {
					getScreen(index).remove();
					if (c.control) {
						var btn = $(c.control).find("a.btn").eq(index);
						var activeFlag = btn.hasClass("active");
						btn.remove();
						if (activeFlag) {
							$(c.control).find("a.btn").eq(0).addClass("active");
							scroll(0);
						}
					}
					c.count -= 1;
					sizePanel();
				}
			}
			
			function pageDown(callback) {
				scroll(cursor + 1, callback);
			}
			
			function pageUp(callback) {
				scroll(cursor - 1, callback);
			}
			
			function sortScreen(sort) {
				var els = []
				$.each(sort, function(i, e) {
					var el = getScreen(e);
					els.push(el);
				});
				$.each(els, function(i, e) {
					e.appendTo(self);
				});
				sizePanel();
			}
			
			 document.body.onselectstart= function() {
			 	return false;
			}
			
			function keyDown(e){
				var up = 37;
				var down = 39;
				var currKey = 0;
				var e = e || event;
				currKey = e.keyCode || e.which || e.charCode;
				
				if (currKey == up){
					document.onkeydown = null;
					pageUp(function() {
						document.onkeydown = keyDown;
					});
				}
				else if (currKey == down) {
					document.onkeydown = null;
					pageDown(function() {
						document.onkeydown = keyDown;
					});
				}
				return false;
			}
			
			document.onkeydown = keyDown;
			
			return {
				scroll: scroll,
				addScreen: addScreen,
				getCount: function () {
					return c.count;	
				},
				sortScreen: sortScreen,
				getScreen: getScreen,
				getCursor: function() {
					return cursor;
				},
				removeScreen: removeScreen,
				pageDown: pageDown,
				pageUp: pageUp
			};
		}
	}) (jQuery);