<?php get_header(); ?>
<?php gah_put_container_start_tag(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content', get_post_format() ); ?>
	
	<?php comments_template( '', true ); ?>
	
<?php endwhile; // end of the loop. ?>

<?php gah_put_container_end_tag(); ?>
<?php get_footer(); ?>