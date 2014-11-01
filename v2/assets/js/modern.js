// var changeImgs = function() { // Swap "src" of <img>s to "data-src"
// 	$('.tip-image').find('img').each(function() {
// 	   var imgSrc = $(this).attr('src');
// 	   $(this).attr('data-src', imgSrc);
// 	   $(this).removeAttr('src');
// 	});
// }
// changeImgs();

$('.overlay').attr('hidden', 'true').find('.overlay-inner').find('form').after('<a href="#" class="overlay-hide"><span>Hide window</span></a>'); // Add "hidden" attribute and hide-link for overlays
// $('.button-search').remove(); // Remove search button since instant search is used
$('.main-main-in').prepend('<div id="js-searchcontainer"></div>'); // Container for search is needed

// Remove focusable for overlays, if not visible. Also reset focusable for all links on site. And add "hidden" attribute
var removeFocus = function() {
	$('a').removeAttr('tabindex');
	$('.tip_version_in').attr('tabindex', '0');
	$('.noFocus').find('a, input, button, textarea, .overlay-title').attr('tabindex', '-1');
	$('.overlay').attr('hidden', 'true');
}

// Set focusable for overlays, if they become visible. Also remove focusable for all links, so that focus stays within overlay.
var setFocus = function(name) {
	$('a').attr('tabindex', '-1');
	$(name).find('a, input, button, textarea, .overlay-title').removeAttr('tabindex');
	$(name).removeAttr('hidden');
}

// Focus input field if search-overlay opens, focus title if contact-overlay opens
var setActive = function(name) {
	if(name == "#overlay-search") {
		$(name).find("input").focus();
	} else if(name == "#overlay-contact") {
		$("#overlay-contact-label").attr('tabindex', '0').focus();
	}
}

// Hide overlay
var hideOverlay = function() {
	var hash = window.location.hash;
	window.location.hash = "";
	$('a[href=' + hash + ']').focus();
	$('.main-header-nav-item').removeClass('selected');
	removeFocus();
	var searchCount = getcount('search');
	if(hash == "#overlay-search" && searchCount == 0) { // If search-overlay is closed and no tips were found
		$('#js-searchinput').val(''); // Then empty the input field
		$('#js-searchcount').remove(); // ... remove the search-indicator
		$('#js-searchcontainer').empty(); // ... empty the search container
		setTimeout(function(){// Show the tips and loadmore-link again which were present before the search - but delay it, so that transition can be seen. js-faded has opacity: 0
			$('.main-main-in').find('article').removeClass('js-hidden js-faded'); 
				if ($('.main-main-in').find('.message-error').length == 0) {
					$('.main-main-in').prepend('<p class="message message-fullwidth message-error animation-shake">No tips matched your search term. Please try again. <a href="#" class="hide-icon"><span>Hide message</span></a></p>'); // Also append message that no tips were found
				}
		},300); // Set timeout so that removal of opacity can actually be seen
	} else if(hash == "#overlay-contact") {
		$('input, textarea').val('');
		$('#js-contactmessage').remove();
		$('input, textarea').removeClass('user-success');
	}
}

// Hide error message ("no tip found") on click
$('body').on('click', '.message .hide-icon', function() {
    $(this).parent().fadeOut(function() {
        $(this).remove();
    });
});

removeFocus();

var loadWebshims = function(hash) {
	if (hash == '#overlay-contact') {
		$.getScript("js/js-webshim/minified/polyfiller.js", function( data, textStatus, jqxhr ) {
			// Form validation polyfill
			$.webshims.setOptions({
				waitReady: false,
				basePath: "js/js-webshim/minified/shims/"
			});
			
			$.webshims.setOptions('forms', {
				customMessages: true,
				replaceValidationUI: true
				
			});

			$.webshims.polyfill('forms');
		});
	}
}

// If page is loaded with a hash-tag
var hash = window.location.hash;
if(hash != "") { // If overlay is active
	$('.main-header-nav-item').find('a[href=' + hash + ']').parent().addClass("selected"); // Select link in naviation
	setFocus(hash); 
	setActive(hash);
	loadWebshims(hash);
}

$('.main-header-nav-item').on('click', 'a', function(e) { // If nav-link is clicked
	var link = $(this).attr('href'),
		hash = window.location.hash;
	loadWebshims(link);
	if(link == hash) { // If selected link and hashtag are the same (that means the same nav-link is pressed again and the overlay should disappear)
		hideOverlay();
		e.preventDefault(); // Prevent default behavior of linkx
	} else { // If different link than selected is clicked
		removeFocus(); // First remove focusable for all overlays
		if($('.tip-menu').length > 0) hideMenu();
		setFocus(link); // Then add for opened overlay

		$(this)
			.parent().addClass('selected') // select link
			.siblings().removeClass('selected'); // remove selected state for all other nav-links

		setActive(link);
	}
});

