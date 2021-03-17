<?php
$_use_routes = false;
$_is_cms = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

$ga_analytics_profile = db_row('SELECT * FROM admin_config WHERE `key` = "ga_widget_profile"');

require_once $_base_path_cms.'widgets/analytics/ga_login.php';

$ga_analytics = new Google_Service_Analytics($ga_client);

$metrics = $_POST['metrics'];
$date = $_POST['date'];

switch($metrics){
	case 'sessions' : $key = 3; break;
	case 'users' : $key = 4; break;
	case 'pageviews' : $key = 5; break;
	case 'organicSearches' : $key = 6; break;
	case 'visitBounceRate' : $key = 7; break;
}

$data = $ga_analytics->data_ga->get(
   'ga:' . $ga_analytics_profile['value'],
   $date,
   ($date == 'yesterday' ? 'yesterday' : 'today'),
   'ga:sessions, ga:users, ga:hits, ga:organicSearches, ga:bounceRate',
   array('dimensions' => ($date == "today" || $date == "yesterday" ? 'ga:hour,' : '') . 'ga:day, ga:month' . ($date != "today" && $date != "yesterday" ? ', ga:year' : ''))
);

foreach($data->rows as $k => $row){
	if($date == "today" || $date == "yesterday"){
		$values[strtotime(str_pad($row[0], 2, "0", STR_PAD_LEFT) . ":00") * 1000 + 2*60*60*1000] = $row[$key];
	}else{
		$values[strtotime($row[0].".".$row[1].".".$row[2]) * 1000 + 2*60*60*1000] = $row[$key];
	}
	
	$sums['sessions'] += $row[3];
	$sums['users'] += $row[4];
	$sums['hits'] += $row[5];
	$sums['organic'] += $row[6];
	$sums['bounce'] += $row[7];
	if($row[7] > 0){
		$bounce_count++;
	}
}
$sums['pages'] = number_format($sums['hits'] / $sums['sessions'], 2, ".", "");
$sums['bounce'] = number_format($sums['bounce'] / $bounce_count, 2, ".", "")."%";

if($date != "today" && $date != "yesterday"){
	ksort($values);
}

$return = array(
	'values' => $values,
	'sums' => $sums
);

header('Content-type: application/json');
echo json_encode($return);