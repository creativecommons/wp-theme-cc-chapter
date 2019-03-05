<section>
	<header>
		<h2>WHAT'S NEW</h2>
		<div>Description</div>
	</header>	
	<article>
		<div class="item">
			<div class="thumbnail">
				<a href=""><img width="362" height="198" src="http://localhost.com/wp-content/uploads/2018/09/featured-teaching.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" srcset="http://localhost.com/wp-content/uploads/2018/09/featured-teaching.jpg 362w, http://localhost.com/wp-content/uploads/2018/09/featured-teaching-300x164.jpg 300w, http://localhost.com/wp-content/uploads/2018/09/featured-teaching-270x148.jpg 270w" sizes="(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px"></a>
			</div>
			<div class="teaser">
				<h3 class="title"><a href="http://localhost.com/uncategorized/creative-commons-australia-partners-with-australasian-open-access-strategy-group/">Creative Commons Australia partners with Australasian Open Access Strategy Group</a></h3>
				<div class="more"><a href="http://localhost.com/uncategorized/creative-commons-australia-partners-with-australasian-open-access-strategy-group/">Read More<i class="cc-icon-right-dir"></i></a></div>
			</div>
		</div>
	</article>
</section>

<section class="home-section-title-widget <?php print $cc_section_name_theme; ?>">
	<div class="widget-inner">
		<header>
			<h2><?php print $cc_section_name_title; ?></h2>
			<?php if ( $cc_section_name_desctiption ) { ?>
			<div class="widget-description"><?php print $cc_section_name_desctiption; ?></div>
			<?php } ?>
		</header>
		<?php
			$the_query = cc_widgets_get_homepage_features_query( 'news-hero', 1 );


		while {
			;
		}


		?>
		
<?php
$x = 6;

do {
	echo "The number is: $x <br>";
	$x++;
} while ( $x <= 5 );
?>
		
		<article class="">
		
		
		<?php

		function build_homepage_feature( $the_query, $is_hero){
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$hero_post_id = get_the_ID();
			$url          = get_permalink();
			$categories   = get_the_category();
			if ( ! empty( $categories ) ) {
				$category_link = '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"> ' . esc_html( $categories[0]->name ) . '</a>';
			} else {
				$category_link = null;
			}


			return $article;
		}
		$the_query = cc_widgets_get_homepage_features_query( 'news-hero', 1 );
		while ( $the_query->have_posts() ) {
			build_homepage_feature( $the_query, true );
		}
		$the_query = cc_widgets_get_homepage_features_query( 'news', 1 );
		while ( $the_query->have_posts() ) {
			build_homepage_feature( $the_query, false );
		}

		?>
		  <h2 class="txt-hero"><?php print $cc_section_name_title; ?></h2>
		  <div class="widget-description"></div>
		  <div class="post-hero">
			<?php
			// The hero feature
			$the_query = cc_widgets_get_homepage_features_query( 'news-hero', 1 );
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$hero_post_id = get_the_ID();
				$url          = get_permalink();
				$categories   = get_the_category();
				if ( ! empty( $categories ) ) {
					$category_link = '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"> ' . esc_html( $categories[0]->name ) . '</a>';
				} else {
					$category_link = null;
				}
				?>
				<div class="item">
				  <div class="thumbnail">
					<a href="<?php print $url; ?>"><?php print the_post_thumbnail( 'large' ); ?></a>
				  </div>
				  <div class="teaser">
					<h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title(); ?></a></h3>
					<div class="excerpt"><?php print the_excerpt(); ?></div>
					 <div class="more"><a href="<?php print $url; ?>"><?php print $cc_whatshappening_post_read_more; ?><i class="cc-icon-right-dir"></i></a></div>
				 </div>
				</div>
				<?php } ?>
		  </div>
		  <div class="posts-featured">
			<?php
			// The four other features.
			// If we have a special feature, then it is 3 featured and 1 special feature.
			// Otherwise, it is 4 features.
			$have_special_feature = false;
			$the_special_query    = cc_widgets_get_homepage_features_query( 'news', 1 );
			if ( $the_special_query->have_posts() ) {
				$have_special_feature = true;
			}

			$the_query       = cc_widgets_get_homepage_features_query( 'news', 5 );
			$posts_displayed = 0;
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				if ( isset( $hero_post_id ) && get_the_ID() == $hero_post_id ) {
					continue;
				} else {
					$posts_displayed++;
				}
				$url        = get_permalink();
				$categories = get_the_category();
				if ( ! empty( $categories ) ) {
					$category_link = '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
				} else {
					$category_link = null;
				}
				?>
				<div class="item">
				  <div class="thumbnail">
					<a href="<?php print $url; ?>"><?php print the_post_thumbnail(); ?></a>
				  </div>
				  <div class="teaser">
					<h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title(); ?></a></h3>
					<div class="more"><a href="<?php print $url; ?>"><?php print $cc_whatshappening_post_read_more; ?><i class="cc-icon-right-dir"></i></a></div>
				  </div>
				</div>
				<?php
				if ( $posts_displayed == 4 || ( $posts_displayed == 3 && $have_special_feature == true ) ) {
					break;}
				?>
				<?php } ?>
			<?php if ( $have_special_feature == true ) : ?>
				<?php
				$the_special_query->the_post();
				$url        = get_permalink();
				$categories = get_the_category();
				if ( ! empty( $categories ) ) {
					$category_link = '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
				} else {
					$category_link = null;
				}
				?>
				<div class="item">
				  <div class="thumbnail">
					<a href="<?php print $url; ?>"><?php print the_post_thumbnail(); ?></a>
				  </div>
				  <div class="teaser">
					<h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title(); ?></a></h3>
					<div class="more"><a href="<?php print $url; ?>"><?php print $cc_whatshappening_post_read_more; ?><i class="cc-icon-right-dir"></i></a></div>
				  </div>
				</div>
			<?php endif; // $have_special_feature == TRUE ?>

		  </div>
		  <div class="more"><a href="/?post_type=post"><?php print $cc_whatshappening_more; ?><i class="cc-icon-right-dir"></i></a></div>
		</div>
	  </section>
