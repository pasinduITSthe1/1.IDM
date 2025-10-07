<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:06
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\category-cms-tree-branch.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27ac3f1a5_05599899',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '08c8ab185c1b19a16687284c2a8be68b2289f5df' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\category-cms-tree-branch.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f27ac3f1a5_05599899 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

<li <?php if ((isset($_smarty_tpl->tpl_vars['last']->value)) && $_smarty_tpl->tpl_vars['last']->value == 'true') {?>class="last"<?php }?>>
	<strong><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['node']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['node']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['node']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</a></strong>
	<?php if ((isset($_smarty_tpl->tpl_vars['node']->value['children'])) && smarty_modifier_count($_smarty_tpl->tpl_vars['node']->value['children']) > 0) {?>
		<ul>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['node']->value['children'], 'child', false, NULL, 'categoryCmsTreeBranch', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['child']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['child']->value) {
$_smarty_tpl->tpl_vars['child']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_categoryCmsTreeBranch']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_categoryCmsTreeBranch']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_categoryCmsTreeBranch']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_categoryCmsTreeBranch']->value['total'];
?>
			<?php if ((isset($_smarty_tpl->tpl_vars['child']->value['children'])) && smarty_modifier_count($_smarty_tpl->tpl_vars['child']->value['children']) > 0 || (isset($_smarty_tpl->tpl_vars['child']->value['cms'])) && smarty_modifier_count($_smarty_tpl->tpl_vars['child']->value['cms']) > 0) {?>
				<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_categoryCmsTreeBranch']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_categoryCmsTreeBranch']->value['last'] : null) && smarty_modifier_count($_smarty_tpl->tpl_vars['node']->value['cms']) == 0) {?>
					<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./category-cms-tree-branch.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('node'=>$_smarty_tpl->tpl_vars['child']->value,'last'=>'true'), 0, true);
?>
				<?php } else { ?>
					<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./category-cms-tree-branch.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('node'=>$_smarty_tpl->tpl_vars['child']->value), 0, true);
?>
				<?php }?>
			<?php }?>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php if ((isset($_smarty_tpl->tpl_vars['node']->value['cms'])) && smarty_modifier_count($_smarty_tpl->tpl_vars['node']->value['cms']) > 0) {?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['node']->value['cms'], 'cms', false, NULL, 'cmsTreeBranch', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['cms']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cms']->value) {
$_smarty_tpl->tpl_vars['cms']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_cmsTreeBranch']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_cmsTreeBranch']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_cmsTreeBranch']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_cmsTreeBranch']->value['total'];
?>
				<li <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_cmsTreeBranch']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_cmsTreeBranch']->value['last'] : null)) {?>class="last"<?php }?> ><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['cms']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['cms']->value['meta_title'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['cms']->value['meta_title'], ENT_QUOTES, 'UTF-8', true);?>
</a></li>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php }?>
		</ul>
	<?php } elseif ((isset($_smarty_tpl->tpl_vars['node']->value['cms'])) && smarty_modifier_count($_smarty_tpl->tpl_vars['node']->value['cms']) > 0) {?>
		<ul>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['node']->value['cms'], 'cms', false, NULL, 'cmsTreeBranch', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['cms']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cms']->value) {
$_smarty_tpl->tpl_vars['cms']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_cmsTreeBranch']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_cmsTreeBranch']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_cmsTreeBranch']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_cmsTreeBranch']->value['total'];
?>
			<li <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_cmsTreeBranch']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_cmsTreeBranch']->value['last'] : null)) {?>class="last"<?php }?> ><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['cms']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['cms']->value['meta_title'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['cms']->value['meta_title'], ENT_QUOTES, 'UTF-8', true);?>
</a></li>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</ul>
	<?php }?>
</li>
<?php }
}
