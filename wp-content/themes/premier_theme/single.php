			<?php get_header(); ?>
            <div id="all">
                <?php get_sidebar(); ?>
          
                <div id="content">
                    <?php 
					if(isset($_GET['s']))
						echo '<h1>Résultats de recherche : '. $_GET['s'] .'</h1>';
					else if(isset($_GET['p']))
						echo '';
					else
						echo '<h1>Quoi de neuf ?</h1>';
				if(have_posts()) :
					while(have_posts()) : 
					the_post();
				?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<h2>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_title(); ?>
						</a>	
					</h2>
				
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