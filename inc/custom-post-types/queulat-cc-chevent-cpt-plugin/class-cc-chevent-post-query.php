<?php

use Queulat\Post_Query;

class Cc_Chevent_Post_Query extends Post_Query {
	public function get_post_type() : string {
		return 'cc_chevent';
	}
	public function get_decorator() : string {
		return Cc_Chevent_Post_Object::class;
	}
	public function get_default_args() : array {
		return [];
	}
	public static function filterQuery( $query ){
		if (!is_single()):
			if ( ( $query->is_post_type_archive('cc_cevent') || ( isset($query->query['post_type']) && $query->query['post_type'] == 'cc_chevent' ) ) && !is_admin() ) {
				$query->set('meta_query', array( array(
					'key'     => 'event_dtstart_date',
					'value'   => date('Y-m-d'),
					'compare' => '>=',
					'type'    => 'DATE'
				) ));
				$query->set('meta_key', 'event_dtstart_date');
				$query->set('orderby', 'meta_value');
				$query->set('order', 'ASC');
			}
		endif;
		return $query;
	}
}

add_action('pre_get_posts', array('Cc_Chevent_Post_Query', 'filterQuery'));