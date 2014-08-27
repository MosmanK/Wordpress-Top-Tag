<?php 
/*
Plugin Name: Wordpress Top Tags
Plugin URI: http://batuhankucukali.com
Description: Aradığınız kriterde en çok aranan anahtar kelimeleri bulur.
Version: 0.1
Author: Batuhan KÜÇÜKALİ
Author URI: http://batuhankucukali.com
License: GNU
*/	

function adding_custom_meta_boxes( $post_type, $post ) {
    add_meta_box( 
        'top-tag',
        __( 'Top Tag' ),
        'tag_function',
        'post',
        'normal',
        'default'
    );
}

add_action( 'add_meta_boxes', 'adding_custom_meta_boxes', 10, 2 );


function tag_function() {

?>	

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
	
	//  Ajax
	$("#submit").click(function(){
		
	 var keyword = $("#keyword").val();
		
		$.ajax({
		
			type: "post",
			url : "<?php echo plugins_url(); ?>/toptag/ajax.php",
			data: {"keyword":keyword},
			dataType: "json",
			success: function(data) {
				
				if(data.data != '') {
					$("#new-tag-post_tag").val(data.data);
				}else{
					$(".warning").show().html("Seçtiğiniz kelimede etiket yoktur!");
				}
			}	
		});
		return false;
	});
	
	
	
});
</script> 
<p class="howto">Anahtar kelime giriniz.</p>
 <form id="tagform" action="" method="post" onsubmit="return false">
	<input id="keyword" class="form-input-tip" type="text" name="keyword"/>
	<input id="submit" class="button" type="submit" value="Getir"/>
 </form>
<p class="howto warning" style="display:none; color:#BF0000"></p>
<?php 
} 
?>