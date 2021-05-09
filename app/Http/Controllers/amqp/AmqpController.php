<?php

namespace App\Http\Controllers\amqp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;
class AmqpController extends Controller
{
    public function send(){
       require_once app_path("amqp/config.php");
        $exchange = 'router';
        $queue = 'msgs';
        $connection = new AMQPStreamConnection(HOST, PORT, USER, PASS, VHOST);
        $channel = $connection->channel();
        $channel->confirm_select();
        $channel->set_ack_handler(
            function (AMQPMessage $message) {
                echo "成功";
            }
        );
        $channel->set_nack_handler(
            function (AMQPMessage $message) {
             echo "提交失败,请重试";
            }
        );

        /*
         * bring the channel into publish confirm mode.
         * if you would call $ch->tx_select() before or after you brought the channel into this mode
         * the next call to $ch->wait() would result in an exception as the publish confirm mode and transactions
         * are mutually exclusive
         */

        /*
            The following code is the same both in the consumer and the producer.
            In this way we are sure we always have a queue to consume from and an
                exchange where to publish messages.
        */

        /*
            name: $queue
            passive: false
            durable: true // the queue will survive server restarts
            exclusive: false // the queue can be accessed in other channels
            auto_delete: false //the queue won't be deleted once the channel is closed.
        */
        $channel->queue_declare($queue, false, true, false, false);

        /*
            name: $exchange
            type: direct
            passive: false
            durable: true // the exchange will survive server restarts
            auto_delete: false //the exchange won't be deleted once the channel is closed.
        */

        $channel->exchange_declare($exchange, AMQPExchangeType::DIRECT, false, true, false);
        $channel->queue_bind($queue, $exchange);
//$messageBody = implode(' ', array_slice($argv, 1));
        $message = new AMQPMessage($_REQUEST["msg"]);
        $channel->basic_publish($message, $exchange);
        $channel->wait_for_pending_acks();
        $channel->close();
        $connection->close();


    }
}
