<div id="menu">
 <?php echo $this->menu ?>
</div>
<br />

<?php echo $this->notify ?>

<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr class="header">
    <td class="header">
      <?php echo _("Summary") ?>
    </td>
  </tr>
</table>
<br />
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td class="smallheader" width="50%">
      <?php echo _("New faxes") ?> <strong><?php echo $this->in_faxes ?></strong>
    </td><td class="smallheader" width="50%">
      <?php echo _("Faxes waiting to be sent") ?> <strong><?php echo $this->out_faxes ?></strong>
    </td>
  </tr><tr>
    <td>
<?php if (!empty($this->inbox)): ?>
      <table width="100%" border="0" cellpadding="2" cellspacing="1">
<?php foreach ($this->inbox as $item): ?>
        <tr>
          <td>
          </td><td>
            <?php echo $item['owner'] ?>
          </td>
        </tr>
<?php endforeach ?>
      </table>
<?php endif ?>
    </td><td>
<?php if (!empty($this->outbox)): ?>
      <table width="100%" border="0" cellpadding="2" cellspacing="1">
<?php foreach ($this->outbox as $item): ?>
        <tr class="item">
          <td>
          </td><td>
            <?php echo $item['owner'] ?>
          </td>
        </tr>
<?php endforeach ?>
      </table>
<?php endif ?>
    </td>
  </tr>
</table>
