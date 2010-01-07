<?php
/**
 * The Hylax script to show a fax view.
 *
 * See the enclosed file COPYING for license information (GPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * $Horde: incubator/hylax/img.php,v 1.4 2009/06/10 05:24:17 slusarz Exp $
 */

@define('AUTH_HANDLER', true);
@define('HYLAX_BASE', dirname(__FILE__));
require_once HYLAX_BASE . '/lib/base.php';

$fax_id = Horde_Util::getFormData('fax_id');
$page = Horde_Util::getFormData('page');
$preview = Horde_Util::getFormData('preview');

/* Set up the cache object. */
require_once 'Horde/Cache.php';
$cache = &Horde_Cache::singleton($conf['cache']['driver'], Horde::getDriverConfig('cache', $conf['cache']['driver']));
if (is_a($cache, 'PEAR_Error')) {
    Horde::fatal($cache, __FILE__, __LINE__);
}

/* Call the get the image data using cache. */
$id = $fax_id . '_' . $page . ($preview ? '_p' : '');
$image = $cache->getOutput($id, "Hylax::getImage('$fax_id', '$page', '$preview');", 86400);

header('Content-type: image/png');
echo $image;