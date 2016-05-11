//This is a custom brush that will use the working layer.
LayerBrush.prototype = new jqScribbleBrush;
function LayerBrush()
{
	LayerBrush.prototype.clearLayer = function()
	{
		this.context.globalAlpha = 0;
		this.context.clearRect(0,0,this.context.canvas.width,this.context.canvas.height);
		this.context.fillStyle = "#FFFFFF";
		this.context.fillRect(0,0,this.context.canvas.width,this.context.canvas.height);
		this.context.globalAlpha = 1;
	};

	LayerBrush.prototype.strokeEnd = function()
	{
		if (this.active && this.drawn) {
			if (this.context_undo != null) {
				this.context_undo.globalCompositeOperation = "source-over";
				this.context_undo.drawImage(this.context_base.canvas,0,0);
			}

			this.context_base.globalCompositeOperation = "source-over";
			this.context_base.drawImage(this.context.canvas,0,0);

			this.clearLayer();
		}

		return jqScribbleBrush.prototype.strokeEnd.call(this);
	};
};

//This is a custom brush that will hand free.
HandBrush.prototype = new LayerBrush;
function HandBrush()
{
	HandBrush.prototype.strokeBegin = function(x, y)
	{
		//For custom brushes make sure to call the parent brush methods
		LayerBrush.prototype.strokeBegin.call(this, x, y);

		this.prevX = x;
		this.prevY = y;
	};

	HandBrush.prototype.strokeMove = function(x, y)
	{
		//For custom brushes make sure to call the parent brush methods
		LayerBrush.prototype.strokeMove.call(this, x, y);

		this.context.moveTo(this.prevX, this.prevY);
		this.context.lineTo(x, y);

		this.context.strokeStyle = this.brushColor;
		this.context.stroke();

		this.prevX = x;
		this.prevY = y;
	};
};

//This is a custom brush that will draw a stroked (empty) figure.
StrokedFigureBrush.prototype = new LayerBrush;
function StrokedFigureBrush()
{
	StrokedFigureBrush.prototype.strokeBegin = function(x, y)
	{
		LayerBrush.prototype.strokeBegin.call(this, x, y);
		this.context.closePath();

		this.initialX = x;
		this.initialY = y;
	};

	StrokedFigureBrush.prototype.strokeDraw = function(x, y)
	{
	};

	StrokedFigureBrush.prototype.strokeMove = function(x, y)
	{
		LayerBrush.prototype.strokeMove.call(this, x, y);

		this.finalX = x;
		this.finalY = y;

		this.clearLayer();

		this.context.beginPath();
		this.context.lineWidth = this.brushSize;
		this.context.strokeStyle = this.brushColor;
		if (this.brushFillColor != false) this.context.fillStyle = this.brushFillColor;

		this.strokeDraw();
	};

	StrokedFigureBrush.prototype.strokeEnd = function()
	{
		if (this.active && this.drawn) {
			this.strokeDraw();
		}

		return LayerBrush.prototype.strokeEnd.call(this);
	};
};

//This is a custom brush that will draw a line.
LineBrush.prototype = new StrokedFigureBrush;
function LineBrush()
{
	LineBrush.prototype.strokeBegin = function(x, y)
	{
		StrokedFigureBrush.prototype.strokeBegin.call(this, x, y);
	};

	LineBrush.prototype.strokeDraw = function()
	{
		StrokedFigureBrush.prototype.strokeDraw.call(this);

		this.context.moveTo(this.initialX-this.brushSize, this.initialY-this.brushSize);
		this.context.lineTo(this.finalX+this.brushSize, this.finalY+this.brushSize);

		this.context.stroke();
	};

	LineBrush.prototype.strokeMove = function(x, y)
	{
		StrokedFigureBrush.prototype.strokeMove.call(this, x, y);
	};

	LineBrush.prototype.strokeEnd = function()
	{
		return StrokedFigureBrush.prototype.strokeEnd.call(this);
	};
};

//This is a custom brush that will draw a rectangle.
RectBrush.prototype = new StrokedFigureBrush;
function RectBrush()
{
	RectBrush.prototype.strokeBegin = function(x, y)
	{
		StrokedFigureBrush.prototype.strokeBegin.call(this, x, y);
	};

	RectBrush.prototype.strokeDraw = function()
	{
		StrokedFigureBrush.prototype.strokeDraw.call(this);

		this.context.moveTo(this.initialX-this.brushSize, this.initialY-this.brushSize);
		this.context.rect(this.initialX-this.brushSize, this.initialY-this.brushSize, this.finalX-this.initialX+this.brushSize, this.finalY-this.initialY+this.brushSize);

		this.context.stroke();
	};

	RectBrush.prototype.strokeMove = function(x, y)
	{
		StrokedFigureBrush.prototype.strokeMove.call(this, x, y);
	};

	RectBrush.prototype.strokeEnd = function()
	{
		return StrokedFigureBrush.prototype.strokeEnd.call(this);
	};
};
//This is a custom brush that will draw a filled rectangle.
FilledRectBrush.prototype = new RectBrush;
function FilledRectBrush()
{
	FilledRectBrush.prototype.strokeDraw = function()
	{
		if (this.brushFillColor != false) {
			this.context.moveTo(this.initialX-this.brushSize, this.initialY-this.brushSize);
			this.context.rect(this.initialX-this.brushSize, this.initialY-this.brushSize, this.finalX-this.initialX+this.brushSize, this.finalY-this.initialY+this.brushSize);

			this.context.fill();
		}

		RectBrush.prototype.strokeDraw.call(this);
	};

};

