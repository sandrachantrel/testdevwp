<?php
/*
Template Name: Template Home
Template Post Type: post, page, product
*/

// toujours commencer par la boucle principale de wp dans n'importe quel fichier traitant du contenu unique
get_header();
if (have_posts()) {
    while (have_posts()) {
        the_post();
        ?>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="h1-home"><?php the_title(); ?></h1>
                        <?php echo apply_filters('the_content', get_option('message_display_custom'));?>
                    </div>
                </div>
            </div>
            <?php

            // 1. On exécute la WP Query
            $my_query = new WP_Query(array(
                'post_type' => 'services',
                'order' => 'ASC',
            ),
            );

            // 2. On lance la boucle personnalisée
            if ($my_query->have_posts()) {

                ?>
                <div class="container services-container">
                    <div class="row">
                        <div class="row">
                            <?php
                            $index = 0;
                            while ($my_query->have_posts()) {

                                $my_query->the_post();
                                $index++;
                                $col = 'col-md-6';
                                if ($index === 4 || $index === 5) {
                                    $col = 'col-md-3';
                                }
                                $types = get_the_terms(get_the_ID(), 'type-service');
                                ?>
                                <article class="col-12 <?php echo $col; ?>" role="article">
                                    <a href="<?php echo get_permalink(); ?>" class="article" rel="bookmark">
                                        <header class="article-title"><?php the_title(); ?></header>
                                        <p class="article-type">Type: <?php foreach ($types as $type) {
                                                echo($type->name);
                                            } ?></p>
                                    </a>
                                </article>

                            <?php } ?>


                        </div>
                    </div>
                </div>
                <?php
            }
            wp_reset_postdata();
            ?>
        </section>

        <?php
    }
    wp_reset_postdata();
}

get_footer();
?>