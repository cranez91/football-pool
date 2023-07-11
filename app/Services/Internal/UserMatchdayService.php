<?php

namespace App\Services\Internal;

use App\Models\UserMatchday;
use Illuminate\Support\Str;

class UserMatchdayService {
    protected $model;

    public function __construct()
    {
        $this->model = new UserMatchday;
    }

    public function insert(array $data)
    {
        return $this->model->create($data);
    }

    public function insertMatches(UserMatchday $userMatch, $matches, array $predictions)
    {
        $userMatches = [];
        foreach ($predictions as $key => $value) {
            $match = $matches->where('game_id', $key)->first();
            $userMatches[] = [
                'uuid' => (string) Str::uuid(),
                'match_id' => $match->id,
                'prediction' => $value,
                'success' => 'N'
            ];
        }
        return $userMatch->userMatches()->createMany($userMatches);
    }
}