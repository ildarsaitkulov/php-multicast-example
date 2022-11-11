<?php
require_once __DIR__ . '/vendor/autoload.php';


class server
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

    public function run()
    {
        $socket = $this->factory->createSender();

        $this->loop->addPeriodicTimer(3, function () use ($socket) {
            $socket->send('hello!', $this->address);
        });

    }
}

$server = new server('224.10.20.30:4050');
$server->run();


