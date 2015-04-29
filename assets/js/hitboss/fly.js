Main.flyLine = function(z) {
	var n = 7;
	var r = 100;
	var E;
	var t = Main.stage;
	var d = Main.fps;
	var y = 0;
	var v = 0;
	var b = Main.width;
	var p = Main.height;
	var B = Main.speed * (Math.random() * 0.2 + 0.8) * n;
	var k;

	function e() {
		Main.penguin.alpha = 0;
		k = G(z);
		var I = {
			images: ["../assets/images/hitboss/fly.png"],
			frames: {
				width: 180,
				height: 170
			},
			animations: {
				fly: [0, 2]
			},
			framerate: 6
		};
		var g = new createjs.SpriteSheet(I);
		E = new createjs.Sprite(g, "fly");
		E.regX = 105;
		E.regY = 105;
		t.addChild(E);
		i()
	}
	var x = 0;
	var u = 9.8 * r;

	function H() {
		x += 1 / d;
		f(B, k)
	}

	function s(I, g) {
		Main.fire("moveStage", I, g)
	}
	var A = Main.penguinOffsetX;
	var w = Main.height - Main.floorLine + 32;
	var F = Main.visibleDistance;
	var a = 0;
	var C = Main.floorLine - Main.penguin.y - Main.penguinHeight / 2;
	var h;

	function f(g, K) {
		var P = g * Math.cos(K) * x;
		var L = g * Math.sin(K) * x - 1 / 2 * u * o(x) + C;
		var J = (g * Math.sin(K) - u * x)*0.6;//垂直速度
		var M = g * Math.cos(K)*3;//水平速度
		var I = -u / o(g) / o(Math.cos(K)) * P + Math.sin(K) / Math.cos(K);
		E.rotation = I * z;
		var O = M * 1 / d;
		if (P + y > F) {
			s(O, P + y)
		} else {
			E.x = b - A - (P + y)
		}
		E.y = p - w - L;
		if (L <= 0 && I < 0) {
			x = 0;
			y += P;
			v = 0;
			B = g * 2.2 / 3;
			k = K * 2.2 / 3;
			a++;
			Main.log(a);
			D();
			C = 0;
			Main.log(E.rotation);
			if (Math.abs(E.rotation) >= 46 && a == 1) {
				l(E.x, E.y, "down");
				D();
				j(P + y);
				return
			}
			if (a == 3) {
				D();
				var N = Math.cos(K) * 800;
				m(P, O, N)
			} else {
				h = createjs.Tween.get(E, {
					loop: false
				}).to({
					rotation: 0
				}, 50, createjs.Ease.bounceOut).call(function() {
					i();
					createjs.Tween.removeTweens(h)
				});
				q(O)
			}
		}
	}
	var c;

	function m(L, J, I) {
		c = new createjs.Bitmap(Resource.get("../assets/images/hitboss/longtraces.png"));
		t.addChild(c);
		c.width = 452;
		c.height = 14;
		c.regX = 452;
		c.regY = -17;
		c.x = E.x;
		c.y = E.y;
		createjs.Ticker.addEventListener("tick", g);

		function g() {
			c.x += J;
			s(J, L + y + 452)
		}
		setTimeout(function() {
			l(E.x, E.y, "slide");
			createjs.Ticker.removeEventListener("tick", g);
			j(L + y + 452)
		}, I);
		var K = new createjs.Shape();
		K.graphics.setStrokeStyle(5, "round", "round");
		K.graphics.beginFill("#FF0000").drawRect(0, 0, 460, 40);
		K.graphics.endStroke();
		K.x = 200;
		K.y = 790;
		c.mask = K
	}

	function q(I) {
		var J = 0;
		var g = new createjs.Bitmap(Resource.get("../assets/images/hitboss/traces.png"));
		t.addChild(g);
		g.width = 145;
		g.height = 45;
		g.regX = 92;
		g.regY = -18;
		g.x = E.x;
		g.y = E.y;
		createjs.Ticker.removeEventListener("tick", K);
		createjs.Ticker.addEventListener("tick", K);

		function K() {
			g.x += I;
			J += I;
			if (J > b * 2 / 3) {
				Main.log("回收痕迹");
				createjs.Ticker.removeEventListener("tick", K);
				t.removeChild(g)
			}
		}
	}

	function l(K, J, g) {
		Main.stage.removeChild(E);
		var I = Main.gameOverPenguinSS;
		E = new createjs.Sprite(I);
		Main.stage.addChild(E);
		E.gotoAndPlay(g);
		E.x = K - 120;
		E.y = J - 112
	}

	function j(g) {
		Main.fire("gameOver", g, E.x)
	}
	Main.on("replay", function() {
		if (c) {
			Main.log("longTracerDisp");
			t.removeChild(c)
		}
		t.removeChild(E);
		E = null;
		D()
	});

	function D() {
		createjs.Ticker.removeEventListener("tick", H)
	}

	function i() {
		D();
		H();
		createjs.Ticker.addEventListener("tick", H)
	}

	function G(g) {
		return Math.PI / 180 * g
	}

	function o(g) {
		return g * g
	}
	e(z)
};