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
