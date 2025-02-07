jQuery(document).ready(function ($) {
    // Function to toggle visibility of dependent inputs
    function toggleDependentInputs()
    {
        $('[data-depends-on]').each(function () {
            var $dependentInput = $(this);
            var dependsOn = $dependentInput.data('depends-on');
            var dependsValue = $dependentInput.data('depends-value');
            var $criticalInput = $('#' + dependsOn);

            if ($criticalInput.length) {
                var isVisible = false;

                if ($criticalInput.is(':checkbox')) {
                    // For checkboxes
                    isVisible = $criticalInput.is(':checked');
                } else if ($criticalInput.is('select')) {
                    // For select inputs
                    isVisible = $criticalInput.val() === dependsValue;
                }

                // Toggle visibility
                $dependentInput.closest('tr').toggle(isVisible);
            }
        });
    }

    // Initial toggle on page load
    toggleDependentInputs();

    // Toggle on change of critical inputs
    $('[id="accept_my_cookies_customize_button_enabled"], [id="accept_my_cookies_google_consent_mode_enabled"], [id="accept_my_cookies_banner_color_style"]').on('change', function () {
        toggleDependentInputs();
    });
});