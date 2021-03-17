/* Add here all your JS customizations */

jQuery(function($){
	
	// sidebar toggle cookie
	$('.sidebar-toggle').click(function(){
		$.post($_base_cms + 'ajax/sidebar.php');
	});
	
	// language tabs
	$('ul.langtabs').not('.classic').each(function(){
		$lng_tabs = $(this);
		$lng_tabs.find('li a').click(function(e){
			e.preventDefault();

			// get clicked lang
			$lng = $(this).data('lang');
			$old_lng = $(this).parent().parent().find('li.active a').data('lang');

			// switch tabs
			$(this).parent().parent().find('li.active').removeClass('active');
			$(this).parent().addClass('active');

			$(this).parent().parent().parent().find('button span:first').html( $(this).html() );

			// show/hide fields
			$(this).parent().parent().parent().parent().parent().find('.lng_' + $old_lng).hide();
			$(this).parent().parent().parent().parent().parent().find('.lng_' + $lng).show();
		});
	});


	// keep session alive
	if($_module != ""){
		setInterval(function(){
			$.post($_base_cms + 'ajax/session.php');
		}, 60000);
	}


	// select fields on view page
	$(".fields-select").click(function(e){
		e.stopPropagation();
	});


	// Image gallery control buttons
	$('body').on('mouseenter', ".gallery ul li", function() {
		$(this).children(".actions").show("fade", 200);
	});
	$('body').on('mouseleave', ".gallery ul li", function() {
		$(this).children(".actions").hide("fade", 200);
	});


	// Tabs
	$.fn.contentTabs = function(){
		$(this).find(".tab_content").hide(); //Hide all content
		$(this).find("ul.tabs li:first").addClass("activeTab").show(); //Activate first tab
		$(this).find(".tab_content:first").show(); //Show first tab content

		$("ul.tabs li").click(function() {
			if($(this).parent().parent().parent().find("ul.tabs li").length){
				$(this).parent().parent().parent().find("ul.tabs li").removeClass("activeTab"); //Remove any "active" class
			}else{
				$(this).parent().parent().find("ul.tabs li").removeClass("activeTab"); //Remove any "active" class
			}
			$(this).addClass("activeTab"); //Add "active" class to selected tab
			if($(this).parent().parent().parent().find(".tab_content").length){
				$(this).parent().parent().parent().find(".tab_content").hide(); //Hide all tab content
			}else{
				$(this).parent().parent().find(".tab_content").hide(); //Hide all tab content
			}
			var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
			$(activeTab).show(); //Fade in the active content
			return false;
		});
	};
	$("div.widget").contentTabs(); //Run function on any div with class name of "Content Tabs"



	// ipp selector
	$('#ippSelector').change(function(){
		location.href = $_base_cms + 'bounce.php?action=ipp&val=' + $(this).val() + $_add_link;
	});



	// On checkbox click colorate the row
	$("#checkAll tbody tr td:first-child input:checkbox:not(:disabled)").click(function() {
		var checkedStatus = this.checked;
		if(checkedStatus){
			$(this).parent().parent().parent().addClass('active');
		}else{
			$(this).parent().parent().parent().removeClass('active');
		}
	});

	// Check all checbboxes
	$("#titleCheck").click(function() {
		var checkedStatus = this.checked;
		$("#checkAll tbody tr td:first-child input:checkbox:not(:disabled)").each(function() {
			this.checked = checkedStatus;
			if(checkedStatus){
				$(this).parent().parent().parent().addClass('active');
			}else{
				$(this).parent().parent().parent().removeClass('active');
			}
		});
	});

	// On row click trigger checkbox click
	$("#checkAll tbody tr").on('click', function(){
		$(this).find("td:first-child input:checkbox:not(:disabled)").click();
	}).on('click', 'div', function(e) {
	    e.stopPropagation();
	}).on('click', 'a', function(e) {
	    e.stopPropagation();
	});



	// do with selectbox
	$('#do_with').change(function(){
		current_checked = new Array();
		var selector = $(this);
		action = selector.find('option:selected').val();
		if(action != ""){
			$("#checkAll tbody tr td:first-child input:checkbox").each(function() {
				if(this.checked) {
					current_checked.push($(this).val());
				}
			});

			ids = current_checked.join(',');

			if(ids == ""){
				alert('Nu ati selectat nimic!');
				selector.find('option:first').attr('selected', true);
			}else{
				switch(action){
					case 'delete': {
						$(".delete-record-all").magnificPopup({
							type: 'inline',
							fixedContentPos: true,
							fixedBgPos: false,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in',
							modal: true
						}).magnificPopup('open');

						$(document).on('click', '#delete-record-all .modal-confirm', function (e) {
							e.preventDefault();

							url = $_base_cms + '?module=' + $_module + '&action=delete' + $_add_link;
							post(url, {id: ids});

							$.magnificPopup.close();
						});
					}break;
					case 'trash': {
						$(".trash-record-all").magnificPopup({
							type: 'inline',
							fixedContentPos: true,
							fixedBgPos: false,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in',
							modal: true
						}).magnificPopup('open');

						$(document).on('click', '#trash-record-all .modal-confirm', function (e) {
							e.preventDefault();

							url = $_base_cms + '?module=' + $_module + '&action=trash' + $_add_link;
							post(url, {id: ids});

							$.magnificPopup.close();
						});
					}break;
					case 'undo_trash': {
						$(".undo-trash-record-all").magnificPopup({
							type: 'inline',
							fixedContentPos: true,
							fixedBgPos: false,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in',
							modal: true
						}).magnificPopup('open');

						$(document).on('click', '#undo-trash-record-all .modal-confirm', function (e) {
							e.preventDefault();

							url = $_base_cms + '?module=' + $_module + '&action=undo_trash' + $_add_link;
							post(url, {id: ids});

							$.magnificPopup.close();
						});
					}break;
					case 'draft': {
						$(".draft-record-all").magnificPopup({
							type: 'inline',
							fixedContentPos: true,
							fixedBgPos: false,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in',
							modal: true
						}).magnificPopup('open');

						$(document).on('click', '#draft-record-all .modal-confirm', function (e) {
							e.preventDefault();

							url = $_base_cms + '?module=' + $_module + '&action=draft' + $_add_link;
							post(url, {id: ids});

							$.magnificPopup.close();
						});
					}break;
					case 'undo_draft': {
						$(".undo-draft-record-all").magnificPopup({
							type: 'inline',
							fixedContentPos: true,
							fixedBgPos: false,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in',
							modal: true
						}).magnificPopup('open');

						$(document).on('click', '#undo-draft-record-all .modal-confirm', function (e) {
							e.preventDefault();

							url = $_base_cms + '?module=' + $_module + '&action=undo_draft' + $_add_link;
							post(url, {id: ids});

							$.magnificPopup.close();
						});
					}break;
					case 'active': {
						$(".active-record-all").magnificPopup({
							type: 'inline',
							fixedContentPos: true,
							fixedBgPos: false,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in',
							modal: true
						}).magnificPopup('open');

						$(document).on('click', '#active-record-all .modal-confirm', function (e) {
							e.preventDefault();

							url = $_base_cms + '?module=' + $_module + '&action=active' + $_add_link;
							post(url, {id: ids});

							$.magnificPopup.close();
						});
					}break;
					case 'inactive': {
						$(".inactive-record-all").magnificPopup({
							type: 'inline',
							fixedContentPos: true,
							fixedBgPos: false,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in',
							modal: true
						}).magnificPopup('open');

						$(document).on('click', '#inactive-record-all .modal-confirm', function (e) {
							e.preventDefault();

							url = $_base_cms + '?module=' + $_module + '&action=inactive' + $_add_link;
							post(url, {id: ids});

							$.magnificPopup.close();
						});
					}break;
					case 'edit': {
						//$('#bulk_edit').trigger('click');
					}break;
				}
			}
		}
	});


	// trash dialog
	$('.trash-record').magnificPopup({
		type: 'inline',
		fixedContentPos: true,
		fixedBgPos: false,
		overflowY: 'auto',
		closeBtnInside: true,
		preloader: false,
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in',
		modal: true,
		callbacks: {
		  	elementParse: function(item) {
		  		$('#trash-record').data('id', item.el.data('id'));
		  	}
	  	}
	});

	$(document).on('click', '#trash-record .modal-confirm', function (e) {
		e.preventDefault();

		$data = $('#trash-record');

		url = $_base_cms + '?module=' + $_module + '&action=trash' + $_add_link;
		post(url, {id: $data.data('id')});

		$.magnificPopup.close();
	});



	// delete dialog
	$('.delete-record').magnificPopup({
		type: 'inline',
		fixedContentPos: true,
		fixedBgPos: false,
		overflowY: 'auto',
		closeBtnInside: true,
		preloader: false,
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in',
		modal: true,
		callbacks: {
		  	elementParse: function(item) {
		  		$('#delete-record').data('id', item.el.data('id'));
		  	}
	  	}
	});

	$(document).on('click', '#delete-record .modal-confirm', function (e) {
		e.preventDefault();

		$data = $('#delete-record');

		url = $_base_cms + '?module=' + $_module + '&action=delete' + $_add_link;
		post(url, {id: $data.data('id')});

		$.magnificPopup.close();
	});



	// delete dialog - restricted
	$('.delete-restricted').magnificPopup({
		type: 'inline',
		fixedContentPos: true,
		fixedBgPos: false,
		overflowY: 'auto',
		closeBtnInside: true,
		preloader: false,
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in',
		modal: true
	});



	// pagination input
	$('#pagination').focusout(function(){
		$page = $(this).val();
		if($(this).val() > $(this).data('max')){
			$page = $(this).data('max');
		}
		location.href = $(this).data('currentpage') + '&pg=' + $page;
	});
	$("#pagination").keyup(function (e) {
	    if (e.keyCode == 13) {
	        $(this).trigger('focusout');
	    }
	});



	// Dual select boxes
	$.configureBoxes();

	$('#order_form').submit(function(e){
		submit = orderSelect($('#box1View'), $('#box2View'));
		if(!submit){
			e.preventDefault();
			return false;
		}
	});



	// Multiple select with dropdown
	$(".select2").select2({
		minimumResultsForSearch: 25,
		dropdownAutoWidth: true
	});
	
	
	
	// clear cache buttons
	$('li.cache-toggle a').on('click', function (event) {
		$(this).parent().toggleClass('open');
	});
	$('body').on('click', function (e) {
	    if (!$('li.cache-toggle').is(e.target) 
	        && $('li.cache-toggle').has(e.target).length === 0 
	        && $('.open').has(e.target).length === 0
	    ) {
	        $('li.cache-toggle').removeClass('open');
	    }
	});

	$(".clear_cms_cache").click(function(e){
		e.preventDefault();
		
		$this = $(this);
		$this.find('i.fa').removeClass('fa-cog').addClass('fa-spinner fa-spin');
		
		ajax_url = $_base_cms + 'ajax/clear_cache.php';
		$.ajax({
			type: 'GET',
			url: ajax_url,
			data: {
				action: 'cms',
			},
			success: function(data) {
				$this.find('i.fa').removeClass('fa-spinner fa-spin').addClass('fa-cog');
				$('li.cache-toggle').removeClass('open');
				
				new PNotify({
					title: 'Update CMS',
					text: 'Cache-ul a fost golit',
					addclass: 'notification-success icon-nb',
					icon: 'fa fa-info',
					shadow: true,
					buttons: {
						closer: true,
						sticker: false
					}
				});
			}
		});
	});
	
	$(".clear_all_cache").click(function(e){
		e.preventDefault();
		
		$this = $(this);
		$this.find('i.fa').removeClass('fa-cogs').addClass('fa-spinner fa-spin');
		
		ajax_url = $_base_cms + 'ajax/clear_cache.php';
		$.ajax({
			type: 'GET',
			url: ajax_url,
			data: {
				action: 'all',
			},
			success: function(data) {
				$this.find('i.fa').removeClass('fa-spinner fa-spin').addClass('fa-cogs');
				$('li.cache-toggle').removeClass('open');
				
				new PNotify({
					title: 'Info',
					text: 'Cache-ul a fost golit',
					addclass: 'notification-success icon-nb',
					icon: 'fa fa-info',
					shadow: true,
					buttons: {
						closer: true,
						sticker: false
					}
				});
			}
		});
	});
	


	// filter box
	$('#filter-select').change(function(){
		val = $(this).find('option:selected').val();
		if(val!=""){
			ajax_url = $_base_cms + 'ajax/filters.php';

			$.ajax({
				type: 'GET',
				url: ajax_url,
				data: {
					module: $_module,
					field: val,
					action: 'init',
				},
				success: function(data) {
					var json = jQuery.parseJSON(data);
					if(json.values) {
						$('#filter-values').select2('destroy');

						$('#filter-values').select2({
							placeholder: "Alege...",
							minimumResultsForSearch: 25,
							width: '100%',
							data: json.values
						});
					} else if(json.ajax) {
						$('#filter-values').select2('destroy');

						$('#filter-values').select2({
					        placeholder: "Alege...",
						    minimumInputLength: 3,
						    width: '100%',
						    allowClear: true,
						    dropdownAutoWidth: true,
						    ajax: {
						        url: ajax_url,
						        dataType: 'json',
						        type: "GET",
						        data: function (term, page) {
						            return {
						            	q: term,
						            	action: 'search',
						            	module: $_module,
										field: val,
						            };
						        },
						        results: function (data) {
						            return {results: data};
						        }
						    }
						});
					} else {
						alert("A aparut o eroare de sistem!");
					}
				}
			});
		}else{
			$('#filter-values').select2('destroy');
		}
	});



	//Lightbox
	$("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools: '',
		show_title: false,
		allow_resize: true,
		changepicturecallback: function(){ 
			$('body').css('overflow', 'hidden');
		},
		callback: function(){ 
			$('body').css('overflow', '');
		}
	});



	// Modal Dismiss
	$(document).on('click', '.modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});

	$(window).load(function(){
		$('div.select2-container').each(function(index, el) {
			var $this = $(this);
			$this.tooltip({
			    title: function() {
			        return $this.next().data('original-title');
			    },
			    placement: function() {
			        return $this.next().data('placement');
			    }
			});
		});
		$(window).resize();
	});

	$(window).resize(function(event) {
		$('.panel-fixed').each(function(index, el) {
			var $this = $(this);
			if($this.parent('[class*=col]')) {
				$this.width($this.parent('[class*=col]').width());
			}
		});
	});

	// Dashboard masonry
	$('.masonry-grid').isotope({
		itemSelector: '.grid-item',
		percentPosition: true,
		masonry: {
			columnWidth: '.grid-sizer'
		}
	});

});


function orderSelect(m1, m2) {
	if(m1.find('option').length > 0 && m2.find('option').length == 0) {
    	alert ('Nu ati selectat nimic');
    	return false;
    } else {
    	// m1.find('option').attr('selected', true);
    	// m2.find('option').attr('selected', true);
    	box1ViewValues = [];
    	box2ViewValues = [];
    	m1.find('option').each(function(){
    		box1ViewValues.push($(this).val());
    	});
    	m2.find('option').each(function(){
    		box2ViewValues.push($(this).val());
    	});
    	$('[name="box1ViewValues"]').val(box1ViewValues);
    	$('[name="box2ViewValues"]').val(box2ViewValues);
    	return true;
    }
}

function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}

