<?php

	class HomeController
	{
		public function index()
		{
			try {
				// echo 'Home';
				$colecPostagens = Postagem::selecionaTodos();
	
				echo "<pre>";
				var_dump($colecPostagens);
				echo "/<pre>";
			}
			catch (Exception $e)
			{
				echo $e->getMessage();
			}
		}
	}