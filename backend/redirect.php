<?

switch($_params['to']){

	case 'cruise': {
		list($cruises, $count) = get_posts(array(
			'table' => 'cruise',
			'limit' => -1
		));
		foreach($cruises as $cruise){
			if($_params['slug'] == generate_name($cruise['title'])){
				go_away(route('cruise', $cruise['title'], $cruise['id_cruise']), '301');
			}
		}
		go_away(route('cruises-home'), '301');
	}break;

	case 'charters-home': {
		go_away(route('charters-home'), '301');
	}break;

	case 'charters-loading': {
		go_away(route('charters-loading', $_params['id']), '301');
	}break;

	case 'charters-search': {
		go_away(route('charters-search', $_params['city_to'], $_params['city_from'], $_params['id']), '301');
	}break;

	case 'charters': {
		if($_params['new'] != ""){
			go_away(route('charters', $_params['new'], $_params['city_from']), '301');
		}else{
			go_away(route('charters', $_params['city_to'], $_params['city_from']), '301');
		}
	}break;

	case 'charters2': {
		if($_params['new'] != ""){
			go_away(route('charters2', $_params['new'], $_params['city_from']), '301');
		}else{
			go_away(route('charters2', $_params['city_to'], $_params['city_from']), '301');
		}
	}break;

	case 'charters-item': {
		if($_params['new'] != ""){
			go_away(route('charters-item', $_params['new'], $_params['city_from'], $_params['slug'], $_params['id']), '301');
		}else{
			go_away(route('charters-item', $_params['city_to'], $_params['city_from'], $_params['slug'], $_params['id']), '301');
		}
	}break;

	case 'charters-item2': {
		if($_params['new'] != ""){
			go_away(route('charters-item2', $_params['new'], $_params['city_from'], $_params['slug'], $_params['id']), '301');
		}else{
			go_away(route('charters-item2', $_params['city_to'], $_params['city_from'], $_params['slug'], $_params['id']), '301');
		}
	}break;

	case 'tourism': {
		if($_params['new'] != ""){
			go_away(route('tourism', $_params['new']), '301');
		}else{
			go_away(route('tourism', $_params['city']), '301');
		}
	}break;

    case 'thank-you': {
		go_away(route('thank-you', $_params['id_booking']), '301');
	}break;


	default: {
		go_away(route($_params['to']), '301');
	}break;

}
