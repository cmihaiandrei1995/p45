<?

/**
* A helper for FTP related actions
*/
class FtpHandler
{
    private $conn;

    function __construct($host, $port = 21, $timeout = 900) {
        $this->conn = ftp_connect($host, $port, $timeout) or die("ERROR: Couldn't connect to ".$host.".");
    }

    function login($user, $pass) {
        global $_config;
        
        if (ftp_login($this->conn, $user, $pass)) {
            ftp_pasv($this->conn, true);
            return true;
        } else {
            die("ERROR: Cound not connect as ".$user.".");
        }
    }

    function get($local_file, $server_file, $mode = FTP_BINARY) {
        return ftp_get($this->conn, $local_file, $server_file, $mode);
    }

    function getFileContent($server_file, $mode = FTP_BINARY) {
        ob_start();

        $result = self::get("php://output", $server_file, $mode);
        $data = ob_get_contents();

        ob_end_clean();

        return $data;
    }

    function getXmlContent($server_file, $mode = FTP_BINARY) {
        $data = self::getFileContent($server_file, $mode);

        return simplexml_load_string($data);
    }

    function nlist($dir) {
        return ftp_nlist($this->conn, $dir);
    }

    function close() {
        ftp_close($this->conn);
    }
}
