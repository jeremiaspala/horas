<?php
require_once 'models/vpnevents.php';

class DashboardController
{
    /** @var PDO */
    private $pdo;

    public function __CONSTRUCT()
    {
        $this->pdo = Database::StartUp();
    }

    public function Index()
    {
        // KPI: usuarios conectados hoy (al menos un evento 'up' hoy)
        $sqlKpi = "SELECT COUNT(DISTINCT `user`) AS total
                   FROM vpn_events
                   WHERE DATE(event_time) = CURDATE() AND event_type = 'up'";
        $kpi = (int)$this->pdo->query($sqlKpi)->fetch(PDO::FETCH_OBJ)->total;

        // Top 10 usuarios conectados hoy (último up de cada usuario hoy)
        $sqlHoy = "
            SELECT t.user,
                   SUBSTRING_INDEX(GROUP_CONCAT(COALESCE(t.remote_addr,'') ORDER BY t.event_time DESC), ',', 1) AS remote_addr,
                   MAX(t.event_time) AS last_time
            FROM vpn_events t
            WHERE DATE(t.event_time) = CURDATE()
              AND t.event_type = 'up'
            GROUP BY t.user
            ORDER BY last_time DESC
            LIMIT 10";
        $hoyUsuarios = $this->pdo->query($sqlHoy)->fetchAll(PDO::FETCH_OBJ);

        // Leaderboard semana (sum(uptime_sec) sobre eventos 'down' de la semana ISO actual)
        $sqlSemana = "
            SELECT e.user,
                   IFNULL(SUM(e.uptime_sec),0) AS total_sec,
                   SUBSTRING_INDEX(GROUP_CONCAT(CASE WHEN e.remote_addr IS NOT NULL AND e.remote_addr<>'' THEN e.remote_addr END ORDER BY e.event_time DESC), ',', 1) AS remote_addr
            FROM vpn_events e
            WHERE e.event_type = 'down'
              AND YEARWEEK(e.event_time, 3) = YEARWEEK(CURDATE(), 3)
            GROUP BY e.user
            HAVING total_sec > 0
            ORDER BY total_sec DESC
            LIMIT 10";
        $topSemana = $this->pdo->query($sqlSemana)->fetchAll(PDO::FETCH_OBJ);

        // Leaderboard mes (sum(uptime_sec) sobre eventos 'down' del mes actual)
        $sqlMes = "
            SELECT e.user,
                   IFNULL(SUM(e.uptime_sec),0) AS total_sec,
                   SUBSTRING_INDEX(GROUP_CONCAT(CASE WHEN e.remote_addr IS NOT NULL AND e.remote_addr<>'' THEN e.remote_addr END ORDER BY e.event_time DESC), ',', 1) AS remote_addr
            FROM vpn_events e
            WHERE e.event_type = 'down'
              AND YEAR(e.event_time) = YEAR(CURDATE())
              AND MONTH(e.event_time) = MONTH(CURDATE())
            GROUP BY e.user
            HAVING total_sec > 0
            ORDER BY total_sec DESC
            LIMIT 10";
        $topMes = $this->pdo->query($sqlMes)->fetchAll(PDO::FETCH_OBJ);

        // Serie para la gráfica: conexiones por hora de hoy (eventos 'up')
        $sqlSerie = "
            SELECT HOUR(event_time) AS h, COUNT(*) AS c
            FROM vpn_events
            WHERE DATE(event_time) = CURDATE() AND event_type = 'up'
            GROUP BY HOUR(event_time)
            ORDER BY h";
        $rows = $this->pdo->query($sqlSerie)->fetchAll(PDO::FETCH_ASSOC);
        $serie = array_fill(0, 24, 0);
        foreach ($rows as $r) {
            $serie[(int)$r['h']] = (int)$r['c'];
        }

        // Pasar todo a la vista
        $chart_labels = json_encode(array_map(function($h){ return str_pad($h, 2, '0', STR_PAD_LEFT).':00'; }, range(0,23)));
        $chart_data   = json_encode(array_values($serie));
        require_once 'views/layout/header.php';
        require_once 'views/dashboard/index_vpn.php';
        require_once 'views/layout/footer.php';
    }

    // Helper estático por si querés usar también en otras vistas rápidamente
    public static function formato_dhms($segundos_total)
    {
        $seg = (int)$segundos_total;
        $d = intdiv($seg, 86400); $seg %= 86400;
        $h = intdiv($seg, 3600);  $seg %= 3600;
        $m = intdiv($seg, 60);    $s = $seg % 60;
        return sprintf('%sd %02dh %02dm %02ds', $d, $h, $m, $s);
    }
}
