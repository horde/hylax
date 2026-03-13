#!/usr/bin/env php
<?php

use Horde\Argv\Parser;

require_once __DIR__ . '/../lib/Application.php';
$hylax = Horde_Registry::appInit('hylax', array('cli' => true));

/* Create the fax information array. Set fax_type to 1 for outgoing. */
$info = array('fax_type' => 1);

/* Parse arguments using Horde\Argv\Parser for positional arguments */
$parser = new Parser([
    'usage' => '%prog <fax_id> <user>',
    'description' => 'Create outgoing fax record in Hylax storage'
]);

list($opts, $args) = $parser->parseArgs();

if (count($args) >= 1) {
    $info['fax_id'] = $args[0];
}
if (count($args) >= 2) {
    $info['fax_user'] = $args[1];
}
Horde::log(sprintf('Creating fax ID %s for user %s.', $info['fax_id'], $info['fax_user']), 'DEBUG');

$hylax->storage->createFax($info, true);
