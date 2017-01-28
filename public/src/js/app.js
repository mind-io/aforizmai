// $(document).on('click', ".like", function(event) {
$('.like').on('click', function(event) {
	event.preventDefault();
	quoteId = event.target.parentNode.parentNode.dataset['quoteid'];
	var isLike = 1;

		$.ajax({
		method: 'POST',
		url: urlLike,
		data: {isLike: isLike, quoteId: quoteId, _token: token}
		})
		.done(function() {
			// $('#quote_' + quoteId).click(function() {
			// 	$(this).find('.thumbs-up').toggleClass('fa-thumbs-o-up fa-thumbs-up')
			// });
			// $('.thumbs-up').toggleClass('fa-thumbs-o-up fa-thumbs-up');
			console.log(isLike);
			if( $(event.target).hasClass("fa-thumbs-o-up")) {
				$(event.target).removeClass("fa-thumbs-o-up").addClass("fa-thumbs-up");
			} else {
				$(event.target).removeClass("fa-thumbs-up").addClass("fa-thumbs-o-up");
			}
		
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

