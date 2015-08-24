/* Script for my chocolate bars
by Polar Design

Hash : RGV2ZWxvcGVkIGJ5IExhcnJ5IFN0YW5maWVsZCAtIGNvbnRhY3QgQCB2aW5jZS5vbWVnYUBnbWFpbC5jb20=
*/



$(document).ready(function(e){
	
	$("button, a, span, div, input, img").off("click");
	$('#content.design-bar button.save').off("click");
	$('#content.design-wrapper button.save-cart').off("click");
	$('#content.design-wrapper button.save-later').off("click");
	$('#navi-listen button.save-n-quit').off("click");
	$('#navi-listen button.quit').off("click");



	detect();
	fontSize();
	
	//recalculateAmounts();

	quantityPage();
	check_amount();
	hideErrorBlock();
	appendMyImage();
	moveMyImage();
	resizableImg();
	transformButton()
	// ajaxUpload();
	appendMyBackgroundImage();
	changeMyColor()
	dPicker();
	itemCounter();
	changeQual();
	changeFont();
	tabbing();
	storeColor();
	billingToShipping();
	editInfo();
	adjustSize();
	closeModal();
	moveMyText();
	removeText();
	loadInArt();
	// loadBarTypes();
	adjustWrapper();
	
	// setTimeout(replaceFBImage, 5000);

	$('#content.design-bar button.save').on("click", function(e){
			e.preventDefault();
			saveBar();
		
	
	});

	$('#content.design-wrapper button.save-cart').on("click", function(e){
		//alert(e.handled);

			saveWrapper();
		
			
	});

	$('#content.design-wrapper button.save-later').on("click", function(e){
			
	
			saveLater();
	
	});

	$('#navi-listen button.save-n-quit').on("click", function(e){
			
	
			savePopup();
		
	});

	$('#navi-listen button.quit').on("click", function(e){
			

			redirect();
		
	});

button2link();
switchColorController();

});

$(window).load(function(){
	//recalculateTotalCoinsAmount();
	
});

function timeReleased(){
	
}

setTimeout(timeReleased(), 1000);



function closeModal(){
	$("a img.modal-close").on("click", function(e){
		$("#navi-listen, #edit-details, #edit-password").fadeOut(500);
		e.preventDefault();
	});
}

function detect(){

				var css1 = "position: absolute; top: -30px; left: 20px;";
				var css2 = "position: absolute; top: 10px; left: 20px;";
				var css3 = "position: absolute; top: 40px; left: 20px;";
				var css4 = "position: absolute; top: 60px; left: 20px;";

				
				
				$("input[name='line_1'], input[name='line_2'], input[name='line_3'], input[name='line_4']").keypress(function(e){
					word = $(this).val();
					if(word.length > 15)   e.preventDefault();
				});
				
	
				$("input[name='line_1']").keyup(function(e){

					if(parseInt($("input[name='quan_1']").val()) > 26){
					width = "; width: 230px;";
				} else {
					width = "";
				}
					word = $(this).val();
					if(word.length > 15)   e.preventDefault();
					var font1 = $("input[name='hfont_1']").val();
					if(!font1) { font1 = $("select[name='font_1']").val(); $("input[name='hfont_1']").val(font1);}
					$(".overlay ul li.first-line").html($(this).val()).attr("style", "font-size:" + parseInt($("input[name='quan_1']").val()) + "px;" + "font-family:  " + "'" + font1 + "';" + "color: " + $("input[name='clur']").val() + width);
				});
				$("input[name='line_2']").keyup(function(e){
					
					if(parseInt($("input[name='quan_2']").val()) > 26){
					width = "; width: 230px;";
				} else {
					width = "";
				}

					word = $(this).val();
					if(word.length > 15)  e.preventDefault();
					var font2 = $("input[name='hfont_2']").val();
					if(!font2) { font2 = $("select[name='font_2']").val(); $("input[name='hfont_2']").val(font2);}

					$(".overlay ul li.second-line").html($(this).val()).attr("style", "font-size:" + parseInt($("input[name='quan_2']").val()) + "px;" + "font-family:  " + "'" + font2 + "'; " + "color: " + $("input[name='clur']").val() + width);
				});
				$("input[name='line_3']").keyup(function(e){
					
				if(parseInt($("input[name='quan_3']").val()) > 26){
					width = "; width: 230px;";
				} else {
					width = "";
				}
					word = $(this).val();
					if(word.length > 15)  e.preventDefault();
					var font3 = $("input[name='hfont_3']").val();
					if(!font3) { font3 = $("select[name='font_3']").val(); $("input[name='hfont_3']").val(font3);}

					$(".overlay ul li.third-line").html($(this).val()).attr("style", "font-size:" + parseInt($("input[name='quan_3']").val()) + "px;" + "font-family:  " + "'" + font3 + "'; " + "color: " + $("input[name='clur']").val() + width);
				});
				$("input[name='line_4']").keyup(function(e){
					
					if(parseInt($("input[name='quan_4']").val()) > 26){
					width = "; width: 230px;";
				} else {
					width = "";
				}

					word = $(this).val();
					if(word.length > 15)  e.preventDefault();
					var font4 = $("input[name='hfont_4']").val();
					if(!font4){ font4 = $("select[name='font_4']").val(); $("input[name='hfont_4']").val(font4);}

					$(".overlay ul li.fourth-line").html($(this).val()).attr("style", "font-size:" + parseInt($("input[name='quan_4']").val()) + "px;" + "font-family:  " + "'" + font4 + "'; " + "color: " + $("input[name='clur']").val() + width);
				});

}

function fontSize(){

				var css1 = "position: absolute; top: -30px; left: 20px;";
				var css2 = "position: absolute; top: 10px; left: 20px;";
				var css3 = "position: absolute; top: 40px; left: 20px;";
				var css4 = "position: absolute; top: 60px; left: 20px;";
				var style1 = $('.overlay ul li.first-line').attr("style");
				var style2 = $('.overlay ul li.second-line').attr("style");
				var style3 = $('.overlay ul li.third-line').attr("style");
				var style4 = $('.overlay ul li.fourth-line').attr("style");
				if(style1 === 'undefined' ){
						style1 = "";
				}
				if(style2 === 'undefined' ){
						style2 = "";
				}
				if(style3 === 'undefined' ){
						style3 = "";
				}
				if(style4 === 'undefined' ){
						style4 = "";
				}

				
				
				

				$("input[name='quan_1']").on("click", function(e, style1){
			
					if(parseInt($("input[name='quan_1']").val()) > 26){
					width = "; width: 230px;";
				} else {
					width = "";
				}
				



				if(e.handled !== true){
					var font1 = $("input[name='hfont_1']").val();
					$(".overlay ul li.first-line").attr("style", "font-size:" + $(this).val() + "px; " + "font-family:  " + "'" + font1 + "'; " + "color: " + $("input[name='clur']").val() + width);
					$("input[name='hquan_1']").val($(this).val());
					e.handled = true;
					}
				});
				$("input[name='quan_2']").on("click", function(e, style2){
				
			
					if(parseInt($("input[name='quan_2']").val()) > 26){
					width = "width: 230px;";
				} else {
					width = "";
				}
				
				var font2 = $("input[name='hfont_2']").val();
				if(e.handled !== true){
					$(".overlay ul li.second-line").attr("style", "font-size:" + $(this).val() + "px; " + "font-family:  " + "'" + font2 + "'; " + "color: " + $("input[name='clur']").val() + width);
					$("input[name='hquan_2']").val($(this).val());

					e.handled = true;
					}
				});
				$("input[name='quan_3']").on("click", function(e,style3){
			
			
					if(parseInt($("input[name='quan_3']").val()) > 26){
					width = "width: 230px;";
				} else {
					width = "";
				}
				

				if(e.handled !== true){
					var font3 = $("input[name='hfont_3']").val();
					$(".overlay ul li.third-line").attr("style", "font-size:" + $(this).val() + "px; " + "font-family:  " + "'" + font3 + "'; " + + "color: " + $("input[name='clur']").val() + width);
					$("input[name='hquan_3']").val($(this).val());

				e.handled = true;
					}
				});
				$("input[name='quan_4']").on("click", function(e, style4){
			
			
					if(parseInt($("input[name='quan_4']").val()) > 26){
					width = "width: 230px;";
				} else {
					width = "";
				}
				


			if(e.handled !== true){
					var font4 = $("input[name='hfont_4']").val();
					$(".overlay ul li.fourth-line").attr("style", "font-size:" + $(this).val() + "px; " + "font-family:  " + "'" + font4 + "'; " + + "color: " + $("input[name='clur']").val() + width);
					$("input[name='hquan_4']").val($(this).val());

				e.handled = true;
					}
				});

				$("a.minus_1").on("click", function(e, style1){
			
			
					if(parseInt($("input[name='quan_1']").val()) > 26){
					width = "width: 230px;";
				} else {
					width = "";
				}
				


			if(e.handled !== true){
					var font1 = $("input[name='hfont_1']").val();
					var quan = parseInt($("input[name='quan_1']").val());
					if(quan != 20) quan--; if(isNaN(quan)) quan = 20;
					$("input[name='quan_1']").val(quan);

					$(".overlay ul li.first-line").attr("style", "font-size:" + quan + "px; " + "font-family:  " + "'" + font1 + "'; " + + "color: " + $("input[name='clur']").val());
					$("input[name='hquan_1']").val(quan);

				e.handled = true;
					}
				});
				$("a.minus_2").on("click", function(e, style2){
			
							
					if(parseInt($("input[name='quan_2']").val()) > 26){
					width = "width: 230px;";
				} else {
					width = "";
				}
				

				if(e.handled !== true){
					var font2 = $("input[name='hfont_2']").val();
					var quan = parseInt($("input[name='quan_2']").val());
					if(quan != 20) quan--; if(isNaN(quan)) quan = 20;
					$("input[name='quan_2']").val(quan);

					$(".overlay ul li.second-line").attr("style", "font-size:" + quan + "px; " + "font-family:  " + "'" + font2 + "'; " + "color: " + $("input[name='clur']").val());
					$("input[name='hquan_2']").val(quan);

						e.handled = true;
					}
				});
				$("a.minus_3").on("click", function(e, style3){
			
			
					if(parseInt($("input[name='quan_3']").val()) > 26){
					width = "width: 230px;";
				} else {
					width = "";
				}
				

					if(e.handled !== true){
					var font3 = $("input[name='hfont_3']").val();
					var quan = parseInt($("input[name='quan_3']").val());
					if(quan != 20) quan--; if(isNaN(quan)) quan = 20;
					$("input[name='quan_3']").val(quan);

					$(".overlay ul li.third-line").attr("style", "font-size:" + quan + "px; " + "font-family:  " + "'" + font3 + "'; " + "color: " + $("input[name='clur']").val());
					$("input[name='hquan_3']").val(quan);

						e.handled = true;
					}
				});
				$("a.minus_4").on("click", function(e, style4){

			
					if(parseInt($("input[name='quan_4']").val()) > 26){
					width = "width: 230px;";
				} else {
					width = "";
				}
				

					if(e.handled !== true){
					var font4 = $("input[name='hfont_4']").val();
					var quan = parseInt($("input[name='quan_4']").val());
					if(quan != 20) quan--; if(isNaN(quan)) quan = 20;
					$("input[name='quan_4']").val(quan);

					$(".overlay ul li.fourth-line").attr("style", "font-size:" + quan + "px; " + "font-family:  " + "'" + font4 + "'; " + "color: " + $("input[name='clur']").val());
					$("input[name='hquan_4']").val(quan);

					e.handled = true;
					}
				});


				$("a.plus_1").on("click", function(e, style1){

					if(e.handled !== true){
					var font1 = $("input[name='hfont_1']").val();
					var quan = parseInt($("input[name='quan_1']").val());
					if(quan != 30) quan++; if(isNaN(quan)) quan = 20;
					 $("input[name='quan_1']").val(quan);

					$(".overlay ul li.first-line").attr("style", "font-size:" + quan + "px; " + "font-family:  " + "'" + font1 + "'; " + "color: " + $("input[name='clur']").val() + width);
					$("input[name='hquan_1']").val(quan);

						e.handled = true;
					}

				});
				$("a.plus_2").on("click", function(e, style2){

					if(e.handled !== true){
					var font2 = $("input[name='hfont_2']").val();
					var quan = parseInt($("input[name='quan_2']").val());
					 if(quan != 30) quan++; if(isNaN(quan)) quan = 20;
					 $("input[name='quan_2']").val(quan);

					$(".overlay ul li.second-line").attr("style", "font-size:" + quan + "px; " + "font-family:  " + "'" + font2 + "'; " + "color: " + $("input[name='clur']").val() + width);
					$("input[name='hquan_2']").val(quan);

					e.handled = true;
					}

				});
				$("a.plus_3").on("click", function(e, style3){

					if(e.handled !== true){
					var font3 = $("input[name='hfont_3']").val();
					var quan = parseInt($("input[name='quan_3']").val());
					 if(quan != 30) quan++; if(isNaN(quan)) quan = 20;
					 $("input[name='quan_3']").val(quan);


					$(".overlay ul li.third-line").attr("style", "font-size:" + quan + "px; " + "font-family:  " + "'" + font3 + "'; " + "color: " + $("input[name='clur']").val() + width);
					$("input[name='hquan_3']").val(quan);

					e.handled = true;
					}
				});
				$("a.plus_4").on("click", function(e, style4){

					if(e.handled !== true){
					var font4 = $("input[name='hfont_4']").val();
					var quan = parseInt($("input[name='quan_4']").val());
					if(quan != 30) quan++; if(isNaN(quan)) quan = 20;
					 $("input[name='quan_4']").val(quan);

					$(".overlay ul li.fourth-line").attr("style", "font-size:" + quan + "px; " + "font-family:  " + "'" + font4 + "'; " + "color: " + $("input[name='clur']").val() + width);
					$("input[name='hquan_4']").val(quan);

					e.handled = true;
					}
				});



}

