<?php

	abstract class Connection
	{
		private static $conn;

		public static function getConn()
		{
			if(empty(self::$conn))
			{
				self::$conn = new PDO('mysql: host=localhost; dbname=serie-php-mvc-crud;', 'servico_serie-php-mvc-crud', 'Teste1234567890');
			}

			return self::$conn;
		}
	}