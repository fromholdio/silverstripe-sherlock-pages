<?php

namespace Fromholdio\SherlockPages\Extensions;

use Fromholdio\Sherlock\Forms\SearchForm;
use SilverStripe\Core\Extension;
use SilverStripe\SiteConfig\SiteConfig;

class SherlockContentControllerExtension extends Extension
{
    private static $allowed_actions = [
        'SherlockForm'
    ];

    public function SherlockForm()
    {
        $siteConfig = SiteConfig::current_site_config();
        if (!$siteConfig->PrimarySearchEngineID) {
            return null;
        }

        return SearchForm::create(
            $this->getOwner(),
            'SherlockForm',
            $siteConfig->PrimarySearchEngineID,
            $this->getOwner()->data()->ID,
            'Search',
            'Go',
            'Search by keyword'
        );
    }
}
