<script src="js/jquery.min.js"></script>


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



<!-- <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript">

	//$(document).ready(function(){
	    //$('#testTable').DataTable();
	//});

// // Feature slider for graphs

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
			//alert(betting);
			$.ajax({ 
				url: "addMiniGame.php", // link of your "whatever" php
				type: "POST",
				data: 'mini-game-delete='+minigamedel, // all data will be passed here
				success: function(data){  
					$('.miniGame').html(data);
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
					//alert(data);
					$('.bettingOption').html(data);
				}
			});
		}
	});

</script>

<script src="js/jquery.checkbox.min.js"></script>

</body>

</html>