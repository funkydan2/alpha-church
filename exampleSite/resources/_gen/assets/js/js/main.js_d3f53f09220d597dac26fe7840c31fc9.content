(function($){skel.breakpoints({wide:"(max-width: 1680px)",normal:"(max-width: 1280px)",narrow:"(max-width: 980px)",narrower:"(max-width: 840px)",mobile:"(max-width: 736px)",mobilep:"(max-width: 480px)"});$(function(){var $window=$(window),$body=$("body"),$header=$("#header"),$banner=$("#banner");$("form").placeholder();skel.on("+narrower -narrower",function(){$.prioritize(".important\\28 narrower\\29",skel.breakpoint("narrower").active);});$("#nav > ul").dropotron({alignment:"right"});$('<div id="navButton">'+
'<a href="#navPanel" class="toggle"></a>'+
"</div>").appendTo($body);$('<div id="navPanel">'+
"<nav>"+
$("#nav").navList()+
"</nav>"+
"</div>").appendTo($body).panel({delay:500,hideOnClick:true,hideOnSwipe:true,resetScroll:true,resetForms:true,side:"left",target:$body,visibleClass:"navPanel-visible"});if(skel.vars.os=="wp"&&skel.vars.osVersion<10)
$("#navButton, #navPanel, #page-wrapper").css("transition","none");if(!skel.vars.mobile&&$header.hasClass("alt")&&$banner.length>0){$(window).on("load",function(){$banner.scrollwatch({delay:0,range:0.5,anchor:"top",on:function(){$header.addClass("alt reveal");},off:function(){$header.removeClass("alt");}});});}});})(jQuery);