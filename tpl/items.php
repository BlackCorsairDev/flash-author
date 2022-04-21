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
		            <?php for ($i = 1; $i < FAUTHOR_IMG_COUNT; $i++) { ?>
					    <div class="color-option flash-option <?php echo ( $value == $i?'selected':'' );?>">
						<?php
						    $img = FAUTHOR_PLUGIN_URL .'img/'.$i.'.gif';
	                        $style = esc_attr( 'background-image: url(' .$img. ');-webkit-background-clip: text;color: transparent;background-size: 100% 100%;font-weight: bold;' );
						?>
						<label for="flash_nick" style="<?php echo $style; ?>"><?php echo $author_nicename; ?></label>
			                <input name="flash_nick" id="flash_nick" type="radio" value="<?php echo $i; ?>" class="tog" <?php echo checked( $value, $i );?> autocomplete="off">
			            </div>
					<?php } ?>
				</fieldset>
			</td>
	    </tr>
    </tbody>
</table>