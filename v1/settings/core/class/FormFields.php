<?php
class FormFields {

	function Checkbox($option) {
	
		$output = NULL;
		
		if (!empty($option['error'])) {
			$output .= '<p>' . $option['error'] . '</p>';
		}
		$output .= '<li class="list-group-item">';
		if (!empty($option['label'])) {
			$output .= $option['label'];
		}
		$output .= '<div class="material-switch pull-right">'
		.'<input ';

		if (!empty($option['id'])) {
			$output .= 'id="'.$option['id'].'" ';
		}
		if (!empty($option['name'])) {
			$output .= 'name="'.$option['name'].'" ';
		}
		if (!empty($option['class'])) {
			$output .= 'class="'.$option['class'].'" ';
		}
		if (!empty($option['data_on_txt'])) {
			$output .= 'data-on="'.$option['data_on_txt'].'" ';
		}
		if (!empty($option['data_off_txt'])) {
			$output .= 'data-off="'.$option['data_off_txt'].'" ';
		}
		if (!empty($option['data_on_style'])) {
			$output .= 'data-onstyle="'.$option['data_on_style'].'" ';
		}
		if (!empty($option['data_off_style'])) {
			$output .= 'data-offstyle="'.$option['data_off_style'].'" ';
		}
		if (!empty($option['checkbox_size'])) {
			$output .= 'data-size="'.$option['checkbox_size'].'" ';
		}
		if (!empty($option['onclick'])) {
			$output .= 'onclick="'.$option['onclick'].'" ';
		}
		if ($option['checked']) {
			$output .= 'checked ';	
		}
			
		$output .= 'type="checkbox" data-toggle="toggle"';
		
		$output .='/>'
		.'</div>'
		.'</li>';
		
		return $output;
	
	}

    function Select($option) {

        $output = '<div class="control-group">';
		if (isset($option['error'])) { 
                $output .='<label class="control-label" for="inputError">
                    <i style="color:red" class="fa fa-times-circle-o">
                        <b>' . $option['error'] .'</b>
                    </i>
                </label>
            <br>';
		    }
		    if (isset($option['label'])) {
				$output .= '<label class="control-label">' . $option['label'].'</label>';
		    }
            	$output .= '<div class="controls">
                <select class="form-control" ';
				if (isset($option['name'])) { $output .= ' name="'.$option['name'].'"'; }
				if (isset($option['class'])) { $output .= ' class="'.$option['class'].'"'; }
				if (isset($option['id'])) { $output .= ' class="'.$option['id'].'"'; }
				if (isset($option['datatarget'])) { $output .= ' data-target="'.$option['datatarget'].'"'; }
				if (isset($option['required'])) { $output .= ' required'; }
				$output .='>';
				if (isset($option['default'])) {
					if (!$option['default'] === false) {
						$output .='<option value="">-- Select One --</option>';
					}
				}
				else {
					$output .='<option value="">-- Select One --</option>';
				}
				if (isset($option['keyvalue'])) {
					$output .= $this->makeOptionsKV($option['array'], $option['value']) .'';
				}
				else {
					$output .= $this->makeOptions($option['array'], $option['value']) .'';
				}
                $output .= '</select>
            </div>
        </div>';
	
		return $output;

    }
	
    function Input($option) {
		$output = '<div class="control-group">';
		if (!empty($option['error'])) { 
                $output .='<label class="control-label" for="inputError">
                    <i style="color:red" class="fa fa-times-circle-o">
                        <b>' . $option['error'] .'</b>
                    </i>
                </label>
            <br>';
		   }
		   
		if (!empty($option['label'])) {
			$output .='<label class="control-label">' . $option['label'] . '</label>';
		}

		$output .='<div class="controls">' .
			'<input class="form-control"';
				if (!empty($option['id'])) { $output .= ' id="' . $option['id'] . '"'; }
				if (!empty($option['name'])) { $output .= ' name="' . $option['name'] . '"'; }
				if (!empty($option['type'])) { $output .= ' type="' . $option['type'] . '"'; }
				if (!empty($option['placeholder'])) { $output .= ' placeholder="' . $option['placeholder'] . '"'; }
				if (!empty($option['value'])) { $output .= ' value="' . $option['value'] . '"'; }
				if (!empty($option['maxchar'])) { $output .=' maxlength="'. $option['maxchar'] . '"'; }
				if (!empty($option['class'])) { $output .=' class="'. $option['class'] . '"'; }
				if (!empty($option['pattern'])) { $output .=' pattern="' . $option['pattern'] . '"'; }
				if (!empty($option['title'])) { $output .=' title="' . $option['title'] . '"'; }
				if (!empty($option['style'])) { $output .=' style="'. $option['style'] . '"'; }
				if (!empty($option['keypress'])) { $output .=' onkeypress="'. $option['keypress'] . '"'; }
				if (!empty($option['required'])) { $output .= ' required'; }
				if (isset($option['readonly'])) { $output .= ' readonly'; }
				
		$output .= '>' .
				'</div>' .
				'</div>';
						
        return $output;
    }
	
	function makeOptions($list, $selected) {
		$output = "";
		foreach ($list as $item) {
			$output .= "<option value=\"{$item}\" ";
			if ($selected == $item) {
				$output .= 'selected';
			}
			$output .= ">{$item}</option>". PHP_EOL;
		}
		return $output;
	}
	
	function makeOptionsKV($list, $selected) {
		$output = NULL;
		foreach ($list as $k => $v) {
			$output .= "<option value=\"{$k}\" ";
			if ($selected == $k) {
				$output .= 'selected';
			}
			$output .= ">{$v}</option>". PHP_EOL;
		}
		return $output;
	}

}
?>