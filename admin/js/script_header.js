$(document).ready(function(){
	ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        });

    $('#selectAllBoxes').click(function(event){
    	if(this.checked){
    		$('.checkBoxes_post').each(function(){
    			this.checked = true;
    		});
    	}else{
    		$('.checkBoxes_post').each(function(){
    			this.checked = false;
    		});
    	}
    });
});

