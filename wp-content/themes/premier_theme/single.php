			<?php get_header(); ?>
            <div id="all">
                <?php get_sidebar(); ?>
          
                <div id="content">
                    <?php 
				if(have_posts()) :
					while(have_posts()) : 
					the_post();
				?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<h1>
						<a style="color: #057" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_title(); ?>
						</a>	
					</h1>
				
					<div class="post_content">
						<?php the_content(); ?>
					</div>
				</div>
                <hr/><hr/>
                <div class="comments-template">
					<?php comments_template(); ?>
                </div>
				<?php
					endwhile;
				endif;
				?>
			</div><!-- #content -->
		</div><!-- #all -->
		<?php get_footer(); ?>