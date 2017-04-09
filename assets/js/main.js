/* global jQuery */
(function ($, root) {

	'use strict';
	
	/* ****************************************************************** */
	/* Prepare main object
	/* ****************************************************************** */
	
		var THEME_NAME = window.THEME_NAME || {};
		THEME_NAME.ready = {};
		
	/* ****************************************************************** */
	/* 
	/* ****************************************************************** */
	
		THEME_NAME.ready.function_name = function() {
			
		};
		
	/* ****************************************************************** */
	/* Run functions on ready
	/* ****************************************************************** */
	
		$( document ).ready(function() {
			
			for (var function_name in THEME_NAME.ready) {
				if (THEME_NAME.ready.hasOwnProperty(function_name)) {
			        THEME_NAME.ready[function_name]();
			    }
			}
		});

})(jQuery, this);
