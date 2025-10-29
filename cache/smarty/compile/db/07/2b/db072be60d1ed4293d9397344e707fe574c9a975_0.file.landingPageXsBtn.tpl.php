<?php
/* Smarty version 4.5.5, created on 2025-10-29 12:32:31
  from 'C:\wamp64\www\1.IDM\modules\wkroomsearchblock\views\templates\hook\landingPageXsBtn.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6901bc07f0ef20_44140322',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db072be60d1ed4293d9397344e707fe574c9a975' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\wkroomsearchblock\\views\\templates\\hook\\landingPageXsBtn.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6901bc07f0ef20_44140322 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10067245346901bc07f0a671_98739782', 'landing_page_search_button_mobile');
?>

<?php }
/* {block 'landing_page_search_button_mobile'} */
class Block_10067245346901bc07f0a671_98739782 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'landing_page_search_button_mobile' => 
  array (
    0 => 'Block_10067245346901bc07f0a671_98739782',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<div class="row margin-top-20 visible-xs">
		<div class="col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
			<button id="xs_room_search" class="btn button button-medium" href="#xs_room_search_form"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Make Booking','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</span></button>
		</div>
	</div>
<?php
}
}
/* {/block 'landing_page_search_button_mobile'} */
}
