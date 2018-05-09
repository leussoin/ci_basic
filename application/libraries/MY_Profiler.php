<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Profiler extends CI_Profiler
{
    public function __construct()
    {
        parent::__construct();
    }

    function run()
    {
        return $this->_button()
            . $this->_container();
    }

    /**
	 * Show Igor profiler button
	 *
	 * @return	string
	 */
    protected function _button()
    {
        return '<a href="javascript:;" class="btn btn-warning" id="Igor-profiler-button" style="bottom:5px;left:5px;position: fixed;">'
            . $this->_compile_controller_info()
            . ' ( '
            . $this->_compile_memory_usage()
            . ' ) '
            .'</a>';
    }
    
    /**
	 * Show Igor profiler content
	 *
	 * @return	string
	 */
    protected function _container()
    {
        return '<div id="Igor-profiler-content" class="container" style="display:none;">'
            . $this->_compile_uri_string()
            . $this->_compile_benchmarks()
            . $this->_compile_get()
            . $this->_compile_post()
            . $this->_compile_queries()
            . '</div>';
    }

    // --------------------------------------------------------------------

	/**
	 * Show the controller and function that were called
	 *
	 * @return	string
	 */
	protected function _compile_controller_info()
	{
        return $this->CI->router->class.'/'.$this->CI->router->method;
    }

    // --------------------------------------------------------------------

	/**
	 * Compile memory usage
	 *
	 * Display total used memory
	 *
	 * @return	string
	 */
	protected function _compile_memory_usage()
	{ 
        return (($usage = memory_get_usage()) != '' ? number_format($usage).' bytes' : $this->CI->lang->line('profiler_no_memory'));
    }

    // --------------------------------------------------------------------

	/**
	 * Auto Profiler
	 *
	 * This function cycles through the entire array of mark points and
	 * matches any two points that are named identically (ending in "_start"
	 * and "_end" respectively).  It then compiles the execution times for
	 * all points and returns it as an array
	 *
	 * @return	array
	 */
	protected function _compile_benchmarks()
	{
		$profile = array();
		foreach ($this->CI->benchmark->marker as $key => $val)
		{
			// We match the "end" marker so that the list ends
			// up in the order that it was defined
			if (preg_match('/(.+?)_end$/i', $key, $match)
				&& isset($this->CI->benchmark->marker[$match[1].'_end'], $this->CI->benchmark->marker[$match[1].'_start']))
			{
				$profile[$match[1]] = $this->CI->benchmark->elapsed_time($match[1].'_start', $key);
			}
		}

		// Build a table containing the profile data.
		// Note: At some point we should turn this into a template that can
		// be modified. We also might want to make this data available to be logged

		$output = '<fieldset id="ci_profiler_benchmarks" style="border:1px solid #900;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee;">'
			.'<legend style="color:#900;">&nbsp;&nbsp;'.$this->CI->lang->line('profiler_benchmarks')."&nbsp;&nbsp;</legend>"
			."<table style=\"width:100%;\">";

		foreach ($profile as $key => $val)
		{
			$key = ucwords(str_replace(array('_', '-'), ' ', $key));
			$output .= '<tr><td style="padding:5px;width:50%;color:#000;font-weight:bold;background-color:#ddd;">'
					.$key.'&nbsp;&nbsp;</td><td style="padding:5px;width:50%;color:#900;font-weight:normal;background-color:#ddd;">'
					.$val."</td></tr>";
		}

		return $output."</table></fieldset>";
	}

    	// --------------------------------------------------------------------

	/**
	 * Compile $_GET Data
	 *
	 * @return	string
	 */
	protected function _compile_get()
	{
		$output = '<fieldset id="ci_profiler_get" style="border:1px solid #cd6e00;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee;">'
			.'<legend style="color:#cd6e00;">&nbsp;&nbsp;'.$this->CI->lang->line('profiler_get_data')."&nbsp;&nbsp;</legend>";

		if (count($_GET) === 0)
		{
			$output .= '<div style="color:#cd6e00;font-weight:normal;padding:4px 0 4px 0;">'.$this->CI->lang->line('profiler_no_get').'</div>';
		}
		else
		{
			$output .= "<table style=\"width:100%;border:none;\">";

			foreach ($_GET as $key => $val)
			{
				is_int($key) OR $key = "'".htmlspecialchars($key, ENT_QUOTES, config_item('charset'))."'";
				$val = (is_array($val) OR is_object($val))
					? '<pre>'.htmlspecialchars(print_r($val, TRUE), ENT_QUOTES, config_item('charset')).'</pre>'
					: htmlspecialchars($val, ENT_QUOTES, config_item('charset'));

				$output .= '<tr><td style="width:50%;color:#000;background-color:#ddd;padding:5px;">&#36;_GET['
					.$key.']&nbsp;&nbsp; </td><td style="width:50%;padding:5px;color:#cd6e00;font-weight:normal;background-color:#ddd;">'
					.$val."</td></tr>";
			}

			$output .= "</table>";
		}

		return $output.'</fieldset>';
	}

	// --------------------------------------------------------------------

	/**
	 * Compile $_POST Data
	 *
	 * @return	string
	 */
	protected function _compile_post()
	{
		$output = '<fieldset id="ci_profiler_post" style="border:1px solid #009900;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee;">'
			.'<legend style="color:#009900;">&nbsp;&nbsp;'.$this->CI->lang->line('profiler_post_data')."&nbsp;&nbsp;</legend>";

		if (count($_POST) === 0 && count($_FILES) === 0)
		{
			$output .= '<div style="color:#009900;font-weight:normal;padding:4px 0 4px 0;">'.$this->CI->lang->line('profiler_no_post').'</div>';
		}
		else
		{
			$output .= "<table style=\"width:100%;\">";

			foreach ($_POST as $key => $val)
			{
				is_int($key) OR $key = "'".htmlspecialchars($key, ENT_QUOTES, config_item('charset'))."'";
				$val = (is_array($val) OR is_object($val))
					? '<pre>'.htmlspecialchars(print_r($val, TRUE), ENT_QUOTES, config_item('charset')).'</pre>'
					: htmlspecialchars($val, ENT_QUOTES, config_item('charset'));

				$output .= '<tr><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">&#36;_POST['
					.$key.']&nbsp;&nbsp; </td><td style="width:50%;padding:5px;color:#009900;font-weight:normal;background-color:#ddd;">'
					.$val."</td></tr>";
			}

			foreach ($_FILES as $key => $val)
			{
				is_int($key) OR $key = "'".htmlspecialchars($key, ENT_QUOTES, config_item('charset'))."'";
				$val = (is_array($val) OR is_object($val))
					? '<pre>'.htmlspecialchars(print_r($val, TRUE), ENT_QUOTES, config_item('charset')).'</pre>'
					: htmlspecialchars($val, ENT_QUOTES, config_item('charset'));

				$output .= '<tr><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">&#36;_FILES['
					.$key.']&nbsp;&nbsp; </td><td style="width:50%;padding:5px;color:#009900;font-weight:normal;background-color:#ddd;">'
					.$val."</td></tr>";
			}

			$output .= "</table>";
		}

		return $output.'</fieldset>';
	}

    // --------------------------------------------------------------------

	/**
	 * Compile Queries
	 *
	 * @return	string
	 */
    protected function _compile_queries()
    {
        $dbs = array();

        // Let's determine which databases are currently connected to
        foreach (get_object_vars($this->CI) as $CI_object)
        {
            if (is_object($CI_object) && is_subclass_of(get_class($CI_object), 'CI_DB') )
            {
                $dbs[] = $CI_object;
            }
        }

        if (count($dbs) == 0)
        {
            return '<fieldset id="ci_profiler_queries" style="border:1px solid #0000FF;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">'
                . '<legend style="color:#0000FF;">&nbsp;&nbsp;'.$this->CI->lang->line('profiler_queries').'&nbsp;&nbsp;</legend>'
                . "<table style='border:none; width:100%;'>"
                . "<tr><td style='width:100%;color:#0000FF;font-weight:normal;background-color:#eee;padding:5px'>".$this->CI->lang->line('profiler_no_db')."</td></tr>"
                . "</table>"
                . "</fieldset>";
        }

        // Load the text helper so we can highlight the SQL
        $this->CI->load->helper('text');

        // Key words we want bolded
        $highlight = array('SELECT', 'DISTINCT', 'FROM', 'WHERE', 'AND', 'LEFT&nbsp;JOIN', 'ORDER&nbsp;BY', 'GROUP&nbsp;BY', 'LIMIT', 'INSERT', 'INTO', 'VALUES', 'UPDATE', 'OR&nbsp;', 'HAVING', 'OFFSET', 'NOT&nbsp;IN', 'IN', 'LIKE', 'NOT&nbsp;LIKE', 'COUNT', 'MAX', 'MIN', 'ON', 'AS', 'AVG', 'SUM', '(', ')');

        $output  = "";

        $count = 0;

        foreach ($dbs as $db)
        {
            $count++;

            $hide_queries = (count($db->queries) > $this->_query_toggle_count) ? ' display:none' : '';

            $show_hide_js = '(<span style="cursor: pointer;" onclick="var s=document.getElementById(\'ci_profiler_queries_db_'.$count.'\').style;s.display=s.display==\'none\'?\'\':\'none\';this.innerHTML=this.innerHTML==\''.$this->CI->lang->line('profiler_section_hide').'\'?\''.$this->CI->lang->line('profiler_section_show').'\':\''.$this->CI->lang->line('profiler_section_hide').'\';">'.$this->CI->lang->line('profiler_section_hide').'</span>)';

            if ($hide_queries != '')
            {
                $show_hide_js = '(<span style="cursor: pointer;" onclick="var s=document.getElementById(\'ci_profiler_queries_db_'.$count.'\').style;s.display=s.display==\'none\'?\'\':\'none\';this.innerHTML=this.innerHTML==\''.$this->CI->lang->line('profiler_section_show').'\'?\''.$this->CI->lang->line('profiler_section_hide').'\':\''.$this->CI->lang->line('profiler_section_show').'\';">'.$this->CI->lang->line('profiler_section_show').'</span>)';
            }

            $output .= '<fieldset style="border:1px solid #0000FF;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">'
                . '<legend style="color:#0000FF;">&nbsp;&nbsp;'.$this->CI->lang->line('profiler_database').':&nbsp; '.$db->database.'&nbsp;&nbsp;&nbsp;'.$this->CI->lang->line('profiler_queries').': '.count($db->queries).'&nbsp;&nbsp;'.$show_hide_js.'</legend>'
                . "<table style='width:100%;{$hide_queries}' id='ci_profiler_queries_db_{$count}'>";

            if (count($db->queries) == 0)
            {
                $output .= "<tr><td style='width:100%;color:#0000FF;font-weight:normal;background-color:#eee;padding:5px;'>".$this->CI->lang->line('profiler_no_queries')."</td></tr>";
            }
            else
            {
                foreach ($db->queries as $key => $val)
                {
                    $time = number_format($db->query_times[$key], 4);

                    $query = $val;

                    $val = highlight_code($val, ENT_QUOTES);

                    foreach ($highlight as $bold)
                    {
                        $val = str_replace($bold, '<strong>'.$bold.'</strong>', $val);
                    }

                    $output .= "<tr><td style='padding:5px; vertical-align: top;width:1%;color:#900;font-weight:normal;background-color:#ddd;'>".$time."&nbsp;&nbsp;</td><tr>"
                        . "<tr><td style='padding:5px; color:#000;font-weight:normal;background-color:#ddd;vertical-align:top;'>".$val."</td></tr>"
                        . "<tr><td style='padding:5px; color:#000;font-weight:normal;background-color:#ddd;'>".print_r($db->query($query)->result_array(), true)."</td></tr>";
                }
            }

            $output .= "</table></fieldset>";

        }

        return $output;
    }

    // --------------------------------------------------------------------

	/**
	 * Compile header information
	 *
	 * Lists HTTP headers
	 *
	 * @return	string
	 */
	protected function _compile_http_headers()
	{
		$output = '<fieldset id="ci_profiler_http_headers" style="border:1px solid #000;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee;">'
			.'<legend style="color:#000;">&nbsp;&nbsp;'.$this->CI->lang->line('profiler_headers')
			.'&nbsp;&nbsp;(<span style="cursor: pointer;" onclick="var s=document.getElementById(\'ci_profiler_httpheaders_table\').style;s.display=s.display==\'none\'?\'\':\'none\';this.innerHTML=this.innerHTML==\''.$this->CI->lang->line('profiler_section_show').'\'?\''.$this->CI->lang->line('profiler_section_hide').'\':\''.$this->CI->lang->line('profiler_section_show').'\';">'.$this->CI->lang->line('profiler_section_show')."</span>)</legend>"
			.'<table style="width:100%;display:none;" id="ci_profiler_httpheaders_table">';

		foreach (array('HTTP_ACCEPT', 'HTTP_USER_AGENT', 'HTTP_CONNECTION', 'SERVER_PORT', 'SERVER_NAME', 'REMOTE_ADDR', 'SERVER_SOFTWARE', 'HTTP_ACCEPT_LANGUAGE', 'SCRIPT_NAME', 'REQUEST_METHOD',' HTTP_HOST', 'REMOTE_HOST', 'CONTENT_TYPE', 'SERVER_PROTOCOL', 'QUERY_STRING', 'HTTP_ACCEPT_ENCODING', 'HTTP_X_FORWARDED_FOR', 'HTTP_DNT') as $header)
		{
			$val = isset($_SERVER[$header]) ? htmlspecialchars($_SERVER[$header], ENT_QUOTES, config_item('charset')) : '';
			$output .= '<tr><td style="vertical-align:top;width:50%;padding:5px;color:#900;background-color:#ddd;">'
				.$header.'&nbsp;&nbsp;</td><td style="width:50%;padding:5px;color:#000;background-color:#ddd;">'.$val."</td></tr>";
		}

		return $output."</table></fieldset>";
	}

	// --------------------------------------------------------------------

	/**
	 * Compile config information
	 *
	 * Lists developer config variables
	 *
	 * @return	string
	 */
	protected function _compile_config()
	{
		$output = '<fieldset id="ci_profiler_config" style="border:1px solid #000;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee;">'
			.'<legend style="color:#000;">&nbsp;&nbsp;'.$this->CI->lang->line('profiler_config').'&nbsp;&nbsp;(<span style="cursor: pointer;" onclick="var s=document.getElementById(\'ci_profiler_config_table\').style;s.display=s.display==\'none\'?\'\':\'none\';this.innerHTML=this.innerHTML==\''.$this->CI->lang->line('profiler_section_show').'\'?\''.$this->CI->lang->line('profiler_section_hide').'\':\''.$this->CI->lang->line('profiler_section_show').'\';">'.$this->CI->lang->line('profiler_section_show')."</span>)</legend>"
			.'<table style="width:100%;display:none;" id="ci_profiler_config_table">';

		foreach ($this->CI->config->config as $config => $val)
		{
			$pre       = '';
			$pre_close = '';
                        
			if (is_array($val) OR is_object($val))
			{
				$val = print_r($val, TRUE);
                                
				$pre       = '<pre>' ;
 				$pre_close = '</pre>';
			}

			$output .= '<tr><td style="padding:5px;vertical-align:top;color:#900;background-color:#ddd;">'
				.$config.'&nbsp;&nbsp;</td><td style="padding:5px;color:#000;background-color:#ddd;">'.$pre.htmlspecialchars($val, ENT_QUOTES, config_item('charset')).$pre_close."</td></tr>";
		}

		return $output."</table></fieldset>";
	}

	// --------------------------------------------------------------------

	/**
	 * Compile session userdata
	 *
	 * @return 	string
	 */
	protected function _compile_session_data()
	{
		if ( ! isset($this->CI->session))
		{
			return;
		}

		$output = '<fieldset id="ci_profiler_csession" style="border:1px solid #000;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee;">'
			.'<legend style="color:#000;">&nbsp;&nbsp;'.$this->CI->lang->line('profiler_session_data').'&nbsp;&nbsp;(<span style="cursor: pointer;" onclick="var s=document.getElementById(\'ci_profiler_session_data\').style;s.display=s.display==\'none\'?\'\':\'none\';this.innerHTML=this.innerHTML==\''.$this->CI->lang->line('profiler_section_show').'\'?\''.$this->CI->lang->line('profiler_section_hide').'\':\''.$this->CI->lang->line('profiler_section_show').'\';">'.$this->CI->lang->line('profiler_section_show').'</span>)</legend>'
			.'<table style="width:100%;display:none;" id="ci_profiler_session_data">';

		foreach ($this->CI->session->userdata() as $key => $val)
		{
			$pre       = '';
			$pre_close = '';
                        
			if (is_array($val) OR is_object($val))
			{
				$val = print_r($val, TRUE);
                                
				$pre       = '<pre>' ;
 				$pre_close = '</pre>';
			}

			$output .= '<tr><td style="padding:5px;vertical-align:top;color:#900;background-color:#ddd;">'
				.$key.'&nbsp;&nbsp;</td><td style="padding:5px;color:#000;background-color:#ddd;">'.$pre.htmlspecialchars($val, ENT_QUOTES, config_item('charset')).$pre_close."</td></tr>";
		}

		return $output."</table></fieldset>";
	}
}