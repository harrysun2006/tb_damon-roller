function _dot(x, y, color)
{
	document.write("<img border='0' style='position: absolute; left: "+ x +"; top: "+ y +";background-color: "+color+"' src='px.gif' width=1 height=1>")
}

function _line(x1, y1, x2, y2, color)
{
	var tmp;
  if(x1 >= x2)
  {
	  tmp = x1;
	  x1 = x2;
	  x2 = tmp;
	  tmp = y1;
	  y1 = y2;
	  y2 = tmp;
  }
  for(var i = x1; i<= x2; i++)
  {
	  x = i;
	  y = (y2 - y1) / (x2 - x1) * (x - x1) + y1;
	  _dot(x, y, color);
  }
}

function _linetl2br(e, color)
{
	if(!e) return;
	if(typeof(e) == "string") e = document.getElementById(e);
	if(typeof(e) != "object") return;
	var x1 = _left(e);
	var y1 = _top(e);
	var x2 = x1 + _width(e);
	var y2 = y1 + _height(e);
	_line(x1, y1, x2, y2, color);
}

function _left(e)
{
	if(!e) return 0;
	var n = 0;
	while (e = e.offsetParent) {
	if (e.style.position == 'absolute' || e.style.position == 'relative' 
		|| (e.style.overflow != 'visible' && e.style.overflow != '' )) break;
		n += e.offsetLeft;
	}
	return n;
}

function _top(e)
{
	if(!e) return 0;
	var n = 0;
	while (e = e.offsetParent) {
	if (e.style.position == 'absolute' || e.style.position == 'relative' 
		|| (e.style.overflow != 'visible' && e.style.overflow != '' )) break;
		n += e.offsetTop;
	}
	return n;
}

function _width(e)
{
	if(!e) return 0;
	return e.offsetWidth;
}

function _height(e)
{
	if(!e) return 0;
	return e.offsetHeight;
}