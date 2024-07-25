/*! ZMTheme.js | zuestmedia.com !*/

jQuery(document).ready(function($) {

	zmNoFullAlignClasstoBody($);

 	zmtAjaxPostsLoader($);

	zmtaccessibilityTweak($);

});

/**
	* add sidebar class to body
	* used to block alignwide & alignfull style in sidebar layouts
	*/
	function zmNoFullAlignClasstoBody($){

		if ($('.zm-no-full-align')[0]){

			$('body').addClass('no-align-widenfull');

		}

	}

	function zmtAjaxPostsLoader($){

    $('.zmt-ajax-posts-load-container').show();

		$(document.body).on('click', '.zmt-ajax-posts-load-button', function(event) {    
			
			event.preventDefault();
      
			$(this).closest('.zmt-ajax-posts-load-container').find('.zmt-ajax-posts-load-button').hide();
			$(this).closest('.zmt-ajax-posts-load-container').find('.zmt-ajax-posts-loading-button').show();
			
			var query_data = {
				query: JSON.stringify($(this).closest('.zmt-ajax-posts-load-container').data('zmt-query')),//important to stringify data, so array datatypes are kept... and clean
				maxpages: $(this).closest('.zmt-ajax-posts-load-container').data('zmt-maxpages'),
				current: $(this).closest('.zmt-ajax-posts-load-container').data('zmt-current'),
				comid: $(this).closest('.zmt-ajax-posts-load-container').data('zmt-comid'),
			}
	
			var ajaxdata = {
				action: 'zmt_ajax_posts_loader',
				query_data: query_data,
				security: zmt_global_vars.ajaxnonce,
			};   
	
			$.ajax({
				url: zmt_global_vars.ajaxurl,
				type: 'POST',
				data: ajaxdata,
				success: function (response) {
						
					if(response.success == true){   

						//get articlelistcontainer before replacing '-ajax-button-container'
						var articlelistcontainer = $('.' + response.data.comid+'-ajax-button-container').parent();

						//makes fade effect wo replaced container
						$('.' + response.data.comid+'-ajax-button-container').replaceWith(function() {
							return $(response.data.html).hide().fadeIn();
						});

						//display container with button
						$('.zmt-ajax-posts-load-container').show(600);

						//find scrolltoelement based on actual articlelistcontainer where replacement happened.
						var scrolltoelement = articlelistcontainer.find('#' + response.data.next_post_id);
						$('html, body').animate({
							scrollTop: scrolltoelement.offset().top
						}, 800);
						
					}
	
				}

			});
	
		});
	
	}

	function zmtaccessibilityTweak($){

		//add aria-hidden to close icons
		$(".uk-close").children("svg").attr( "aria-hidden", "true" );

	}
