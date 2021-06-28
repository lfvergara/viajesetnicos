<div class="mkdf-membership-dashboard-page">
	<div class="mkdf-membership-dashboard-page-content">
		<div class="mkdf-profile-image">
            <?php echo mkdf_membership_kses_img( $profile_image ); ?>
        </div>
		<p>
			<span><?php esc_html_e( 'First Name', 'mkdf-membership' ); ?>:</span>
			<?php echo esc_html($first_name); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Last Name', 'mkdf-membership' ); ?>:</span>
			<?php echo esc_html($last_name); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Email', 'mkdf-membership' ); ?>:</span>
			<?php echo esc_html($email); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Desription', 'mkdf-membership' ); ?>:</span>
			<?php echo esc_html($description); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Website', 'mkdf-membership' ); ?>:</span>
			<a href="<?php echo esc_url( $website ); ?>" target="_blank"><?php echo esc_html($website); ?></a>
		</p>
	</div>
</div>
