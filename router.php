<?php
/* ===========================================================================
 * Copyright 2018-2019 Zindex Software
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================================ */

/*
 * Use this file with the PHP's built in server.
 * Just type the following command and point your browser to http://localhost:8080/
 *
 * php - S localhost:8080 -t public router.php
 */

$path = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($path, '?')) {
    $len = strlen($path);
    $path = substr($path, 0, $len - ($len - $pos));
}

$path = urldecode($path);

$assetsPaths = [
    '/assets/' => __DIR__ . $path,
];

foreach ($assetsPaths as $assetPath => $assetFile) {
    if (strpos($path, $assetPath) === 0 && file_exists($assetFile) && is_file($assetFile)) {
        $mime = get_mime_types();
        $ext = pathinfo($assetFile, PATHINFO_EXTENSION);
        $contentType = $mime[$ext] ?? 'application/octet-stream';
        header('Content-Type: ' . $contentType);
        readfile($assetFile);
        return;
    }
}

$file = $_SERVER['DOCUMENT_ROOT'] . $path;

if (file_exists($file) && is_file($file)) {
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    if (supported_extension($ext)) {
        return false;
    }
    $mime = get_mime_types();
    header('Content-Type: ' . ($mime[$ext] ?? 'application/octet-stream'));
    readfile($file);
    return;
}

require __DIR__ . '/public/index.php';

function get_mime_types()
{
    static $types = [
        'aac' => 'audio/aac',
        'abw' => 'application/x-abiword',
        'arc' => 'application/x-freearc',
        'avi' => 'video/x-msvideo',
        'azw' => 'application/vnd.amazon.ebook',
        'bin' => 'application/octet-stream',
        'bmp' => 'image/bmp',
        'bz' => 'application/x-bzip',
        'bz2' => 'application/x-bzip2',
        'csh' => 'application/x-csh',
        'css' => 'text/css',
        'csv' => 'text/csv',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'eot' => 'application/vnd.ms-fontobject',
        'epub' => 'application/epub+zip',
        'gz' => 'application/gzip',
        'gif' => 'image/gif',
        'htm' => 'text/html',
        'html' => 'text/html',
        'ico' => 'image/vnd.microsoft.icon',
        'ics' => 'text/calendar',
        'jar' => 'application/java-archive',
        'jpeg' => 'image/jpeg',
        'js' => 'text/javascript',
        'json' => 'application/json',
        'jsonld' => 'application/ld+json',
        'mid' => 'audio/midi',
        'mjs' => 'text/javascript',
        'mp3' => 'audio/mpeg',
        'mpeg' => 'video/mpeg',
        'mpkg' => 'application/vnd.apple.installer+xml',
        'odp' => 'application/vnd.oasis.opendocument.presentation',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        'odt' => 'application/vnd.oasis.opendocument.text',
        'oga' => 'audio/ogg',
        'ogv' => 'video/ogg',
        'ogx' => 'application/ogg',
        'otf' => 'font/otf',
        'png' => 'image/png',
        'pdf' => 'application/pdf',
        'php' => 'appliction/php',
        'ppt' => 'application/vnd.ms-powerpoint',
        'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'rar' => 'application/x-rar-compressed',
        'rtf' => 'application/rtf',
        'sh' => 'application/x-sh',
        'svg' => 'image/svg+xml',
        'swf' => 'application/x-shockwave-flash',
        'tar' => 'application/x-tar',
        'tif' => 'image/tiff',
        'tiff' => 'image/tiff',
        'ts' => 'video/mp2t',
        'ttf' => 'font/ttf',
        'txt' => 'text/plain',
        'vsd' => 'application/vnd.visio',
        'wav' => 'audio/wav',
        'weba' => 'audio/webm',
        'webm' => 'video/webm',
        'webp' => 'image/webp',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'xhtml' => 'application/xhtml+xml',
        'xls' => 'application/vnd.ms-excel',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'xml' => 'application/xml ',
        'xul' => 'application/vnd.mozilla.xul+xml',
        'zip' => 'application/zip',
        '3gp' => 'video/3gpp',
        '3g2' => 'video/3gpp2',
        '7z' => 'application/x-7z-compressed',
    ];

    return $types;
}

function supported_extension($ext)
{
    static $extensions = [
        'xml', 'xsl', 'xsd', '3gp', 'apk', 'avi', 'bmp', 'csv', 'doc', 'docx', 'flac', 'gz', 'gzip', 'ics', 'kml',
        'kmz', 'm4a', 'mp3', 'mp4', 'mpg', 'mpeg', 'mov', 'odp', 'ods', 'odt', 'oga', 'pdf', 'pptx', 'pps', 'qt',
        'swf', 'tar', 'text', 'tif', 'wav', 'wmv', 'xls', 'xlsx', 'zip', 'ogg', 'ogv', 'webm', 'htm', 'svg',
    ];
    return in_array($ext, $extensions);
}
