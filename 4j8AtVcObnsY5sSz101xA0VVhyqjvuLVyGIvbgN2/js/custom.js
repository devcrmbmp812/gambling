$(document).ready(function() {

	

	// Adds title attributes and classnames to list items	 

	$("ul li a:contains('Dashboard')").addClass("dashboard").attr('title', 'Dashboard');

	$("ul li a:contains('Pages')").addClass("pages").attr('title', 'Pages');

	$("ul li a:contains('Media')").addClass("media").attr('title', 'Media');

	$("ul li a:contains('History')").addClass("history").attr('title', 'History');

	$("ul li a:contains('Messages')").addClass("messages").attr('title', 'Messages');

	$("ul li a:contains('Settings')").addClass("settings").attr('title', 'Settings');

	

	

	//$("nav").height($(document).height());

	

	// Add class to last list item of submenu	

	//$("ul.submenu li:last-child").addClass("last");

	

	

	// Append Plus icon on thumbnail hover

	$(".gallery a").hover(function(){

		$(this).append("<span style='display:none'>&oplus;</span>").find("span").fadeIn(500);

	}, function(){

		$(this).find("span").fadeOut(500);

	});

	

	//  Tmeline load

	i=200;

	$(".tl-post").each(function(){

		$(this).delay(i).animate({"opacity" : 1});

		i=i+200;

	});

	

	// Table sorter

	$("#myTable").tablesorter();

	$("tr:not(.table-head):odd").addClass("odd");

	

	// Equal height divs - www.broken-links.com

	var highestCol = Math.max($('.widget-container > .widget').height(),$('.widget-container > .widget').height());

	$('.widget-container > .widget').height(highestCol);

		

	// Setttings dropdown menu	

	$("header span").hover(function(){

		$(this).find("ul").stop("true", "true").slideDown(500);

	}, function(){

		$(this).find("ul").stop("true", "true").slideUp(500);

	});

	

	// Notification/inbox dropdown menu

	$(".dropdown:has(ul)").hover(function(){

		$(this).find("ul").stop("true", "true").slideDown(500);

	}, function(){

		$(this).find("ul").stop("true", "true").slideUp(500);

	});	

	

	// Hide alert

	$(".close").click(function(){

		$(this).parent().parent().fadeOut(500);

		$(".content").delay(300).animate({"marginTop" : 0});

	});

	

	// Navigation accordion menu

	$(window).bind("load resize", function(){

		if ($("nav").width() > 100) {

			$("nav ul li:has(ul)").hover(function(){

				$(this).find("ul.submenu").stop("true", "true").slideDown(500);

			}, function(){

				$(this).find("ul.submenu").stop("true", "true").delay(100).slideUp(500);

			});

		} else {

			$("nav ul li ul").empty();

		}

	});

	

	// Mobile navigation for sliding navigation

	

	// $(".ico-font").toggle(function(){

		// $("nav").animate({"left" : 0}, 20);

		// $("section.content").animate({ marginLeft: 215, marginRight: -215}, 20);

		// $("section.alert").animate({ marginLeft: 215}, 20);

	// }, function(){

		// $("nav").animate({"left" : "-215px"});

		// $("section.content").animate({ marginLeft: 0, marginRight: 0}, 400);

		// $("section.alert").animate({ marginLeft: 0, marginRight: 0}, 400);

		// return false;

	// });

	

	// iPhone style checkbox

	$('header aside span input[type=checkbox]').checkbox();

	

	$('.settings-dd li input').each(function(){

	    $(this).next('span').andSelf().wrapAll('<div class="checkbox-wrap"/>');

	});

	

	// Clear input fields on focus

	// $('input').each(function() {

	// 	var default_value = this.value;

	// 	$(this).focus(function(){

	// 	   if(this.value == default_value) {

	// 	           this.value = '';

	// 	   }

	// 	});

	// 	$(this).blur(function(){

	// 	   if(this.value == '') {

	// 	           this.value = default_value;

	// 	   }

	// 	});

	// });

	

    $('.post').wysiwyg({

		controls: {

			html: { visible: true },

			h1: { visible: true },

			h2: { visible: true },

			h3: { visible: true },

			code: { visible: true},

			createLink: { visible: true},

			unLink: { visible: true},

			insertImage: { visible: true},

			insertTable: { visible: true},

			insertHorizontalRule: { visible: true},

			subscript: { visible: true},

			superscript: { visible: true},

			insertOrderedList: { visible: true},

			insertUnorderedList: { visible: true},

			indent: { visible: true},

			outdent: { visible: true},

			undo: {visible: true},

			redo: {visible: true},

			justifyRight: {visible: true},

			justifyLeft: {visible: true},

			justifyFull: {visible: true},

			justifyCenter: {visible: true},

		}, css : "css/wysiwyg.css"

	});

	

	// WYSIWYG Editor

	$(window).bind("load resize", function(){

	if ( $(window).width() < 1024) {

		$('#quick_post').wysiwyg({

			controls: {

				html: { visible: true },

				h1: { visible: true },

				h2: { visible: true },

				h3: { visible: true },

				code: { visible: true},

				createLink: { visible: true},

				unLink: { visible: true},

				insertImage: { visible: true},

				insertTable: { visible: true},

				insertHorizontalRule: { visible: true},

				subscript: { visible: true},

				superscript: { visible: true},

				insertOrderedList: { visible: true},

				insertUnorderedList: { visible: true},

				indent: { visible: true},

				outdent: { visible: true},

				undo: {visible: true},

				redo: {visible: true},

				justifyRight: {visible: true},

				justifyLeft: {visible: true},

				justifyFull: {visible: true},

				justifyCenter: {visible: true},

			}, css : "css/wysiwyg.css"

		});

	} else {

		$('#quick_post').wysiwyg({

			controls: {

				html: { visible: true },

				h1: { visible: true },

				h2: { visible: true },

				h3: { visible: true },

				code: { visible: true},

				createLink: { visible: true},

				unLink: { visible: true},

				insertImage: { visible: true},

				insertTable: { visible: true},

				insertHorizontalRule: { visible: true},

				subscript: { visible: true},

				superscript: { visible: true},

				insertOrderedList: { visible: true},

				insertUnorderedList: { visible: true},

				indent: { visible: true},

				outdent: { visible: true}

			}, css : "css/wysiwyg.css"

		});

	}

	});

	

	// Sticky sidebar

	

	$(window).bind("load resize", function(){

	if ( $(window).width() > 768) {

	    var aboveHeight = $('.testing').outerHeight();

	

	    $(window).scroll(function(){

			if ($(window).scrollTop() > aboveHeight){

	            $('nav').addClass('fixed').css('top','0').next()

	

	            } else {

	

	            $('nav').removeClass('fixed').css('top','0')

	        }

	    });

	 }

	 });



	

	$('#categoryType').click(function(){

		var _categoryType = $('#categoryType :selected').val();

		$('[name="categoryType"]').val(_categoryType);

	});



	$('#hotNew').click(function(){

		var _hotNew = $('#hotNew :selected').val();

		$('[name="hotNew"]').val(_hotNew);

	});

	$('#rate').click(function(){

		var _rate = $('#rate :selected').val();

		$('[name="rate"]').val(_rate);

	});

	$('#sportsType').click(function(){

		var _sportsType = $('#sportsType :selected').val();

		$('[name="sportsType"]').val(_sportsType);

	});

	$('#newsType').click(function(){

		var _newsType = $('#newsType :selected').val();

		$('[name="newsType"]').val(_newsType);

	});

	$('#bonustype').click(function(){

		var _bonustype = $('#bonustype :selected').val();

		$('[name="bonustype"]').val(_bonustype);

	});

	$('#buttonOneColor').click(function(){

		var _buttonOneColor = $('#buttonOneColor :selected').val();

		$('[name="buttonOneColor"]').val(_buttonOneColor);

	});

	$('#deleteDetails').hide();

	var _count = 0;

	$('#addDetails').click(function(){

		var parent = $('.addBonusDetailsParent');

		var k = $('.addBonusDetailsParent > .field-wrap > .child-wrap:eq(0)').clone();

		var i = $(k).appendTo('.addBonusDetailsParent > .field-wrap');

		_count++;

		$(k).find('input').val('');

		if(_count == 0){

			$('#deleteDetails').hide();

		}else{

			$('#deleteDetails').show();

		}

	});

	$('#deleteDetails').click(function(){

		$('.addBonusDetailsParent > .field-wrap > .child-wrap:last-child').remove();

		_count--;

		return _count;

		if(_count == 0){

			$('#deleteDetails').hide();

		}else{

			$('#deleteDetails').show();

		}

	});


	$('#adminSite').change(function(){
		var siteName = $(this).val();
		$.ajax({ 
		    url: "select_sports_image.php", // link of your "whatever" php
		    type: "POST",
		    data: 'siteName='+siteName, // all data will be passed here
		    success: function(data){  
		    	$('#profile_img').val(data);
		    }

		});
	});

	// $('#emailValidAdmin').click(function(){alert('hihihih');
	// 	var _vl = $(this).data('emailid');

	// 	alert(_vl);
	// });
	

});

