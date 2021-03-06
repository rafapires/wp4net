<?php

class FrmProEntriesListHelper extends FrmEntriesListHelper {

	function get_bulk_actions() {
        $actions = array( 'bulk_delete' => __( 'Delete'));

        if ( ! current_user_can('frm_delete_entries') ) {
            unset($actions['bulk_delete']);
        }

        //$actions['bulk_export'] = __( 'Export to XML', 'formidable' );

        $actions['bulk_csv'] = __( 'Export to CSV', 'formidable' );

        return $actions;
    }

    function extra_tablenav( $which ) {
        $footer = ($which == 'top') ? false : true;
        FrmProEntriesHelper::before_table($footer, $this->params['form']);
	}

	public function search_box( $text, $input_id ) {
		if ( ! $this->has_items() && ! isset( $_REQUEST['s'] ) ) {
			return;
		}

		if ( isset( $this->params['form'] ) ) {
			$form = FrmForm::getOne( $this->params['form'] );
		} else {
			$form = FrmForm::get_published_forms( array(), 1 );
		}

		if ( $form ) {
			$field_list = FrmField::getAll( array( 'fi.form_id' => $form->id, 'fi.type not' => FrmFieldsHelper::no_save_fields() ), 'field_order' );
		}

		$fid = isset( $_REQUEST['fid'] ) ? esc_attr( stripslashes( $_REQUEST['fid'] ) ) : '';
		$input_id = $input_id . '-search-input';
		$search_str = isset( $_REQUEST['s'] ) ? esc_attr( stripslashes( $_REQUEST['s'] ) ) : '';

		foreach ( array( 'orderby', 'order' ) as $get_var ) {
			if ( ! empty( $_REQUEST[ $get_var ] ) ) {
				echo '<input type="hidden" name="' . esc_attr( $get_var ) . '" value="' . esc_attr( $_REQUEST[ $get_var ] ) . '" />';
        	}
        }

?>
<div class="search-box frm_sidebar">
	<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ) ?>"><?php echo esc_attr( $text ); ?>:</label>
	<input type="text" id="<?php echo esc_attr( $input_id ) ?>" name="s" value="<?php echo esc_attr( $search_str ); ?>" />
	<?php
	if ( isset( $field_list ) && ! empty( $field_list ) ) { ?>
	<select name="fid" class="hide-if-js">
		<option value="">&mdash; <?php _e( 'All Fields', 'formidable' ) ?> &mdash;</option>
		<option value="created_at" <?php selected( $fid, 'created_at' ) ?>><?php _e( 'Entry creation date', 'formidable' ) ?></option>
		<option value="id" <?php selected( $fid, 'id' ) ?>><?php _e( 'Entry ID', 'formidable' ) ?></option>
		<?php foreach ( $field_list as $f ) { ?>
		<option value="<?php echo ( $f->type == 'user_id' ) ? 'user_id' : $f->id ?>" <?php selected( $fid, $f->id ) ?>><?php echo FrmAppHelper::truncate( $f->name, 30 );  ?></option>
		<?php } ?>
	</select>

	<div class="button dropdown hide-if-no-js">
		<a href="#" id="frm-fid-search" class="frm-dropdown-toggle" data-toggle="dropdown"><?php _e( 'Search', 'formidable' ) ?> <b class="caret"></b></a>
		<ul class="frm-dropdown-menu pull-right" id="frm-fid-search-menu" role="menu" aria-labelledby="frm-fid-search">
			<li><a href="#" id="fid-">&mdash; <?php _e( 'All Fields', 'formidable' ) ?> &mdash;</a></li>
			<li><a href="#" id="fid-created_at"><?php _e( 'Entry creation date', 'formidable' ) ?></a></li>
			<li><a href="#" id="fid-id"><?php _e( 'Entry ID', 'formidable' ) ?></a></li>
			<?php
			foreach ( $field_list as $f ) { ?>
			<li><a href="#" id="fid-<?php echo ( $f->type == 'user_id' ) ? 'user_id' : $f->id ?>"><?php echo FrmAppHelper::truncate( $f->name, 30 ); ?></a></li>
			<?php
				unset( $f );
			} ?>
		</ul>
	</div>
	<?php submit_button( $text, 'button hide-if-js', false, false, array( 'id' => 'search-submit' ) );
	} else {
		submit_button( $text, 'button', false, false, array( 'id' => 'search-submit' ) );
		if ( ! empty( $search_str ) ) { ?>
	<a href="<?php echo esc_url( admin_url( 'admin.php?page=formidable-entries&frm_action=list&form=' . $form->id ) ) ?>"><?php _e( 'Reset', 'formidable' ) ?></a>
	<?php
		}
	} ?>

</div>
<?php
	}
}
