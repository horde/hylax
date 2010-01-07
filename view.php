<?php
/**
 * The Hylax script to show a fax view.
 *
 * See the enclosed file COPYING for license information (GPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * $Horde: incubator/hylax/view.php,v 1.7 2009/06/10 05:24:18 slusarz Exp $
 */

@define('HYLAX_BASE', dirname(__FILE__));
require_once HYLAX_BASE . '/lib/base.php';

$fax_id = Horde_Util::getFormData('fax_id');
$url = Horde_Util::getFormData('url');
$folder = strtolower(Horde_Util::getFormData('folder'));
$path = Horde_Util::getFormData('path');
$base_folders = Hylax::getBaseFolders();

if (Horde_Util::getFormData('action') == 'download') {
    $filename = sprintf('fax%05d.pdf', $fax_id);
    $browser->downloadHeaders($filename);
    Hylax::getPDF($fax_id);
    exit;
}

$fax = $hylax_storage->getFax($fax_id);
if (is_a($fax, 'PEAR_Error')) {
    $notification->push(sprintf(_("Could not open fax ID \"%s\". %s"), $fax_id, $fax->getMessage()), 'horde.error');
    if (empty($url)) {
        $url = Horde::applicationUrl('folder.php', true);
    }
    header('Location: ' . $url);
    exit;
}

$title = _("View Fax");

/* Get the preview pages. */
$pages = Hylax::getPages($fax_id, $fax['fax_pages']);

/* Set up template. */
$template = &new Horde_Template();
$template->set('form', '');
$template->set('pages', $pages);
$template->set('menu', Hylax::getMenu('string'));
$template->set('notify', Horde_Util::bufferOutput(array($notification, 'notify'), array('listeners' => 'status')));

require HYLAX_TEMPLATES . '/common-header.inc';
echo $template->fetch(HYLAX_TEMPLATES . '/fax/fax.html');
require $registry->get('templates', 'horde') . '/common-footer.inc';