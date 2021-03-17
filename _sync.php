<?

//exit;

$remote_site = array(
    'host' => '185.92.193.56',
    'user' => 'paralela',
    'pass' => '4rPaUTBQNXcw',
    'path' => '/public_html/' // !!! Must be absolute path visible in ftp !!!
);

$source_folder = "/home/devparalela/public_html/"; // !!! Must be absolute path !!!

$exclude_items = array(
    '_chat_bck/',
    '_html/',
    '_layout/',
    '_tmp/',
    'api/',
    'blog/',
    'chat/',
    'cron/',
    'img/*',
    'link-plata/',
    'uploads/',
    'video/',
    'ws/',

    '.htaccess',
    'config.php',

    '.ftpquota',
    '.user.ini',
    'php.ini'
);

$from_dev_to_live = false; // must be false to sync from live to dev

$delete_from_remote = false; // be very carefull with this one

$dry_run = true; // perform dry run first ?




$ftp_url = "ftp://".$remote_site['user'].":".$remote_site['pass']."@".$remote_site['host'];

$command = '
    lftp -e "
        set ftp:ssl-allow no;
        set ftp:list-options -a;
        set ftp:auto-passive-mode on;
        open '.$ftp_url.';
        lcd '.$source_folder.';
        cd '.$remote_site['path'].';
        mirror '.($dry_run ? ' --dry-run ' : '').($from_dev_to_live ? ' --reverse ' : '').' '.($delete_from_remote ? ' --delete ' : '').' --parallel=10 --no-perms --verbose ';
            foreach($exclude_items as $item){
                $command .= ' --exclude "^'.$item.'$" ';
            }
            $command .= ' --exclude-glob "error_log" ';
            $command .= ' --exclude-glob "_sync.php" ';
        $command .= ';
        exit;
    "
';

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>var interval = setInterval(function() { var scrollBottom = $(window).scrollTop() + $(window).height(); $(window).scrollTop(scrollBottom); }, 500); $(document).ready(function(){ clearInterval(interval); });</script>
<?
flush();

$proc = popen($command, 'r');
echo '<pre>';
while (!feof($proc)){
    echo fread($proc, 4096);
    @flush();
}
echo '</pre>';

if(file_exists($source_folder.'transfer_log')){
    unlink($source_folder.'transfer_log');
}

echo "\nSync done";
