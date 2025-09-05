<?php


class owner
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::StartUp();
    }

    public function all(): array
    {
        $sql = "SELECT id, nombre, apellido, usuario, email, sector, habilitado
                FROM owners
                ORDER BY apellido, nombre";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search(string $q): array
    {
        $q = trim($q);
        if ($q === '') return $this->all();

        $sql = "SELECT id, nombre, apellido, usuario, email, sector, habilitado
                FROM owners
                WHERE CONCAT_WS(' ', nombre, apellido, usuario, email, sector) LIKE :q
                ORDER BY apellido, nombre";
        $st = $this->pdo->prepare($sql);
        $st->execute([':q' => "%{$q}%"]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $st = $this->pdo->prepare("SELECT * FROM owners WHERE id = :id");
        $st->execute([':id' => $id]);
        $row = $st->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO owners (nombre, apellido, usuario, email, sector, habilitado, created_at, updated_at)
                VALUES (:nombre, :apellido, :usuario, :email, :sector, :habilitado, NOW(), NOW())";
        $st = $this->pdo->prepare($sql);

        $email = filter_var(trim($data['email'] ?? ''), FILTER_VALIDATE_EMAIL) ?: null;

        $st->execute([
            ':nombre'     => strip_tags(trim($data['nombre'] ?? '')),
            ':apellido'   => strip_tags(trim($data['apellido'] ?? '')),
            ':usuario'    => strip_tags(trim($data['usuario'] ?? '')),
            ':email'      => $email,
            ':sector'     => strip_tags(trim($data['sector'] ?? '')),
            ':habilitado' => !empty($data['habilitado']) ? 1 : 0,
        ]);
        return (int)$this->pdo->lastInsertId();
    }
}
