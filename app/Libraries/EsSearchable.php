<?php
/**
 * Created by PhpStorm.
 * User: arun
 * Date: 2018-12-26
 * Time: 23:26
 */

namespace App\Libraries;

trait EsSearchable
{
    public $searchSettings = [
        'attributesToHighlight' => [
            '*'
        ]
    ];

    public $highlight = [];
}