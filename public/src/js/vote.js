$('.voteUp').on('click', function(event) {
	event.preventDefault();
	quoteId = event.target.parentNode.parentNode.dataset['quoteid'];
	var isVote = 1;
	console.log("isVote" + ' ' + isVote);

		$.ajax({
		method: 'POST',
		url: urlVote,
		data: {isVote: isVote, quoteId: quoteId, _token: token}
		})
		.done(function() {
			votes = parseInt($(event.target.parentNode.nextElementSibling).text());

			// Check the state of voteUp, toggle fa thumbs icon, update votes badge
			if($(event.target).hasClass('fa-thumbs-up')) {
				$(event.target).toggleClass('fa-thumbs-up fa-thumbs-o-up');
				$(event.target.parentNode.nextElementSibling).text(votes - 1);
			} else if($(event.target.parentNode.nextElementSibling.nextElementSibling.children).hasClass("fa-thumbs-down")) {
				$(event.target.parentNode.nextElementSibling.nextElementSibling.children).toggleClass('fa-thumbs-down fa-thumbs-o-down')
				$(event.target).toggleClass('fa-thumbs-up fa-thumbs-o-up');
				$(event.target.parentNode.nextElementSibling).text(votes + 2);
			} else {
				$(event.target).toggleClass('fa-thumbs-o-up fa-thumbs-up');
				$(event.target.parentNode.nextElementSibling).text(votes + 1);
			}
			
		});

});

$('.voteDown').on('click', function(event) {
	event.preventDefault();
	quoteId = event.target.parentNode.parentNode.dataset['quoteid'];
	var isVote = -1;
	console.log("isVote" + ' ' + isVote);

	$.ajax({
		method: 'POST',
		url: urlVote,
		data: {isVote: isVote, quoteId: quoteId, _token: token}
	})
		.done(function() {
			votes = parseInt($(event.target.parentNode.previousElementSibling).text());
			
			if($(event.target).hasClass('fa-thumbs-down')) {
				$(event.target).toggleClass('fa-thumbs-down fa-thumbs-o-down');
				$(event.target.parentNode.previousElementSibling).text(votes + 1);
			} else if($(event.target.parentNode.previousElementSibling.previousElementSibling.children).hasClass("fa-thumbs-up")) {
				$(event.target.parentNode.previousElementSibling.previousElementSibling.children).toggleClass('fa-thumbs-up fa-thumbs-o-up')
				$(event.target).toggleClass('fa-thumbs-down fa-thumbs-o-down');
				$(event.target.parentNode.previousElementSibling).text(votes - 2);
			} else {
				$(event.target).toggleClass('fa-thumbs-o-down fa-thumbs-down');
				$(event.target.parentNode.previousElementSibling).text(votes - 1);
			}

		});

});

