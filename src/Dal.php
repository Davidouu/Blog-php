<?php

namespace App;

class Dal
{
    // db connection
    private ?\PDO $pdo = null;

    // last request
    private ?\PDOStatement $stmt = null;

    // Constructor
    public function __construct()
    {
        try {
            $this->pdo = new \PDO('mysql:dbname='.$_ENV['DB_NAME'].';host='.$_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }

    // Execute query
    public function execute(string $query, object|array $data = []): bool
    {
        try {
            $request = $this->pdo->prepare($query);
            foreach ($data as $key => $value) {
                $request->bindValue(':'.$key, $value);
            }

            $this->stmt = $request;

            return $request->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    // Fetch data
    public function fetchData(string $fetchType): array
    {
        try {
            if ($fetchType === 'all') {
                $data = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);

                return $data;
            } elseif ($fetchType === 'one') {
                $data = $this->stmt->fetch(\PDO::FETCH_ASSOC);

                return $data;
            }
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }

    // Get last insert id
    public function getLastInsertId(): int
    {
        return $this->pdo->lastInsertId();
    }
}
