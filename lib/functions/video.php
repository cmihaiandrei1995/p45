<?
/**
 * Youtube functions.
 */
function is_yt($url) {
    $is_youtube = '/^(https?:\/\/(w{0,3}.?youtube+\.\w{2,3})\/watch\?v=[\w\-\_]{11}([^\/\.])*$|^http:\/\/(w{0,3}.?youtu\.be\/[\w\-\_]{11}([^\/\.])*$))/';
    return preg_match($is_youtube, $url);
}

function get_yt_id($url) {
    $pattern = "/v=[a-zA-Z0-9_\-]+/";
    if(preg_match($pattern, $url, $matches, PREG_OFFSET_CAPTURE)) {
        // var_dump($matches);
        return str_replace('v=','',$matches[0][0]);
    } else {
        $pattern = '/^.*youtu.be\/([a-zA-Z0-9_\-]+)$/';
        preg_match($pattern, $url, $matches, PREG_OFFSET_CAPTURE);
        // var_dump($matches);
        return $matches[1][0];
    }
}

function get_yt_thumb($url) {
    return "https://i3.ytimg.com/vi/".get_yt_id($url)."/hqdefault.jpg";
}


/**
 * Vimeo functions.
 */
function is_vimeo($url) {
    $is_vimeo = '/^https?:\/\/(www\.|player\.)?vimeo\.com(\/video)?\/(\d+).*$/';
    return preg_match($is_vimeo, $url);
}

function get_vimeo_id($url) {
    $is_vimeo = '/^https?:\/\/(www\.|player\.)?vimeo\.com(\/video)?\/(\d+).*$/';
    preg_match($is_vimeo, $url, $matches);

    return $matches[3];
}

function get_vimeo_thumb($url) {
    $id = get_vimeo_id($url);

    $data = json_decode(file_get_contents('https://vimeo.com/api/v2/video/'.$id.'.json'));
    return $data[0]->thumbnail_large;
}



/**
 * General video functions
 */
function valid_video($url) {
    return is_yt($url) || is_vimeo($url);
}

function get_video_id($url) {
    if(is_yt($url)) {
        return get_yt_id($url);
    }

    if(is_vimeo($url)) {
        return get_vimeo_id($url);
    }
}

function get_video_thumb($url) {
    if(is_yt($url)) {
        return get_yt_thumb($url);
    }

    if(is_vimeo($url)) {
        return get_vimeo_thumb($url);
    }
}

function get_video_code($url, $width = '560', $height = '315', $autoplay = false, $mute = false) {
    if(is_yt($url)) {
        return '<iframe width="'.$width.'" height="'.$height.'" src="//www.youtube.com/embed/'.get_yt_id($url).''.($autoplay ? '?autoplay=1' : '').'" '.($mute ? 'volume="0"' : '').' frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen></iframe>';
    }

    if(is_vimeo($url)) {
        return '<iframe width="'.$width.'" height="'.$height.'" src="//player.vimeo.com/video/'.get_vimeo_id($url).'" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen></iframe>';
    }
}

function get_video_embed($url, $width = '560', $height = '315', $autoplay = false){
	preg_match('#<iframe(.*?)></iframe>#is', $url, $matches);
	if($matches[0] != ""){
		return preg_replace(
   			array('/width="\d+"/i', '/height="\d+"/i'),
   			array(sprintf('width="%d"', $width), sprintf('height="%d"', $height)),
   		stripslashes($matches[0]));
	}else{
		return get_video_code($url, $width, $height, $autoplay);
	}
}