function changeFont(){
		
				


				$("select[name='font_1']").change(function(e, style1){
			

			if(e.handled !== true){

				if(parseInt($("input[name='quan_1']").val()) > 26){
					width = "; width: 230px;";
				} else {
					width = "";
				}

				var size1 = parseInt($("input[name='hquan_1']").val());
					$(".overlay ul li.first-line").attr("style", "font-family:  " + "'" + $(this).val() + "'; " + "font-size: " + parseInt(size1) + "px; " + "color: " + $("input[name='clur']").val() + width );
					$("input[name='hfont_1']").val($(this).val());

					e.handled = true;
					}
				});
				$("select[name='font_2']").change(function(e, style2){
			if(e.handled !== true){

				if(parseInt($("input[name='quan_2']").val()) > 26){
					width = "; width: 230px;";
				} else {
					width = "";
				}

				var size2 = parseInt($("input[name='hquan_2']").val());

					$(".overlay ul li.second-line").attr("style", "font-family:  " + "'" + $(this).val()  + "'; " + "font-size: " + parseInt(size2) + "px; " + "color: " + $("input[name='clur']").val() + width);
					$("input[name='hfont_2']").val($(this).val());
					e.handled = true;
					}
				});
				$("select[name='font_3']").change(function(e, style3){
			if(e.handled !== true){

				if(parseInt($("input[name='quan_3']").val()) > 26){
					width = "; width: 230px;";
				} else {
					width = "";
				}

				var size3 = parseInt($("input[name='hquan_3']").val());

					$(".overlay ul li.third-line").attr("style", "font-family:  " + "'" + $(this).val() + "'; " + "font-size: " + parseInt(size3) + "px; " + "color: " + $("input[name='clur']").val() + width);
					$("input[name='hfont_3']").val($(this).val());
				e.handled = true;
					}
				});
				$("select[name='font_4']").change(function(e, style4){
			if(e.handled !== true){

				if(parseInt($("input[name='quan_4']").val()) > 26){
					width = "; width: 230px;";
				} else {
					width = "";
				}

				var size4 = parseInt($("input[name='hquan_4']").val() + width);

					$(".overlay ul li.fourth-line").attr("style", "font-family:  " + "'" + $(this).val() + "'; " + "font-size: " + parseInt(size4) + "px; " + "color: " + $("input[name='clur']").val() );
					$("input[name='hfont_4']").val($(this).val());
					e.handled = true;
					}
				});

}


function removeText(){
		$("a").click(function(e){

			var link_class = $(this).attr("class");
			var text = "";
			switch(link_class){

					case "remove_1":
						
						$(".overlay ul li.first-line").html("");
						
					break;

					case "remove_2":
						$(".overlay ul li.second-line").html("");
					break;

					case "remove_3":
						$(".overlay ul li.third-line").html("");
					break;

					case "remove_4":
						$(".overlay ul li.fourth-line").html("");
					break;
			}
		});
}

function button2link(){
		$("button, span").click(function(){
			// alert("trigged");
			if($(this).data('href')){
				window.location = $(this).data("href");
			}
		});
}

function redirect(){
	
				window.location =  $("#navi-listen button.quit").data("href");
		
}


function appendMyImage(){

	$("#content.design-bar .select-art-box.clipArt ul li a img").click(function(){
				//alert("clicked");
				var img = $(this).parent().data('clipart');
				localStorage["bar_clipart"] = img;
				$("div.overlay div.transparent-overlay").css("background-color", "rgba(126, 64, 17, 0.7)");
				$(".design-bar-custom img").attr("src", "/env/images/mcb/template-bar.png");
				$("div.overlay img").attr("style", "visibility: visible;");
				$("div.overlay img").attr("src", "/env/html5_configurator/hex-loader2.gif");
				$("#content.design-bar .ajax-upload input[name='layer_top']").val("env/configurator/files/clipArts/" + img);
				var server = $.ajax({
					url: "/env/html5_configurator/convert.php",
					type: "POST",
					data: {image:img}
				});
				server.done(function(data){
				$("div.overlay img").attr("src", data).css("opacity", ".4");
				$("div.overlay img").attr("data-upload", 0);

				//$("div.overlay img#overlay-image").replaceWith(data);
				$("div.overlay img#original-image").attr("src", "/env/configurator/files/clipArts/" + img).attr("style", "display: none;");
				$("div.overlay img#original-image").attr("data-clipart", img);
				});

				server.fail(function(jqXHR, textStatus){
				$("div.overlay img").attr("src", "/env/html5_configurator/iconmonstr-warning-icon-48.png");
				});

				delete this.img;
	});

	$("#content.design-wrapper .select-art-box.clipArt ul li a img").click(function(){
				//alert("clicked");
				var img = $(this).parent().data('clipart');
				//$("div.overlay div.transparent-overlay").css("background-color", "rgba(126, 64, 17, 0.7)");
				//$(".design-bar-custom img").attr("src", "/env/images/mcb/bar_no_design.png");
				$("div.overlay img").attr("style", "visibility: visible;");
				$("div.overlay img").attr("src", "/env/html5_configurator/hex-loader2.gif");
				$("#content.design-wrapper .ajax-upload input[name='layer_top']").val("env/configurator/files/clipArts/" + img);
					var x = $(".ajax-upload input[name='imgposx']").val();
					var y = $(".ajax-upload input[name='imgposy']").val();
					// alert(x); alert(y);
					
				

				var server = $.ajax({
					url: "/env/html5_configurator/convert.php",
					type: "POST",
					data: {image:img}
				});
				server.done(function(data){
			
				$("div.overlay img").attr("src", "/env/configurator/files/clipArts/" + img);
				
				});

				server.fail(function(jqXHR, textStatus){

				$("div.overlay img").attr("src", "/env/html5_configurator/iconmonstr-warning-icon-48.png");
			
				});
				
						$("div.overlay img").css("visibility", "visible");
						$("div.overlay img").css("left", x);
						$("div.overlay img").css("top", y);
		
				
				delete this.img;
			});


}

function appendMyBackgroundImage(){


	$("#content.design-wrapper .select-art-box.bg ul li a").click(function(){
				// alert("clicked");
				var img = $(this).data('clipart');
				//$("div.overlay div.transparent-overlay").css("background-color", "rgba(126, 64, 17, 0.7)");
				//$(".design-bar-custom img").attr("src", "/env/images/mcb/bar_no_design.png");
				//$("div.overlay img").attr("style", "visibility: visible;");
				$("div.wrapper-background").css("background-image", "url('/env/html5_configurator/" + img + "')");
				$("#content.design-wrapper .ajax-upload input[name='wrapper']").val("/env/html5_configurator/" + img);
				//$("div.wrapper-background").css("background-position-y", "-600px");
				localStorage["wrapper_wrap"] = "/env/html5_configurator/" + img;

				delete this.img;
	});


}



