/*
Name: 			Theme Admin Extension
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.4.0
*/

window.admin = {};

// Panels
(function( $ ) {

	$(function() {
		$('.panel')
			.on( 'panel:toggle', function() {
				var $this,
					direction;

				$this = $(this);
				direction = $this.hasClass( 'panel-collapsed' ) ? 'Down' : 'Up';

				$this.find('.panel-body, .panel-footer')[ 'slide' + direction ]( 200, function() {
					$this[ (direction === 'Up' ? 'add' : 'remove') + 'Class' ]( 'panel-collapsed' )
				});
			})
			.on( 'panel:dismiss', function() {
				var $this = $(this);

				if ( !!( $this.parent('div').attr('class') || '' ).match( /col-(xs|sm|md|lg)/g ) && $this.siblings().length === 0 ) {
					$row = $this.closest('.row');
					$this.parent('div').remove();
					if ( $row.children().length === 0 ) {
						$row.remove();
					}
				} else {
					$this.remove();
				}
			})
			.on( 'click', '[data-panel-toggle]', function( e ) {
				e.preventDefault();
				$(this).closest('.panel').trigger( 'panel:toggle' );
			})
			.on( 'click', '[data-panel-dismiss]', function( e ) {
				e.preventDefault();
				$(this).closest('.panel').trigger( 'panel:dismiss' );
			})
			/* Deprecated */
			.on( 'click', '.panel-actions a.fa-caret-up', function( e ) {
				e.preventDefault();
				var $this = $( this );

				$this
					.removeClass( 'fa-caret-up' )
					.addClass( 'fa-caret-down' );

				$this.closest('.panel').trigger( 'panel:toggle' );
			})
			.on( 'click', '.panel-actions a.fa-caret-down', function( e ) {
				e.preventDefault();
				var $this = $( this );

				$this
					.removeClass( 'fa-caret-down' )
					.addClass( 'fa-caret-up' );

				$this.closest('.panel').trigger( 'panel:toggle' );
			})
			.on( 'click', '.panel-actions a.fa-times', function( e ) {
				e.preventDefault();
				var $this = $( this );

				$this.closest('.panel').trigger( 'panel:dismiss' );
			});
	});

})( jQuery );

// MultiSelect
(function( $ ) {

	'use strict';

	if ( $.isFunction( $.fn[ 'multiselect' ] ) ) {

		$(function() {
			$( '[data-plugin-multiselect]' ).each(function() {

				var $this = $( this ),
					opts = {};

				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;

				$this.adminPluginMultiSelect(opts);

			});
		});

	}

}).apply( this, [ jQuery ]);

// MultiSelect
(function(admin, $) {

	admin = admin || {};

	var instanceName = '__multiselect';

	var PluginMultiSelect = function($el, opts) {
		return this.initialize($el, opts);
	};

	PluginMultiSelect.defaults = {
		templates: {
			filter: '<div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div>'
		}
	};

	PluginMultiSelect.prototype = {
		initialize: function($el, opts) {
			if ( $el.data( instanceName ) ) {
				return this;
			}

			this.$el = $el;

			this
				.setData()
				.setOptions(opts)
				.build();

			return this;
		},

		setData: function() {
			this.$el.data(instanceName, this);

			return this;
		},

		setOptions: function(opts) {
			this.options = $.extend( true, {}, PluginMultiSelect.defaults, opts );

			return this;
		},

		build: function() {
			this.$el.multiselect( this.options );

			return this;
		}
	};

	// expose to scope
	$.extend(admin, {
		PluginMultiSelect: PluginMultiSelect
	});

	// jquery plugin
	$.fn.adminPluginMultiSelect = function(opts) {
		return this.each(function() {
			var $this = $(this);

			if ($this.data(instanceName)) {
				return $this.data(instanceName);
			} else {
				return new PluginMultiSelect($this, opts);
			}

		});
	}

}).apply(this, [ window.admin, jQuery ]);

(function( $ ) {

	'use strict';

	if ( $.isFunction( $.fn[ 'placeholder' ]) ) {

		$('input[placeholder]').placeholder();

	}

}).apply(this, [ jQuery ]);


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

				$this.adminPluginSelect2(opts);
			});
		});

	}

}).apply(this, [ jQuery ]);

// Select2
(function(admin, $) {

	admin = admin || {};

	var instanceName = '__select2';

	var PluginSelect2 = function($el, opts) {
		return this.initialize($el, opts);
	};

	PluginSelect2.defaults = {
	};

	PluginSelect2.prototype = {
		initialize: function($el, opts) {
			if ( $el.data( instanceName ) ) {
				return this;
			}

			this.$el = $el;

			this
				.setData()
				.setOptions(opts)
				.build();

			return this;
		},

		setData: function() {
			this.$el.data(instanceName, this);

			return this;
		},

		setOptions: function(opts) {
			this.options = $.extend( true, {}, PluginSelect2.defaults, opts );

			return this;
		},

		build: function() {
			this.$el.select2( this.options );

			return this;
		}
	};

	// expose to scope
	$.extend(admin, {
		PluginSelect2: PluginSelect2
	});

	// jquery plugin
	$.fn.adminPluginSelect2 = function(opts) {
		return this.each(function() {
			var $this = $(this);

			if ($this.data(instanceName)) {
				return $this.data(instanceName);
			} else {
				return new PluginSelect2($this, opts);
			}

		});
	}

}).apply(this, [ window.admin, jQuery ]);