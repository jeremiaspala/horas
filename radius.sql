-- tablas para módulo radius
CREATE TABLE IF NOT EXISTS owners (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre      VARCHAR(100) NOT NULL,
  apellido    VARCHAR(100) NOT NULL,
  usuario     VARCHAR(100) DEFAULT NULL,
  email       VARCHAR(150) DEFAULT NULL,
  sector      VARCHAR(150) DEFAULT NULL,
  habilitado  TINYINT(1) NOT NULL DEFAULT 1,
  created_at  DATETIME NOT NULL,
  updated_at  DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS vlans (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre   VARCHAR(100) NOT NULL,
  vlan_id  INT NOT NULL
);

CREATE TABLE IF NOT EXISTS equipos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre       VARCHAR(150) NOT NULL,
  tipo         VARCHAR(100) NOT NULL,
  mac_address  VARCHAR(17) NOT NULL,
  sector_id    INT DEFAULT NULL,
  owner_id     INT NOT NULL,
  descripcion  VARCHAR(255) DEFAULT NULL,
  vlan_id      INT DEFAULT NULL,
  ip_address   VARCHAR(45) DEFAULT NULL,
  created_at   DATETIME NOT NULL,
  updated_at   DATETIME NOT NULL,
  CONSTRAINT fk_equipos_owner FOREIGN KEY (owner_id) REFERENCES owners(id),
  CONSTRAINT fk_equipos_vlan FOREIGN KEY (vlan_id) REFERENCES vlans(id)
);
