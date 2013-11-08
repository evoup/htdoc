		var preloaded = [];

		// here is a lame preloading script i am putting in just for demonstration
		for (var i = 1; i <= 8; i++) {
			preloaded[i] = [loadImage(i + "-0.gif"), loadImage(i + "-1.gif")];
		}

		function init() {
			// whatever stuff you need to do onload goes here.

			//==========================================================================================
			// if supported, initialize mtdropdowns
			//==========================================================================================
			// Check isSupported() so that menus aren't accidentally sent to non-supporting browsers.
			// This is better than server-side checking because it will also catch browsers which would
			// normally support the menus but have javascript disabled.
			//
			// If supported, call initialize() and then hook whatever image rollover code you need to do
			// to the .onactivate and .ondeactivate events for each menu.
			//==========================================================================================
			if (mtDropDown.isSupported()) {
				mtDropDown.initialize();

				// hook all the image swapping of the main toolbar to menu activation/deactivation
				// instead of simple rollover to get the effect where the button stays hightlit until
				// the menu is closed.
				menu1.onactivate = function() { swapImage("button1", preloaded[1][1].src) };
				menu1.ondeactivate = function() { swapImage("button1", preloaded[1][1].src) };

				menu1.onactivate = function() { swapImage("button2", preloaded[2][1].src) };
				menu1.ondeactivate = function() { swapImage("button2", preloaded[2][1].src) };

				menu1.onactivate = function() { swapImage("button3", preloaded[3][1].src) };
				menu1.ondeactivate = function() { swapImage("button3", preloaded[3][1].src) };

				menu1.onactivate = function() { swapImage("button4", preloaded[4][1].src) };
				menu1.ondeactivate = function() { swapImage("button4", preloaded[4][1].src) };

				menu1.onactivate = function() { swapImage("button5", preloaded[5][1].src) };
				menu1.ondeactivate = function() { swapImage("button5", preloaded[5][1].src) };
				
				menu1.onactivate = function() { swapImage("button6", preloaded[6][1].src) };
				menu1.ondeactivate = function() { swapImage("button6", preloaded[6][1].src) };
				
				menu1.onactivate = function() { swapImage("button7", preloaded[7][1].src) };
				menu1.ondeactivate = function() { swapImage("button7", preloaded[7][1].src) };
				
				menu1.onactivate = function() { swapImage("button8", preloaded[8][1].src) };
				menu1.ondeactivate = function() { swapImage("button8", preloaded[8][1].src) };
				
			}
		}

		// this is a crappy example preloader. Use whichever one you want.
		function loadImage(sFilename) {
			var img = new Image();
			img.src ="_images/nav/" + sFilename;
			return img;
		}

		// this is a crappy example image swapper. Use whichever you want.
		function swapImage(imgName, sFilename) {
		document.images.src = sFilename;
		}