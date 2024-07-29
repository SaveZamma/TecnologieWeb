<?php

namespace App\Models;

class Job
{
    public static function all(): array
    {
        return [
            [
                'id'=>1,
                'title'=>'Director',
                'salary'=>'$50000'
            ]
        ];
    }
}
