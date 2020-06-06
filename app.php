#!/usr/bin/php
<?php
include __DIR__ . '/vendor/autoload.php';
$config = include __DIR__ . '/config.php';

use Calcinai\PHPi\Pin\PinFunction;
use React\EventLoop\Factory;

$loop = Factory::create();
$board = \Calcinai\PHPi\Factory::create($loop);
$pin = $board->getPin(21);
$pin->setFunction(PinFunction::INPUT);

$data = [
    'text' => 'Sie haben Post!',
    'chat_id' => $config['telegram']['chat_id']
];

$token = $config['telegram']['token'];

$state = 1;
$loop->addPeriodicTimer(0.1, function () use ($pin, &$state, $token, $data) {
    if ($pin->getLevel() !== $state) {
        $state = $pin->getLevel();
        if ($state) {
            file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));
        }
    }
});

$loop->run();
