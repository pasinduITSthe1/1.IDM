<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:31
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_room_allotment_comment.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f293207823_65521693',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd25449b09db62df6041e02a3a48452c150ca2a75' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_room_allotment_comment.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f293207823_65521693 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal-body">
    <div><b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Allotment remark'),$_smarty_tpl ) );?>
</b>: <?php echo $_smarty_tpl->tpl_vars['comment']->value;?>
</div>

    <?php if ((isset($_smarty_tpl->tpl_vars['loaderImg']->value)) && $_smarty_tpl->tpl_vars['loaderImg']->value) {?>
        <div class="loading_overlay">
            <img src='<?php echo $_smarty_tpl->tpl_vars['loaderImg']->value;?>
' class="loading-img"/>
        </div>
    <?php }?>
</div>
<?php }
}
