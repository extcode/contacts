<?php
declare(strict_types=1);

use Extcode\Contacts\Domain\Model\Category;
use Extcode\Contacts\Domain\Model\TtContent;

return [
    Category::class => [
        'tableName' => 'sys_category',
    ],
    TtContent::class => [
        'tableName' => 'tt_content',
    ],
];
