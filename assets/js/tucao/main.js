var group = {
	loading: function() {
		document.getElementById("loading");
		
		(function() {
			for (var a = "body.jpg bg2.jpg bg3.jpg bg4.jpg loader.gif loader-bg.png mirror.png nb.png rule_bg.jpg tip1.jpg tip2.jpg tip3.jpg share.png finger.png head.jpg".split(" "), b = 0; b < a.length; b++) 
				a[b] = "../assets/images/tucao/" + a[b];
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