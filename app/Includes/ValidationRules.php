<?php

namespace App\Includes;

use Respect\Validation\Validator as V;

class ValidationRules
{
    function common()
    {
        return [
            'email' => V::email(),
            'firstname' => V::notEmpty(),
            'lastname' => V::notEmpty(),
        ];
    }

    // POST /users
    function usersPost()
    {
        return [
            'email' => self::common()['email'],
            'firstname' => self::common()['firstname'],
            'lastname' => self::common()['lastname'],
        ];
    }
}
