<?php
/**
 * @author AzuraTheme
 * @param int $attachment_id
 * @param string $attachment_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @param bool $place_hold  Using place hold image if the image does not exist
 * @since 1.0
 * @return url or false
 */
function amandalite_resize_image( $attachment_id = null, $attachment_url = null, $width, $height, $crop = false, $place_holder = false )
{
    $actual_file_path = null;
    if ( $attachment_id ) {
        $actual_file_path = get_attached_file( $attachment_id );
    } elseif ( $attachment_url ) {
  		$actual_file_path = str_replace( get_site_url(), rtrim( ABSPATH, '/' ), $attachment_url );
    }
    
    if ( !$actual_file_path && $place_holder ) {
        $actual_file_path = get_template_directory() . '/assets/images/place-holder.png';
    }

    if ( $actual_file_path )
    {
        $image_editor = wp_get_image_editor( $actual_file_path );    
        if ( ! is_wp_error($image_editor) ) {
            $image_editor->resize( $width, $height, $crop );
            $new_image = $image_editor->save( $image_editor->generate_filename() );

            if ( ! is_wp_error($new_image) ) {
                $new_image_url = str_replace( rtrim( ABSPATH, '/' ), get_site_url(), $new_image['path'] );
                return $new_image_url;
            }
        }
    }
    return false;
}
?>