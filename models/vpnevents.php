<?php
class VpnEvents
{
    private $pdo;

    // Variables por cada campo de la tabla vpn_events
    public $id;
    public $event_time;
    public $connect_time;
    public $event_type;
    public $user;
    public $service;
    public $interface;
    public $caller_id;
    public $remote_addr;
    public $local_addr;
    public $uptime_sec;
    public $router_id;
    public $session_key;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /* ======================================================
     * CRUD básico
     * ====================================================== */
    public function Listar()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM vpn_events ORDER BY event_time DESC");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function ListarLast()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM vpn_events ORDER BY event_time DESC limit 20");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM vpn_events WHERE id = ?");
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM vpn_events WHERE id = ?");
            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar($data)
    {
        try {
            $sql = "UPDATE vpn_events SET
                        event_time = ?,
                        connect_time = ?,
                        event_type = ?,
                        `user` = ?,
                        service = ?,
                        `interface` = ?,
                        caller_id = ?,
                        remote_addr = ?,
                        local_addr = ?,
                        uptime_sec = ?,
                        router_id = ?,
                        session_key = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)->execute(array(
                $data->event_time,
                $data->connect_time,
                $data->event_type,
                $data->user,
                $data->service,
                $data->interface,
                $data->caller_id,
                $data->remote_addr,
                $data->local_addr,
                $data->uptime_sec,
                $data->router_id,
                $data->session_key,
                $data->id
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar($data)
    {
        try {
            $sql = "INSERT INTO vpn_events
                        (event_time, connect_time, event_type, `user`, service, `interface`, caller_id, remote_addr, local_addr, uptime_sec, router_id, session_key)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)->execute(array(
                $data->event_time,
                $data->connect_time,
                $data->event_type,
                $data->user,
                $data->service,
                $data->interface,
                $data->caller_id,
                $data->remote_addr,
                $data->local_addr,
                $data->uptime_sec,
                $data->router_id,
                $data->session_key
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /* ======================================================
     * Consultas para dashboards / reportes
     * ====================================================== */

    // 1) Usuarios conectados ahora mismo (último evento por session_key es 'up')
    public function UsuariosConectadosAhora()
    {
        try {
            $sql = <<<SQL
            WITH ult AS (
              SELECT
                session_key,
                `user`,
                service,
                `interface`,
                caller_id,
                remote_addr,
                local_addr,
                router_id,
                event_type,
                connect_time,
                event_time,
                ROW_NUMBER() OVER (PARTITION BY session_key ORDER BY event_time DESC) AS rn
              FROM vpn_events
              WHERE session_key IS NOT NULL
            )
            SELECT
              `user`, service, `interface`, caller_id, remote_addr, local_addr, router_id,
              connect_time AS started_at, event_time AS last_event_time, session_key
            FROM ult
            WHERE rn = 1 AND event_type = 'up'
            ORDER BY started_at DESC;
            SQL;

            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // 2) Top N últimos usuarios conectados (últimos 'up')
    public function UltimosUsuariosConectados($limit = 10)
    {
        try {
            $sql = "SELECT `user`, service, `interface`, caller_id, remote_addr, local_addr, router_id, connect_time AS started_at
                    FROM vpn_events
                    WHERE event_type = 'up'
                    ORDER BY connect_time DESC
                    LIMIT :lim";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':lim', (int)$limit, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // 3) Top N usuarios con más tiempo conectado HOY (suma uptime_sec de eventos 'down' del día actual)
    public function TopUsuariosHoy($limit = 10)
    {
        try {
            $sql = "SELECT `user`,
                           SEC_TO_TIME(SUM(uptime_sec)) AS total_uptime_hhmmss,
                           SUM(uptime_sec) AS total_uptime_sec
                    FROM vpn_events
                    WHERE event_type = 'down'
                      AND DATE(event_time) = CURDATE()
                    GROUP BY `user`
                    ORDER BY total_uptime_sec DESC
                    LIMIT :lim";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':lim', (int)$limit, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // 3b) Top N usuarios con más tiempo conectado SEMANA ISO actual (lunes-domingo)
    public function TopUsuariosSemana($limit = 10)
    {
        try {
            $sql = "SELECT `user`,
                           SEC_TO_TIME(SUM(uptime_sec)) AS total_uptime_hhmmss,
                           SUM(uptime_sec) AS total_uptime_sec
                    FROM vpn_events
                    WHERE event_type = 'down'
                      AND YEARWEEK(event_time, 3) = YEARWEEK(CURDATE(), 3)
                    GROUP BY `user`
                    ORDER BY total_uptime_sec DESC
                    LIMIT :lim";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':lim', (int)$limit, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // 3c) Top N usuarios con más tiempo conectado MES actual
    public function TopUsuariosMes($limit = 10)
    {
        try {
            $sql = "SELECT `user`,
                           SEC_TO_TIME(SUM(uptime_sec)) AS total_uptime_hhmmss,
                           SUM(uptime_sec) AS total_uptime_sec
                    FROM vpn_events
                    WHERE event_type = 'down'
                      AND YEAR(event_time) = YEAR(CURDATE())
                      AND MONTH(event_time) = MONTH(CURDATE())
                    GROUP BY `user`
                    ORDER BY total_uptime_sec DESC
                    LIMIT :lim";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':lim', (int)$limit, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // 3d) Top N usuarios por rango arbitrario
    public function TopUsuariosPorRango($fromDate, $toDate, $limit = 10)
    {
        try {
            $sql = "SELECT `user`,
                           SEC_TO_TIME(SUM(uptime_sec)) AS total_uptime_hhmmss,
                           SUM(uptime_sec) AS total_uptime_sec
                    FROM vpn_events
                    WHERE event_type = 'down'
                      AND event_time >= ?
                      AND event_time <  ?
                    GROUP BY `user`
                    ORDER BY total_uptime_sec DESC
                    LIMIT :lim";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $fromDate);
            $stm->bindValue(2, $toDate);
            $stm->bindValue(':lim', (int)$limit, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // 4) ¿Usuario conectado el día X? (devuelve sesiones que tocan cualquier parte del día)
    public function UsuarioConectadoDia($user, $day /* YYYY-MM-DD */)
    {
        try {
            $sql = <<<SQL
            WITH sesiones AS (
              SELECT
                u.session_key,
                u.`user`,
                u.service,
                u.`interface`,
                u.caller_id,
                u.remote_addr,
                u.local_addr,
                u.router_id,
                u.connect_time AS started_at,
                d.event_time   AS ended_at
              FROM vpn_events u
              LEFT JOIN vpn_events d
                ON d.session_key = u.session_key AND d.event_type = 'down'
              WHERE u.event_type = 'up' AND u.`user` = :uname
            ),
            rango AS (
              SELECT
                :day AS d_start,
                DATE_ADD(:day, INTERVAL 1 DAY) AS d_end
            )
            SELECT
              s.`user`, s.service, s.`interface`, s.caller_id,
              s.remote_addr, s.local_addr, s.router_id,
              s.started_at, s.ended_at,
              (s.ended_at IS NULL) AS is_active,
              s.session_key
            FROM sesiones s
            CROSS JOIN rango r
            WHERE s.started_at < r.d_end
              AND COALESCE(s.ended_at, '9999-12-31') >= r.d_start
            ORDER BY s.started_at;
            SQL;
            $stm = $this->pdo->prepare($sql);
            $stm->execute([':uname' => $user, ':day' => $day]);
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // 5) Listado de usuarios que alguna vez se conectaron
    public function UsuariosUnicos()
    {
        try {
            $stm = $this->pdo->prepare("SELECT DISTINCT `user` FROM vpn_events ORDER BY `user`");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_COLUMN);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // 6) Listado de días (día de inicio) en que un usuario se conectó (simple)
    public function DiasUsuarioInicio($user)
    {
        try {
            $sql = "SELECT DISTINCT DATE(connect_time) AS day_connected
                    FROM vpn_events
                    WHERE event_type = 'up' AND `user` = ?
                    ORDER BY day_connected DESC";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$user]);
            return $stm->fetchAll(PDO::FETCH_COLUMN);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // 7) Días que un usuario estuvo conectado (expansión por sesión; incluye sesiones activas hasta NOW())
    public function DiasUsuarioExpandido($user)
    {
        try {
            $sql = <<<SQL
            WITH RECURSIVE
            sesiones AS (
              SELECT
                session_key,
                ANY_VALUE(`user`) AS `user`,
                MIN(CASE WHEN event_type='up'   THEN connect_time END) AS started_at,
                MAX(CASE WHEN event_type='down' THEN event_time   END) AS ended_at
              FROM vpn_events
              WHERE session_key IS NOT NULL
              GROUP BY session_key
              HAVING MIN(CASE WHEN event_type='up' THEN connect_time END) IS NOT NULL
            ),
            filtradas AS (
              SELECT `user`, started_at, COALESCE(ended_at, NOW()) AS ended_at
              FROM sesiones
              WHERE `user` = :uname
            ),
            dias(`user`, day, ended_at) AS (
              SELECT `user`, DATE(started_at) AS day, ended_at
              FROM filtradas
              UNION ALL
              SELECT `user`, DATE_ADD(day, INTERVAL 1 DAY), ended_at
              FROM dias
              WHERE DATE_ADD(day, INTERVAL 1 DAY) <= DATE(ended_at)
            )
            SELECT DISTINCT day
            FROM dias
            ORDER BY day DESC;
            SQL;
            $stm = $this->pdo->prepare($sql);
            $stm->execute([':uname' => $user]);
            return $stm->fetchAll(PDO::FETCH_COLUMN);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // 8) Días que un usuario estuvo conectado dentro de un rango [from_date, to_date)
    public function DiasUsuarioExpandidoRango($user, $fromDate, $toDate)
    {
        try {
            $sql = <<<SQL
            WITH RECURSIVE
            sesiones AS (
              SELECT
                session_key,
                ANY_VALUE(`user`) AS `user`,
                MIN(CASE WHEN event_type='up'   THEN connect_time END) AS started_at,
                MAX(CASE WHEN event_type='down' THEN event_time   END) AS ended_at
              FROM vpn_events
              WHERE session_key IS NOT NULL
              GROUP BY session_key
              HAVING MIN(CASE WHEN event_type='up' THEN connect_time END) IS NOT NULL
            ),
            norm AS (
              SELECT `user`, started_at, COALESCE(ended_at, NOW()) AS ended_at
              FROM sesiones
              WHERE `user` = :uname
            ),
            recortadas AS (
              SELECT
                `user`,
                GREATEST(started_at, :from_date) AS seg_start,
                LEAST(ended_at,   :to_date)      AS seg_end
              FROM norm
              WHERE started_at < :to_date AND ended_at > :from_date
            ),
            dias(`user`, day, seg_end) AS (
              SELECT `user`, DATE(seg_start) AS day, seg_end
              FROM recortadas
              UNION ALL
              SELECT `user`, DATE_ADD(day, INTERVAL 1 DAY), seg_end
              FROM dias
              WHERE DATE_ADD(day, INTERVAL 1 DAY) <  DATE(seg_end)
                 OR (DATE_ADD(day, INTERVAL 1 DAY) = DATE(seg_end) AND TIME(seg_end) > '00:00:00')
            )
            SELECT DISTINCT day
            FROM dias
            ORDER BY day DESC;
            SQL;
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                ':uname' => $user,
                ':from_date' => $fromDate,
                ':to_date' => $toDate
            ]);
            return $stm->fetchAll(PDO::FETCH_COLUMN);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // 9) Helpers de rango fijo (hoy / semana ISO actual / mes actual)
    public function DiasUsuarioHoy($user)
    {
        $from = date('Y-m-d');
        $to   = date('Y-m-d', strtotime('+1 day'));
        return $this->DiasUsuarioExpandidoRango($user, $from, $to);
    }

    public function DiasUsuarioSemana($user)
    {
        // lunes 00:00 de la semana actual
        $dow = (int)date('w'); // 0=domingo..6=sábado
        $offset = $dow === 0 ? 6 : ($dow - 1);
        $from = date('Y-m-d', strtotime("-$offset day"));
        $to   = date('Y-m-d', strtotime("$from +7 day"));
        return $this->DiasUsuarioExpandidoRango($user, $from, $to);
    }

    public function DiasUsuarioMes($user)
    {
        $from = date('Y-m-01');
        $to   = date('Y-m-d', strtotime("$from +1 month"));
        return $this->DiasUsuarioExpandidoRango($user, $from, $to);
    }
}

