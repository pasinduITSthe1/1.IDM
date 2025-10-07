<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:42
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\shop\helpers\list\list_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29e6e7737_14403276',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a2330c12f102f62c6317a95070bfc3dc7e9e5b6a' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\shop\\helpers\\list\\list_header.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29e6e7737_14403276 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_124577199868e4f29e6ca7e6_64934180', "startForm");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/list/list_header.tpl");
}
/* {block "startForm"} */
class Block_124577199868e4f29e6ca7e6_64934180 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'startForm' => 
  array (
    0 => 'Block_124577199868e4f29e6ca7e6_64934180',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>

<?php $_smarty_tpl->_assignInScope('action', smarty_modifier_replace($_smarty_tpl->tpl_vars['action']->value,'id_shop','shop_id'));?>
	<form method="post" action="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="form-horizontal clearfix" id="form-<?php echo $_smarty_tpl->tpl_vars['list_id']->value;?>
">
<?php
}
}
/* {/block "startForm"} */
}
