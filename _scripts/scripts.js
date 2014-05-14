/*jslint white: true, browser: true, onevar: true, undef: true, nomen: true, eqeqeq: true, plusplus: true, bitwise: true, regexp: true, newcap: true, immed: true, strict: true */
/*global $: false, window: false */

(function () {
	'use strict';
	
	window.CC2010 = {
		init: function () {
			document.body.className = 'js';
			
			this.makeDragDrop('#game-shirts li img', '#ian-shirts img', this.dropItem);
			this.makeDragDrop('#game-pants li img', '#ian-pants img', this.dropItem);
			this.makeDragDrop('#game-feet li img', '#ian-feet img', this.dropItem);
		},
		
		makeDragDrop: function (f, t, callback) {
			var that = this, from = $(f), to = $(t);
			
			from
				.draggable({
					helper: 'clone',
					stop: function (ev, ui) {
						var clone_left = ui.helper.offset().left,
							clone_right = clone_left + ui.helper.width(),

							to_left = to.offset().left,
							to_right = to_left + to.width(),
							
							x_is_good = (clone_left > to_left && clone_left < to_right) || (clone_right < to_right && clone_right > to_left),
							
							clone_top = ui.helper.offset().top,
							clone_bottom = clone_top + ui.helper.height(),
							
							to_top = to.offset().top,
							to_bottom = to_top + to.height(),
							
							y_is_good = (clone_top > to_top && clone_top < to_bottom) || (clone_bottom < to_bottom && clone_bottom > to_top);
						
						if (x_is_good && y_is_good) {
							that.dropItem(ui.helper, to);
						}

						ui.helper.remove();
					}
				});
		},
		
		dropItem: function (from, to) {
			var item_src = from.attr('src');
			
			to.attr('src', item_src).next().attr('value', item_src);
		}
	};
	
	$(document).ready(function () {
		window.CC2010.init();
	});
} ());