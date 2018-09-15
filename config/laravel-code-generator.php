<?php

return [

/*
|--------------------------------------------------------------------------
| CodeGenerator config overrides
|--------------------------------------------------------------------------
|
| It is a good idea to sperate your configuration form the code-generator's
| own configuration. This way you won't lose any settings/preference
| you have when upgrading to a new version of the package.
|
| Additionally, you will always know any the configuration difference between
| the default config than your own.
|
| To override the setting that is found in the codegenerator.php file, you'll
| need to create identical key here with a different value
|
| IMPORTANT: When overriding an option that is an array, the configurations
| are merged together using php's array_merge() function. This means that
| any option that you list here will take presence during a conflict in keys.
|
| EXAMPLE: The following addition to this file, will add another entry in
| the common_definitions collection
|
|   'common_definitions' =>
|   [
|       [
|           'match' => '*_at',
|           'set' => [
|               'css-class' => 'datetime-picker',
|           ],
|       ],
|   ],
|
 */

    /*
    |--------------------------------------------------------------------------
    | Should the code generator organize the new migrations?
    |--------------------------------------------------------------------------
    |
    | This option will allow the code generator to group the migration related
    | to the same table is a separate folder. The folder name will be the name
    | of the table.
    |
    | It is recommended to set this value to true, then use crest apps command
    | to migrate instead of the build in command.
    |
    | php artisan migrate-all
    | php artisan migrate:rollback-all
    | php artisan migrate:reset-all
    | php artisan migrate:refresh-all
    | php artisan migrate:status-all
    |
     */
    'organize_migrations' => true,

    /*
    |--------------------------------------------------------------------------
    | The default output format for datetime fields.
    |--------------------------------------------------------------------------
    |
    | This output format can also be changed at the field level using the
    | "date-format" property of the field.
    |
     */
    'datetime_out_format' => 'j/n/Y g:i A',

    /*
    |--------------------------------------------------------------------------
    | Patterns to use to pre-set field's properties.
    |--------------------------------------------------------------------------
    |
    | To make constructing fields easy, the code-generator scans the field's name
    | for a matching pattern. If the name matches any of these patterns, the
    | field's properties will be set accordingly. Defining pattern will save
    | you from having to re-define the properties for common fields.
    |
     */
    'common_definitions' =>
    [
        [
            'match' => '*_at',
            'set' => [
                'css-class' => 'datetime-picker',
                'date-format' => 'j/n/Y g:i A',
            ],
        ],
        [
            'match' => ['*_date', 'date_*'],
            'set' => [
                'css-class' => 'date-picker',
                'date-format' => 'j/n/Y',
            ],
        ],
        [
            'match' => ['*_time', 'time_*'],
            'set' => [
                'css-class' => 'time-picker',
            ],
        ],
    ],

];
