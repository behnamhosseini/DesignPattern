<?php
//  Below is an example of implementing an API in PHP that allows a user to choose a bank using
//  the Strategy pattern, creates an instance of the bank class using the Factory pattern, and then calls the chosen bank with the Adapter pattern.

// PaymentStrategy.php
interface PaymentStrategy {
    public function pay($amount);
}

// Bank1PaymentStrategy.php
class Bank1PaymentStrategy implements PaymentStrategy {
    public function pay($amount) {
        // Implement payment with Bank 1
        echo "Payment with Bank 1: $amount\n";
    }
}

// Bank2PaymentStrategy.php
class Bank2PaymentStrategy implements PaymentStrategy {
    public function pay($amount) {
        // Implement payment with Bank 2
        echo "Payment with Bank 2: $amount\n";
    }
}

// Bank3PaymentStrategy.php
class Bank3PaymentStrategy implements PaymentStrategy {
    public function pay($amount) {
        // Implement payment with Bank 3
        echo "Payment with Bank 3: $amount\n";
    }
}

// PaymentStrategyFactory.php
class PaymentStrategyFactory {
    public static function createPaymentStrategy($bank) {
        switch ($bank) {
            case 'bank1':
                return new Bank1PaymentStrategy();
            case 'bank2':
                return new Bank2PaymentStrategy();
            case 'bank3':
                return new Bank3PaymentStrategy();
            default:
                throw new \Exception('Invalid bank selection');
        }
    }
}

// BankAdapter.php
class BankAdapter {
    private $strategy;

    public function __construct(PaymentStrategy $strategy) {
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
        $strategy = PaymentStrategyFactory::createPaymentStrategy($bank);
        $bankAdapter = new BankAdapter($strategy);
        $bankAdapter->makePayment($amount);
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>