<?php

class CreativeCommons_Works extends WP_Widget {
	var $default_title, $default_size;

	/**
	* Registers the widget with WordPress.
	*/
	function __construct() {
		parent::__construct(false, $name = __("CC Works <span></span>", 'creativecommons'));
		$this->default_category  = 'homepage';
	}

	/**
	* Front-end display of widget.
	*
	* @see WP_Widget::widget()
	*
	* @param array $args     Widget arguments.
	* @param array $instance Saved values from database.
   */
	function widget( $args, $instance ) {

		//Load the options into variables
		$cc_work_title = isset($instance['cc_work_title']) ? $instance['cc_work_title'] : null;
		$cc_work_more = isset($instance['cc_work_more']) ? $instance['cc_work_more'] :null;
		$cc_work_post_read_more = isset($instance['cc_work_post_read_more']) ? $instance['cc_work_post_read_more'] : null;
		$cc_work_numposts = isset($instance['cc_work_numposts']) ? $instance['cc_work_numposts'] : "4";
		$cc_work_description = isset($instance['cc_work_description']) ? $instance['cc_work_description'] : null;
		$cc_work_show_excerpt = isset($instance['cc_work_show_excerpt']) ? $instance['cc_work_show_excerpt'] : false;
		$cc_work_hero_content_display = isset($instance['cc_work_hero_content_display']) ? $instance['cc_work_hero_content_display'] : "excerpt";
		$cc_work_content_display = isset($instance['cc_work_content_display']) ? $instance['cc_work_content_display'] : "excerpt";
		//$cc_work_aspect_ratio = isset($instance['cc_work_aspect_ratio']) ? $instance['cc_work_aspect_ratio'] : "3_2";
		//$cc_work_show_excerpt = $instance[ 'cc_work_show_excerpt' ] ? 'true' : 'false';

		echo $args['before_widget'];
		$noheader = "no-header";
		if(isset($cc_work_title) || isset($cc_work_description)){
			$noheader = false;
		}
		// add  $cc_work_theme to section classes 
?>
<section class="featured-works widget  num-cols-<?php echo $cc_work_numposts;?> <?php echo $noheader;?>">

<?php 
	if(!$noheader){ ?>
	<header>
		<?php if($cc_work_title) { ?><h2><?php print $cc_work_title; ?></h2><?php } ?>
		<?php if($cc_work_description){ ?><div class="widget-description"><?php print $cc_work_description; ?></div><div style="clear:both;"></div><?php } ?>
	</header>
	<?php 
	} 
		// The hero feature
            $the_query = cc_widgets_get_featured_posts_by_taxonomy_query('work', 'hero', 1);
            while ( $the_query->have_posts() ){
				$the_query->the_post();
				$hero_post_id = get_the_ID();
				$url = get_permalink();
				$categories = get_the_category();
				
				if ( ! empty( $categories ) ) {
					$category_link  ='<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
				} else {
					$category_link = NULL;
				}
				
		?>
		<article class="hero">
			<div class="item">
				<div class="thumbnail ratio_3_2" style="background-image:url(<?php print the_post_thumbnail_url('large'); ?>)">
					<a href="<?php print $url; ?>"><img src="/wp-content/themes/cc-chapter<?php //bloginfo('template_url'); ?>/images/ratio_3_2.png" /></a>
				</div>
				<div class="teaser">
					<h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title() ?></a></h3>
					<div class="excerpt" <?php if($cc_work_hero_content_display == 'hide'){ ?> style="display:none;" <?php } ?>><?php 
						if($cc_work_hero_content_display == 'excerpt'){ print the_excerpt(); } 
						else { print the_content(); } ?>
					</div>
					<?php if($cc_work_post_read_more) { ?><div class="more"><a href="<?php print $url; ?>"><?php print $cc_work_post_read_more; ?></a></div><?php } ?>
				</div>
			</div>
		</article>
			<?php } ?>
	<div class="widget-inner">
		<?php 
			
		// The other features
            $the_query = cc_widgets_get_featured_posts_by_taxonomy_query('work', 'highlight', $cc_work_numposts);
            while ( $the_query->have_posts() ){
				$the_query->the_post();
				$hero_post_id = get_the_ID();
				$url = get_permalink();
				$categories = get_the_category();
				
				if ( ! empty( $categories ) ) {
					$category_link  ='<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
				} else {
					$category_link = NULL;
				}
				$custom = get_post_custom();
				
	?>
		<article>
			<div class="item">
				<div class="thumbnail">
					<?php 
						if(isset($custom['featured_video_link'])) {
					?><div class="video"><?php
						echo do_shortcode( '[video  src="' . $custom['featured_video_link'][0] . '"]' );
					?></div><?php
						} else { 
					?>

					<a href="<?php print $url; ?>"><?php print the_post_thumbnail('large'); ?></a>
						<?php } ?>
				</div>
				<div class="teaser">
					<h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title() ?></a></h3>
					<div class="excerpt" <?php if($cc_work_content_display == 'hide'){ ?> style="display:none;" <?php } ?>><?php 
						if($cc_work_content_display == 'excerpt'){ print the_excerpt(); } 
						else { print the_content(); } ?>
					</div>
					<?php if($cc_work_post_read_more) { ?><div class="more"><a href="<?php print $url; ?>"><?php print $cc_work_post_read_more; ?></a></div><?php } ?>
				</div>
			</div>
		</article>
		<?php 
			}
			
			
            // The four other features.
            // If we have a special feature, then it is 3 featured and 1 special feature.
            // Otherwise, it is 4 features.
            $have_special_feature = FALSE;
            $the_special_query = cc_widgets_get_homepage_features_query('program', 0);
            if ($the_special_query->have_posts()){
              $have_special_feature = TRUE;
            }
		?>
	</div>

	<!-- fix more link... category/type  -->
	<?php if($cc_work_more) { ?><div class="more"><a href="/?post_type=post"><?php print $cc_work_more; ?><i class="cc-icon-right-dir"></i></a></div><?php } ?>
</section>

<?php
    echo $args['after_widget'];
	}
/*
	TEXT		TITLE
	TEXTAREA	DESCRIPTION (WYSIWYG EDITOR)
	TEXT		MORE ARTICLES
CATAGORY
COLOR SCHEME (later)
	NUMBER OF POSTS
Has Hero?

*/
public function form( $instance ) {
// TITLE
	if( isset( $instance[ 'cc_work_title' ] ) ) {
						$cc_work_title = $instance[ 'cc_work_title' ];} 
	else {				$cc_work_title = __( 'Featured<br>Works', 'wpb_widget_domain' );}
	// DESCRIPTION
	if( isset( $instance[ 'cc_work_description' ] ) ) {
						$cc_work_description = $instance[ 'cc_work_description' ];} 
	else {				$cc_work_description = __( '<strong>1.1 billion works and counting.</strong> Explore these featured Creative Commons Licensed resources below, or you can <a href="/share-your-work/">share your work</a>,  and help light upthe global commons!', 'wpb_widget_domain' ); }
	//MORE ARTICLES
	if( isset( $instance[ 'cc_work_more' ] ) ) {
						$cc_work_more = $instance[ 'cc_work_more' ]; } 
	else {				$cc_work_more = __( '', 'wpb_widget_domain' ); }
	//READ MORE
	if( isset( $instance[ 'cc_work_post_read_more' ])){	
						$cc_work_post_read_more = $instance[ 'cc_work_post_read_more' ];} 
	else {				$cc_work_post_read_more = __( '', 'wpb_widget_domain' ); }
//Repeat for number of posts
	if( isset( $instance[ 'cc_work_numposts' ] ) ) {
						$cc_work_numposts = $instance[ 'cc_work_numposts' ];}
	else {				$cc_work_numposts = __( '4', 'wpb_widget_domain' );}      
//show excerpt
	if( isset( $instance[ 'cc_work_show_excerpt' ] ) ) {
						$cc_work_show_excerpt = $instance[ 'cc_work_show_excerpt' ];}
	else {				$cc_work_show_excerpt = __( '', 'wpb_widget_domain' );}
//Content Display Type
	if( isset( $instance[ 'cc_work_content_display' ] ) ) {
						$cc_work_content_display = $instance[ 'cc_work_content_display' ];}
	else {				$cc_work_content_display = __( 'excerpt', 'wpb_widget_domain' );}     

	if( isset( $instance[ 'cc_work_hero_content_display' ] ) ) {
						$cc_work_hero_content_display = $instance[ 'cc_work_hero_content_display' ];}
	else {				$cc_work_hero_content_display = __( 'excerpt', 'wpb_widget_domain' );}	  
// Image Ratio
/*
	if( isset( $instance[ 'cc_work_aspect_ratio' ] ) ) {
						$cc_work_aspect_ratio = $instance[ 'cc_work_aspect_ratio' ];}
	else {				$cc_work_aspect_ratio = __( '3_2', 'wpb_widget_domain' );}
	*/
// Widget Title
	if( isset( $instance[ 'title' ] ) ) {
						$title = $instance[ 'title' ];}
	else {				$title = __( 'TEST', 'wpb_widget_domain' );}

        ?>
	<p><label for="<?php echo $this->get_field_id( 'cc_work_title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'cc_work_title' ); ?>" name="<?php echo $this->get_field_name( 'cc_work_title' ); ?>" type="text" value="<?php echo esc_attr( $cc_work_title ); ?>" /></p>
	<p><label for="<?php echo $this->get_field_id( 'cc_work_description' ); ?>"><?php _e( 'Description:' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'cc_work_description' ); ?>" name="<?php echo $this->get_field_name( 'cc_work_description' ); ?>" type="text"><?php echo esc_attr( $cc_work_description ); ?></textarea></p>
	<p><label for="<?php echo $this->get_field_id( 'cc_work_more' ); ?>"><?php _e( 'More Articles Link:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'cc_work_more' ); ?>" name="<?php echo $this->get_field_name( 'cc_work_more' ); ?>" type="text" value="<?php echo esc_attr( $cc_work_more ); ?>" /></p>
	<p><label for="<?php echo $this->get_field_id( 'cc_work_post_read_more' ); ?>"><?php _e( 'Read More Link:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'cc_work_post_read_more' ); ?>" name="<?php echo $this->get_field_name( 'cc_work_post_read_more' ); ?>" type="text" value="<?php echo esc_attr( $cc_work_post_read_more ); ?>" /></p>
	<p><label for="<?php echo $this->get_field_id( 'cc_work_numposts' ); ?>"><?php _e( 'Number of Posts:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'cc_work_numposts' ); ?>" name="<?php echo $this->get_field_name( 'cc_work_numposts' ); ?>" type="text" value="<?php echo esc_attr( $cc_work_numposts ); ?>" /></p>
		
	<div style="column-count: 2;">	
		<div>
			<label for="<?php echo $this->get_field_id( 'cc_work_hero_content_display' ); ?>">Hero Content Display:</label>
			<p><label><input type="radio" value="excerpt" name="<?php echo $this->get_field_name( 'cc_work_hero_content_display' ); ?>" <?php checked( $cc_work_hero_content_display, 'excerpt' ); ?> id="<?php echo $this->get_field_id( 'cc_work_hero_content_display' ); ?>" />
				<?php esc_attr_e( 'Show the Excerpt', 'text_domain' ); ?></label></p>
			<p><label><input type="radio" value="content" name="<?php echo $this->get_field_name( 'cc_work_hero_content_display' ); ?>" <?php checked( $cc_work_hero_content_display, 'content' ); ?> id="<?php echo $this->get_field_id( 'cc_work_hero_content_display' ); ?>" />
				<?php esc_attr_e( 'Show Full Content', 'text_domain' ); ?></label></p>
			<p><label><input type="radio" value="hide" name="<?php echo $this->get_field_name( 'cc_work_hero_content_display' ); ?>" <?php checked( $cc_work_hero_content_display, 'hide' ); ?> id="<?php echo $this->get_field_id( 'cc_work_hero_content_display' ); ?>" />
				<?php esc_attr_e( 'Hide Content', 'text_domain' ); ?></label></p>
		</p>	
		</div>	
		<div>
			<label for="<?php echo $this->get_field_id( 'cc_work_content_display' ); ?>">Content Display:</label>
			<p><label><input type="radio" value="excerpt" name="<?php echo $this->get_field_name( 'cc_work_content_display' ); ?>" <?php checked( $cc_work_content_display, 'excerpt' ); ?> id="<?php echo $this->get_field_id( 'cc_work_content_display' ); ?>" />
				<?php esc_attr_e( 'Show the Excerpt', 'text_domain' ); ?></label></p>
			<p><label><input type="radio" value="content" name="<?php echo $this->get_field_name( 'cc_work_content_display' ); ?>" <?php checked( $cc_work_content_display, 'content' ); ?> id="<?php echo $this->get_field_id( 'cc_work_content_display' ); ?>" />
				<?php esc_attr_e( 'Show Full Content', 'text_domain' ); ?></label></p>
			<p><label><input type="radio" value="hide" name="<?php echo $this->get_field_name( 'cc_work_content_display' ); ?>" <?php checked( $cc_work_content_display, 'hide' ); ?> id="<?php echo $this->get_field_id( 'cc_work_content_display' ); ?>" />
				<?php esc_attr_e( 'Hide Content', 'text_domain' ); ?></label></p>
		</p>	
		</div>	
	</div>	
	<?php
	

}
  /**
   * Save the options.
   */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : null;
		$instance['cc_work_title'] = ( ! empty( $new_instance['cc_work_title'] ) ) ? strip_tags( $new_instance['cc_work_title'],"<br>" ) : null;
		$instance['cc_work_description'] = ( ! empty( $new_instance['cc_work_description'] ) ) ? $new_instance['cc_work_description']  : null;
		$instance['cc_work_more'] = ( ! empty( $new_instance['cc_work_more'] ) ) ? strip_tags( $new_instance['cc_work_more'] ) : null;
		$instance['cc_work_post_read_more'] = ( ! empty( $new_instance['cc_work_post_read_more'] ) ) ? strip_tags( $new_instance['cc_work_post_read_more'] ) : null;
		$instance['cc_work_show_excerpt'] = ( ! empty( $new_instance['cc_work_show_excerpt'] ) ) ? strip_tags( $new_instance['cc_work_show_excerpt'] ) : false;
		$instance['cc_work_content_display'] = ( ! empty( $new_instance['cc_work_content_display'] ) ) ? strip_tags( $new_instance['cc_work_content_display'] ) : "excerpt";
		$instance['cc_work_hero_content_display'] = ( ! empty( $new_instance['cc_work_hero_content_display'] ) ) ? strip_tags( $new_instance['cc_work_hero_content_display'] ) : "excerpt";
		//$instance['cc_work_aspect_ratio'] = ( ! empty( $new_instance['cc_work_aspect_ratio'] ) ) ? strip_tags( $new_instance['cc_work_aspect_ratio'] ) : "3_2";

		//$instance[ 'cc_work_show_excerpt' ] = $new_instance[ 'cc_work_show_excerpt' ];
		return $instance;
	}
}


function cc_homepage_work_widget_init() {
  register_widget( 'CreativeCommons_Works' );
}

add_action( 'widgets_init', 'cc_homepage_work_widget_init', 1 );
