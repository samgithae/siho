<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/6/17
 * Time: 3:05 PM
 */

namespace Hudutech\Controller;

use Hudutech\AppInterface\UserInterface;
use Hudutech\Auth\Auth;
use Hudutech\DBManager\DB;
use Hudutech\Entity\User;

class UserController extends Auth implements UserInterface
{
    public function create(User $user)
    {
        $db = new DB();
        $conn = $db->connect();

        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $username = $user->getUsername();
        $userLevel = $user->getUserLevel();
        $password = $user->getPassword();
        $isActive = $user->isActive();

        try{
            $stmt = $conn->prepare("INSERT INTO users(
                                                                    firstName,
                                                                    lastName,
                                                                    email,
                                                                    username,
                                                                    userLevel,
                                                                    password,
                                                                    isActive
                                                                ) VALUES (
                                                                    :firstName,
                                                                    :lastName,
                                                                    :email,
                                                                    :username,
                                                                    :userLevel,
                                                                    :password,
                                                                    :isActive
                                                                ) 
                                                                ");
            $stmt->bindParam(":firstName", $firstName);
            $stmt->bindParam(":lastName", $lastName);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":userLevel", $userLevel);
            $stmt->bindParam(":password",$password);
            $stmt->bindParam(":isActive",$isActive);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public function update(User $user, $id)
    {
        $db = new DB();
        $conn = $db->connect();

        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $username = $user->getUsername();
        $userLevel = $user->getUserLevel();
        $password = $user->getPassword();
        $isActive = $user->isActive();

        try{
            $stmt = $conn->prepare("UPDATE users SET
                                                            firstName=:firstName,
                                                            lastName=:lastLogin,
                                                            email=:email,
                                                            username=:username,
                                                            userLevel=:userLevel,
                                                            password=:password,
                                                            isActive=:isActive
                                                        WHERE
                                                            id=:id
                                                        ");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":firstName", $firstName);
            $stmt->bindParam(":lastName", $lastName);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":userLevel", $userLevel);
            $stmt->bindParam(":password",$password);
            $stmt->bindParam(":isActive",$isActive);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function delete($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("DELETE FROM users WHERE id=:id");
            $stmt->bindParam(":id", $id);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function destroy()
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("DELETE FROM users");
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }


    public static function getId($id)
    {
        $db = new DB();
        $conn = $db->connect();
        try{
            $stmt = $conn->prepare("SELECT t.* FROM users t WHERE t.id=:id");
            $stmt->bindParam(":id", $id);
            return $stmt->execute() && $stmt->rowCount() == 1 ? $stmt->fetch(\PDO::FETCH_ASSOC) : [];
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function getObject($id)
    {
        $db = new DB();
        $conn = $db->connect();
        try{
            $stmt = $conn->prepare("SELECT t.* FROM users t WHERE t.id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->setFetchMode(\PDO::FETCH_CLASS |\PDO::FETCH_PROPS_LATE, User::class);
            return $stmt->execute() && $stmt->rowCount() == 1 ? $stmt->fetch() : null;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function all()
    {
        $db = new DB();
        $conn = $db->connect();
        try{
            $stmt = $conn->prepare("SELECT t.* FROM users t WHERE 1");
            return $stmt->execute() && $stmt->rowCount() > 0 ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

}