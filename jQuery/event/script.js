$(function(){
	$("p").hover(function(){
		alert("Hello");
	},
	function(){
		alert("Bye");
	});
	$("input").focus(function(){
		$(this).css("background","#ccc");
	});
	$("h3").on({
		mouseenter: function(){
			$(this).css("background","red");
		},
		mouseleave: function(){
			$(this).css("background","green");
		},
		click: function(){
			$(this).css("background","yellow");
		}
	});
	
	$("#hide").on("click",function(){
		$("div").hide('slow');
	});
	$("#show").on("click",function(){
		$("div").show('slow');
	});
	$("#toggle").on("click",function(){
		$("#one").toggle(2000);
	});
});