$(document).keydown(function(e) { // overlay can be hidden with ESC key
    var hash = window.location.hash;
    if(e.which == 27) {
    	if (hash == "#overlay-contact" || hash == "#overlay-search") hideOverlay();
    	if ($('.tip-menu').length > 0) hideMenu();
    }
  //   } else if(e.which == 13) { // search-overlay can also be hidden with ENTER key
		// if (hash == "#overlay-search") hideOverlay();
  //   }
});

$('.overlay').on('click', '.overlay-hide', function() { // Hide overlay with close-button
	hideOverlay();
});

// Change form text according to selected radio button
$('.form-row-radio-item').find('label').on('click', function() {
	var theFor = $(this).attr('for');
    if (theFor == "send-sug") {
    	$('.overlay-contact').find('[for=msg]').text('Your tip')
	    .end()
	    .find('.overlay-contact-hint').fadeIn();
    } else if (theFor == "send-msg") {
    	 $('.overlay-contact').find('[for=msg]').text('Your message')
	    .end()
	    .find('.overlay-contact-hint').fadeOut();
    }
});

// Process contact form with Ajax
$("#js-overlay-contact-form").submit(function(e){ // Submits form only if all fields are valid
	e.preventDefault();
	$.post("process.php",
		{
			event: 'email',
			contacttype: $(".overlay-contact").find("[name=contact-type]:checked").val(),
			name: $('.overlay-contact').find('[name=name]').val(),
			email: $('.overlay-contact').find('[name=email]').val(),
			msg: $('.overlay-contact').find('[name=msg]').val()
		},
		function(data){
			// Success
			$(".overlay-contact").find('form').prepend('<p class="message message-dark message-success" id="js-contactmessage">' + data + '</p>');
			$("html, body").animate({ scrollTop: 0 }, "slow");
		}
	).error(function() {
		$(".overlay-contact").find('form').prepend('<p class="message message-dark message-error" id="js-contactmessage">An error has occured. Please try again.</p>');
	});
});

// Get number of tips in DB ... 
var getcount = function(type) {
	if (type == 'tips') var theEvent = "tipscount"; // Total number of tips
	if (type == 'search') var theEvent = "searchcount"; // Number of tips with given search term
	var returnValue;
   	$.ajax({ // Not with $.post, because it needs to be async 
        type: "POST",
        url: "process.php",
        async: false, // Needs to be set
        data: {
			event: theEvent,
			searchterm: $('[name=searchterm]').val()
		},
        success: function(data){
        	returnValue = data;
        }
    });	
    return returnValue;
}

// Load more tips
var loc = window.location.href;
var locPos = loc.substr(loc.indexOf("count") + 6);
if (loc.indexOf("count") > 0) startTips = locPos; // Determine if POST-Parameter "count" is set, if yes set number of tips to initially load to this amount
else startTips = 5; // Else set it to the default value
var startTips = parseInt(startTips, 10);
var	countTips = 5; // How many tips to load additionally when clicking on "Load more"
var getTips = function(getThis) {
	$.post("process.php",
		{
			event: 'loadmore',
			start: startTips, // From which tip in DB to start
			count: countTips // How many tips to get with one click on "loadmore"
		},
		function(data){
			// Success
			$(getThis).before(data); // Paste fetched tips from DB before loadmore-link
			setTimeout(function(){ // Fade in new tips, but delay it, so that transition can be seen
				$('.js-faded').removeClass('js-faded');
			},300); // Set timeout so that removal of opacity can actually be seen
			$(getThis).removeClass('is-active'); // Stop loadmore-link from animating
			startTips = startTips + countTips; // Increase to know which tip from DB to get next 
			var tipsCount = getcount('tips'); // Get number of tips in DB from above function
			if (startTips >= tipsCount) $('.loadmore').hide(); // Hide loadmore-link if there are no more tips available in DB
		}
	).error(function() {
		$(getThis).before('<p class="message message-error">An error has occured. Please try again.</p>');
	});
}

// Delay loading of new posts so that user can see, that something happens
$("#js-loadmore").on('click',function(e){ 
	var thisNow = $(this); // Store this in variable
	$(thisNow).addClass('is-active'); // Animates the loadmore-link
	setTimeout(function(){
		getTips(thisNow);
	},1000); // Above function is only called after 1 sec
	var urlChg = "?count=" + (startTips + countTips);
	history.pushState({}, '', urlChg);
	e.preventDefault();
});

