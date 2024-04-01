<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

class Import extends Layout
{
    protected function renderPage(Context $context): string
    {
        // @codingStandardsIgnoreStart
        return <<<HTML
    <p>Data has been imported from JSON Files to Database - You're good to go!</p>
HTML;
        // @codingStandardsIgnoreEnd
    }
}