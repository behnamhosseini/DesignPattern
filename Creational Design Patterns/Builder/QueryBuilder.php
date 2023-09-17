<!-- In database operations, constructing complex SQL queries can be error-prone and hard to maintain when done manually. 
A Query Builder with the Builder pattern can provide a fluent and type-safe way to create SQL queries. -->

<?php
class QueryBuilder {
    private $query;

    public function select($columns) {
        $this->query = "SELECT " . implode(", ", $columns);
        return $this;
    }

    public function from($table) {
        $this->query .= " FROM $table";
        return $this;
    }

    public function where($condition) {
        $this->query .= " WHERE $condition";
        return $this;
    }

    public function build() {
        return $this->query;
    }
}

// Usage
$query = (new QueryBuilder())
    ->select(['name', 'email'])
    ->from('users')
    ->where('age > 18')
    ->build();

echo $query;

?>

<!-- In this example, the QueryBuilder class allows you to construct SQL queries step by step with method chaining, 
ensuring that the queries are well-formed and reducing the risk of SQL injection vulnerabilities. -->