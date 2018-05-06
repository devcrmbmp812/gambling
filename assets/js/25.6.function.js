$(document).ready(function(){
		$('.info').click(function(){
			//$('.ask-item-bonus-card').toggleClass('flipped');
			$(this).parents('.ask-item-bonus-card').toggleClass('flipped');
		});
		$('.info').click(function(){
			//$('.ask-item-web-card').toggleClass('flipped');
			$(this).parents('.ask-item-web-card').toggleClass('flipped');
		});
		$('.info').click(function(){
			//$('.ask-item-news-card').toggleClass('flipped');
			$(this).parents('.ask-item-news-card').toggleClass('flipped');
		});
		$('.info').click(function(){
			//$('.ask-item-complain-card').toggleClass('flipped');
			$(this).parents('.ask-item-complain-card').toggleClass('flipped');
		});
		//$('#custom-form').hide();
		$('.searchOn').click(function(){
			$('#custom-form').toggle();
		});
		$('.resp-search-form').hide();
		$('.formCome').click(function(){
			$('.resp-search-form').show();
			$('.resp-search-form').removeClass('slideOutLeft').addClass('slideInRight');
		});
		$('.glyphicon-remove').click(function(){
			$('.resp-search-form').removeClass('slideInRight');
			$('.resp-search-form').hide();
		});
		
		
		if($('.owl-carousel').length){
			jQuery('.owl-carousel').owlCarousel({
				loop:true,
				margin:25,
				nav:false,
				navText: [
					'<i class="fa fa-angle-left"></i>',
					'<i class="fa fa-angle-right"></i>'
				],
				responsive:{
					0:{
						items:1
					},
					600:{
						items:3
					},
					1000:{
						items:4
					}
				}
			});
		}
		/* ---------------------------------------------------------------------- */
		/*	Click to Top 
		/* ---------------------------------------------------------------------- */
		if($('.owl-carousel-team').length){
			jQuery('.owl-carousel-team').owlCarousel({
				loop:true,
				margin:10,
				nav:true,
				autoplay:true,
				navText: [
					'<i class="fa fa-angle-left"></i>',
					'<i class="fa fa-angle-right"></i>'
				],
				responsive:{
					0:{
						items:1
					},
					600:{
						items:2
					},
					1000:{
						items:3
					}
				}
			});
		}

		
	// $(window).scroll(function(){
	// 	var wScroll = $(this).scrollTop();
	// 	if(wScroll > $('#fixed-right').offset().top){
	// 		$('#fixed-right').css({
	// 			"position":"fixed",
	// 			"top":"0"
	// 		});
	// 	}
	// 	if(wScroll < $('#fixed-right').offset().top){
	// 		console.log('hi');
	// 	}
	// });
	
	
	$( ".issue-select option" ).change(function(){
    	var complaints_heading = $( ".issue-select option:selected" ).attr("value");
		$('#issue-heading').text(complaints_heading);
		var selected = $( "#sel1 option:selected" ).data('show');
		alert(selected);
		//var _show-text = selected.data('show'); 
		//$(selected).removeClass('not-show');alert(selected);
		//$(selected).siblings().removeClass('not-show').addClass('not-show');
    });
    $('#complain-form').hide();
    $('[name="optradio"]').click(function(){
		var e = $(this).attr("id");
		if(e == "optradioNo"){
			$('#complain-form').show();
		}else{
			$('#complain-form').hide();
		}
	});
});

$(function () {

        var rating = 5;
        //var rating = $('.rateyo-readonly > input').val();

        $(".counter").text(rating);

        $("#rateYo1").on("rateyo.init", function () { console.log("rateyo.init"); });

        $("#rateYo1").rateYo({
          rating: rating,
          numStars: 5,
          precision: 2,
          starWidth: "15px",
          spacing: "15px",
          multiColor: {

            startColor: "#ff0000",
            endColor  : "#ffffff"
          },
          onInit: function () {

            console.log("On Init");
          },
          onSet: function () {

            console.log("On Set");
          }
        }).on("rateyo.set", function () { console.log("rateyo.set"); })
          .on("rateyo.change", function () { console.log("rateyo.change"); });


        $(".rateyo").rateYo();

        $(".rateyo-readonly-widg").rateYo({
          rating: rating,
          numStars: 5,
          precision: 2,
          fullStar: true,
          minValue: 1,
          maxValue: 5,
          multiColor: {
            startColor: "#ff0000",
            endColor  : "#f1c40f"
          },
          starWidth: "15px",
          spacing: "15px"
        }).on("rateyo.change", function (e, data) {
          $('.ratingCounter').text(data.rating);
          $('#commentRate').val(data.rating);
        });
         $(".rateyo-readonly").rateYo({

          rating: rating,
          numStars: 5,
          precision: 2,
          minValue: 1,
          maxValue: 5,
          readOnly: true,
          // multiColor: {

          //   startColor: "#4CAF50",
          //   endColor  : "#ffffff"
          // },
          starWidth: "15px",
          spacing: "5px"
        }).on("rateyo.change", function (e, data) {
        
	 	$('.counter').text(data.rating);
        });
      });


