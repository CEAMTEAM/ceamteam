g_stbWindowHeight = 0;
(function ($, app, undefined) {
	$(document).ready(function() {
		g_stbWindowHeight = $(window).width() > 810 ? $(window).height() * 0.7 : $(window).height();	// 810px is mobile responsive width

		var tableId = app.getParameterByName('id'),
			tablesModel = app.Models.Tables,
			editor = new Handsontable(document.getElementById('tableEditor'), {
				height: g_stbWindowHeight,
				renderAllRows: false,		// To prevent losing of rows for huge tables (need to check in future is it all right now?)
				colWidths: 100,
				rowHeaders: true,
				colHeaders: true,
				fixedRowsTop: 0,
				fixedColumnsLeft: 0,
				comments: true,
				contextMenu: true,
				formulas: true,
				/*fillHandle: {
					autoInsertRow: false		// Disable adding of new row during drag-down cell via right bottom corner
				},*/
				manualRowResize: true,
				manualColumnResize: true,
				manualRowMove: true,
				manualColumnMove: true,
				mergeCells: true,
				outsideClickDeselects: false,
				undo: true,
				renderer: tablesModel.getDefaultRenderer(),
				startCols: app.getParameterByName('cols') || 5,
				startRows: app.getParameterByName('rows') || 5,
				currentRowClassName: 'current',
				currentColClassName: 'current'
			}),
			toolbar = new app.Editor.Toolbar('#tableToolbar', editor),
			formula = new app.Editor._Formula(editor);

		window.editor = editor;
		app.Editor.Hot = editor;
		app.Editor.Tb = toolbar;

		toolbar.subscribe();
		formula.subscribe();

		// Custom Handsontabe Renderer
		Handsontable.renderers.DefaultRenderer = function(instance,td,row,col,prop,value,cellProperties) {
			value = Handsontable.TextCell.renderer.call(this,instance,td,row,col,prop,value,cellProperties);

			if(cellProperties && cellProperties.formatType == 'currency') {
				value = tablesModel.setCellFormat(value,'currency');
			} else if(cellProperties && cellProperties.formatType == 'percent') {
				value = tablesModel.setCellFormat(value,'percent');
			} else if(instance.useNumberFormat && (app.isNumber(value) || cellProperties.formatType == 'number')) {
				value = tablesModel.setCellFormat(value,'number');
			}
			Handsontable.TextCell.renderer.call(this,instance,td,row,col,prop,value,cellProperties);
		};
		Handsontable.editors.TextEditor.prototype.focus = function() {
			this.TEXTAREA.select();
		};
		Handsontable.editors.TextEditor.prototype.beginEditing = function() {
			// To show percents as is if it is pure number
			var formatType = this.cellProperties.formatType || '',value = this.originalValue;

			if(app.isNumber(value) && !tablesModel.isFormula(value)) {
				if(formatType == 'percent') {
					value = (value * 100).toString();
				}
			}

			this.originalValue = value;

			Handsontable.editors.BaseEditor.prototype.beginEditing.call(this);
		};
		Handsontable.editors.TextEditor.prototype.saveValue = function(val,ctrlDown) {
			// Correct save of percent values
			var type = this.cellProperties.type || '',formatType = this.cellProperties.formatType || '',value = val[0][0];

			if(app.isNumber(value) && !tablesModel.isFormula(value)) {
				if(formatType == 'percent' && type != 'dropdown') {
					value = (value / 100).toString();
				}
			}
			if(formatType == 'time_duration') {
				var cellFormat = this.cellProperties.format || $('input[name="timeDurationFormat"]').val(),newTime = moment(value,cellFormat);

				if(newTime.isValid()) {
					value = newTime.format(cellFormat);
				} else {
					var duration = value.match(/.{1,2}/g);

					newTime = moment.duration({
						seconds: duration[2] || 0,minutes: duration[1] || 0,hours: duration[0] || 0,days: 0,weeks: 0,months: 0,years: 0
					});

					if(newTime._milliseconds || value == 0) {
						value = newTime.format(cellFormat);
					}
				}
			}

			val[0][0] = value;

			Handsontable.editors.BaseEditor.prototype.saveValue.call(this,val,ctrlDown);
		};
		Handsontable.editors.DropdownEditor.prototype.beginEditing = function() {
			// To show percents as is if it is pure number
			var formatType = this.cellProperties.formatType || '',source = this.cellProperties.source || [];

			for(var i = 0; i < source.length; i++) {
				if(app.isNumber(source[i]) && !tablesModel.isFormula(source[i])) {
					if(formatType == 'percent') {
						source[i] = (source[i] * 100).toString();
					}
				}
			}
			Handsontable.editors.BaseEditor.prototype.beginEditing.call(this);
		};

		Handsontable.editors.DropdownEditor.prototype.saveValue = function(val,ctrlDown) {
			// Correct save of percent values
			var type = this.cellProperties.type || '',formatType = this.cellProperties.formatType || '',source = this.cellProperties.source || [],value = val[0][0];

			if(app.isNumber(value) && !tablesModel.isFormula(value)) {
				if(formatType == 'percent') {
					value = (value / 100).toString();
				}
			}
			for(var i = 0; i < source.length; i++) {
				if(app.isNumber(source[i]) && !tablesModel.isFormula(source[i])) {
					if(formatType == 'percent') {
						source[i] = (source[i] / 100).toString();
					}
				}
			}
			val[0][0] = value;

			Handsontable.editors.BaseEditor.prototype.saveValue.call(this,val,ctrlDown);
		};

		// Editor Hooks
		editor.addHook('beforeCellAlignment', function (stateBefore, range, type, alignmentClass) {
			updateUndoRedoBtns();
		});
		editor.addHook('beforeFilter', function (conditionsStack) {
			// Handsontable PRO event, add just in case (UndoRedo plugin listens this event)
			updateUndoRedoBtns();
		});
		editor.addHook('beforeChange', function (changes, source) {
			$.each(changes, function (index, changeSet) {
				var row = changeSet[0],
					col = changeSet[1],
					value = changeSet[3],
					cell = editor.getCellMeta(row, col);

				if (cell.type == 'date') {
					var newDate = moment(value, cell.format);

					if (newDate.isValid()) {
						changeSet[3] = newDate.format(cell.format);
					}
				}
			});
		});
		editor.addHook('afterChange', function (changes) {
			updateUndoRedoBtns();

			if (!$.isArray(changes) || !changes.length) {
				return;
			}
			$.each(changes, function (index, changeSet) {
				var row = changeSet[0],
					col = changeSet[1],
					value = changeSet[3];

				if (value && value.toString().match(/\\/)) {
					editor.setDataAtCell(row, col, value.replace(/\\/g, '&#92;'));
				}
			});
			editor.render();
		});
		editor.addHook('afterLoadData', function () {
			generateWidthData();
			generateHeightData();
		});
		editor.addHook('afterCreateRow', function(insertRowIndex, amount, source) {
			var data = editor.getData(),
				i = insertRowIndex > amount ? insertRowIndex - 1 : insertRowIndex + 1;

			setTimeout(function() {
				for(var j = 0; j < data[insertRowIndex].length; j++) {
					editor.setCellMetaObject(insertRowIndex, j, editor.getCellMeta(i, j));
				}
				editor.render();
			}, 10);
			generateHeightData();
			editor.allHeights.splice(insertRowIndex, 0, editor.allHeights[i]);
			updateUndoRedoBtns();
		});
		editor.addHook('afterCreateCol', function(insertColumnIndex, amount, source) {
			insertColumnIndex = typeof(insertColumnIndex) != 'undefined' ? insertColumnIndex : 0;

			var selectedCell = editor.getSelected()
				,	selectedColumnIndex = 0
				,	data = editor.getData()
				,	j = insertColumnIndex <= amount ? insertColumnIndex + 1 : insertColumnIndex - 1;
			if(selectedCell && selectedCell[1] && selectedCell[1] > 0) {
				selectedColumnIndex = selectedCell[1];
			}
			setTimeout(function() {
				for(var i = 0; i < data.length; i++) {
					editor.setCellMetaObject(i, insertColumnIndex, editor.getCellMeta(i, j))
				}
				editor.render();
			}, 10);
			generateWidthData();
			editor.allWidths.splice(selectedColumnIndex, 0, editor.allWidths[j]);
			updateUndoRedoBtns();
		});
		editor.addHook('afterRemoveRow', function (from, amount) {
			generateHeightData();
			editor.allHeights.splice(from, amount);
			var countRows = editor.countRows(),
				plugin = editor.getPlugin('ManualRowResize');

			for (var i = 0; i < countRows; i++) {
				var colHeight = editor.getRowHeight(i);

				if (colHeight !== editor.allHeights[i]) {
					plugin.setManualSize(i, editor.allHeights[i]);
				}
			}
			updateUndoRedoBtns();
		});
		editor.addHook('afterRemoveCol', function(from, amount) {
			generateWidthData();
			editor.allWidths.splice(from, amount);

			var countCols = editor.countCols(),
				plugin = editor.getPlugin('ManualColumnResize');

			for (var i = 0; i < countCols; i++) {
				var colWidth = editor.getColWidth(i);
				if (colWidth !== editor.allWidths[i]) {
					plugin.setManualSize(i, editor.allWidths[i]);
				}
			}
			updateUndoRedoBtns();
		});
		editor.addHook('afterRowResize', function(row, height) {
			generateHeightData();
			editor.allHeights.splice(row, 1, height);
		});
		editor.addHook('afterColumnResize', function(column, width) {
			generateWidthData();
			editor.allWidths.splice(column, 1, width);
		});
		editor.addHook('afterRowMove', function (rows, target) {
			editor.render();
		});
		editor.addHook('afterColumnMove', function (columns, target) {
			editor.render();
		});
		editor.addHook('afterCopy', function (changes, copyCoords) {
			collectCellsMetaData(changes, copyCoords);
		});
		editor.addHook('afterCut', function (changes, cutCoords) {
			collectCellsMetaData(changes, cutCoords);
		});
		editor.addHook('afterPaste', function (changes, pasteCoords) {
			var rowsCopyCount = pasteCoords[0].startRow + g_stbCopyPasteRowsCount - 1,
				colsCopyCount = pasteCoords[0].startCol + g_stbCopyPasteColsCount - 1,
				endRow = pasteCoords[0].endRow < rowsCopyCount ? rowsCopyCount : pasteCoords[0].endRow,
				endCol = pasteCoords[0].endCol < colsCopyCount ? colsCopyCount : pasteCoords[0].endCol,
				j = 0;

			for(var i = 0; i < pasteCoords.length; i++) {
				for(var row = pasteCoords[i].startRow; row <= endRow; row++) {
					for(var col = pasteCoords[i].startCol; col <= endCol; col++) {
						if(!g_stbCopyPasteCellsMetaData[j]) {
							j = 0;
						}
						if(g_stbCopyPasteCellsMetaData[j]) {
							var value = editor.getDataAtCell(row, col),
								deltaRow = row - g_stbCopyPasteCellsMetaData[j].row,
								deltaCol = col - g_stbCopyPasteCellsMetaData[j].col,
								direction = '';

							if(deltaRow) {
								if(deltaRow > 0) {
									direction = 'down';
								} else {
									direction = 'up';
								}
								value = editor.plugin.utils.updateFormula(value, direction, Math.abs(deltaRow));
							}
							if(deltaCol) {
								if(deltaCol > 0) {
									direction = 'right';
								} else {
									direction = 'left';
								}
								value = editor.plugin.utils.updateFormula(value, direction, Math.abs(deltaCol));
							}
							editor.setDataAtCell(row, col, value);
							editor.setCellMetaObject(row, col, g_stbCopyPasteCellsMetaData[j]);
							j++;
						}
					}
				}
			}
			editor.render();
		});

		// Load table data to editor
		$.when(
			tablesModel.getMeta(tableId),
			tablesModel.getRows(tableId)
		).done(function (metaResponse, rowsResponse) {
				tablesModel.setTableData(metaResponse, rowsResponse);
			}).fail(function (error) {
				alert('Failed to load table data: ' + error);
			}).always(function (response) {
				$('#loadingProgress').remove();
				editor.render();
			});

		// Select all table cells by click on the top left corner of table editor
		$('.ht_clone_top_left_corner').on('mousedown', function(e) {
			editor.selectCell(0,0, editor.countRows() - 1, editor.countCols() - 1)
		});

		// Functions
		function generateHeightData() {
			if (!editor.allHeights) {
				editor.allHeights = typeof(editor.getSettings().rowHeights) == 'object' ? editor.getSettings().rowHeights : [];
			}
		}
		function generateWidthData() {
			if (!editor.allWidths) {
				editor.allWidths = typeof(editor.getSettings().colWidths) == 'object' ? editor.getSettings().colWidths : [];
			}
		}
		function updateUndoRedoBtns() {
			if(editor.undoRedo) {
				var undo = $('[data-method="undo"]'),
					redo = $('[data-method="redo"]');

				setTimeout(function() {
					if(editor.undoRedo.isUndoAvailable()) {
						undo.removeClass('inactive');
					} else {
						undo.addClass('inactive');
					}
					if(editor.undoRedo.isRedoAvailable()) {
						redo.removeClass('inactive');
					} else {
						redo.addClass('inactive');
					}
				}, 100);
			}
		}
		function collectCellsMetaData(changes, coords) {
			g_stbCopyPasteCellsMetaData = [];
			g_stbCopyPasteRowsCount = 0;
			g_stbCopyPasteColsCount = 0;
			for(var i = 0; i < coords.length; i++) {
				for(var row = coords[i].startRow; row <= coords[i].endRow; row++) {
					for(var col = coords[i].startCol; col <= coords[i].endCol; col++) {
						g_stbCopyPasteCellsMetaData.push(editor.getCellMeta(row,col));
						if(row == coords[i].startRow) {
							g_stbCopyPasteColsCount++;
						}
					}
					g_stbCopyPasteRowsCount++;
				}
			}
		}
	});
}(window.jQuery, window.supsystic.Tables));