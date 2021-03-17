<?php

function limit_text($string, $limit, $break = " ", $pad = "...") {
    $string = preg_replace('/\s+/', ' ', trim(strip_tags($string)));

    // return with no change if string is shorter than $limit
    if(strlen($string) <= $limit) return $string;

    // is $break present between $limit and the end of the string?
    if(false !== ($breakpoint = strpos($string, $break, $limit))) {
        if($breakpoint < strlen($string) - 1) {
            $string = substr($string, 0, $breakpoint) . $pad;
        }
    }

    return $string;
}

function starts_with($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

function ends_with($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

function str_like($pattern, $subject){
    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
    return (bool) preg_match("/^{$pattern}$/i", $subject);
}

function generate_name($string, $allowed_characters = array()) {

    $string = replace_special_characters($string);

    if($allowed_characters){
        foreach($allowed_characters as $char){
            $extra_string .= "\\".$char;
        }
    }

    $string = preg_replace("@[^A-Za-z0-9\-".$extra_string."]+@i", "-", $string);
    $string = preg_replace("@[\-]+@i", "-", $string);

    return strtolower(trim($string, '-'));
}

function replace_special_characters($string){
	$to_be_replaced = array(
        '&amp;' => ' and ',
        '&micro;' => 'u',
        '&Agrave;' => 'A',
        '&Aacute;' => 'A',
        '&Acirc;' => 'A',
        '&Atilde;' => 'A',
        '&Auml;' => 'A',
        '&Aring;' => 'A',
        '&AElig;' => 'AE',
        '&Ccedil;' => 'C',
        '&Egrave;' => 'E',
        '&Eacute;' => 'E',
        '&Ecirc;' => 'E',
        '&Euml;' => 'E',
        '&Igrave;' => 'I',
        '&Iacute;' => 'I',
        '&Icirc;' => 'I',
        '&Iuml;' => 'I',
        '&Ntilde;' => 'N',
        '&Ograve;' => 'O',
        '&Oacute;' => 'O',
        '&Ocirc;' => 'O',
        '&Otilde;' => 'O',
        '&Ouml;' => 'O',
        '&Oslash;' => 'O',
        '&Ugrave;' => 'U',
        '&Uacute;' => 'U',
        '&Ucirc;' => 'U',
        '&Uuml;' => 'U',
        '&Yacute;' => 'Y',
        '&szlig;' => 'ss',
        '&agrave;' => 'a',
        '&aacute;' => 'a',
        '&acirc;' => 'a',
        '&atilde;' => 'a',
        '&auml;' => 'a',
        '&aring;' => 'a',
        '&aelig;' => 'ae',
        '&ccedil;' => 'c',
        '&egrave;' => 'e',
        '&eacute;' => 'e',
        '&ecirc;' => 'e',
        '&euml;' => 'e',
        '&igrave;' => 'i',
        '&iacute;' => 'i',
        '&icirc;' => 'i',
        '&iuml;' => 'i',
        '&ntilde;' => 'n',
        '&ograve;' => 'o',
        '&oacute;' => 'o',
        '&ocirc;' => 'o',
        '&otilde;' => 'o',
        '&ouml;' => 'o',
        '&oslash;' => 'o',
        '&ugrave;' => 'u',
        '&uacute;' => 'u',
        '&ucirc;' => 'u',
        '&uuml;' => 'u',
        '&yacute;' => 'y',
        '&yuml;' => 'y',
        '&OElig;' => 'OE',
        '&oelig;' => 'oe',
        '&Scaron;' => 'S',
        '&scaron;' => 's',
        '&Yuml;' => 'Y',
        '&ndash;' => '-',
        '&rsquo;' => '',
        '&lsquo;' => '',
        '&#039;' => '-',
        '&#259;' => 'a',
        '&#258;' => 'A',
        '&#226;' => 'a',
        '&#194;' => 'A',
        '&#238;' => 'i',
        '&#206;' => 'I',
        '&#351;' => 's',
        '&#350;' => 'S',
        '&#355;' => 't',
        '&#354;' => 'T',
        '%C5%A2' => 'T',
        '%C5%A3' => 't',
        '%C8%9A' => 'T',
        '%C8%9B' => 't',
        '%C4%83' => 'a',
        '%C4%82' => 'A',
        '%C3%A2' => 'a',
        '%C3%82' => 'A',
        '%C3%AE' => 'i',
        '%C3%8E' => 'I',
        '%C8%99' => 's',
        '%C8%98' => 'S',
        '%C5%9F' => 's',
        '%C5%9E' => 'S'
    );
	
    $string = strip_tags($string);
    $string = decode_utf8($string);
    $string = htmlentities($string, ENT_QUOTES, 'utf-8');
    $string = str_replace( array_keys($to_be_replaced), array_values($to_be_replaced), $string);
    $string = str_replace(array("-quot-","-amp-","-ndash-"), "-", $string);
	
	return $string;
}

function decode_utf8($string) {
    $accented = array(
        'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ă', 'Ą',
        'Ç', 'Ć', 'Č', 'Œ',
        'Ď', 'Đ',
        'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ă', 'ą',
        'ç', 'ć', 'č', 'œ',
        'ď', 'đ',
        'È', 'É', 'Ê', 'Ë', 'Ę', 'Ě',
        'Ğ',
        'Ì', 'Í', 'Î', 'Ï', 'İ',
        'Ĺ', 'Ľ', 'Ł',
        'è', 'é', 'ê', 'ë', 'ę', 'ě',
        'ğ',
        'ì', 'í', 'î', 'ï', 'ı',
        'ĺ', 'ľ', 'ł',
        'Ñ', 'Ń', 'Ň',
        'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ő',
        'Ŕ', 'Ř',
        'Ś', 'Ş', 'Š',
        'ñ', 'ń', 'ň',
        'ò', 'ó', 'ô', 'ö', 'ø', 'ő',
        'ŕ', 'ř',
        'ś', 'ş', 'š', 'ș',
        'Ţ', 'Ť',
        'Ù', 'Ú', 'Û', 'Ų', 'Ü', 'Ů', 'Ű',
        'Ý', 'ß',
        'Ź', 'Ż', 'Ž',
        'ţ', 'ť', 'ț',
        'ù', 'ú', 'û', 'ų', 'ü', 'ů', 'ű',
        'ý', 'ÿ',
        'ź', 'ż', 'ž',
        'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р',
        'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'р',
        'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
        'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'
        );

    $replace = array(
        'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'A', 'A',
        'C', 'C', 'C', 'CE',
        'D', 'D',
        'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'a', 'a',
        'c', 'c', 'c', 'ce',
        'd', 'd',
        'E', 'E', 'E', 'E', 'E', 'E',
        'G',
        'I', 'I', 'I', 'I', 'I',
        'L', 'L', 'L',
        'e', 'e', 'e', 'e', 'e', 'e',
        'g',
        'i', 'i', 'i', 'i', 'i',
        'l', 'l', 'l',
        'N', 'N', 'N',
        'O', 'O', 'O', 'O', 'O', 'O', 'O',
        'R', 'R',
        'S', 'S', 'S',
        'n', 'n', 'n',
        'o', 'o', 'o', 'o', 'o', 'o',
        'r', 'r',
        's', 's', 's', 's',
        'T', 'T',
        'U', 'U', 'U', 'U', 'U', 'U', 'U',
        'Y', 'Y',
        'Z', 'Z', 'Z',
        't', 't', 't',
        'u', 'u', 'u', 'u', 'u', 'u', 'u',
        'y', 'y',
        'z', 'z', 'z',
        'A', 'B', 'B', 'r', 'A', 'E', 'E', 'X', '3', 'N', 'N', 'K', 'N', 'M', 'H', 'O', 'N', 'P',
        'a', 'b', 'b', 'r', 'a', 'e', 'e', 'x', '3', 'n', 'n', 'k', 'n', 'm', 'h', 'o', 'p',
        'C', 'T', 'Y', 'O', 'X', 'U', 'u', 'W', 'W', 'b', 'b', 'b', 'E', 'O', 'R',
        'c', 't', 'y', 'o', 'x', 'u', 'u', 'w', 'w', 'b', 'b', 'b', 'e', 'o', 'r'
        );

    return str_replace($accented, $replace, $string);
}

function html2txt($text){
	$text = preg_replace(
        array(
          // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu',
          // Add line breaks before and after blocks
            '@</?((address)|(blockquote)|(center)|(del))@iu',
            '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
            '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
            '@</?((table)|(th)|(td)|(caption))@iu',
            '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
            '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
            '@</?((frameset)|(frame)|(iframe))@iu',
        ),
        array(
            ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
            "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
            "\n\$0", "\n\$0",
        ),
        $text);
		
    return strip_tags($text);
}

function toUTF8($text){
  /**
   * Function \ForceUTF8\Encoding::toUTF8
   *
   * This function leaves UTF8 characters alone, while converting almost all non-UTF8 to UTF8.
   *
   * It assumes that the encoding of the original string is either Windows-1252 or ISO 8859-1.
   *
   * It may fail to convert characters to UTF-8 if they fall into one of these scenarios:
   *
   * 1) when any of these characters:   ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞß
   *    are followed by any of these:  ("group B")
   *                                    ¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶•¸¹º»¼½¾¿
   * For example:   %ABREPRESENT%C9%BB. «REPRESENTÉ»
   * The "«" (%AB) character will be converted, but the "É" followed by "»" (%C9%BB)
   * is also a valid unicode character, and will be left unchanged.
   *
   * 2) when any of these: àáâãäåæçèéêëìíîï  are followed by TWO chars from group B,
   * 3) when any of these: ðñòó  are followed by THREE chars from group B.
   *
   * @name toUTF8
   * @param string $text  Any string.
   * @return string  The same string, UTF8 encoded
   *
   */

    if(is_array($text))
    {
      foreach($text as $k => $v)
      {
        $text[$k] = toUTF8($v);
      }
      return $text;
    } 
    
    if(!is_string($text)) {
      return $text;
    }
       
    $max = strlen($text);
  
    $buf = "";
    for($i = 0; $i < $max; $i++){
        $c1 = $text{$i};
        if($c1>="\xc0"){ //Should be converted to UTF8, if it's not UTF8 already
          $c2 = $i+1 >= $max? "\x00" : $text{$i+1};
          $c3 = $i+2 >= $max? "\x00" : $text{$i+2};
          $c4 = $i+3 >= $max? "\x00" : $text{$i+3};
            if($c1 >= "\xc0" & $c1 <= "\xdf"){ //looks like 2 bytes UTF8
                if($c2 >= "\x80" && $c2 <= "\xbf"){ //yeah, almost sure it's UTF8 already
                    $buf .= $c1 . $c2;
                    $i++;
                } else { //not valid UTF8.  Convert it.
                    $cc1 = (chr(ord($c1) / 64) | "\xc0");
                    $cc2 = ($c1 & "\x3f") | "\x80";
                    $buf .= $cc1 . $cc2;
                }
            } elseif($c1 >= "\xe0" & $c1 <= "\xef"){ //looks like 3 bytes UTF8
                if($c2 >= "\x80" && $c2 <= "\xbf" && $c3 >= "\x80" && $c3 <= "\xbf"){ //yeah, almost sure it's UTF8 already
                    $buf .= $c1 . $c2 . $c3;
                    $i = $i + 2;
                } else { //not valid UTF8.  Convert it.
                    $cc1 = (chr(ord($c1) / 64) | "\xc0");
                    $cc2 = ($c1 & "\x3f") | "\x80";
                    $buf .= $cc1 . $cc2;
                }
            } elseif($c1 >= "\xf0" & $c1 <= "\xf7"){ //looks like 4 bytes UTF8
                if($c2 >= "\x80" && $c2 <= "\xbf" && $c3 >= "\x80" && $c3 <= "\xbf" && $c4 >= "\x80" && $c4 <= "\xbf"){ //yeah, almost sure it's UTF8 already
                    $buf .= $c1 . $c2 . $c3 . $c4;
                    $i = $i + 3;
                } else { //not valid UTF8.  Convert it.
                    $cc1 = (chr(ord($c1) / 64) | "\xc0");
                    $cc2 = ($c1 & "\x3f") | "\x80";
                    $buf .= $cc1 . $cc2;
                }
            } else { //doesn't look like UTF8, but should be converted
                    $cc1 = (chr(ord($c1) / 64) | "\xc0");
                    $cc2 = (($c1 & "\x3f") | "\x80");
                    $buf .= $cc1 . $cc2;
            }
        } elseif(($c1 & "\xc0") == "\x80"){ // needs conversion
              if(isset($win1252ToUtf8[ord($c1)])) { //found in Windows-1252 special cases
                  $buf .= $win1252ToUtf8[ord($c1)];
              } else {
                $cc1 = (chr(ord($c1) / 64) | "\xc0");
                $cc2 = (($c1 & "\x3f") | "\x80");
                $buf .= $cc1 . $cc2;
              }
        } else { // it doesn't need conversion
            $buf .= $c1;
        }
    }
    return $buf;
}

function hours_range($lower = 0, $upper = 86400, $step = 1800, $format = '') {
    $times = array();

    if ( empty( $format ) ) {
        $format = 'g:i a';
    }

    foreach ( range( $lower, $upper, $step ) as $increment ) {
        $increment = gmdate( 'H:i', $increment );
        list( $hour, $minutes ) = explode( ':', $increment );
        $date = new DateTime( $hour . ':' . $minutes );
        $times[(string) $increment] = $date->format( $format );
    }

    return $times;
}

/* draws a calendar */
function draw_calendar($month, $year, $data){

    /* draw table */
    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

    /* table headings */
    $headings = array('Lu','Ma','Mi','Jo','Vi','Sa','Du');
    $calendar.= '<thead><tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr></thead>';

    /* days and weeks vars now ... */
    $running_day = date('w',mktime(0,0,0,$month,1,$year));
    $running_day = ($running_day > 0) ? $running_day-1 : $running_day;  // First day monday

    $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    /* row for week one */
    $calendar.= '<tbody>';
        $calendar.= '<tr class="calendar-row">';

        /* print "blank" days until the first of the current week */
        for($x = 0; $x < $running_day; $x++){
            $calendar.= '<td class="calendar-day-np"> </td>';
            $days_in_this_week++;
        }

        /* keep going with days.... */
        for($list_day = 1; $list_day <= $days_in_month; $list_day++){
            $calendar.= '<td class="calendar-day'.($data['flights'][$list_day] ? ' available' : '').($data['flights'][$list_day]['price']==$data['lowest'] ? ' lowest' : '').($data['selected']==$list_day||($data['flights'][$list_day]['price']===0&&!$data['selected']) ? ' selected' : '').'">';
                /* add in the day number */
                if($data['flights'][$list_day]) {
                    $calendar.= '<a href="#" class="trigger-filter-data" data-filter-name="'.$data['field'].'" data-filter-value="'.$list_day.'">';
                } else {
                    $calendar.= '<a>';
                }

                $calendar.= '<span class="day-number">'.$list_day.'</span>';

                if($data['flights'][$list_day]) {
                    if(isset($data['flights'][$list_day]['diff'])) {
                        $calendar.= '<span class="day-price">+'.$data['flights'][$list_day]['diff'].' &euro;</span>';
                    } else {
                        $calendar.= '<span class="day-price">'.$data['flights'][$list_day]['price'].' &euro;</span>';
                    }
                }
                $calendar.= '</a>';

            $calendar.= '</td>';
            if($running_day == 6) {
                $calendar.= '</tr>';
                if(($day_counter+1) != $days_in_month) {
                    $calendar.= '<tr class="calendar-row">';
                }
                $running_day = -1;
                $days_in_this_week = 0;
            }
            $days_in_this_week++; $running_day++; $day_counter++;
        }

        /* finish the rest of the days in the week */
        if($days_in_this_week < 8) {
            for($x = 1; $x <= (8 - $days_in_this_week); $x++) {
                $calendar.= '<td class="calendar-day-np"> </td>';
            }
        }

        /* final row */
        $calendar.= '</tr>';
    $calendar.= '</tbody>';

    /* end the table */
    $calendar.= '</table>';

    /* all done, return result */
    return $calendar;
}

function add_alert($text, $class = 'info') {
	global $_site_title;
	
    if(!is_array($_SESSION[$_site_title]['alerts'])) $_SESSION[$_site_title]['alerts'] = array();

    $_SESSION[$_site_title]['alerts'][] = array (
        'text' => $text,
        'class' => 'alert-'.$class.' alert'
    );
}

function print_alert($alert) {
    ?>
        <div class="<?=$alert['class']?>"><p><?=$alert['text']?></p></div>
    <?
}

function print_alerts($delay = 4000) {
	global $_site_title;
	
    if(!empty($_SESSION[$_site_title]['alerts'])) {
        foreach($_SESSION[$_site_title]['alerts'] as $alert) print_alert($alert);
    }
    $_SESSION[$_site_title]['alerts'] = array();
}

function get_shortest_date_interval($one, $two) {
    return $one.' - '.$two;
}

function days_between_dates($date1, $date2) {
    $date1_exp = date('Y-m-d', strtotime($date1));
    $date2_exp = date('Y-m-d', strtotime($date2));
    $date1 = new DateTime($date1_exp);
    $date2 = new DateTime($date2_exp);

    $diff = $date2->diff($date1)->format("%a");
    return $diff;
}
