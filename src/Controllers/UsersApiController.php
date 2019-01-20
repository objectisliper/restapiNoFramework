<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 20.01.19
 * Time: 20:02
 */

namespace App\Controllers;

use App\Models\Users;
use Firebase\JWT\JWT;

class UsersApiController extends BaseController
{

    public function registerUser($request){
        $user = new Users();
        try {
            $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
            $user->setUsername($_POST['username']);
            $request['em']->persist($user);
            $request['em']->flush();
        } catch (\Exception $e){
            return $this->apiResponse(['success' => false], 500);
        }
        return $this->apiResponse(['success' => true], 200);
    }

    public function login($request){
        $password = $_POST['password'];
        $username = $_POST['username'];
        $user = $request['em']->getRepository('\App\Models\Users')->findBy(['username' => $username])[0];
        if (!empty($user)) {
            if (password_verify($password, $user->getPassword())) {
                require(__DIR__ . '/../../config/jwt-config.php');
                $token = array(
                    "iss" => $iss,
                    "aud" => $aud,
                    "iat" => $iat,
                    "nbf" => $nbf,
                    "data" => array(
                        "id" => $user->getId(),
                        "firstname" => $user->getUsername(),
                    )
                );
                $jwt = JWT::encode($token, $privateKey, 'RS256');
                $this->isAuthGuard($jwt);
                return $this->apiResponse(['success' => true, 'jwt' => $jwt], 200);
            } else {
                return $this->apiResponse(['success' => false, 'error' => 'wrong password'], 401);
            }
        }
        return $this->apiResponse(['success' => false, 'error' => 'user not exist'], 401);
    }

    public static function isAuthGuard($jwt){
        try {
            require(__DIR__ . '/../../config/jwt-config.php');
            // decode jwt
            JWT::decode($jwt, $publicKey, array('RS256'));

        }
        catch (\Exception $e){
            return false;
        }
        return true;
    }

}