<?php

namespace Fromholdio\SherlockPages\Model;

use \Page;
use Fromholdio\Sherlock\Model\SearchEngineEntry;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\FieldType\DBIndexable;
use SilverStripe\Versioned\Versioned;

class PageSearchEngineEntry extends DataObject implements SearchEngineEntry
{
    private static $table_name = 'PageSearchEngineEntry';
    private static $singular_name = 'Page Search Engine Entry';
    private static $plural_name = 'Page Search Engine Entries';

    private static $extensions = [
        Versioned::class
    ];

    private static $indexes = [
        'TitleFields' => [
            'type' => DBIndexable::TYPE_FULLTEXT,
            'columns' => [
                'Title',
                'MenuTitle'
            ]
        ],
        'ContentFields' => [
            'type' => DBIndexable::TYPE_FULLTEXT,
            'columns' => [
                'Content',
                'MetaDescription'
            ]
        ],
        'SearchEngineID' => true
    ];

    private static $db = [
        'Title' => 'Varchar',
        'MenuTitle' => 'Varchar',
        'URLSegment' => 'Varchar',
        'MetaDescription' => 'Text',
        'Content' => 'Text'
    ];

    private static $has_one = [
        'SearchEngine' => PageSearchEngine::class,
        'Page' => Page::class
    ];

    private static $default_sort = 'Title DESC';

    public function getRecord()
    {
        return $this->Page();
    }
}
