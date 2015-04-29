var group = {
	loading: function() {
		document.getElementById("loading");
		
		(function() {
			for (var a = "body.jpg bg_1.jpg bg_2.jpg bg_3.jpg bg_4.jpg bg_5.jpg bg_6.jpg bg_7.jpg bg_8.jpg bg_9.jpg bg_10_01.jpg bg_11_01.jpg bg_22_01.jpg bg_44_01.jpg bg_55_01.jpg bg_33_01.jpg 11111.jpg 2222.jpg 333.jpg 4444.jpg 55555.jpg guanzhu.jpg share.jpg againBtn.png resultBtn.png shareBtn.png shareResultBtn.png select_bg.png guanzhuBtn.jpg loader.gif loader-bg.png".split(" "), b = 0; b < a.length; b++) 
				a[b] = "../assets/images/character/" + a[b];
			var d =
				function(a, c) {
					var b = new Image;
					b.onload = function() {
						b.onload = null;
						c(a)
					};
					b.src = a
				},
				c = document.getElementById("loading_rate"),
				e = document.getElementById("bar"),
				f = 0;
			(function(a, b) {
				for (var c = a.length, e = 0; a.length;) d(a.shift(), function(a) {
					b(a, ++e, c)
				})
			})(a, function(a, b, d) {
				f = b / d;
				e.style.width = Math.floor(212 * f) + "px";
				c.innerHTML = Math.floor(100 * f) + "%";
				1 == f && setTimeout(function() {
					$("#loading").hide();
				}, 500)
			})
		})()
	}
}
group.loading();
$.fn.x = function(x) {
	return this.css("-webkit-transform", "translateX(" + x + ")");
};
$.fn.toX = function(x, fnEnd) {
	return this.anim({"-webkit-transform": "translateX(" + x + ")"}, 0.8, "ease", fnEnd);
};