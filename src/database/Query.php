<?php

namespace wjcms\framework\database;

use Exception;
use PDO;

class Query
{
    protected $table;
    protected $options =['limit'=>'','field'=>'*','where'=>'','orderBy'=>'','groupBy'=>''];
    protected $bindParams = [];
    protected $key;
    public function table(string $table)
    {
        $this->table =$table;
        $this->getFieldInfo();
        return $this;
    }

    protected function getFieldInfo()
    {
        $result = $this->query("DESC {$this->table}");
        foreach ($result as $field) {
            if ($field['Key']==='PRI') {
                $this->key = $field['Field'];
                break;
            }
        }
    }

    public function limit($n, $m='')
    {
        $this->options['limit']= " LIMIT $n ".($m ? ','.$m :'');
        return $this;
    }

    public function delete()
    {
        if (!$this->options['where']) {
            throw new Exception('删除请添加条件');
        }
        $sql = sprintf(
            "DELETE FROM %s %s",
            $this->table,
            $this->formatWhere()
        );
        return $this->execute($sql);
    }

    public function update($params)
    {
        $hasWhere = $this->options['where'] ?:
            (isset($params[$this->key]) ? $this->where([
                [$this->key,'=',$params[$this->key]]
            ]):null);
        if (!$hasWhere) {
            throw new Exception('更新必须设置条件或含有主键数据');
        }
        $sql = sprintf(
            "UPDATE %s SET %s %s",
            $this->table,
            implode(',', array_map(function ($v) {
                return "{$v}=:{$v}";
            }, array_keys($params))),
            $this->formatWhere()
        );
        dump($sql);
        return $this->execute($sql, $params);
    }

    public function insert($params)
    {
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES(%s)",
            $this->table,
            implode(',', array_keys($params)),
            ':'.implode(',:', array_keys($params))
        );
        dump($sql);
        return $this->execute($sql, $params);
    }

    public function where(array $where)
    {
        $exp ='';
        foreach ($where as $k=>$v) {
            $name = ":" . $v[0] .$k;
            $this->bindParams[$name] = $v[2];
            $exp.= " {$v[0]} {$v[1]} {$name} ".($v[3] ?? 'AND');
        }
        $this->options['where'] =$exp;
        return $this;
    }

    public function field(...$field)
    {
        $this->options['field'] = '`'.implode('`,`', $field).'`';
        return $this;
    }

    protected function formatWhere()
    {
        return $this->options['where'] ? " WHERE ".preg_replace("/(AND|OR)$/i", '', $this->options['where']) : null;
    }

    protected function getSql()
    {
        return sprintf(
            "SELECT %s FROM  %s %s %s",
            $this->options['field'],
            $this->table,
            $this->formatWhere(),
            $this->options['limit']
        );
    }

    public function get()
    {
        return  $this->query($this->getSql());
    }

    //处理select
    public function query($sql, array $params=[])
    {
        $sth = $this->connect()->prepare($sql);
        $sth->execute($this->formatPrepareParams($params));
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    //处理insert update
    public function execute($sql, array $params=[])
    {
        dump($this->formatPrepareParams($params));
        $sth = $this->connect()->prepare($sql);
        return $sth->execute($this->formatPrepareParams($params));
    }

    protected function formatPrepareParams(array $params=[])
    {
        $fields = [];
        foreach ($params as $k =>$v) {
            $fields[":{$k}"] = $v;
        }
        return array_merge($this->bindParams, $fields);
    }
}
