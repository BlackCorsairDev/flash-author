 <table class="form-table" role="presentation">
	<tbody>
		<tr class="user-admin-color-wrap">
		    <th scope="row">Flash Background Scheme</th>
		    <td>
				<fieldset id="flash-picker" class="scheme-list">
		            <legend class="screen-reader-text"><span>Flash Background Scheme</span></legend>
		            <input type="hidden" id="wporg_field" name="wporg_field" value="<?php echo $value; ?>">		
					    <div class="color-option flash-option <?php echo ( $value == 0?'selected':'' );?>">
						    <label for="flash_nick"><?php echo $author_nicename; ?></label>
			                <input name="flash_nick" id="flash_nick" type="radio" value="0" class="tog" <?php echo checked( 0, 0 );?> autocomplete="off">
			            </div>
		            <?php $i = 1; foreach (glob(FAUTHOR_DIR . 'img/*.gif') as $img) {  ?>
					    <div class="color-option flash-option <?php echo ( $value == $i?'selected':'' );?>">
						<?php $this->image = $i; $style =  esc_html($this->_the_style()); ?>
						    <label for="flash_nick" style="<?php echo $style; ?>"><?php echo $author_nicename; ?></label>
			                <input name="flash_nick" id="flash_nick" type="radio" value="<?php echo $i; ?>" class="tog" <?php echo checked( $value, $i );?> autocomplete="off">
			            </div>
					<?php  $i++; } ?>
				</fieldset>
			</td>
	    </tr>
    </tbody>
</table>
