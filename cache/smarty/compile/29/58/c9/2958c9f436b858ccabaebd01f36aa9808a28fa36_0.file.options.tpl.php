<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:34
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\order_preferences\helpers\options\options.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f296775586_48025135',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2958c9f436b858ccabaebd01f36aa9808a28fa36' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\order_preferences\\helpers\\options\\options.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f296775586_48025135 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_189739982268e4f296670054_98126499', "input");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_129548090068e4f296731811_94235146', "footer");
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6065666768e4f296771f53_77640308', "after");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/options/options.tpl");
}
/* {block "input"} */
class Block_189739982268e4f296670054_98126499 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'input' => 
  array (
    0 => 'Block_189739982268e4f296670054_98126499',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ($_smarty_tpl->tpl_vars['field']->value['type'] == 'html' && $_smarty_tpl->tpl_vars['category']->value == 'standard_product' && $_smarty_tpl->tpl_vars['key']->value == 'PS_STANDARD_PRODUCT_ORDER_ADDRESS') {?>
        <div class="col-lg-9">
            <div class="alert alert-info"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please set all the required fields for the custom address below'),$_smarty_tpl ) );?>
</div>
        </div>
        <div>
            <?php if ((isset($_smarty_tpl->tpl_vars['countries']->value)) && $_smarty_tpl->tpl_vars['countries']->value) {?>
                <div id="conf_service_id_country" class="form-group">
                    <label class="control-label required col-lg-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Country'),$_smarty_tpl ) );?>
</label>
                    <div class="col-lg-9">
                        <select class="form-control fixed-width-xxl " name="service_id_country" id="service_id_country">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countries']->value, 'country');
$_smarty_tpl->tpl_vars['country']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['country']->value) {
$_smarty_tpl->tpl_vars['country']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['country']->value['id_country'];?>
" <?php if ((isset($_smarty_tpl->tpl_vars['custom_address_details']->value['id_country'])) && $_smarty_tpl->tpl_vars['country']->value['id_country'] == $_smarty_tpl->tpl_vars['custom_address_details']->value['id_country']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['country']->value['name'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                </div>
                <div id="conf_service_id_state" class="form-group">
                    <label class="control-label required col-lg-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'State'),$_smarty_tpl ) );?>
</label>
                    <div class="col-lg-9">
                        <select class="form-control fixed-width-xxl" name="service_id_state" id="service_id_state">
                        <?php if ((isset($_smarty_tpl->tpl_vars['custom_address_details']->value['id_state']))) {?><option value="<?php echo $_smarty_tpl->tpl_vars['custom_address_details']->value['id_state'];?>
" selected></option><?php }?>
                        </select>
                    </div>
                </div>
            <?php }?>
            <div id="conf_service_city" class="form-group">
                <label class="control-label required col-lg-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'City'),$_smarty_tpl ) );?>
</label>
                <div class="col-lg-9">
                    <input class="form-control fixed-width-xxl" type="text" name="service_city" id="service_city" <?php if ((isset($_smarty_tpl->tpl_vars['custom_address_details']->value['city']))) {?>value="<?php echo $_smarty_tpl->tpl_vars['custom_address_details']->value['city'];?>
"<?php }?>/>
                </div>
            </div>
            <div id="conf_service_postcode" class="form-group">
                <label class="control-label col-lg-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Zip/postal code'),$_smarty_tpl ) );?>
</label>
                <div class="col-lg-9">
                    <input class="form-control fixed-width-xxl" type="text" name="service_postcode" id="service_postcode" <?php if ((isset($_smarty_tpl->tpl_vars['custom_address_details']->value['postcode']))) {?>value="<?php echo $_smarty_tpl->tpl_vars['custom_address_details']->value['postcode'];?>
"<?php }?>/>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

    <?php }
}
}
/* {/block "input"} */
/* {block "footer"} */
class Block_129548090068e4f296731811_94235146 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_129548090068e4f296731811_94235146',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

    <?php if ($_smarty_tpl->tpl_vars['category']->value == 'standard_product') {?>
        <?php echo '<script'; ?>
 type="text/javascript">
            function ajaxGetStates(id_state_selected) {
                $.ajax({
                    url: "index.php",
                    cache: false,
                    data: "ajax=1&tab=AdminStates&token=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0], array( array('tab'=>'AdminStates'),$_smarty_tpl ) );?>
&action=states&id_country="+$('#service_id_country').val() + "&id_state=" + $('#service_id_state').val(),
                    success: function(html)
                    {
                        if (html == 'false') {
                            $("#conf_service_id_state").fadeOut();
                            $('#service_id_state option[value=0]').attr("selected", "selected");
                        } else {
                            $("#service_id_state").html(html);
                            $("#conf_service_id_state").fadeIn();
                            $('#service_id_state option[value=' + id_state_selected + ']').attr("selected", "selected");
                        }
                    }
                });
            }

            $(document).ready(function(){
                <?php if ((isset($_smarty_tpl->tpl_vars['custom_address_details']->value['id_state']))) {?>
                    if ($('#service_id_country') && $('#service_id_state')) {
                        ajaxGetStates(<?php echo $_smarty_tpl->tpl_vars['custom_address_details']->value['id_state'];?>
);
                        $('#service_id_country').change(function() {
                            ajaxGetStates();
                        });
                    }
                <?php }?>
            });
        <?php echo '</script'; ?>
>
    <?php }
}
}
/* {/block "footer"} */
/* {block "after"} */
class Block_6065666768e4f296771f53_77640308 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'after' => 
  array (
    0 => 'Block_6065666768e4f296771f53_77640308',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
 type="text/javascript">
    changeCMSActivationAuthorization();
    changeOverbookingOrderAction();
    changeStandardProductAddressType();
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block "after"} */
}
