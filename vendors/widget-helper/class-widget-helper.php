<?php
/**
 * Widget helper class
 *
 * @package NewsGreen
 */

if ( ! class_exists(' NewsGreen_Widget_Helper' ) ) {

	/**
	* Widget helper class.
	*
	* @since 1.0.0
	*/
	class NewsGreen_Widget_Helper extends WP_Widget {

		protected $args;

		protected $fields;

		function create_widget( $args ) {

			$this->args = $args;

			$widget_options  = isset( $args['widget'] ) ? $args['widget'] : array();
			$control_options = isset( $args['control'] ) ? $args['control'] : array();

			$this->fields = isset( $args['fields'] ) ? $args['fields'] : array();

			parent::__construct( $args['id'], $args['label'], $widget_options, $control_options );

		}

		function form( $instance ) {

			$this->create_form( $instance );

		}

		function get_field_values( $instance ) {

			$values = array();
			$defaults = $this->get_default_field_values();
			$values = array_merge( $defaults, $instance );
			return $values;

		}

		private function get_default_field_values() {

			$default_values = array();

			if ( ! empty( $this->fields ) ) {
				foreach ( $this->fields as $key => $field ) {
					$default_values[ $key ] = null;
					if ( ! isset( $instance[ $key ] ) && isset( $field['default'] ) ) {
						$default_values[ $key ] = $field['default'];
					}
				}
			}

			return $default_values;

		}

		protected function create_form( $instance ) {

			if ( ! $this->fields ) {
				return;
			}

			$values = $this->get_field_values( $instance );

			foreach ( $this->fields as $key => $field ) {
				$this->create_form_field( $key, $field, $values[ $key ] );
			}

		}

		protected function create_form_field( $key, $field, $value ) {

			$type  = isset( $field['type'] ) ? $field['type'] : 'text';
			$class = isset( $field['class'] ) ? sanitize_html_class( $field['class'] ) : '';

			$field['rows']        = ( isset( $field['rows'] ) && absint( $field['rows'] ) > 0 ) ? absint( $field['rows'] ) : 5;
			$field['placeholder'] = isset( $field['placeholder'] ) ? $field['placeholder'] : '';

			switch ( $type ) {
				case 'text':
				case 'email':
				case 'url':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
						<input type="<?php echo esc_attr( $type ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" value="<?php echo esc_attr( $value ); ?>" class="<?php echo esc_attr( $class ); ?>" />
						<?php if ( isset( $field['description'] ) && ! empty( $field['description'] ) ) : ?>
							<span class="widget-field-description"><em><?php echo esc_html( $field['description'] ); ?></em></span>
						<?php endif; ?>
					</p>

					<?php
				break;

				case 'image':
					?>
					<div class="widget-field-image">
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
						<input type="button" class="button button-primary wh-image-picker" value="<?php esc_attr_e( 'Upload', 'newsreader' ); ?>" data-uploader_title="<?php esc_attr_e( 'Select Image', 'newsreader' ); ?>" data-uploader_button_text="<?php esc_attr_e( 'Choose Image', 'newsreader' ); ?>" />
						<input type="hidden" class="image-field-hidden" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" value="<?php echo esc_attr( $value ); ?>" />
						<input type="button" class="button button-secondary btn-image-remove" value="<?php esc_attr_e( 'Remove', 'newsreader' ); ?>" <?php echo ( empty( $value ) ) ? 'style="display:none;"' : ''; ?> />
						<div class="field-image-preview">
						<?php if ( ! empty( $value ) ) : ?>
							<img src="<?php echo esc_url( $value ); ?>" alt="" />
						<?php endif; ?>
						</div><!-- .field-image-preview -->
					</div>
					<?php
				break;

				case 'number':
					$min = isset( $field['min'] ) ? absint( $field['min'] ) : 0;
					$max = isset( $field['max'] ) ? absint( $field['max'] ) : 999;
					$step = isset( $field['step'] ) ? absint( $field['step'] ) : 1;
					?>
					<p class="widget-field-number">
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
						<input type="number" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" value="<?php echo esc_attr( $value ); ?>" class="<?php echo esc_attr( $class ); ?>" min="<?php echo esc_attr( $min ); ?>" max="<?php echo esc_attr( $max ); ?>" step="<?php echo esc_attr( $step ); ?>" />
						<?php if ( isset( $field['description'] ) && ! empty( $field['description'] ) ) : ?>
							<span class="widget-field-description"><em><?php echo esc_html( $field['description'] ); ?></em></span>
						<?php endif; ?>
					</p>
					<?php
				break;

				case 'color':
					?>
					<p class="widget-field-color">
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
						<input type="text" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" value="<?php echo esc_attr( $value ); ?>" class="wh-color-picker <?php echo esc_attr( $class ); ?>" />
					</p>
					<?php
				break;

				case 'checkbox':
					?>
					<p>
						<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" class="<?php echo esc_attr( $class ); ?>" <?php checked( ! empty( $value ) ); ?> />
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
					</p>
					<?php
				break;

				case 'textarea':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
						<textarea rows="<?php echo absint( $field['rows'] ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" class="widefat <?php echo esc_attr( $class ); ?>" placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>"><?php echo esc_textarea( $value ); ?></textarea>
						<?php if ( isset( $field['description'] ) && ! empty( $field['description'] ) ) : ?>
							<span class="widget-field-description"><em><?php echo esc_html( $field['description'] ); ?></em></span>
						<?php endif; ?>
					</p>
					<?php
				break;

				case 'separator':
					?>
					<hr class="separator" />
					<?php
				break;

				case 'heading':
					?>
					<div class="widefat widget-field-heading <?php echo esc_attr( $class ); ?>">
						<h4><?php echo esc_html( $field['label'] ); ?></h4>
					</div>
					<?php
				break;

				case 'message':
					?>
					<div class="widefat widget-field-message <?php echo esc_attr( $class ); ?>">
						<?php echo wp_kses_post( $field['label'] ); ?>
					</div>
					<?php
				break;

				case 'select':
					?>
					<p class="widget-field-select">
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
						<select id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" class="<?php echo esc_attr( $class ); ?>">
							<?php if ( ! empty( $field['choices'] ) ) : ?>
								<?php foreach ( $field['choices'] as $k => $label ) : ?>
									<option value="<?php echo esc_attr( $k ); ?>" <?php selected( $k, $value ); ?>><?php echo esc_html( $label ); ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
						</select>
						<?php if ( isset( $field['description'] ) && ! empty( $field['description'] ) ) : ?>
							<span class="widget-field-description"><em><?php echo esc_html( $field['description'] ); ?></em></span>
						<?php endif; ?>
					</p>
					<?php
				break;

				case 'radio':
					?>
					<p class="widget-field-radio">
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
						<?php if ( ! empty( $field['choices'] ) ) : ?>
							<?php foreach ( $field['choices'] as $k => $label ) : ?>
								<label for="<?php echo esc_attr( $this->get_field_id( $key ) . '-' . $k ); ?>">
								<input type="radio" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) . '-' . $k ); ?>" value="<?php echo esc_attr( $k ); ?>" <?php checked( $k, $value ) ?> /><span class="radio-item"><?php echo esc_html( $label ); ?></span>
								</label>
							<?php endforeach; ?>
						<?php endif; ?>
						<?php if ( isset( $field['description'] ) && ! empty( $field['description'] ) ) : ?>
							<span class="widget-field-description"><em><?php echo esc_html( $field['description'] ); ?></em></span>
						<?php endif; ?>
					</p>
					<?php
				break;

				case 'dropdown-pages':
					$page_args = array();

					$page_args['selected']         = $value;
					$page_args['name']             = $this->get_field_name( $key );
					$page_args['id']               = $this->get_field_id( $key );
					$page_args['show_option_none'] = ( isset( $field['show_option_none'] ) ) ? esc_html( $field['show_option_none'] ) : '';
					$page_args['class']            = esc_attr( $class ) ;

					?>
					<p class="widget-field-dropdown-pages">
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
						<?php wp_dropdown_pages( $page_args ); ?>
						<?php if ( isset( $field['description'] ) && ! empty( $field['description'] ) ) : ?>
							<span class="widget-field-description"><em><?php echo esc_html( $field['description'] ); ?></em></span>
						<?php endif; ?>
					</p>
					<?php
				break;

				case 'dropdown-taxonomies':
					$tax_args = array();

					$tax_args['selected']        = $value;
					$tax_args['hide_empty']      = true;
					$tax_args['taxonomy']        = ( isset( $field['taxonomy'] ) ) ? esc_attr( $field['taxonomy'] ) : 'category' ;
					$tax_args['name']            = $this->get_field_name( $key );
					$tax_args['id']              = $this->get_field_id( $key );
					$tax_args['show_option_all'] = ( isset( $field['show_option_all'] ) ) ? esc_html( $field['show_option_all'] ) : '' ;
					$tax_args['class']           = esc_attr( $class );
					?>
					<p class="widget-field-dropdown-taxonomies">
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
						<?php wp_dropdown_categories( $tax_args ); ?>
						<?php if ( isset( $field['description'] ) && ! empty( $field['description'] ) ) : ?>
							<span class="widget-field-description"><em><?php echo esc_html( $field['description'] ); ?></em></span>
						<?php endif; ?>
					</p>
					<?php
				break;

				default:
				break;
			}

		}

		function update( $new_instance, $old_instance ) {

			$instance = $this->update_form( $new_instance, $old_instance );

			return $instance;

		}

		protected function update_form( $new_instance, $old_instance ) {

			$instance = $old_instance;

			foreach ( $this->fields as $key => $field ) {

				$instance[ $key ] = $this->sanitize_field( $key, $field, $new_instance[ $key ] );

			}

			return $instance;

		}

		protected function sanitize_field( $key, $field, $new_value ) {

			$ret = null;

			$field_type = isset( $field['type'] ) ? $field['type'] : 'text';

			switch ( $field_type ) {
				case 'text':
					$ret = sanitize_text_field( $new_value );
					break;

				case 'number':
					$ret = absint( $new_value );
					break;

				case 'color':
					$ret = sanitize_text_field( $new_value );
					break;

				case 'image':
					$ret = esc_url_raw( $new_value );
					break;

				case 'select':
					$ret = sanitize_text_field( $new_value );
					break;

				case 'radio':
					$ret = sanitize_text_field( $new_value );
					break;

				case 'textarea':
					$ret = wp_kses_post( $new_value );
					break;

				case 'url':
					$ret = esc_url_raw( $new_value );
					break;

				case 'email':
					$ret = sanitize_email( $new_value );
					break;

				case 'dropdown-pages':
					$ret = absint( $new_value );
					break;

				case 'dropdown-taxonomies':
					$ret = absint( $new_value );
					break;

				case 'checkbox':
					$ret = (bool)$new_value;
					break;

				default:
					$ret = sanitize_text_field( $new_value );
					break;
			}

			return $ret;

		}
	}
}
