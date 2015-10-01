<?php

namespace App\Cortejando\Transformers;


class UserTransformer extends Transformer
{
    /**
     * Transform api results to meaningful output
     *
     * @param $user
     * @return array
     */
    public function transform($user)
    {
        return [
            'complete_name' => $user['name'],
            'overview'      => $user['description'],
            'date_of_birth' => $user['dob'],
            'gender'        => $user['gender']
        ];
    }
}