$(document).ready(function(){
	var _wi = $('.ask-page-content').width();
	$(window).scroll(function(){
		if($('#show-pop-up').length > 0){
			var wScroll = $(this).scrollTop();
			if(wScroll > $('#show-pop-up').offset().top){
				$('.fixed-top').show().width(_wi);
			}
			if(wScroll <= $('#show-pop-up').offset().top){
				$('.fixed-top').hide();
			}
		}
	});
	$(window).resize(function(){
		var _wi = $('.ask-page-content').width();
		$('.fixed-top').width(_wi);
	});
	$( "#sel1 option" ).click(function(){
    	var complaints_heading = $( "#sel1 option:selected" ).attr("value");
    	$('#issue-heading').text(complaints_heading);
    });
    $('#complain-form').hide();
    $('[name="optradio"]').click(function(){
		var e = $(this).attr("id");
		if(e == "optradioNo"){
			$('#complain-form').show();
		}else{
			$('#complain-form').hide();
		}
	});
});


$(document).ready(function() {
    $('.complain-counter').counterUp({
        delay: 10,
        time: 1000
    });
    //$("#myModalTwo").modal("show");
    $('.ask-social > li > a').click(function(){
    	var _modalHeder = $(this).data('header');
    	var _modalContent= $(this).data('content');
    	$('.modalSocialHeader').text(_modalHeder);
    	//modalSocialBody
    	var _bodyText = '<p class="text-white font13">You can connect with me on ' + _modalHeder + '</p>';
    	$('.modalSocialBody').html(_bodyText);
    });
    // $('#sel2').click(function(){
    // 	$('#complaintSitName').
    // });
    $('#sel2').click(function(){
		var _slectedSiteName = $('#sel2 :selected').text();
		$('#complaintSitName').val(_slectedSiteName);
	});


	

    
});

$(document).ready(function(){
	//var a = $('.main').find('a').attr("href", "#");
	var screenWidth = $(window).width();
	var positionRight = [ 40, 300, 600, 900 ];
	var countBox = $('.box').size();
	for( i = 0; i < countBox; i++){
		$('.box').each(function(countBox){
			$(this).css({
				"position":"fixed",
				"bottom":0,
				"right": positionRight[countBox],
				"z-index":"1000"	
			});
		});
	}
	$('.chatBody').hide();

	$.chatBoxDisplay = function(m, o){
		if(m){
			$('.displayControlButton').on('click', function(){
				$(this).parents('.chatWindow').find('.chatBody').hide();
				$(this).parents('.chatWindow').find('.newMessage').show();
				$(this).find('.minimize').removeClass('fa-minus').addClass('fa-plus');
				$.cookie('chatBoxShow', 'YES');
			});
		} else {
			$('.displayControlButton').on('click', function(){
				$(this).parents('.chatWindow').find('.chatBody').show();
				$(this).parents('.chatWindow').find('.newMessage').hide();
				$(this).find('.minimize').removeClass('fa-plus').addClass('fa-minus');
				$.cookie('chatBoxShow', 'NO');
			});
		}
	};

	$(document).on('click', '.displayControlButton', function(){
		$.chatBoxDisplay(($.cookie('chatBoxShow') != 'YES'));
	});

	$.chatBoxDisplay(($.cookie('chatBoxShow') == 'YES'));
});

