// JavaScript Document
$(document).ready(function(e) {
	
   $("#switchdiv1").DivSwitch({id:"switchdiv1",btn:"switch_btn",btn_class0:"divBG1",btn_class1:"divBG2",detailed:"switch_",time:"500"}); 
      $("#switchdiv2").DivSwitch({id:"switchdiv2",btn:"switch_btn",btn_class0:"divBG1",btn_class1:"divBG2",detailed:"switch_",time:"500"}); 

});
(function($){
calenda={};
div_switch={};

pageUI={};
//↓↓↓↓↓↓↓↓↓↓↓↓↓-----日历------↓↓↓↓↓↓↓↓↓↓↓↓↓
	//链接后台获取事件点
	calenda.geteventpoint=function(){
		var date=$("#calenda1").find("option:selected").val();
		//年份date.substr(0,4)
		//月份date.substr(5,7)
		
		$.ajax({
			url : "./get_calendar.php",
			type : "post",		
			data: { 
				TYPE_ID:'1',
				YEAR:date.substr(0,4),
				MONTH:date.substr(5,7)
			},
			dataType : "json",
			success : success,
			error: function(data){
			}
	});	
	function success(data){

		$(data).each(function(index,el){
			calenda.addeventpoint(el)
			
		})
	}
	
	}
	calenda.geteventinfos=function(day){

		var date=$("#calenda1").find("option:selected").val();

//年份date.substr(0,4)
//月份date.substr(5,7)
//日 day
		//console.log(date.substr(0,4)+"-"+date.substr(5,7)+"-"+day)
		$.ajax({
			url : "./get_calendar.php",
			type : "post",		
			data: { 
				TYPE_ID:'2',
				YEAR:date.substr(0,4),
				MONTH:date.substr(5,7),
				DAY:day
			},
			dataType : "json",
			success : success,
			error: function(data){
				//console.log("error"+data)
			}
		});	
		function success(data){

			if(data.more=='1')
				calenda.have_more_info();
			$(data.CONTENT).each(function(index,el){
				calenda.addeventinfo(el,data.TITLE[index]);
			});
		
			
		}
	
	//console.log(date.substr(0,4)+"-"+date.substr(5,7)+"-"+day)
	}
	//显示更多按钮
	calenda.have_more_info=function(){
		$(".schedule").find(".schedule_info").find(".head").find(".more").css("display","block");
	}
	//显示更多按钮
	calenda.hide_more_info_btn=function(){
		$(".schedule").find(".schedule_info").find(".head").find(".more").css("display","none");
	}
	//添加一条日程详细记录
	calenda.addeventinfo=function(text,title){
		
		$(".schedule_info").find("ul").append('<li title="'+title+'">'+text+'</li>');		
		
	}
	calenda.showinfo=function(el){
		//var date=$("#calenda1").find("option:selected").val();
		$(".schedule").find(".schedule_info").click(function(){pageUI.stopBubble(event);})
		$(".schedule").find(".schedule_info").find(".title").text($("#calenda1").find("option:selected").text()+$(el).text()+"日—日程安排")
		$(".schedule").find(".schedule_info").stop(false,true);
		$(".schedule_info").find("ul").empty();
		$(".schedule").find(".schedule_info").animate({top:[-249,'easeOutBounce'],opacity:'1'},500);
		
		calenda.geteventinfos($(el).text());
	}
	
	
	calenda.hideinfo=function(){
		$(".schedule").find(".schedule_info").stop(false,true);
		calenda.hide_more_info_btn()
		$(".schedule").find(".schedule_info").animate({top:[11,'easeInCubic'],opacity:'0'},300);
	}
	
	calenda.addeventpoint=function(n){
		var el=$(".schedule").find("table").find("td:has(div):eq("+(n-1)+")")
		$(el).find("div").addClass("eventpoint");
		$(el).click(function(){	
			pageUI.stopBubble(event);		
			calenda.showinfo(this);	
					
		});
		
	}
	calenda.addNowDate=function(n){
		$(".schedule").find("table").find("td:has(div):eq("+(n-1)+")").addClass("calendatextbg");
	}
	calenda.change=function(){
		
		$(".schedule").find("table").stop(false,true);
		
		$(".schedule").find("table").animate({opacity:'0.2'},300,function(){
			
			$(".schedule").find("table").find("tr:gt(0)").remove();
			
			var date=$("#calenda1").find("option:selected").val();
			
			calenda.showcalenda(date.substr(0,4),date.substr(5,2));
			
			$(".schedule").find("table").animate({opacity:'1'},300);
			
			calenda.geteventpoint();
		
		});
		
	}
	
	
	calenda.showcalenda=function(year,month){
		
		$(".schedule").find("table").append(calenda.getcalendahtml(year,month));

		if(year==calenda.getNowDate().Y&&month==calenda.getNowDate().M)
		
			calenda.addNowDate(calenda.getNowDate().D);
						//calenda.addeventpoint(12)
		$(".schedule").find("table").animate({opacity:'1'},300);
		
	}
	
	//获取option
	calenda.getoption=function(){
		var y=calenda.getNowDate().Y;
		var m=calenda.getNowDate().M;
		if (m < 6)
		{
			y--;
		}
		m=m-5;
		for( var i=0; i<11;i++)
		{
			if(m==1)
				y++;
			m_=m
			if(m_<=0)
				m_=12+m_;
			_m=m_;
			if(_m<10)
				_m="0"+_m;
			var selected=""
			if(y==calenda.getNowDate().Y&&m==calenda.getNowDate().M)
			selected=" selected";
			var html='<option  value="'+y+'/'+_m+'"'+selected+'>'+y+'年'+m_+'月</option>';
			$("#calenda1").append(html);
			m++;
			if(m>12	)
			{
				m=1;
			}
		}
		
	}
	
	calenda.getcalendahtml=function(year,month){
		
		var days=calenda.DaysOfMonth(year,month);
		
		var _month=month-1
		
		if(month==1)
			_month=12
			
		var _days=calenda.DaysOfMonth(year,_month);
		
		var before=calenda.FirstDayOfMonth_Week(year,month);
		
		var html='<tr height="30">';
		
		var gray='';
		
		if(before>0)
		{
			//console.log(_days-before+1)
			for(var j=(_days-before+1); j<=_days;j++)
			{
				
				html+='<td class="gray">'+j+'</td>';
				
			}
			for(var k=1; k<=days; k++)
			{
				
				if((k+before)%7==1||(k+before)%7==0)
					gray=' class="gray1"';
				else
					gray='';
					
				html+='<td'+gray+'><div>'+k+'</div></td>';
				
				if((k+before)%7==0)
				
					html+='</tr><tr height="30">'
				
			}
			
			var have=(html.split('</td>')).length-1;
			
			for(var l=1;l<=(42-have);l++)
			{	
				html+='<td class="gray">'+l+'</td>';
				
				if((l+have)%7==0&&(l+have)!=42)
				
					html+='</tr><tr height="30">'				
				
			}
			
		}	
		if(before==0)
		{
			
			for(var m=(_days-6); m<=_days;m++)
			{
				//console.log(m)
				html+='<td class="gray">'+m+'</td>';
				
			}	
			html+="</tr><tr>";
			
			for(var k=1; k<=days; k++)
			{
				
				if((k+before)%7==1||(k+before)%7==0)
					gray=' class="gray1"';
				else
					gray='';
					
				html+='<td'+gray+'><div>'+k+'</div></td>';
				
				if(k%7==0)
				
					html+='</tr><tr height="30">'
				
			}	
			
			var have=(html.split('</td>')).length-1;
			
			for(var l=1;l<=(42-have);l++)
			{	
				html+='<td class="gray">'+l+'</td>'
				if((l+have)%7==0&&(l+have)!=42)
					html+='</tr><tr height="30">'				
				
			}							
		}	
		//console.log(html)
		return html;
		
	}
	calenda.FirstDayOfMonth_Week=function(year,month)
	
	{

		var days=calenda.totalDays(year,month);
		
		var tmp=days%7;
			
		return tmp;

	}
	calenda.totalDays=function(year,month)
	{

		var days=calenda.Days_FirstDayOfYear(year);

		for(var i=1;i<month;i++)
		
		{
		
			  days+=calenda.DaysOfMonth(year,i);
		
		}
		
		return days;

	}
	calenda.Days_FirstDayOfYear=function(year)
	{
	
		var days=365*year;

		for(var i=1;i<year;i++)
				
		{
		
			  days+=calenda.isLeapYear(i);
		
		}

		return days;

	}	
	calenda.DaysOfMonth=function(year,month)
	{

		var arr=[31,28,31,30,31,30,31,31,30,31,30,31];
		
		if(year!=2&&calenda.isLeapYear(year)==0)	
			 
			return arr[month-1];
	
		else 
		
			return arr[month-1]+1;

	}
	calenda.isLeapYear=function(year) 
	{

		return ((year%4==0 && year%100!=0) ||year%400==0)?1:0;
		
	}	
	calenda.getNowDate =function()
	{
	
		var now=new Date();
	
		var year=now.getFullYear();
		
		var month=now.getMonth()+1;
		
		var day=now.getDate();
		
		var week=now.getDay()
		
		var ArrayOfWeek=["日","一","二","三","四","五","六",];
		
		var hours=now.getHours();
		
		var minutes=now.getMinutes();
		
		var second=now.getSeconds();
		
		var StringTime=now.toLocaleString();
		
		return{
				
			Y:year,
			
			M:month,
			
			D:day,
			
			W:ArrayOfWeek[week],
			
			indexOfWeek:week,
			
			H:hours,
			
			m:minutes,
			
			s:second,
			
			stringTime:StringTime
			
		}
		
	}		
//↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑--------日历---------↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

//↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓--------DIV切换---------↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓			
	$.fn.DivSwitch=function(obj){
		
		var id=obj.id;
		
		$("#"+id).css({"overflow":"hidden","z-index":"3"});
		
		var w=$("#"+id).css("width");
		//console.log(w)
		$("#"+id).find("."+obj.btn+":eq(0)").addClass(obj.btn_class1);
		
		$("#"+id).find("."+obj.btn+":gt(0)").addClass(obj.btn_class1);
		
		$("#"+id).find("."+obj.btn+":eq(0)").addClass(obj.btn_class0);
		
		$("#"+id).find("."+obj.detailed+":gt(0)").css({"left":w,"opacity":"0"});
		
		div_switch.hoverfunction(obj);
		
	}
	div_switch.hoverfunction=function(obj){
		
		$("#"+obj.id).find("."+obj.btn).mouseover(function(){
			
			$("#"+obj.id).find("."+obj.detailed).stop(false,true);
			
			$(this).siblings().removeClass(obj.btn_class0);
			
			$(this).addClass(obj.btn_class0);
			
			$("#"+obj.id).find("."+obj.detailed+":eq("+$(this).index()+")").css("z-index","3");
			
			$("#"+obj.id).find("."+obj.detailed+":eq("+$(this).index()+")").animate({left:"0",opacity:"1"},Number(obj.time),function(){
				$("#"+obj.id).find("."+obj.detailed+":eq("+$(this).index()+")").css("z-index","2");
				
				$("#"+obj.id).find("."+obj.detailed+":lt("+$(this).index()+")").css({"left":$("#"+obj.id).css("width"),"z-index":"1","opacity":"0"});
				
				$("#"+obj.id).find("."+obj.detailed+":gt("+$(this).index()+")").css({"left":$("#"+obj.id).css("width"),"z-index":"1","opacity":"0"});
				
			});
		})
	}	
	
	pageUI.stopBubble=function(e){  
		//console.log(e)
        if (e && e.stopPropagation)  
		
            e.stopPropagation();
			  
        else 
		
            window.event.cancelBubble=true;
			
    }
//↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑--------DIV切换---------↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑	
})(jQuery)