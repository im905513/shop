/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'zh';
	//config.uiColor = '#AADC6E';
	config.toolbar = 'MyToolbar';
    config.toolbar_MyToolbar =
		[
		[ 'Styles', 'Format', 'Font', 'FontSize' ],
		['Bold', 'Italic', 'Underline', 'NumberedList', 'BulletedList'],
		['Link', 'Unlink'], ['Undo', 'Redo', '-', 'SelectAll'], [ 'TextColor', 'BGColor' ],['Image' ], ['Source']
		];
};
