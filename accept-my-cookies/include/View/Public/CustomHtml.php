<?php

namespace AcceptMyCookies\View\Public;

/**
 * CustomHtml
 *
 * Handles the rendering of the custom html in the <head>.
 */
class CustomHtml
{
    /**
     * @var array Plugin options.
     */
    private $options;

    /**
     * Constructor.
     *
     * @param array $options Plugin options.
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * Render the custom html.
     */
    public function render()
    {
        $this->renderCustomHtml();
    }

    /**
     * Render the HTML for the consent banner.
     */
    private function renderCustomHtml()
    {
        echo json_decode($this->options['custom_html_head'], true);
    }
}
