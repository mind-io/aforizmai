$(document).on('click', ".like", function(event) {
	event.preventDefault();
	quoteId = event.target.parentNode.parentNode.dataset['quoteid'];
	var isLike = 1;
	// var $thumb = $(this).find('i.fa');

	console.log(isLike);
	// console.log($thumb);
	
	$.ajax({
		method: 'POST',
		url: urlLike,
		data: {isLike: isLike, quoteId: quoteId, _token: token}
	})
		.done(function() {
			$('.thumbs-up').toggleClass('fa-thumbs-o-up fa-thumbs-up');
		
   //          event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this Quote' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this Quote' : 'Dislike';
   //          if (isLike) {
   //              event.target.nextElementSibling.nextElementSibling.innerText = 'Dislike';
   //          } else {
   //              event.target.previousElementSibling.previousElementSibling.innerText = 'Like';
			// }		
		});
});

$('.dislike').on('click', function(event) {
	event.preventDefault();
	quoteId = event.target.parentNode.parentNode.dataset['quoteid'];
	var isLike = -1;
	console.log(isLike);
	$.ajax({
		method: 'POST',
		url: urlLike,
		data: {isLike: isLike, quoteId: quoteId, _token: token}
	})
		.done(function() {
			$('.thumbs-down').toggleClass('fa-thumbs-o-down fa-thumbs-down');

   //          event.target.innerText = isLike ? event.target.innerText == 'Dislike' ? 'You don\'t like this Quote' : 'Dislike' : event.target.innerText == 'Like' ? 'You like this Quote' : 'Like';
   //          if (isLike) {
   //              event.target.previousElementSibling.previousElementSibling.innerText = 'Like';
   //          } else {
   //              event.target.nextElementSibling.nextElementSibling.innerText = 'Dislike';
			// }		
		});
});