function changeMyColor(){

			$("div.choose-color-box ul li a").click(function(e){
				var clur_name = $(this).data("name");
				var rgb = [];
				var temp = "";
				var tp = [];
				var color_link = $(".choose-color-box a.text-color-link").data("radio");
				var color_image = $(".choose-color-box a.clipart-color-link").data("radio");

			if(color_link === 'active'){
				var font1 = $("input[name='hfont_1']").val(); var line_x_1 = $("li.first-line").css("left"); var line_y_1 = $("li.first-line").css("top");
				var font2 = $("input[name='hfont_2']").val();  var line_x_2 = $("li.second-line").css("left"); var line_y_2 = $("li.second-line").css("top");
				var font3 = $("input[name='hfont_3']").val();  var line_x_3 = $("li.third-line").css("left"); var line_y_3 = $("li.third-line").css("top");
				var font4 = $("input[name='hfont_4']").val();  var line_x_4 = $("li.fourth-line").css("left"); var line_y_4 = $("li.fourth-line").css("top");
				var size1 = $("input[name='hquan_1']").val();
				var size2 =$("input[name='hquan_2']").val();
				var size3 =$("input[name='hquan_3']").val();
				var size4 =$("input[name='hquan_4']").val();
				var x = $(".ajax-upload input[name='imgposx']").val();
				var y = $(".ajax-upload input[name='imgposy']").val();
						


					var clur = $(this).css("background-color");
					//var path = "/env/html5_configurator/banner/" + img;
					$("li.first-line").attr("style","font-family:  " + "'" + font1 + "'; " + "font-size: " + parseInt(size1) + "px; " + " color : " + clur + "; left: " + "" + line_x_1 + ";" + " top: " + "" + line_y_1 + ";"); 
					$("li.second-line").attr("style","font-family:  " + "'" + font2 + "'; " + "font-size: " + parseInt(size2) + "px; " + " color : " + clur + "; left: " + "" + line_x_2 + ";" + " top: " + "" + line_y_2 + ";"); 
					$("li.third-line").attr("style","font-family:  " + "'" + font3 + "'; " + "font-size: " + parseInt(size3) + "px; " + " color : " + clur + "; left: " + "" + line_x_3 + ";" + " top: " + "" + line_y_3 + ";");
					$("li.fourth-line").attr("style","font-family:  " + "'" + font4 + "'; " + "font-size: " + parseInt(size4) + "px; " + " color : " + clur + "; left: " + "" + line_x_4 + ";" + " top: " + "" + line_y_4 + ";");
					$("input[name='textColor']").val(clur);
					$(".choose-color-box a.text-color-link .text-color").html(clur_name);

					$("input[name='line_one_x']").val(line_x_1);
					$("input[name='line_two_x']").val(line_x_2);
					$("input[name='line_three_x']").val(line_x_3);
					$("input[name='line_four_x']").val(line_x_4);

					$("input[name='line_one_y']").val(line_y_1);
					$("input[name='line_two_y']").val(line_y_2);
					$("input[name='line_three_y']").val(line_y_3);
					$("input[name='line_four_y']").val(line_y_4);


					var l = clur.length - 4;
					// alert(l);
					temp = clur.substr(-l);
					rgb = temp.split(",");
					// alert(temp[2]);
					tp = rgb[2].split(")");
					rgb[2] = tp[0];

					localStorage['red_text'] = rgb[0];
					localStorage['green_text'] = rgb[1];
					localStorage['blue_text'] = rgb[2];



				} else if(color_image === 'active'){
						// alert("fired");
					$("div.choose-color-box ul li a").click(function(){
						// var overlay_img = $("div.overlay img#overlay-image").attr("src");
						// alert(overlay_img);
						var img_src = $("div.overlay img#original-image").attr("src");
					// if( img_src === ""){
					// var img = $("div.overlay img#original-image").attr("src");
					// } else {
					// var img = $("div.overlay img").attr("src");
					// }

					var img = $("div.overlay img#original-image").attr("src");
					console.log("value of img: " + img);
					temp = img.split("?");
					var query =  "?" + new Date().getTime();
					img = temp[0] + query;

					var clur = "";
					
					clur = $(this).css("background-color");
					
					$("input[name='artColor']").val(clur);
				
	
					var l = clur.length - 4;
					// alert(l);
					temp = clur.substr(-l);
					rgb = temp.split(",");
					// alert(temp[2]);
					tp = rgb[2].split(")");
					rgb[2] = tp[0];
					// alert(rgb[2]);

					// alert(clur);
					// rgb = hexToRgb(clur);
					//alert(rgb[0] + " , " + rgb[1] + "  ,  " + rgb[2]);

						
					localStorage['red_image'] = rgb[0];
					localStorage['green_image'] = rgb[1];
					localStorage['blue_image'] = rgb[2];
						
if($("div.overlay img#overlay-image").attr("src") != ""){
				
				var url_path = ($("#overlay-image").attr("data-upload") != 1) ? "/env/html5_configurator/color.php" : "/env/html5_configurator/color-uploaded.php";

					var server = $.ajax({
					url: url_path,
					type: "POST",
					data: { image: img, color: clur, red: rgb[0], green: rgb[1], blue: rgb[2], hex:clur}	
						});
					$("div.overlay img#overlay-image").attr("src", "/env/html5_configurator/hex-loader2.gif");
					server.done(function(data){
						  $("div.overlay img#overlay-image").attr("src", data);
						$("#overlay-image").addClass("clip-art upload-image");
							});
					$(".choose-color-box a.clipart-color-link .clipart-color").html(clur_name);
}
						});

				}
if($("div.overlay img#overlay-image").attr("src") != ""){				
						$("div.overlay img").css("visibility", "visible");
						$("div.overlay img").css("left", x);
						$("div.overlay img").css("top", y);
					}
			});
			

			// $(".wrapper-background").backgroundDraggable();
}




function transformButton(){			
			$('.upload-img').click(function(e){
				e.preventDefault();
				$(this).before("<input type='file' name='files[]' class='btn mango upload-btn' id='file-select' style='width: 120px;'></br><input type='submit' onclick='javascript:ajaxUpload()' value='Upload' class='btn mango' id='upload-button'>").remove();
			
				// $(this).remove();

					});
		}

function ajaxUpload(){					
			
		var	form = document.getElementById("file-upload");
		form.onsubmit = function(event){
			event.preventDefault();

				var	fileSelect = document.getElementById("file-select");
				var uploadButton = document.getElementById("upload-button");

		
			$("div.overlay img").attr("src", "/env/html5_configurator/hex-loader2.gif");
			uploadButton.innerHTML = 'Uploading...';

			var files = fileSelect.files;
			var formData = new FormData();

			// Loop through each of the selected files.
			for (var i = 0; i < files.length; i++) {
  			var file = files[i];

  		
  			// Add the file to the request.
  			formData.append('files[]', file, file.name);
				}

// Set up the request.
var xhr = new XMLHttpRequest();

// Open the connection.
if(window.location.pathname.match('\/products\/build\/[a-zA-Z]*'))
xhr.open('POST', '/env/html5_configurator/upload_bar.php', true);
else
xhr.open('POST', '/env/html5_configurator/upload.php', true);
// Set up a handler for when the request finishes.
xhr.onload = function () {
  if (xhr.status === 200) {
    // File(s) uploaded.
    uploadButton.innerHTML = 'Upload';
    var img = xhr.responseText;
    // alert(img);
    $("div.overlay img#overlay-image").attr("style", "visibility: visible;");
    $("div.overlay img").attr("data-upload", 1);
    $("div.overlay img#overlay-image").delay(2000).attr("src", "/" + img);
    $("div.overlay img#original-image").delay(2000).attr("src", "/" + img);
    $("#content.design-bar .ajax-upload input[name='layer_top']").val( "/" + img);
  } else {
    alert('An error occurred!');
  }
};


// Send the Data.
xhr.send(formData);

			}


}

function moveMyImage(){

		var parent = $("div.overlay img.clip-art").offset();
		

		$("div.overlay img.clip-art").draggable({axis: "x, y", containment:"parent"}).mouseup(function(){
				//var pos = $(this).offset();
				var x = $(this).css("left"); var y = $(this).css("top");
				$(".ajax-upload input[name='imgposx']").val(x);
				$(".ajax-upload input[name='imgposy']").val(y);

				//alert("x : " + x + " , " + "y :" + y);
		});
}

function moveMyText(){
	$("#content.design-bar div.overlay ul li.first-line, #content.design-bar div.overlay ul li.second-line, #content.design-bar  div.overlay ul li.third-line, #content.design-bar  div.overlay ul li.fourth-line ").draggable({axis: "x", containment:"parent"});
	$("#content.design-wrapper div.wrapper-background div.overlay ul li.first-line, #content.design-wrapper div.wrapper-background div.overlay ul li.second-line, #content.design-wrapper div.wrapper-background div.overlay ul li.third-line, #content.design-wrapper div.wrapper-background div.overlay ul li.fourth-line ").draggable({axis: "x, y", containment:"parent"});
}

function dPicker(){
$('#requesteddate').datepicker({dateFormat: 'yy-mm-dd'});
}

function itemCounter(){
	var num = 1;
	$(".item-col").each(function(){
		$(this).removeClass("num-").addClass("num-" + num);
		$(this).find("a.minus-").removeClass("minus-").addClass("minus-" + num);
		$(this).find("input.qual-").removeClass("qual-").addClass("qual-" + num);
		$(this).find("a.add-").removeClass("add-").addClass("add-" + num);
		num++;
	});
}

function relocate(url){
	window.location = url;
}

function changeQual(){
	var num = 0;
		$("a").on("click", function(e){

					if(e.handled !== true){
				if($(this).hasClass("reduce")){
					//alert("reduce");
					num = $(this).parent().find("input").val();
					if(num > 200)num--;
					$(this).parent().find("input").val(num);
					event.stopPropagation();
					event.preventDefault();
				}

				if($(this).hasClass("plus")){
					//alert("plus");
					num = $(this).parent().find("input").val();
					num++;
					$(this).parent().find("input").val(num);
					event.stopPropagation();
					event.preventDefault();
						}
				e.handled = true;
					}

			});
}

function storeColor(){
	$("#content.design-wrapper .choose-color-box ul li a").click(function(){
				var color = $(this).css("background-color");
				$("#content.design-wrapper form[name='store_color'] input[name='textColor']").val(color);
				$("#content.design-wrapper form[name='store_color'] input[name='artColor']").val(color);

		});
}


function saveBar(){

		var temp = "";
		var line_1 = $("#content.design-bar form[name='add_text_to_bar']  input[name='line_1']").val();
		var line_2 = $("#content.design-bar form[name='add_text_to_bar']  input[name='line_2']").val();
		var line_3 = $("#content.design-bar form[name='add_text_to_bar']  input[name='line_3']").val();
		var line_4 = $("#content.design-bar form[name='add_text_to_bar']  input[name='line_4']").val();
		var line_1_size = $("#content.design-bar form[name='add_text_to_bar']  input[name='quan_1']").val();
		var line_2_size = $("#content.design-bar form[name='add_text_to_bar']  input[name='quan_2']").val();
		var line_3_size = $("#content.design-bar form[name='add_text_to_bar']  input[name='quan_3']").val();
		var line_4_size = $("#content.design-bar form[name='add_text_to_bar']  input[name='quan_4']").val();
		var line_1_font = $("#content.design-bar .add-text-box form[name='add_text_to_bar']  select[name='font_1']").val();
		var line_2_font = $("#content.design-bar .add-text-box form[name='add_text_to_bar']  select[name='font_2']").val();
		var line_3_font = $("#content.design-bar .add-text-box form[name='add_text_to_bar']  select[name='font_3']").val();
		var line_4_font = $("#content.design-bar .add-text-box form[name='add_text_to_bar']  select[name='font_4']").val();
		var bar_type = $("#content.design-bar .choose-type-bar form input[name='bar_type']").val();
		var layer_top = $("#content.design-bar .ajax-upload input[name='layer_top']").val();
		var base =   $("#content.design-bar .ajax-upload input[name='baseimg']").val();
		var productsid = $("#content.design-bar .ajax-upload input[name='productsid']").val();
		var productname = $("#content.design-bar .ajax-upload input[name='productname']").val();
		var sessionid = $("#content.design-bar .ajax-upload input[name='sessionid']").val();
		var url = $("#content.design-bar button.save").data("url");
		var hquan_1 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hquan_1']").val();
		var hquan_2 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hquan_2']").val();
		var hquan_3 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hquan_3']").val();
		var hquan_4 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hquan_4']").val();
		var hfont_1 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hfont_1']").val();
		var hfont_2 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hfont_2']").val();
		var hfont_3 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hfont_3']").val();
		var hfont_4 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hfont_4']").val();
		var line_one_x = $("#content.design-bar form[name='add_text_to_bar'] input[name='line_one_x']").val();
		temp = line_one_x.split("px");
		line_one_x = parseInt(temp[0]);
		var line_two_x = $("#content.design-bar form[name='add_text_to_bar'] input[name='line_two_x']").val();
		temp = line_two_x.split("px");
		line_two_x = parseInt(temp[0]);
		var line_three_x = $("#content.design-bar form[name='add_text_to_bar'] input[name='line_three_x']").val();
		temp = line_three_x.split("px");
		line_three_x = parseInt(temp[0]);
		var line_four_x = $("#content.design-bar form[name='add_text_to_bar'] input[name='line_four_x']").val();
		temp = line_four_x.split("px");
		line_four_x = parseInt(temp[0]);
		var imgposx = parseInt($("#content.design-bar .ajax-upload input[name='imgposx']").val());
		var imgposy = parseInt($("#content.design-bar .ajax-upload input[name='imgposy']").val());
		var uploaded = parseInt($("#content.design-bar div.overlay img#overlay-image").attr("data-upload"));

		 console.log("line 1" + line_1 + "\r\n" +
			"line 2" + line_2 + "\r\n" +
			"line 3" + line_3 + "\r\n" +
			"line 4" + line_4 + "\r\n" +
			"line_1_size" + line_1_size + "\r\n" +
			"line_2_size" + line_2_size + "\r\n" +
			"line_3_size" + line_3_size + "\r\n" +
			"line_4_size" + line_4_size + "\r\n" +
			"line 1 font " + line_1_font + "\r\n" +
			"line 2 font " + line_2_font + "\r\n" +
			"line 3 font " + line_3_font + "\r\n" +
			"line 4 font " + line_4_font + "\r\n" +
			"bar type " + bar_type + "\r\n" +
			"layer top " + layer_top + "\r\n" +
			"base " + base + "\r\n" +
			"products id " + productsid + "\r\n" +
			"product name " + productname + "\r\n" +
			"session id " + sessionid + "\r\n" 
			);

		 	if(supports_html5_storage()){
			localStorage["bar_line_one"] =  line_1; 
			localStorage["bar_line_two"] = line_2;
			localStorage["bar_line_three"] = line_3;
			localStorage["bar_line_four"] = line_4;
			localStorage["bar_line_one_size"] = line_1_size;
			localStorage["bar_line_two_size"] = line_2_size;
			localStorage["bar_line_three_size"] = line_3_size;
			localStorage["bar_line_four_size"] = line_4_size;
			localStorage["bar_line_one_font"] = line_1_font;
			localStorage["bar_line_two_font"] = line_2_font;
			localStorage["bar_line_three_size"] = line_3_font;
			localStorage["bar_line_four_size"] = line_4_font;
			localStorage["bar_layer_top"] = layer_top;
			localStorage["bar_base"] = base;
			localStorage["bar_bar_type"] = bar_type;
			localStorage["bar_productsid"] = productsid;
			localStorage["bar_productname"] = productname;
			localStorage["bar_sessionid"] = sessionid;
			localStorage["bar_conf_type"] =  'bar';
			localStorage["bar_hquan_1"] =  hquan_1;
			localStorage["bar_hquan_2"] =  hquan_2;
			localStorage["bar_hquan_3"] =  hquan_3;
			localStorage["bar_hquan_4"] =  hquan_4;
			localStorage["bar_hfont_1"] =  hfont_1;
			localStorage["bar_hfont_2"] =  hfont_2;
			localStorage["bar_hfont_3"] =  hfont_3;
			localStorage["bar_hfont_4"] =  hfont_4;
			localStorage["bar_line_one_x"] =  line_one_x;
			localStorage["bar_line_two_X"] =  line_two_x;
			localStorage["bar_line_three_x"] =  line_three_x;
			localStorage["bar_line_four_x"] =  line_four_x;
			localStorage["bar_imgposx"] =  imgposx;
			localStorage["bar_imgposy"] =  imgposy;
			localStorage["bar_uploaded"] = uploaded;
	}

					var server = $.ajax({
					url: "/env/html5_configurator/submit.php",
					type: "POST",
					data: {line_one: line_1, 
						   line_two: line_2, 
						   line_three: line_3, 
						   line_four: line_4,
						   line_one_size: line_1_size, 
						   line_two_size: line_2_size, 
						   line_three_size: line_3_size, 
						   line_four_size: line_4_size,
						   line_one_font: line_1_font, 
						   line_two_font: line_2_font, 
						   line_three_font: line_3_font, 
						   line_four_font: line_4_font,
						   line_one_x: line_one_x,
						   line_two_x: line_two_x,
						   line_three_x: line_three_x,
						   line_four_x: line_four_x,
						   line_one_y: 0,
						   line_two_y: 0,
						   line_three_y: 0,
						   line_four_y: 0,
						   image_uploaded: uploaded,
						   bar_type: bar_type,
						   layer_top: layer_top,
						   base: base,
						   productsid: productsid,
						   productname: productname,
						   sessionid: sessionid,
						   conf_type: 'bar'  }
				});
				server.done(function(data){
				setTimeout(function(){window.location = url}, 3000);
				});

				server.fail(function(jqXHR, textStatus){
				alert('Server error, contact the site admin.');
				});

				delete this.line_1;
				delete this.line_2;
				delete this.line_3;
				delete this.line_4;
				delete this.line_1_size;
				delete this.line_2_size;
				delete this.line_3_size;
				delete this.line_4_size;
				delete this.line_1_font;
				delete this.line_2_font;
				delete this.line_3_font;
				delete this.line_4_font;
				delete this.bar_type;
				delete this.layer_top;
				delete this.base;
				delete this.productsid;
				delete this.productname;
				delete this.sessionid;
				delete this.conf_type;
				return;


	
}


