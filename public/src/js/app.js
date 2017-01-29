$('.voteUp').on('click', function(event) {
	event.preventDefault();
	quoteId = event.target.parentNode.parentNode.dataset['quoteid'];
	var isVote = 1;

		$.ajax({
		method: 'POST',
		url: urlVote,
		data: {isVote: isVote, quoteId: quoteId, _token: token}
		})
		.done(function() {
			console.log("isVote" + ' ' + isVote);
			votes = parseInt($(event.target.parentNode.nextElementSibling).text());

			if($(event.target).hasClass('fa-thumbs-o-up')) {

				if($(event.target.parentNode.nextElementSibling.nextElementSibling.children).hasClass("fa-thumbs-down")) {
					$(event.target.parentNode.nextElementSibling.nextElementSibling.children).toggleClass('fa-thumbs-down fa-thumbs-o-down')
					$(event.target.parentNode.nextElementSibling).text(votes+2);
				}
				$(event.target).toggleClass('fa-thumbs-o-up fa-thumbs-up');
				$(event.target.parentNode.nextElementSibling).text(votes-1);
			}

			$(event.target).toggleClass('fa-thumbs-up fa-thumbs-o-up');
			$(event.target.parentNode.nextElementSibling).text(votes+1);
 
			
		});

});

$('.voteDown').on('click', function(event) {
	event.preventDefault();
	quoteId = event.target.parentNode.parentNode.dataset['quoteid'];
	var isVote = -1;
	$.ajax({
		method: 'POST',
		url: urlVote,
		data: {isVote: isVote, quoteId: quoteId, _token: token}
	})
		.done(function() {
			console.log("isVote" + ' ' + isVote);
			votes = parseInt($(event.target.parentNode.previousElementSibling).text());
			$(event.target).toggleClass('fa-thumbs-o-down fa-thumbs-down');
			if($(event.target.parentNode.previousElementSibling.previousElementSibling.children).hasClass("fa-thumbs-up")) {

				$(event.target.parentNode.previousElementSibling.previousElementSibling.children).toggleClass('fa-thumbs-up fa-thumbs-o-up')
				$(event.target.parentNode.previousElementSibling).text(votes-2);
				// console.log(votes);

			}
			$(event.target.parentNode.previousElementSibling).text(votes-1);
			// console.log(votes);

   //          event.target.innerText = isVote ? event.target.innerText == 'DisVote' ? 'You don\'t like this Quote' : 'DisVote' : event.target.innerText == 'Like' ? 'You like this Quote' : 'Like';
   //          if (isVote) {
   //              event.target.previousElementSibling.previousElementSibling.innerText = 'Like';
   //          } else {
   //              event.target.nextElementSibling.nextElementSibling.innerText = 'DisVote';
			// }		
		});
});

