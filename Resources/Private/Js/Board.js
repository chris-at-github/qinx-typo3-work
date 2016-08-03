$('.card').each(function() {
	var card = $(this);

	card.bind('click', function(e) {
		window.location.href = card.data('target');
	});
})