function saveWrapper(){

		var line_1 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='line_1']").val();
		var line_2 = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_2']").val();
		var line_3 = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_3']").val();
		var line_4 = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_4']").val();
		var line_1_size = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='quan_1']").val();
		var line_2_size = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='quan_2']").val();
		var line_3_size = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='quan_3']").val();
		var line_4_size = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='quan_4']").val();
		var line_1_font = $("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   select[name='font_1']").val();
		var line_2_font = $("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   select[name='font_2']").val();
		var line_3_font = $("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   select[name='font_3']").val();
		var line_4_font = $("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   select[name='font_4']").val();
		var line_1_color; var line_2_color; var line_3_color; var line_4_color;

				line_1_color = $("#content.design-wrapper form[name='store_color'] input[name='textColor']").val();
				line_2_color = $("#content.design-wrapper form[name='store_color'] input[name='textColor']").val();
				line_3_color = $("#content.design-wrapper form[name='store_color'] input[name='textColor']").val();
				line_4_color = $("#content.design-wrapper form[name='store_color'] input[name='textColor']").val();
	
		var wrapper = "/var/www/mch" + $("#content.design-wrapper .ajax-upload input[name='wrapper']").val();
		var layer_top = $("#content.design-wrapper .ajax-upload input[name='layer_top']").val();
		//var base = $("#content.design-wrapper .wrapper-background img:first-child").attr('src');
		var base = "/var/www/mch" + $("#content.design-wrapper .ajax-upload input[name='baseimg']").val();
		var productsid = $("#content.design-wrapper .ajax-upload input[name='productsid']").val();
		var productname = $("#content.design-wrapper .ajax-upload input[name='productname']").val();
		var sessionid = $("#content.design-wrapper .ajax-upload input[name='sessionid']").val();
		var userid = $("#content.design-wrapper .ajax-upload input[name='userid']").val();
		var url = $("#content.design-wrapper button.save-cart").data("url");
			var hquan_1 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='hquan_1']").val();
		var hquan_2 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='hquan_2']").val();
		var hquan_3 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='hquan_3']").val();
		var hquan_4 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='hquan_4']").val();
		var hfont_1 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='hfont_1']").val();
		var hfont_2 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='hfont_2']").val();
		var hfont_3 = $("#content.design-wrappper form[name='add_text_to_bar'] input[name='hfont_3']").val();
		var hfont_4 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='hfont_4']").val();
		var line_one_x = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='line_one_x']").val();
		temp = line_one_x.split("px");
		line_one_x = parseInt(temp[0]);
		var line_two_x = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='line_two_x']").val();
		temp = line_two_x.split("px");
		line_two_x = parseInt(temp[0]);
		var line_three_x = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='line_three_x']").val();
		temp = line_three_x.split("px");
		line_three_x = parseInt(temp[0]);
		var line_four_x = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='line_four_x']").val();
		temp = line_four_x.split("px");
		line_four_x = parseInt(temp[0]);
		var imgposx = parseInt($("#content.design-wrapper .ajax-upload input[name='imgposx']").val());
		var imgposy = parseInt($("#content.design-wrapper .ajax-upload input[name='imgposy']").val());
		var uploaded = parseInt($("#content.design-wrapper div.overlay img#overlay-image").attr("data-upload"));

	 console.log("line 1" + line_1 + "\r\n" +
			"line 2" + line_2 + "\r\n" +
			"line 3" + line_3 + "\r\n" +
			"line 4" + line_4 + "\r\n" +
			"line_1_size" + line_1_size + "\r\n" +
			"line_2_size" + line_2_size + "\r\n" +
			"line_3_size" + line_3_size + "\r\n" +
			"line_4_size" + line_4_size + "\r\n" +
			"line_1_font" + line_1_font + "\r\n" +
			"line_2_font" + line_2_font + "\r\n" +
			"line_3_font" + line_3_font + "\r\n" +
			"line_4_font" + line_4_font + "\r\n" +
			"line_1_color" + line_1_color + "\r\n" +
			"line_2_color" + line_2_color + "\r\n" +
			"line_3_color" + line_3_color + "\r\n" +
			"line_4_color" + line_4_color + "\r\n" +
			"wrapper" + wrapper + "\r\n" +
			"layer_top" + layer_top + "\r\n" +
			"base" + base + "\r\n" +
			"productsid" + productsid + "\r\n" +
			"productname" + productname + "\r\n" +
			"sessionid" + sessionid + "\r\n" +
			"userid" + userid + "\r\n"
			); 

	if(supports_html5_storage()){
			 
			localStorage["wrapper_line_one"] =  line_1; 
			localStorage["wrapper_line_two"] = line_2;
			localStorage["wrapper_line_three"] = line_3;
			localStorage["wrapper_line_four"] = line_4;
			localStorage["wrapper_line_one_size"] = line_1_size;
			localStorage["wrapper_line_two_size"] = line_2_size;
			localStorage["wrapper_line_three_size"] = line_3_size;
			localStorage["wrapper_line_four_size"] = line_4_size;
			localStorage["wrapper_line_one_font"] = line_1_font;
			localStorage["wrapper_line_two_font"] = line_2_font;
			localStorage["wrapper_line_three_size"] = line_3_font;
			localStorage["wrapper_line_four_size"] = line_4_font;
			localStorage["wrapper_layer_top"] = layer_top;
			localStorage["wrapper_base"] = base;
			localStorage["wrapper_wrap"] = wrapper;
			localStorage["wrapper_productsid"] = productsid;
			localStorage["wrapper_productname"] = productname;
			localStorage["wrapper_sessionid"] = sessionid;
			localStorage["wrapper_conf_type"] =  'bar';
			localStorage["wrapper_hquan_1"] =  hquan_1;
			localStorage["wrapper_hquan_2"] =  hquan_2;
			localStorage["wrapper_hquan_3"] =  hquan_3;
			localStorage["wrapper_hquan_4"] =  hquan_4;
			localStorage["wrapper_hfont_1"] =  hfont_1;
			localStorage["wrapper_hfont_2"] =  hfont_2;
			localStorage["wrapper_hfont_3"] =  hfont_3;
			localStorage["wrapper_hfont_4"] =  hfont_4;
			localStorage["wrapper_line_one_x"] =  line_one_x;
			localStorage["wrapper_line_two_X"] =  line_two_x;
			localStorage["wrapper_line_three_x"] =  line_three_x;
			localStorage["wrapper_line_four_x"] =  line_four_x;
			localStorage["wrapper_imgposx"] =  imgposx;
			localStorage["wrapper_imgposy"] =  imgposy;
			localStorage["wrapper_uploaded"] = uploaded;

	}


					var server = $.ajax({
					url:"/env/html5_configurator/submit.php",
					type: "POST",
					data: {line_one: line_1, 
						   line_two: line_2, 
						   line_three: line_3, 
						   line_four: line_4,
						   line_one_size: line_1_size, 
						   line_two_size: line_2_size, 
						   line_three_size: line_3_size, 
						   line_four_size: line_4_size,
						   line_one_font: line_1_font, 
						   line_two_font: line_2_font, 
						   line_three_font: line_3_font, 
						   line_four_font: line_4_font,
						   line_one_color: line_1_color,
						   line_two_color: line_2_color,
						   line_three_color: line_3_color,
						   line_four_color: line_4_color,
						   wrapper: wrapper,
						   layer_top: layer_top,
						   base: base,
						   productsid: productsid,
						   productname: productname,
						   sessionid: sessionid,
						   userid: userid,
						   conf_type: 'wrapper'  }
				});
				server.done(function(data){
				setTimeout(function(){window.location = url}, 2000);
				});

				server.fail(function(jqXHR, textStatus){
				alert('Server error, contact the site admin.');
				});

				// delete this.line_1;
				// delete this.line_2;
				// delete this.line_3;
				// delete this.line_4;
				// delete this.line_1_size;
				// delete this.line_2_size;
				// delete this.line_3_size;
				// delete this.line_4_size;
				// delete this.line_1_font;
				// delete this.line_2_font;
				// delete this.line_3_font;
				// delete this.line_4_font;
				// delete this.line_1_color;
				// delete this.line_2_color;
				// delete this.line_3_color;
				// delete this.line_4_color;
				// delete this.wrapper;
				// delete this.bar_type;
				// delete this.layer_top;
				// delete this.base;
				// delete this.productsid;
				// delete this.productname;
				// delete this.sessionid;
				// delete this.conf_type;
				// delete this.userid;

		}


