import $ from 'jquery';

class Search {
  // 1. describe and create/initiate our object.	
  constructor() {
  	/*
    this.name = "Jane";
    this.eyeColor = "green";
    this.head = {};
    this.brain = {};  */
	/* This part makes the live search window, which was moved from footer.php.
	   if web browser disables JavaScript, search window should not be displayed.
	   this is the reason why it should be displayed by 'Search.js' file.
	   It should be in the first line of constructor, since other function will work
	   only after searh live window exists.  */
    this.addSearchHTML();

    this.resultsDiv = $("#search-overlay__results");
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
	this.searchOverlay = $(".search-overlay");
	// search-term is the ID of <input> HTML element
    this.searchField = $("#search-term");
	this.events();
	// this property will be used for openOverlay and closeOverlay methods.
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
	this.previousValue;
	/* this is used to keep from reset the timer of keyboard. whenever user press
	  the keyboard in search window */
    this.typingTimer;
  }

  // 2. events 
  // on this.head feels cold, wearsHat
  // on this.brain feels hot, goingSwimming.
  	events() {
  		this.openButton.on("click", this.openOverlay.bind(this));
		this.closeButton.on("click", this.closeOverlay.bind(this));
		// search window will be open by keybaord.  
		  $(document).on("keydown", this.keyPressDispatcher.bind(this));
		// when use input data in search window, typingLogic method is called.  
		// searchField is defined by constructor of this class.
		/*  we can use $('#search-term), but accessing DOM is much slower than
		   JavaScript(jQuery). So, we use a property of this class object. which is
		   'searchField'. This is same as #Search-term and defined by constructor.  */
  		this.searchField.on("keyup", this.typingLogic.bind(this));
  	}


  // 3. methods (function, action ...)
  typingLogic() {
	// console.log("hello from typing logic.");
  	if (this.searchField.val() != this.previousValue) {
		// typingTimer is defined by constructor of this class.
  		clearTimeout(this.typingTimer);

  		if (this.searchField.val()) {
  			if (!this.isSpinnerVisible) {
		  		this.resultsDiv.html('<div class="spinner-loader"></div>');
		  		this.isSpinnerVisible = true;
	  	    }
			//this.typingTimer = setTimeout(function () {console.log("This is a timeout test.");}, 2000);
			/* after 750ms, getResults() will be called.  */  
		  	this.typingTimer = setTimeout(this.getResults.bind(this), 750);
  		} else {
  			this.resultsDiv.html('');
  			this.isSpinnerVisible = false;
  		}	  	
  	}  	
  	this.previousValue = this.searchField.val(); 
  }