$(document).ready(function() {

	tinymce.init({ selector:'#editor',
	mode: 'none',
	theme: 'modern',
	menu: {
    file: {title: 'File', items: 'newdocument'},
    edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
    insert: {title: 'Insert', items: 'link media | template hr'},
    view: {title: 'View', items: 'visualaid'},
    format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | removeformat'},
    table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
    tools: {title: 'Tools', items: 'spellchecker code | print preview media | forecolor backcolor emoticons | codesample help'}
  	},
  	toolbar: 'undo redo | insert | bold italic fontsizeselect fontselect | forecolor backcolor | formatselect | textpattern_patterns | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | pagebreak | insertdatetime | charmap | emoticons | searchreplace | fullscreen | layer',

  	plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor importcss layer textpattern'
    ],  // required by the code menu item
	fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
	font_formats: 'Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats',
	block_formats: 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre',
	style_formats_merge: true,
	theme_advanced_buttons3_add : "save,insertlayer,moveforward,movebackward,absolute",
  	save_enablewhendirty : true,
  	save_onsavecallback : "mysave",
	pagebreak_separator : "<!-- my page break -->",
  	content_css: 'css/content.css',
	preview_styles: false
 });

}); 





$(document).ready(function(){
	$('.responseMsg').hide();
 	$('.responseButton').click(function(){
  		var msgParent = $(this).parents('.conv-singel-parent');
  		$(msgParent).find('.responseMsg').toggle();
 	});
});

