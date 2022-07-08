
$(document).ready(function () {
	var tableColumns = [];
	$.each($('#table_main th'), function(i,v) {
		if ($(this).data('included') == 'yes') {
			tableColumns.push(i);
		}
	});

	var table = $("#table_main").DataTable({ "order": [[0, "desc"]],
	buttons: [
	    {
			extend: 'excel',
			exportOptions: {
				columns: tableColumns
			}
	    },
	    {
			extend: 'pdf',
			exportOptions: {
				columns: tableColumns
			}
	    }
	] });
	$(document).on('click', '#generateReport-Excel', function () {
		table.button('0').trigger();
	});
	$(document).on('click', '#generateReport-PDF', function () {
		table.button('1').trigger();
	});
});
