<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/27/17
 * Time: 10:37 PM
 */

namespace Hudutech\Auth;

use Hudutech\DBManager\DB;

/**
 * Class Auth
 *
 */
class Auth
{

    /**
     * @var
     */
    private $token;

    /**
     * @param $username
     * @param $password
     * @return array
     */
    public static function authenticate($username, $password)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM `users` WHERE `username`=:username");
            $stmt->bindParam(":username", $username);

            $stmt->execute();

            if ($stmt->rowCount() == 1) {

                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                if (password_verify($password, $row['password'])) {
                    if ($row['isActive'] == 0) {
                        return ["error" => "Your Account Has Been Temporally blocked Contact Admin"];
                    }
                    if ($row['isActive'] == 1) {
                        return ["success" => "Authenticated Successfully"];
                    } else {
                        return ["error" => "Invalid Login Credentials Supplied."];
                    }
                } else {
                    return ["error" => "Invalid Login Credentials Supplied."];
                }

            } else {
                return ["error" => "Invalid Login Credentials Supplied."];
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return ["error" => "Internal Server error occurred Try again later."];
        }
    }

    /**
     * Generate a csrf_token to
     * prevent form submission from other sites
     * using js or other means
     * --This variable should be sent in session
     * for every form submission and check if it matches
     * on submitting the form
     * Unset the session on successful form submission
     * @return string
     */
    public function generateCSRFToken()
    {
        $this->token = md5(uniqid('auth', true));
        return $this->token;
    }

    /**
     * @param $username
     * @return null
     */
    public static function getLoggedInUser($username)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT username, userLevel FROM users WHERE username=:username");
            $stmt->bindParam(":username", $username);
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                return $row;
            } else {
                return null;
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return null;
        }
    }

    /**
     * @param $password
     * @return bool|string
     */
    public static function makePassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function changePassword($username, $newPassword)
    {
        $db = new DB();
        $conn = $db->connect();
        $password = self::makePassword($newPassword);

        try {
            $stmt = $conn->prepare("UPDATE `users` SET `password`=:password WHERE `username`=:username");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }
    public static function deactivateAccount($id) {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("UPDATE users SET isActive=0 WHERE id=:id");
            $stmt->bindParam(":id", $id);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function activateAccount($id){
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("UPDATE users SET isActive=1 WHERE id=:id");
            $stmt->bindParam(":id", $id);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }
}