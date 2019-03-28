<?php get_header(); ?>

<?php if ( have_posts() ): ?>

	<?php if ( is_singular() ): ?>
		<?php while ( have_posts() ): the_post(); ?>
			<?php get_template_part( 'views/content/content', get_post_format() ); ?>
		<?php endwhile; ?>
	<?php else: ?>
        <section class="pr-archive">
			<?php if ( is_home() && ! is_front_page() ) : ?>
                <header class="pr-archive__header">
                    <h1 class="pr-archive__title"><?php single_post_title(); ?></h1>
                </header>
			<?php endif; ?>
            <div class="pr-archive__body">
				<?php while ( have_posts() ): the_post(); ?>
					<?php get_template_part( 'views/archive/archive', get_post_format() ); ?>
				<?php endwhile; ?>
            </div>

			<?php the_posts_navigation(); ?>
        </section>
	<?php endif; ?>

<?php else: ?>
	<?php get_template_part( 'views/content', 'none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>
