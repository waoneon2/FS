<?php
/**
 * Class tric_video_support
 *
 */
class tric_video_support{

	/**
	 * Render a video on the fornt end from URL
	 * @param $videoUrl - the video url that we want to render
	 *
	 * @return string - the player HTML
	 */
	static function render_video($videoUrl, $auto = false) {
		$buffy = '';
		switch (self::detect_video_service($videoUrl)) {
			case 'youtube':
				$autoplay = $auto ? '?rel=0&controls=0&showinfo=0&autoplay=1' : '';
				$buffy = (is_ssl() ? "https" : "http") . '://www.youtube.com/embed/' . self::get_youtube_id($videoUrl) . $autoplay ;

				break;

			case 'vimeo':
				$autoplay = $auto ? '?title=0&byline=0&portrait=0&autoplay=1&badge=0' : '';
				$buffy = (is_ssl() ? "https" : "http") . '://player.vimeo.com/video/' . self::get_vimeo_id($videoUrl) . $autoplay ;

				break;
		}
		return $buffy;
	}

	/**
	 * detects if we have a recognized video service and makes sure that it's a valid url
	 * @param $videoUrl
	 * @return bool
	 */
	private static function validate_video_url($videoUrl) {
		if (self::detect_video_service($videoUrl) === false) {
			return false;
		}
		if (!preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $videoUrl)) {
			return false;
		}
		return true;
	}


	/**
	 * Returns the video thumb url from the video URL
	 * @param $videoUrl
	 * @return string
	 */
	static function get_thumb_url($videoUrl) {

		switch (self::detect_video_service($videoUrl)) {
			case 'youtube':
				$yt_1920_url = (is_ssl() ? "https" : "http") . '://img.youtube.com/vi/' . self::get_youtube_id($videoUrl) . '/maxresdefault.jpg';
				$yt_640_url  = (is_ssl() ? "https" : "http") . '://img.youtube.com/vi/' . self::get_youtube_id($videoUrl) . '/sddefault.jpg';
				$yt_480_url  = (is_ssl() ? "https" : "http") . '://img.youtube.com/vi/' . self::get_youtube_id($videoUrl) . '/hqdefault.jpg';

				if (!self::is_404($yt_1920_url)) {
					return $yt_1920_url;
				}

				elseif (!self::is_404($yt_640_url)) {
					return $yt_640_url;
				}

				elseif (!self::is_404($yt_480_url)) {
					return $yt_480_url;
				}

				else {

				}
				break;

			case 'vimeo':

				$url = 'http://vimeo.com/api/oembed.json?url=https://vimeo.com/' . self::get_vimeo_id($videoUrl);

				$response = wp_remote_get($url, array(
					'timeout' => 10,
					'sslverify' => false,
					'user-agent' => 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0'
				));

				if (!is_wp_error($response)) {
					$td_result = @json_decode(wp_remote_retrieve_body($response));
					return ($td_result->thumbnail_url);
				}
				break;
		}


		return '';
	}

	/*
	 * youtube id
	 */
    private static function get_youtube_id($videoUrl) {
        $query_string = array();
        parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query_string);

        if (empty($query_string["v"])) {
        	if (strpos($videoUrl, 'embed')) {

        		// link: https://www.youtube.com/embed/fdskljff
        		$yt_short_link_parts_explode1 = explode('embed', $videoUrl);
        		$yt_short_link_parts = explode('/', $yt_short_link_parts_explode1[1]);
        		return $yt_short_link_parts[1];

        	} else {

        		//explode at ? mark
        		$yt_short_link_parts_explode1 = explode('?', $videoUrl);

        		//short link: http://youtu.be/fdskljff
        		$yt_short_link_parts = explode('/', $yt_short_link_parts_explode1[0]);
        		if (!empty($yt_short_link_parts[3])) {
        		    return $yt_short_link_parts[3];
        		}

        		return $yt_short_link_parts[0];
        	}
        } else {
            return $query_string["v"];
        }
    }

    /*
     * Vimeo id
     */
    private static function get_vimeo_id($videoUrl) {
    	if (strpos($videoUrl, 'player.vimeo.com')) {
    		$video_id_parts = explode('/', $videoUrl);
    		$video_id = $video_id_parts[4];
    	} else {
    		sscanf(parse_url($videoUrl, PHP_URL_PATH), '/%d', $video_id);
    	}

        return $video_id;
    }

    /*
     * Detect the video service from url
     */
    private static function detect_video_service($videoUrl) {
        $videoUrl = strtolower($videoUrl);
        if (strpos($videoUrl,'youtube.com') !== false or strpos($videoUrl,'youtu.be') !== false) {
            return 'youtube';
        }
        if (strpos($videoUrl,'vimeo.com') !== false) {
            return 'vimeo';
        }

        return false;
    }


    private static function is_404($url) {
        $headers = @get_headers($url);
	    if (!empty($headers[0]) and strpos($headers[0],'404') !== false) {
		    return true;
	    }
	    return false;
    }



}

