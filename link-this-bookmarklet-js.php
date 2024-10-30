(function() {
	
	var kMinImageSize = 30;
	var kOutlineColor = "#1030cc";
	var kOutlineSize = 3;
	var kShadowSize = 7;
	
	function div(opt_parent) {
		var e = document.createElement("div");
		e.style.padding = "0";
		e.style.margin = "0";
		e.style.border = "0";
		e.style.position = "relative";
		if (opt_parent) {
			opt_parent.appendChild(e);
		}
		return e;
	}
	
	function setOpacity(element, opacity) {
		if (navigator.userAgent.indexOf("MSIE") != -1) {
			var normalized = Math.round(opacity * 100);
			element.style.filter = "alpha(opacity=" + normalized + ")";
		} else {
			element.style.opacity = opacity;
		}
	}
	
	function scrollPos() {
		if (self.pageYOffset !== undefined) {
			return {
			x: self.pageXOffset,
			y: self.pageYOffset
			};
		} else {
			return {
			x: document.body.scrollLeft,
			y: document.body.scrollTop
			};	
		}
	}
	
	function checkForFrameMessage() {
		var prefix = "WPLINKHARE";
		var url = location.href.split('#')[0]; 
		var hash = location.href.split('#')[1]; // location.hash is decoded
		if (!hash || hash.substring(0, prefix.length) != prefix) {
			return;
		}
		
		var el = document.getElementById('linkthisbookmarklet_container');
		if (el && el.parentNode) {
			el.parentNode.removeChild(el);
			location.replace(url + "#");
		}
	}
	
	
	// Create the share dialog in the corner of the window
	var container = div();
	container.id = "linkthisbookmarklet_container";
	container.style.position = "absolute";
	container.style.top = scrollPos().y + "px";
	container.style.right = "0";
	container.style.width = "auto";
	container.style.zIndex = 100000;
	var foreground = div(container);
	foreground.id = "linkthisbookmarklet__foreground";
	foreground.style.backgroundColor = "white";
	foreground.style.zIndex = 2;
	foreground.style.width = "450px";
	foreground.style.height = "450px";
	foreground.innerHTML = '<iframe src="<?php echo get_option('siteurl'); ?>/?link-this-bookmarklet=1&link_url=' + location.href + '&link_name=' + document.title + '" frameborder="0" id="linkthisbookmarklet__iframe" style="width:100%;height:100%;border:0px;padding:0px;margin:0px"></iframe>';
	document.body.appendChild(container);
	
	var interval = window.setInterval(function() {
		checkForFrameMessage();
	}, 50);
})();