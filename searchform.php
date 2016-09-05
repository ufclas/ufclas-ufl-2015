<form action="https://search.ufl.edu/search" method="get" class="search-wrap" role="search">
<label for="query" class="visuallyhidden"><?php esc_html_e('Search', 'ufclas-ufl-2015'); ?></label>
<input type="text" name="query" placeholder="<?php esc_attr_e('Search', 'ufclas-ufl-2015'); ?>" />
<button type="submit" class="btn-search">
    <span class="icon-svg">
    <svg>
        <use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#search"></use>
    </svg>
  </span>
</button>
<input type="hidden" name="source" id="source" value="web">
<input type="hidden" name="site" id="site" value="<?php $parsed_url = parse_url( home_url() ); echo $parsed_url['host']; if ( isset($parsed_url['path']) ) { echo $parsed_url['path']; } ?>">      
</form>