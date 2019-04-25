<?php

namespace Fromholdio\SherlockPages\Extensions;

use Fromholdio\Sherlock\Model\SearchEngine;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class SherlockSiteConfigExtension extends DataExtension
{
    private static $has_one = [
        'PrimarySearchEngine' => SearchEngine::class
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab(
            'Root.Main',
            DropdownField::create(
                'PrimarySearchEngineID',
                $this->getOwner()->fieldLabel('PrimarySearchEngine'),
                SearchEngine::get()->map()->toArray()
            )
        );
    }
}
