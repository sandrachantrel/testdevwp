<?php
get_header();
?>
    <section>
        <div class="container container-single-service">
            <div class="row">
                <div class="col-12">
                    <?php
                    $post = 0;
                    if (have_posts()) :
                        while (have_posts()) :
                            the_post(); ?>
                            <h1 class="service-title"><?php the_title(); ?></h1>
                            <aside class="service-type"><?php the_terms(get_the_ID(), 'type-service', 'Type : '); ?></aside>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <?php the_post_thumbnail('service-thumbnail', ['class' => 'service-image']); ?>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                            <p class="service-prix"> Prix du service:
                                <b><?php echo get_post_meta(get_the_ID(), '_serviceprix', true); ?> €</b>
                            </p>
                        <?php endwhile;
                    endif; ?>
                </div>
            </div>
        </div>

        <?php wp_reset_postdata(); ?>

    </section>

<?php

get_footer() ?>