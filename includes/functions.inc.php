<?php
/*
Mysql improved extension (mysqli) provides a procedural interface as well as  an object oriented interface . 
Inthis article we will look at some procedural function_exists
<strong>mysqli_connect()</strong>
This function is used for connecting to mysql . before doing ay database operation , you need to connect to mysql .
 on success this function returns link identifier that you can use in other mysqli functions . 
 on failure it will throw an error.

syntax : $conn = mysqli_connect('host_name','username','password','database_name',port_no);//port_no default is 3306
example  : $conn = mysqli_connect('localhost','studylink','studylink','contacts');
 */

 /*
 <strong>mysqli_connect_error()</strong>
 mysqli_connect throws an error at failure and mysqli_connect_error()
 stores the error in last call to mysqli_connect(). If there is no error it returns null.
 
code:
$conn = mysqli_connect('localhost','studylink','studylink','contacts');
if(mysqli_connect_error()){
    $logMessage = 'MYSQL error : ' . mysqli_connect_error();
    //call your logger here.
    die('could not connect to the database.');
}
// Rest of the code goes here.
 */

 /*
 <strong>mysqli_select_db()</strong> 
 To change the database in use, you can use mysqli_select_db().
 Example : 
 mysqli_select_db($conn , 'new_db');
 */

 /*
 <strong>mysqli_close($conn)</strong>
  You can close the mysql connection using this function It returns true on success and false on failure.
  Example: 
  mysqli_close($conn);
  */

  /*
  <strong>mysqli_query()</strong>
   This is the function used for executing MYsql queries . It returns False on failure.
    For select query(where there is output),It returns a mysql result set (resource) which can be used later to
    fetch the data.
   Code: 
    $query = "SELECT * FROM contacts";
    if(mysqli_query($conn , $query)){
        //iterate and display result.
    }
    else{
        //show error.
    }
*/

/*
<strong>mysqli_fetch__array()</strong>
This function is used for reading data from mysqli result set (returned by a mysqli_query()).
It reads and returns one row of data as an indexed/associative array and then moves the pointer to the next row.
When there is no more rows to return , it returns null.
code: 
    while($row = mysqli_fetch_array($result)){
        //Till there is data, $row will be an array.
        //At the end $tow will become null ending the loop.
    }

 <strong>mysqli_fetch_row()</strong>
  This function only returns indexed array (also known as enumerated array)
  */

/*
<strong>mysqli_fetch_assoc()</strong>
 This function only returns associative array.
 */

 /*
 <strong>mysqli_free_result()<strong>
 Immediately after using result set , you can free the memory used for it as below.
 Example: 
 mysqli_free_result($result);
*/

  /*
  <strong>mysqli_num_rows()</strong> 
  Returns the number of rows in result set
  */

  /* 
<strong>mysqli_affected_rows()</strong>
    This function provides information on last MYSQL query executed. 
    For INSERT,UPDATE,DELETE and REPLACE, it provides number of rows affected . 
    For SELECT, it returns number of rows in result set as mysqli_num_rows().
    Example : 
    mysqli_affected_rows($conn)
*/

/*
<strong>mysqli_insert_id</strong>
 Returns the id of the last record that was inserted.
 Example : 
 mysqli_insert_id($conn);
 */

/*
<strong>mysqli_error()</strong>
 If there was an error in last MYSQL query , the function will return an error. 
 If there is no error , it would return an empty string.
 Example : 
 mysqli_error($conn);
 */

  /*
  <strong>mysqli_real_escape_string()</strong>
   Some characters like single quote has special meaning in sql statements. 
   For an example , single quote is used for wrapping strings. So,if your sql statements contains these special
    characters, you need to escape them via mysqli_real_escape_string() before sending the query to mysqli_query().

   Code: 
   $query = "SELECT 'id' FROM 'contacts' WHERE 'lastname' =''o'Neil";
   mysqli_query($conn , $query);
   mysqli_query($link , $query);
   */

function db_connect()
{
    static $connection;
    if(!$connection)
    {
        //try to connect to database if not established connection
        $config = parse_ini_file('config.ini');
        $connection = mysqli_connect($config['host'], $config['username'], $config['password'], $config['dbname']);
    }
    // assure connection is a valid connection.!
    if($connection == false)
    {
        return mysqli_connect_error();
    }
    return $connection;
}

function db_query($query)
{
    $connection = db_connect();
    $result = mysqli_query($connection , $query);
    return $result;
}

function db_error()
{
    $connection = db_connect();
    return mysqli_error($connection);
}

function db_select($query)
{
    $result = db_query($query); //guarantee $result is resultset !
    if($result == false)
    {
        return false;
    }
    $rows = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $rows[] = $row;
    } 
    return $rows;
}

function db_quote($value)
{
    $connection = db_connect();
    return mysqli_real_escape_string($connection , $value);
}

function dd($variable)
{
    die(var_dump($variable));
}

function add_single_quotes($variable)
{
    return "'$variable'";
}

function redirect($url)
{
    header("Location: $url");
}
?>