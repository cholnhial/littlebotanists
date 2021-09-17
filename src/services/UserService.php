<?php

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

}