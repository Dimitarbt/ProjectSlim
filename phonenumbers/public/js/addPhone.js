    	$(function(){
			
			$(document.body).on('click', '.btn-remove-phone' ,function(){
				$(this).closest('.phone-input').remove();
			});
			
			
			$('.btn-add-phone').click(function(){

				var index = $('.phone-input').length + 1;
				
				$('.phone-list').append(''+
						'<div class="input-group phone-input">'+
							
							'<input type="text" name="phone['+index+']" class="form-control" placeholder="+ 389 XX XXX XXX" />'+
							
							'<span class="input-group-btn">'+
								'<button class="btn btn-danger btn-remove-phone" type="button"><span class="glyphicon glyphicon-remove"></span></button>'+
							'</span>'+
						'</div>'
				);

			});
			
		});