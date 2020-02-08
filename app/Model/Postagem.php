<?php

	class Postagem
	{
		public static function selecionaTodos()
		{
			$con = Connection::getConn();

			$sql = "SELECT * FROM postagem ORDER BY id DESC";
			$sql = $con->prepare($sql);
			$sql->execute();

			$resultado = array();

			while ($row = $sql->fetchObject('Postagem'))
			{
				$resultado[] = $row;
			}

			if(!$resultado)
			{
				throw new Exception("Não foi encontrado nenhum registro no banco");
			}

			return $resultado;
		}
		
		public static function selecionaPorId($idPost)
		{
			$con = Connection::getConn();

			$sql = "SELECT * FROM postagem WHERE id = :id";
			$sql = $con->prepare($sql);
			$sql->bindValue(':id', $idPost, PDO::PARAM_INT);
			$sql->execute();

			$resultado = $sql->fetchObject('Postagem');

			if(!$resultado)
			{
				throw new Exception("Não foi encontrado nenhum registro no banco");
			}
			else
			{
				$resultado->comentarios = Comentario::selecionarComentarios($idPost);
			}


			return $resultado;
		}

		public static function insert($dadosPost)
		{
			if(empty($dadosPost['titulo']) || empty($dadosPost['conteudo']))
			{
				throw new Exception("Preencha todos os campos");

				return false;
			}

			$con = Connection::getConn();

			$sql = "INSERT INTO postagem (titulo, conteudo) VALUES (:titulo, :conteudo)";
			$sql = $con->prepare($sql);
			$sql->bindValue(":titulo", $dadosPost["titulo"]);
			$sql->bindValue(":conteudo", $dadosPost["conteudo"]);
			$resultado = $sql->execute();

			if(!$resultado)
			{
				throw new Exception("Falha ao inserir publicação");

				return false;
			}

			return true;
		}

		public static function update($params)
		{
			$con = Connection::getConn();

			$sql = "UPDATE postagem SET titulo = :titulo, conteudo = :conteudo WHERE id=:id";
			$sql = $con->prepare($sql);
			$sql->bindValue("titulo", $params['titulo']);
			$sql->bindValue("conteudo", $params['conteudo']);
			$sql->bindValue("id", $params['id']);
			$resultado = $sql->execute();

			if(!$resultado)
			{
				throw new Exception("Falha ao atualizar publicação");

				return false;
			}

			return true;
		}
	}