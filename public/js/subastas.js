$('.btn-danger').on('click', function(e){
    var txt;
    if (confirm("¿Esta seguro que quiere eliminar este registro?") == true) {
        txt = "Ud presionó eliminar!";
        e.preventDefault();
        var subastaId = $(this).attr('name');
    	//console.log(subastaId);
        /*
    	$.ajax({
    		url: js_base_url('subasta/eliminar/')+subastaId,
    		type:"POST",
    		data:{
    			'subastaId': subastaId
    		},
            success:function(response) {
    			location.reload();
    		},
    		error:function(){
    			alert("Error al eliminar producto.");
    		}
        });
        */
        location.href = js_base_url('subasta/eliminar/')+subastaId;
    }
    console.log(txt);



});
