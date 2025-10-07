<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:31
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\_partials\order-extra-services.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f293521611_67369462',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b7f59b7c6263493cfa3f780087003740effdb830' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\_partials\\order-extra-services.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f293521611_67369462 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_136364907968e4f293246c67_72105366', 'order_extra_services');
?>

<?php }
/* {block 'order_extra_services_tabs'} */
class Block_186840035168e4f29326e701_24634550 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <ul class="nav nav-tabs">
                        <?php if ((isset($_smarty_tpl->tpl_vars['additionalServices']->value)) && $_smarty_tpl->tpl_vars['additionalServices']->value) {?>
                            <li class="active"><a href="#room_type_service_product_desc" data-toggle="tab"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Services'),$_smarty_tpl ) );?>
</a></li>
                        <?php }?>
                        <?php if ((isset($_smarty_tpl->tpl_vars['extraDemands']->value)) && $_smarty_tpl->tpl_vars['extraDemands']->value) {?>
                            <li <?php if (!(isset($_smarty_tpl->tpl_vars['additionalServices']->value)) || !$_smarty_tpl->tpl_vars['additionalServices']->value) {?> class="active" <?php }?>><a href="#room_type_demands_desc" data-toggle="tab"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Facilities'),$_smarty_tpl ) );?>
</a></li>
                        <?php }?>
                    </ul>
                <?php
}
}
/* {/block 'order_extra_services_tabs'} */
/* {block 'order_extra_services_tab_content'} */
class Block_182631620968e4f2932a7971_87492503 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                            <?php if ((isset($_smarty_tpl->tpl_vars['additionalServices']->value)) && $_smarty_tpl->tpl_vars['additionalServices']->value) {?>
                                <div id="room_type_service_product_desc" class="tab-pane <?php if ((isset($_smarty_tpl->tpl_vars['additionalServices']->value)) && $_smarty_tpl->tpl_vars['additionalServices']->value) {?>active<?php }?>">
                                    <?php $_smarty_tpl->_assignInScope('roomCount', 1);?>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['additionalServices']->value, 'roomAdditionalService', false, 'key');
$_smarty_tpl->tpl_vars['roomAdditionalService']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['roomAdditionalService']->value) {
$_smarty_tpl->tpl_vars['roomAdditionalService']->do_else = false;
?>
                                        <div class="room_demands">
                                            <div class="demand_header">
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room'),$_smarty_tpl ) );?>
 <?php echo sprintf('%02d',$_smarty_tpl->tpl_vars['roomCount']->value);?>
&nbsp;
                                                <span>(<?php ob_start();
echo $_smarty_tpl->tpl_vars['roomAdditionalService']->value['adults'];
$_prefixVariable84 = ob_get_clean();
if ($_prefixVariable84 <= 9) {?>0<?php echo $_smarty_tpl->tpl_vars['roomAdditionalService']->value['adults'];
} else {
echo $_smarty_tpl->tpl_vars['roomAdditionalService']->value['adults'];
}?> <?php if ($_smarty_tpl->tpl_vars['roomAdditionalService']->value['adults'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adult'),$_smarty_tpl ) );
}
if ($_smarty_tpl->tpl_vars['roomAdditionalService']->value['children'] > 0) {?>, <?php ob_start();
echo $_smarty_tpl->tpl_vars['roomAdditionalService']->value['children'];
$_prefixVariable85 = ob_get_clean();
if ($_prefixVariable85 <= 9) {?>0<?php echo $_smarty_tpl->tpl_vars['roomAdditionalService']->value['children'];
} else {
echo $_smarty_tpl->tpl_vars['roomAdditionalService']->value['children'];
}?> <?php if ($_smarty_tpl->tpl_vars['roomAdditionalService']->value['children'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child'),$_smarty_tpl ) );
}
}?>)</span>
                                            </div>
                                            <div class="room_demand_detail">
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['roomAdditionalService']->value['additional_services'], 'additionalService');
$_smarty_tpl->tpl_vars['additionalService']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['additionalService']->value) {
$_smarty_tpl->tpl_vars['additionalService']->do_else = false;
?>
                                                    <div class="room_demand_block">
                                                        <div class="">
                                                            <div class="">
                                                                <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['additionalService']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

                                                                <?php if ($_smarty_tpl->tpl_vars['additionalService']->value['allow_multiple_quantity']) {?>
                                                                    <span class="quantity"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Quantity: %s)','sprintf'=>array(sprintf('%02d',$_smarty_tpl->tpl_vars['additionalService']->value['quantity']))),$_smarty_tpl ) );?>
</span>
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <span>
                                                                <?php if ($_smarty_tpl->tpl_vars['useTax']->value) {?>
                                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>htmlspecialchars((string)$_smarty_tpl->tpl_vars['additionalService']->value['total_price_tax_incl'], ENT_QUOTES, 'UTF-8', true),'currency'=>$_smarty_tpl->tpl_vars['objOrder']->value->id_currency),$_smarty_tpl ) );?>

                                                                <?php } else { ?>
                                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>htmlspecialchars((string)$_smarty_tpl->tpl_vars['additionalService']->value['total_price_tax_excl'], ENT_QUOTES, 'UTF-8', true),'currency'=>$_smarty_tpl->tpl_vars['objOrder']->value->id_currency),$_smarty_tpl ) );?>

                                                                <?php }?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            </div>
                                        </div>
                                        <?php $_smarty_tpl->_assignInScope('roomCount', $_smarty_tpl->tpl_vars['roomCount']->value+1);?>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </div>
                            <?php }?>
                        <?php
}
}
/* {/block 'order_extra_services_tab_content'} */
/* {block 'order_extra_demands_tab_content'} */
class Block_23918856668e4f2933d80b4_51521011 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                            <?php if ((isset($_smarty_tpl->tpl_vars['extraDemands']->value)) && $_smarty_tpl->tpl_vars['extraDemands']->value) {?>
                                <div id="room_type_demands_desc" class="tab-pane <?php if (!(isset($_smarty_tpl->tpl_vars['additionalServices']->value)) || !$_smarty_tpl->tpl_vars['additionalServices']->value) {?>active<?php }?>">
                                    <?php $_smarty_tpl->_assignInScope('roomCount', 1);?>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['extraDemands']->value, 'roomDemand');
