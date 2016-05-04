<?php

namespace library\Dao;
/**
 * DB 
 * 
 * @package 
 * @version $id$
 * @copyright 1997-2005 The PHP Group
 * @author Simple.xull<simple.xull@gmail.com> 
 */
class DB {

	private static $_instance = null;

	protected $dbConfig;
	private $link;

	private function __construct ()
	{
		$this->connect();
	}

	public static function getInstance ()
	{
		if ((self::$_instance instanceof self) === false) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	protected function connect ()
	{
		$this->dbConfig = \Yaf\Registry::get("config")->database;	
		$this->link = new \mysqli($this->dbConfig->hostname, $this->dbConfig->username, $this->dbConfig->password, $this->dbConfig->database, $this->dbConfig->port);	
		
		/*
		 * This is the "official" OO way to do it,
		 * BUT $connect_error was broken until PHP 5.2.9 and 5.3.0.
		 */
		if ($this->link->connect_error) {
		    die('Connect Error (' . $this->link->connect_errno . ') ' . $this->link->connect_error);
		}

		// if ($result = $this->link->query("SELECT DATABASE()")) {
		//     $row = $result->fetch_row();
		//     printf("Default database is %s.\n", $row[0]);
		// }

		$this->link->select_db($this->dbConfig->database);
	}


	protected function query ($sql, $attr = '')
	{

	}


	protected function fetchOne ($sql, $attr = '')
	{
		$result = $this->link->query($sql);
		return $result;
	}

	/** 
     * 字段和表名添加 `符号
     * 保证指令中使用关键字不出错 针对mysql 
     * @param string $value 
     * @return string 
     */
    protected function _addChar($value) { 
        if ('*'==$value || false!==strpos($value,'(') || false!==strpos($value,'.') || false!==strpos($value,'`')) { 
            //如果包含* 或者 使用了sql方法 则不作处理 
        } elseif (false === strpos($value,'`') ) { 
            $value = '`'.trim($value).'`';
        } 
        return $value; 
    }



	/** 
	 * 取得数据表的字段信息 
	 * @param string $tbName 表名
	 * @return array 
	 */
    protected function _tbFields($tbName) {
        $sql = 'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME="'.$tbName.'" AND TABLE_SCHEMA="'.$this->dbConfig->database.'"';
        // $stmt = self::$_dbh->prepare($sql);
        // $stmt->execute();
        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = $this->query($sql);
        $ret = array();
        foreach ($result as $key=>$value) {
            $ret[$value['COLUMN_NAME']] = 1;
        }
        return $ret;
    }
 
	/** 
	 * 过滤并格式化数据表字段
	 * @param string $tbName 数据表名 
	 * @param array $data POST提交数据 
	 * @return array $newdata 
	 */
    protected function _dataFormat($tbName,$data) {
        if (!is_array($data)) return array();
        $table_column = $this->_tbFields($tbName);
        $ret=array();
        foreach ($data as $key=>$val) {
            if (!is_scalar($val)) continue; //值不是标量则跳过
            if (array_key_exists($key,$table_column)) {
                $key = $this->_addChar($key);
                if (is_int($val)) { 
                    $val = intval($val); 
                } elseif (is_float($val)) { 
                    $val = floatval($val); 
                } elseif (preg_match('/^\(\w*(\+|\-|\*|\/)?\w*\)$/i', $val)) {
                    // 支持在字段的值里面直接使用其它字段 ,例如 (score+1) (name) 必须包含括号
                    $val = $val;
                } elseif (is_string($val)) { 
                    $val = '"'.addslashes($val).'"';
                }
                $ret[$key] = $val;
            }
        }
        return $ret;
    }

    /**
     * 启动事务 
     * @return void 
     */
    public function startTrans() { 
        //数据rollback 支持 
        if ($this->_trans==0) self::$_dbh->beginTransaction();
        $this->_trans++; 
        return; 
    }
     
    /** 
     * 用于非自动提交状态下面的查询提交 
     * @return boolen 
     */
    public function commit() {
        $result = true;
        if ($this->_trans>0) { 
            $result = self::$_dbh->commit(); 
            $this->_trans = 0;
        } 
        return $result;
    }
 
    /** 
     * 事务回滚 
     * @return boolen 
     */
    public function rollback() {
        $result = true;
        if ($this->_trans>0) {
            $result = self::$_dbh->rollback();
            $this->_trans = 0;
        }
        return $result;
    }
 

	private function __clone () {}

}
