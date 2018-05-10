<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
	protected $_data = array();

	public function __construct()
	{
		$this->data = array();
		$this->js = array();
		$this->css = array();
		$this->extra = array();
		$this->debug = FALSE;
	}

	/**
	 * ecrit le chemin vers les fichiers js
	 * prend en compte la configuration minify
	 * @param debug Bool, determine si on est en mode profiler
	 * @return data_path Array, les js avec leur chemin d'acces
	 */
	function set_js( $debug = FALSE )
	{
		$data = $this->js;

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

		// Extra envoyé par le controlleur
		if(isset($this->extra,$this->extra['js']) && !empty($this->extra['js']) ) {
			if(! is_array($this->extra) ) {
				$this->extra = array($this->extra);
			}
			
			$extra = array_merge(
				$extra,
				array_map(function($x) {
					return $this->CI->config->item('extra_path') . 'js/' . $x;
				}, $this->extra)
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
		}, $arr);
	}

	/**
	 * ecrit le chemin vers les fichiers css
	 * @return data_path Array, les css avec leur chemin d'acces
	 */
	function set_css()
	{
		$data = $this->css;
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

		// EXTRA CSS envoyés par le controlleur
		if(isset($this->extra['css']) && ! empty($this->extra['js']) ) {
			if(! is_array($this->extra) ) {
				$this->extra = array($this->extra);
			}
			$extra = array_merge(
				$extra, 
				array_map(function($file) {
					return $this->CI->config->item('extra_path') . 'css/' . $file;
				}, $this->extra)
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

		$data_path = array_map(function($x) use($assetsPath)
		{
			$file = $assetsPath . $x . '.css';
			return $file;
		}, $data);

		$arr = array_merge($extra, $data_path);

		return array_map(function($x) {
			return base_url($x);
		},$arr);
	}

	function set($name, $value)
	{
		$this->_data[$name] = $value;
	}

	/**
	 * @param data tableau ou variable
	 * @return void
	 */
	function init($data)
	{
		if($data != NULL) {
			// si c'est un tableau  on parcoure les differents champs pour renconstruire les objets
			if(is_array($data) ) {
				foreach($data as $key => $value) {
					// si la variable existe dans le constructeur
					if( isset($this->{$key}) ) {
						if(! is_array($this->{$key}) ) {
							$this->{$key} = $value;
						} else {
							array_push($this->{$key}, $value);
						}
					} else {
						$this->data{$key} = $value;
					}
				}
			} else {
				$this->data = $data;
			}
		}
	}

	function load($view = '', $data = NULL, $return = FALSE)
	{
		$this->init($data);

		$this->CI =& get_instance();
		$this->CI->load->helpers('url');
		$this->CI->benchmark->mark('template_start');

		// --- VARIABLE
		$template = 'layouts/template';
		$header = 'layouts/header';
		$footer = 'layouts/footer';
		$debug = ( $this->debug || ENVIRONMENT === 'testing' ) ? TRUE : FALSE;
		
		// PROFILER
		$this->set('_DEBUG', $debug);

		// ASSETS
		$this->set('_JS', $this->set_js($debug));

		$this->set('_CSS', $this->set_css() );

		// --- VIEW
		// HEADER
		$this->set('_HEADER', $this->CI->load->view($header, $this->data, TRUE));

		// CONTENT 
		$this->set('_MAIN', $this->CI->load->view($view, array('data' => $this->data), TRUE));

		// FOOTER
		$this->set('_FOOTER', $this->CI->load->view($footer, $this->data, TRUE));

		$this->CI->benchmark->mark('template_end');
		
		return $this->CI->load->view($template, $this->_data, $return);
	}
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */