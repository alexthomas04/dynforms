$(document).on('click', '.glyphicon-chevron-down', function(event) {
	event.preventDefault();
	$(this).removeClass('glyphicon-chevron-down');
	$(this).addClass('glyphicon-chevron-up');
});
$(document).on('click', '.glyphicon-chevron-up', function(event) {
	event.preventDefault();
	$(this).removeClass('glyphicon-chevron-up');
	$(this).addClass('glyphicon-chevron-down');
});
$(document).on('click', '.panel-heading > h3 > .glyphicon-chevron-down,.glyphicon-chevron-up', function(event) {
	event.preventDefault();
	var panel = $(this).closest('.panel');
	panel.children('.panel-body').toggle(400);
});