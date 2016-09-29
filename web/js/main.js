$(document).ready(function(){
    
	/*Функция для вывода информации в модальном окне*/
	function showContact(contactmodal){
		$('#author-contact .modal-body').html(contactmodal);
		$('#author-contact').modal();
	}
	
	
	
	/*Функция для модального окна*/
	$('.authorreviews').on('click', function(e){
		e.preventDefault();
		//return false;
		var id_author = $(this).data('id_author')
		
		$.ajax({
			url: '/reviews/reviews/contactmodal',
			data: {id_author: id_author},
			type: 'GET',
			success: function(res){
				if (!res)
					alert('Ошибка!');
				else 
					//console.log(res);
					showContact(res);// Вывод информации в модальном 
			},
			error: function(){
				alert('Error');
			}
		});
	});
	
});











