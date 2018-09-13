jQuery(function($){

	//Clears all the local storage data
	window.localStorage.clear();

   $('.msip5-district').typeahead({
		name: 'MSIP5_2014_district',
		valueKey: 'district',
		prefetch: '/wp-content/themes/ceam13/lib/js/typeahead/updated-2014.json',
		template: [
			'<div class="reportCard">',
				'<h6 class="reportCard__item"><span class="reportCard__itemTitle">School</span>{{school}}</h6>',
				'<h6 class="reportCard__item"><span class="reportCard__itemTitle">District</span>{{district}} / {{region}}MO</h6>',
				'<h6 class="reportCard__item"><span class="reportCard__itemTitle">Grade </span>{{grade}} ({{score}}%)</h6>',
				'<h6 class="reportCard__item"><span class="reportCard__itemTitle">+/- </span>{{diff}} from last year</h6>',
				'<div class="badge">',
					'<span>{{grade}}</span>',
				'</div>',
			'</div>'
		].join(''),
		engine: Hogan,
		limit: 25
	});


  $('.msip5-school').typeahead({
    name: 'MSIP5_2014_school',
    valueKey: 'school',
    prefetch: '/wp-content/themes/ceam13/lib/js/typeahead/updated-2014.json',
    template: [
    '<div class="reportCard">',
    '<h6 class="reportCard__item"><span class="reportCard__itemTitle">School</span>{{school}}</h6>',
    '<h6 class="reportCard__item"><span class="reportCard__itemTitle">District</span>{{district}} / {{region}}MO</h6>',
    '<h6 class="reportCard__item"><span class="reportCard__itemTitle">Grade </span>{{grade}} ({{score}}%)</h6>',
    '<h6 class="reportCard__item"><span class="reportCard__itemTitle">+/- </span>{{diff}} from last year</h6>',
    '<div class="badge">',
    '<span>{{grade}}</span>',
    '</div>',
    '</div>'
    ].join(''),
    engine: Hogan,
    limit: 25
  });



});
