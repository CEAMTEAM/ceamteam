export default {
  init() {
    console.log("msip5");
    jQuery(function($) {
      //Clears all the local storage data
      //window.localStorage.clear();

      $(".msip5").typeahead({
        name: "MSIP5",
        valueKey: "school",
        prefetch: "/wp-content/themes/ceam18/vendor/typeahead/msipMini.json",
        template: [
          '<div class="reportCard">',
          '<h6 class="reportCard__item"><span class="reportCard__itemTitle">School</span>{{school}}</h6>',
          '<h6 class="reportCard__item"><span class="reportCard__itemTitle">District</span>{{agency}}</h6>',
          '<h6 class="reportCard__item"><span class="reportCard__itemTitle">Grade </span>{{grade}} ({{percentage}}%)</h6>',
          '<div class="badge">',
          "<span>{{grade}}</span>",
          "</div>",
          "</div>"
        ].join(""),
        engine: Hogan,
        limit: 25
      });
    });
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  }
};
