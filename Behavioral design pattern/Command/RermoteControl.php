<?php
interface Command {
    public function execute();
}

class TurnOnCommand implements Command {
    private $device;

    public function __construct($device) {
        $this->device = $device;
    }

    public function execute() {
        $this->device->turnOn();
    }
}

class TurnOffCommand implements Command {
    private $device;

    public function __construct($device) {
        $this->device = $device;
    }

    public function execute() {
        $this->device->turnOff();
    }
}

class Television {
    public function turnOn() {
        echo "Television is ON\n";
    }

    public function turnOff() {
        echo "Television is OFF\n";
    }
}

class StereoSystem {
    public function turnOn() {
        echo "Stereo System is ON\n";
    }

    public function turnOff() {
        echo "Stereo System is OFF\n";
    }
}

class RemoteControl {
    private $command;

    public function setCommand(Command $command) {
        $this->command = $command;
    }

    public function pressButton() {
        $this->command->execute();
    }
}

// Create electronic devices
$tv = new Television();
$stereo = new StereoSystem();

// Create commands
$turnOnTV = new TurnOnCommand($tv);
$turnOffTV = new TurnOffCommand($tv);

$turnOnStereo = new TurnOnCommand($stereo);
$turnOffStereo = new TurnOffCommand($stereo);

// Create the remote control
$remote = new RemoteControl();

// Configure the remote control with commands
$remote->setCommand($turnOnTV);
$remote->pressButton(); // Turn on the TV

$remote->setCommand($turnOffTV);
$remote->pressButton(); // Turn off the TV

$remote->setCommand($turnOnStereo);
$remote->pressButton(); // Turn on the Stereo System

$remote->setCommand($turnOffStereo);
$remote->pressButton(); // Turn off the Stereo System

?>