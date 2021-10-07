<?php

if ( function_exists('amandalite_require_file') )   
{   
    # Load Classes
    amandalite_require_file( AMANDALITE_CORE_CLASSES . 'class-tgm-plugin-activation.php' );
    
    # Load Functions
    amandalite_require_file( AMANDALITE_CORE_FUNCTIONS . 'customizer/azr_customizer_settings.php' );
    amandalite_require_file( AMANDALITE_CORE_FUNCTIONS . 'customizer/azr_customizer_style.php' );
    amandalite_require_file( AMANDALITE_CORE_FUNCTIONS . 'amandalite_resize_image.php' );

    # Widgets
	amandalite_require_file( AMANDALITE_CORE_PATH . 'widgets/amandalite_latest_posts_widget.php' );
    amandalite_require_file( AMANDALITE_CORE_PATH . 'widgets/amandalite_social_network.php' );


}
