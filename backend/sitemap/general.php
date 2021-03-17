<?
require_once $_base_path.'lib/classes/google/sitemap.class.php';

$pages[] = array(
	"loc" => $_base,
	"changefreq" => "daily",
	"lastmod" => date("Y-m-d\TH:i:s+00:00",mktime(date('H')-mt_rand(2,7),date('i')-mt_rand(1,50),0,date('m'),date('d'),date('Y'))),
	"priority" => "1",
);

/*
$pages[] = array(
	"loc" => route('rentacar'),
	"changefreq" => "daily",
	"lastmod" => date("Y-m-d\TH:i:s+00:00",mktime(date('H')-mt_rand(2,7),date('i')-mt_rand(1,50),0,date('m'),date('d'),date('Y'))),
	"priority" => "0.9",
);

$pages[] = array(
	"loc" => route('contact'),
	"changefreq" => "monthly",
	"lastmod" => date("Y-m-d\TH:i:s+00:00",mktime(date('H')-mt_rand(2,7),date('i')-mt_rand(1,50),0,date('m'),date('d'),date('Y'))),
	"priority" => "0.1",
);

$pages[] = array(
	"loc" => route('faq'),
	"changefreq" => "monthly",
	"lastmod" => date("Y-m-d\TH:i:s+00:00",mktime(date('H')-mt_rand(2,7),date('i')-mt_rand(1,50),0,date('m'),date('d'),date('Y'))),
	"priority" => "0.1",
);

$pages[] = array(
	"loc" => route('about'),
	"changefreq" => "monthly",
	"lastmod" => date("Y-m-d\TH:i:s+00:00",mktime(date('H')-mt_rand(2,7),date('i')-mt_rand(1,50),0,date('m'),date('d'),date('Y'))),
	"priority" => "0.1",
);
*/

$site_map_container = new google_sitemap();

for($i=0; $i<count($pages); $i++){
	$value = $pages[$i];
	$site_map_item = new google_sitemap_item( $value['loc'], $value['lastmod'], $value['changefreq'], $value['priority'], $value['image'] );
	$site_map_container->add_item( $site_map_item );
}

$sitemap = $site_map_container->build();

header( "Content-type: application/xml; charset=\"UTF-8\"", true);
header( 'Pragma: no-cache' );
echo $sitemap;
exit;
