
    $("[name=range]").on("change", function() {
    $("[for=range]").val(this.value +".00  $" );
    }).trigger("change");

    $("[name=range1]").on("change", function() {
    $("[for=range1]").val(this.value +".00  $" );
    }).trigger("change");

    $("[name=range2]").on("change", function() {
    $("[for=range2]").val(this.value +".00  $" );
    }).trigger("change");


 //    function myFunction(imgs) {
	//     var expandImg = document.getElementById("expandedImg");
	//     var imgText = document.getElementById("imgtext");
	//     expandImg.src = imgs.src;
	//     imgText.innerHTML = imgs.alt;
	//     expandImg.parentElement.style.display = "block";
	// }