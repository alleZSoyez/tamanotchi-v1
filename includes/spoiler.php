<script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>

<script>
	function spoilerButton(text, button,showTxt,hideTxt){
		$(document).ready(function() {
			$(button).val(showTxt);
			$(button).click(function() {
				if($(text).css("display")=="none") {
					$(text).css({"display":"block"});     
					$(button).val(hideTxt);}
				else {
					$(text).css({"display":"none"});   
					$(button).val(showTxt);}
				});
			}
		);
	}
</script>
