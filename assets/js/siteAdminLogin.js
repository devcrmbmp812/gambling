$(document).ready(function(){
	var _sitename = $('#notification-site-name').val();
	
	//sports notification
	$.ajax({
        url: "ajax/notificationSportsCommentSiteAdmin.php", 
        type: "POST",
        data: 'siteName='+_sitename, 
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
    //sports notification from admin
	$.ajax({
        url: "ajax/notesportscomadminresp.php", 
        type: "POST",
        data: 'siteName='+_sitename, 
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
        url: "ajax/notificationBonusCommentSiteAdmin.php",
        type: "POST",
        data: 'siteName='+_sitename, 
        success: function(data){  
            $('.notification-siteAdmin').append(data);
            $('.paste-notification').append(data);
            //alert(data);
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
    //bonus admin notification
    $.ajax({
        url: "ajax/notebonuscomadminresp.php",
        type: "POST",
        data: 'siteName='+_sitename, 
        success: function(data){  
            $('.notification-siteAdmin').append(data);
            $('.paste-notification').append(data);
            //alert(data);
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
    //sadari notification
    $.ajax({
        url: "ajax/notificationSadariCommentSiteAdmin.php",
        type: "POST",
        data: 'siteName='+_sitename, 
        success: function(data){  
            $('.notification-siteAdmin').append(data);
            $('.paste-notification').append(data);
            //alert(data);
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
    //sadari admin notification
    $.ajax({
        url: "ajax/notesadaricomadminresp.php",
        type: "POST",
        data: 'siteName='+_sitename, 
        success: function(data){  
            $('.notification-siteAdmin').append(data);
            $('.paste-notification').append(data);
            //alert(data);
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

    //sadari admin notification
    $.ajax({
        url: "ajax/complaintNotificationSiteAdmin.php",
        type: "POST",
        data: 'siteName='+_sitename, 
        success: function(data){  
            $('.notification-siteAdmin').append(data);
            $('.paste-notification').append(data);
            //alert(data);
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

    //sadari admin notification
    $.ajax({
        url: "ajax/complaintNotificationrespSiteAdmin.php",
        type: "POST",
        data: 'siteName='+_sitename, 
        success: function(data){  
            $('.notification-siteAdmin').append(data);
            $('.paste-notification').append(data);
            //alert(data);
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