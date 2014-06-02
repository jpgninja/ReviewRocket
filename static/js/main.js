jQuery('document').ready(function() {
	var i,
			currentPage,
			pages 							= {
				rate: 		jQuery('.page-rate'),
				review: 	jQuery('.page-review'),
				feedback: jQuery('.page-feedback'),
				thankyou: jQuery('.page-thankyou')
			},
			positiveRating 			= jQuery('.rate-positive'),
			nonPositiveRating 	= jQuery('.rate-neutral, .rate-negative'),
			feedbackForm 				=	jQuery('.form-feedback'),
			feedbackSubmit 			= jQuery('.feedback-submit'),


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

				// Page: Rate
				positiveRating.on('click', 			positiveReviewHandler);
				nonPositiveRating.on('click', 	nonPositiveReviewHandler);

				// Page: Feedback
				feedbackSubmit.on('click', 			feedbackFormHandler);
				feedbackForm.on('submit', 			feedbackFormSubmitHandler);
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
							ease: 			Power4.easeOut,
							onComplete: function() {
								pageHiddenHandler(transitionArray);
							}
						},
						inArgs 	= {
							opacity: 		1,
							scale: 			1,
							ease: 			Power4.easeOut,
							onComplete: function() {
								pageShownHandler(transitionArray[1]);
							}
						};

				tl.to(pages[transitionArray[1]], 0, 		inPreparationArgs);
				tl.to(pages[transitionArray[0]], 0.2, 	outArgs);
				tl.to(pages[transitionArray[1]], 0.5, 	inArgs);

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

				console.log('pageHiddenHandler', transitionArray, pages[transitionArray[1]]);

				pages[transitionArray[0]].removeClass('page-active');
				pages[transitionArray[1]].addClass('page-active');

			},

			pageShownHandler = function(transitionArray) {
				
				console.log('pageShownHandler', transitionArray);

				jQuery('.page-active')
					.find('input')
					.eq(0)
					.focus();
			},

			feedbackFormHandler = function(event) {
				console.log('feedbackFormHandler', 'Form sent!');
				
				event = event || window.event;

				if (event) {

					// TODO: Ajax form post, then animate to thank you.

					// Stop further events from firing
					event.stopPropagation();
					event.preventDefault();

					// Submit the form
					feedbackForm.submit();

					// Tranisition to Thank You page
					transitionArray = ['feedback', 'thankyou'];
					pageTransition(transitionArray);
									
				}

				return false;
			},

			feedbackFormSubmitHandler = function(event) {
				event = event || window.event;

				if (event) {
					// Stop further events from firing
					event.stopPropagation();
					event.preventDefault();
				}

				return false;
			};

	init();
});