function saveLater(){

		var line_1 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='line_1']").val();
		var line_2 = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_2']").val();
		var line_3 = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_3']").val();
		var line_4 = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_4']").val();
		var line_1_size = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='quan_1']").val();
		var line_2_size = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='quan_2']").val();
		var line_3_size = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='quan_3']").val();
		var line_4_size = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='quan_4']").val();
		var line_1_font = $("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   select[name='font_1']").val();
		var line_2_font = $("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   select[name='font_2']").val();
		var line_3_font = $("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   select[name='font_3']").val();
		var line_4_font = $("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   select[name='font_4']").val();
		var line_1_color; var line_2_color; var line_3_color; var line_4_color;

				line_1_color = $("#content.design-wrapper form[name='store_color'] input[name='textColor']").val();
				line_2_color = $("#content.design-wrapper form[name='store_color'] input[name='textColor']").val();
				line_3_color = $("#content.design-wrapper form[name='store_color'] input[name='textColor']").val();
				line_4_color = $("#content.design-wrapper form[name='store_color'] input[name='textColor']").val();
	
		var wrapper = "/var/www/mch" + $("#content.design-wrapper .ajax-upload input[name='wrapper']").val();
		var layer_top = $("#content.design-wrapper .ajax-upload input[name='layer_top']").val();
		//var base = $("#content.design-wrapper .wrapper-background img:first-child").attr('src');
		var base =  "/var/www/mch" + $("#content.design-wrapper .ajax-upload input[name='baseimg']").val();
		var productsid = $("#content.design-wrapper .ajax-upload input[name='productsid']").val();
		var productname = $("#content.design-wrapper .ajax-upload input[name='productname']").val();
		var sessionid = $("#content.design-wrapper .ajax-upload input[name='sessionid']").val();
		var userid = $("#content.design-wrapper .ajax-upload input[name='userid']").val();
		var url = $("#content.design-wrapper button.save-later").data("url");

	 // console.log(line_1 + "\r\n" +
		// 	line_2 + "\r\n" +
		// 	line_3 + "\r\n" +
		// 	line_4 + "\r\n" +
		// 	line_1_size + "\r\n" +
		// 	line_2_size + "\r\n" +
		// 	line_3_size + "\r\n" +
		// 	line_4_size + "\r\n" +
		// 	line_1_font + "\r\n" +
		// 	line_2_font + "\r\n" +
		// 	line_3_font + "\r\n" +
		// 	line_4_font + "\r\n" +
		// 	line_1_color + "\r\n" +
		// 	line_2_color + "\r\n" +
		// 	line_3_color + "\r\n" +
		// 	line_4_color + "\r\n" +
		// 	wrapper + "\r\n" +
		// 	layer_top + "\r\n" +
		// 	base + "\r\n" +
		// 	productsid + "\r\n" +
		// 	productname + "\r\n" +
		// 	userid + "\r\n" +
		// 	sessionid + "\r\n"
		// 	); 

		if(supports_html5_storage()){
			localStorage["wrapper"] = {line_one: line_1, 
									line_two: line_2,
									line_three: line_3,
									line_four: line_4,
									line_one_size: line_1_size,
									line_two_size: line_2_size,
									line_three_size: line_3_size,
									line_four_size: line_4_size,
									line_one_font: line_1_font,
									line_two_font: line_2_font,
									line_three_font: line_3_font,
									line_four_font: line_4_font,
									wrapper: wrapper,
									layer_top: layer_top,
									base: base,
									productsid: productsid,
									productname: productname,
									sessionid: sessionid,
									userid: userid,
									conf_type: 'save'}	
	}


					var server = $.ajax({
					url:"/env/html5_configurator/submit.php",
					type: "POST",
					data: {line_one: line_1, 
						   line_two: line_2, 
						   line_three: line_3, 
						   line_four: line_4,
						   line_one_size: line_1_size, 
						   line_two_size: line_2_size, 
						   line_three_size: line_3_size, 
						   line_four_size: line_4_size,
						   line_one_font: line_1_font, 
						   line_two_font: line_2_font, 
						   line_three_font: line_3_font, 
						   line_four_font: line_4_font,
						   line_one_color: line_1_color,
						   line_two_color: line_2_color,
						   line_three_color: line_3_color,
						   line_four_color: line_4_color,
						   wrapper: wrapper,
						   layer_top: layer_top,
						   base: base,
						   productsid: productsid,
						   productname: productname,
						   sessionid: sessionid,
						   userid: userid,
						   conf_type: 'save'  }
				});
				server.done(function(data){
				setTimeout(function(){window.location = url}, 2000);
				});

				server.fail(function(jqXHR, textStatus){
				alert('Server error, contact the site admin.');
				});

				delete this.line_1;
				delete this.line_2;
				delete this.line_3;
				delete this.line_4;
				delete this.line_1_size;
				delete this.line_2_size;
				delete this.line_3_size;
				delete this.line_4_size;
				delete this.line_1_font;
				delete this.line_2_font;
				delete this.line_3_font;
				delete this.line_4_font;
				delete this.line_1_color;
				delete this.line_2_color;
				delete this.line_3_color;
				delete this.line_4_color;
				delete this.wrapper;
				delete this.bar_type;
				delete this.layer_top;
				delete this.base;
				delete this.productsid;
				delete this.productname;
				delete this.sessionid;
				delete this.userid;
				delete this.conf_type;
				return;


}

function savePopup(){

		var line_1 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='line_1']").val();
		var line_2 = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_2']").val();
		var line_3 = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_3']").val();
		var line_4 = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_4']").val();
		var line_1_size = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='quan_1']").val();
		var line_2_size = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='quan_2']").val();
		var line_3_size = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='quan_3']").val();
		var line_4_size = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='quan_4']").val();
		var line_1_font = $("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   select[name='font_1']").val();
		var line_2_font = $("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   select[name='font_2']").val();
		var line_3_font = $("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   select[name='font_3']").val();
		var line_4_font = $("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   select[name='font_4']").val();
		var line_1_color; var line_2_color; var line_3_color; var line_4_color;

				line_1_color = $("#content.design-wrapper form[name='store_color'] input[name='textColor']").val();
				line_2_color = $("#content.design-wrapper form[name='store_color'] input[name='textColor']").val();
				line_3_color = $("#content.design-wrapper form[name='store_color'] input[name='textColor']").val();
				line_4_color = $("#content.design-wrapper form[name='store_color'] input[name='textColor']").val();
	
		var wrapper = "/var/www/mch" + $("#content.design-wrapper .ajax-upload input[name='wrapper']").val();
		var layer_top = $("#content.design-wrapper .ajax-upload input[name='layer_top']").val();
		//var base = $("#content.design-wrapper .wrapper-background img:first-child").attr('src');
		var base =  "/var/www/mch" + $("#content.design-wrapper .ajax-upload input[name='baseimg']").val();
		var productsid = $("#content.design-wrapper .ajax-upload input[name='productsid']").val();
		var productname = $("#content.design-wrapper .ajax-upload input[name='productname']").val();
		var sessionid = $("#content.design-wrapper .ajax-upload input[name='sessionid']").val();
		var userid = $("#content.design-wrapper .ajax-upload input[name='userid']").val();
		var url = $("#navi-listen button.save-n-quit").data("href");
	
	 // alert(line_1 + "\r\n" +
		// 	line_2 + "\r\n" +
		// 	line_3 + "\r\n" +
		// 	line_4 + "\r\n" +
		// 	line_1_size + "\r\n" +
		// 	line_2_size + "\r\n" +
		// 	line_3_size + "\r\n" +
		// 	line_4_size + "\r\n" +
		// 	line_1_font + "\r\n" +
		// 	line_2_font + "\r\n" +
		// 	line_3_font + "\r\n" +
		// 	line_4_font + "\r\n" +
		// 	line_1_color + "\r\n" +
		// 	line_2_color + "\r\n" +
		// 	line_3_color + "\r\n" +
		// 	line_4_color + "\r\n" +
		// 	wrapper + "\r\n" +
		// 	layer_top + "\r\n" +
		// 	base + "\r\n" +
		// 	productsid + "\r\n" +
		// 	productname + "\r\n" +
		// 	userid + "\r\n" +
		// 	sessionid + "\r\n"
		// 	); 

	if(supports_html5_storage()){
			localStorage["wrapper"] = {line_one: line_1, 
									line_two: line_2,
									line_three: line_3,
									line_four: line_4,
									line_one_size: line_1_size,
									line_two_size: line_2_size,
									line_three_size: line_3_size,
									line_four_size: line_4_size,
									line_one_font: line_1_font,
									line_two_font: line_2_font,
									line_three_font: line_3_font,
									line_four_font: line_4_font,
									wrapper: wrapper,
									layer_top: layer_top,
									base: base,
									productsid: productsid,
									productname: productname,
									sessionid: sessionid,
									userid: userid,
									conf_type: 'save'}	
	}

					var server = $.ajax({
					url:"/env/html5_configurator/submit.php",
					type: "POST",
					data: {line_one: line_1, 
						   line_two: line_2, 
						   line_three: line_3, 
						   line_four: line_4,
						   line_one_size: line_1_size, 
						   line_two_size: line_2_size, 
						   line_three_size: line_3_size, 
						   line_four_size: line_4_size,
						   line_one_font: line_1_font, 
						   line_two_font: line_2_font, 
						   line_three_font: line_3_font, 
						   line_four_font: line_4_font,
						   line_one_color: line_1_color,
						   line_two_color: line_2_color,
						   line_three_color: line_3_color,
						   line_four_color: line_4_color,
						   wrapper: wrapper,
						   layer_top: layer_top,
						   base: base,
						   productsid: productsid,
						   productname: productname,
						   sessionid: sessionid,
						   userid: userid,
						   conf_type: 'save'  }
				});
				server.done(function(data){
				setTimeout(function(){window.location = url}, 4000);
				});

				server.fail(function(jqXHR, textStatus){
				alert('Server error, contact the site admin.');
				});

				delete this.line_1;
				delete this.line_2;
				delete this.line_3;
				delete this.line_4;
				delete this.line_1_size;
				delete this.line_2_size;
				delete this.line_3_size;
				delete this.line_4_size;
				delete this.line_1_font;
				delete this.line_2_font;
				delete this.line_3_font;
				delete this.line_4_font;
				delete this.line_1_color;
				delete this.line_2_color;
				delete this.line_3_color;
				delete this.line_4_color;
				delete this.wrapper;
				delete this.bar_type;
				delete this.layer_top;
				delete this.base;
				delete this.productsid;
				delete this.productname;
				delete this.sessionid;
				delete this.userid;
				delete this.conf_type;
				return;

		

}

