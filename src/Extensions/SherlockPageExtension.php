<?php

namespace Fromholdio\SherlockPages\Extensions;

use SilverStripe\CMS\Model\SiteTreeExtension;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;

class SherlockPageExtension extends SiteTreeExtension
{
    private static $db = [
        'ShowInSiteSearch' => 'Boolean'
    ];

    private static $defaults = [
        'ShowInSiteSearch' => 1
    ];

    private static $field_labels = [
        'ShowInSiteSearch' => 'Show in site search?'
    ];

    public function updateSettingsFields(FieldList $fields)
    {
        $siteSearch = CheckboxField::create(
            'ShowInSiteSearch',
            $this->getOwner()->fieldLabel('ShowInSiteSearch')
        );
        $showInSearch = $fields->dataFieldByName('ShowInSearch');
        $showInSearch->setTitle('Show in search engines?');
        $fields->insertAfter('ShowInSearch', $siteSearch);
    }
}
