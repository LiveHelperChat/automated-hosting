<?php
//
// Definition of  class
//
// Created on: <07-Jul-2003 10:06:19 wy>
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ Publish
// SOFTWARE RELEASE: 4.4.0
// COPYRIGHT NOTICE: Copyright (C) 1999-2010 eZ Systems AS
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

/*! \file
*/

// php cron.php -s site_admin -e instance -c cron/update_counter

set_time_limit( 0 );

echo  "Update content view count...\n";


$year = date('Y');
$month = date( 'M', time() );
$day = date('d');
$hour = date('H');
$minute = date('i');
$second = date('s');
$startTime = $day . "/" . $month . "/" . $year . ":" . $hour . ":" . $minute . ":" . $second;



$nodeIDArray = array();
$pathArray = array();
$contentArray = array();
$nonContentArray = array();

$updateViewLog = "updateview.log";

$startLine = "";
$hasStartLine = false;

$updateViewLogPath = "extension/instance/doc/" . $updateViewLog;
if ( is_file( $updateViewLogPath ) )
{
    $fh = fopen( $updateViewLogPath, "r" );
    if ( $fh )
    {
        while ( !feof ( $fh ) )
        {
            $line = fgets( $fh, 1024 );
            if ( preg_match( "/\[/", $line ) )
            {
                $startLine = $line;
                $hasStartLine = true;
            }
        }
        fclose( $fh );
    }
}

echo "Start line:\n" . $startLine;
$lastLine = "";
$logFilePath = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'access_log_path');

$partsHost = array();

if ( is_file( $logFilePath ) )
{
    $handle = fopen( $logFilePath, "r" );
    if ( $handle )
    {
        $startParse = false;
        $stopParse = false;
        while ( !feof ($handle) and !$stopParse )
        {
            $line = fgets($handle, 1024);
            if ( !empty( $line ) )
            {
                if ( $line != "" )
                    $lastLine = $line;

                if ( $startParse or !$hasStartLine )
                {
                    $logPartArray = preg_split( "/[\"]+/", $line );
                    $timeIPPart = $logPartArray[0];

                    if (strpos($timeIPPart, '[') === false) {
                        continue;
                    }

                    list( $ip, $timePart ) = explode( '[', $timeIPPart );

                    $timeParts = explode(' ', $timePart);
                    $time = isset($timeParts[0]) ? $timeParts[0] : '';
                    $rest = isset($timeParts[1]) ? $timeParts[1] : '';

                    if ( $time == $startTime )
                        $stopParse = true;
                    $requirePart = $logPartArray[1];

                    list( $requireMethod, $url ) = explode( ' ', $requirePart );
                    $url = preg_replace( "/\?.*/", "", $url);


                    $parts = explode( ' ', $timeIPPart );
					$address = str_replace('.'.erConfigClassLhConfig::getInstance()->getSetting( 'site', 'seller_domain'), '', $parts[1]);

					if (isset($partsHost[$address])){
						$partsHost[$address]++;
					} else {
						$partsHost[$address] = 1;
					}
                }
                if ( $line == $startLine )
                {
                    $startParse = true;
                }
            }
        }
        fclose( $handle );
    }
    else
    {
        echo "Warning: Cannot open apache log-file '$logFilePath' for reading, please check permissions and try again.\n";
    }
}
else
{
    echo "Warning: apache log-file '$logFilePath' doesn't exist, please check your ini-settings and try again.\n";
}

foreach ($partsHost as $address => $hits) {
	$items = erLhcoreClassModelInstance::getList(array('filter' => array('address' => $address)));
	if (!empty($items)) {
		$host = array_shift($items);
		$host->request -= $hits;
		$host->saveThis();
		echo $host->address,'-',$hits,"\n";
	}
}

$fh = fopen( $updateViewLogPath, "w" );
if ( $fh )
{
    fwrite( $fh, "# Finished at " . date('Y-m-d H:i:s') . "\n" );
    fwrite( $fh, "# Last updated entry:" . "\n" );
    fwrite( $fh, $lastLine . "\n" );
    fclose( $fh );
}

echo "Finished at " . date('Y-m-d H:i:s') . "\n";

?>