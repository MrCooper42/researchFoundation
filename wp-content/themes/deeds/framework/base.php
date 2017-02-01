<?php

/*get_template_part('includes/library/form_helper');
get_template_part('includes/enqueue');
get_template_part('includes/helpers/post_types');
get_template_part('includes/helpers/meta_boxes');
get_template_part('includes/helpers/functions');
get_template_part('includes/helpers/widgets');
*/

class SH_Base
{
	protected $_cache_group = '';
	protected $_cache = '';
	
	function __construct()
	{
		$this->_cache_group = '_sh_cache_group';
		
		$this->_cache = get_transient($this->_cache_group);
	}
	
	/**
	 * enqueue styles/js for theme page
	 *
	 * @since NHP_Options 1.0
	*/
	function _fields_enqueue($settings = array(), $data){
		
			$element = array();
			if($settings){
				
				foreach( $settings as $fieldk => $field){
					//print_r($field);exit;
					$element[] = $this->_generate_html($fieldk, $field, $data);
					
				}//foreach
			
			}//if fields
			
	
			return $element;
		
	}//function
	
	function _generate_html($name, $field, $settings)
	{
		
		$return = array();
		
		$value = (sh_set( $settings, $name ) ) ? sh_set($settings, $name ) : sh_set( $field, 'std');
		$attributes = $this->__set_attrib(sh_set($field, 'attributes'));
		
		switch( sh_set( $field, 'type' ) )
		{
			case 'select':
				$return['field'] = form_dropdown( $name, sh_set($field, 'options'), $value, $attributes );
			break;
			case 'date':
				$return['field'] = form_input( $name, $value, $attributes );
				$return['field'] .= '<script type="text/javascript">jQuery(document).ready(function($){$(\'input[name="'.$name.'"]\').datepicker();});</script>';   
			break;
		}
		
		$return['title'] = sh_set($field, 'title');
		
		return $return;
	}
	
	
	function __set_attrib( $attr = array() )
	{
		$res = ' ';
		foreach( $attr as $k => $v )
		{
			$res .= $k.'="'.$v.'" ';
		}
		
		return $res;
	}
	
	function alloption( $key = '' )
	{
		$cache = wp_cache_get( 'alloptions', 'options');

		if( !$key ) return $cache;

		$value = sh_set( $cache, $key ) ;
		if( $value != '' ) return maybe_unserialize( $value );
		else return get_option( $key );
	}
	
	function get_cache( $key, $type = 'postmeta', $args = array() )
	{
		global $post;

		//$group = $this->_cache;//&$GLOBALS['__sh_cache'];//printr($group);
		$cache = sh_set( $this->_cache, $type );
		$newkey = ( $type == 'postmeta' ) ? $key.'_'.sh_set( $post, 'ID') : $key;
		//if( $value = sh_set( $cache, $newkey ) ) return $value;
		//else {
		
		///printr($args);
		switch( $type )
		{
			case 'postmeta':
			
				if( $value = sh_set( $cache, $newkey ) ) return $value;
				else{
					$meta = get_post_meta( sh_set( $post, 'ID' ), $key, true);
					if( $meta ){
						$this->_cache[$type][$newkey] = $meta;
						set_transient( $this->_cache_group, $this->_cache, 60*60);
						return $meta;
					}
				}
			break;
			case 'wpquery':
				
				$base64 = $this->base64( $args );
				if( $value = sh_set( $cache, $newkey ) ) {
					
					if( $v = sh_set( $value, $base64 ) ) return $v;
					else {
						$query = new WP_Query( $args );

						if( $query->have_posts()) {
							$this->_cache[$type][$newkey][$base64] = $query;
							set_transient( $this->_cache_group, $this->_cache, 60*60);
							return $query;
						}
					}
				}else{
					$query = new WP_Query( $args );
					//printr($query);
					if( $query ) {
						$this->_cache[$type][$newkey][$base64] = $query;
						set_transient( $this->_cache_group, $this->_cache, 60*60);
						return $query;
					}
				}
				
			break;
		}
		//$group[$type] = $cache;
		//printr($group);
		//set_transient( $this->_cache_group, $group, 60*60);
		//$GLOBALS['__sh_cache'] = get_transient($this->_cache_group);
		//$this->_cache = get_transient($this->_cache_group);
		//}
		
		//if( $value = sh_set( sh_set( $this->_cache, $type ), $newkey ) ) return $value;
		//else return false;
		return false;
	}
	
	function base64( $str, $type = 'encode' )
	{
		$str = (is_array( $str ) || is_object( $str ) ) ? serialize( $str ) : $str;
		if( $type == 'encode' ) return base64_encode( $str );
		elseif( $type == 'decode') return base64_decode( $str );
	}
	
	function page_template( $tpl )
	{
		$page = get_pages(array('meta_key' => '_wp_page_template','meta_value' => $tpl));
		if($page) return current( (array)$page);
		else return false;
	}
	
	function set_term_key( $post_type )
	{
	  if( ! $post_type ) return;
	  
	  return '_sh_'.$post_type.'_settings';
	  
	}

}

$GLOBALS['_sh_base'] = new SH_Base;







