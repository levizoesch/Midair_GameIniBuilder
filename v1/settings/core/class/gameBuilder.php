<?php
class gameBuilder {
		
	// Page Title
	private $Title;
	
	// Default Arrays
	private $Toggle;
	
	// Super Admin Password
	private $inputError_AdminPassword;
	private $msg_AdminPassword;
	public $inputDefault_AdminPassword;
	private $inputValue_AdminPassword;
	protected $inputName_AdminPassword;
	
	// Demo Recording
	private $inputError_Demos;
	private $msg_Demos;
	private $inputDefault_Demos;
	private $inputValue_Demos;
	private $inputName_Demos;
	
	// Input fields
	function __construct() {
		
		$this->gameIni = new gameIni();
				
		/**
		* Default Settings Comments
		* Manually change these values as applicable.
		*/
		// Super Admin Password
		$this->msg_AdminPassword = 'Define the super admin password. Access in game <pre>adminLogin pswdhere</pre>';
		$this->inputDefault_AdminPassword = $this->random_AdminPassword();
		$this->inputValue_AdminPassword = NULL;
		$this->inputName_AdminPassword = 'sap';
		
		// Record Match Demo
		$this->msg_Demos = 'This enable/disable match recordings';
		$this->inputDefault_Demos = true;
		$this->inputValue_Demos = NULL;
		$this->inputName_Demos = 'rd';
		
		
		/******************************
		* Do not Edit Below This Line
		*******************************/
		// Required Classes
		$this->FormFields = new FormFields();
		
		// Logo Name/Directory Structure.
		$this->Midair_Logo = 'logo.png';
		$this->Midair_LogoLocation = BASE_URL . IMG_DIR;
		
		// Default Arrays
		$this->Toggle = array(1 => 'Enabled', 0 => 'Disabled');
		
		// Page Title
		$this->Title = 'Midair: Game.ini Builder';
		
		// Input Field Errors
		$this->error_AdminPassword = NULL;
		$this->error_Demos = NULL;
		
		
	}
	
	private function random_AdminPassword() {  
		$l = 8;
		$s = '';
		$v = array("a","e","i","o","u");  
		$c = array(
			'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 
			'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
		);  
		srand((double) microtime() * 1000000);
		$m = $l/2;
		for ($i = 1; $i <= $m; $i++) {
			$s .= $c[rand(0,19)];
			$s .= $v[rand(0,4)];
		}
		return $s;
	}
	
	private function form_Builder() {
	
		$x = array(
			'results' => array(
				/* Admin Password*/
				'admin' => array(
					'type' => 'Input',
					'input' => array(
						'label' => 'Super Admin Password',
						'error' => $this->inputError_AdminPassword,
						'name' => $this->inputName_AdminPassword,
						'value' => $this->random_AdminPassword(),
						'required' => true
					),
					'note' => $this->msg_AdminPassword
				),
				/* Record Demos */
				'demos' => array(
					'type' => 'Select',
					'input' => array(
						'label' => 'Record Demo',
						'error' => $this->inputError_Demos,
						'name' => $this->inputName_Demos,
						'value' => $this->inputDefault_Demos,
						'array' => $this->Toggle,
						'keyvalue' => true,
						'default' => false,
						'required' => true
					),
					'note' => $this->msg_Demos
				)
			)
		);
		
		return $x;
		
	}
			
	public function html_Builder($x = array()) {
		
		$html = NULL;
		
		foreach ($x as $o) {
		
			$html .= '<li class="list-group-item"><div class="row">';
				$html .= '<div class="col-lg-3">';
				switch ($o['type']) {
					case 'Input';
						$html .= $this->FormFields->Input($o['input']);
					break;
					case 'Select';
						$html .= $this->FormFields->Select($o['input']);
					break;
				}
				$html .= '</div>';
				$html .= '<div class="col-lg-9">';
					$html .= '<p style="padding-top:10px; line-height:100%;">' . $o['note'] . '</p>';
				$html .= '</div>';
			$html .= '</div></li>';
			
		}
		
		return $html;	
	}
						
	public function html_buildMarkup() {
			
		$html = NULL;
		
		$builder_x = $this->form_Builder();
		
		$this->gameIni->postData($_POST);
		
		$html .= '<center><img src="'. $this->Midair_LogoLocation . $this->Midair_Logo.'" width="30%"></center>'
			. '<form class="form-horizontal" name="gameini" action="index.php" method="post">'
			. '<div class="row">'
			. '<div class="col-lg-6 col-lg-push-3">'
			. '<div class="panel panel-info">'
				. '<div class="panel-heading">'
					. '<h3 class="panel-title"> <b>Midair</b> Game.ini Generator </h3>'
				. '</div>'
				. '<div class="panel-body">'
				. $this->html_Builder($builder_x['results'])
				. '</div><br><br>'
				.'<center><button type="submit" class="btn btn-sm btn-success">Generate</button><center>'
				.'<br>'
			. '</div>'
			. '</div>'
			. '</div>'

			. '<form>';
			
			return $html;
	}
	
	public function buildPage($html_body) {
		
		$html = NULL;
		/*
		* Build generalized HTML Markup
		*/

		$html = ''
			. '<!doctype html>'
			. '<html>'
			. '<head>'
			. '<meta charset="utf-8">'
			. '<title>' . $this->Title . '</title>'
			. '</head>'
			. '<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">'
			. '<link rel="stylesheet" type="text/css" href="http://gameini.traqza.com/v1/assets/css/style.css">'
			. '<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>'
			. '<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">'
			. '<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>'
			. '<script src="http://gameini.traqza.com/v1/assets/js/scripts.js"></script>'
			. '<body>'
			. $html_body
			. '</body>'
			. '</html>'
			.'';
		
		return $html;
	
	}

	public function html_resultsMarkup() {
		

		$html = NULL;
		$html .= '<center><img src="'. $this->Midair_LogoLocation . $this->Midair_Logo.'" width="30%"></center>'
			. '<form class="form-horizontal" action="index.php" method="post">'
			. '<div class="row">'
			. '<div class="col-lg-4 col-lg-push-4">'
			. '<div class="panel panel-info">'
				. '<div class="panel-heading">'
					. '<h3 class="panel-title"> Generated Game.ini Results </h3>'
				. '</div>'
				. '<div class="panel-body">'
				. '<b>Directions</b><br>'
					.'Copy & paste contents below into your <b>game.ini</b> located within the server config folder.
					Make sure to restart the server.<br>'
					.'<div class="well" style="background:#989898">';
						$html .= '///////////////////////////////////////////////////////<br>';
						$html .= '// Game.ini Generator by <b>Krayvok</b><br>';
						$html .= '///////////////////////////////////////////////////////<br>';						
				$html . '</div>';
			$html .= '</div>';
			$html .= '<center><button class="btn btn-warning">Go Back</button></center>'
			. '</div>'
			. '</div>'
			. '</div>'
			. '<form>';
			
			return $html;
	}
	
}