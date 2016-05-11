function drawingInit(from_view, parent_module_name, field_name, initialImage)
{
	if (from_view == 'edit') {
		//Find Canvas
		var canvas = $("#"+field_name+"_canvas");
		$(canvas).jqScribble({layers: 2, backgroundImage: initialImage, brush: HandBrush,
			saveFunction: function(imageData) {
				$("#"+field_name).val(imageData);
			}});

		//Immediate actions
		$("#"+field_name+"_tool_clear").on("click", function() {
			ConfirmPopup(sugar_app_strings.LBL_DRAWING_CLEAR_CONFIRM,function(){
				$(canvas).jqScribble.clear();
				$($(canvas).jqScribble.canvas).trigger("mouseout");
				$("#"+field_name).val("");
				$("#"+field_name+"_delete").val("1"); //If field is empty, will cause the bitmap already saved to be deleted (case #4976)
			});
			return false;
		});
		$("#"+field_name+"_tool_reinit").on("click", function() {
			$(canvas).jqScribble.reinit(); //Image is loaded using asynchronous loading --> timeout reset needed
			setTimeout(function() {
				$($(canvas).jqScribble.canvas).trigger("mouseout");
			}, 1000);
			return false;
		});
		$("#"+field_name+"_tool_undo").on("click", function() {
			$(canvas).jqScribble.undo();
			$($(canvas).jqScribble.canvas).trigger("mouseout");
			return false;
		});

		//Toolbars definition
		$("#"+field_name+"_tool_eraser").on("click", function() {
			$(canvas).jqScribble.update({brush: EraserBrush});
			$("a.drawing_tool_brush").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_hand").on("click", function() {
			$(canvas).jqScribble.update({brush: HandBrush});
			$("a.drawing_tool_brush").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_line").on("click", function() {
			$(canvas).jqScribble.update({brush: LineBrush});
			$("a.drawing_tool_brush").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_rect").on("click", function() {
			$(canvas).jqScribble.update({brush: FilledRectBrush});
			$("a.drawing_tool_brush").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_ellipse").on("click", function() {
			$(canvas).jqScribble.update({brush: FilledEllipseBrush});
			$("a.drawing_tool_brush").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_text").on("click", function() {
			$(canvas).jqScribble.update({textId: field_name+"_tool_textinput", brush: TextBrush});
			$("a.drawing_tool_brush").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});

		//Fontsize
		$("#"+field_name+"_tool_fontsmall").on("click", function() {
			$(canvas).jqScribble.update({fontSize: 10});
			$("a.drawing_tool_font").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_fontmedium").on("click", function() {
			$(canvas).jqScribble.update({fontSize: 20});
			$("a.drawing_tool_font").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_fontlarge").on("click", function() {
			$(canvas).jqScribble.update({fontSize: 30});
			$("a.drawing_tool_font").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});

		//Line weight
		$("#"+field_name+"_tool_width1").on("click", function() {
			$(canvas).jqScribble.update({brushSize: 1});
			$("a.drawing_tool_width").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_width3").on("click", function() {
			$(canvas).jqScribble.update({brushSize: 3});
			$("a.drawing_tool_width").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_width5").on("click", function() {
			$(canvas).jqScribble.update({brushSize: 5});
			$("a.drawing_tool_width").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_width10").on("click", function() {
			$(canvas).jqScribble.update({brushSize: 10});
			$("a.drawing_tool_width").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});

		//Line colors
		$("#"+field_name+"_tool_black").on("click", function() {
			$(canvas).jqScribble.update({brushColor: "rgb(0,0,0)"});
			$("a.drawing_tool_color").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_red").on("click", function() {
			$(canvas).jqScribble.update({brushColor: "rgb(255,0,0)"});
			$("a.drawing_tool_color").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_green").on("click", function() {
			$(canvas).jqScribble.update({brushColor: "rgb(0,255,0)"});
			$("a.drawing_tool_color").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_blue").on("click", function() {
			$(canvas).jqScribble.update({brushColor: "rgb(0,0,255)"});
			$("a.drawing_tool_color").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});

		//Fill Colors
		$("#"+field_name+"_tool_fillnone").on("click", function() {
			$(canvas).jqScribble.update({brushFillColor: false});
			$("a.drawing_tool_fillcolor").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_fillblack").on("click", function() {
			$(canvas).jqScribble.update({brushFillColor: "rgb(0,0,0)"});
			$("a.drawing_tool_fillcolor").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_fillred").on("click", function() {
			$(canvas).jqScribble.update({brushFillColor: "rgb(255,0,0)"});
			$("a.drawing_tool_fillcolor").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_fillgreen").on("click", function() {
			$(canvas).jqScribble.update({brushFillColor: "rgb(0,255,0)"});
			$("a.drawing_tool_fillcolor").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});
		$("#"+field_name+"_tool_fillblue").on("click", function() {
			$(canvas).jqScribble.update({brushFillColor: "rgb(0,0,255)"});
			$("a.drawing_tool_fillcolor").removeClass("drawing_tool_selected");
			$(this).addClass("drawing_tool_selected");
			return false;
		});

		//Save the picture in hidden field as the mouse exit the canvas
		$($(canvas).jqScribble.canvas).on("mouseout", function() {
			try{ 
				$(canvas).jqScribble.save(null);
			}
			catch(err){}
		});
		
		//$('#SAVE_HEADER').attr("onclick", "$(\"#"+field_name+"_canvas\").jqScribble.save(null);" + $('#SAVE_HEADER').attr("onclick"));
		//$('#SAVE_FOOTER').attr("onclick", $('#SAVE_HEADER').attr("onclick"));
	}
}
