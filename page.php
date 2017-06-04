<?php get_header(); ?>

<?php while ( have_posts() ): the_post(); ?>
  <main id="main" class="main-page">
    <article id="post-<?php the_ID(); ?>" <?php post_class('main-inner'); ?>>

      <header class="title-box">
        <div class="title-box-inner container">
          <div class="breadcrumb"><?php cd_breadcrumb(); ?></div>
          <h1 class="post-title">
            <?php echo get_the_title(); ?>
          </h1>
        </div>
      </header>


      <div class="container-outer">
        <div class="container">

          <div class="content">

            <div class="content-inner">

              <div class="content-inside">

                <div class="post-meta content-box">
                  <?php if ( cd_is_meta_date() ){ ?><span class="post-date"><?php echo get_the_date(); ?></span><?php } ?>
                  <?php if ( cd_is_meta_author() ){ ?><span class="post-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo $author = get_the_author(); ?></a></span><?php } ?>
                  <?php if ( cd_is_meta_com() && comments_open() && cd_is_post_single_comment() ) { ?><span class="post-comment"><?php comments_popup_link('0', '1', '%'); ?></span><?php } ?>
                </div>
                <div class="entry">
                  <div class="entry-inner content-box"><?php the_content(); ?></div>
                </div>
                <?php wp_link_pages( $defaults = array( 'before' => '<div class="post-pages">' . __( 'Pages:', 'coldbox' ), 'after'=> '</div>', 'link_before' => '<span class="page-number">', 'link_after' => '</span>' ) ); ?>

                <?php if ( cd_is_post_single_comment() ) { comments_template( '/comments.php', true ); } ?>

              </div><!--/.content-inside-->

            </div><!--/.content-inner-->
          </div><!--/.content-->

          <?php get_sidebar(); ?>

        </div><!--/.container-->
      </div><!--/.container-outer-->

    </article>
  </main>
<?php endwhile; ?>

<?php get_footer(); ?>
