<div id="menu">
 <?php echo $this->menu ?>
</div>
<br />

<?php echo $this->notify ?>

<?php echo $this->form ?>
<br />
<table width="100%" border="0" cellpadding="2" cellspacing="1">
  <tr class="smallheader" align="center">
    <td>
      <?php echo _("Pages") ?>
    </td>
  </tr><tr>
    <td class="previewpages">
    <?php foreach ($this->pages as $page): ?><?php echo $page ?>
<?php endforeach ?>
    </td>
  </tr>
</table>
