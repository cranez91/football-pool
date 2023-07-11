<?php

namespace App\Services\Internal;

use App\Models\Matchday;

class MatchdayService {
    protected $model;

    public function __construct()
    {
        $this->model = new Matchday;
    }

    public function getItemBySlug(string $slug)
    {
        return $this->model->with('matches')->where('slug', $slug)->first();
    }
}