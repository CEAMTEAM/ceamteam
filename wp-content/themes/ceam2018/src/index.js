import "jquery";
import "./style.styl";
import Headroom from "./vendor/headroom.js";

import Hogan from "./vendor/hogan/lib/hogan.js";
import "./vendor/typeahead/typeahead.min.js";

// import "./vendor/typeahead/superintendant-information.js";
// import "./vendor/msip5/msip5.js";
// import "./vendor/msip5/msip5_2014.js";

import Router from "./util/Router";
import common from "./routes/common";
import home from "./routes/home";
// import msip5 from "./routes/msip5";

// grab an element
var headr = document.querySelector("header");
// construct an instance of Headroom, passing the element
var headroom = new Headroom(headr, {
  offset: 205,
  tolerance: 5,
  classes: {
    initial: "animated",
    pinned: "slideDown",
    unpinned: "slideUp"
  }
});
// initialise
headroom.init();

// https://www.jamestease.co.uk/blether/add-remove-or-toggle-classes-using-vanilla-javascript

var ceam = ceam || {};

// same functions as above
ceam.nav = (function() {
  function mobileMenu() {
    var burgerBtn = document.querySelector(".hamburger");
    var burgerIcon = burgerBtn.getElementsByTagName("div")[0];
    var closeIcon = burgerBtn.getElementsByTagName("div")[2];
    var manageScroll = document.getElementById("manageScroll");

    // querySelector returns the first element it finds with the correct selector
    // addEventListener is roughly analogous to $.on()
    burgerBtn.addEventListener("click", function(e) {
      e.preventDefault();

      // querySelectorAll returns all the nodes it finds with the selector
      // however, you can't iterate over querySelectorAll results (!!)
      // so this is a workaround - call Array.map and pass in the
      // list of nodes along with a function
      // technically querySelectorAll returns a NodeList not an Array so
      /// doesn't have standard array functions
      [].map.call(document.querySelectorAll(".nav__layer"), function(el) {
        // classList is the key here - contains functions to manipulate
        // classes on an element
        el.classList.toggle("nav--active");
      });
      burgerIcon.classList.toggle("hide");
      closeIcon.classList.toggle("hide");
      manageScroll.classList.toggle("manageScroll");
    });
  }

  return {
    mobileMenu: mobileMenu
  };
})();

ceam.helpers = (function() {
  function jsCheck() {
    // again, use classList to manipulate classes on elements
    var bodyClass = document.querySelector("html").classList;
    bodyClass.remove("no-js");
    bodyClass.add("js");
  }

  return {
    jsCheck: jsCheck
  };
})();

// start everything
// this isn't in a doc.ready - loaded at the bottom of the page so the DOM is already ready
ceam.helpers.jsCheck();
ceam.nav.mobileMenu();

