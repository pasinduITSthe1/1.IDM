<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:31
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_traveller_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2936258d9_81160640',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6ee22b9f86384b0b2ee474d67695521031777b5c' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_traveller_form.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2936258d9_81160640 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal-body">
    <div class="text-left errors-wrap"></div>
    <form id="customer-guest-details-form">
        <div class="form-group row">
            <div class="col-sm-2">
            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Title'),$_smarty_tpl ) );?>
</label>
                <select name="id_gender">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['genders']->value, 'gender', false, 'k');
$_smarty_tpl->tpl_vars['gender']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['gender']->value) {
$_smarty_tpl->tpl_vars['gender']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['gender']->value->id_gender;?>
"<?php if ($_smarty_tpl->tpl_vars['customerGuestDetail']->value->id_gender == $_smarty_tpl->tpl_vars['gender']->value->id_gender) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['gender']->value->name;?>
</option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </div>
            <div class="col-sm-5">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First Name'),$_smarty_tpl ) );?>
</label>
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['customerGuestDetail']->value->firstname;?>
" name="firstname">
            </div>
            <div class="col-sm-5">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last Name'),$_smarty_tpl ) );?>
</label>
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['customerGuestDetail']->value->lastname;?>
" name="lastname">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email'),$_smarty_tpl ) );?>
</label>
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['customerGuestDetail']->value->email;?>
" name="email">
            </div>
            <div class="col-sm-6">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Phone'),$_smarty_tpl ) );?>
</label>
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['customerGuestDetail']->value->phone;?>
" name="phone">
            </div>
        </div>
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
