<?php

namespace App\Traits;

use DOMDocument;
use DOMXPath;

trait ExportTrait
{
    public function htmlToText($html): string
    {
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED);
        $xpath = new DOMXPath($dom);
        $text = '';

        foreach ($xpath->query('//text()') as $node) {
            $text .= $node->nodeValue . "\n";
        }

        $text = str_replace(["<br>", "<p>", "</p>"], "\n", $text);
        $text = preg_replace("/\n+/", "\n", $text);
        $text = rtrim($text, "\n");

        return $text;
    }
}
