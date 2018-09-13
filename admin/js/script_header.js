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
    
    console.log("hello");
    
//    function loadUsersOnline() {
//        $.get("function.php?online_users=result",function(data){
//            console.log("vhj");
//            $(".usersonline").text("datga"); 
//        });
//    }
//
//    loadUsersOnline();
//
//    setInterval(function(){
//        loadUsersOnline();
//    },500);
});

