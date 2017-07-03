<?php
/* ------------------------------------------------------------------------- *
* Get Related Posts
* ------------------------------------------------------------------------- */
$max_articles = cd_single_related_max();

$tags = wp_get_post_tags($post -> ID);
$tag_ids = array();

foreach ( $tags as $tag ) {
  array_push( $tag_ids, $tag -> term_id);
}

$tag_args = array(
  'post__not_in' => array($post -> ID),
  'posts_per_page'=> $max_articles,
  'tag__in' => $tag_ids,
  'orderby' => 'rand',
);

$related_posts = get_posts( $tag_args );
$posts_by_cats_count = count( $related_posts );

// If hasn't got enought by tags, also gets by categories
if ( $max_articles > $posts_by_cats_count || empty( $tags ) ) {

  $categories = get_the_category( $post -> ID );
  $category_ID = array();

  foreach ( $categories as $category ) {
    array_push( $category_ID, $category -> cat_ID);
  }

  $cat_args = array(
    'post__not_in' => array( $post -> ID ),
    'posts_per_page'=> ( $max_articles - $posts_by_cats_count ),
    'category__in' => $category_ID,
    'orderby' => 'rand',
  );
  $posts_by_cats = get_posts( $cat_args );

  $related_posts = array_merge( $related_posts, $posts_by_cats );
} ?>


<?php if ( count( $related_posts ) > 0 ) : ?>

  <section class="related-posts content-box">

    <h4 class="related-head"><?php esc_html_e( 'Related Posts', 'coldbox' ); ?></h4>
    <ul class="related-posts-list">


      <?php foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>

        <li class="related-article">
          <article <?php post_class();?>>

            <figure class="post-thumbnail">
              <a href="<?php the_permalink(); ?>">
                <?php if ( has_post_thumbnail() ): ?>
                  <?php the_post_thumbnail( 'cd-standard' ); ?>
                <?php else: ?>
                  <img src="<?php echo esc_attr( get_template_directory_uri() . '/img/thumb-standard.png' ); ?>" alt="noimage" height="500" width="500">
                <?php endif; ?>
              </a>
            </figure>

            <div class="post-content">
              <div class="post-category"><?php the_category(' / ') ?></div>
              <h5 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            </div>

          </article>
        </li>

      <?php endforeach; ?>

    </ul>

  </section>

<?php endif; ?>

<?php wp_reset_postdata(); ?>
