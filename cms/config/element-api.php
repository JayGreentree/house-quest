<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        'api/news.json' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'marketNews'],
                'transformer' => function(Entry $entry) {
                    return [
                        'title' => $entry->title,
                        'slug' => $entry->slug,
                        'url' => $entry->url,
                        'postDate' => $entry->postDate->format('Y-m-d'),
                        'articleSummary' => $entry->summaryText,
                        'articleCopy' => $entry->richText,
                        'jsonUrl' => UrlHelper::url("api/news/{$entry->slug}.json")
                    ];
                }
            ];
        },
        'api/news/<slug:{slug}>.json' => function($slug) {
            return [
                'elementType' => Entry::class,
                'criteria' => [
                  'section' => 'marketNews',
                  'slug' => $slug
              ],
              'one' => true,
              'transformer' => function(Entry $entry) {
                return [
                    'title' => $entry->title,
                    'articleSummary' => (string)$entry->summaryText,
                    'articleCopy' => $entry->richText,
                ];
              }
            ];
        }
    ]
];