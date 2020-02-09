
// UI-Panels.js
// ====================================================================
// This file should not be included in your project.
// This is just a sample how to initialize plugins or components.
//
// - Designbudy.com -


 $(document).ready(function() {


	// UI DRAG & DROP PANEL
	// =================================================================
	// Require Bootstrap Button
	// -----------------------------------------------------------------
	// http://getbootstrap.com/javascript/#buttons
	// =================================================================

    $(".grid").sortable({
        tolerance: 'pointer',
        revert: 'invalid',
        handle: '.panel-heading',
        connectWith: '.row > [class*=col]',
        placeholder: 'well placeholder tile',
        forceHelperSize: true
    });

    $("[data-click=timeline-collapse-1]").closest(".tab-base").find(".timeline-body-1").slideToggle();
    $("[data-click=timeline-collapse-1]").click(function(e) {
        e.preventDefault();
        $(this).closest(".tab-base").find(".timeline-body-1").slideToggle();
        $(this).children('.fa').toggleClass('fa-chevron-up fa-chevron-down');
    });
    
    $("[data-click=timeline-collapse-2]").closest(".tab-base").find(".timeline-body-2").slideToggle();
    $("[data-click=timeline-collapse-2]").click(function(e) {
        e.preventDefault();
        $(this).closest(".tab-base").find(".timeline-body-2").slideToggle();
        // $(this).children('.fa').toggleClass('fa-chevron-up fa-chevron-down');
    });

 });