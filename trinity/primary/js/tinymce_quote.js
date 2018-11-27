/*-------------------------------------------
	Tinymce quote
-------------------------------------------*/
(function() {
	tinymce.PluginManager.add('tric_tinymce_button', function(editor, url) {
		editor.addButton('tric_tinymce_button', {
			icon: false,
			text: "Quote",
			onclick: function() {
				editor.windowManager.open({
					title: "Quote",
					width: 465,
					height: 418,
					body: [
					{
						type: 'textbox',
						name: 'tric_quote',
						multiline:true,
						label: 'Quote',
						value: ''
					},
					{
						type: 'textbox',
						name: 'tric_author',
						placeholder: 'Author',
						label: 'Quote Author',
						value: ''
					},
					{
						type: 'textbox',
						name: 'tric_context',
						placeholder: '\'17 or Biology Professo',
						label: 'Quote Attribution Context',
						value: ''
					}],
					onsubmit: function(e) {
						var tricQuote 		= e.data.tric_quote;
						var tricAuthor 		= e.data.tric_author;
						var tricContext 	= e.data.tric_context;

						var shortCode = '';

						shortCode += '<figure class="quote">';
							shortCode += '<blockquote class="quote_content"><p>'+ tricQuote +'</p></blockquote>';
							shortCode += '';
							shortCode += '<figcaption class="quote_caption">';
								shortCode += '<span class="quote_caption_name"> '+ tricAuthor +'</span>';
								shortCode += '<span class="quote_caption_title"> '+ tricContext +'</span>';
							shortCode += '</figcaption>';
						shortCode += '</figure>';
						shortCode += '<p></p>';

						editor.insertContent(shortCode);
					},
					setup: function (editor) {
					    editor.on('init', function () {
					        editor.focus();
					        editor.selection.select(editor.getBody(), true);
					        editor.selection.collapse(false);
					    });
					}
				});
			}
		});
	});
})();