$(document).ready(function(){
	var _removeFile = $('#removeFile');
	$(_removeFile).hide();
	$(document).on('click', '#addMoreFile', function(){
		var _input = '<input type="file" name="complaintFiles[]" class="form-control complaintFiles" style="padding-top: 3px; padding-bottom: 38px;" />';
		$(_input).insertBefore('#addMoreFile');
		var _inputCount = $('.complaintFiles').size();
		if(_inputCount > 1){
			$(_removeFile).show();
		}
	});
	$(document).on('click', '#removeFile', function(){
		$('.complaintFiles:last').remove();
		var _inputCount = $('.complaintFiles').size();
		if(_inputCount == 1){
			$(_removeFile).hide();
		}
	});
});
$(document).ready(function(){
	$(document).on('change','.bonusAmountFilter',function(){
		var _bonusAmountFilter = $(this).val();
	   	$('.bonusAmountCheck').val(_bonusAmountFilter);
	   	$('.bonusAmountCheck').attr('checked','checked');
	});
});
$(document).ready(function(){
	$(document).on('change','.minDepositeAmpountFilter',function(){
		var _minDepositeAmpountFilter = $(this).val();
	   	$('.minDepositeAmpountCheck').val(_minDepositeAmpountFilter);
	   	$('.minDepositeAmpountCheck').attr('checked','checked');
	});
});
$(document).ready(function(){
	$(document).on('change','.maxBonusAmountFilter',function(){
		var _maxBonusAmountFilter = $(this).val();
	   	$('.maxBonusAmountCheck').val(_maxBonusAmountFilter);
	   	$('.maxBonusAmountCheck').attr('checked','checked');
	});
});
$(document).ready(function(){
	$(document).on('change','.maxCashoutFilter',function(){
		var _maxCashoutFilter = $(this).val();
	   	$('.maxCashoutCheck').val(_maxCashoutFilter);
	   	$('.maxCashoutCheck').attr('checked','checked');
	});
});
//
$(document).ready(function(){
	$(document).on('change','.maximumBettingFilter',function(){
		var _maximumBettingFilter = $(this).val();
		$(this).parent('.range1').find('output').text(_maximumBettingFilter + ' 원');
	   	$('.maximumBettingCheck').val(_maximumBettingFilter);
	   	$('.maximumBettingCheck').attr('checked','checked');
	});
});
$(document).ready(function(){
	$(document).on('change','.maxAwardAmountFilter',function(){
		var _maxAwardAmountFilter = $(this).val();
		$(this).parent('.range1').find('output').text(_maxAwardAmountFilter + ' 원');
	   	$('.maxAwardAmountCheck').val(_maxAwardAmountFilter);
	   	$('.maxAwardAmountCheck').attr('checked','checked');
	});
});
$(document).ready(function(){
	$(document).on('change','.maxPrizeMoneyFilter',function(){
		var _maxPrizeMoneyFilter = $(this).val();
		$(this).parent('.range1').find('output').text(_maxPrizeMoneyFilter + ' 원');
	   	$('.maxPrizeMoneyCheck').val(_maxPrizeMoneyFilter);
	   	$('.maxPrizeMoneyCheck').attr('checked','checked');
	});
});
$(document).ready(function(){
	$(document).on('change','.maxBettingAmountFilter',function(){
		var _maxBettingAmountFilter = $(this).val();
		$(this).parent('.range1').find('output').text(_maxBettingAmountFilter + ' 원');
	   	$('.maxBettingAmountCheck').val(_maxBettingAmountFilter);
	   	$('.maxBettingAmountCheck').attr('checked','checked');
	});
});
$(document).ready(function(){
	$(document).on('change','.minBettingAmountFilter',function(){
		var _minBettingAmountFilter = $(this).val();
		$(this).parent('.range1').find('output').text(_minBettingAmountFilter + ' 원');
	   	$('.minBettingAmountCheck').val(_minBettingAmountFilter);
	   	$('.minBettingAmountCheck').attr('checked','checked');
	});
});

$(document).ready(function(){
	$('.ask-panel-heading-filter').click(function(){
		if($(this).hasClass('collapsed')){
			$(this).find('span').addClass('rotate180');
		}else{
			$(this).find('span').removeClass('rotate180');
		}
	});
});
//
// $(document).ready(function(){
// 	$(document).on('change','.filter',function(){
// 	   	$("#search_form").submit();
// 	  	return false;
// 	});
// });



$(document).ready(function(){
	$(document).on('change','.filter',function(){
	   	//$("#search_form").submit();
	   	var data = $("#search_form").serialize();
	   	$.ajax({
            url: "sports-function-filter.php", // link of your "whatever" php
            type: "GET",
            //async: true,
            //cache: false,
            data: data, // all data will be passed here
            success: function(data){  
                $('.AJAX-response').html(data);
                $('.info').click(function(){
					$(this).parents('.ask-item-web-card').toggleClass('flipped');
				});
            }
        });
	});
});
$(document).ready(function(){
	$(document).on('change','.filter1',function(){
	   	//$("#search_form").submit();
	   	var data = $("#search_form").serialize();
	   	$.ajax({
            url: "sadari-filter-function.php", // link of your "whatever" php
            type: "GET",
            //async: true,
            //cache: false,
            data: data, // all data will be passed here
            success: function(data){  
                $('.AJAX-response').html(data);
                $('.info').click(function(){
					$(this).parents('.ask-item-web-card').toggleClass('flipped');
				});
            }
        });
	});
});

