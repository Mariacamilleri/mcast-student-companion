<?php
    // Connects to the MySQL database.
    function connect()
    {
        // 1. Assign a new connection to a new variable.
        $link = mysqli_connect('localhost', 'root', '', 'mcast_sc_db')
            or die('Could not connect to the database.');

        // 2. Give back the variable so we can always use it.
        return $link;
    }

    // Disconnects the website from the database.
    function disconnect(&$link)
    {
        mysqli_close($link);
    }

    function add_note($text, $user_id){

        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            INSERT INTO tbl_notes
                (text, tbl_users_id)
            VALUES
                (?, ?)
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: string string double integer double
        mysqli_stmt_bind_param($stmt, 'si', $text, $user_id);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have a new primary key ID.
        return mysqli_stmt_insert_id($stmt);
    }

    // verifies the password according to the email generated.
    function check_password($email, $password)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Protect variables to avoid any SQL injection
        $email = mysqli_real_escape_string($link, $email);

        // 3. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT id, password, salt
            FROM tbl_users
            WHERE email = '{$email}'
        ");

        // 4. Disconnect from the database.
        disconnect($link);

        // 5. If no record exists, we can stop here.
        if (!$record = mysqli_fetch_assoc($result))
        {
            return FALSE;
        }

        // 6. We can check that the password matches what is on record.
        $password = $record['salt'].$password;
        if (!password_verify($password, $record['password']))
        {
            return FALSE;
        }

        // 7. all is fine
        return $record['id'];
    }

    // Writes the new login data to the auth table.
    function set_login_data($id, $code, $ip_address, $expiration)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            INSERT INTO tbl_user_auth
                (user_id, auth_code, ip_address, expiration)
            VALUES
                (?, ?, ?, ?)
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: string string double integer double
        mysqli_stmt_bind_param($stmt, 'issi', $id, $code, $ip_address, $expiration);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have a new primary key ID.
        return mysqli_stmt_affected_rows($stmt);
    }

    // Retrieves the login data for a user.
    function get_login_data($id, $ip_address)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Protect variables to avoid any SQL injection
        $id = mysqli_real_escape_string($link, $id);
        $ip_address = mysqli_real_escape_string($link, $ip_address);

        // 3. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT
                a.id,
                a.email,
                b.name,
                b.surname,
                c.auth_code,
                c.expiration
            FROM
                tbl_users a
            LEFT JOIN
                tbl_user_details b
            ON
                a.id = b.user_id
            LEFT JOIN
                tbl_user_auth c
            ON
                a.id = c.user_id
            WHERE
                a.id = {$id} AND c.ip_address = '{$ip_address}'
        ");

        // 4. Disconnect from the database.
        disconnect($link);

        // 5. There should only be one row, or FALSE if nothing.
        return mysqli_fetch_assoc($result) ?: FALSE;
    }

    // Clears the login data from a table.
    function clear_login_data($id, $auth_code)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            DELETE FROM tbl_user_auth
            WHERE user_id = ? AND auth_code = ?
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: integer string
        mysqli_stmt_bind_param($stmt, 'is', $id, $auth);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have changed one row.
        return mysqli_stmt_affected_rows($stmt) == 1;
    }

    // Checks if an email is already registered.
    function email_exists($email)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Protect variables to avoid any SQL injection
        $email = mysqli_real_escape_string($link, $email);

        // 3. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT id
            FROM tbl_users
            WHERE email = '{$email}'
        ");

        // 4. Disconnect from the database.
        disconnect($link);

        // 5. There should only be one row, or FALSE if nothing.
        return mysqli_num_rows($result) >= 1;
    }

    // Checks that a user is logged into the system
    function is_logged()
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. we'll need the information from the cookies.
        $id         = array_key_exists('id', $_COOKIE) ? $_COOKIE['id'] : 0;
        $auth_code  = array_key_exists('auth_code', $_COOKIE) ? $_COOKIE['auth_code'] : '';

        // 3. Protect variables to avoid any SQL injection
        $id = mysqli_real_escape_string($link, $id);
        $auth_code = mysqli_real_escape_string($link, $auth_code);
        $expiration = mysqli_real_escape_string($link, time());

        // 4. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT user_id
            FROM tbl_user_auth
            WHERE
                user_id = {$id} AND
                auth_code = '{$auth_code}' AND
                expiration > {$expiration}
        ");

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. There should only be one row, or FALSE if nothing.
        return mysqli_num_rows($result) == 1;
    }

    // generates a random code
	function random_code($limit = 8)
	{
	    return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
	}

    // Registers a user's login data.
    function register_login_data($email, $password, $salt)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. protect the password using blowfish.
        $password = password_hash($salt.$password, CRYPT_BLOWFISH);

        // 3. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            INSERT INTO tbl_users
                (email, password, salt, creation_date)
            VALUES
                (?, ?, ?, ?)
        ");

        // 4. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: string string double integer double
        mysqli_stmt_bind_param($stmt, 'sssi', $email, $password, $salt, time());

        // 5. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 6. Disconnect from the database.
        disconnect($link);

        // 7. If the query worked, we should have a new primary key ID.
        return mysqli_stmt_insert_id($stmt);
    }

    // Registers a user's login data.
    function register_user_details($id, $name, $surname)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            INSERT INTO tbl_user_details
                (user_id, name, surname)
            VALUES
                (?, ?, ?)
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: string string double integer double
        mysqli_stmt_bind_param($stmt, 'iss', $id, $name, $surname);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have a new primary key ID.
        return mysqli_stmt_affected_rows($stmt);
    }



    // Retrieves all the notes available in the database.
    function get_notes_for_user($user_id)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Retrieve all the rows from the table.
        $result = mysqli_query($link, "
            SELECT *
            FROM tbl_notes
            WHERE tbl_users_id = {$user_id}
        ");

        echo mysqli_error($link);

        // 3. Disconnect from the database.
        disconnect($link);

        // 4. Return the result set.
        return $result;
    }

?>
