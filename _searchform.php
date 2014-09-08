<?php  ?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/search' ) ); ?>">
		<label for="q" class="assistive-text"><?php _e( 'Search', 'thematic' ); ?></label>
		<input type="text" class="field" name="q" id="q" placeholder="<?php esc_attr_e( 'Search', 'thematic' ); ?>" />
		<input type="submit" class="button" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Go', 'thematic' ); ?>" />
	</form>
<?php  ?>