$(document).ready(function(){
	$(document).on('change','.filter2',function(){
	   	//$("#search_form").submit();
	   	var data = $("#search_form").serialize();
	   	$.ajax({
            url: "bonus-filter-function.php", // link of your "whatever" php
            type: "GET",
            //async: true,
            //cache: false,
            data: data, // all data will be passed here
            success: function(data){  
                $('.AJAX-response').html(data);
                $('.info').click(function(){
					$(this).parents('.ask-item-bonus-card').toggleClass('flipped');
				});
            }
        });
	});
});

$(document).ready(function(){
	$(document).on('change','.filter3',function(){
	   	//$("#search_form").submit();
	   	var data = $("#search_form").serialize();
	   	$.ajax({
            url: "mini-game-filter.php", // link of your "whatever" php
            type: "GET",
            //async: true,
            //cache: false,
            data: data, // all data will be passed here
            success: function(data){  
                $('.AJAX-response').html(data);
                $('.info').click(function(){
					$(this).parents('.ask-item-web-card').toggleClass('flipped');
				});
            }
        });
	});
});

//search
$(document).ready(function(){
	var searchTextHighlightVal = $('#searchTextHighlight').val();
	//alert(searchTextHighlightVal);
	$('.searchTextResult').text('Showing result for' + '    ' + searchTextHighlightVal);
	if($('.ask-cards').length == 0){
		$('.noResultFound').text('No result found...!');
	};

});
$(document).ready(function(){
	$('.site-coment-arrow').click(function(){
		$(this).find('.acc-drop').toggleClass('rotate180');
	});
});

$(document).ready(function(){
	$('.categoryComplaint').change(function(){
		//alert();
		var _issue = $(this).val();
		if(_issue == ''){
			alert('Please select one option.');
			$('#text-paste').html('');
		}else{
			$.ajax({
	            url: "complaint-text.php", // link of your "whatever" php
	            type: "POST",
	            //async: true,
	            //cache: false,
	            data: 'issue='+_issue, // all data will be passed here
	            success: function(data){  
	                $('#text-paste').html(data);
					$('#issue-heading').text(_issue);
	            }
	        });
		}
	});
});

$(document).ready(function(){
	// var checkuser = true;
	// var checkemail = true;
	// $('#tblUser_userId').change(function(){
	// 	$.ajax({
 //            url: "usercheck.php", // link of your "whatever" php
 //            type: "POST",
 //            data: 'data='+$(this).val(), // all data will be passed here
 //            success: function(data){  
 //               	if(data == 0){
 //               		$('.user-check-style').css("marginBottom","-6px");
 //               		$('.user-check-result').slideDown();
 //               		$('.user-check-result').text('User ID available');
 //               		$('#SIGNUPBUTTON').attr('disabled', false);
 //               		checkuser = false;
 //               	}else{
 //               		$('.user-check-style').css("marginBottom","-6px");
 //               		$('.user-check-result').slideDown();
 //               		$('.user-check-result').text('User ID already exist!!!');
 //               		$('#SIGNUPBUTTON').attr('disabled', true);
 //               		checkuser = true;
 //               	}
 //            }
 //        });
	// });
	$('#tblUser_email').change(function(){
		$.ajax({
            url: "emailcheck.php", // link of your "whatever" php
            type: "POST",
            data: 'data='+$(this).val(), // all data will be passed here
            success: function(data){  
               	if(data == 0){
               		$('.user-email-style').css("marginBottom","-6px");
               		$('.user-email-result').slideDown();
               		$('.user-email-result').text('Email ID available');
               		$('#SIGNUPBUTTON').attr('disabled', false);
               	}else{
               		$('.user-email-style').css("marginBottom","-6px");
               		$('.user-email-result').slideDown();
               		$('.user-email-result').text('Email ID already exist!!!');
               		$('#SIGNUPBUTTON').attr('disabled', true);
               	}
            }
        });
	});
	
	// $('.transparent-panel').click(function(){alert("gi");
		// var _dp = $(this).parents('.dynamic-panel');
		// $(_dp).find('.panel-heading').addClass('rotate90-deg');
		// $(_dp).siblings().find('.panel-heading').removeClass('rotate90-deg');
	// });
});




