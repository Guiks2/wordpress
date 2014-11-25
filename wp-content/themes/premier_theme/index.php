			<?php get_header(); ?>
            <div id="all">
                <?php get_sidebar(); ?>
          
                <div id="content">
                    <?php 
						echo '<h1>Quoi de neuf ?</h1>';
				if(have_posts()) :
					while(have_posts()) : 
					the_post();
				?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<h2>
						<?php the_post_thumbnail(); ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_title(); ?>
						</a>	
					</h2>
					<p class="postmetadata">
						<?php the_time('j F Y') ?> par <?php the_author() ?> | Cat&eacute;gorie: <?php the_category(', ') ?> | <?php comments_popup_link('Pas de commentaires', '1 Commentaire', '% Commentaires'); ?> <?php edit_post_link('Editer', ' &#124; ', ''); ?>
					</p>	
					<div class="post_content">
						<?php the_content(); ?>
					</div>
				</div>
				<?php
					endwhile;
				endif;
				?>
			</div><!-- #content -->
		</div><!-- #all -->
		<?php get_footer(); ?>