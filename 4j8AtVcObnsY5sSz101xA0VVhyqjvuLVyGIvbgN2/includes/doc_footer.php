<!--<script src="js/jquery.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="js/custom.js"></script>
<script src="js/jquery.wysiwyg.js"></script>
<!-- <script src="js/cycle.js"></script>
<script src="js/flot.js"></script>
<script src="js/flot.resize.js"></script>
<script src="js/flot-time.js"></script>
<script src="js/flot-pie.js"></script>
<script src="js/flot-graphs.js"></script>
<script src="js/cycle.js"></script> -->
<script src="js/jquery.tablesorter.min.js"></script>
<script src="../assets/js/jquery.rateyo.min.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="lib/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link href="lib/fancybox/jquery.fancybox.js">
<script type="text/javascript">
	$(document).ready(function(){
	    $('#myTable').DataTable();
	});
// Feature slider for graphs

// $('.cycle').cycle({
// 	fx: "scrollHorz",
// 	timeout: 0,
//     slideResize: 0,
//     prev:    '.left-btn', 
//     next:    '.right-btn'
// });

// </script>

<script type="text/javascript">

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

	// $('.ksc_delete').click(function(){
	// 	var mini = $('select[name=ksc_miniGame]').val();
	// 	if(mini == ''){
	// 		alert('Please select option.');
	// 	}else{
	// 		$.ajax({ 
	// 			url: "deleteminigame.php", // link of your "whatever" php
	// 			type: "POST",
	// 			data: 'mini='+mini, // all data will be passed here
	// 			success: function(data){  
	// 				location.reload();
	// 			}
	// 		});
	// 	}
	// });

	$('.ksc_delete').click(function(){
		var minigamedel = $('.miniGame').val();
		if(minigamedel == ''){
			alert('Please select option.');
		}else{
			//alert(minigamedel);die();
			$.ajax({ 
				url: "addMiniGame.php", // link of your "whatever" php
				type: "POST",
				data: 'mini-game-delete='+minigamedel, // all data will be passed here
				success: function(data){  
					$('.miniGame').html(data);
					location.reload();
				}
			});
		}
	});

	$('.ksc_betting_delete').click(function(){
		var bettingOptiondel = $('.bettingOption').val();
		if(bettingOptiondel == ''){
			alert('Please select option.');
		}else{
			//alert(betting);
			$.ajax({ 
				url: "addMiniGame.php", // link of your "whatever" php
				type: "POST",
				data: 'bettingOptiondel-delete='+bettingOptiondel, // all data will be passed here
				success: function(data){  
					$('.bettingOption').html(data);
					location.reload();
				}
			});
		}
	});

	$('#dynamic-sports').change(function(){
		var _val = $(this).val();
		$.ajax({ 
		    url: "update-bonus-sports-image.php", // link of your "whatever" php
		    type: "GET",
		    //async: true,
		    //cache: false,
		    data: 'sportsImage='+_val, // all data will be passed here
		    success: function(data){  
		        var str = data;
				var res = str.split("*");
				$('#bonusImageName').val(res[1]);
				$('#sportsImagesname').val(res[0]);
				$('#spotsBonuslink').val(res[3]);
				$('#spotsBonusJoincode').val(res[2]);
				alert('Sports content selected');
		    }

		});
	});

	$(document).ready(function(){
		$('.fancy').fancybox();
	});

</script>

<script src="js/jquery.checkbox.min.js"></script>

</body>

</html>