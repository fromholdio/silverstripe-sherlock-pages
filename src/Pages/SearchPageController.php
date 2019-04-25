<?php

namespace Fromholdio\SherlockPages\Pages;

use Fromholdio\Sherlock\Extensions\SearchControllerExtension;
use \PageController;

class SearchPageController extends PageController
{
    private static $extensions = [
        SearchControllerExtension::class
    ];
}
