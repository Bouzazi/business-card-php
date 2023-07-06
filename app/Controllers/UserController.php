<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Includes\ValidationRules as ValidationRules;
use \App\Models\User as User;

class UserController
{
    private $logger;
    private $db;
    private $validator;
    private $table;

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator)
    {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('users');
    }

    // POST /users
    // Create user
    public function create(Request $request, Response $response)
    {
        $this->logger->addInfo('POST /users');
        $data = $request->getParsedBody();
        $errors = [];
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, ValidationRules::usersPost());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }
        if (!$errors && User::where(['email' => $data['email']])->first()) {
            $errors[] = 'Email already exists';
        }
        if (!$errors) {
            // Input is valid, so let's do something...
            $new = new \App\Models\User($data);
            $new->save();
            // $newUser = User::create($data);
            return $response->withJson([
                'success' => true,
                'id' => $new
            ], 200);
        } else {
            // Error occured
            return $response->withJson([
                'success' => false,
                'errors' => $errors
            ], 400);
        }
    }
}
