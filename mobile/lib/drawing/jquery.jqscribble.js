/*
Copyright (C) 2011 by Jim Saunders

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
function jqScribbleBrush()
{
	jqScribbleBrush.prototype._init = function(context, context_base, context_undo, brushSize, brushColor, brushFillColor, textId, fontSize)
	{
		this.context = context;
		this.context_base = context_base;
		this.context_undo = context_undo;
		this.context.globalCompositeOperation = 'source-over';
		this.context_base.globalCompositeOperation = 'source-over';
		this.context_undo.globalCompositeOperation = 'source-over';
		this.brushSize = brushSize;
		this.brushColor = brushColor;
		this.brushFillColor = brushFillColor;
		this.textId = textId;
		this.fontSize = fontSize;
		this.drawn = false;
		this.active = false;
	};

	//For custom brushes override this method and perform
	//any action to prepare the brush for drawing.
	jqScribbleBrush.prototype.strokeBegin = function(x, y)
	{
		this.active = true;
		this.context.beginPath();
		this.context.lineWidth = this.brushSize;
	};

	//For custom brushes override this method and perform
	//any action that the brush does while drawing.
	jqScribbleBrush.prototype.strokeMove = function(x, y){this.drawn = this.active;};

	//For custom brushes override this method to perform
	//any action to reset the brush once drawing is complete
	jqScribbleBrush.prototype.strokeEnd = function()
	{
		this.active = false;
		if(this.drawn)
		{
			this.drawn = false;
			return true;
		}
		return false;
	};
}
//All brushes should inherit from the Brush interface
BasicBrush.prototype = new jqScribbleBrush;
function BasicBrush()
{
	BasicBrush.prototype.strokeBegin = function(x, y)
	{
		//For custom brushes make sure to call the parent brush methods
		jqScribbleBrush.prototype.strokeBegin.call(this, x, y);
		this.prevX = x;
		this.prevY = y;
	};

	BasicBrush.prototype.strokeMove = function(x, y)
	{
		//For custom brushes make sure to call the parent brush methods
		jqScribbleBrush.prototype.strokeMove.call(this, x, y);

		this.context.moveTo(this.prevX, this.prevY);
		this.context.lineTo(x, y);

		this.context.strokeStyle = this.brushColor;
		this.context.stroke();

		this.prevX = x;
		this.prevY = y;
	};
}

function BasicCanvasSave(imageData){window.open(imageData,'jqScribble Image');}

(function($)
{
	//These are the default settings if none are specified.
	var settings = {
		layers:				0, //CAPTIVEA
		width:				300,
		height: 			250,
		backgroundImage:	false,
		backgroundImageX: 	0,
		backgroundImageY: 	0,
		backgroundColor:	"#ffffff",
		saveMimeType: 		"image/png",
		saveFunction: 		BasicCanvasSave,
		brush:				BasicBrush,
		brushSize:			3,
		brushColor:			"rgb(0,0,0)",
		brushFillColor:		"rgb(0,0,0)",
		textId:				"", //html id of the text input tag
		fontSize:			20
	};

	var brush = null;

	function addImage(context)
	{
		var img = new Image();
		img.onload = function(){context.drawImage(img, settings.backgroundImageX, settings.backgroundImageY);}
		img.src = settings.backgroundImage;
	}

	$.fn.jqScribble = function(options)
	{
		//Check if the container is a canvas already. If it is
		//then we need the canvas DOM element otherwise we make
		//a new canvas element to use.
		this.jqScribble.blank = true;
		var noparent = this.is('canvas');
		if(noparent)this.jqScribble.canvas_base = this[0];
		else this.jqScribble.canvas_base = document.createElement("canvas");

		var context_base = this.jqScribble.canvas_base.getContext("2d");
		$.extend(settings, options);

		//The canvas will take the inner dimensions
		//of the element it will be attached to, or
		//the settings value if the dims aren't large
		//enough to make a valid drawing area.
		var width = this.innerWidth();
		var height = this.innerHeight();
		//if(noparent) //CAPTIVEA
		if(!noparent) //CAPTIVEA: the canvas will take the dimensions of the parent if it has been dynamically created
		{
			width = this.parent().width();
			height = this.parent().height();
		}
		if(width < 2)width = settings.width;
		if(height < 2)height = settings.height;

		this.jqScribble.canvas_base.width = width;
		this.jqScribble.canvas_base.height = height;

		this.jqScribble.clear();

		//If the container isn't already a canvas then append the canvas we created
		if(!noparent)this.append(this.jqScribble.canvas_base);

		//CAPTIVEA begin
		if (settings.layers > 0) {
			if (settings.layers > 1) {
				this.jqScribble.canvas_undo = $('<canvas id="'+this.jqScribble.canvas_base.id+'_undo" name="'+this.jqScribble.canvas_base.name+'_undo" class="drawing_canvas drawing_canvas_undo"></canvas>')[0];
				this.jqScribble.canvas_undo.width = this.jqScribble.canvas_base.width;
				this.jqScribble.canvas_undo.height = this.jqScribble.canvas_base.height;
				$(this.jqScribble.canvas_undo).css({
					'position': 'relative',
					'top': -6-this.jqScribble.canvas_base.height,
					'left': 0
					});
				$(this.jqScribble.canvas_base).after(this.jqScribble.canvas_undo);
				var context_undo = this.jqScribble.canvas_undo.getContext('2d');
				context_undo.globalCompositeOperation = 'source-over';
				context_undo.globalAlpha = 1;
				context_undo.clearRect(0,0,this.jqScribble.canvas_base.width,this.jqScribble.canvas_base.height);
				context_undo.fillStyle = "#FFFFFF";
				context_undo.fillRect(0,0,this.jqScribble.canvas_base.width,this.jqScribble.canvas_base.height);
			} else {
				var context_undo = null;
			}
			this.jqScribble.canvas = $('<canvas id="'+this.jqScribble.canvas_base.id+'_work" name="'+this.jqScribble.canvas_base.name+'_work" class="drawing_canvas"></canvas>')[0];
			//ci-dessous marche pas, ???
			/*$(this.jqScribble.canvas).css({
				'width': $(this.jqScribble.canvas).width(),
				'height': $(this.jqScribble.canvas).height(),
				'position': 'absolute',
				'top': $(this.jqScribble.canvas).offset().top+50,
				'left': $(this.jqScribble.canvas).offset().left
			});*/
			this.jqScribble.canvas.width = this.jqScribble.canvas_base.width;
			this.jqScribble.canvas.height = this.jqScribble.canvas_base.height;
			$(this.jqScribble.canvas).css({
				//'position': 'absolute',
				'position': 'relative',
				//'top': 0,//$(this.jqScribble.canvas_base).offset().top,
				'top': -6-this.jqScribble.canvas_base.height,//$(this.jqScribble.canvas_base).offset().top,
				'left': 0//$(this.jqScribble.canvas_base).offset().left
				});
			$(this.jqScribble.canvas_base).after(this.jqScribble.canvas);
			var context = this.jqScribble.canvas.getContext('2d');
			context.globalCompositeOperation = 'source-over';
			context.globalAlpha = 0;
			context.clearRect(0,0,this.jqScribble.canvas_base.width,this.jqScribble.canvas_base.height);
			context.fillStyle = "#FFFFFF";
			context.fillRect(0,0,this.jqScribble.canvas_base.width,this.jqScribble.canvas_base.height);
			context.globalAlpha = 1;
		} else {
			this.jqScribble.canvas_undo = null;
			var context_undo = null;
			this.jqScribble.canvas = this.jqScribble.canvas_base;
			var context = context_base;
		}
		//CAPTIVEA end

		if(settings.backgroundImage)
		{
			addImage(context_base);
			this.jqScribble.blank = false;
		}

		brush = new settings.brush();
		brush._init(context, context_base, context_undo, settings.brushSize, settings.brushColor, settings.brushFillColor, settings.textId, settings.fontSize);

		var self = this;

		if(brush.strokeBegin && brush.strokeMove && brush.strokeEnd)//CAPTIVEA
		{
			//Have to add touch events the old fashioned way since
			//jquery removes that stuff from the event object.
			this.jqScribble.canvas.addEventListener("touchstart", function(e)
			{
				var o = self.offset();
				e.preventDefault();
				if(e.touches.length > 0)brush.strokeBegin(e.touches[0].pageX-o.left, e.touches[0].pageY-o.top);
			}, false);
			this.jqScribble.canvas.addEventListener("touchmove",  function(e)
			{
				var o = self.offset();
				e.preventDefault();
				if(e.touches.length > 0 && brush.active)brush.strokeMove(e.touches[0].pageX-o.left, e.touches[0].pageY-o.top);
			}, false);
			this.jqScribble.canvas.addEventListener("touchend",   function(e)
			{
				e.preventDefault();
				if(e.touches.length == 0)self.jqScribble.blank = !brush.strokeEnd() && self.jqScribble.blank;
			}, false);

			$(this.jqScribble.canvas).bind("mousedown", function(e)
			{
				var o = self.offset();
				brush.strokeBegin(e.pageX-o.left, e.pageY-o.top);
			});
			$(this.jqScribble.canvas).bind("mousemove", function(e)
			{
				var o = self.offset();
				if(brush.active)brush.strokeMove(e.pageX-o.left, e.pageY-o.top);
			});
			$(this.jqScribble.canvas).bind("mouseup mouseout",  function(e){self.jqScribble.blank = !brush.strokeEnd() && self.jqScribble.blank;});
		}

	};

	$.fn.jqScribble.getSetting = function(setting)
	{
		if (setting == "saveMimeType")
			return settings.saveMimeType;
		return false;
	}

	$.fn.jqScribble.update = function(options, reset)
	{
		var newBg = !!options.backgroundColor;
		var newImg = !!options.backgroundImage;
		var newWidth = !!options.width;
		var newHeight = !!options.height;
		var newBrush = !!options.brush;
		$.extend(settings, options);

		var context_base = this.canvas_base.getContext("2d");
		if (this.canvas_undo != null)
			var context_undo = this.canvas_undo.getContext("2d");
		else
			var context_undo = null;
		var context = this.canvas.getContext("2d");

		if(newBrush)brush = new settings.brush();
		brush._init(context, context_base, context_undo, settings.brushSize, settings.brushColor, settings.brushFillColor, settings.textId, settings.fontSize);

		if(newWidth) {this.canvas_base.width = settings.width; this.canvas.width = settings.width; if (this.canvas_undo != null) this.canvas_undo.width = settings.width;}
		if(newHeight) {this.canvas_base.height = settings.height; this.canvas.height = settings.height; if (this.canvas_undo != null) this.canvas_undo.height = settings.height;}
		if(newBg || newImg || newWidth || newHeight || reset) this.clear();
		if(newImg)
		{
			addImage(context_base);
			this.blank = false;
		}

		return this;
	};

	$.fn.jqScribble.undo = function()
	{
		if (this.canvas_undo != null) {
			var context_undo = this.canvas_undo.getContext("2d");
			var context_base = this.canvas_base.getContext("2d");
			//context_base.globalCompositeOperation = 'source-over';
			context_base.drawImage(context_undo.canvas,0,0);
		}
		return this;
	};

	$.fn.jqScribble.reinit = function()
	{
		this.clear();
		var context_base = this.canvas_base.getContext("2d");
		addImage(context_base);
		this.blank = false;
		return this;
	};

	$.fn.jqScribble.clear = function()
	{
		var context_base = this.canvas_base.getContext("2d");
		context_base.clearRect(0, 0, this.canvas_base.width, this.canvas_base.height);
		context_base.fillStyle = settings.backgroundColor;
		context_base.fillRect(0, 0, this.canvas_base.width, this.canvas_base.height);
		this.blank = true;
		return this;
	};

	$.fn.jqScribble.save = function(newSave)
	{
		var saveFunction = settings.saveFunction;
		if(typeof newSave === 'function')saveFunction = newSave;

		if(!this.blank)saveFunction(this.canvas_base.toDataURL(settings.saveMimeType));
		return this;
	};

})(jQuery);