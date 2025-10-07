<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:13
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\customer_threads\page_header_toolbar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2815e4461_62255757',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '793d189f73ceaa18c25e3c154a7d5f180d6386ac' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\customer_threads\\page_header_toolbar.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2815e4461_62255757 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14409298068e4f281493a79_30690144', 'pageTitle');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "page_header_toolbar.tpl");
}
/* {block 'pageTitle'} */
class Block_14409298068e4f281493a79_30690144 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'pageTitle' => 
  array (
    0 => 'Block_14409298068e4f281493a79_30690144',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((isset($_smarty_tpl->tpl_vars['display']->value)) && $_smarty_tpl->tpl_vars['display']->value == 'view') {?>
        <h2 class="page-title">
            <?php if (is_array($_smarty_tpl->tpl_vars['title']->value)) {?>
                <?php echo preg_replace('!<[^>]*?>!', ' ', (string) end($_smarty_tpl->tpl_vars['title']->value));?>

            <?php } else { ?>
                <span title="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
">
                    <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( preg_replace('!<[^>]*?>!', ' ', (string) $_smarty_tpl->tpl_vars['title']->value),40 ));?>

                </span>
            <?php }?>
        </h2>
    <?php } else { ?>
        <?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

    <?php }
}
}
/* {/block 'pageTitle'} */
}