//This is a custom brush that will draw a circle/ellipse.
EllipseBrush.prototype = new StrokedFigureBrush;
function EllipseBrush()
{
	EllipseBrush.prototype.strokeBegin = function(x, y)
	{
		StrokedFigureBrush.prototype.strokeBegin.call(this, x, y);
	};

	EllipseBrush.prototype.strokeDraw = function()
	{
		StrokedFigureBrush.prototype.strokeDraw.call(this);

		//bof, ça aurait du marcher mais ellipse n'est pas implemente sur tous les navigateurs
		//this.context.moveTo(this.initialX-this.brushSize, this.initialY-this.brushSize);
		//this.context.ellipse(this.initialX-this.brushSize, this.initialY-this.brushSize, this.finalX-this.initialX+this.brushSize, this.finalY-this.initialY+this.brushSize, 0, 0, Math.PI, true);
		this.context.moveTo(this.initialX+(this.finalX-this.initialX)/2-this.brushSize, this.finalY-this.brushSize); // A1
		this.context.bezierCurveTo(
				this.finalX+this.brushSize, this.finalY-this.brushSize, // C1
				this.finalX+this.brushSize, this.initialY+this.brushSize, // C2
				this.initialX+(this.finalX-this.initialX)/2-this.brushSize, this.initialY+this.brushSize); // A2
		this.context.bezierCurveTo(
				this.initialX-this.brushSize, this.initialY+this.brushSize, // C3
				this.initialX-this.brushSize, this.finalY-this.brushSize, // C4
				this.initialX+(this.finalX-this.initialX)/2-this.brushSize, this.finalY-this.brushSize); // A1

		this.context.stroke();
	};

	EllipseBrush.prototype.strokeMove = function(x, y)
	{
		StrokedFigureBrush.prototype.strokeMove.call(this, x, y);
	};

	EllipseBrush.prototype.strokeEnd = function()
	{
		return StrokedFigureBrush.prototype.strokeEnd.call(this);
	};
};
//This is a custom brush that will draw a filled circle/ellipse.
FilledEllipseBrush.prototype = new EllipseBrush;
function FilledEllipseBrush()
{
	FilledEllipseBrush.prototype.strokeDraw = function()
	{
		if (this.brushFillColor != false) {
			//bof, ça aurait du marcher mais ellipse n'est pas implemente sur tous les navigateurs
			//this.context.moveTo(this.initialX-this.brushSize, this.initialY-this.brushSize);
			//this.context.ellipse(this.initialX-this.brushSize, this.initialY-this.brushSize, this.finalX-this.initialX+this.brushSize, this.finalY-this.initialY+this.brushSize, 0, 0, Math.PI, true);
			this.context.moveTo(this.initialX+(this.finalX-this.initialX)/2-this.brushSize, this.finalY-this.brushSize); // A1
			this.context.bezierCurveTo(
					this.finalX+this.brushSize, this.finalY-this.brushSize, // C1
					this.finalX+this.brushSize, this.initialY+this.brushSize, // C2
					this.initialX+(this.finalX-this.initialX)/2-this.brushSize, this.initialY+this.brushSize); // A2
			this.context.bezierCurveTo(
					this.initialX-this.brushSize, this.initialY+this.brushSize, // C3
					this.initialX-this.brushSize, this.finalY-this.brushSize, // C4
					this.initialX+(this.finalX-this.initialX)/2-this.brushSize, this.finalY-this.brushSize); // A1

			this.context.fill();
		}

		EllipseBrush.prototype.strokeDraw.call(this);
	};

};

//This is a custom brush that will erase a rectangle in the canvas .
EraserBrush.prototype = new StrokedFigureBrush;
function EraserBrush()
{
	EraserBrush.prototype.strokeDraw = function()
	{
	};

	EraserBrush.prototype.strokeMove = function(x, y)
	{
		StrokedFigureBrush.prototype.strokeMove.call(this, x, y);

		this.context.strokeStyle = "#000000";
		this.context.lineWidth = 1;
		this.context.moveTo(this.initialX, this.initialY);
		this.context.strokeRect(this.initialX, this.initialY, this.finalX-this.initialX, this.finalY-this.initialY);
	};

	EraserBrush.prototype.strokeEnd = function()
	{
		if (this.active && this.drawn) {
			this.clearLayer();
			this.context.fillStyle = "#FFFFFF";
			this.context.moveTo(this.initialX, this.initialY);
			this.context.fillRect(this.initialX, this.initialY, this.finalX-this.initialX, this.finalY-this.initialY);
		}

		StrokedFigureBrush.prototype.strokeEnd.call(this);
	};

};

//This is a custom brush that draw text.
TextBrush.prototype = new LayerBrush;
function TextBrush()
{
	TextBrush.prototype.strokeBegin = function(x, y)
	{
		//For custom brushes make sure to call the parent brush methods
		LayerBrush.prototype.strokeBegin.call(this, x, y);

		this.prevX = x;
		this.prevY = y;
	};

	TextBrush.prototype.strokeMove = function(x, y)
	{
		//For custom brushes make sure to call the parent brush methods
		LayerBrush.prototype.strokeMove.call(this, x, y);

		this.prevX = x;
		this.prevY = y;
	};

	TextBrush.prototype.strokeEnd = function()
	{
		//if (this.active && this.drawn) {
		if (this.active) {
			var text = $("#"+this.textId).val();
			this.context.font = ""+this.fontSize+"px arial";
			this.context.lineWidth = this.brushSize;
			this.context.strokeStyle = this.brushColor;
			this.context.strokeText(text, this.prevX, this.prevY);
			if (this.brushFillColor != false) {
				this.context.fillStyle = this.brushFillColor;
				this.context.fillText(text, this.prevX, this.prevY);
			}
			this.drawn = true;
		}

		LayerBrush.prototype.strokeEnd.call(this);
	};
};
