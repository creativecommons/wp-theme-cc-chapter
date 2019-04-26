<?php

/*
	Search filter class
*/

class search_filter {
	public $query;
	private $post_type;
	private $taxonomies;
	private $meta;
	private $date;
	private $event_date;
	private $posts_per_page;
	private $page;
	private $search_text;
	private $taxonomy_name;
	private $tax_array;

	function __construct() {
		//$this->search($args);
	}

	function get_current_taxonomy() {
		$meta = get_queried_object();
		if ( empty($this->taxonomy_name) ) {
			$tax = $meta->taxonomy;
		} else {
			$tax = $this->taxonomy_name;
		}
		return $tax;
	}
	function set_taxonomy_name($tax) {
		$this->taxonomy_name = $tax;
	}
	function default_post_type() {
		return 'post';
	}
	function set_search_text($text) {
		$this->search_text = $text;
	}
	function get_search_text() {
		return $this->search_text;
	}
	function set_page($page) {
		$this->page = $page;
	}
	function get_page() {
		if ( !empty( $this->page ) ) {
			return $this->page;
		} 
	}
	function get_query() {
		return $this->query;
	}
	function set_taxonomies($taxonomies) {
		$this->taxonomies = $taxonomies;
	}
	function set_array_taxonomies($taxonomies) {
		$this->tax_array = $taxonomies;
	}
	function get_taxonomies() {
		return $this->taxonomies;
	}
	function set_post_type($post_type) {
		$this->post_type = $post_type;
	}
	function get_date() {
		return $this->date;
	}
	function set_date($date_array) {
		$this->date = $date_array;
	}
	function set_event_date($date_array)
	{
		$this->event_date = $date_array;
	}
	function get_post_type() {
		if ( !empty( $this->post_type ) ) {
			return $this->post_type;
		} else {
			return $this->default_post_type();
		}
	}
	function get_default_args() {
		$meta = get_queried_object();

		$default =  array(
			'post_type' => $this->get_post_type(),
			'posts_per_page' => get_option('posts_per_page'),
			'posts_status' => 'publish',
			);
		if (!empty($this->date)) {
			 $default['date_query'] = array($this->date);
		}
		if (!empty($this->search_text)) {
			$default['s'] = $this->search_text;
		}
		if (!empty($this->page)) {
			$default['paged'] = $this->page;
		}
		if ( ( get_class($meta) == 'WP_Term') && ( empty( $this->taxonomies ) ) ) {
			$default['tax_query'] = array(
				array(
					'taxonomy' => $meta->taxonomy,
					'field' => 'slug',
					'terms' => $meta->slug
					)
				);
		} else if ( !empty($this->taxonomies[0]) ) {
			$taxonomies = array(); 
			foreach ($this->taxonomies as $tax) {
				$taxonomies[] = array(
					'taxonomy' => $this->get_current_taxonomy(),
					'field' => 'slug',
					'terms' => $tax
					);
			}
			$default['tax_query'] = $taxonomies; 
		}
		if (!empty($this->tax_array) && is_array($this->tax_array)) {
			foreach ($this->tax_array as $tax => $term) {
				$taxonomies[] = array(
					'taxonomy' => $tax,
					'field' => 'slug',
					'terms' => $term
				);
			}
			$default['tax_query'] = $taxonomies;
		}
		if ( !empty( $this->meta ) ) {
			$default['meta_query'] = $this->meta;
		}
		if ( !empty( $this->event_date ) ) {
			$default['meta_query'] = array();
			$date = $this->event_date;
			if (!empty($date['year']) || !empty($date['month'])) {
				$month = (!empty($date['month'])) ? $date['month'] : '01';
				$year = (!empty($date['year'])) ? $date['year'] : date('Y');
				$default['meta_query'][] = array(
					'key' => 'event_dtstart_date',
					'value' => $year.'-'.$month.'-01',
					'compare' => '>=',
					'type' => 'DATE'
				);
				$month = (!empty($date['month'])) ? $date['month'] : '12';
				$default['meta_query'][] = array(
					'key' => 'event_dtstart_date',
					'value' => $year . '-'.$month.'-31',
					'compare' => '<=',
					'type' => 'DATE'
				);
			}
			$default['meta_key'] = 'event_dtstart_date';
			$default['orderby'] = 'meta_value';
			$default['order'] = 'DESC';
		}
		//echo '<pre>'; print_r($default); echo '</pre>';
		return $default;
	}
	function search($args = null) {
		$default = wp_parse_args($this->get_default_args(),$args=false);
		$this->query = new WP_Query($default);
		return $this->query;
	}
	function get_years($from='2010') {
		$years = array();
		for ( $x = $from; $x <= date(Y); $x++) {
			$years[] = $x;
		}
		return $years;
	}
	function get_years_select($attributes=null, $selected=null) {
		if ( !empty($attributes ) && is_array( $attributes ) ) {
			$print_attr = '';
			foreach ($attributes as $key => $val) {
				$print_attr .= ' '.$key.'="'.$val.'" ';
			}
		}
		$years = $this->get_years();
		$out = '<select '.$print_attr.' >';
			$out .= '<option value="">Year</option>';
		foreach ( $years as $year ) {
			$select = ($year == $selected ) ? ' selected="selected"': '';
			$out .= '<option value="'.$year.'"'.$select.'>'.$year.'</option>';
		}
		$out .='</select>';

		return $out;
	}
	function get_months() {
		return array(
			1 => 'Jan',
			2 => 'Feb',
			3 => 'Mar',
			4 => 'Apr',
			5 => 'May',
			6 => 'Jun',
			7 => 'Jul',
			8 => 'Aug',
			9 => 'Sep',
			10 => 'Oct',
			11 => 'Nov',
			12 => 'Dec'
			);
	}
	function get_months_select($attributes=null, $selected=null) {
		if ( !empty($attributes ) && is_array( $attributes ) ) {
			$print_attr = '';
			foreach ($attributes as $key => $val) {
				$print_attr .= ' '.$key.'="'.$val.'" ';
			}
		}
		$months = $this->get_months();
		$out = '<select '.$print_attr.' >';
			$out .= '<option value="">Month</option>';
		foreach ( $months as $key => $month ) {
			$select = ($key == $selected ) ? ' selected="selected"': '';
			$out .= '<option value="'.$key.'"'.$select.'>'.$month.'</option>';
		}
		$out .='</select>';

		return $out;
	}
}