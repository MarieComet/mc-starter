<?php
/**
 * Registers and displays notices
 */


add_action( 'admin_notices', 'mcstarter_review_notice' );
/**
 * Displays our review notice
 */
function mcstarter_review_notice(){
    $mcstarter_review = get_transient( 'mcstarter_review' );
    if( ! $mcstarter_review ){
        ?>
            <div class="notice notice-info is-dismissible">
                <p>
                    <?php 
                        printf( 
                            __( 'If you like my MCStarter theme, do you mind <a href="%s" target="_blank" rel="noreferrer">leaving a review</a> ? That will help me a lot ! Thanks in advance !', 'mcstarter' ), 
                            'https://wordpress.org/themes/mcstarter/'
                        );
                    ?>
                </p>  
            </div>
        <?php
    }
    set_transient( 'mcstarter_review', true, 2 * WEEK_IN_SECONDS );
}