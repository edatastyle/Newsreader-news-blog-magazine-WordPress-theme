<?php
if( ! function_exists( 'newsreader_comment' ) ):
function newsreader_comment($comment, $args, $depth) {
    ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" class="media">
     <div class="media-left">    
          <div class="comment-author vcard image">
             <?php echo esc_url( get_avatar($comment,$size='48',$default='http://0.gravatar.com/avatar/36c2a25e62935705c5565ec465c59a70?s=32&d=mm&r=g' ) ); ?>
          </div>
     </div>
     <div class="media-body comment-wrp">
			  <?php if ($comment->comment_approved == '0') : ?>
                 <em><?php esc_html_e('Your comment is awaiting moderation.','newsreader') ?></em>
                 <br />
              <?php endif; ?>
            <h4 class="author"><?php echo esc_url( get_comment_author_link() ); ?></h4>
            <span class="date"><a href="<?php echo esc_html( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(/* translators: 1: date and time(s). */ esc_html__('%1$s at %2$s' , 'newsreader'), get_comment_date(),  get_comment_time()) ?></a></span>
            <p class="text">
                 <?php comment_text() ?>
            </p>
        

          <div class="reply">
             <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>  
			 <?php edit_comment_link(__('(Edit)','newsreader'),'  ','') ?>
          </div>
          
      </div>
      
      
     </div>
   
<?php
        }
endif;
if( ! function_exists( 'newsreader_comment_form_fields' ) ):
    add_filter( 'comment_form_default_fields', 'newsreader_comment_form_fields' );
    function newsreader_comment_form_fields( $fields ) {
        $commenter = wp_get_current_commenter();
        
        $req      = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
        
        $fields   =  array(
            'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name' , 'newsreader' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                        '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
            'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email'  , 'newsreader' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                        '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
            'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website'  , 'newsreader' ) . '</label> ' .
                        '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>'        
        );
        
        return $fields;
    }
endif;
if( ! function_exists( 'newsreader_comment_form' )):	
	add_filter( 'comment_form_defaults', 'newsreader_comment_form' );
    function newsreader_comment_form( $args ) {
        $args['comment_field'] = '<div class="form-group comment-form-comment">
                <label for="comment">' . __( 'Comment', 'newsreader' ) . '</label> 
                <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
            </div>';
        $args['class_submit'] = 'btn btn-theme'; // since WP 4.1
        
        return $args;
    }
endif;
?>