$(document).ready(function(){
	formSubmit();
})

function formSubmit(){

	$('#FormLogin').submit(function(e){
		e.preventDefault()

		var dni = $('#txtDNI').val()
		var contra = $('#txtContra').val()
		
		var data = 'dni='+dni+'&contra='+contra;

		$.ajax({
			url:'dist/form/formcomen.php',
			type: 'POST',
			data : data,
			beforeSend: function(){
				console.log('enviando datos a la DB..')
			},
			success: function(resp){
				alert(resp)
				$('#FormLogin')[0].reset()
					
			}

		})
	})
	
}