function billingToShipping(){
	$("input[name='s_billing'], input[name='same']").on("click", function(e){
			
if(e.handled !== true){
		if($(this).val() != "1"){
			//alert("not checked");
			$(this).val("1");
			var firstname = $("input[name='billingFirstname'], input[name='first_name']").val();
			var lastname = $("input[name='billingLastname'], input[name='last_name']").val();
			var company = $("input[name='billingCompany'], input[name='company']").val();
			var address_1 = $("input[name='billingAddress1'], input[name='address_1']").val();
			var address_2 = $("input[name='billingAddress2'], input[name='address_2']").val();
			var city = $("input[name='billingCity'], input[name='city']").val();
			var state = $("select[name='billingState'], select[name='state']").val();
			var zip = $("input[name='billingZip'], input[name='zip']").val();
			var country = $("select[name='billingCountry'], select[name='country']").val();
	

			 $("input[name='shippingFirstname'], input[name='s_first_name']").val(firstname);
			 $("input[name='shippingLastname'], input[name='s_last_name']").val(lastname);
			 $("input[name='shippingCompany'], input[name='s_company']").val(company);
			 $("input[name='shippingAddress1'], input[name='s_address_1']").val(address_1);
			 $("input[name='shippingAddress2'], input[name='s_address_2']").val(address_2);
			 $("input[name='shippingCity'], input[name='s_city']").val(city);
			 $("select[name='shippingState'], select[name='s_state']").val(state);
			 $("input[name='shippingZip'], input[name='s_zip']").val(zip);
			 $("select[name='shippingCountry'], select[name='s_country']").val(country);









		}else{
			//alert("checked");
			$(this).val("");
		 	 $("input[name='shippingFirstname'], input[name='s_first_name']").val("");
			 $("input[name='shippingLastname'], input[name='s_last_name']").val("");
			 $("input[name='shippingCompany'], input[name='s_company']").val("");
			 $("input[name='shippingAddress1'], input[name='s_address1']").val("");
			 $("input[name='shippingAddress2'], input[name='s_address2']").val("");
			 $("input[name='shippingCity'], input[name='s_city']").val("");
			 $("input[name='shippingState'], input[name='s_state']").val("");
			 $("input[name='shippingZip'], input[name='s_zip']").val("");
			 $("input[name='shippingCountry'], input[name='s_country']").val("");
		}
		e.handled = true;
		}
	});
}

function moveImg(){
		var btop = $("content.design-bar design-bar-custom div.overlay").position.top;
		var bleft = $("content.design-bar design-bar-custom div.overlay").position.left;
		$("content.design-bar design-bar-custom img").darggable({axis: 'y', containment : [0, btop, 0, 0]});
		$("content.design-bar design-bar-custom img").darggable({axis: 'x', containment : [bleft, 0, 0, 0]});
		$("content.design-wrapper design-bar-custom img").darggable({axis: 'y', containment : [0, btop, 0, 0]});
		$("content.design-wrapper design-bar-custom img").darggable({axis: 'x', containment : [bleft, 0, 0, 0]});

}

function resizableImg(){
		$("content.design-bar design-bar-custom img").resizable();
		$("content.design-bar design-bar-custom img").resizable();
		$("content.design-wrapper design-bar-custom img").resizable();
		$("content.design-wrapper design-bar-custom img").resizable();
}


function editInfo(){
		$("button").click(function(e){
			var cls = "";
				if(e.handled != true){
							if(cls = $(this).hasClass("edit-details")){
								
								//cls = "#" + cls;
								$('#edit-details').show();
							}

							if(cls = $(this).hasClass("edit-password")){
								//cls = "#" + cls;
								$('#edit-password').show();
							}
					e.handled = true;
				}
		});
}


function popup(){
			$("#content.design-wrapper a").click(function(){

			});
}

function adjustSize(){
		$("input[name='img_width']").click(function(){
			$(".design-bar-custom  img.clip-art").attr("width", parseInt($(this).val()));
		});
		$("input[name='img_height']").click(function(){
			$(".design-bar-custom  img.clip-art").attr("height", parseInt($(this).val()));

		});

		$("button.image-plus").click(function(e){
			
			var w = parseInt($(".design-bar-custom  img.clip-art").attr("width"));			
			
			if(w < 200) {
			$("input[name='img_width']").val(w++);
			$(".design-bar-custom  img.clip-art").attr("width", w++);
			}
			var h = parseInt($(".design-bar-custom  img.clip-art").attr("height"));	
			
			if(h < 200) {
			$("input[name='img_height']").val(h++);
			$(".design-bar-custom  img.clip-art").attr("height", h++);
			}

		});
	
		$("button.image-minus").click(function(e){

		
			var w = parseInt($(".design-bar-custom  img.clip-art").attr("width"));			
					
			if(w > 50) {
			$("input[name='img_width']").val(w--);
			$(".design-bar-custom  img.clip-art").attr("width", w--);
			}
			
			var h = parseInt($(".design-bar-custom  img.clip-art").attr("height"));	
			if(h > 50) {
			$("input[name='img_height']").val(h--);
			$(".design-bar-custom  img.clip-art").attr("height", h--);
			}
		

		});

		$("button.image-remove").click(function(e){
			e.preventDefault();
			$(".design-bar-custom  img.clip-art").attr("src", "");
			$(".design-bar-custom img.clip-art").attr("style", "visibility: hidden;")

		});

}

function tabbing(){
	$(".tab-display ul li a").click(function(){
			if($(this).parent().hasClass("tab-description")){
					$(".tab-price, .tab-production").removeClass("lt-brown selected").addClass("grey");
					$(this).parent().removeClass("grey").addClass("lt-brown selected");
					$("div.description-price, div.description-production").hide();
					$("div.description").show();
			}
			if($(this).parent().hasClass("tab-price")){
					$(".tab-description, .tab-production").removeClass("lt-brown selected").addClass("grey");
					$(this).parent().removeClass("grey").addClass("lt-brown selected");
					$("div.description-production, div.description").hide();
					$("div.description-price").show();
			}
			if($(this).parent().hasClass("tab-production")){
					$(".tab-description, .tab-price").removeClass("lt-brown selected").addClass("grey");
					$(this).parent().removeClass("grey").addClass("lt-brown selected");
					$("div.description, div.description-price").hide();
					$("div.description-production").show();
			}
	});
}

function switchColorController(){
		$("a.text-color-link").click(function(e){
			e.preventDefault();
			e.stopPropagation();

			
					switch($(this).data("radio")){

							case "inactive":
								$("a.text-color-link").data("radio", "active").addClass("grey rnd-bar rnd selected");
								$("a.clipart-color-link").data("radio", "inactive").removeClass("grey rnd-bar rnd selected");
								$("form[name='select_color'] #radio-text").attr("checked", "");
								$("form[name='select_color'] #radio-clipart").removeAttr("checked");
							break;

							case "active":
								$("a.clipart-color-link").data("radio", "active").addClass("grey rnd-bar rnd selected");
								$("a.text-color-link").data("radio", "inactive").removeClass("grey rnd-bar rnd selected");
								$("form[name='select_color'] #radio-clipart").attr("checked", "");
								$("form[name='select_color'] #radio-text").removeAttr("checked");

							break;
					
			}

		});

		$("a.clipart-color-link").click(function(e){
			e.preventDefault();
			e.stopPropagation();

					switch($(this).data("radio")){

							case "inactive":
								$("a.clipart-color-link").data("radio", "active").addClass("grey rnd-bar rnd selected");
								$("a.text-color-link").data("radio", "inactive").removeClass("grey rnd-bar rnd selected");
								$("form[name='select_color'] #radio-clipart").attr("checked", "");
								$("form[name='select_color'] #radio-text").removeAttr("checked");
							break;
					
							case "active":
								$("a.text-color-link").data("radio", "active").addClass("grey rnd-bar rnd selected");
								$("a.clipart-color-link").data("radio", "inactive").removeClass("grey rnd-bar rnd selected");
								$("form[name='select_color'] #radio-text").attr("checked", "");
								$("form[name='select_color'] #radio-clipart").removeAttr("checked");
							break;
			}

		});
}

function quantityPage(){
		var quan = ""; var rate = "";
		quan = $("input.number-field").val();
		rate = $("input.item-rate").val();
		$("span.price-subtotal-col").html(parseFloat(quan*rate));


		$(".quantity-selector a.reduce, .quantity-selector a.plus").click(function(){
				var val = "";
				val = $("input.number-field").val();
				var class_name = $(this).attr("class");
				 // alert(rate);
				class_name === 'plus' ? val ++ : val-- ;
				$("span.price-subtotal-col").html(parseFloat(val*rate));

				
		});
}



function loadInArt(){
			$("div.clipart-box form select[name='clipart_select']").off('change');
			var path =  "";
			$("div.clipart-box form select[name='clipart_select']").change(function(){
					path = $(this).val();
					//alert(path);

					var server = $.ajax({
				url:"/env/html5_configurator/loadArt.php" ,
				method: "POST",
				data: {path: path},
				dataType: "html",
			});

			server.done(function(data){
					//alert(data);
					$("div.clipart-box .clipArt").off(appendMyImage());
					$("div.clipart-box .clipArt").empty();
					$("div.clipart-box .clipArt").html(data);
					$("div.clipart-box .clipArt").on(appendMyImage());
			});

			server.fail(function(data){
				alert('Something went wrong with the application, please try again later');
			});
		});
			
			
}


function loadBarTypes(){
		var bar = $("img#bar-milk").attr("src");
		console.log("loaded bar image: " + bar);
		$("img#bar-milk").ready(function(){
		var h = document.getElementById("bar-milk").naturalHeight;
		var w = document.getElementById("bar-milk").naturalWidth;
		//$("#content.design-bar .jumbotron .overlay").css({"background-image": "url('" + bar + "')", "height" : h, "width": w});
		// $("#content.design-bar .jumbotron .overlay").addCSS("height", h);
		// $("#content.design-bar .jumbotron .overlay").addCSS("width", w);
		// alert(h); alert(w);
		});
		
		
		 $("#content.design-bar .ajax-upload input[name='baseimg'], #content.design-bar .ajax-upload input[name='baseimg']").val(bar);
			$("#content.design-bar .choose-type-bar form input[name='bar_type']").click(function(){
					var value = $(this).val();
					//alert(value);
					switch(value){
							
							case "1":
							bar = $("img#bar-milk").attr("src");
							h = document.getElementById("bar-milk").naturalHeight;
							w = document.getElementById("bar-milk").naturalWidth;
							$("#content.design-wrapper .ajax-upload input[name='baseimg'], #content.design-bar .ajax-upload input[name='baseimg']").val(bar);
							$("#content.design-bar .jumbotron .overlay").css({"background-image": "url('" + bar + "')", "height" : h, "width": w});
							console.log(" height :" + h + " weight: " + w);
							// $("#content.design-bar .jumbotron .overlay").addCSS("height", h);
							// $("#content.design-bar .jumbotron .overlay").addCSS("width", w);
							break;

							case "2":
							bar = $("img#bar-dark").attr("src");
							h = document.getElementById("bar-dark").naturalHeight;
							w = document.getElementById("bar-dark").naturalWidth;
							$("#content.design-wrapper .ajax-upload input[name='baseimg'], #content.design-bar .ajax-upload input[name='baseimg']").val(bar);
							$("#content.design-bar .jumbotron .overlay").css({"background-image": "url('" + bar + "')", "height" : h, "width": w});
							console.log(" height :" + h + " weight: " + w);
							// $("#content.design-bar .jumbotron .overlay").addCSS("height", h);
							// $("#content.design-bar .jumbotron .overlay").addCSS("width", w);
							break;

							case "3":
							bar = $("img#bar-both").attr("src");
							h = document.getElementById("bar-both").naturalHeight;
							w = document.getElementById("bar-both").naturalWidth;
							$("#content.design-wrapper .ajax-upload input[name='baseimg'], #content.design-bar .ajax-upload input[name='baseimg']").val(bar);
							$("#content.design-bar .jumbotron .overlay").css({"background-image": "url('" + bar + "')", "height" : h, "width": w});
							console.log(" height :" + h + " weight: " + w);
							// $("#content.design-bar .jumbotron .overlay").addCSS("height", h);
							// $("#content.design-bar .jumbotron .overlay").addCSS("width", w);
							break;
					}
			});
}


