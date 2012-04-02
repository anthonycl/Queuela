// Return a helper with preserved width of cells
var fixHelper = function(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
};

$(function() {
	if($('#admin-task-sort').length != 0) {
		var taskTable = $('#admin-task-sort tbody');
	
		taskTable.sortable({
			helper: fixHelper,
			update: function() {
				sort = taskTable.sortable('serialize');
				
				console.log(sort);
				
				$.ajax({
					url: '/admin/companies/projects/tasks/updatesort',
					type: 'post',
					data: sort,
					error: function(){
						alert("There was a problem while trying to save your new sort. Please try again.");
						//window.location = window.location.pathname; //$(location).attr('href');
					}
				});
			}
		}).disableSelection();
	}

	if($('textarea.editor-full').length != 0) {
		var config = {
			coreStyles_bold	: { element : 'b' },
			coreStyles_italic : { element : 'i' },
	
			fontSize_style :
			{
				element		: 'font',
				attributes	: { 'size' : '#(size)' }
			}
		};

		$('textarea.editor-full').ckeditor(config);
	}

	if($('table.prettify').length != 0) {
		$('table.prettify').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
	}

	if($('select.multiselect').length != 0) {
		$("select.multiselect").chosen().change(function(a, b, c){
			console.log(a);
			console.log(b);
			console.log(c);
		});
	}

	if($('#task-block-chart').length != 0) {
		var block_spacing = parseInt($('#task-block-chart #block_spacing').val());
		var width = 0;

		$("#task-block-chart #inner .task").each(function(){
			var paddingLeft = parseInt($(this).css('padding-left').replace('px',''));
			var paddingRight = parseInt($(this).css('padding-right').replace('px',''));
			width = width + $(this).width() + paddingLeft + paddingRight; // For Padding
		});
		
		$("#task-block-chart #inner").css("width", width);

		for(i=0;i<width;i=i+block_spacing) {
			$("#task-block-chart #task-block-dates").append('<div style="display: inline-block;">'+(i/block_spacing+1)+'</div>');
		}
	}
});

