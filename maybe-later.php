
add_action( 'admin_enqueue_scripts', 'jcc_sortables_scripts' );

function jcc_sortables_scripts() {
	global $post;
	if ( in_array($hook, array('post.php','post-new.php') ) && (( $post->post_type == 'page' ) ||
	( isset($_GET['post_type']) && ($_GET['post_type'] == 'recipe') )) ) {
		wp_enqueue_script( 'sortable-ingredients', 
							get_stylesheet_directory_uri() . '/js-admin/sortable.js', 
							array( "jquery", "jquery-ui-core", "jquery-ui-sortable" ) );
		}
	}


add_action( 'add_meta_boxes', 'jcc_add_meta_boxes' );

function jcc_add_meta_boxes() {
	add_meta_box( 'menu-items', "Menu Items", 'show_edit_menu_items', 'page' );
	}

function show_edit_menu_items() {
	global $post;
	global $newrow_editor;
	$ingreds_array = array();
	
	echo '<table class="widefat" id="menu-item-list"><tbody>
			<thead><th id="Delete" class="manage-column column-cb" style="width:36px" >Actions</th><th id="menu-item" class="manage-column column-menu-item">Menu Item</th><th class="nonessential manage-column column-menu-item-general">Price</th><th>S</th><th>M</th><th>L</th></thead>'; 
	
	if ( ( $ingreds_array = get_post_meta( $post->ID, 'menu-items', true ) ) && is_array($ingreds_array) && ( count($ingreds_array) > 0) ) {
	
	$rowcount = 0;
	
	foreach( $ingreds_array as $key_id => $thisrow ) {
		if (!empty($thisrow)) { 
		
			if ( isset($thisrow['unit']) && 'divider' == $thisrow['unit'] )) {
			
				echo <<<HTML
				<tr id="menu-item-{$rowcount}" class="sortable" >
					<td class="item-actions"><a class="x-delete"></a> <div class="drag-move"></div>
						<input type="hidden" name="menu-item[{$rowcount}][newpos]" value="{$rowcount}"></td></td>
					<td colspan="3" class="colhead"><select id="menu-item-{$rowcount}-unit" name="menu-item[{$rowcount}][unit]" style="width:80px" >{$optiontext}</select>: 
					<input type="text" class="subhead_entry" name="menu-item[{$rowcount}][name]" value="{$thisrow['name']}" style="width:280px" /></td>
				</tr>
HTML;
			} else {
			
				echo <<<HTML
				<tr id="menu-item-{$rowcount}" class="sortable" >
					<td class="item-actions"><a class="x-delete"></a> <div class="drag-move"></div>
						<input type="hidden" name="menu-item[{$rowcount}][newpos]" value="{$rowcount}"></td>
					<td><input class="name_entry" name="menu-item[{$rowcount}][name]" value="{$thisrow['name']}" style="width:280px" /></td>
					<td><input class="name_entry" name="menu-item[{$rowcount}][name]" value="{$thisrow['name']}" style="width:150px" /></td>
				</tr>
HTML;
				}
			}
			$rowcount++;
		}
	} 
	
	echo $newrow_editor;

	echo '</tbody></table><p><strong>Add new row:</strong> &nbsp;<a href="javascript:addRow(\'editor\')" >New menu-item</a> | <a href="javascript:addRow(\'header\')" >New header/text line</a>';
	
}

function save_menu_item_meta( $post_id ) {
	if (get_post_type( $post_id) != 'recipe') return;
	save_edit_ingredients( $post_id );
	save_edit_nutritional_info( $post_id );
	}

		function save_edit_ingredients($post_id) {

			if (empty($_POST['ingredient']) || !isset($post_id)) return;
			$ingredients_array = $_POST['ingredient'];
			
			function sort_ingredient_custom_field( $a ) {
				global $post_id,$post_ingredient_terms;
				if (empty($a['name'])) return;
								
				if (in_array($a['unit'], array('subhead','h1','h2','h3','text') ) )  // subhead or text entry
					return array( 'term' =>null, 'unit'=>$a['unit'], 'position'=>$a['newpos'], 'name'=> $a['name'] );
				
				$number = (isset($a['numeric'])) ? $a['numeric'] : '';
				$unit = (isset($a['unit'])) ? $a['unit'] : '';
				$position = (isset($a['newpos'])) ? $a['newpos'] : null;
				
				$term_id = ( term_exists( $a['name'], 'ingredient' ) );
				if (!$term_id) {
					$new_term = wp_insert_term( $a['name'], 'ingredient' );
					if (!is_wp_error($new_term)) $term_id = $new_term['term_id'];
					} else $term_id = $term_id['term_id'];
				$post_ingredient_terms[] = $term_id;
				return array( 'term' =>$term_id,'numeric'=>$number, 'unit'=>$unit, 'position'=>$position, 'detailname' => $a['detailname'], 'name' => $a['name'] );
			}
						
			$sorted = array_map( 'sort_ingredient_custom_field', $ingredients_array);
			$post_ingredient_terms = array_map( create_function('$item_array','if ($item_array["term"]) return (int)$item_array["term"];'), $sorted );
			
			wp_set_object_terms( $post_id, $post_ingredient_terms, 'ingredient');
			update_post_meta( $post_id, 'ingredients', $sorted );
			
			}