function adjustWrapper(){
	$(document).ready(function(){
			var wrapper = $("#content.design-wrapper .select-art-box.bg ul li a img:first-child").attr("src");
			$("#content.design-wrapper .jumbotron .wrapper-background").css("background-image", "url(" + wrapper + ")");
			$("#content.design-wrapper .ajax-upload img#wrapperimg").attr("src", wrapper);		

	});
		


	$("#wrapperimg").load(function(){
			var w = document.getElementById("wrapperimg").naturalWidth;
			var h = document.getElementById("wrapperimg").naturalHeight;
			$("#content.design-wrapper .jumbotron .wrapper-background").css("width", w);
			$("#content.design-wrapper .jumbotron .wrapper-background").css("height", h);

			// alert("width" + w); alert("height" + h);
			});

		$("#content.design-wrapper .select-art-box.bg ul li a").click(function(){
					var img = $(this).find("img").attr("src");
					$("#content.design-wrapper .ajax-upload img#wrapperimg").attr("src", img);		
					var w = document.getElementById("wrapperimg").naturalWidth;
					var h = document.getElementById("wrapperimg").naturalHeight;
					$("#content.design-wrapper .jumbotron .wrapper-background").css("width", w);
					$("#content.design-wrapper .jumbotron .wrapper-background").css("height", h);
		});
}

function storeBarValues(){

		$(document).mouseup(function(){
		var line_1 = $("#content.design-bar form[name='add_text_to_bar'] input[name='line_1']").val();
		var line_2 = $("#content.design-bar form[name='add_text_to_bar']  input[name='line_2']").val();
		var line_3 = $("#content.design-bar form[name='add_text_to_bar']  input[name='line_3']").val();
		var line_4 = $("#content.design-bar form[name='add_text_to_bar']  input[name='line_4']").val();
		
			// alert("bar pfffttttt");
			var line_one_x = $("#content.design-bar .design-bar-custom div.overlay ul li.first-line").css("left");
			temp = line_one_x.split("px");
			// console.log(temp[0]);
			// console.log(temp[1]);
			line_one_x = parseInt(temp[0]);
			$("#content.design-bar .add-text-box form[name='add_text_to_bar']   input[name='line_one_x']").val(line_one_x);
			$("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   input[name='line_one_x']").val(line_one_x);
			localStorage["bar_line_one_x"] = line_one_x;
	
	
			var line_two_x = $("#content.design-bar .design-bar-custom div.overlay ul li.second-line").css("left");
			temp = line_two_x.split("px");
			line_two_x = parseInt(temp[0]);		
			$("#content.design-bar .add-text-box form[name='add_text_to_bar']   input[name='line_two_x']").val(line_two_x);
			$("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   input[name='line_two_x']").val(line_two_x);
			localStorage["bar_line_two_x"] = line_two_x;


			var line_three_x = $("#content.design-bar .design-bar-custom div.overlay ul li.third-line").css("left");
			temp = line_three_x.split("px");
			line_three_x = parseInt(temp[0]);
			$("#content.design-bar .add-text-box form[name='add_text_to_bar']   input[name='line_three_x']").val(line_three_x);
			$("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   input[name='line_three_x']").val(line_three_x);
			localStorage["bar_line_three_x"] = line_three_x;

			var line_four_x = $("#content.design-bar .design-bar-custom div.overlay ul li.fourth-line").css("left");
			temp = line_four_x.split("px");
			line_four_x = parseInt(temp[0]);
			$("#content.design-bar .add-text-box form[name='add_text_to_bar']   input[name='line_four_x']").val(line_four_x);
			$("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   input[name='line_four_x']").val(line_four_x);
			localStorage["bar_line_four_x"] = line_four_x;


		var hquan_1 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hquan_1']").val();
		var hquan_2 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hquan_2']").val();
		var hquan_3 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hquan_3']").val();
		var hquan_4 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hquan_4']").val();
		var hfont_1 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hfont_1']").val();
		var hfont_2 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hfont_2']").val();
		var hfont_3 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hfont_3']").val();
		var hfont_4 = $("#content.design-bar form[name='add_text_to_bar'] input[name='hfont_4']").val();
		var bar_type = $("#content.design-bar .choose-type-bar form input[name='bar_type']").val();
		var layer_top = $("#content.design-bar .ajax-upload input[name='layer_top']").val();
		var base =   $("#content.design-bar .ajax-upload input[name='baseimg']").val();
		var imgposx = parseInt($("#content.design-bar .ajax-upload input[name='imgposx']").val());
		var imgposy = parseInt($("#content.design-bar .ajax-upload input[name='imgposy']").val());
		var uploaded = parseInt($("#content.design-bar div.overlay img#overlay-image").attr("data-upload"));
		//console.log($("#content.design-bar div.overlay img#overlay-image").attr("data-upload"));

			
			localStorage["bar_line_one"] =  line_1; 
			localStorage["bar_line_two"] = line_2;
			localStorage["bar_line_three"] = line_3;
			localStorage["bar_line_four"] = line_4;
			localStorage["bar_layer_top"] = layer_top;
			localStorage["bar_base"] = base;
			localStorage["bar_bar_type"] = bar_type;
			localStorage["bar_hquan_1"] =  parseInt(hquan_1);
			localStorage["bar_hquan_2"] =  parseInt(hquan_2);
			localStorage["bar_hquan_3"] =  parseInt(hquan_3);
			localStorage["bar_hquan_4"] =  parseInt(hquan_4);
			localStorage["bar_hfont_1"] =  hfont_1;
			localStorage["bar_hfont_2"] =  hfont_2;
			localStorage["bar_hfont_3"] =  hfont_3;
			localStorage["bar_hfont_4"] =  hfont_4;
			localStorage["bar_imgposx"] =  imgposx;
			localStorage["bar_imgposy"] =  imgposy;
			localStorage["bar_uploaded"] = uploaded;

		});
					
}

function storeWrapperValues(){

		$(document).mouseup(function(){
		var line_1 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='line_1']").val();
		var line_2 = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_2']").val();
		var line_3 = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_3']").val();
		var line_4 = $("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_4']").val();
		

			 // alert($("#content.design-wrapper .ajax-upload input[name='layer_top']").val());
			var line_one_x = $("#content.design-wrapper .design-bar-custom div.overlay ul li.first-line").css("left");
			temp = line_one_x.split("px");
			// console.log(temp[0]);
			// console.log(temp[1]);
			line_one_x = parseInt(temp[0]);
			// $("#content.design-bar .add-text-box form[name='add_text_to_bar']   input[name='line_one_x']").val(line_one_x);
			$("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   input[name='line_one_x']").val(line_one_x);
			localStorage["wrapper_line_one_x"] = line_one_x;
	
	
			var line_two_x = $("#content.design-wrapper .design-bar-custom div.overlay ul li.second-line").css("left");
			temp = line_two_x.split("px");
			line_two_x = parseInt(temp[0]);		
			// $("#content.design-bar .add-text-box form[name='add_text_to_bar']   input[name='line_two_x']").val(line_two_x);
			$("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   input[name='line_two_x']").val(line_two_x);
			localStorage["wrapper_line_two_x"] = line_two_x;


			var line_three_x = $("#content.design-wrapper .design-bar-custom div.overlay ul li.third-line").css("left");
			temp = line_three_x.split("px");
			line_three_x = parseInt(temp[0]);
			// $("#content.design-bar .add-text-box form[name='add_text_to_bar']   input[name='line_three_x']").val(line_three_x);
			$("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   input[name='line_three_x']").val(line_three_x);
			localStorage["wrapper_line_three_x"] = line_three_x;

			var line_four_x = $("#content.design-wrapper .design-bar-custom div.overlay ul li.fourth-line").css("left");
			temp = line_four_x.split("px");
			line_four_x = parseInt(temp[0]);
			// $("#content.design-bar .add-text-box form[name='add_text_to_bar']   input[name='line_four_x']").val(line_four_x);
			$("#content.design-wrapper .add-text-box form[name='add_text_to_bar']   input[name='line_four_x']").val(line_four_x);
			localStorage["wrapper_line_four_x"] = line_four_x;


		var hquan_1 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='hquan_1']").val();
		var hquan_2 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='hquan_2']").val();
		var hquan_3 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='hquan_3']").val();
		var hquan_4 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='hquan_4']").val();
		var hfont_1 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='hfont_1']").val();
		var hfont_2 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='hfont_2']").val();
		var hfont_3 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='hfont_3']").val();
		var hfont_4 = $("#content.design-wrapper form[name='add_text_to_bar'] input[name='hfont_4']").val();
		var bar_type = $("#content.design-wrapper .choose-type-bar form input[name='bar_type']").val();
		var layer_top = $("#content.design-wrapper .ajax-upload input[name='layer_top']").val();
		var base =   $("#content.design-wrapper .ajax-upload input[name='baseimg']").val();
		var imgposx = parseInt($("#content.design-wrapper .ajax-upload input[name='imgposx']").val());
		var imgposy = parseInt($("#content.design-wrapper .ajax-upload input[name='imgposy']").val());
		var uploaded = parseInt($("#content.design-wrapper div.overlay img#overlay-image").attr("data-upload"));
		// var wrapper = "/var/www/mch" + $("#content.design-wrapper .ajax-upload input[name='wrapper']").val();
			
	

			localStorage["wrapper_line_one"] =  line_1; 
			localStorage["wrapper_line_two"] = line_2;
			localStorage["wrapper_line_three"] = line_3;
			localStorage["wrapper_line_four"] = line_4;
			localStorage["wrapper_layer_top"] = layer_top;
			localStorage["wrapper_base"] = base;
			localStorage["wrapper_bar_type"] = bar_type;
			localStorage["wrapper_hquan_1"] =  parseInt(hquan_1);
			localStorage["wrapper_hquan_2"] =  parseInt(hquan_2);
			localStorage["wrapper_hquan_3"] =  parseInt(hquan_3);
			localStorage["wrapper_hquan_4"] =  parseInt(hquan_4);
			localStorage["wrapper_hfont_1"] =  hfont_1;
			localStorage["wrapper_hfont_2"] =  hfont_2;
			localStorage["wrapper_hfont_3"] =  hfont_3;
			localStorage["wrapper_hfont_4"] =  hfont_4;
			localStorage["wrapper_imgposx"] =  imgposx;
			localStorage["wrapper_imgposy"] =  imgposy;
			localStorage["wrapper_uploaded"] = uploaded;
			// localStorage["wrapper_wrap"] = wrapper;

		});
					
}

