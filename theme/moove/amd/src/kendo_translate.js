define(
	[
		'jquery', 'kendo.all.min', 'core/config', 'core/notification', 'core/str'
	], 
function($, kendo, Config, Notification, Str) {
	var strings = [
		{
			key : 'refresh',
			component : 'theme_moove'
		},
		{
			key : 'of',
			component : 'theme_moove'
		},
		{
			key : 'items',
			component : 'theme_moove'
		},
		{
			key : 'empty',
			component : 'theme_moove'
		},
		{
			key : 'itemsPerPage',
			component : 'theme_moove'
		},
		{
			key : 'previous',
			component : 'theme_moove'
		},
		{
			key : 'next',
			component : 'theme_moove'
		},
		{
			key : 'last',
			component : 'theme_moove'
		},
		{
			key : 'search',
			component : 'theme_moove'
		},
		{
			key : 'page',
			component : 'theme_moove'
		},
		{
			key : 'first',
			component : 'theme_moove'
		}
	];
	Str.get_strings(strings).then(function(s) {

		kendo.ui.Locale = "Vietnamese (Vi)";

		kendo.ui.ColumnMenu.prototype.options.messages =
		  $.extend(kendo.ui.ColumnMenu.prototype.options.messages, {

		      /* COLUMN MENU MESSAGES 
		       ****************************************************************************/
		      sortAscending: "Sort Ascending",
		      sortDescending: "Sort Descending",
		      filter: "Filter",
		      columns: "Columns",
		      done: "Done",
		      settings: "Column Settings"
		      /***************************************************************************/
		  });

		kendo.ui.Groupable.prototype.options.messages =
		  $.extend(kendo.ui.Groupable.prototype.options.messages, {

		      /* GRID GROUP PANEL MESSAGES 
		       ****************************************************************************/
		      empty: "Drag a column header and drop it here to group by that column"
		      /***************************************************************************/
		  });

		kendo.ui.FilterMenu.prototype.options.messages =
		  $.extend(kendo.ui.FilterMenu.prototype.options.messages, {

		      /* FILTER MENU MESSAGES 
		       ***************************************************************************/
		      info: "Show items with value that:",        // sets the text on top of the filter menu
		      filter: "Filter",      // sets the text for the "Filter" button
		      clear: "Clear",        // sets the text for the "Clear" button
		      // when filtering boolean numbers
		      isTrue: "is true", // sets the text for "isTrue" radio button
		      isFalse: "is false",     // sets the text for "isFalse" radio button
		      //changes the text of the "And" and "Or" of the filter menu
		      and: "And",
		      or: "Or",
		      selectValue: "-Select value-",
		      operator: "Operator",
		      value: "Value",
		      cancel: "Cancel"
		      /***************************************************************************/
		  });

		kendo.ui.FilterMenu.prototype.options.operators =
		  $.extend(kendo.ui.FilterMenu.prototype.options.operators, {

		      /* FILTER MENU OPERATORS (for each supported data type) 
		       ****************************************************************************/
		      string: {
		          eq: "Is equal to",
		          neq: "Is not equal to",
		          startswith: "Starts with",
		          contains: "Contains",
		          doesnotcontain: "Does not contain",
		          endswith: "Ends with"
		      },
		      number: {
		          eq: "Is equal to",
		          neq: "Is not equal to",
		          gte: "Is greater than or equal to",
		          gt: "Is greater than",
		          lte: "Is less than or equal to",
		          lt: "Is less than"
		      },
		      date: {
		          eq: "Is equal to",
		          neq: "Is not equal to",
		          gte: "Is after or equal to",
		          gt: "Is after",
		          lte: "Is before or equal to",
		          lt: "Is before"
		      },
		      enums: {
		          eq: "Is equal to",
		          neq: "Is not equal to"
		      }
		      /***************************************************************************/
		  });

		kendo.ui.Pager.prototype.options.messages =
		  $.extend(kendo.ui.Pager.prototype.options.messages, {

		      /* PAGER MESSAGES 
		       ****************************************************************************/
		      display: '{0} - {1} ' + s[1] +' {2} '+ s[2],
		      empty: s[3],
		      page: s[9],
		      of: s[1] + " {0}",
		      itemsPerPage: s[4],
		      first: s[10],
		      previous: s[5],
		      next: s[6],
		      last: s[7],
		      refresh: s[0],
		      search: s[8]
		      /***************************************************************************/
		  });

		kendo.ui.Validator.prototype.options.messages =
		  $.extend(kendo.ui.Validator.prototype.options.messages, {

		      /* VALIDATOR MESSAGES 
		       ****************************************************************************/
		      required: "{0} is required",
		      pattern: "{0} is not valid",
		      min: "{0} should be greater than or equal to {1}",
		      max: "{0} should be smaller than or equal to {1}",
		      step: "{0} is not valid",
		      email: "{0} is not valid email",
		      url: "{0} is not valid URL",
		      date: "{0} is not valid date"
		      /***************************************************************************/
		  });

		kendo.ui.ImageBrowser.prototype.options.messages =
		  $.extend(kendo.ui.ImageBrowser.prototype.options.messages, {

		      /* IMAGE BROWSER MESSAGES 
		       ****************************************************************************/
		      uploadFile: "Upload",
		      orderBy: "Arrange by",
		      orderByName: "Name",
		      orderBySize: "Size",
		      directoryNotFound: "A directory with this name was not found.",
		      emptyFolder: "Empty Folder",
		      deleteFile: 'Are you sure you want to delete "{0}"?',
		      invalidFileType: "The selected file \"{0}\" is not valid. Supported file types are {1}.",
		      overwriteFile: "A file with name \"{0}\" already exists in the current directory. Do you want to overwrite it?",
		      dropFilesHere: "drop file here to upload",
		      search: "Search"
		      /***************************************************************************/
		  });

		kendo.ui.Editor.prototype.options.messages =
		  $.extend(kendo.ui.Editor.prototype.options.messages, {

		      /* EDITOR MESSAGES 
		       ****************************************************************************/
		      bold: "Bold",
		      italic: "Italic",
		      underline: "Underline",
		      strikethrough: "Strikethrough",
		      superscript: "Superscript",
		      subscript: "Subscript",
		      justifyCenter: "Center text",
		      justifyLeft: "Align text left",
		      justifyRight: "Align text right",
		      justifyFull: "Justify",
		      insertUnorderedList: "Insert unordered list",
		      insertOrderedList: "Insert ordered list",
		      indent: "Indent",
		      outdent: "Outdent",
		      createLink: "Insert hyperlink",
		      unlink: "Remove hyperlink",
		      insertImage: "Insert image",
		      insertHtml: "Insert HTML",
		      viewHtml: "View HTML",
		      fontName: "Select font family",
		      fontNameInherit: "(inherited font)",
		      fontSize: "Select font size",
		      fontSizeInherit: "(inherited size)",
		      formatBlock: "Format",
		      formatting: "Format",
		      foreColor: "Color",
		      backColor: "Background color",
		      style: "Styles",
		      emptyFolder: "Empty Folder",
		      uploadFile: "Upload",
		      orderBy: "Arrange by:",
		      orderBySize: "Size",
		      orderByName: "Name",
		      invalidFileType: "The selected file \"{0}\" is not valid. Supported file types are {1}.",
		      deleteFile: 'Are you sure you want to delete "{0}"?',
		      overwriteFile: 'A file with name "{0}" already exists in the current directory. Do you want to overwrite it?',
		      directoryNotFound: "A directory with this name was not found.",
		      imageWebAddress: "Web address",
		      imageAltText: "Alternate text",
		      linkWebAddress: "Web address",
		      linkText: "Text",
		      linkToolTip: "ToolTip",
		      linkOpenInNewWindow: "Open link in new window",
		      dialogUpdate: "Update",
		      dialogInsert: "Insert",
		      dialogButtonSeparator: "or",
		      dialogCancel: "Cancel",
		      createTable: "Create table",
		      addColumnLeft: "Add column on the left",
		      addColumnRight: "Add column on the right",
		      addRowAbove: "Add row above",
		      addRowBelow: "Add row below",
		      deleteRow: "Delete row",
		      deleteColumn: "Delete column",
		      /***************************************************************************/
		  });

		kendo.ui.NumericTextBox.prototype.options =
		    $.extend(kendo.ui.NumericTextBox.prototype.options, {

		        /* NUMERIC TEXT BOX OR INTEGER TEXT BOX MESSAGES
		        ****************************************************************************/
		        upArrowText: "Increase value",
		        downArrowText: "Decrease value"
		        /***************************************************************************/
		    });

		kendo.ui.Upload.prototype.options.localization =
			$.extend(kendo.ui.Upload.prototype.options.localization, {

			    /* UPLOAD LOCALIZATION
		         ****************************************************************************/
			    select: "Select files...",
			    cancel: "Cancel",
			    retry: "Retry",
			    remove: "Remove",
			    uploadSelectedFiles: "Upload files",
			    dropFilesHere: "drop files here to upload",
			    statusUploading: "uploading",
			    statusUploaded: "uploaded",
			    statusWarning: "warning",
			    statusFailed: "failed",
			    headerStatusUploading: "Uploading...",
			    headerStatusUploaded: "Done"
			    /***************************************************************************/
			});
	});


})
