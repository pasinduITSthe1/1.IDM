<?php
/* Smarty version 4.5.5, created on 2025-10-28 17:20:45
  from 'C:\wamp64\www\1.IDM\admin134miqa0b\themes\default\template\helpers\modules_list\modal.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6900ae15c96463_08638843',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a16bae375b1318c9a2794ab5d072a400945c5172' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin134miqa0b\\themes\\default\\template\\helpers\\modules_list\\modal.tpl',
      1 => 1759835419,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6900ae15c96463_08638843 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal fade" id="modules_list_container">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Recommended Modules and Services'),$_smarty_tpl ) );?>
</h3>
			</div>
			<div class="modal-body">
				<div id="modules_list_container_tab_modal" style="display:none;"></div>
				<div id="modules_list_loader"><i class="icon-refresh icon-spin"></i></div>
			</div>
		</div>
	</div>
</div>
<?php }
}