$(document).ready(function(){

	$('#adminSite').hide();

	$('.updateGroupID').change(function(){

		var va = $(this).val();

		if(va == 2){

			$('#adminSite').show();

		} else if(va == 3){

			$('#adminSite').hide();

		}

	});

});



$(document).ready(function(){

	var frameHeight = $(window).height();

	$('#chatFrame').css("height", frameHeight);

	$(window).resize(function(){

		$('#chatFrame').css("height", frameHeight);

	});





	

});

// $(document).ready(function(){

// 	$('.add_new').click(function(){

// 		var _new = $(this).parent('add-new');

// 		var _appnd = $(_new).data('appnd');

// 		var _datatype = $(_new).data('type');

// 		if(_datatype = 'miniGame'){

// 			var _html = '<table><tr><td width="85%"><input type="text" value="" id="add-Minigame-value" placeholder="Add Mini Game" /></td><td><button class="add-Minigame" id="add-Minigame">ADD</button></td></tr></table>';

// 			alert(_html);

// 		}else if(_datatype = 'betting-option'){

// 			var _html = '<table><tr><td width="85%"><input type="text" value="" id="add-bettingOption-value" placeholder="Add betting Option" /></td><td><button class="add-Minigame" id="add-bettingOption">ADD</button></td></tr></table>';

// 		}

// 		$(_html).appendTo(_appnd);

// 	});

// });



// notification load for admin