jQuery(function($) {
  //Clears all the local storage data
  window.localStorage.clear();

  $(".school-district").typeahead({
    name: "superindentent_info_school_district",
    valueKey: "school-district",
    prefetch:
      "/wp-content/themes/ceam13/lib/js/typeahead/superintendant-information.json",
    template: [
      '<div class="si-reportCard">',
      "<div><span class=si-term>School Disctrict</span><span class=si-desc> {{school-district}}</span></div>",
      "<div><span class=si-term>Superintendent</span><span class=si-desc> {{superintendent}}</span></div>",
      "<div><span class=si-term>Salary</span><span class=si-desc> {{salary}}</span></div>",
      "<div><span class=si-term>Annual pension contribution to Public School Retirement System of 14.5%</span><span class=si-desc> {{annual-pension-contribution}}</span></div>",
      "<div><span class=si-term>Additional annuity</span><span class=si-desc> {{annuity}}</span></div>",
      "<div><span class=si-term>Total salary/compensation and retirement (plus additional compensation, stipends, or expense as noted below)</span><span class=si-desc> {{total-costs}}</span></div>",
      "<div><span class=si-term>Other compensation/ expenses notes</span><span class=si-desc> {{other-compensation}}</span></div>",
      "<div><span class=si-term>Insurance</span><span class=si-desc> {{insurance}}</span></div>",
      "<div><span class=si-term>Notes about this contract</span><span class=si-desc> {{notes}}</span></div>",
      "<div><span class=si-term>Paid leave days provided</span><span class=si-desc> {{leave-days-annually}}</span></div>",
      "<div><span class=si-term>Membership dues paid by district</span><span class=si-desc> {{paid-dues-to-organizations}}</span></div>",
      "<div><span class=si-term>Mileage/use of vehicle</span><span class=si-desc> {{mileage}}</span></div>",
      "<div><span class=si-term>Meals/lodging on trips</span><span class=si-desc> {{meals-lodging}}</span></div>",
      "<div><span class=si-term>Other expenses</span><span class=si-desc> {{other-expenses}}</span></div>",
      "<div><span class=si-term>Personal benefits</span><span class=si-desc> {{personal-benefits}}</span></div>",
      "<div><span class=si-term>2014 District Budget</span><span class=si-desc> {{budget-2014}}</span></div>",
      "<div><span class=si-term>2014 Student Enrollment</span><span class=si-desc> {{enrollment-for-2014}}</span></div>",
      "<div><span class=si-term>2015 MAP Score â€“ English</span><span class=si-desc> {{map-english-2015}}</span></div>",
      "<div><span class=si-term>2015 MAP Score â€“ Math</span><span class=si-desc> {{map-math-2015}}</span></div>",
      "</div>"
    ].join(""),
    engine: Hogan,
    limit: 25
  });

  $(".superintendant-information").typeahead({
    name: "superindentent_info",
    valueKey: "superintendent",
    prefetch:
      "/wp-content/themes/ceam13/lib/js/typeahead/superintendant-information.json",
    template: [
      '<div class="si-reportCard">',
      "<div><span class=si-term>School Disctrict</span><span class=si-desc> {{school-district}}</span></div>",
      "<div><span class=si-term>Superintendent</span><span class=si-desc> {{superintendent}}</span></div>",
      "<div><span class=si-term>Salary</span><span class=si-desc> {{salary}}</span></div>",
      "<div><span class=si-term>Annual pension contribution to Public School Retirement System of 14.5%</span><span class=si-desc> {{annual-pension-contribution}}</span></div>",
      "<div><span class=si-term>Additional annuity</span><span class=si-desc> {{annuity}}</span></div>",
      "<div><span class=si-term>Total salary/compensation and retirement (plus additional compensation, stipends, or expense as noted below)</span><span class=si-desc> {{total-costs}}</span></div>",
      "<div><span class=si-term>Other compensation/ expenses notes</span><span class=si-desc> {{other-compensation}}</span></div>",
      "<div><span class=si-term>Insurance</span><span class=si-desc> {{insurance}}</span></div>",
      "<div><span class=si-term>Notes about this contract</span><span class=si-desc> {{notes}}</span></div>",
      "<div><span class=si-term>Paid leave days provided</span><span class=si-desc> {{leave-days-annually}}</span></div>",
      "<div><span class=si-term>Membership dues paid by district</span><span class=si-desc> {{paid-dues-to-organizations}}</span></div>",
      "<div><span class=si-term>Mileage/use of vehicle</span><span class=si-desc> {{mileage}}</span></div>",
      "<div><span class=si-term>Meals/lodging on trips</span><span class=si-desc> {{meals-lodging}}</span></div>",
      "<div><span class=si-term>Other expenses</span><span class=si-desc> {{other-expenses}}</span></div>",
      "<div><span class=si-term>Personal benefits</span><span class=si-desc> {{personal-benefits}}</span></div>",
      "<div><span class=si-term>2014 District Budget</span><span class=si-desc> {{budget-2014}}</span></div>",
      "<div><span class=si-term>2014 Student Enrollment</span><span class=si-desc> {{enrollment-for-2014}}</span></div>",
      "<div><span class=si-term>2015 MAP Score â€“ English</span><span class=si-desc> {{map-english-2015}}</span></div>",
      "<div><span class=si-term>2015 MAP Score â€“ Math</span><span class=si-desc> {{map-math-2015}}</span></div>",
      "</div>"
    ].join(""),
    engine: Hogan,
    limit: 25
  });
});

/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
  /** All pages */
  common,
  /** Home page */
  home
  /** About Us page, note the change from about-us to aboutUs. */
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());

console.log("yo");
