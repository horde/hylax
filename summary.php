<?php
/**
 * The Hylax script to show a summary view.
 *
 * See the enclosed file LICENSE for license information (GPL). If you
 * did not receive this file, see http://www.horde.org/licenses/gpl.
 */

require_once __DIR__ . '/lib/Application.php';
$hylax = Horde_Registry::appInit('hylax');

$fmt_inbox = array();
$inbox = $hylax->gateway->getFolder('inbox');
foreach ($inbox as $item) {
    $fmt_inbox[] = array('owner' => $item[2]);
}

$fmt_outbox = array();
$outbox = $hylax->gateway->getFolder('outbox');
foreach ($outbox as $item) {
    $fmt_outbox[] = array(//'time' => $item
                          'owner' => $item[2],
                          );
}

/* Set up actions. */
$view = new Horde_View(['templatePath' => HYLAX_TEMPLATES . '/summary']);
$view->in_faxes = $hylax->gateway->numFaxesIn();
$view->out_faxes = $hylax->gateway->numFaxesOut();
$view->inbox = $fmt_inbox;
$view->outbox = $fmt_outbox;
$view->menu = Hylax::getMenu('string');

Horde::startBuffer();
$notification->notify(array('listeners' => 'status'));
$view->notify = Horde::endBuffer();

$page_output->header();
echo $view->render('summary');
$page_output->footer();
