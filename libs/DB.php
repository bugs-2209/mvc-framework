<?php

namespace Framework\libs;

class DB {

    const HOST = 'localhost';

    const USERNAME = 'root';

    const PASSWORD = '';

    const DB_NAME = 'test';

    public function connect() {
        
        $connec = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD, self::DB_NAME);

        mysqli_set_charset($connec, 'utf8');

        if (mysqli_connect_errno() == 0) {
            return $connec;
        }

        return false;
    }
}

