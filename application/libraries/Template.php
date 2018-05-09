<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
	var $data = array();
	var $instance ;

	/**
	 * ecrit le chemin vers les fichiers js
	 * prend en compte la configuration minify
	 * @param data Array, les js defini dans le controlleur
	 * @param extraData Array, les extra defini dans le controlleur
	 * @param debug Bool, determine si on est en mode profiler
	 * @return data_path Array, les js avec leur chemin d'acces
	 */
	function set_js( $data = array(), $extraData = array(), $debug = FALSE )
	{
		// EXTRA
		$extra = array();
		if( $this->CI->config->item('extra_js') ) {
			if( $this->CI->config->item('extra_bundle') ) {
				$extra[] = $this->CI->config->item('assets_path') . 'js/extra.bundle.js';
			
			} else {
				$js = $this->CI->config->item('extra_js');

				if(! is_array($js)) {
					$js = array($js);
				}
				
				$extra = array_map(function($x) {
					return $this->CI->config->item('extra_path') . 'js/' . $x;
				}, $js);
			}
		}

		// ExtraData
		if(! empty($extraData) ) {
			if(! is_array($extraData) ) {
				$extraData = array($extraData);
			}
			
			$extra = array_merge(
				$extra,
				array_map(function($x) {
					return $this->CI->config->item('extra_path') . 'js/' . $x;
				}, $extraData)
			);
		}
		// JS
		// determine le chemin en fonction du minify ou de la production
		if( ENVIRONMENT === 'production' || $this->CI->config->item('minify') ) {
			$path = $this->CI->config->item('assets_path');
			$extension = '.min.js';

		} else {
			$path = $this->CI->config->item('src_path');
			$extension = '.js';
		}

		// GLOBAL
		// On insere le fichier global juste apres les extra
		if( $this->CI->config->item('global') ) {
			$extra[] = $path . 'js/' . $this->CI->config->item('global') . $extension;
		}

		if(! is_array($data)) {
			$data = array($data);
		}

		$data_path = array_map(function($x) use ($path, $extension) {
			return $path . 'js/' . $x . $extension;
		}, $data);

		$arr = array_merge($extra, $data_path);
		
		if($debug) {
			$arr[] = 'Igor/profiler.js';
		}

		return array_map(function($x) {
			return base_url($x);
		},$arr);
	}

	/**
	 * ecrit le chemin vers les fichiers css
	 * @param data Array, les css defini dans le controlleur
	 * @param extraData Array, les extra defini dans le controlleur
	 * @param debug bool, determine si on est en mode profiler
	 * @return data_path Array, les css avec leur chemin d'acces
	 */
	function set_css( $data = array(), $extraData = array(), $debug = FALSE )
	{
		$assetsPath = $this->CI->config->item('assets_path') . 'css/';

		// EXTRA
		$extra = array();
		if( $this->CI->config->item('extra_css') ) {
			if( $this->CI->config->item('extra_bundle') ) {
				$extra[] = $assetsPath . 'extra.bundle.css';
			
			} else {
				$css = $this->CI->config->item('extra_css');

				if(! is_array($css)) {
					$css = array($css);
				}

				$extra = array_map(function($file) {
					return $this->CI->config->item('extra_path') . 'css/' . $file;
				}, $css);
			}
		}

		// ExtraData
		if(! empty($extraData) ) {
			if(! is_array($extraData) ) {
				$extraData = array($extraData);
			}
			$extra = array_merge(
				$extra, 
				array_map(function($file) {
					return $this->CI->config->item('extra_path') . 'css/' . $file;
				}, $extraData)
			);
		}

		// GLOBAL
		// On insere le fichier global juste apres les extra
		if( $this->CI->config->item('global') ) {
			$extra[] = $assetsPath . $this->CI->config->item('global') . '.css';
		}

		// CSS
		if(! is_array($data)) {
			$data = array($data);
		}

		$data_path = array_map(function($x) {
			$file = $assetsPath . $x . '.css';
			return $file;
		}, $data);

		$arr = array_merge($extra, $data_path);

		if($debug) {
			$arr[] = 'Igor/profiler.css';
		}

		return array_map(function($x) {
			return base_url($x);
		},$arr);
	}

	function set($name, $value)
	{
		$this->data[$name] = $value;
	}
	
	function load($view = '' , $data = array(), $return = FALSE)
	{
		$this->CI =& get_instance();
		$this->CI->load->helpers('url');
		$this->CI->benchmark->mark('template_start');

		// --- VARIABLE
		$template = 'layouts/template';
		$header = 'layouts/header';
		$footer = 'layouts/footer';
		$debug = ( (isset($data['debug']) && $data['debug'] == TRUE) OR ENVIRONMENT === 'testing' ) ? TRUE : FALSE;
		
		// PROFILER
		$this->set('_DEBUG', $debug);

		// ASSETS
		$this->set('_JS', $this->set_js(
				isset($data['js']) ? $data['js'] : array(),
				isset($data['extra'], $data['extra']['js']) ? $data['extra']['js'] : array(),
				$debug
			)
		);

		$this->set('_CSS', $this->set_css(
				isset($data['css']) ? $data['css'] : array(),
				isset($data['extra'], $data['extra']['css']) ? $data['extra']['css'] : array(),
				$debug
			)
		);

		// --- VIEW
		// HEADER
		$this->set('_HEADER', $this->CI->load->view($header, $data, TRUE));

		// CONTENT 
		$this->set('_MAIN', $this->CI->load->view($view, $data, TRUE));

		// FOOTER
		$this->set('_FOOTER', $this->CI->load->view($footer, $data, TRUE));

		$this->CI->benchmark->mark('template_end');
		
		return $this->CI->load->view($template, $this->data, $return);
	}
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */