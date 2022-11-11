<?php
require_once __DIR__ . '/vendor/autoload.php';

class client
{
    /**
     * @var \React\EventLoop\LoopInterface
     */
    protected $loop;
    /**
     * @var \Clue\React\Multicast\Factory
     */
    protected $factory;
    /**
     * @var string
     */
    private $address;

    public function __construct(string $address)
    {
        $this->loop = \React\EventLoop\Loop::get();

        $this->factory = new Clue\React\Multicast\Factory($this->loop);
        $this->address = $address;
    }

    public function listen()
    {
        $socket = $this->factory->createReceiver($this->address);

        
        $socket->on('message', function ($data, $remote) use ($socket) {
            var_dump($remote);
            echo $data . PHP_EOL;
        });
    }

}

$client = new client('224.10.20.30:4050');
$client->listen();