// Search tips with Ajax
var searchTips = function() {
	// $('#js-searchcontainer').find('img').remove(); // Remove images so that they don't get screwed up
	$.post("process.php",
		{
			event: 'search',
			searchterm: $('[name=searchterm]').val() // Content of search field
		},
		function(data){
			$('.main-main-in > article, .main-main-in #js-loadmore').addClass('js-faded js-hidden'); // First hide current shown tips and loadmore link (so that they can later be shown again, if search overlay is closed). Both classes are needed so that the tips can be faded in with CSS (js-faded has opacity: 0).
			$('.main-main-in').find('#js-searchcontainer').empty().prepend(data); // Paste found tips into emptied container
			// $('#js-searchcontainer').find('mark').css('display', 'none');
			setTimeout(function(){
				$('#js-searchcontainer').find('.js-faded').removeClass('js-faded'); // Fade in new tips
			},300); // Set timeout so that removal of opacity can actually be seen
			setFocus('#overlay-search'); // Set tabindex for search-overlay so that only this one can be accessed via keyboard
		}
	).error(function() {
		// $(getThis).before('<p class="message message-error">An error has occured. Please try again.</p>');
	});
}

// On keyup perform above function for tip-search
// $('#js-searchinput').on('keyup', function() {
// 	if ($(this).val().length > 2) {
// 		var maxcount = 9;
// 		var searchCount = getcount('search'); // Check how many tips are found with above function
// 		if(searchCount > maxcount) searchCount = maxcount + "+"; // If too many tips are found, append "+"
// 		if($('#js-searchcount').length == 1) {
// 			$('#js-searchcount').html("<b>Number of tips found:</b> " + searchCount); // If count-indicator is already present, just update its content
// 		} else {
// 			$('.overlay-search').find('.form-row').append('<span class="overlay-search-count" id="js-searchcount" tabindex="0"><b>Number of tips found:</b> ' + searchCount + '</span>'); // Else - if something is entered into the input first - append the whole element
// 		}
// 	    searchTips();
// 	}
// });

// $("#js-overlay-search-form").submit(function(e){ // Prevent that pressing enter submits form
// 	e.preventDefault();
// });

var hideMenu = function() { // Hide title menu
	$('.tip-menu').addClass('is-hidden'); // Change visual style
	setTimeout(function(){
		$('.tip-menu').remove(); // Remove with a timeout, so that it's faded in (same as transition in CSS)
	},300);
	if (clickedTitle != null) clickedTitle.focus();
	removeFocus();
	$('body').off();
}

var hideMenuOutside = function(e) {
	var clicked = $(e.target); // Get the clicked element
	if (clicked.is('.tip-menu') || clicked.parents().is('.tip-menu') || clicked.is('.tip-title-in')) { // Only close menu if none of these elements is clicked
		return;
	} else { // click was outside the dialog, so close it
		hideMenu(); 
	}
}

$('.main-main-in').on('click', '.tip-title-in', function(e) { // Show menu on click on title
	clickedTitle = $(this); // Save clicked title in global variable (so that it also can be accessed within ESC-key function above)
    if($('.tip-menu').length > 0) { // If menu is already there, hide it
    	hideMenu();
    }
    else { // If menu is not yet there
    	$('a').attr('tabindex', '-1'); // Set all links outside the menu to non tapable
    	// $('.tip_version_in').attr('tabindex', '-1'); // Also for version info
    	var text = $(this).text(); // Get text of tip
    	// var link = $(this).parents('.tip-title').find('> a').attr('href'); // Get link of tip
    	var link = location.href; // ...
    	// console.log(link);
    	
    	$(this).append('<div class="tip-menu is-hidden" role="dialog" aria-label="tip-menu-label"><h2 id="tip-menu-label">Options</h2><ul><li class="tip-menu-twit"><a href="#">Tweet this tip</a></li><li class="tip-menu-link">Tip link: <input type="text" class="is-hidden"/></li></ul></div>'); // Construct and add menu
    	setTimeout(function(){
			$('.tip-menu').removeClass('is-hidden'); // Remove class with a timeout, so that it's faded in (same as transition in CSS)
			$('.tip-menu-twit a').focus();
		},300); 

    	$(this).parent().find('input').val(link).on('click', function() { // If click on input field (where URL link is shown), select its content
    	    $(this).select();
    	});

    	$('.tip-title-in').on('click', '.tip-menu a', function(e) { // If on menu links is clicked
    		if ($(this).parent().hasClass('tip-menu-twit')) { // If clicked on Twitter link
    			window.location.href = "http://twitter.com/home/?status=Check out this Sketch tip at sketchtips.info: '" + text + "' (" + link + ")";
    		}
    		// if ($(this).parent().hasClass('tip-menu-comm')) { // If clicked on Comment link
    		// 	window.location.href = "http://" + link + "#disqus_thread";
    		// }
    	});

    	$('body').on('click', function(e) {
			hideMenuOutside(e);
    	}).on('tap', function(e) {
    	    hideMenuOutside(e);
    	});
    }
    e.preventDefault();
});