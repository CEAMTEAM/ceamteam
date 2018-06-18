jQuery(function($){

	//Clears all the local storage data
	window.localStorage.clear();

   $('.school-district').typeahead({
		name: 'superindentent_info_school_district',
		valueKey: 'school-district',
		prefetch: '/wp-content/themes/ceam13/lib/js/typeahead/superintendant-information.json',
		template: [
			'<div class="si-reportCard">',
				'<div><span class=si-term>School Disctrict</span><span class=si-desc> {{school-district}}</span></div>',
				'<div><span class=si-term>Superintendent</span><span class=si-desc> {{superintendent}}</span></div>',
				'<div><span class=si-term>Salary</span><span class=si-desc> {{salary}}</span></div>',
				'<div><span class=si-term>Annual pension contribution to Public School Retirement System of 14.5%</span><span class=si-desc> {{annual-pension-contribution}}</span></div>',
				'<div><span class=si-term>Additional annuity</span><span class=si-desc> {{annuity}}</span></div>',
				'<div><span class=si-term>Total salary/compensation and retirement (plus additional compensation, stipends, or expense as noted below)</span><span class=si-desc> {{total-costs}}</span></div>',
				'<div><span class=si-term>Other compensation/ expenses notes</span><span class=si-desc> {{other-compensation}}</span></div>',
				'<div><span class=si-term>Insurance</span><span class=si-desc> {{insurance}}</span></div>',
				'<div><span class=si-term>Notes about this contract</span><span class=si-desc> {{notes}}</span></div>',
				'<div><span class=si-term>Paid leave days provided</span><span class=si-desc> {{leave-days-annually}}</span></div>',
				'<div><span class=si-term>Membership dues paid by district</span><span class=si-desc> {{paid-dues-to-organizations}}</span></div>',
				'<div><span class=si-term>Mileage/use of vehicle</span><span class=si-desc> {{mileage}}</span></div>',
				'<div><span class=si-term>Meals/lodging on trips</span><span class=si-desc> {{meals-lodging}}</span></div>',
				'<div><span class=si-term>Other expenses</span><span class=si-desc> {{other-expenses}}</span></div>',
				'<div><span class=si-term>Personal benefits</span><span class=si-desc> {{personal-benefits}}</span></div>',
				'<div><span class=si-term>2014 District Budget</span><span class=si-desc> {{budget-2014}}</span></div>',
				'<div><span class=si-term>2014 Student Enrollment</span><span class=si-desc> {{enrollment-for-2014}}</span></div>',
				'<div><span class=si-term>2015 MAP Score – English</span><span class=si-desc> {{map-english-2015}}</span></div>',
				'<div><span class=si-term>2015 MAP Score – Math</span><span class=si-desc> {{map-math-2015}}</span></div>',
			'</div>'
		].join(''),
		engine: Hogan,
		limit: 25
	});


  $('.superintendant-information').typeahead({
    name: 'superindentent_info',
    valueKey: 'superintendent',
    prefetch: '/wp-content/themes/ceam13/lib/js/typeahead/superintendant-information.json',
    template: [
	    '<div class="si-reportCard">',
				'<div><span class=si-term>School Disctrict</span><span class=si-desc> {{school-district}}</span></div>',
				'<div><span class=si-term>Superintendent</span><span class=si-desc> {{superintendent}}</span></div>',
				'<div><span class=si-term>Salary</span><span class=si-desc> {{salary}}</span></div>',
				'<div><span class=si-term>Annual pension contribution to Public School Retirement System of 14.5%</span><span class=si-desc> {{annual-pension-contribution}}</span></div>',
				'<div><span class=si-term>Additional annuity</span><span class=si-desc> {{annuity}}</span></div>',
				'<div><span class=si-term>Total salary/compensation and retirement (plus additional compensation, stipends, or expense as noted below)</span><span class=si-desc> {{total-costs}}</span></div>',
				'<div><span class=si-term>Other compensation/ expenses notes</span><span class=si-desc> {{other-compensation}}</span></div>',
				'<div><span class=si-term>Insurance</span><span class=si-desc> {{insurance}}</span></div>',
				'<div><span class=si-term>Notes about this contract</span><span class=si-desc> {{notes}}</span></div>',
				'<div><span class=si-term>Paid leave days provided</span><span class=si-desc> {{leave-days-annually}}</span></div>',
				'<div><span class=si-term>Membership dues paid by district</span><span class=si-desc> {{paid-dues-to-organizations}}</span></div>',
				'<div><span class=si-term>Mileage/use of vehicle</span><span class=si-desc> {{mileage}}</span></div>',
				'<div><span class=si-term>Meals/lodging on trips</span><span class=si-desc> {{meals-lodging}}</span></div>',
				'<div><span class=si-term>Other expenses</span><span class=si-desc> {{other-expenses}}</span></div>',
				'<div><span class=si-term>Personal benefits</span><span class=si-desc> {{personal-benefits}}</span></div>',
				'<div><span class=si-term>2014 District Budget</span><span class=si-desc> {{budget-2014}}</span></div>',
				'<div><span class=si-term>2014 Student Enrollment</span><span class=si-desc> {{enrollment-for-2014}}</span></div>',
				'<div><span class=si-term>2015 MAP Score – English</span><span class=si-desc> {{map-english-2015}}</span></div>',
				'<div><span class=si-term>2015 MAP Score – Math</span><span class=si-desc> {{map-math-2015}}</span></div>',
			'</div>'
		].join(''),
    engine: Hogan,
    limit: 25
  });



});