$_smarty_tpl->tpl_vars['roomDemand']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['roomDemand']->value) {
$_smarty_tpl->tpl_vars['roomDemand']->do_else = false;
?>
                                        <div class="room_demands">
                                            <div class="demand_header">
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room'),$_smarty_tpl ) );?>
 <?php echo sprintf('%02d',$_smarty_tpl->tpl_vars['roomCount']->value);?>
&nbsp;
                                                <span>(<?php ob_start();
echo $_smarty_tpl->tpl_vars['roomDemand']->value['adults'];
$_prefixVariable86 = ob_get_clean();
if ($_prefixVariable86 <= 9) {?>0<?php echo $_smarty_tpl->tpl_vars['roomDemand']->value['adults'];
} else {
echo $_smarty_tpl->tpl_vars['roomDemand']->value['adults'];
}?> <?php if ($_smarty_tpl->tpl_vars['roomDemand']->value['adults'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adult'),$_smarty_tpl ) );
}
if ($_smarty_tpl->tpl_vars['roomDemand']->value['children'] > 0) {?>, <?php ob_start();
echo $_smarty_tpl->tpl_vars['roomDemand']->value['children'];
$_prefixVariable87 = ob_get_clean();
if ($_prefixVariable87 <= 9) {?>0<?php echo $_smarty_tpl->tpl_vars['roomDemand']->value['children'];
} else {
echo $_smarty_tpl->tpl_vars['roomDemand']->value['children'];
}?> <?php if ($_smarty_tpl->tpl_vars['roomDemand']->value['children'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child'),$_smarty_tpl ) );
}
}?>)</span>
                                            </div>
                                            <div class="room_demand_detail">
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['roomDemand']->value['extra_demands'], 'demand');
$_smarty_tpl->tpl_vars['demand']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['demand']->value) {
$_smarty_tpl->tpl_vars['demand']->do_else = false;
?>
                                                    <div class="room_demand_block">
                                                        <div class=""><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['demand']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                                                        <div class="">
                                                            <span>
                                                                <?php if ($_smarty_tpl->tpl_vars['useTax']->value) {?>
                                                                    <?php ob_start();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['demand']->value['total_price_tax_incl'], ENT_QUOTES, 'UTF-8', true);
$_prefixVariable88=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_prefixVariable88,'currency'=>$_smarty_tpl->tpl_vars['objOrder']->value->id_currency),$_smarty_tpl ) );?>

                                                                <?php } else { ?>
                                                                    <?php ob_start();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['demand']->value['total_price_tax_excl'], ENT_QUOTES, 'UTF-8', true);
$_prefixVariable89=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_prefixVariable89,'currency'=>$_smarty_tpl->tpl_vars['objOrder']->value->id_currency),$_smarty_tpl ) );?>

                                                                <?php }?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            </div>
                                        </div>
                                        <?php $_smarty_tpl->_assignInScope('roomCount', $_smarty_tpl->tpl_vars['roomCount']->value+1);?>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </div>
                                </div>
                            <?php }?>
                        <?php
}
}
/* {/block 'order_extra_demands_tab_content'} */
/* {block 'order_extra_services_tabs_content'} */
class Block_28887798968e4f29329c461_65537671 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <div class="tab-content">
                        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_182631620968e4f2932a7971_87492503', 'order_extra_services_tab_content', $this->tplIndex);
?>


                        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_23918856668e4f2933d80b4_51521011', 'order_extra_demands_tab_content', $this->tplIndex);
?>

                    </div>
                <?php
}
}
/* {/block 'order_extra_services_tabs_content'} */
/* {block 'order_extra_services'} */
class Block_136364907968e4f293246c67_72105366 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_extra_services' => 
  array (
    0 => 'Block_136364907968e4f293246c67_72105366',
  ),
  'order_extra_services_tabs' => 
  array (
    0 => 'Block_186840035168e4f29326e701_24634550',
  ),
  'order_extra_services_tabs_content' => 
  array (
    0 => 'Block_28887798968e4f29329c461_65537671',
  ),
  'order_extra_services_tab_content' => 
  array (
    0 => 'Block_182631620968e4f2932a7971_87492503',
  ),
  'order_extra_demands_tab_content' => 
  array (
    0 => 'Block_23918856668e4f2933d80b4_51521011',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="card">
        <div class="card-header">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Extra Services'),$_smarty_tpl ) );?>

        </div>
        <div class="card-body">
            <?php if (((isset($_smarty_tpl->tpl_vars['extraDemands']->value)) && $_smarty_tpl->tpl_vars['extraDemands']->value) || ((isset($_smarty_tpl->tpl_vars['additionalServices']->value)) && $_smarty_tpl->tpl_vars['additionalServices']->value)) {?>
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_186840035168e4f29326e701_24634550', 'order_extra_services_tabs', $this->tplIndex);
?>

                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_28887798968e4f29329c461_65537671', 'order_extra_services_tabs_content', $this->tplIndex);
?>

            <?php }?>
        </div>
    </div>
<?php
}
}
/* {/block 'order_extra_services'} */
}
