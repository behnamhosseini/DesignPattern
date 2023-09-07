<?php

abstract class Document
{
    protected $content;

    public function getContent()
    {
        return $this->content;
    }

    abstract public function generate();
}

class Invoice extends Document
{
    public function generate()
    {
        $this->content = "Invoice: Generating invoice content...\n";
    }
}

class Receipt extends Document
{
    public function generate()
    {
        $this->content = "Receipt: Generating receipt content...\n";
    }
}

interface DocumentFactory
{
    public function createDocument();
}

class InvoiceFactory implements DocumentFactory
{
    public function createDocument()
    {
        return new Invoice();
    }
}

class ReceiptFactory implements DocumentFactory
{
    public function createDocument()
    {
        return new Receipt();
    }
}

$invoiceFactory = new InvoiceFactory();
$receiptFactory = new ReceiptFactory();

$invoice = $invoiceFactory->createDocument();
$receipt = $receiptFactory->createDocument();

$invoice->generate();
$receipt->generate();

echo $invoice->getContent();
echo $receipt->getContent();
?>