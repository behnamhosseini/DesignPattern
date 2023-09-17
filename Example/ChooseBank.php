<?php
//  Below is an example of implementing an API in PHP that allows a user to choose a bank using
//  the  pattern, creates an instance of the bank class using the Factory pattern, and then calls the chosen bank with the Adapter pattern.

// Payment.php
interface Payment {
    public function pay($amount);
}

// Bank1Payment.php
class Bank1Payment implements Payment {
    public function pay($amount) {
        // Implement payment with Bank 1
        echo "Payment with Bank 1: $amount\n";
    }
}

// Bank2Payment.php
class Bank2Payment implements Payment {
    public function pay($amount) {
        // Implement payment with Bank 2
        echo "Payment with Bank 2: $amount\n";
    }
}

// Bank3Payment.php
class Bank3Payment implements Payment {
    public function pay($amount) {
        // Implement payment with Bank 3
        echo "Payment with Bank 3: $amount\n";
    }
}

// PaymentFactory.php
class PaymentFactory {
    public static function createPayment($bank) {
        switch ($bank) {
            case 'bank1':
                return new Bank1Payment();
            case 'bank2':
                return new Bank2Payment();
            case 'bank3':
                return new Bank3Payment();
            default:
                throw new \RuntimeException('Invalid bank selection');
        }
    }
}

// BankAdapter.php
class BankAdapter {
    private $strategy;

    public function __construct(Payment $strategy) {
        $this->strategy = $strategy;
    }

    public function makePayment($amount) {
        $this->strategy->pay($amount);
    }
}

// API Endpoint
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bank = $_POST['bank'];
    $amount = $_POST['amount'];

    try {
        $strategy = PaymentFactory::createPayment($bank);
        $bankAdapter = new BankAdapter($strategy);
        $bankAdapter->makePayment($amount);
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>