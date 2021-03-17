<?
/**
 * Takes out config variables from the database, if not found, inserts it.
 */
function get_config($key){

    $config = db_row('
        SELECT * FROM config 
        WHERE `key` = "'.$key.'"'
    );

    if (!$config) {

        db_query("INSERT INTO config (`key`) VALUES (?)", $key);
        return null;

    } else {
        return $config['value'];
    }
}
