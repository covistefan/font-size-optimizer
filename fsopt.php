<?php

/** 
 * Plugin Name:     Font Size Optimizer
 * Plugin URI:      https://wordpress.org/plugins/font-size-optimizer/
 * Description:     Optimize Text size to parent element width
 * Version:         3.4
 * Author:          appleuser
 * Author URI:      https://profiles.wordpress.org/appleuser
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:     fsopt
 * Domain Path:     /languages
 */

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    die;
}

if (!(function_exists('createFSO'))):
function createFSO() {
    $get_fso_els = get_option('fso_elements');
    if (trim($get_fso_els)!=''):
    endif;
    }
endif;

if (!(function_exists('activateFSO'))):
function activateFSO() {
    $get_fso_els = get_option('fso_elements');
    // workflow for v1
    if (trim($get_fso_els)!=''):
        $get_fso_mc = trim(get_option('fso_mc'));
        $get_fso_ms = intval(get_option('fso_ms'));
        $get_fso_els = explode(",", $get_fso_els);
        $newel = array();
        if (is_array($get_fso_els)):
	        foreach ($get_fso_els AS $kk => $kv):
	        	if (trim($kv)!=''):
		        	$newel[] = strtolower(trim($kv));
		        endif;
	        endforeach;
	    endif;
        echo "<script language='JavaScript' type='text/javascript'>\n\n";
        echo "jQ(document).ready(function() {\n";
        foreach ($newel AS $nk => $nv):
            echo "\tjQ('".$nv."').optwidth({\n";
            if ($get_fso_mc!=''): echo "\t\tmc: '".$get_fso_mc."',\n"; endif;
            if ($get_fso_ms!=''): echo "\t\tms: '".$get_fso_ms."',\n"; endif;
            echo "\t\t});\n";
        endforeach;
        echo "\t});\n";
        echo "</script>\n";
    endif;
    // workflow since v2
    $getfso = array();
	$getfso['show_debug'] = intval(get_option('fso_debug'));
	$getfso['ceen_value'] = unserialize(get_option('fso_ceen'));
	$getfso['cmcn_value'] = unserialize(get_option('fso_cmcn'));
	$getfso['cmsn_value'] = unserialize(get_option('fso_cmsn'));
	$getfso['cubn_value'] = unserialize(get_option('fso_cubn'));
	$getfso['cwln_value'] = unserialize(get_option('fso_cwln'));
	$getfso['cuon_value'] = unserialize(get_option('fso_cuon'));
	$getfso['csln_value'] = unserialize(get_option('fso_csln'));
	if (isset ($getfso['ceen_value']) && is_array($getfso['ceen_value']) && count($getfso['ceen_value'])>0):
		echo "<script language='JavaScript' type='text/javascript'>\n\n";
        echo "jQ(document).ready(function() {\n";
        foreach($getfso['ceen_value'] as $gk => $gv):
            echo "\tjQ('".$gv."').optwidth({\n";
			if ($getfso['show_debug']==1): echo "\t\tdebug: true,\n"; endif;
            if (trim($getfso['cmcn_value'][$gk])!=''): echo "\t\tmc: '".trim($getfso["cmcn_value"][$gk])."',\n"; endif;
            if (intval($getfso['cmsn_value'][$gk])>0): echo "\t\tms: ".intval($getfso['cmsn_value'][$gk]).",\n"; endif;
            if (trim($getfso['cubn_value'][$gk])!=''): echo "\t\tub: '".trim($getfso['cubn_value'][$gk])."',\n"; endif;
            if (intval($getfso['cwln_value'][$gk])>0): echo "\t\twl: ".intval($getfso['cwln_value'][$gk]).",\n"; endif;
            if (intval($getfso['cuon_value'][$gk])>0): echo "\t\tuo: true,\n"; endif;
            if (intval($getfso['csln_value'][$gk])>0): echo "\t\tsl: true,\n"; endif;
            echo "\t\t});\n";
        endforeach;

        echo "\t});\n";
        echo "</script>\n";
	endif;
    }
endif;

