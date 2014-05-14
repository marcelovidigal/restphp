<?php

// classe para conexao com o banco de dados mysql, via acesso nativo do pdo
// e necessario ter definido as seguintes constantes BD, HOST, USUARIO, SENHA
class BD {
	
	// instancia singleton
	private static $instancia;
	
	// conexao com o banco de dados
	private static $conexao;
	
	// obtem uma instancia da classe BD
	public static function getInstancia() {
		if (empty(self::$instancia)) {
			self::$instancia = new BD();
		}
	
		return self::$instancia;
	}
	
	// retorna a conexao PDO com o banco de dados
	public static function getConexao() {
	
		self::getInstancia();
	
		return self::$conexao;
	}
	
	// retorna o id da ultima insercao no bd
	public static function getId() {
		return self::getConexao()->lastInsertId();
	}
	
	// construtor privado da classe singleton
	private function __construct() {
		self::$conexao = new PDO("mysql:dbname=" . BD . ";host=" . HOST, USUARIO, SENHA, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		self::$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	}
	
	// prepara a sql para ser executada posteriormente
	public static function preparar($sql) {
		return self::getConexao()->prepare($sql);
	}
	
	// inicia uma transacao
	public static function iniciarTransacao() {
		return self::getConexao()->beginTransaction();
	}
	
	// comita uma transacao
	public static function commit() {
		return self::getConexao()->commit();
	}
	
	// realiza um rollback da transacao
	public static function rollBack() {
		return self::getConexao()->rollBack();
	}
	
	// formata uma data para o mysql
	public static function formatarDataParaMysql($data) {
		return implode("-", array_reverse(explode("/", $data)));
	}
	
	// formata uma data do mysql
	public static function formatarDataDoMysql($data) {
		return implode("/", array_reverse(explode("-", $data)));
	}
	
	// formata um valor monetario
	public static function formatarDecimalParaMysql($valor) {
		
		$valor = str_replace(".", "", $valor);
		$valor = str_replace(",", ".", $valor);
		
		return $valor;
	}
	
}