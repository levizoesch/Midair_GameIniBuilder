<?php
class gameIni {
	
	function __construct() {
	
		$this->AdminPassword = NULL;
		$this->RecordDemos = NULL;
		
	}
	
	function postData() {
		
		$post = array();
		
		if (!empty($_POST)) {
			$post['admin_password'] = $_POST['sap'];	
			$post['record_demos'] = $_POST['rd'];	
		}
		
		return $post;
		
	}
	
	function postResults() {
		
		$results = $this->postData();
		
		$html .= NULL;
		
		if (!empty($results['admin_password'])) {
			$html .= '[AdminPassword]' . '<br>';
			$html .= 'Password='.$results['admin_password'] . '<br><br>';
		}
		
	}

	function set_AdminPassword($x) { $this->AdminPassword = $x;	}
	function get_AdminPassword() { return $this->AdminPassword;	}
	
	function set_RecordDemos($x) { $this->RecordDemos = $x;	}
	function get_RecordDemos() { return $this->RecordDemos;	}
}

?>