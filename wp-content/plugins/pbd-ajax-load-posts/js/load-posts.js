$(document).ready(function($) {
	/** IMPORTANT
	**  NOTE:: 'custom_page_class' value can be found on the HEADER.*/

	// The number of the next page to load (/page/x/).
	var pageNum = parseInt(pbd_alp.startPage) + 1;
	
	
	// The maximum number of pages the current query can return.
	var max = parseInt(pbd_alp.maxPages);
	
	
	// The link of the next page of posts.
	var nextLink = pbd_alp.nextLink;


		// Default functionality
		if( $('.post-list-default').length != 0 ) {

			/**
			 * Replace the traditional navigation with our own,
			 * but only if there is at least one page of new posts to load.
			 */

			if(pageNum <= max) {
				// Insert the "More Posts" link.
				$('.post-list-default')
					.append('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>')
					.append('<p id="pbd-alp-load-posts"><a href="#">Load More Posts</a></p>');
					
				// Remove the traditional navigation.
				$('.navigation').remove();
			}
			
			
			/**
			 * Load new posts when the link is clicked.
			 */

			$('#pbd-alp-load-posts a').click(function() {
				
				// Are there more posts to load?
				if(pageNum <= max) {
				
					// Show that we're working.
					$(this).text('Loading posts...');
					
					$('.pbd-alp-placeholder-'+ pageNum).load(nextLink + ' .post',
						function() {
							// Update page number and nextLink.
							pageNum++;
							nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
							
							// Add a new placeholder, for when user clicks again.
							$('#pbd-alp-load-posts')
								.before('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>')
							
							// Update the button message.
							if(pageNum <= max) {
								$('#pbd-alp-load-posts a').text('Load More Posts');
							} else {
								$('#pbd-alp-load-posts a').text('No more posts to load.');
							}
						}
					);
				} else {
					$('#pbd-alp-load-posts a').append('.');
				}	
				
				return false;
			});
		
		}


		//to work with load more publish tab
		if( $('.post-publish').length != 0 ) {
			if(pageNum <= max) {
				// Insert the "More Posts" link.
				$('.post-publish')
					.append('<div class="pbd-alp-placeholder-publish-'+ pageNum +'"></div>')
					.append('<p id="pbd-alp-load-posts-publish"><a href="#">Load More Posts</a></p>');
					
				// Remove the traditional navigation.
				$('.navigation').remove();
			}

			$('#pbd-alp-load-posts-publish a').click(function() {
				
				// Are there more posts to load?
				if(pageNum <= max) {
				
					// Show that we're working.
					$(this).text('Loading posts...');
					
					$('.pbd-alp-placeholder-publish-'+ pageNum).load(nextLink + ' .post-publish-list',
						function() {
							// Update page number and nextLink.
							pageNum++;
							nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
							
							console.log(nextLink);
							// Add a new placeholder, for when user clicks again.
							$('#pbd-alp-load-posts-publish')
								.before('<div class="pbd-alp-placeholder-publish-'+ pageNum +'"></div>')
							
							// Update the button message.
							if(pageNum <= max) {
								$('#pbd-alp-load-posts-publish a').text('Load More Posts');
							} else {
								$('#pbd-alp-load-posts-publish a').text('No more posts to load.');
							}
						}
					);
				} else {
					$('#pbd-alp-load-posts-publish a').append('.');
				}	
				
				return false;
			});
		}

		//to work with load more favorite tab
		if( $('.post-favorite').length != 0 ) {
			if(pageNum <= max) {
				// Insert the "More Posts" link.
				$('.post-favorite')
					.append('<div class="pbd-alp-placeholder-favorite-'+ pageNum +'"></div>')
					.append('<p id="pbd-alp-load-posts-favorite"><a href="#">Load More Posts</a></p>');
					
				// Remove the traditional navigation.
				$('.navigation').remove();
			}

			$('#pbd-alp-load-posts-favorite a').click(function() {
				
				// Are there more posts to load?
				if(pageNum <= max) {
				
					// Show that we're working.
					$(this).text('Loading posts...');
					
					$('.pbd-alp-placeholder-favorite-'+ pageNum).load(nextLink + ' .post-favorite-list',
						function() {
							// Update page number and nextLink.
							pageNum++;
							nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
							
							console.log(nextLink);
							// Add a new placeholder, for when user clicks again.
							$('#pbd-alp-load-posts-favorite')
								.before('<div class="pbd-alp-placeholder-favorite-'+ pageNum +'"></div>')
							
							// Update the button message.
							if(pageNum <= max) {
								$('#pbd-alp-load-posts-favorite a').text('Load More Posts');
							} else {
								$('#pbd-alp-load-posts-favorite a').text('No more posts to load.');
							}
						}
					);
				} else {
					$('#pbd-alp-load-posts-favorite a').append('.');
				}	
				
				return false;
			});
		}

		//to work with load more draft tab
		if( $('.post-draft').length != 0 ) {
			if(pageNum <= max) {
				// Insert the "More Posts" link.
				$('.post-draft')
					.append('<div class="pbd-alp-placeholder-draft-'+ pageNum +'"></div>')
					.append('<p id="pbd-alp-load-posts-draft"><a href="#">Load More Posts</a></p>');
					
				// Remove the traditional navigation.
				$('.navigation').remove();
			}

			$('#pbd-alp-load-posts-draft a').click(function() {
				
				// Are there more posts to load?
				if(pageNum <= max) {
				
					// Show that we're working.
					$(this).text('Loading posts...');
					
					$('.pbd-alp-placeholder-draft-'+ pageNum).load(nextLink + ' .post-draft-list',
						function() {
							// Update page number and nextLink.
							pageNum++;
							nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
							
							console.log(nextLink);
							// Add a new placeholder, for when user clicks again.
							$('#pbd-alp-load-posts-draft')
								.before('<div class="pbd-alp-placeholder-draft-'+ pageNum +'"></div>')
							
							// Update the button message.
							if(pageNum <= max) {
								$('#pbd-alp-load-posts-draft a').text('Load More Posts');
							} else {
								$('#pbd-alp-load-posts-draft a').text('No more posts to load.');
							}
						}
					);
				} else {
					$('#pbd-alp-load-posts-draft a').append('.');
				}	
				
				return false;
			});
		}


		 //to fixed bugged in publish tab .
        $('a[href="#1"]').on('shown.bs.tab', function(e){

			if(pageNum <= max) {
				// Insert the "More Posts" link.
				$('.post-publish')
					.append('<div class="pbd-alp-placeholder-publish-'+ pageNum +'"></div>')
					.append('<p id="pbd-alp-load-posts-publish"><a href="#">Load More Posts</a></p>');
					
				// Remove the traditional navigation.
				$('.navigation').remove();
			}

			$('#pbd-alp-load-posts-publish a').click(function() {
				
				// Are there more posts to load?
				if(pageNum <= max) {
				
					// Show that we're working.
					$(this).text('Loading posts...');
					
					$('.pbd-alp-placeholder-publish-'+ pageNum).load(nextLink + ' .post-publish-list',
						function() {
							// Update page number and nextLink.
							pageNum++;
							nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
							
							console.log(nextLink);
							// Add a new placeholder, for when user clicks again.
							$('#pbd-alp-load-posts-publish')
								.before('<div class="pbd-alp-placeholder-publish-'+ pageNum +'"></div>')
							
							// Update the button message.
							if(pageNum <= max) {
								$('#pbd-alp-load-posts-publish a').text('Load More Posts');
							} else {
								$('#pbd-alp-load-posts-publish a').text('No more posts to load.');
							}
						}
					);
				} else {
					$('#pbd-alp-load-posts-publish a').append('.');
				}	
				
				return false;
			});

        });	

		
		 //to fixed bugged in draft tab .
        $('a[href="#3"]').on('shown.bs.tab', function(e){

			if(pageNum <= max) {
				// Insert the "More Posts" link.
				$('.post-draft')
					.append('<div class="pbd-alp-placeholder-draft-'+ pageNum +'"></div>')
					.append('<p id="pbd-alp-load-posts-draft"><a href="#">Load More Posts</a></p>');
					
				// Remove the traditional navigation.
				$('.navigation').remove();
			}

			$('#pbd-alp-load-posts-draft a').click(function() {
				
				// Are there more posts to load?
				if(pageNum <= max) {
				
					// Show that we're working.
					$(this).text('Loading posts...');
					
					$('.pbd-alp-placeholder-draft-'+ pageNum).load(nextLink + ' .post-draft-list',
						function() {
							// Update page number and nextLink.
							pageNum++;
							nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
							
							console.log(nextLink);
							// Add a new placeholder, for when user clicks again.
							$('#pbd-alp-load-posts-draft')
								.before('<div class="pbd-alp-placeholder-draft-'+ pageNum +'"></div>')
							
							// Update the button message.
							if(pageNum <= max) {
								$('#pbd-alp-load-posts-draft a').text('Load More Posts');
							} else {
								$('#pbd-alp-load-posts-draft a').text('No more posts to load.');
							}
						}
					);
				} else {
					$('#pbd-alp-load-posts-draft a').append('.');
				}	
				
				return false;
			});

        });	
	
});