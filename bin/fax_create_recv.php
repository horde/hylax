#!/usr/bin/env php
<?php

use Horde\Argv\Parser;

require_once __DIR__ . '/../lib/Application.php';
$hylax = Horde_Registry::appInit('hylax', array('cli' => true));

/* Create the fax information array. Set fax_type to 0 for incoming. */
$info = array('fax_type' => 0,
              'fax_user' => '');

/* Parse arguments using Horde\Argv\Parser for positional arguments */
$parser = new Parser([
    'usage' => '%prog <fax_id> <filename>',
    'description' => 'Create incoming fax record in Hylax storage'
]);

list($opts, $args) = $parser->parseArgs();

if (count($args) >= 1) {
    $info['fax_id'] = $args[0];
}
if (count($args) >= 2) {
    $file = $args[1];
    $info['job_id'] = (int)substr($file, 9, -4);
}

$fax_info = $cli->readStdin();
$fax_info = explode("\n", $fax_info);
foreach ($fax_info as $line) {
    $line = trim($line);
    if (preg_match('/Pages: (\d+)/', $line, $matches)) {
        $info['fax_pages'] = $matches[1];
    } elseif (preg_match('/Sender: (.+)/', $line, $matches)) {
        $info['fax_number'] = $matches[1];
    } elseif (preg_match('/Received: (\d{4}):(\d{2}):(\d{2}) (\d{2}):(\d{2}):(\d{2})/', $line, $d)) {
        $time = mktime($d[4], $d[5], $d[6], $d[2], $d[3], $d[1]);
        $info['fax_created'] = $time;
    }
}

$t = $hylax_storage->createFax($info, true);
var_dump($t);
