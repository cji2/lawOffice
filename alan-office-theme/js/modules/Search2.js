// jquery is imported to use it.
import $ from 'jquery';

class Search {
	// 1. describe and create/initiate our object.
	constructor() {
		// this is CSS class jQuery selector.
		this.openButton = $(".js-search-trigger");
		this.closeButton = $(".search-overlay__close");
		this.searchOverlay = $(".search-overlay");
		// this will call the events listners, which will be triggered by clicking.
		this.events();
	}
	// 2. events.
	events() {
		// when user clicks, this will open 'openOverlay' method.
		/* most of 'this' in this class indicate a object created by the constructor.
		  but, in this jQuery 'this' means each HTML element which is clicked.
		  so we should use bind().  */
		this.openButton.on("click", this.openOverlay.bind(this));
		// when user clicks, this will open 'closeOverlay' method.
		this.closeButton.on("click", this.closeOverlay.bind(this));
	}
	// 3. methods (function, action ...)
	openOverlay() {
		this.searchOverlay.addClass("search-overlay--active");
	}

	closeOverlay() {
		this.searchOverlay.removeClass("search-overlay--active");
	}
}
export default Search;