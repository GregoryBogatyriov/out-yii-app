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
					showContact(res);// Вывод информации в модальном окне
			},
			error: function(){
				alert('Error');
			}
		});
	});
	
	
	/*Функция для вставки информации в модальное окно. В качестве параметра передаём название вида*/
	function showConfirm(confirm){
		$('#button-confirm .modal-body').html(confirm);
		$('#button-confirm').modal();
	}
	
	
	/*Модальное окно для подтверждения ip*/
	 $('.confirm-button').on('click', function(e){
		e.preventDefault();
		var city = $(this).data('city')
		
		$.ajax({
			url: '/cityes/cityes/confirm',
			data: {city: city},
			type: 'GET',
			success: function(res){
				if (!res) {alert('Ошибка!');}
				else //console.log(res);
				showConfirm(res);// Вывод информации в модальном окне
				setTimeout(function() {window.location.reload();}, 1000);
			},
			error: function(){
				alert('Error');
			}
		});
		
		
	}); 
	
	
	
	
	
	/*Функция для вставки информации в модальное окно. В качестве параметра передаём название вида*/
	function showConfirm(negative){
		$('#button-negative .modal-body').html(negative);
		$('#button-negative').modal();
	}
	
	
	/*Модальное окно для отрицания ip*/
	$('.negative-button').on('click', function(e){
		e.preventDefault();
		var city = $(this).data('city')
		
		$.ajax({
			url: '/cityes/cityes/negative',
			data: {city: city},
			type: 'GET',
			success: function(res){
				if (!res) {alert('Ошибка!');}
				else 
				showConfirm(res);// Вывод информации в модальном окне
			},
			error: function(){
				alert('Error');
			}
		});
		
	}); 
	
	
	
	
	
	
	/*Рейтинг голосование за отзыв*/
	$('#send-vote').on('click', function(e){
		e.preventDefault();
		var id_review = $('#vote').attr('review-id');// Получили id отзыва
		var rating = $('input:radio:checked').val();
		
		
		$.ajax({
			url: '/reviews/reviews/rating',
			data: {id_review: id_review, rating: rating},
			type: 'POST',
			success: function(res){
						$('#novotes').hide();
						$('#voterating').hide();
						$('#form-wrapper').html(res);
						//console.log(res);
			},
			error: function(){
				alert("Ошибка при голосовании");
			}
				
		});
		
	}); 
	
	
});











