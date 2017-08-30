<?php
/*
Plugin Name: Training Software Seni
Description: Simple non-bloated WordPress Contact Form
Version: 1.0
Author: Cyndy Alisia Lumban Gaol
Author URI: https://www.facebook.com/cindy.alisia
*/
  $IDbase = 0;
  $blog_id = get_current_blog_id();

    function html_form_code() {
    	echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
    	echo '<p>';
    	echo 'Your Name (required) <br/>';
    	echo '<input type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) . '" size="30" />';
    	echo '</p>';
    	echo '<p>';
    	echo 'Your Email (required) <br/>';
    	echo '<input type="email" name="cf-email" value="' . ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) . '" size="30" />';
    	echo '</p>';
    	echo '<p>';
    	echo 'Phone_number (required) <br/>';
    	echo '<input type="text" name="cf-phone" value="' . ( isset( $_POST["cf-phone"] ) ? esc_attr( $_POST["cf-phone"] ) : '' ) . '" size="12" />';
    	echo '</p>';
    	echo '<p>';
    	echo 'Your Testimonial (required) <br/>';
    	echo '<textarea rows="10" cols="35" name="cf-testimonial">' . ( isset( $_POST["cf-testimonial"] ) ? esc_attr( $_POST["cf-testimonial"] ) : '' ) . '</textarea>';
    	echo '</p>';
    	echo '<p><input type="submit" name="cf-submitted" value="Send"></p>';
    	echo '</form>';
    }

function deliver_mail() {

    if ( isset( $_POST['cf-submitted'] ) ) {
        $IDbase =rand(1, 1000);
        $name    = sanitize_text_field( $_POST["cf-name"] );
        $email   = sanitize_email( $_POST["cf-email"] );
        $phone = sanitize_text_field( $_POST["cf-phone"] );
        $testimonial = esc_textarea( $_POST["cf-testimonial"] );
      //  $blog_id = get_site_url();

        $GLOBALS['wpdb']->insert(
        	'wordpress',
        	array(
            'ID' => $IDbase,
        		'name' => $name,
        		'email' => $email,
            'phone_number' => $phone,
            'testimonial' => $testimonial
  	       )
         );
    }
}

function cf_shortcode() {
    ob_start();
    deliver_mail();
    html_form_code();

    return ob_get_clean();
}

add_shortcode( 'sitepoint_contact_form', 'cf_shortcode' );

function my_admin_menu() {
	add_menu_page( 'My Top Level Menu Example', 'Admin Page', 'manage_options', 'myplugin/myplugin-admin-page.php', 'myplguin_admin_page', 'dashicons-tickets', 6  );
}

add_action( 'admin_menu', 'my_admin_menu' );

function myplguin_admin_page(){
  $blog_id = get_site_url();
?>
	<div class="wrap">
    <h2>Admin Page</h2>
      <?php echo $blog_id;?>
      <table class="table" border="1">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone number</th>
          <th>Testimonial</th>
        </tr>

        <?php
          global $wpdb;
          $result = $wpdb -> get_results("SELECT * FROM wordpress WHERE blog_id = '$blog_id'");
          if(isset($_GET['del'])){
            $del = $_GET['id'];
            $wpdb->query($wpdb->prepare("DELETE FROM wordpress WHERE ID = %d AND blog_id = %s",$del, $blog_id));
          }
          foreach ($result as $print) {
        ?>
        <tr>
          <td><?php echo $print->ID; ?></td>
          <td><?php echo $print->name; ?></td>
          <td><?php echo $print->email; ?></td>
          <td><?php echo $print->phone_number; ?></td>
          <td><?php echo $print->testimonial; ?></td>
          <td>
            <a href="<?php echo admin_url('admin.php?page=myplugin%2Fmyplugin-admin-page.php&del=1&id=' . $print->ID); ?>">Delete</a>
          </td>
        </tr>
        <?php } ?>

      </table>
<?php }

class Testimonial_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */

	function __construct() {
		parent::__construct(
			'foo_widget', // Base ID
			esc_html__( 'Testimonial', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'for looking Testimonial from users', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
    //$blog_id = get_site_url();
    global $wpdb;
    $mylink =$wpdb->get_row("SELECT testimonial FROM wordpress WHERE blog_id = '$blog_id' ORDER BY RAND() LIMIT 1");

		echo esc_html__( $mylink->testimonial, 'text_domain');
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		?>
		<p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label>
		    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Foo_Widget

function register_foo_widget() {
    register_widget( 'Testimonial_Widget' );
}

add_action( 'widgets_init', 'register_foo_widget' );
