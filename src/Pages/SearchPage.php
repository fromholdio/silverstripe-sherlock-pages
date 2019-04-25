<?php

namespace Fromholdio\SherlockPages\Pages;

use Fromholdio\Sherlock\Extensions\SearchPageExtension;
use \Page;

class SearchPage extends Page
{
    private static $table_name = 'SearchPage';
    private static $singular_name = 'Search Page';
    private static $plural_name = 'Search Pages';
    private static $description = 'Search page';
    private static $icon = 'resources/app/client/icons/search.svg';

    private static $extensions = [
        SearchPageExtension::class
    ];
}
