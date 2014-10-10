/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.filebrowserBrowseUrl = '/admin/editor/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = '/admin/editor/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = '/admin/editor/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = '/admin/editor/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = '/admin/editor/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = '/admin/editor/kcfinder/upload.php?type=flash';
	config.height = 200;
	config.skin = 'moono_blue';
	config.extraPlugins = 'slideshow';  
	// Define changes to default configuration here. For example:
	//config.language = 'fr';
	config.uiColor = '#f1a03d';
};
