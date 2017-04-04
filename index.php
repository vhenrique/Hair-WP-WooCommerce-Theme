<?php get_header(); ?>

    <div class="container">
        <?php if(!empty($redux_options[$themePrefix.'infoBox_ico_one']) && strlen($redux_options[$themePrefix.'infoBox_title_one']) > 0 && strlen($redux_options[$themePrefix.'infoBox_excerpt_one'])){
            echo '<div class="column dt-sc-one-third first"><div class="dt-sc-ico-content type3 animate" data-delay="100" data-animation="animated fadeIn">';
            echo '<div class="icon"><img src="'.$redux_options[$themePrefix.'infoBox_ico_one']['url'].'" alt="'.$redux_options[$themePrefix.'infoBox_excerpt_one'].'" title="'.$redux_options[$themePrefix.'infoBox_title_one'].'" /></div>';
            echo '<h3>'.$redux_options[$themePrefix.'infoBox_title_one'].'</h3><p>'.apply_filters('the_content', $redux_options[$themePrefix.'infoBox_excerpt_one']).'</p>';
            echo '</div></div>';
        } 

        if(!empty($redux_options[$themePrefix.'infoBox_ico_two']) && strlen($redux_options[$themePrefix.'infoBox_title_two']) > 0 && strlen($redux_options[$themePrefix.'infoBox_excerpt_two'])){
            echo '<div class="column dt-sc-one-third first"><div class="dt-sc-ico-content type3 animate" data-delay="100" data-animation="animated fadeIn">';
            echo '<div class="icon"><img src="'.$redux_options[$themePrefix.'infoBox_ico_two']['url'].'" alt="'.$redux_options[$themePrefix.'infoBox_excerpt_two'].'" title="'.$redux_options[$themePrefix.'infoBox_title_two'].'" /></div>';
            echo '<h3>'.$redux_options[$themePrefix.'infoBox_title_two'].'</h3><p>'.apply_filters('the_content', $redux_options[$themePrefix.'infoBox_excerpt_two']).'</p>';
            echo '</div></div>';
        } 

        if(!empty($redux_options[$themePrefix.'infoBox_ico_three']) && strlen($redux_options[$themePrefix.'infoBox_title_three']) > 0 && strlen($redux_options[$themePrefix.'infoBox_excerpt_three'])){
            echo '<div class="column dt-sc-one-third first"><div class="dt-sc-ico-content type3 animate" data-delay="100" data-animation="animated fadeIn">';
            echo '<div class="icon"><img src="'.$redux_options[$themePrefix.'infoBox_ico_three']['url'].'" alt="'.$redux_options[$themePrefix.'infoBox_excerpt_three'].'" title="'.$redux_options[$themePrefix.'infoBox_title_three'].'" /></div>';
            echo '<h3>'.$redux_options[$themePrefix.'infoBox_title_three'].'</h3><p>'.apply_filters('the_content', $redux_options[$themePrefix.'infoBox_excerpt_three']).'</p>';
            echo '</div></div>';
        } ?>
        
        <div class="hr-invisible-medium"></div>
        <div class="hr-separator"></div>
        <div class="hr-invisible-small"></div>

        <h2 class="border-title aligncenter animate" data-delay="100" data-animation="animated fadeInDown">Quem usa nossos cabelos</h2>
        <div class="hr-invisible-very-very-small"></div>
        <div class="column dt-sc-one-fifth  first animate" data-delay="100" data-animation="animated fadeIn">
            <div class="dt-sc-team type2">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/luciana-gimenez.png" alt="" title="" />
                </div>
                <h5><p>  Luciana Gimenez </p></h5>
            </div>
        </div> 
        <div class="column dt-sc-one-fifth  animate" data-delay="300" data-animation="animated fadeIn">
            <div class="dt-sc-team type2">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/lexa.png" alt="" title="" />
                </div>
                <h5><p> Lexa </p></h5>
            </div>
        </div>
        <div class="column dt-sc-one-fifth  animate" data-delay="500" data-animation="animated fadeIn">
            <div class="dt-sc-team type2">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/sheila.png" alt="" title="" />                    
                </div>
                <h5><p> Scheila Carvalho </p></h5>
            </div>
        </div>
        <div class="column dt-sc-one-fifth  animate" data-delay="700" data-animation="animated fadeIn">
            <div class="dt-sc-team type2">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cristiane-oliveira.png" alt="" title="" />
                </div>
                <h5><p> Cristiana Oliveira </p></h5>
            </div>
        </div>
        <div class="column dt-sc-one-fifth  animate" data-delay="700" data-animation="animated fadeIn">
            <div class="dt-sc-team type2">
                <div class="image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/babi-muniz.jpg" alt="" title="" />
                </div>
                <h5><p> Babi Muniz </p></h5>
            </div>
        </div>
        <div class="hr-invisible-small"></div> 
        <div class="hr-separator"></div>
        <div class="hr-invisible-small"></div>

        <div class="column dt-sc-one-sixth first">
            <?php $terms = get_terms('product_cat', array('hide_empty'=>1, 'parent'=>0));
            if(!empty($terms)){
                echo '<h3 class="border-title "> Menu </h3><div class="column dt-sc-one-fourth first">';
                echo '<ul class="dt-sc-fancy-list orange arrow">';
                foreach($terms as $term){
                    $children = get_term_children($term->term_id, 'product_cat');
                    if(!empty($children)){
                        echo '<li><a href="'.get_term_link($term, 'product_cat').'">'.$term->name.'</a><ul>';
                        foreach($children as $child){
                            $objChild = get_term_by( 'id', $child, 'product_cat');
                            if($objChild->count != 0){
                                echo '<li><a href="'.get_term_link($child, 'product_cat').'">'.$objChild->name.'</a></li>';
                            }
                        }
                        echo '</ul></li>';
                    } else{
                        echo '<li><a href="'.get_term_link($term, 'product_cat').'">'.$term->name.'</a></li>';
                    }
                }
                echo '</ul></div>';
            } ?>
        </div>

        <div class="column dt-sc-five-sixth">
            <h3 class="border-title ">Novidades Martha Hair</h3>
            <?php $highlights = get_posts(array('post_type'=>'product', 'posts_per_page'=>9));
            if(!empty($highlights)){
                for($i = 0; $i < count($highlights); $i++){
                    if($i % 3 == 0){
                        echo '<div class="column dt-sc-one-third first"><div class="dt-sc-team type2 animate" data-delay="100" data-animation="animated fadeIn">';
                    } else{
                        echo '<div class="column dt-sc-one-third"><div class="dt-sc-team type2 animate" data-delay="100" data-animation="animated fadeIn">';
                    }
                    echo '<div class="image">'.get_the_post_thumbnail($highlights[$i]->ID, $themePrefix.'featuredProduct', array('title'=>$highlights[$i]->post_title, 'alt'=> $highlights[$i]->post_excerpt)).'</div>';
                    echo '<div class="info-produtos"><h5><a href="'.get_permalink($highlights[$i]->ID).'">'.$highlights[$i]->post_title.'</a></h5>';
                    $product = new WC_Product( $highlights[$i]->ID );
                    echo '<span><a class="dt-sc-button small" href="'.get_permalink($highlights[$i]->ID).'" >Comprar</a><h4>'.$product->get_price_html().'</h4></span>';
                    echo '</div></div></div>';
                }
            } ?>
        </div>
        <div class="hr-invisible-very-small"></div>
        <div class="hr-invisible-very-small"></div>
        <div class="hr-separator"></div>
    </div>
<?php get_footer(); ?>