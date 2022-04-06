<?php
namespace Core;
use Aura\SqlQuery\QueryFactory;

class ModelAbstract
{
    protected QueryFactory $queryFactory;

    protected DB $db;

    public function __construct()
    {
        $this->queryFactory = new QueryFactory('mysql');
        $this->db = new DB();

    }

    protected function select()
    {
        return  $this->queryFactory->newSelect();
    }

    protected function insert()
    {
        return  $this->queryFactory->newInsert();
    }

    protected function update()
    {
        return $this->queryFactory->newUpdate();
    }


    protected function delete()
    {
        return $this->queryFactory->newDelete();
    }

    public function save(): void
    {
        $this->assignData();
        if (!isset($this->id)) {
            $this->create();
        } else {
            $this->edit();
        }
    }
    protected function create(): void
    {
        $insert = $this->insert();
        $insert->into(static::TABLE)->cols($this->data);
        $this->db->execute($insert);
    }
    protected function edit(): void
    {
        $update = $this->update();
        $update->table(static::TABLE)->cols($this->data);
        $this->db->execute($update);
    }


}