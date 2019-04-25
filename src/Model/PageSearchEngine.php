<?php

namespace Fromholdio\SherlockPages\Model;

use \Page;
use Fromholdio\Sherlock\Model\SearchEngine;
use SilverStripe\Core\Convert;

class PageSearchEngine extends SearchEngine
{
    private static $table_name = 'PageSearchEngine';
    private static $singular_name = 'Page Search Engine';
    private static $plural_name = 'Page Search Engines';

    private static $engine_entry_class = PageSearchEngineEntry::class;

    private static $engine_config = [
        'direct' => [
            'Title',
            'URLSegment'
        ],
        'fields' => [
            'TitleFields:FulltextBooleanRelevance(2)',
            'ContentFields:FulltextBooleanRelevance'
        ]
    ];

    private static $engine_sort_config = [
        'direct' => [
            'title' => [
                'name' => 'Alphabetical by Title',
                'sql' => 'Title'
            ],
            'lastedited' => [
                'name' => 'By last edited date',
                'sql' => 'LastEdited'
            ],
            'default' => 'title'
        ],
        'fields' => [
            'relevance' => [
                'name' => 'Relevance',
                'sql' => '@TitleFieldsScore + @ContentFields',
                'direction' => 'DESC'
            ],
            'title' => [
                'name' => 'Alphabetical by Title',
                'sql' => 'Title'
            ],
            'lastedited' => [
                'name' => 'By last edited date',
                'sql' => 'LastEdited'
            ],
            'default' => 'relevance'
        ]
    ];

    public function isValidRecord($record)
    {
        $valid = (
            is_a($record, Page::class)
            && $record->ShowInSiteSearch
        );
        if (!$valid) {
            return false;
        }
        return parent::isValidRecord($record);
    }

    public function loadRecord($record, $entry = null)
    {
        if (!$entry) {
            $entry = $this->findOrMakeEntry($record);
        }
        $entry->Created = $record->Created;
        $entry->LastEdited = $record->LastEdited;
        $entry->Title = $record->Title;
        $entry->MenuTitle = $record->MenuTitle;
        $entry->URLSegment = $record->URLSegment;
        $entry->MetaDescription = $record->MetaDescription;
        if ($record->hasMethod('getSearchContent')) {
            $entry->Content = Convert::html2raw($record->getSearchContent());
        }
        else {
            $entry->Content = Convert::html2raw($record->Content);
        }
        $entry->PageID = $record->ID;
        $entry->SearchEngineID = $this->ID;
        return $entry;
    }

    public function getRecords($entries = null)
    {
        if (!$entries) {
            $entries = $this->getEntries();
        }
        $entryIDs = $entries->columnUnique('PageID');
        if (count($entryIDs) < 1) {
            return null;
        }
        $entryIDsString = implode(',', $entryIDs);
        $pages = Page::get()->filter('ID', $entryIDs);
        $selectFields = $pages->dataQuery()->getFinalisedQuery()->getSelect();
        return $pages->sort('FIELD(' . $selectFields['ID'] . ', ' . $entryIDsString . ')');
    }

    protected function getEntryFilter($record)
    {
        return [
            'PageID' => $record->ID,
            'SearchEngineID' => $this->ID
        ];
    }
}
