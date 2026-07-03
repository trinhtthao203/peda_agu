/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//var APP_URL = 'http://172.19.49.161/AGU2022/public/';
	var APP_URL = 'https://www.agu.edu.vn/';
	config.contentsCss = [
		APP_URL + 'assets/frontend/css/ckeditor.css'
	];
	
	//APP_URL + 'assets/frontend/css/theme-responsive.css',
	//APP_URL + 'assets/frontend/css/custom.css',
	//APP_URL + 'assets/frontend/css/ie.css',
	//APP_URL + 'assets/frontend/css/lib/bootstrap.min.css'
};
