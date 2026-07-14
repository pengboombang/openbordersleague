<?php

function loadLeaderboardData(): array
{
    $odsPath = __DIR__ . '/../data/NGO rescues 2025 on.ods';

    if (!class_exists('ZipArchive') || !is_file($odsPath)) {
        return [
            'leaderboard' => [],
            'source' => null,
        ];
    }

    $zip = new ZipArchive();
    if ($zip->open($odsPath) !== true) {
        return [
            'leaderboard' => [],
            'source' => null,
        ];
    }

    $contentXml = $zip->getFromName('content.xml');
    $zip->close();

    if ($contentXml === false || $contentXml === '') {
        return [
            'leaderboard' => [],
            'source' => null,
        ];
    }

    $document = new DOMDocument();
    $previous = libxml_use_internal_errors(true);
    $loaded = $document->loadXML($contentXml);
    libxml_clear_errors();
    libxml_use_internal_errors($previous);

    if (!$loaded) {
        return [
            'leaderboard' => [],
            'source' => null,
        ];
    }

    $xpath = new DOMXPath($document);
    $xpath->registerNamespace('table', 'urn:oasis:names:tc:opendocument:xmlns:table:1.0');
    $xpath->registerNamespace('text', 'urn:oasis:names:tc:opendocument:xmlns:text:1.0');
    $xpath->registerNamespace('office', 'urn:oasis:names:tc:opendocument:xmlns:office:1.0');

    $totals = [];
    $monthlyTotals = [];

    foreach ($xpath->query('//table:table') as $sheet) {
        $sheetName = $sheet->getAttributeNS('urn:oasis:names:tc:opendocument:xmlns:table:1.0', 'name');
        if (!in_array($sheetName, ['2025', '2026'], true)) {
            continue;
        }

        foreach ($xpath->query('./table:table-row', $sheet) as $row) {
            $values = extractOdsRowValues($xpath, $row, 6);
            if ($values === []) {
                continue;
            }

            // Get ISO date from first cell's office:date-value attribute
            $dateCells = $xpath->query('./table:table-cell[1]', $row);
            $dateAttr = $dateCells->length > 0
                ? $dateCells->item(0)->getAttributeNS('urn:oasis:names:tc:opendocument:xmlns:office:1.0', 'date-value')
                : '';

            // Only count rescues from 2026-01-01 onwards (current season)
            if ($dateAttr === '' || $dateAttr < '2026-01-01') {
                continue;
            }

            $yearMonth = substr($dateAttr, 0, 7); // YYYY-MM
            if (!isset($monthlyTotals[$yearMonth])) {
                $monthlyTotals[$yearMonth] = [];
            }

            $date = trim((string) ($values[0] ?? ''));
            $rescued = trim((string) ($values[1] ?? ''));
            $ngoCode = normalizeNgoName(trim((string) ($values[4] ?? '')));
            $ngo = displayNgoName($ngoCode);
            $action = strtolower(trim((string) ($values[5] ?? '')));

            if ($ngoCode === '' || $rescued === '' || !is_numeric($rescued)) {
                continue;
            }

            if ($action !== 'rescue') {
                continue;
            }

            if (!isset($totals[$ngo])) {
                $totals[$ngo] = [
                    'ngo' => $ngo,
                    'ngo_code' => $ngoCode,
                    'rescued' => 0,
                    'last_seen' => $date,
                ];
            }
            if (!isset($monthlyTotals[$yearMonth][$ngo])) {
                $monthlyTotals[$yearMonth][$ngo] = [
                    'ngo' => $ngo,
                    'ngo_code' => $ngoCode,
                    'rescued' => 0,
                    'last_seen' => $date,
                ];
            }

            $totals[$ngo]['rescued'] += (int) $rescued;
            $monthlyTotals[$yearMonth][$ngo]['rescued'] += (int) $rescued;

            if ($date !== '') {
                $totals[$ngo]['last_seen'] = $date;
                $monthlyTotals[$yearMonth][$ngo]['last_seen'] = $date;
            }
        }
    }

    $leaderboard = array_values($totals);
    usort($leaderboard, static function (array $left, array $right): int {
        if ($left['rescued'] === $right['rescued']) {
            return strcmp($left['ngo'], $right['ngo']);
        }

        return $right['rescued'] <=> $left['rescued'];
    });

    foreach ($leaderboard as $index => &$entry) {
        $entry['rank'] = $index + 1;
        $entry['medal'] = $index === 0 ? '🥇' : ($index === 1 ? '🥈' : ($index === 2 ? '🥉' : ''));
        $entry['points'] = $entry['rescued'];
        $entry['website'] = getNgoWebsite($entry['ngo']);
    }
    unset($entry);

    return [
        'leaderboard' => $leaderboard,
        'monthlyTotals' => $monthlyTotals,
        'availableMonths' => array_keys($monthlyTotals),
        'source' => $odsPath,
    ];
}

