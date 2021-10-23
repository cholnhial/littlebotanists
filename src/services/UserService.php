<?php

/**
 *
 * Handles all user related functionality
 *
 * Class UserService
 */
class UserService
{

    /**
     * Checks whether a given name is taken or available
     *
     * @param $name string the name to check
     * @return bool true if name is taken false otherwise
     */
    public function isNameTaken($name) {
        global $databaseHandle;

        $stmt = $databaseHandle->prepare("SELECT * FROM users WHERE name=:name");
        $stmt->execute(['name' => $name]);
        $user = $stmt->fetch();

        if ($user == false) {
            return false;
        }

        return true;
    }

    /**
     *  Returns all the users along with scores
     */
    public function getUsersWithScores() {
        global $databaseHandle;
        $stmt = $databaseHandle->prepare("SELECT * FROM users WHERE score > 0 ORDER BY score DESC");
        $stmt->execute();
        $users = array();
        $count = 1;
        while($user = $stmt->fetch()) {
            $users[$count] = $user;
            $count++;
        }

        return $users;
    }

    public function getUsersWithMatchingGameTime() {
        global $databaseHandle;
        $stmt = $databaseHandle->prepare("SELECT * FROM users WHERE best_matching_game_time > 0 ORDER BY best_matching_game_time ASC");
        $stmt->execute();
        $users = array();
        $count = 1;
        while($user = $stmt->fetch()) {
            $users[$count] = $user;
            $count++;
        }

        return $users;
    }


    /**
     *
     * Saves the username to the database
     *
     * @param $name
     * @return bool
     */
    public function saveName($name) {
        global $databaseHandle;

        $sql = "INSERT INTO users (name) VALUES (?)";
        $stmt= $databaseHandle->prepare($sql);
       if(!$stmt->execute([$name])) {
           return false;
       }

       return true;
    }

    /**
     * Saves the user score to the database if the user exists
     *
     * @param $name
     * @param $score
     * @return bool
     */
    public function updateUserScore($name, $score) {
        global $databaseHandle;

        $stmt = $databaseHandle->prepare("SELECT * FROM users WHERE name=:name");
        $stmt->execute(['name' => $name]);
        $user = $stmt->fetch();

        $sql = "UPDATE users SET score=? WHERE `name`=?";
        $stmt = $databaseHandle->prepare($sql);
        if(!$stmt->execute([$user['score'] + $score,  $name])) {
            return false;
        }

        return true;
    }

    /**
     * Saves the user matching game best time to the database if the user exists
     *
     * @param $name
     * @param $score
     * @return bool
     */
    public function updateMatchingGameTime($name, $time) {
        global $databaseHandle;

        $stmt = $databaseHandle->prepare("SELECT * FROM users WHERE name=:name");
        $stmt->execute(['name' => $name]);
        $user = $stmt->fetch();

        $sql = "UPDATE users SET best_matching_game_time=? WHERE `name`=?";
        $stmt = $databaseHandle->prepare($sql);
        if($user['best_matching_game_time'] == 0 || $user['best_matching_game_time']  > $time) {
            if(!$stmt->execute([$time,  $name])) {
                return false;
            }
        }

        return true;
    }

}