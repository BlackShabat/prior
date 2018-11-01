<header class="pl-header">

	<?php if ( has_action( 'prior_header_top' ) ): ?>
        <div class="pl-header__top">
			<?php do_action( 'prior_header_top' ); ?>
        </div>
	<?php endif; ?>

	<?php if ( has_action( 'prior_header_main' ) ): ?>
        <div class="pl-header__container">
            <div class="pl-header__main">
				<?php do_action( 'prior_header_main' ); ?>
            </div>
        </div>
	<?php endif; ?>

	<?php if ( has_action( 'prior_header_bottom' ) ): ?>
        <div class="pl-header__bottom">
			<?php do_action( 'prior_header_bottom' ); ?>
        </div>
	<?php endif; ?>

</header>
