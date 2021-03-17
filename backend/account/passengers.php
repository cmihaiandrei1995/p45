<?

if(!is_logged_in()){
	go_away(route('login'));
}

$_user = get_logged_in_user();







$_section = "passengers";

// seo
$_meta_title = "Pasageri";
$_meta_description = "";
$_meta_keywords = "";
$_no_index = true;