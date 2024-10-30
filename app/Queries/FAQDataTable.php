<?php

namespace App\Queries;

use App\Models\FAQ;

/**
 * Class FAQDataTable
 */
class FAQDataTable
{
    public function get(): FAQ
    {
        /** @var FAQ $query */
        $query = FAQ::query()->select('faqs.*');

        return $query;
    }
}
