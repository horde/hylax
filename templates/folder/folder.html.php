<div id="menu">
 <?php echo $this->menu ?>
</div>
<br />

<?php echo $this->notify ?>

<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr class="header">
    <td class="header">
      <?php echo _("Folder:") ?> <?php echo $this->folder_name ?>
    </td><td align="right">
      <?php echo implode(' | ', $this->actions) ?>
    </td>
  </tr>
</table>
<br />
<table width="100%" border="0" cellpadding="2" cellspacing="1">
  <tr class="smallheader" align="center">
    <td width="%1">
      &nbsp;
    </td><td>
      <?php echo _("Date") ?>
    </td><td>
      <?php echo _("Number") ?>
    </td><td>
      <?php echo _("Owner") ?>
    </td><td>
      <?php echo _("Pages") ?>
    </td><td>
      <?php echo _("Status") ?>
    </td>
  </tr>
<?php if (!empty($this->folder)): ?>
<?php foreach ($this->folder as $item): ?>
  <tr class="item<?php echo $item['alt_count'] ?>" onmouseover="className='selected-hi';" onmouseout="className='item<?php echo $item['alt_count'] ?>';">
    <td nowrap="nowrap">
      <?php foreach ($item['actions'] as $action): ?><?php echo $action ?>&nbsp;<?php endforeach ?>
    </td><td>
      <?php echo $item['fax_created'] ?>
    </td><td>
      <?php echo $item['fax_number'] ?>
    </td><td>
      <?php echo $item['fax_user'] ?>
    </td><td align="center">
      <?php echo $item['fax_pages'] ?>
    </td><td>
      <?php echo $item['fax_status'] ?>
    </td>
  </tr>
<?php endforeach ?>
<?php else: ?>
  <tr>
    <td colspan="9" align="center" class="item">
      <?php echo _("No entries") ?>
    </td>
  </tr>
<?php endif ?>
</table>
