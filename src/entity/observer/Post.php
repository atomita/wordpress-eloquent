<?php

namespace atomita\wordpress\eloquent\observer;

use Carbon\Carbon;

class Post
{
    function saving($record)
    {
        if (! $record->isDirty('post_modified_gmt')) {
            $record->post_modified_gmt = new Carbon(null, 'GMT');
        }
    }

    function creating($record)
    {
        if (! $record->isDirty('post_date_gmt')) {
            $record->post_date_gmt = new Carbon(null, 'GMT');
        }
    }

}
