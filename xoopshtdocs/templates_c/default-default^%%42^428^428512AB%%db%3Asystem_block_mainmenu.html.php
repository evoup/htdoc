<?php /* Smarty version 2.6.18, created on 2008-02-28 20:13:25
         compiled from db:system_block_mainmenu.html */ ?>
<table cellspacing="0">
  <tr>
    <td id="mainmenu">
      <a class="menuTop" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/"><?php echo $this->_tpl_vars['block']['lang_home']; ?>
</a>
      <!-- start module menu loop -->
      <?php $_from = $this->_tpl_vars['block']['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module']):
?>
      <a class="menuMain" href="<?php echo $this->_tpl_vars['xoops_url']; ?>
/modules/<?php echo $this->_tpl_vars['module']['directory']; ?>
/"><?php echo $this->_tpl_vars['module']['name']; ?>
</a>
        <?php $_from = $this->_tpl_vars['module']['sublinks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sublink']):
?>
          <a class="menuSub" href="<?php echo $this->_tpl_vars['sublink']['url']; ?>
"><?php echo $this->_tpl_vars['sublink']['name']; ?>
</a>
        <?php endforeach; endif; unset($_from); ?>
      <?php endforeach; endif; unset($_from); ?>
      <!-- end module menu loop -->
    </td>
  </tr>
</table>