$(document).ready(function(){

	

	$.ajax({ 
	    url: "bonusCommentnote.php", // link of your "whatever" php
	    type: "GET",
	    //async: true,
	    //cache: false,
	    data: '1', // all data will be passed here
	    success: function(data){  
	        $('.notice').append(data);
	        var notycount = $('.notice li').length;
			if(notycount == 0){
				$('.notificationCount').text('0');
			}else{
				$('.notificationCount').text(notycount);
			}
	    }
	});

	$.ajax({ 
	    url: "sportsCommentnote.php", // link of your "whatever" php
	    type: "GET",
	    //async: true,
	    //cache: false,
	    data: '1', // all data will be passed here
	    success: function(data){  
	        $('.notice').append(data);
	        var notycount = $('.notice li').length;
			if(notycount == 0){
				$('.notificationCount').text('0');
			}else{
				$('.notificationCount').text(notycount);
			}
	    }
	});

	$.ajax({ 
	    url: "sadariCommentnote.php", // link of your "whatever" php
	    type: "GET",
	    //async: true,
	    //cache: false,
	    data: '1', // all data will be passed here
	    success: function(data){  
	        $('.notice').append(data);
	        var notycount = $('.notice li').length;
			if(notycount == 0){
				$('.notificationCount').text('0');
			}else{
				$('.notificationCount').text(notycount);
			}
	    }
	});

	$.ajax({ 

	    url: "newsCommentnote.php", // link of your "whatever" php

	    type: "GET",

	    //async: true,

	    //cache: false,

	    data: '1', // all data will be passed here

	    success: function(data){  

	        $('.notice').append(data);

	        var notycount = $('.notice li').length;

			if(notycount == 0){

				$('.notificationCount').text('0');

			}else{

				$('.notificationCount').text(notycount);

			}

	    }

	});



	$.ajax({ 

	    url: "complaintnote.php", // link of your "whatever" php

	    type: "GET",

	    //async: true,

	    //cache: false,

	    data: '1', // all data will be passed here

	    success: function(data){  

	        $('.notice').append(data);

	        var notycount = $('.notice li').length;

			if(notycount == 0){

				$('.notificationCount').text('0');

			}else{

				$('.notificationCount').text(notycount);

			}

	    }

	});

	$.ajax({ 
	    url: "complaintnoteresponse.php", // link of your "whatever" php
	    type: "GET",
	    //async: true,
	    //cache: false,
	    data: '1', // all data will be passed here
	    success: function(data){  
	        $('.notice').append(data);
	        var notycount = $('.notice li').length;
			if(notycount == 0){
				$('.notificationCount').text('0');
			}else{
				$('.notificationCount').text(notycount);
			}
	    }
	});

// Froum notification
	// $.ajax({ 
	//     url: "levelupnote.php", // link of your "whatever" php
	//     type: "GET",
	//     //async: true,
	//     //cache: false,
	//     data: '1', // all data will be passed here
	//     success: function(data){  
	//         $('.notice').append(data);
	//         var notycount = $('.notice li').length;
	// 		if(notycount == 0){
	// 			$('.notificationCount').text('0');
	// 		}else{
	// 			$('.notificationCount').text(notycount);
	// 		}
	//     }
	// });

	$('.changeLevelupRequest').change(function(){
		var _uId = $(this).data('user');
		var _lID = $(this).data('levelupid');
		var _sVal = $(this).val();
		$.ajax({
			url: "ajax/level-up.php",
			type: "POST",
			data: 'user='+_uId+'&levelid='+_lID+'&sid='+_sVal,
			success: function(data){
				//alert(data);
				var _resd = data.split('@@');
                if(_resd[1] == 0){
                	$('.alert .red p').text(_resd[0]);
                	$('.alert .red').show();
                	$('.custom-pip').text(_resd[2]);
                }else{
                	$('.alert .green p').text(_resd[0]);
                	$('.alert .green').show();
                	$('.custom-pip').text(_resd[2]);
                }
			}
		});
	});
	// changeverfication
	$('.changeverfication').change(function(){ 
		var _uvId = $(this).data('user');
		var _vVal = $(this).val();
		$.ajax({
			url: "ajax/email-verification.php",
			type: "POST",
			data: 'user='+_uvId+'&sid='+_vVal,
			success: function(data){
				//alert(data);
				var _resd = data.split('@@');
                if(_resd[1] == 0){
                	$('.alert .red p').text(_resd[0]);
                	$('.alert .red').show();
                }else{
                	$('.alert .green p').text(_resd[0]);
                	$('.alert .green').show();
                }
			}
		});
	});

	//hide-show-topic
	$('.showHideTopic').change(function(){ 
		var _topId = $(this).data('topic');
		var _topVal = $(this).val();
		$.ajax({
			url: "ajax/hide-show-topic.php",
			type: "POST",
			data: 'topic='+_topId+'&sid='+_topVal,
			success: function(data){
				//alert(data);
				var _resd = data.split('@@');
                if(_resd[1] == 0){
                	$('.alert .red p').text(_resd[0]);
                	$('.alert .red').show();
                }else{
                	$('.alert .green p').text(_resd[0]);
                	$('.alert .green').show();
                }
			}
		});
	});

	$('.showHideTopicreply').change(function(){ 
		var _toprId = $(this).data('topic');
		var _toprVal = $(this).val();
		$.ajax({
			url: "ajax/comment-topic-spam-show.php",
			type: "POST",
			data: 'topic='+_toprId+'&sid='+_toprVal,
			success: function(data){
				//alert(data);
				var _resd = data.split('@@');
                if(_resd[1] == 0){
                	$('.alert .red p').text(_resd[0]);
                	$('.alert .red').show();
                }else{
                	$('.alert .green p').text(_resd[0]);
                	$('.alert .green').show();
                }
			}
		});
	});




});

$(document).ready(function(){

	$('.add-column').click(function(){

		var _open = $(this).data('open');

		//alert(_open);

		$(_open).show();

	});	

	$('.close_open').click(function(){

		var _close = $(this).data('close');

		//alert(_open);

		$(_close).hide();

	});

});

