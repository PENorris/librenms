<?php

/*
 * LibreNMS
 *
 * Copyright (c) 2014 Neil Lathwood <https://github.com/laf/ http://www.lathwood.co.uk/fa>
 *
 * This program is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.  Please see LICENSE.txt at the top level of
 * the source code distribution for details.
 */
header('Content-type: text/plain');

if (is_admin() === false) {
    die('ERROR: You need to be admin');
}

if ($_POST['state'] == 'true') {
    $state = 1;
} elseif ($_POST['state'] == 'false') {
    $state = 0;
} else {
    $state = 0;
}

if (dbUpdate(array('value' => $state), 'callback', '`name` = "enabled"', array()) == 0) {
    dbInsert(array('value' => $state,'name' => 'enabled'), 'callback');
}
