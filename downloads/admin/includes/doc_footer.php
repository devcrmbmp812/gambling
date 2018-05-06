<script src="js/jquery.min.js"></script>
<script src="js/jquery.wysiwyg.js"></script>
<script src="js/custom.js"></script>
<script src="js/cycle.js"></script>
<script src="js/flot.js"></script>
<script src="js/flot.resize.js"></script>
<script src="js/flot-time.js"></script>
<script src="js/flot-pie.js"></script>
<script src="js/flot-graphs.js"></script>
<script src="js/cycle.js"></script>
<script src="js/jquery.tablesorter.min.js"></script>
<script src="../assets/js/jquery.rateyo.min.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="lib/tinymce/js/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
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
</script>
<script src="js/jquery.checkbox.min.js"></script>
</body>
</html>