$(document).ready(function(){
	$('.add_new_mini').click(function(){
		var _col = $(this).data('collect');
		var _collect = $(_col).val();
		//alert(_collect);
		if(_collect == ''){
			alert('No data added');
		}else{

			//alert(_collect);
			$.ajax({ 
			    url: "addMiniGame.php", // link of your "whatever" php
			    type: "POST",
			    data: 'mini-game='+_collect, // all data will be passed here
			    success: function(data){ 
			    	//alert(data);
			        $('.miniGame').html(data);
			        //$('.miniGame').trigger("chosen:updated");
			    }

			});

		}

	});

	

	

	$('.add_new_bettingoption').click(function(){

		var _col = $(this).data('collect');

		var _collect = $(_col).val();

		//alert(_collect);

		if(_collect == ''){

			alert('No data added');

		}else{

			//alert(_collect);

			$.ajax({ 

			    url: "addbettingoption.php", // link of your "whatever" php

			    type: "POST",

			    data: 'betting-option='+_collect, // all data will be passed here

			    success: function(data){  

			        $('.bettingOption').html(data);
			        $(_col).val('');
			    }

			});

		}

	});



});

$(document).ready(function(){
	$('.btn-reset').click(function(){ //alert('hi');
		$(this).siblings('input[type=text]').val('');
	});
});

$(document).ready(function(){
	$('.delete-mini').click(function(){
		//alert($('.miniGame').val());
	});
});
$(document).ready(function(){
	var _rId = $('.reponsiveID').val();
	$('.deleteFiles').click(function(){
		$(this).parents('.parentresponsefiles').remove();
		var storeImage = new Array();
		$('.respons-files-image-show li').each(function(){
			var _t = $(this).find('.responsFileslocalstore').val();
			storeImage.push(_t);
		});
		$.ajax({ 
		    url: "complaint-edit-ajax.php", // link of your "whatever" php
		    type: "POST",
		    data: 'storedImage='+storeImage+'&id='+_rId, // all data will be passed here
		    success: function(data){  
		        alert('Image is removed');
		        //$('#responsFileslocalstoreajax').val(data);
		    }
		});
	});
});

$(document).ready(function(){
	var _removeFiles = $('#removeFiles');
	//$(_removeFiles).hide();
	$(document).on('click', '#addMoreFile', function(){
		var _input = '<input type="file" name="complaintFils[]" class="form-control complaintFils" /><br>';
		$(_input).insertBefore('#addMoreFile');
		var _inputCount = $('.complaintFils').size();
		if(_inputCount > 1){ alert(_inputCount);
			$(_removeFiles).show();
		}
	});
	$(document).on('click', '#removeFiles', function(){
		$('.complaintFils:last').remove();
		var _inputCount = $('.complaintFils').size();
		if(_inputCount == 1){
			$(_removeFiles).hide();
		}
	});
});


function openCity(cityName) {
    var i;
    var x = document.getElementsByClassName("city");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none"; 
    }
    document.getElementById(cityName).style.display = "block"; 
}





// $(function () {



//         var rating = 5;

//         //var rating = $('.rateyo-readonly > input').val();



//         $(".counter").text(rating);



//         $("#rateYo1").on("rateyo.init", function () { console.log("rateyo.init"); });



//         $("#rateYo1").rateYo({

//           rating: rating,

//           numStars: 5,

//           precision: 2,

//           starWidth: "15px",

//           spacing: "15px",

//           multiColor: {



//             startColor: "#ff0000",

//             endColor  : "#ffffff"

//           },

//           onInit: function () {



//             console.log("On Init");

//           },

//           onSet: function () {



//             console.log("On Set");

//           }

//         }).on("rateyo.set", function () { console.log("rateyo.set"); })

//           .on("rateyo.change", function () { console.log("rateyo.change"); });





//         $(".rateyo").rateYo();



//         $(".rateyo-readonly-widg").rateYo({

//           rating: rating,

//           numStars: 5,

//           precision: 2,

//           fullStar: true,

//           minValue: 1,

//           maxValue: 5,

//           multiColor: {

//             startColor: "#ff0000",

//             endColor  : "#f1c40f"

//           },

//           starWidth: "15px",

//           spacing: "15px"

//         }).on("rateyo.change", function (e, data) {

//           $('.ratingCounter').text(data.rating);

//           $('#commentRate').val(data.rating);

//         });

//          $(".rateyo-readonly").rateYo({



//           rating: rating,

//           numStars: 5,

//           precision: 2,

//           minValue: 1,

//           maxValue: 5,

//           readOnly: true,

//           // multiColor: {



//           //   startColor: "#4CAF50",

//           //   endColor  : "#ffffff"

//           // },

//           starWidth: "15px",

//           spacing: "5px"

//         }).on("rateyo.change", function (e, data) {

        

// 	 	$('.counter').text(data.rating);

//         });

//       });



