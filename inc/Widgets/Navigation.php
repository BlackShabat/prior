<?php

namespace Prior\Widgets;

class Navigation extends \WP_Widget {
	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct( 'prior_navigation', 'Prior Navigation', [
			'classname'   => 'pc-nav',
			'description' => 'prior navigation widget',
		] );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$title    = apply_filters( 'widget_title', $instance['title'] );
		$location = isset( $instance['location'] ) ? $instance['location'] : false;

		if ( ! $location ) {
			return;
		}

		if ( has_nav_menu( $location ) ) {
			wp_nav_menu( apply_filters( 'prior_navigation_args', [
				'theme_location'  => $location,
				'container_class' => 'pc-' . $location
			] ) );
		}

		wc_get_template( '../views/widgets/navigation.php', [
			'title'    => $title,
			'location' => $location
		] );
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$instanceTitle    = isset( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'prior' );
		$instanceLocation = isset( $instance['location'] ) ? $instance['location'] : '';

		$locations = get_registered_nav_menus();
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_attr_e( 'Title:', 'prior' ); ?>
            </label>
            <input class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                   type="text"
                   value="<?php echo esc_attr( $instanceTitle ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'location' ) ); ?>">
				<?php esc_attr_e( 'Menu location:', 'prior' ); ?>
            </label>
            <select name="<?php echo esc_attr( $this->get_field_name( 'location' ) ); ?>"
                    id="<?php echo esc_attr( $this->get_field_id( 'location' ) ); ?>"
            >
				<?php foreach ( $locations as $id => $name ): ?>
                    <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $instanceLocation, $id ); ?>>
						<?php echo $name; ?>
                    </option>
				<?php endforeach; ?>
            </select>
        </p>
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance             = [];
		$instance['title']    = ( isset( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['location'] = ( isset( $new_instance['location'] ) ) ? $new_instance['location'] : '';

		return $instance;
	}
}