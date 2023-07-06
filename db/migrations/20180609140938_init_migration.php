<?php


use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class InitMigration extends AbstractMigration
{
        public function change()
        {
                // users
                $table = $this->table('users', ['id' => false, 'primaryKey' => ['uuid']])
                        ->addColumn('uuid', 'uuid', ['null' => false])
                        ->addColumn('email', 'text')
                        ->addColumn('firstname', 'text')
                        ->addColumn('lastname', 'text')
                        ->addColumn('title', 'text', ['null' => true])
                        ->addColumn('companyname', 'text', ['null' => true])
                        ->addColumn('companyaddress', 'text', ['null' => true])
                        ->addColumn('mobile', 'text', ['null' => true])
                        ->addColumn('phone', 'text', ['null' => true])
                        ->addColumn('socialmedia', 'text', ['null' => true])
                        ->addColumn('logo', 'blob', ['null' => true, 'limit' => MysqlAdapter::BLOB_MEDIUM])
                        ->addColumn('created_at', 'timestamp')
                        ->addColumn('updated_at', 'timestamp', ['null' => true])
                        ->addColumn('deleted_at', 'timestamp', ['null' => true])
                        ->create();

                $defaultExpression = 'UUID();';
                $this->execute("ALTER TABLE users ALTER COLUMN uuid SET DEFAULT $defaultExpression");
        }
}
