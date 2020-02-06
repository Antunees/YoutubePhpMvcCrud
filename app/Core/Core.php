<?php

	class Core
	{
		public function start($urlGet)
		{
			$acao = isset($urlGet['metodo']) ? $urlGet['metodo'] : "index";

			if(isset($urlGet['pagina']))
			{
				$controller = ucfirst($urlGet['pagina'] . 'Controller');
			}
			else
			{
				$controller = 'HomeController';
			}

			if(!class_exists($controller))
			{
				$controller = 'ErroController';
			}

			$id = isset($urlGet['id']) ? $urlGet['id'] : null;
			
			call_user_func_array(array(new $controller, $acao), array('id' => $id));
		}
	}