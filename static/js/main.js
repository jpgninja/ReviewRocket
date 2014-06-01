jQuery('document').ready(function() {
	var i,
			currentPage,
			pages 							= {
				rate: 		jQuery('.page-rate'),
				review: 	jQuery('.page-review'),
				feedback: jQuery('.page-feedback')
			},
			positiveRating 			= jQuery('.rate-positive'),
			nonPositiveRating 	= jQuery('.rate-neutral, .rate-negative'),


			/**
			 *	Initialize
			 */
			init = function() {

				addListeners();
			},


			/**
			 *	Add Event Listeners
			 */
			addListeners = function() {

				positiveRating.on('click', 			positiveReviewHandler);
				nonPositiveRating.on('click', 	nonPositiveReviewHandler);
			},

			pageTransition = function(transitionArray) {

				var tl 			= new TimelineLite(),
						inPreparationArgs = {
							opacity: 		0,
							scale: 			0.8,
						}
						outArgs = {
							opacity: 		0,
							scale: 			0.8,
							ease: 			Power4.easeInOut,
							onComplete: function() {
								pageHiddenHandler(transitionArray);
							}
						},
						inArgs 	= {
							opacity: 		1,
							scale: 			1,
							ease: 			Power4.easeInOut,
							onComplete: function() {
								pageShownHandler(transitionArray[1]);
							}
						};

				tl.to(pages[transitionArray[1]], 0, 	inPreparationArgs);
				tl.to(pages[transitionArray[0]], 0.25, outArgs);
				tl.to(pages[transitionArray[1]], 0.25, inArgs);

				tl.play();

			},


			/**
			 * 	=====
			 * 	Event Listeners
			 *	=====
			 */


			/**
			 *	nonPositiveReviewHandler
			 */
			nonPositiveReviewHandler = function() {
				var transitionArray = ['rate', 'feedback'];

				pageTransition(transitionArray);
				
				console.log('non-positive review!');
			},


			/**
			 *	positiveReviewHandler
			 */
			positiveReviewHandler = function() {
				
				var transitionArray = ['rate', 'review'];

				pageTransition(transitionArray);

				console.log('positive review!');
			},

			pageHiddenHandler = function(transitionArray) {

				// console.log('pageHiddenHandler', transitionArray);

				pages[transitionArray[0]].removeClass('page-active');
				pages[transitionArray[1]].addClass('page-active');

			},

			pageShownHandler = function(transitionArray) {
				// console.log('pageShownHandler', transitionArray);

			}

	init();
});