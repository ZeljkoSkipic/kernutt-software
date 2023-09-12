<?php
$title = get_the_title();
$image = get_the_post_thumbnail(get_the_id(), 'large');
$excerpt = get_the_excerpt();
?>

<div class="posts_grid_item">
    <div class="pg-image">

        <?php if ($image) : ?>
            <a href="<?php the_permalink(); ?>">
                <?php echo $image; ?>
            </a>
        <?php endif; ?>

    </div>

    <?php if ($title) : ?>

        <h4 class="heading-secondary">
            <a href="<?php the_permalink(); ?>"><?php echo $title; ?></a>
        </h4>

    <?php endif; ?>

    <div class="posts-author-date">
        <p class="posts-author"> <?php echo "by ". get_the_author()." | ".get_the_date('M. d, Y') ?> </p>
    </div>

    <?php if ($excerpt) :
         if (strlen($excerpt) <= 100){
            // Outputs the whole post content
           $trimmed_excerpt = $excerpt;
        }else{
            $trimmed_excerpt = substr($excerpt, 0, strpos($excerpt, ' ', 60));
            $trimmed_excerpt.="...";
        }

          $single_url = "<a class='post-link' href='".get_the_permalink()."'>".__('read more.')." </a>";
          $excerpt = sprintf("%s %s", $trimmed_excerpt, $single_url );
          ?>

        <div class="entry-content"> <?php echo $excerpt;  ?> </div>

    <?php endif; ?>

</div>
