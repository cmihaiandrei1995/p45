// Tooltip
(function( $ ) {

	'use strict';
	
	if ( $.isFunction( $.fn['tooltip'] ) ) {
		$( 'body' ).tooltip({ 
			//container: 'body',
			selector: '[data-toggle=tooltip],[rel=tooltip]'
		});
	}

}).apply( this, [ jQuery ]);

// Scroll to Top
(function(theme, $) {
	// Scroll to Top Button.
	if (typeof theme.PluginScrollToTop !== 'undefined') {
		theme.PluginScrollToTop.initialize();
	}
}).apply(this, [ window.theme, jQuery ]);

// Select2
(function( $ ) {

	'use strict';

	if ( $.isFunction($.fn[ 'select2' ]) ) {

		$(function() {
			$('[data-plugin-selectTwo]').each(function() {
				var $this = $( this ),
					opts = {};

				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginSelect2(opts);
			});
		});

	}

}).apply(this, [ jQuery ]);

// Scrollable
(function( $ ) {

	'use strict';

	if ( $.isFunction($.fn[ 'nanoScroller' ]) ) {

		$(function() {
			$('[data-plugin-scrollable]').each(function() {
				var $this = $( this ),
					opts = {};

				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions) {
					opts = pluginOptions;
				}

				$this.themePluginScrollable(opts);
			});
		});

	}

}).apply(this, [ jQuery ]);