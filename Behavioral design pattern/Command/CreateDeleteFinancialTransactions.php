<?php
interface Command {
    public function execute();
}

class CreateTransactionCommand implements Command {
    private $accountingSystem;
    private $transactionData;

    public function __construct($accountingSystem, $transactionData) {
        $this->accountingSystem = $accountingSystem;
        $this->transactionData = $transactionData;
    }

    public function execute() {
        $this->accountingSystem->createTransaction($this->transactionData);
    }
}

class DeleteTransactionCommand implements Command {
    private $accountingSystem;
    private $transactionId;

    public function __construct($accountingSystem, $transactionId) {
        $this->accountingSystem = $accountingSystem;
        $this->transactionId = $transactionId;
    }

    public function execute() {
        $this->accountingSystem->deleteTransaction($this->transactionId);
    }
}
class AccountingSystem {
    private $transactions = [];

    public function createTransaction($transactionData) {
        $this->transactions[] = $transactionData;
        echo "Transaction created: " . json_encode($transactionData) . "\n";
    }

    public function deleteTransaction($transactionId) {
        if (isset($this->transactions[$transactionId])) {
            $deletedTransaction = $this->transactions[$transactionId];
            unset($this->transactions[$transactionId]);
            echo "Transaction deleted: " . json_encode($deletedTransaction) . "\n";
        } else {
            echo "Transaction not found.\n";
        }
    }
}
class CommandInvoker {
    private $command;

    public function setCommand(Command $command) {
        $this->command = $command;
    }

    public function executeCommand() {
        $this->command->execute();
    }
}
// Create the accounting system
$accountingSystem = new AccountingSystem();

// Create transaction data
$transactionData1 = ["date" => "2023-09-07", "description" => "Sale", "amount" => 1000];
$transactionData2 = ["date" => "2023-09-08", "description" => "Expense", "amount" => -500];

// Create commands
$createTransactionCommand1 = new CreateTransactionCommand($accountingSystem, $transactionData1);
$createTransactionCommand2 = new CreateTransactionCommand($accountingSystem, $transactionData2);

$deleteTransactionCommand = new DeleteTransactionCommand($accountingSystem, 1); // Assuming we want to delete the second transaction

// Create the command invoker
$commandInvoker = new CommandInvoker();

// Execute commands
$commandInvoker->setCommand($createTransactionCommand1);
$commandInvoker->executeCommand(); // Create Transaction 1

$commandInvoker->setCommand($createTransactionCommand2);
$commandInvoker->executeCommand(); // Create Transaction 2

$commandInvoker->setCommand($deleteTransactionCommand);
$commandInvoker->executeCommand(); // Delete Transaction 2

?>