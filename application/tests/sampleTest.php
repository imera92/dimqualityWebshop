<?php 
	class Sampletest extends PHPUnit_Framework_TestCase
	{
		public function setUp()
	    {
	       $this->pdo = new PDO($GLOBALS['db_dsn'], $GLOBALS['db_username'], $GLOBALS['db_password']);
	       $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	       $this->pdo->query("CREATE TABLE producto (
	       						id int(11) NOT NULL,
	       						nombre varchar(50) NOT NULL,
	       						marca varchar(50) NOT NULL,
	       						categoria varchar(50) NOT NULL,
	       						codigo varchar(50) NOT NULL,
	       						pvp decimal(8,2) NOT NULL,
	       						descripcion text,
	       						estado int(11) NOT NULL,
	       						stock int(4) NOT NULL,
	       						destacado int(2) DEFAULT NULL,
       						)");
	       $this->pdo->query("ALTER TABLE producto ADD PRIMARY KEY (id), ADD UNIQUE KEY codigo (codigo)");
	       $this->pdo->query("INSERT INTO producto (nombre, marca, categoria, codigo, pvp, descripcion, estado, stock, destacado) VALUES ('Dell Latitude E5450', 'Dell', 'LAPTOP', 'dddeE5450', 740.00, 'Intel Core i3-5010U Processor (3M Cache, 2.10 GHz), 4GB DDR3L 1600MHz', 1, 9, 0)");
	    }

		public function testGetProductoPorId()
		{
			loader('Producto');
			$producto = new Producto;
			$this->assertTrue($producto->getProductoPorId(1));
		}
	}
?>