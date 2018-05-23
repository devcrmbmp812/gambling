$(document).ready(function(){

	// forum Details page
	// coment and replies slide up and down
	$('.replies').click(function(){
		var _dI = $(this).data('id'); //data Id
		var _dPI = $(this).data('parentid'); //data parent Id
		var _dCI = $(this).data('child'); //data child 
		if(_dCI == 1){
			$(this).find('i').toggleClass( "fa-chevron-down fa-chevron-up");
			$(this).parents('.Post.undefined.CommentPost').siblings('.post-comment-'+_dPI+'-'+_dI).slideToggle();
			//$('.post-comment-'+_dPI+'-'+_dI).slideToggle();
		}else if (_dCI == 2){
			$(this).find('i').toggleClass( "fa-chevron-down fa-chevron-up");
			$(this).parents('.Post.undefined.ReplyPost').siblings('.post-comment-comment-'+_dPI+'-'+_dI).slideToggle();
			//$('.post-comment-comment-'+_dPI+'-'+_dI).slideToggle();
		}
	});

	// like and dsilike lists
	$('.like-dislike-count').click(function(){
		var _cAt = $(this).data('cat');
		$('#likeDislikeModal').find('.modal-title').text(_cAt);
	});

	//text editor
	$('.text-area-container-parent').width($('.betting-forum-details-list-main').width());
	$('#removeEditorContainer').click(function(){
		$(this).parents('.text-area-container-parent').hide();
	});
	$('.open-reply-editor').click(function(){
		if($(this).data('check') > 0){
			$('#topicResponseIndex').val($(this).data('index'));
			$('#topicParentId').val($(this).data('parentid'));
			$('.text-area-container-parent').show();
		}else{
			alert("Please login to reply!!!");
		}
	});




	// list page
	$('.text-area-container-parent-list').width($('.forum-list-container').width());
	$('.start-discussion a').click(function(){
		if($(this).data('check') > 0){
			$('.text-area-container-parent-list').show();
		}else{
			alert("Please login to start discussion!!!");
		}
	});
	$('#removeEditorContainerlist').click(function(){
		$(this).parents('.text-area-container-parent-list').hide();
	});

	$('#topicFiles').on('change', function(e){
		var files = e.target.files;
		$.each(files, function(i, file){
			var reader = new FileReader();
			reader.readAsDataURL(file);
			reader.onload = function(e){
				var template = '<li>'+
								'<a href="#">'+
								'<img src="'+e.target.result+'" alt="">'+
								'</a>'+
								//'<button type="button" class="btn btn-danger btn-xs btn-del-img delImg">'+
								//'<i class="fa fa-times-circle" aria-hidden="true"></i>'+
								//'</button>'+
								'</li>';
				
				$('.forum-image-container ul').append(template);
			};
		});
		$('.forum-image-container').show();
		$('.forum-editor').css("padding-top","140px");
	});

	//like dislike change
	$('.likedislikeclick').click(function(){
		var _pID = $(this).data('parentid');
		var _tID = $(this).data('topicueid');
		var _rUN = $(this).data('enabled');
		var _sTATE = $(this).data('state');
		if(_rUN == 0 && _sTATE == 1){
			alert('Please login first to like this post');
		}else if(_rUN == 0 && _sTATE == 0){
			alert('Please login first to dislike this post');
		}else{
			//alert('free to like or dislike');
			$.ajax({
	            url: "ajax/commentlikedislike.php", // link of your "whatever" php
	            type: "POST",
	            //async: true,
	            //cache: false,
	            data: 'parentid='+_pID+'&topicueid='+_tID+'&state='+_sTATE+'&id='+_rUN, // all data will be passed here
	            success: function(data){  
	                alert(data);
	                //location.reload();
	            }
	        });
		}
	});


	// spam 

	$('.spam-check').click(function(){
		var _psID = $(this).data('parentid');
		var _tsID = $(this).data('topicueid');
		var _rsUN = $(this).data('check');
		//var _sTATE = $(this).data('state');
		if(_rsUN > 0){
			//alert('free to like or dislike');
			$.ajax({
	            url: "ajax/spam.php", // link of your "whatever" php
	            type: "POST",
	            //async: true,
	            //cache: false,
	            data: 'parentid='+_psID+'&topicueid='+_tsID+'&id='+_rsUN, // all data will be passed here
	            success: function(data){  
	                alert(data);
	                //location.reload();
	            }
	        });
		}else{
	        alert('Please login first to spam this post');
		}
	});


	//edit

	// $('.edit-post-forum').click(function(){ 
	// 	var _peID = $(this).data('parentid');
	// 	var _teID = $(this).data('topicueid');
	// 	var _reUN = $(this).data('check');
	// 	var _eID = $(this).data('editid');
	// 	if(_reUN == 1){
	// 		//alert('free to like or dislike');
	// 		$.ajax({
	//             url: "ajax/edit-post-forum.php", // link of your "whatever" php
	//             type: "POST",
	//             dataType: "json",
	//             //async: true,
	//             //cache: false,
	//             data: 'parentid='+_peID+'&topicueid='+_teID+'&id='+_reUN+'&eid='+_eID, // all data will be passed here
	//             success: function(data){  
	//                 //alert(data["topicUniqueId"]);
	//                 $('.text-area-container-parent').show();
	//                 $('.text-area-container-parent').find()
	                
	//             }
	//         });
	// 	}else{
	//         alert('You are not admin');
	// 	}
	// });



	var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }

    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }

});