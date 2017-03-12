<?php /* Smarty version Smarty-3.1.13, created on 2015-02-03 14:27:54
         compiled from "application/views/snippets/field.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6701888954d0ccda2cb265-82321762%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cbddadfb59ab2a9d9becd5dfc22976352544eecd' => 
    array (
      0 => 'application/views/snippets/field.tpl',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6701888954d0ccda2cb265-82321762',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'f' => 0,
    'ismobile' => 0,
    'name' => 0,
    'value' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d0ccda448249_36220592',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d0ccda448249_36220592')) {function content_54d0ccda448249_36220592($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['f']->value->type=="time"){?>
    <?php if ($_smarty_tpl->tpl_vars['ismobile']->value){?>
        <p class="s2">
            <?php echo $_smarty_tpl->tpl_vars['f']->value->title;?>
 <br />
            <input class="time" type="number" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['f']->value->name;?>
][]" size="2" value="<?php if ($_smarty_tpl->tpl_vars['value']->value){?><?php echo floor(($_smarty_tpl->tpl_vars['value']->value->{$_smarty_tpl->tpl_vars['f']->value->name}/3600));?>
<?php }else{ ?>00<?php }?>" style="text-align: center;" /> :
            <input class="time" type="number" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['f']->value->name;?>
][]" size="2" value="<?php if ($_smarty_tpl->tpl_vars['value']->value){?><?php echo floor(($_smarty_tpl->tpl_vars['value']->value->{$_smarty_tpl->tpl_vars['f']->value->name}%3600/60));?>
<?php }else{ ?>00<?php }?>" style="text-align: center;" /> :
            <input class="time" type="number" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['f']->value->name;?>
][]" size="2" value="<?php if ($_smarty_tpl->tpl_vars['value']->value){?><?php echo $_smarty_tpl->tpl_vars['value']->value->{$_smarty_tpl->tpl_vars['f']->value->name}%60;?>
<?php }else{ ?>00<?php }?>" style="text-align: center;" />
        </p>
    <?php }else{ ?>
        <p class="s2">
            <?php echo $_smarty_tpl->tpl_vars['f']->value->title;?>
 <br />
            <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['f']->value->name;?>
][]" size="2" value="<?php if ($_smarty_tpl->tpl_vars['value']->value){?><?php echo floor(($_smarty_tpl->tpl_vars['value']->value->{$_smarty_tpl->tpl_vars['f']->value->name}/3600));?>
<?php }else{ ?>00<?php }?>" style="text-align: center;" /> :
            <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['f']->value->name;?>
][]" size="2" value="<?php if ($_smarty_tpl->tpl_vars['value']->value){?><?php echo floor(($_smarty_tpl->tpl_vars['value']->value->{$_smarty_tpl->tpl_vars['f']->value->name}%3600/60));?>
<?php }else{ ?>00<?php }?>" style="text-align: center;" /> :
            <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['f']->value->name;?>
][]" size="2" value="<?php if ($_smarty_tpl->tpl_vars['value']->value){?><?php echo $_smarty_tpl->tpl_vars['value']->value->{$_smarty_tpl->tpl_vars['f']->value->name}%60;?>
<?php }else{ ?>00<?php }?>" style="text-align: center;" />
        </p>   
    <?php }?>

<?php }elseif($_smarty_tpl->tpl_vars['f']->value->type=="select"){?>
    <p class="s2">
        <?php echo $_smarty_tpl->tpl_vars['f']->value->title;?>
 <br />
        <select name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['f']->value->name;?>
]">
            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['f']->value->values; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value->key;?>
"<?php if ((($_smarty_tpl->tpl_vars['value']->value&&$_smarty_tpl->tpl_vars['v']->value->key==$_smarty_tpl->tpl_vars['value']->value->{$_smarty_tpl->tpl_vars['f']->value->name})||(!$_smarty_tpl->tpl_vars['value']->value&&isset($_smarty_tpl->tpl_vars['v']->value->default)))){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value->val;?>
</option>
            <?php } ?>
        </select>
    </p>
<?php }elseif($_smarty_tpl->tpl_vars['f']->value->type=="amount"){?>

    <p class="s1">
        <?php echo $_smarty_tpl->tpl_vars['f']->value->title;?>
 <br />
        <input type="number" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['f']->value->name;?>
]"<?php if ($_smarty_tpl->tpl_vars['value']->value){?> value="<?php echo $_smarty_tpl->tpl_vars['value']->value->{$_smarty_tpl->tpl_vars['f']->value->name};?>
"<?php }?> />
    </p>



<?php }elseif($_smarty_tpl->tpl_vars['f']->value->type=="text"){?>
    <p class="s4">
        <?php echo $_smarty_tpl->tpl_vars['f']->value->title;?>
 <br />
        <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['f']->value->name;?>
]"<?php if ($_smarty_tpl->tpl_vars['value']->value){?> value="<?php echo $_smarty_tpl->tpl_vars['value']->value->{$_smarty_tpl->tpl_vars['f']->value->name};?>
"<?php }?> />
    </p>

<?php }elseif($_smarty_tpl->tpl_vars['f']->value->type=="textarea"){?>
    <p class="s4">
        <?php echo $_smarty_tpl->tpl_vars['f']->value->title;?>
 <br />
        <textarea type="text" id="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['f']->value->name;?>
]" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['f']->value->name;?>
]" rows="3" ><?php if ($_smarty_tpl->tpl_vars['value']->value){?><?php echo $_smarty_tpl->tpl_vars['value']->value->{$_smarty_tpl->tpl_vars['f']->value->name};?>
<?php }?></textarea>
    </p>
<?php }?><?php }} ?>