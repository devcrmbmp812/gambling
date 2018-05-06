 $(document).ready(function(){
// 	$('.notificationCount').text('0');
	var _login = $('#notification-login-id').val();

	//sports notification
	$.ajax({
        url: "ajax/notificationSportsCommentUser.php", 
        type: "POST",
        data: 'id='+_login, 
        success: function(data){  
            $('.notification-siteAdmin').append(data);
            $('.paste-notification').append(data);
            var notycount = $('.paste-notification a').length;
			if(notycount == 0){
				$('.notificationCount').text('0');
			}else{
                $('.notificationCount').show();
				$('.notificationCount').text(notycount);
				$('.hideOnNotification').hide();
			}
        }
    });

    //bonus notification
	$.ajax({
        url: "ajax/notificationBonusCommentUser.php", 
        type: "POST",
        data: 'id='+_login, 
        success: function(data){  
            $('.notification-siteAdmin').append(data);
            $('.paste-notification').append(data);
            var notycount = $('.paste-notification a').length;
			if(notycount == 0){
				$('.notificationCount').text('0');
			}else{
                $('.notificationCount').show();
				$('.notificationCount').text(notycount);
				$('.hideOnNotification').hide();
			}
        }
    });

    //Sadari notification
	$.ajax({
        url: "ajax/notificationSadariCommentUser.php", 
        type: "POST",
        data: 'id='+_login, 
        success: function(data){  
            $('.notification-siteAdmin').append(data);
            $('.paste-notification').append(data);
            var notycount = $('.paste-notification a').length;
			if(notycount == 0){
				$('.notificationCount').text('0');
			}else{
                $('.notificationCount').show();
				$('.notificationCount').text(notycount);
				$('.hideOnNotification').hide();
			}
        }
    });

    //news notification
	$.ajax({
        url: "ajax/notificationNewsCommentUser.php", 
        type: "POST",
        data: 'id='+_login, 
        success: function(data){  
            $('.notification-siteAdmin').append(data);
            $('.paste-notification').append(data);
            var notycount = $('.paste-notification a').length;
			if(notycount == 0){
				$('.notificationCount').text('0');
			}else{
                $('.notificationCount').show();
				$('.notificationCount').text(notycount);
				$('.hideOnNotification').hide();
			}
        }
    });

    //complaint notification
	$.ajax({
        url: "ajax/userComplaintResponse.php", 
        type: "POST",
        data: 'id='+_login, 
        success: function(data){  
            $('.notification-siteAdmin').append(data);
            $('.paste-notification').append(data);
            var notycount = $('.paste-notification a').length;
			if(notycount == 0){
				$('.notificationCount').text('0');
			}else{
                $('.notificationCount').show();
				$('.notificationCount').text(notycount);
				$('.hideOnNotification').hide();
			}
        }
    });
 });