function extractOdsRowValues(DOMXPath $xpath, DOMElement $row, int $maxColumns): array
{
    $values = [];
    $columnIndex = 0;

    foreach ($row->childNodes as $child) {
        if (!$child instanceof DOMElement) {
            continue;
        }

        $localName = $child->localName;
        if ($localName !== 'table-cell' && $localName !== 'covered-table-cell') {
            continue;
        }

        $repeat = (int) $child->getAttributeNS('urn:oasis:names:tc:opendocument:xmlns:table:1.0', 'number-columns-repeated');
        if ($repeat < 1) {
            $repeat = 1;
        }

        $value = '';
        if ($localName === 'table-cell') {
            $textNodes = [];
            foreach ($xpath->query('.//text:p', $child) as $paragraph) {
                $textNodes[] = trim($paragraph->textContent);
            }
            $value = trim(implode(' ', array_filter($textNodes, static fn($part) => $part !== '')));
        }

        for ($i = 0; $i < $repeat && $columnIndex < $maxColumns; $i++) {
            $values[$columnIndex] = $value;
            $columnIndex++;
        }

        if ($columnIndex >= $maxColumns) {
            break;
        }
    }

    return $values;
}

function normalizeNgoName(string $ngo): string
{
    if ($ngo === '') {
        return '';
    }

    $segments = preg_split('/\s*\+\s*/', $ngo);
    if ($segments === false || $segments === []) {
        return $ngo;
    }

    return trim((string) $segments[0]);
}

function getNgoWebsite(string $ngo): string
{
    static $websites = [
        'Ocean Viking'        => 'https://sosmediterranee.org',
        'Sea-Watch 5'         => 'https://sea-watch.org',
        'Sea-Eye 5'           => 'https://sea-eye.org',
        'Sea-Eye 4'           => 'https://sea-eye.org',
        'Humanity 1'          => 'https://sos-humanity.org',
        'Louise Michel'       => 'https://mvlouisemichel.org/',
        'Aita Mari'           => 'https://www.salvamentohumanitario.eu',
        'Life Support'        => 'https://www.emergency.it',
        'Italian Coast Guard' => 'https://www.guardiacostiera.gov.it',
        'NADIR'               => 'https://resqship.org/',
        'AURORA'              => 'https://sea-watch.org',
        'SOLIDAIRE'           => 'https://solidaire.ong/',
    ];

    return $websites[$ngo] ?? '';
}

function displayNgoName(string $ngo): string
{
    static $aliases = [
        'OV' => 'Ocean Viking',
        'SW5' => 'Sea-Watch 5',
        'SE5' => 'Sea-Eye 5',
        'SE4' => 'Sea-Eye 4',
        'HUM1' => 'Humanity 1',
        'LM' => 'Louise Michel',
        'AM' => 'Aita Mari',
        'SP1' => 'Sea Punk I',
        'TTM3' => 'Trotamar III',
        'ITCG' => 'Italian Coast Guard',
        'LS' => 'Life Support',
    ];

    if ($ngo === '') {
        return '';
    }

    return $aliases[$ngo] ?? $ngo;
}
