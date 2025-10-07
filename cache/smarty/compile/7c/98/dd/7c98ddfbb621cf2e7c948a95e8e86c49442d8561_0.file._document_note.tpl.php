<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:29
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_document_note.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f291b05180_55257210',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7c98ddfbb621cf2e7c948a95e8e86c49442d8561' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_document_note.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f291b05180_55257210 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal-body">
    <form  action="<?php echo $_smarty_tpl->tpl_vars['current_index']->value;?>
&amp;vieworder&amp;id_order=<?php echo $_smarty_tpl->tpl_vars['order']->value->id;
if ((isset($_GET['token']))) {?>&amp;token=<?php echo htmlspecialchars((string)$_GET['token'], ENT_QUOTES, 'UTF-8', true);
}?>" method="post">
        <div class="form-group">
            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Note Detail'),$_smarty_tpl ) );?>
</label>
            <input type="hidden" name="id_order_invoice" id="id_order_invoice" value="" />
            <textarea name="note" id="editNote" class="edit-note textarea-autosize"></textarea>
        </div>
        <button class="btn btn-default" type="submit" name="submitEditNote" style="display:none" id="submitEditNote"></button>
    </form>

    <?php if ((isset($_smarty_tpl->tpl_vars['loaderImg']->value)) && $_smarty_tpl->tpl_vars['loaderImg']->value) {?>
        <div class="loading_overlay">
            <img src='<?php echo $_smarty_tpl->tpl_vars['loaderImg']->value;?>
' class="loading-img"/>
        </div>
    <?php }?>
</div>
<?php }
}
