<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Kanye Quotes
    |--------------------------------------------------------------------------
    |
    | Below you may configure whether the quotes are retrieved from https://api.kanye.rest/
    | using "kanye_rest" driver, or from a selection of hard-coded known
    | quotes using the "fake" driver.
    |
    | Supported Drivers: "kanye_rest", "fake"
    |
    */
    'driver' => env('KANYE_DRIVER', 'kanye_rest'),
];
