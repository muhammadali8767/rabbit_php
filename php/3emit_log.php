<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$message  = json_encode([
    "ETP_ID" => 4,
    "REQUEST_ID" => 5,
    "METHOD_NAME" => "QUERY_ORGAN",
    "PAYLOAD" => [
        "INN" => "231456987"
    ]
]);

$msg = new AMQPMessage($message);
$connection_out = new AMQPStreamConnection("195.158.8.89", 5672, "transbuild", "Crust-Ammonium-Batboy-Comfort-Skewed", "/");
$channel = $connection_out->channel();
$channel->basic_publish($msg, 'common', 'isugf.request');
$channel->close();
$connection_out->close();

echo ' [x] Sent ', $message, "\n";









// $msg = new AMQPMessage($message);
// $connection = new AMQPStreamConnection("195.158.8.89", 5672, "transbuild", "Crust-Ammonium-Batboy-Comfort-Skewed", "/");
// $channel = $connection->channel();
// $connection_out = new AMQPStreamConnection("195.158.8.89", 5672, 'enkt', '123456789', "/");

// $channel->exchange_declare('common', 'topic', false, false, false);

// $channel->basic_publish($msg, 'enkt_broadcast');

// $msg = new AMQPMessage($data);

// $channel->basic_publish($msg, 'logs');

// echo ' [x] Sent ', $data, "\n";

// $channel->close();
// $connection->close();
