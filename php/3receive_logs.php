<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$queue_name = "transbuild_in";
// $queue_name = "transbuild_digest";
$connection = new AMQPStreamConnection("195.158.8.89", 5672, "transbuild", "Crust-Ammonium-Batboy-Comfort-Skewed", "/");
$channel = $connection->channel();

// $channel->exchange_declare('common', 'topic', false, false, false);

// $channel->queue_bind($queue_name, 'common');

echo " [*] Waiting for logs. To exit press CTRL+C\n";

$callback = function (AMQPMessage $msg) {
    // echo ' [x] ', $msg->body, "\n";
    print_r($msg);
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}

$channel->close();
$connection->close();


// $connection_in = new AMQPStreamConnection(
//     env('RABBIT_MQ_HOST', 'dev-rabbit.mf.uz'),
//     env('RABBIT_MQ_PORT', 5672),
//     env('RABBIT_MQ_USER', 'enkt'),
//     env('RABBIT_MQ_PASSWORD', '123456789')
// );

// $callback = function (AMQPMessage $msg) {
// print_r($msg);
// }
// $channel->basic_consume(
//     $queue_name,
//     '',
//     false,
//     false,
//     false,
//     false,
//     $callback
// );


// while ($channel_in->is_consuming()) {
//     $channel_in->wait();
// }











?>
