<?php

declare(strict_types=1);

use Theatrical\Invoice;
use Theatrical\Performance;
use Theatrical\Performances;
use Theatrical\Play;

require_once __DIR__ . '/vendor/autoload.php';

$plays = [
    'hamlet' => Play::create('Hamlet', 'tragedy'),
    'as-like' => Play::create('As You Like It', 'comedy'),
    'othello' => Play::create('Othello', 'tragedy'),
];
$performances = [
    new Performance('hamlet', 55),
    new Performance('as-like', 35),
    new Performance('othello', 40),
];
$invoice = new Invoice(customer: 'BigCo', performances: new Performances($performances));
echo '<h1>Html Statement</h1>';
// Uncomment the following two line once the HtmlStatement Class is written (Ch.1 page 31)
//$statementPrinter = new HtmlStatement();
//echo  $statementPrinter->print($invoice, $plays);
