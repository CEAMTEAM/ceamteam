jQuery(function($){

	//Clears all the local storage data
	//window.localStorage.clear();

   $('.msip5').typeahead({
		name: 'MSIP5',
		valueKey: 'school',
		prefetch: '/wp-content/themes/ceam13/lib/js/typeahead/msipMini.json',
		template: [
			'<div class="reportCard">',
				'<h6 class="reportCard__item"><span class="reportCard__itemTitle">School</span>{{school}}</h6>',
				'<h6 class="reportCard__item"><span class="reportCard__itemTitle">District</span>{{agency}}</h6>',
				'<h6 class="reportCard__item"><span class="reportCard__itemTitle">Grade </span>{{grade}} ({{percentage}}%)</h6>',
				'<div class="badge">',
					'<span>{{grade}}</span>',
				'</div>',
			'</div>'
		].join(''),
		engine: Hogan,
		limit: 25
	});
});
