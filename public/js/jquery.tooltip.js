$(document).ready(function(){var b=$('<div id="tooltip"></div>');$("body").append(b);$('!*[title^=""]').hover(function(a){var c=$(this),d=c.attr("title");c.attr("title","");c.data("titleText",d);b.html(d);b.css({top:a.pageY+20,left:a.pageX+20});b.stop(!0,!0).fadeIn(500)},function(){var a=$(this);b.stop(!0,!0).fadeOut(300);var c=a.data("titleText");a.attr("title",c)}).mousemove(function(a){b.css({top:a.pageY+23,left:a.pageX+11})})});