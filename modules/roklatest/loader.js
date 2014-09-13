
//include function
function include(url) {
  document.write('<script src="', url, '" type="text/JavaScript"><\/script>');
}

function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      if (oldonload) {
        oldonload();
      }
      func();
    }
  }
}

function addCSStoHead() {
	if (!document.getElementById('someuniqueid'))
	{
	  var objHead = document.getElementsByTagName('head');
	  if (objHead[0])
	  {
	    var objCSS = objHead[0].appendChild(document.createElement('link'));
	    objCSS.id = 'someuniqueid';
	    objCSS.rel = 'stylesheet';
	    objCSS.href = 'modules/roklatest/roklatest.css';
	    objCSS.type = 'text/css';
	  }
	}
}

//load js libs if not already loaded
if (typeof(slide) == 'undefined') {
  include('modules/roklatest/prototype.lite.js');
  include('modules/roklatest/moo.fx.js');
  include('modules/roklatest/moo.fx.pack.js');
  include('modules/roklatest/moo.fx.slide.js');  
}

//addLoadEvent(addCSStoHead);
