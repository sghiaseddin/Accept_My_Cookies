jQuery(document).ready(function ($) {
    // Handle tab clicks
    $('.nav-tab-wrapper a').on('click', function (e) {
        e.preventDefault(); // Prevent default link behavior

        // Get the target tab
        var targetTab = $(this).data('tab');
        var tabHref = $(this).attr('href');

        // Remove active class from all tabs
        $('.nav-tab').removeClass('nav-tab-active');

        // Add active class to the clicked tab
        $(this).addClass('nav-tab-active');

        // Hide all tab content
        $('.tab-content').hide();

        // Show the target tab content
        $('#' + targetTab + '-tab').show();

        // Update the URL without reloading the page
        var url = new URL(window.location);
        url.searchParams.set('tab', targetTab);
        history.pushState(null, '', url.pathname + url.search);
    });
});