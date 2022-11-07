<?php

namespace CustomPaymentGateway\Gateway\Config;

use CustomPaymentGateway\Form\Checkbox;
use CustomPaymentGateway\Form\Text;

class Form {

	public static function select(array $args) {
		if (isset($args['description'])) {
			self::description($args['description']);
		}
		?>
		<select
			name="<?php echo esc_attr($args['label_for']) ?>"
			id="<?php echo esc_attr($args['label_for']) ?>"
		>
			<?php
			foreach ($args['options'] as $key => $option) {
				?>
				<option value="<?php echo esc_attr($key) ?>" <?php selected($args['value'], $key) ?>>
					<?php echo esc_html($option) ?>
				</option>
				<?php
			}
			?>
		</select>
		<?php
	}

	public static function description(string $text) {
		?>
		<p class="description"><?php echo esc_html($text); ?></p>
		<?php
	}
}