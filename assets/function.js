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
	
	$(window).scroll(function(){
		if($('#show-pop-up').size() > 0){
			var wScroll = $(this).scrollTop();
			if(wScroll > $('#show-pop-up').offset().top){
				$('.fixed-top').show();
			}
			if(wScroll <= $('#show-pop-up').offset().top){
				$('.fixed-top').hide();
			}
		}
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
		var wScroll = $(this).scrollTop();
		if(wScroll > $('#show-pop-up').offset().top){
			$('.fixed-top').show().width(_wi);
		}
		if(wScroll <= $('#show-pop-up').offset().top){
			$('.fixed-top').hide();
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


// http://www.w3schools.com/bootstrap/bootstrap_ref_js_modal.asp

// $(document).ready(function(){
// 	$('.responseMsg').hide();
// 	$('.responseButton').click(function(){
// 		var t = $(this).parents('.content');
// 		var _t = $(t).closest('.responseMsg').toggle();
// 		alert(_t);
// 	});
// });

	// chat
// $(document).ready(function(){
// 	//var countChatBox = $('.chat').size();
// 	$('.chatboxContainer').css({
// 		"position":"fixed",
// 		"bottom":0,
// 		"right":0,
// 		"z-index":"1000"
// 	});

// 	$.chatBoxDisplay = function(m){
// 		if(m){
// 			$('.minimize').click(function(){
// 				$(this).addClass('fa-minus-square-o').removeClass('fa-plus-square-o');
// 				$(this).parents('.chatBox').find('.chatContent').show();
// 			});
// 			$.cookie('chatBoxShow', 'YES');
// 		} else {
// 			$('.minimize').click(function(){
// 				$(this).removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
// 				$(this).parents('.chatBox').find('.chatContent').hide();
// 			});
// 			$.cookie('chatBoxShow', 'NO');
// 		}
// 	};

// 	$('#showChatBox').click(function(){
// 		$.chatBoxDisplay(($.cookie('chatBoxShow') != 'YES'));
// 	});

// 	$.chatBoxDisplay(($.cookie('chatBoxShow') == 'YES'));
// });

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
		var _input = '<input type="file" name="complaintFiles[]" class="form-control complaintFiles" />';
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
	var searchTextHighlightVal = $('#searchTextHighlight').val();
	//alert(searchTextHighlightVal);
	$('.searchTextResult').text('Showing result for' + '    ' + searchTextHighlightVal);
	if($('.ask-cards').length == 0){
		$('.noResultFound').text('No result found...!');
	};

});

