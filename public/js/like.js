$('.like').on('click', function(event) {
	event.preventDefault();
	quoteId = event.target.parentNode.parentNode.dataset['quoteid'];
	var isLike = true;

		$.ajax({
		method: 'POST',
		url: urlLike,
		data: {isLike: isLike, quoteId: quoteId, _token: token}
		})
		.done(function() {
			likes = parseInt($(event.target.parentNode.previousElementSibling).text());

			// Check the status of like, toggle fa heart icon, update likes count
			if($(event.target).hasClass('fa-heart')) {
				$(event.target).toggleClass('fa-heart fa-heart-o');
				$(event.target.parentNode.previousElementSibling).text(likes - 1);
			} else {
				$(event.target).toggleClass('fa-heart-o fa-heart');
				$(event.target.parentNode.previousElementSibling).text(likes + 1);
			}
		});

});