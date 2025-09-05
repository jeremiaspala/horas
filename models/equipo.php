<?php

class equipo
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::StartUp();
    }

    public function by_owner(int $owner_id): array
    {
        $sql = "SELECT id, nombre, tipo, mac_address, vlan_id, ip_address, descripcion, created_at, updated_at
                FROM equipos
                WHERE owner_id = :oid
                ORDER BY tipo, nombre";
        $st = $this->pdo->prepare($sql);
        $st->execute([':oid' => $owner_id]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $sql = "SELECT e.*, v.nombre AS vlan_nombre, v.vlan_id AS vlan_tag
                FROM equipos e
                LEFT JOIN vlans v ON v.id = e.vlan_id
                WHERE e.id = :id";
        $st = $this->pdo->prepare($sql);
        $st->execute([':id' => $id]);
        $row = $st->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO equipos
                (nombre, tipo, mac_address, sector_id, owner_id, descripcion, vlan_id, ip_address, created_at, updated_at)
                VALUES
                (:nombre, :tipo, :mac, :sector_id, :owner_id, :descripcion, :vlan_id, :ip, NOW(), NOW())";
        $st = $this->pdo->prepare($sql);

        $nombre = strip_tags(trim($data['eq_nombre'] ?? ''));
        $tipo   = strip_tags(trim($data['eq_tipo'] ?? ''));

        $mac = strtoupper(trim($data['eq_mac'] ?? ''));
        if ($mac !== '' && !preg_match('/^([0-9A-F]{2}([:-])){5}[0-9A-F]{2}$/', $mac)) {
            $mac = '';
        }

        $ip = trim($data['eq_ip'] ?? '');
        if ($ip !== '' && filter_var($ip, FILTER_VALIDATE_IP) === false) {
            $ip = '';
        }

        $st->execute([
            ':nombre'     => $nombre,
            ':tipo'       => $tipo,
            ':mac'        => $mac,
            ':sector_id'  => (int)($data['eq_sector_id'] ?? 0),
            ':owner_id'   => (int)($data['eq_owner_id'] ?? 0),
            ':descripcion'=> strip_tags(trim($data['eq_desc'] ?? '')),
            ':vlan_id'    => (int)($data['eq_vlan_id'] ?? 0),
            ':ip'         => $ip,
        ]);
        return (int)$this->pdo->lastInsertId();
    }
}
