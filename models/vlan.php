<?php

class vlan
{
    private PDO $pdo;
    public function __construct() { $this->pdo = Database::StartUp(); }

    public function all(): array
    {
        $sql = "SELECT id, nombre, vlan_id FROM vlans ORDER BY vlan_id";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
