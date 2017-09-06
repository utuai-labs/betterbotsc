"use strict";

/*************************************************************
WIDGETS PLUGIN BACKEND SCRIPTS

COLOR WIDGETS
WIDGET UL SORTABLE
FONT AWESOME SELECT PREVIEW ICON

*************************************************************/


/*************************************************************
COLOR WIDGETS
*************************************************************/

	jQuery(document).ready(function($) {
		if ($('.widget').size() > 0) {

			//color widgets
			$('.widget').each(function(index, e) {
				var $this = $(this);
				if ($this.attr('id')) {
					if ($this.attr('id').indexOf('oxie_') != -1) $this.find('.widget-title').css({
						'backgroundColor': '#86beb3',
						'color': '#ffffff',
						'text-shadow': 'none'
					});
				}

			});

		}
	});


/*************************************************************
WIDGET UL SORTABLE
*************************************************************/

	// on document ready
	jQuery(document).ready(function($) {
		if ($('.widget_sortable').size() > 0) {

			initWidgetSortable();

			// reinit on widget add (previewer)
			$(document).on( 'widget-added', function (event) {
				initWidgetSortable();
			});

		}

		function initWidgetSortable () {
				
			$('.widget_sortable').each(function (index) {

				var $this = $(this);
				var placeholder = (typeof $this.attr('data-placeholder') == "undefined") ? "widget_sortable_placeholder" : $this.attr('data-placeholder');

				$this.sortable ({
					placeholder: placeholder,
					revert: true,
					update: updateIndexesWidgetSortable,
				});

			});


		}


		function updateIndexesWidgetSortable (event, ui) {

			var $this = $(this);


			var blockName ="";
			var splitIndex = $this.attr('data-split_index');
			var liIndex = 0;
			var optionNameArray = new Array();
			var $LIs = $this.find('li');
			$LIs.each(function (index, element) {
				var $this = $(this);
				var liIndex = index;
				var $options = $this.find('.li_option');
				$options.each(function (index, element) {
					var $thisOption = $(this);
					//update option name (make sure it only updates numbers in 2nd bracket)
					var optionName = $thisOption.attr('name');
					var optionNameArray = optionName.split('[');
					optionNameArray[splitIndex] = liIndex+"]";

					optionName = optionNameArray.join('[');
					$thisOption.attr('name',optionName);
				});
			}); 

			// force change event on first input to activate previewer to update
			$this.find('input').first().trigger('change');
		}



	});

	// when ever a theme widget has bee saved. NB: remember to change widget_id_base for future themes.
	jQuery(document).ajaxSuccess(function(e, xhr, settings) {

		$ = jQuery;

		// make sure this code only runs on widgets page
		if ($('.widgets-php').size() > 0) {

			var widget_id_base = 'oxie';

			if(settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1) {

				//SORTABLE
				$('.widget_sortable').sortable ({
					placeholder: 'widget_sortable_placeholder',
					revert: true,
					update: ajaxUpdateIndexesWidgetSortable,
				});
				
			}

		}

		function ajaxUpdateIndexesWidgetSortable (event, ui) {

			$ = jQuery;

			var $this = $(this);
			var blockName ="";
			var splitIndex = $this.attr('data-split_index');
			var liIndex = 0;
			var optionNameArray = new Array();
			var $LIs = $this.find('li');
			$LIs.each(function (index, element) {
				var $this = $(this);
				var liIndex = index;
				var $options = $this.find('.li_option');
				$options.each(function (index, element) {
					var $thisOption = $(this);
					//update option name (make sure it only updates numbers in 2nd bracket)
					var optionName = $thisOption.attr('name');
					var optionNameArray = optionName.split('[');
					optionNameArray[splitIndex] = liIndex+"]";

					optionName = optionNameArray.join('[');
					$thisOption.attr('name',optionName);
				});
			}); 

		}

	});

/*****************************************
FONT AWESOME SELECT PREVIEW ICON
*****************************************/

	jQuery(document).ready(function($) {
		if ($('.fa_select').size() > 0) {

			$('body').on('change', '.fa_select', function(event) {
				var $this = $(this);
				var thisValue = $this.val();
				var $iconPreview = $this.next('i');

				$iconPreview.attr('class', "fa " + thisValue);
			});

		}

	});