  getResults() {
	 
	// this.resultsDiv.html('Real search result!');
	/* This retrieve database written in JSON fomrat. When we use arrow funciton, we may not use bind().  
	   The object, lawOfficeData is defined in 'functions.php' file.
	   So, after we change functions.php file, we should run 'gulf scripts' to re-compile JavaScript */
	/* This is for post searching. 
		But, if we connect post searching* with page searching by nesting, search speed is very slow,
		since is synchronous searching! */

	/* "when().then()" allow us to have asynchronous search. The argument of when() can 
	   have as many searches as we want.*/  
	$.when(
		/* when we combine two $.getJSON(), using $.when().then(), callback function will be defined
		only once by the agrument of .then().   */
		$.getJSON(lawOfficeData.root_url + "/wp-json/wp/v2/posts?search=" + this.searchField.val()),
		$.getJSON(lawOfficeData.root_url + "/wp-json/wp/v2/pages?search=" + this.searchField.val())
	).then((posts, pages) => {
		var combinedResults = posts[0].concat(pages[0]);	
		/* we use back quote, rahter than quoation mark to change the line within quote!!!
		but, within back quote, we cannot use if statement. 
		So, we use ternary operator: ${condition ?  yay(then) : nay(else)}
		join() convert array into simple string.
		map() execute a function within parenthesis for each element in a array. */
		this.resultsDiv.html(`
			<h2 class="search-overlay__section-title">Information from Alan's Office</h2>
			${combinedResults.length ? 
					'<ul class="link-list min-list">' 
				:   "<h3 style='color:red;'>No information matches the search! </h3>" } 
				${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
			${combinedResults.length ? '</ul>' : ''}	
		`);
		/* before we can search result, result window displays spinnter by getting
		  the property, isSpinnerVisible false */
		this.isSpinnerVisible = false;
	},  () => {
  		this.resultsDiv.html('<p>Unexpected error; please try again!</p>');
	}); 
	/*	
	$.getJSON(lawOfficeData.root_url + "/wp-json/wp/v2/posts?search=" + this.searchField.val(), (posts) => {
		/* this is for page searching*/
		//$.getJSON(lawOfficeData.root_url + "/wp-json/wp/v2/pages?search=" + this.searchField.val(), (pages) => {
		/* this combines post search and page search! concat() connects two results. */	
		//var combinedResults = posts.concat(pages);	
		/* we use back quote, rahter than quoation mark to change the line within quote!!!
		but, within back quote, we cannot use if statement. 
		So, we use ternary operator: ${condition ?  yay(then) : nay(else)}
		join() convert array into simple string.
		map() execute a function within parenthesis for each element in a array. */
		/*
		this.resultsDiv.html(`
			<h2 class="search-overlay__section-title">Information from Alan's Office</h2>
			${combinedResults.length ? 
					'<ul class="link-list min-list">' 
				:   "<h3 style='color:red;'>No information matches the search! </h3>" } 
				${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
			${combinedResults.length ? '</ul>' : ''}	
		`);
		*/
		/* before we can search result, result window displays spinnter by getting
		  the property, isSpinnerVisible false */
		/*  
		this.isSpinnerVisible = false;
		});
	});
	*/
	/*
  	$.when(
  		$.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()), 
  		$.getJSON(universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val())
  		).then((posts, pages)  => {
  		var combinedResults = posts[0].concat(pages[0]);
  			this.resultsDiv.html(`
  			<h2 class="search-overlay__section-title">General Inforamtion</h2>
  			${combinedResults.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
  				${combinedResults.map(item =>`<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
  			${combinedResults.length ? '</ul>' : ''}
  		`);
  		this.isSpinnerVisible = false;
  	}, () => {
  		this.resultsDiv.html('<p>Unexpected error; please try again!</p>');
	  });
	*/
  }

  keyPressDispatcher(e) {
	//e.keyCode
	// key code is displayed at console.
	// console.log(e.keyCode);
	/*  keycode of 's's' is 83, and keycode of 'esc' is 27. 
	    'isOverlayOpen' propety is defined by constructor of this class. */  
  	if (e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus'))
  		this.openOverlay();
  	else if (e.keyCode == 27 && this.isOverlayOpen)
  		this.closeOverlay();
  }
  /*
  goingSwimming() {
  }
  wearsHat() {
  } */
  openOverlay() {
	this.searchOverlay.addClass("search-overlay--active");
	// when we click search button, this will disable scroll function.  
	$("body").addClass("body-no-scroll");
	/* whenever we reopen live search windown after we close it, 
	   the following will reset the input of the search!     */  
	this.searchField.val('');
	/* the following has 301ms dealy since CSS transition takes time.
	   So after it finshies, we can make search window has focus. 
	   To save code, we used ES5 arrow fucntion.  */  
  	setTimeout(() => this.searchField.focus(), 301);
  	console.log("our open method just ran!");
	this.isOverlayOpen = true;
	return false;  
  }
  closeOverlay() {
	this.searchOverlay.removeClass("search-overlay--active");
	// when se close search window, this will enable scroll function again.  
  	$("body").removeClass("body-no-scroll");
  	console.log("our close method just ran!");
  	this.isOverlayOpen = false;
  }
  /* This part makes the live search window, which was moved from footer.php.
	 If web browser disables JavaScript, search window should not be displayed.
	 This is the reason why it should be displayed by 'Search.js' file */
  addSearchHTML() {
	/* The following is the jQuery method to display live search window.
	   The argument of append() has back quote, since it has HTML elements, which are 
	   defined by more than one line.	*/  
  	$("body").append(`  
  		<div class="search-overlay">
		    <div class="search-overlay__top">
		      <div class="container">
		        <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
		        <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
		        <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
		      </div>
		    </div>

		    <div class="container">
		      <div id="search-overlay__results"></div>
		    </div>
  		</div>
     `);
  }

}

//var amazingSearch = new Search();

export default Search;