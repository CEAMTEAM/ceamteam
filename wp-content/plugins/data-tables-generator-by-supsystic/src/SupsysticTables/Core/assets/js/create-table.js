(function($, app) {

	$(document).ready(function () {

		$('a[href="admin.php?page=supsystic-tables#add"]').attr('href', '#add');

		var $createBtn = $('.create-table'),
			$error = $('#formError'),
			$input = $('#addDialog_title'),
			$cols = $('#addDialog_cols'),
			$rows = $('#addDialog_rows'),
			$dialog = $('#addDialog').dialog({
				width: 480,
				modal: true,
				autoOpen: false,
				close: function () {
					window.location.hash = '';
				},
				buttons: {
					Create: function (event) {
						var $button = $(event.target),
							buttonInitHtml = $button.html();

						if ($input.val().length == 0 || $input.val().length > 255) {
							$error.find('p').text('Title can\'t be empty or more than 255 characters');
							$error.fadeIn();
							return;
						}

						if ((isNaN($cols.val()) || !$cols.val().length ) || (isNaN($rows.val()) || !$rows.val().length)) {
							$error.find('p').text('Columns and rows value must be a numbers and not empty.');
							$error.fadeIn();

							return;
						}

						if (parseInt($cols.val()) < $cols.attr('min')) {
							$error.find('p').text('Columns value can\'t be less then ' + $cols.attr('min') + '.');
							$error.fadeIn();

							return;
						}

						if (parseInt($rows.val()) < $rows.attr('min')) {
							$error.find('p').text('Rows value can\'t be less then ' + $rows.attr('min') + '.');
							$error.fadeIn();

							return;
						}

						$button.html(app.createSpinner());
						$error.fadeOut();

						app.request({ module: 'tables', action: 'create'}, { title: $input.val(), rows: $rows.val(), cols: $cols.val() })
							.done(function (response) {
								window.location.href = response.url + '&cols=' + $cols.val() + '&rows=' + $rows.val();
							}).fail(function (message) {
								$error.find('p').text(message);
								$error.fadeIn();
							}).always(function () {
								$button.html(buttonInitHtml);
							});
					},
					Cancel: function () {
						$dialog.dialog('close');
					}
				}
			});

		$input.on('focus', function () {
			$error.fadeOut();
		});

		$createBtn.on('click', function () {
			$dialog.dialog('open');
		});

		$(window).on('hashchange', function () {
			if (window.location.hash === '#add') {
				// To prevent error if data not loaded completely
				setTimeout(function() {
					$dialog.dialog('open');
				}, 500);
			}
		}).trigger('hashchange');
	});

})(jQuery, window.supsystic.Tables);