if (!(function_exists('fso_loadtext'))):
function fso_loadtext() {
	load_plugin_textdomain( 'fsopt', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
	}
endif;

if (!(function_exists('fso_admin'))):
function fso_admin() {
	add_options_page(__("Font Size Optimizer", "fsopt"), __("Font Size Optimizer", "fsopt"), 'level_8', __FILE__, 'fso_options');
	}
endif;

if (!(function_exists('fso_options'))):
function fso_options() {
    echo "<h1>".__("Font Size Optimizer", "fsopt")."</h1>";
    echo "<p>".__("Define elements that the Font Size Optimizer function should be used on.", "fsopt")."</p>";

	add_option('fso_debug', 0);
	add_option('fso_ceen', '');
	add_option('fso_cmcn', '');
	add_option('fso_cmsn', '');
	add_option('fso_cubn', '');
	add_option('fso_cwln', '');
	add_option('fso_cuon', '');
	add_option('fso_csln', '');
	
    if (isset($_POST['ceen_value'])) {
        foreach ($_POST['ceen_value'] AS $pk => $pv) {
            $_POST['ceen_value'][$pk] = sanitize_text_field($pv);
        }
    }
    if (isset($_POST['cmcn_value'])) {
        foreach ($_POST['cmcn_value'] AS $pk => $pv) {
            $_POST['cmcn_value'][$pk] = sanitize_html_class($pv);
        }
    }
    if (isset($_POST['cwln_value'])) {
        foreach ($_POST['cwln_value'] AS $pk => $pv) {
            $_POST['cwln_value'][$pk] = intval($pv);
        }
    }

	if (isset($_POST['ceen_value'])) {
		$updated['fso_ceen'] = update_option('fso_ceen', serialize($_POST['ceen_value']));
		$updated['fso_cmcn'] = update_option('fso_cmcn', serialize($_POST['cmcn_value']));
		$updated['fso_cmsn'] = update_option('fso_cmsn', serialize($_POST['cmsn_value']));
		$updated['fso_cubn'] = update_option('fso_cubn', serialize($_POST['cubn_value']));
		$updated['fso_cwln'] = update_option('fso_cwln', serialize($_POST['cwln_value']));
		$updated['fso_cuon'] = update_option('fso_cuon', serialize($_POST['cuon_value']));
		$updated['fso_csln'] = update_option('fso_csln', serialize($_POST['csln_value']));
	}
	
	if (isset($_POST['show_debug'])) {
		$updated['fso_debug'] = update_option('fso_debug', intval($_POST['show_debug']));
	}
	
 	// get values from older version
 	if (trim(get_option('fso_elements'))!='') {
		 $get_fso_els = explode(",", trim(get_option('fso_elements'))); 
		 $newel = array(); 
		 if (is_array($get_fso_els)) {
			 foreach ($get_fso_els AS $kk => $kv) {
				 if (trim($kv)!='') {
					 $newel[] = strtolower(trim($kv));
				} 
			}
			$setvars = array(
				'el_edit' => trim(implode(", ", $newel)),
				'mc_edit' => get_option('fso_mc'),
				'ms_edit' => intval(get_option('fso_ms')),
				'ub_edit' => 'word',
				'wl_edit' => '0'
			);
		}
	}
 	
 	// setup the elements array
 	$elements = array();
 	
 	if (isset($setvars)):
	    $eled = explode(',', $setvars['el_edit']);
	    foreach($eled as $ek => $ev) :
			$elements[trim($ev)] = array(
				"el" => trim($ev),
			  	"mc" => $setvars['mc_edit'],
			  	"ms" => $setvars['ms_edit'],
			  	"ub" => $setvars['ub_edit'],
			  	"wl" => $setvars['wl_edit'],
			  	"uo" => 0,
			  	"sl" => 0
			); 
			endforeach;
		unset($setvars);
		delete_option('fso_elements');
	    delete_option('fso_sb');
	    delete_option('fso_mc');
	    delete_option('fso_ms');
	endif;
 	
 	$getfso = array();
 	$getfso['show_debug'] = intval(get_option('fso_debug'));
	$getfso['ceen_value'] = unserialize(get_option('fso_ceen'));
	$getfso['cmcn_value'] = unserialize(get_option('fso_cmcn'));
	$getfso['cmsn_value'] = unserialize(get_option('fso_cmsn'));
	$getfso['cubn_value'] = unserialize(get_option('fso_cubn'));
	$getfso['cwln_value'] = unserialize(get_option('fso_cwln'));
	$getfso['cuon_value'] = unserialize(get_option('fso_cuon'));
	$getfso['csln_value'] = unserialize(get_option('fso_csln'));
	// setup the elements display by running through ceen_value
	if (isset ($getfso['ceen_value'])) {
		foreach($getfso['ceen_value'] as $gk => $gv) {
			$elements[trim($gv)] = array(
			   "el" => trim($getfso['ceen_value'][$gk]),
			  	"mc" => trim($getfso['cmcn_value'][$gk]),
			  	"ms" => intval($getfso['cmsn_value'][$gk]),
			  	"ub" => trim($getfso['cubn_value'][$gk]),
			  	"wl" => intval($getfso['cwln_value'][$gk]),
			  	"uo" => intval($getfso['cuon_value'][$gk]),
			  	"sl" => intval($getfso['csln_value'][$gk])
				); 
		}
	}

    ?>
    <div id="fso-tabs">
		<div id="element_edit_area">
			<ul style='margin-bottom: 0px;'>
				<li class="fielddesc"><?php _e("selector to change", "fsopt"); ?></li>
				<li class="fieldvalue"><input type="text" name="el_edit" id="ceen" /></li>
				<li class="fielddesc"><?php _e("class name of modified elements", "fsopt"); ?></li>
				<li class="fieldvalue"><input type="text" name="mc_edit" id="cmcn" value="" placeholder="optwidth" /></li>
				<li class="fielddesc"><?php _e("minimum font-size of modified elements", "fsopt")?></li>
				<li class="fieldvalue"><input type="number" name="ms_edit" min="1" steps="1" id="cmsn" value="" /></li>
				<li class="fielddesc"><?php _e("kind of modification", "fsopt"); ?></li>
				<li class="fieldvalue"><select name="ub_edit" id="cubn" onchange="showWL(this.value)">
					<option value="word"selected="selected"><?php _e("word", "fsopt"); ?></option>
					<option value="line"><?php _e("line", "fsopt")?></option>
					<option value="wordline"><?php _e("wordline", "fsopt")?></option>
				</select></li>
			</ul>
			<div id="wlarea" style="display: none">
				<ul style='margin-top: 0px;'>
					<li class="fielddesc"><?php _e("number of characters in one wordline", "fsopt")?></li>
					<li class="fieldvalue"><input type="text" name="wl_edit" id="cwln" placeholder="70" /></li>
				</ul>
			</div>
			<div id="uoarea" >
				<ul style='margin-top: 0px;'>
					<li class="fielddesc"><?php _e("span to parent width", "fsopt")?></li>
					<li class="fieldvalue"><input type="checkbox" name="uo_edit" id="cuon" value="" /></li>
				</ul>
			</div>
			<div id="slarea">
				<ul style='margin-bottom: 0px;'>
					<li class="fielddesc"><?php _e("stich multiple lines", "fsopt")?></li>
					<li class="fieldvalue"><input type="checkbox" name="sl_edit" id="csln" value="" /></li>
				</ul>
			</div>
			<input type="hidden" name="id_edit" id="editid" value="" />
			<input type="button" class="button button-small" name="btn_ie" id="btnie" value="<?php _e("Insert", "fsopt"); ?>" onclick="insertUpdateGenerated()" />
			<input type="button" class="button button-small" name="btn_cc" id="btncc" value="<?php _e("Cancel", "fsopt"); ?>" onclick="insertUpdateCancel()" />
		</div>
		<form action="" method="post">
		<div id="generated_code_area" <?php if(count($elements)==0): ?>style='display: none;'<?php endif; ?>>
			
			<?php
			
			$divnum = 1;
			foreach ($elements as $ek => $val):
				$t = false;
				echo '<div id="fsoe_'.$divnum.'" class="codeholder">';
				echo "<div class='showcode' style='margin-bottom: 5px;'>\$('<div style='display: inline;' id='az_ceen_".$divnum."'>".$val['el']."</div>').optwidth({";
				if (strlen(trim($val['mc']))!=0): echo "<div style='display: inline;' id='az_cmcn_".$divnum."'>\n\tmc: '".$val['mc']."',</div>"; $t = true; endif;
				if (intval($val['ms'])>0): echo "<div style='display: inline;' id='az_cmsn_".$divnum."'>\n\tms: ".$val['ms'].",</div>"; $t = true; endif;
				if (trim($val['ub'])!='word'): echo "<div style='display: inline;' id='az_cubn_".$divnum."'>\n\tub: '".$val['ub']."',</div>"; $t = true; endif;
				if (intval($val['wl'])>0): echo "<div style='display: inline;' id='az_cwln_".$divnum."'>\n\twl: ".$val['wl']."</div>"; $t = true; endif;
				if ($val['uo']==1 && trim($val['ub'])!='line'): echo "<div style='display: inline;' id='az_cuon_".$divnum."'>\n\tuo: true, </div>"; $t = true; else: $val['uo'] = 0; endif;
				if ($val['sl']==1 && trim($val['ub'])!='line'): echo "<div style='display: inline;' id='az_csln_".$divnum."'>\n\tsl: true, </div>"; $t = true; else: $val['sl'] = 0; endif;
				if ($t): echo "\n\t"; endif;
				echo "});</div>";
				echo '<input type="hidden" name="ceen_value[]" value="'.$val["el"].'" id="ceen_fsoe_'.$divnum.'">';
				echo '<input type="hidden" name="cmcn_value[]" value="'.$val["mc"].'" id="cmcn_fsoe_'.$divnum.'">';
				echo '<input type="hidden" name="cmsn_value[]" value="'.$val["ms"].'" id="cmsn_fsoe_'.$divnum.'">';
				echo '<input type="hidden" name="cubn_value[]" value="'.$val["ub"].'" id="cubn_fsoe_'.$divnum.'">';
				echo '<input type="hidden" name="cwln_value[]" value="'.$val["wl"].'" id="cwln_fsoe_'.$divnum.'">';
				echo '<input type="hidden" name="cuon_value[]" value="'.$val["uo"].'" id="cuon_fsoe_'.$divnum.'">';
				echo '<input type="hidden" name="csln_value[]" value="'.$val["sl"].'" id="csln_fsoe_'.$divnum.'">';
				echo '<input type="button" class="button button-small " value="'.__("Remove", "fsopt").'" onclick="eraseItem(\'fsoe_'.$divnum.'\')" > ';
				echo '<input type="button" class="button button-small " value="'.__("Edit", "fsopt").'" onclick="editItem(\'fsoe_'.$divnum.'\')" > ';
				echo '<input type="button" class="button button-small " value="'.__("Duplicate", "fsopt").'" onclick="dupItem(\'fsoe_'.$divnum.'\')" > ';
				$divnum++;
				echo '</div>';
			endforeach;
			
			
			?>
			
		</div>
		<hr class="clearbreak" />
            <p><input type="hidden" id="fso_debug" name="show_debug" value="0" /><input type="checkbox" id="fso_debug" name="show_debug" value="1" <?php if($getfso['show_debug']==1): echo " checked='checked' "; endif; ?> /> <label for="fso_debug"><?php _e("Debug Mode (shows calculating in console)", "fsopt"); ?></label></p>
            <p id="delhint" style="display: none;"><?php _e("Please use the 'Save'-button to finaly delete removed fsopt allocations.", "fsopt"); ?></p>
            <p><input type="submit" class="button button-primary" value="<?php echo __("Save", "fsopt"); ?>"></p>
		</form>
	</div>
		
	<?php

	}
endif;

if (!(function_exists('fso_set_options'))):
function fso_set_options() {
	add_option('fso_elements', '');
    add_option('fso_mc', '');
    add_option('fso_ms', '');
	add_option('fso_ceen', '');
	add_option('fso_cmcn', '');
	add_option('fso_cmsn', '');
	add_option('fso_cubn', '');
	add_option('fso_cwln', '');
	add_option('fso_cuon', '');
	}
endif;

if (!(function_exists('fso_deinstall'))):
function fso_deinstall() {
	delete_option('fso_elements');
	delete_option('fso_debug');
    delete_option('fso_sb');
    delete_option('fso_mc');
    delete_option('fso_ms');
	delete_option('fso_ceen');
	delete_option('fso_cmcn');
	delete_option('fso_cmsn');
	delete_option('fso_cubn');
	delete_option('fso_cwln');
	delete_option('fso_cuon');
	delete_option('fso_csln');
	}
endif;

if (!(function_exists('fso_script'))):
function fso_script() {
	wp_enqueue_script( 'script', plugins_url('/js/fsopt.min.js', __FILE__), array('jquery'), false, true);
	}
endif;

if (!(function_exists('fso_backend_script'))):
function fso_backend_script() {
	wp_register_script( 'fso_script', plugins_url('/js/fsoptbackend.min.js', __FILE__), array('jquery'), false, true);
	$translation_array = array(
		'setup_selector' => __( 'Please setup at least the selector', 'fsopt' ),
		'remove' => __( 'Remove', 'fsopt' ),
		'edit' => __( 'Edit', 'fsopt' ),
		'duplicate' => __( 'Duplicate', 'fsopt' ),
		'insert' => __( 'Insert', 'fsopt' ),
		'dochanges' => __( 'Assign Changes', 'fsopt' ),
		);
	wp_localize_script( 'fso_script', 'fso_string', $translation_array );
	wp_enqueue_script( 'fso_script' );
	wp_enqueue_style( 'fsopt', plugins_url('/css/fsopt.css', __FILE__), false);
	}
endif;

if (function_exists('_activation_hook')) {
	register_activation_hook(__FILE__, 'fso_set_options');
	}

if (function_exists('register_uninstall_hook')) {
	register_uninstall_hook(__FILE__, 'fso_deinstall');
	}

if (is_admin()):
	add_action('admin_menu', 'fso_admin');
	add_action('init', 'fso_backend_script');
else:
	add_action('init', 'fso_script');
endif;
add_action('plugins_loaded', 'fso_loadtext');
add_action('wp_head', 'createFSO');
add_action('wp_footer', 'activateFSO', 999);

?>