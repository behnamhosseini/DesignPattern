<!-- Description: In document generation applications, you often need to create different types of documents like PDFs, Word documents, or HTML documents
 based on user requirements. The Factory Method pattern can be used to create document objects of various types. -->
<?php
// Abstract Product: Document
interface Document {
    public function generate();
}

// Concrete Product: PDF Document
class PDFDocument implements Document {
    public function generate() {
        return "Generated a PDF document.\n";
    }
}

// Concrete Product: Word Document
class WordDocument implements Document {
    public function generate() {
        return "Generated a Word document.\n";
    }
}

// Concrete Product: HTML Document
class HTMLDocument implements Document {
    public function generate() {
        return "Generated an HTML document.\n";
    }
}

// Abstract Creator: DocumentCreator
interface DocumentCreator {
    public function createDocument();
}

// Concrete Creator: PDFDocumentCreator
class PDFDocumentCreator implements DocumentCreator {
    public function createDocument() {
        return new PDFDocument();
    }
}

// Concrete Creator: WordDocumentCreator
class WordDocumentCreator implements DocumentCreator {
    public function createDocument() {
        return new WordDocument();
    }
}

// Concrete Creator: HTMLDocumentCreator
class HTMLDocumentCreator implements DocumentCreator {
    public function createDocument() {
        return new HTMLDocument();
    }
}

// Client Code
function generateDocument(DocumentCreator $creator) {
    $document = $creator->createDocument();
    echo $document->generate();
}

// Usage
$pdfCreator = new PDFDocumentCreator();
$wordCreator = new WordDocumentCreator();
$htmlCreator = new HTMLDocumentCreator();

generateDocument($pdfCreator);
generateDocument($wordCreator);
generateDocument($htmlCreator);

?>

<!-- In this example:

We have an abstract Document interface representing various types of documents with a generate method.

There are concrete product classes (PDFDocument, WordDocument, HTMLDocument) that implement the Document interface and provide their own document generation logic.

We have an abstract DocumentCreator interface with a createDocument method for creating document objects.

Concrete creator classes (PDFDocumentCreator, WordDocumentCreator, HTMLDocumentCreator) implement the DocumentCreator interface and create specific document types.

In the client code, the generateDocument function accepts a DocumentCreator and uses it to create and generate documents of different types.

When you run this code, you'll see output like:

css
Copy code
Generated a PDF document.
Generated a Word document.
Generated an HTML document.
This demonstrates how the Factory Method pattern allows you to create different types of objects (documents, in this case) with a common interface while letting each concrete creator class determine the specific type of object to create. -->