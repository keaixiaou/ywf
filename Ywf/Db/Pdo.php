<?php
/**
 * User: shenzhe
 * Date: 13-6-17
 */


namespace Ywf\Db;

use Ywf\Core\YwfException;

class Pdo
{
    /**
     * @var \PDO
     */
    private $pdo;
    private $config;
    private $lastTime;
    /**
     * @var Pdo
     */
    private $tryAgain = 0;

    public $codeBroken = 'HY000';


    /**
     * @param $config
     * @param null $className
     * entityDemo
     * <?php
     *    假设数据库有user表,表含有id(自增主键), username, password三个字段
     *    class UserEntity {
     *         const TABLE_NAME = 'user';  //对应的数据表名
     *         const PK_ID = 'id';         //主键id名
     *         public $id;                 //public属性与表字段一一对应
     *         public $username;
     *         public $password;
     *    }
     * @param null $dbName
     */
    public function __construct($config)
    {
        if(empty($config)) {
            throw new \Exception("Connnect config can't Empty!", -1);
        }
        $this->config = $config;
        if(empty($this->config['dsn'])){
            $host = $this->config['host'];
            $port = $this->config['port'];
            $dbname = $this->config['database'];
            $this->config['dsn'] = "mysql:dbname=$dbname;host=$host;port=$port";
        }
        if(empty($this->config['pingtime'])) {
            $this->config['pingtime'] = 3600;
        }
        $this->lastTime = time() + $this->config['pingtime'];
        $this->checkPing();
    }

    public function checkPing()
    {
        if (empty($this->pdo)) {
            $this->pdo = $this->connect();
        } elseif (!empty($this->config['ping'])) {
            $this->ping();
        }
    }

    private function connect()
    {
        $persistent = empty($this->config['pconnect']) ? 0 : 1;
        return new \PDO($this->config['dsn'], $this->config['user'], $this->config['password'], array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES '{$this->config['charset']}';",
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_PERSISTENT => $persistent
            ));

    }

    public function executeSql($sql, $param=null){
        $this->tryAgain = 0;
        try{
            $statement = $this->pdo->prepare($sql);
            if(!is_null($param)) {
                $statement->execute($param);
            }else{
                $statement->execute();
            }
        }catch(\Exception $e){
            if($e->getCode() == $this->codeBroken){
                $this->tryAgain ++ ;
                if($this->tryAgain < 3) {
                    $this->pdo = $this->connect();
                    return $this->executeSql($sql, $param);
                }
            }
            throw new YwfException($e->getMessage());
        }
        return $statement;
    }

    public function getInsertId(){
        return $this->pdo->lastInsertId();
    }

    public function ping()
    {
        $now = time();
        if($this->lastTime < $now) {
            if (empty($this->pdo)) {
                $this->pdo = $this->connect();
            } else {
                try {
                    $status = $this->pdo->getAttribute(\PDO::ATTR_SERVER_INFO);
                } catch (\Exception $e) {
                    if ($e->getCode() == $this->codeBroken) {
                        $this->pdo = $this->connect();
                    } else {
                        throw $e;
                    }
                }
            }
        }
        $this->lastTime = $now + $this->config['pingtime'];
        return $this->pdo;
    }

    public function close()
    {
        if(empty($this->config['pconnect'])) {
            $this->pdo = null;
        }
    }

}
