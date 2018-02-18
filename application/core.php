<?php
	class TableRows extends RecursiveIteratorIterator {
		function __construct($it) {
			parent::__construct($it, self::LEAVES_ONLY);
		}
		function current() {
			return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
		}
		function beginChildren() {
			echo "<tr>";
		}
		function endChildren() {
			echo "</tr>" . "\n";
		}
	}
	function mekeQuery($sql){
		try {
			$con = new PDO("mysql:host=localhost;dbname=testworktrafgid", "root", "123456");
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				echo $v;
			}
		}
		catch (PDOException $e)
		{
			echo "Connection failed" . $e->getMessage();
		}
		$conn = null;
	}
	function ex1(){
		$sql = "SELECT * FROM `offers`";
		echo "<tr><th>Id</th><th>Name</th></tr>";
		mekeQuery($sql);
	}
	function ex2(){
		$sql = "SELECT requests.id, offers.name FROM `requests` INNER JOIN `offers` ON requests.offer_id = offers.id";
		echo "<tr><th>Request number</th><th>Name of product</th></tr>";
		mekeQuery($sql);
	}
	function ex3(){
		$sql = "SELECT requests.id, offers.name, requests.price, requests.count, operators.fio FROM `requests`
					INNER JOIN `offers` ON requests.offer_id = offers.id INNER JOIN `operators` ON requests.operator_id = operators.id 
					WHERE requests.count > 2 AND (requests.operator_id = 10 OR requests.operator_id =12)";
		echo "<tr><th>Request number</th><th>Name of product</th><th>Price</th><th>Count</th><th>Operators name</th></tr>";
		mekeQuery($sql);
	}
	function ex4(){
		$sql = "SELECT offers.name, requests.count, SUM(requests.price) AS Price FROM `requests`
					INNER JOIN `offers` ON requests.offer_id = offers.id GROUP BY offers.name";
		echo "<tr><th>Name of product</th><th>Count</th><th>Price</th></tr>";
		mekeQuery($sql);
	}
	if (isset($_GET['action']))
	{
		switch ($_GET['action']){
			case 'ex1':
				ex1();
				break;
			case 'ex2':
				ex2();
				break;
			case 'ex3':
				ex3();
				break;
			case 'ex4':
				ex4();
				break;
		}
	}
