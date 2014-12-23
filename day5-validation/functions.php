<?php 
//output any array as an unordered list
	//use eric for custom function names so you don't create a function name that already exist.
function eric_array_list($array){
	//if the array exists, display it
	if(is_array($array)){
		echo '<ul>';
		//output one list item per thing in the array
			foreach ( $array as $item ) {
				echo '<li>' . $item . '</li>'; //concatinating items
			}
		echo '</ul>';
	}

}

//display one inline error message (use this next to a field)
function eric_inline_error($array, $item){
	//check to make sure if the item exist in the array
	if( isset( $array[$item] ) ){
		echo '<div class="inline-error">' . $array[$item] . '</div>';
	}
}

//no close PHP