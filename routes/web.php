<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Symfony\Component\HttpKernel\Exception\HttpException;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('/', function () {
    $request = request()->json()->all();

    $name = $request["name"] ?? $request["name"] ?? null;
    $lastName = $request["lastName"] ?? null;
    $email = $request["email"] ?? null;
    $password = $request["password"] ?? null;
    $phoneNumber = $request["phoneNumber"] ?? null;

    $errors = [];

    if (is_null($name)) {
        $errors["name"] = "You must inform your name";
    }

    if (is_null($lastName)) {
        $errors["lastName"] = "You must inform your last name";
    }

    if (is_null($email)) {
        $errors["email"] = "You must inform your email";
    }

    if (is_null($password)) {
        $errors["password"] = "You must inform your password";
    }

    if (strlen($password) < 6) {
        $errors["passwordCount"] = "Your password must be longer than 6 characters";
    }

    if (
        !is_string($name) ||
        !is_string($lastName) ||
        !is_string($email) ||
        !is_string($password) ||
        !is_string($phoneNumber)
    ) {
        $errors["others"][] = "Some data value is not a string";
    }
      
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Email that you informed is not valid";
    }

    if (count($errors)) {
        return response($errors, 400);
    }
    
    return response([
        "name" => $name,
        "lastName" => $lastName,
        "email" => $email,
        "phoneNumber" => $phoneNumber
    ], 201);
});

$router->get('/', function () use ($router) {
    return "Yooo, just try to post me ;)";
});