function supports_html5_storage() {
  try {
    return 'localStorage' in window && window['localStorage'] !== null;
  } catch (e) {
    return false;
  }
}

	function loadSavedValues_Bar(){
				if(supports_html5_storage()){
					console.log(parseInt(localStorage["bar_uploaded"]));
						var lineone = localStorage["bar_line_one"];
						var linetwo = localStorage["bar_line_two"];
						var linethree = localStorage["bar_line_three"];
						var linefour = localStorage["bar_line_four"];
						var hquan_1 = parseInt(localStorage["bar_hquan_1"]);
						var hquan_2 = parseInt(localStorage["bar_hquan_2"]);
						var hquan_3 = parseInt(localStorage["bar_hquan_3"]);
						var hquan_4 = parseInt(localStorage["bar_hquan_4"]);
						var hfont_1 = localStorage["bar_hfont_1"];
						var hfont_2 = localStorage["bar_hfont_2"];
						var hfont_3 = localStorage["bar_hfont_3"];
						var hfont_4 = localStorage["bar_hfont_4"];
						var line_one_x = parseInt(localStorage["bar_line_one_x"]);
						var line_two_x = parseInt(localStorage["bar_line_two_X"]);
						var line_three_x = parseInt(localStorage["bar_line_three_x"]);
						var line_four_x = parseInt(localStorage["bar_line_four_x"]);
						var layer_top = localStorage["bar_layer_top"];
						var base = localStorage["bar_base"];
						var bar_type = localStorage["bar_bar_type"];
						var imgposx = parseInt(localStorage["bar_imgposx"]);
						var imgposy = parseInt(localStorage["bar_imgposy"]);


						$("#content.design-bar form[name='add_text_to_bar']  input[name='line_1']").val(lineone);
						$("#content.design-bar form[name='add_text_to_bar']  input[name='line_2']").val(linetwo);
						$("#content.design-bar form[name='add_text_to_bar']  input[name='line_3']").val(linethree);
						$("#content.design-bar form[name='add_text_to_bar']  input[name='line_4']").val(linefour);
						$("#content.design-bar .ajax-upload input[name='layer_top']").val(layer_top);
						$("#content.design-bar .design-bar-custom div.overlay").ready(function(){
						$("#content.design-bar .design-bar-custom div.overlay ul li.first-line").html(lineone).attr("style", "font-size: " + hquan_1 + "px; font-family: '" + hfont_1 + "'; color: undefined; left: " + line_one_x + "px;");
						$("#content.design-bar .design-bar-custom div.overlay ul li.second-line").html(linetwo).attr("style", "font-size: " + hquan_2 + "px; font-family: '" + hfont_2 + "'; color: undefined left: " + line_two_x + "px;");
						$("#content.design-bar .design-bar-custom div.overlay ul li.third-line").html(linethree).attr("style", "font-size: " + hquan_3 + "px; font-family: '" + hfont_3 + "'; color: undefined left: " + line_three_x + "px;");
						$("#content.design-bar .design-bar-custom div.overlay ul li.fourth-line").html(linefour).attr("style", "font-size: " + hquan_4 + "px; font-family: '" + hfont_4 + "'; color: undefined left: " + line_four_x + "px;");
				if(parseInt(localStorage["bar_uploaded"]) !== 1){		
					var img = localStorage["bar_clipart"];
					console.log(img);
					var server = $.ajax({
					url: "/env/html5_configurator/convert.php",
					type: "POST",
					data: {image:img}
				});
				server.done(function(data){
				$("div.overlay img").attr("src", data).css("opacity", ".4");
				//$("div.overlay img#overlay-image").replaceWith(data);
				$("div.overlay img#original-image").attr("src", "/" + layer_top).attr("style", "display: none;");
				});

				server.fail(function(jqXHR, textStatus){
				$("div.overlay img").attr("src", "/env/html5_configurator/iconmonstr-warning-icon-48.png");
				});
						
				$("#content.design-bar .design-bar-custom div.overlay img").attr("style", "left: " +  imgposx +"px;" + "top: " + imgposy + "px; visibility: visible;");
} else if(parseInt(localStorage["bar_uploaded"]) === 1) {
	
						// var img = layer_top;
					// console.log(img);
				// 	var server = $.ajax({
				// 	url: "/env/html5_configurator/convert_uploaded.php",
				// 	type: "POST",
				// 	data: {image:img}
				// });
				// server.done(function(data){
				
				//$("div.overlay img#overlay-image").replaceWith(data);
				
				$("div.overlay img").attr("src",  layer_top);
				$("#content.design-bar .design-bar-custom div.overlay img").attr("style", "left: " +  imgposx +"px;" + "top: " + imgposy + "px; visibility: visible; opacity: .4;");
				$("div.overlay img#original-image").attr("src",  layer_top).attr("style", "display: none;");
				// });

				// server.fail(function(jqXHR, textStatus){
				// $("div.overlay img").attr("src", "/env/html5_configurator/iconmonstr-warning-icon-48.png");
				// });
						
				

						}
					});
				}
					
			}

function loadSavedValues_Wrapper(){
				if(supports_html5_storage()){
					console.log(localStorage["wrapper_layer_top"]);
						var lineone = localStorage["wrapper_line_one"];
						var linetwo = localStorage["wrapper_line_two"];
						var linethree = localStorage["wrapper_line_three"];
						var linefour = localStorage["wrapper_line_four"];
						var hquan_1 = parseInt(localStorage["wrapper_hquan_1"]);
						var hquan_2 = parseInt(localStorage["wrapper_hquan_2"]);
						var hquan_3 = parseInt(localStorage["wrapper_hquan_3"]);
						var hquan_4 = parseInt(localStorage["wrapper_hquan_4"]);
						var hfont_1 = localStorage["wrapper_hfont_1"];
						var hfont_2 = localStorage["wrapper_hfont_2"];
						var hfont_3 = localStorage["wrapper_hfont_3"];
						var hfont_4 = localStorage["wrapper_hfont_4"];
						var line_one_x = parseInt(localStorage["wrapper_line_one_x"]);
						var line_two_x = parseInt(localStorage["wrapper_line_two_X"]);
						var line_three_x = parseInt(localStorage["wrapper_line_three_x"]);
						var line_four_x = parseInt(localStorage["wrapper_line_four_x"]);
						var layer_top = localStorage["wrapper_layer_top"];
						var base = localStorage["wrapper_base"];
						var bar_type = localStorage["wrapper_bar_type"];
						var imgposx = parseInt(localStorage["wrapper_imgposx"]);
						var imgposy = parseInt(localStorage["wrapper_imgposy"]);
						var wrapper = localStorage["wrapper_wrap"];
						var temp = wrapper.split("/var/www/mch");
						if(temp.length > 1){
						wrapper = temp[1];
					} else {
						wrapper = temp[0];
					}
						console.log("wrapper uri: " + wrapper);

						$("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_1']").val(lineone);
						$("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_2']").val(linetwo);
						$("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_3']").val(linethree);
						$("#content.design-wrapper form[name='add_text_to_bar']  input[name='line_4']").val(linefour);
						$("#content.design-wrapper .ajax-upload input[name='layer_top']").val(layer_top);
						$("#content.design-wrapper .design-bar-custom div.overlay").ready(function(){
						$("#content.design-wrapper .design-bar-custom div.overlay ul li.first-line").html(lineone).attr("style", "font-size: " + hquan_1 + "px; font-family: '" + hfont_1 + "'; color: undefined; left: " + line_one_x + "px;");
						$("#content.design-wrapper .design-bar-custom div.overlay ul li.second-line").html(linetwo).attr("style", "font-size: " + hquan_2 + "px; font-family: '" + hfont_2 + "'; color: undefined left: " + line_two_x + "px;");
						$("#content.design-wrapper .design-bar-custom div.overlay ul li.third-line").html(linethree).attr("style", "font-size: " + hquan_3 + "px; font-family: '" + hfont_3 + "'; color: undefined left: " + line_three_x + "px;");
						$("#content.design-wrapper .design-bar-custom div.overlay ul li.fourth-line").html(linefour).attr("style", "font-size: " + hquan_4 + "px; font-family: '" + hfont_4 + "'; color: undefined left: " + line_four_x + "px;");
						$("content.design-wrapper .design-bar-custom div.overlay").css("background-image");
						$("div.wrapper-background").css("background-image", "url('" + wrapper + "')");
						$("#content.design-wrapper .ajax-upload input[name='wrapper']").val(wrapper);
			

				$("div.overlay img").attr("src", "/" + layer_top);
				//$("div.overlay img#overlay-image").replaceWith(data);
				$("div.overlay img#original-image").attr("src",  "/" + layer_top).attr("style", "display: none;");
						
				$("#content.design-wrapper .design-bar-custom div.overlay img").attr("style", "left: " +  imgposx +"px;" + "top: " + imgposy + "px; visibility: visible;");

					});
				}
					
			}


// $(document).ready(function(){
// if(window.location.pathname.match('\/products\/build\/[a-zA-Z]*')){
// 		setTimeout(loadSavedValues_Bar, 1000);
// }else if(window.location.pathname.match('\/products\/wrapper\/[a-zA-Z]*')){
// 			// setTimeout(loadSavedValues_Bar, 3000);
// }
// 	});

// function replaceFBImage(){

// $("a.pluginShareButtonLink").ready(function(){
// 	$("a.pluginShareButtonLink img.img").attr("src", "/env/images/mcb/facebook-color.png");
// 	});
// }

// Credits to Tim Down:
// http://stackoverflow.com/questions/5623838/rgb-to-hex-and-hex-to-rgb
function hexToRgb(hex) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}






// Credits to 
// http://stackoverflow.com/questions/1077041/refresh-image-with-a-new-one-at-the-same-url
function refreshUri(uri, callback, q) {
	alert("refreshUri in use");
    var reload = function () {
        // Force a reload of the iframe
        this.contentWindow.location.reload(true);

        // Remove `load` event listener and remove iframe
        this.removeEventListener('load', reload, false);
        this.parentElement.removeChild(this);

        // Run the callback if it is provided
        if (typeof callback === 'function') {
            callback();
        }
    };

    var iframe = document.createElement('iframe');
    iframe.style.display = 'block';

    // Reload iframe once it has loaded
    iframe.addEventListener('load', reload, false);

    // Only call callback if error occured while loading
    //iframe.addEventListener('error', callback, false);
    iframe.src = uri + q;
    $("body").append(iframe);
}

function replaceImage(id, q) {
	alert("callback");
    return function(){
        var oldImage = document.getElementById(id);
        var newImage = new Image();
        newImage.src = oldImage.src;
        newImage.id = oldImage.id;
        newImage.class = oldImage.class;
        newImage.width = oldImage.width;
        newImage.height = oldImage.height;
        oldImage.parentNode.replaceChild(newImage,oldImage);
    }
}


 // $(function() {
 //    $(".rslides").responsiveSlides({
 //    	auto: true,
 //    	nav: false,
 //    	speed: 2000,
 //    	pause: true
 //    	 });
 //  });






function money_format(price)
{
	return '$ '+(Math.round(price*100)/100).toFixed( 2 );
}

function isNumberKey(evt)
{
   var charCode = (evt.which) ? evt.which : event.keyCode
   return charCode <= 57 && charCode != 32;
}

function moreLessPicker(amount, input)
{
	var value = parseInt(input.val());
	if (value<1)
		return;
	input.val(value + amount);
	if (input.val() == 0)
		input.val(1);
	
	recalculateAmounts();
}

function recalculateTotalCoinsAmount()
{
	//coins_total_amount = $('#bagsAmount').val();
}

function recalculateAmounts()
{
	recalculateTotalCoinsAmount();
	var prices = 100;
	var bagsAmount = $('#bagsAmount').val();
	var bagsUnitPrice = getUnitPriceForAmount(bagsAmount,prices);
	var bagsTotal = bagsAmount * bagsUnitPrice;

	//$('#bagsTotal').html(parseInt(money_format(bagsTotal)));
}

function getUnitPriceForAmount(amount, prices)
{
	prices = eval(prices);
	var minStart = false;
	for (var i=0; i<prices.length; i++) {
		var price = prices[i];
		if (amount >= price.start && 
			(amount <= price.end || price.end == 0)) {
			return parseFloat(price.price);
		}
		if (price.start < minStart.start || minStart == false)
			minStart = price;
	}
	return parseFloat(minStart.price);
}

function check_amount() {
    var amount = $('#bagsAmount').val();
    if(amount < 200) {
        $('#popupInfo').css('display', 'block');
        return false;
    }
    else
        return true;
}

function hideErrorBlock() {
    $('#popupInfo').css('display', 'none');
}

var coins_total_amount = 0;

$('#bagsForm a.less').click(function(){
	moreLessPicker(-1,$('#bagsAmount'));
	return false;
});
$('#bagsForm a.more').click(function(){
	moreLessPicker( 1,$('#bagsAmount'));
	return false;
	});