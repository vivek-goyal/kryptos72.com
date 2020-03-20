<?php
/*
@package: File Manager Advanced
@Class: class_fma_shortcode
*/
define('fma_file',__FILE__);
if(class_exists('class_fma_shortcode')) {
    return;
}
class class_fma_shortcode {
      // shortcode
	   var $opr = array( 'mkdir', 'mkfile', 'rename', 'duplicate', 'paste', 'ban', 'archive', 'extract', 'copy', 'cut', 'edit','rm','download', 'upload', 'search', 'info', 'help','empty','resize');
       public function __construct() {
       add_action( 'wp_ajax_fma_load_shortcode_fma_ui', array(&$this, 'fma_load_shortcode_fma_ui'));
       add_action( 'wp_ajax_nopriv_fma_load_shortcode_fma_ui', array(&$this, 'fma_load_shortcode_fma_ui'));
      }
      // conn
      public function fma_load_shortcode_fma_ui() {
		 if ( wp_verify_nonce( $_REQUEST['_fmakey'], 'fmaskey' ) ) {
            $current_user = wp_get_current_user();
			$el_opr = $this->opr;
			$operations = isset($_REQUEST['operations']) ? sanitize_text_field($_REQUEST['operations']) : '';
			$pathtype = isset($_REQUEST['path_type']) ? sanitize_text_field($_REQUEST['path_type']) : 'inside';
			$read = isset($_REQUEST['r']) ? sanitize_text_field($_REQUEST['r']) : 'true';
			$write = isset($_REQUEST['w']) ? sanitize_text_field($_REQUEST['w']) : 'false';
			if(!empty($operations)){
				if($operations == 'all') {
				 $el_opr = array();
				} else {
				  $operations =  explode(',',$operations);
				  $el_opr = array_diff($el_opr, $operations); // targeting access
				}
			}
			else {
			   $el_opr = array(); // mltha rowq
			}

			 $pa = isset($_REQUEST['path']) ? sanitize_text_field($_REQUEST['path']) : '';
			 $root = site_url();
			 if( !empty($pa) && $pa != '%' && $pa != '$') {
				 $path = ABSPATH.$pa;
				 $root = site_url().'/'.$pa;
			 } else if($pa == '$') {
                if ( isset( $current_user->user_login ) ) {
                          $user_dirname = 'wp-content/uploads/file-manager-advanced/users/'.$current_user->user_login;
                          $path = ABSPATH.$user_dirname;
                          $root = site_url().'/'.$user_dirname;
                }
            }
             else {
				 $path = ABSPATH;
				 $root = site_url();
			 }
			 if($pathtype == 'outside') {
				 $paths = $pa;
				 $root = !empty($_REQUEST['url']) ? $_REQUEST['url'] : site_url().'/'.$pa;
			 } else {
				 $paths = $path;
			 }

			$fr = array();
			$hides = !empty($_REQUEST['hide']) ? sanitize_text_field($_REQUEST['hide']) : '';
			$rf = explode(',', $hides);
					if(!empty($rf[0]) && is_array($rf)):
					  foreach($rf as $rrf):
						$fr[] = array( 'pattern' => '!^/'.$rrf.'!','hidden' => true );
					  endforeach;
					else:
						$fr[] = array('hidden' => false, 'read' => $read, 'write' => $write);
					endif;
					 $re = array();

					 $x = 0;
while($x <= count($rf)) {
    $re[] = $fr[$x];
    $x++;
}
// hide unexpected autogenerated folders
                    $re[] = array(
								  'pattern' => '/.tmb/',
								   'read' => false,
								   'write' => false,
								   'hidden' => true,
								   'locked' => false
								);
			        $re[] = array(
								  'pattern' => '/.quarantine/',
								   'read' => false,
								   'write' => false,
								   'hidden' => true,
								   'locked' => false
								);
				    $re[] = array(
									'pattern' => '/.htaccess/',
									 'read' => false,
									 'write' => false,
									 'hidden' => true,
									 'locked' => false
								  );			
require 'library/php/autoload.php';
				$opts = array(
				'roots' => array(
					// Items volume
					array(
						'driver'        => 'LocalFileSystem',           // driver for accessing file system (REQUIRED)
						'path'          => $paths,                 // path to files (REQUIRED)
						'URL'           => $root, // URL to files (REQUIRED)
						'winHashFix'    => DIRECTORY_SEPARATOR !== '/', // to make hash same to Linux one on windows too
						'uploadDeny'    => array(''),                // All Mimetypes not allowed to upload
						'uploadAllow'   => array('all'),// Mimetype `image` and `text/plain` allowed to upload
						'uploadOrder'   => array('deny', 'allow'),      // allowed Mimetype `image` and `text/plain` only
						'accessControl' => 'access',                     // disable and hide dot starting files (OPTIONAL)
						'acceptedName' => 'validName',
						'disabled'      => $el_opr,
						'attributes' => $re,


					),
				)
       );

// run elFinder
$fmaconnector = new elFinderConnector(new elFinder($opts));
$fmaconnector->run();
die;
		 }
}
}
new class_fma_shortcode;
?>