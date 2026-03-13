#!/usr/bin/env php
<?php

use Horde\Argv\Parser;

require_once __DIR__ . '/../lib/Application.php';
$hylax = Horde_Registry::appInit('hylax', array('cli' => true));

/* Parse arguments using Horde\Argv\Parser for positional arguments */
$parser = new Parser([
    'usage' => '%prog <filename>',
    'description' => 'Save incoming fax data to Hylax storage'
]);

list($opts, $args) = $parser->parseArgs();

/* Get the filename from which the job ID is obtained, in the format 'recvq/faxNNNNN.tif'. */
if (count($args) >= 1) {
    $file = $args[0];
    $job_id = (int)substr($file, 9, -4);
}

/* Store the raw fax postscript data. */
$data = $cli->readStdin();
if (empty($data)) {
    Horde::log('No print data received from standard input. Exiting fax submission.', 'ERR');
    exit;
}

/* Get the file and store into VFS. */
$fax_id = $hylax->storage->saveFaxData($data, '.ps');
if (is_a($fax_id, 'PEAR_Error')) {
    echo '0';
    exit;
}
Horde::log(sprintf('Creating fax ID %s for received fax.', $fax_id), 'DEBUG');
echo $fax_id;
