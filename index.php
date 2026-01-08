<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Include the header
get_header(); ?>

<main>
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
    else :
        echo '<p>No content found</p>';
    endif;
    ?>

</main>

<?php
// Include the footer
get_footer();
