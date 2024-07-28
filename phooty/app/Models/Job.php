<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Job
{
  public static function all(): array
  {
    return [
      [
        'id' => 1,
        'title' => 'Human Hunter',
        'salary' => '$100000',
      ],
      [
        'id' => 2,
        'title' => 'Human Recruiter',
        'salary' => '$20000',
      ],
      [
        'id' => 3,
        'title' => 'Human Butcher',
        'salary' => '$40000',
      ]
    ];
  }

  public static function find(int $id): array
  {
    $job = Arr::first(static::all(), fn($job) => $job['id'] == $id);

    if ($job == null) {
      abort(404);
    }

    return $job;
  }
}
