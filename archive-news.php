<?php get_header(); ?>

<div class="section-area-left article-wrap">
            <main class="main-contents">
            <section class="contents">
                    <div class="title">
                        <span class="border-h"></span>
                        <h2><?php echo esc_html(get_post_type_object(get_post_type())->label); ?></h2>
                    </div>
                    <div class="cont-text">
                    <?php
                    if( wp_is_mobile() ){
                        $num = 3; // スマホの表示数(全件は-1)
                      } else {
                        $num = 10; // PCの表示数(全件は-1)
                      }
                      $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                      $args = [
                        'post_type' => 'news', // 投稿タイプのスラッグ(通常投稿なので'post')
                        'paged' => $paged, // ページネーションがある場合に必要
                        'posts_per_page' => $num, // 表示件数
                      ];
                      $wp_query = new WP_Query($args);
                    if ( $wp_query->have_posts() ) :
                    while ( $wp_query->have_posts() ) : $wp_query->the_post();
                    ?>
                    
                        <div class="news-cont">
                            <div class="flex date">
                                <p><?php the_time('Y年m月d日'); ?></p>
                                <?php
                                    $category = get_the_category();
                                    $tag = get_the_tags();
                                    echo '<span class="tag '.$tag[0]->slug.'">'.$category[0]->name.'</span>';
                                ?>
                            </div>
                            <p class="container"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                        </div>
                        <?php endwhile; else: ?>
                        <p>まだニュースがありません</p>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>
                        <div class="arrow">
                            <?php
                                the_posts_pagination( array( 
                                'mid_size' => 1,
                                'prev_next' => false,
                                ) );
                            ?>
                            </div>
                    </div>
            </main>
        </div>

        <?php get_sidebar(); ?>

<?php get_footer(); ?>