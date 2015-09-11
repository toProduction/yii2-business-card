<?php

use yii\db\Schema;
use yii\db\Migration;

class m150804_134614_init extends Migration
{
    public function safeUp ()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%feedback}}', [
            'id'         => Schema::TYPE_PK,
            'subject'    => Schema::TYPE_STRING,
            'name'       => Schema::TYPE_STRING,
            'email'      => Schema::TYPE_STRING,
            'body'       => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'touch'      => Schema::TYPE_SMALLINT,
        ], $tableOptions);

        $this->insert('{{%feedback}}', [
            'id'         => 1,
            'subject'    => 'Hello, message',
            'name'       => 'Samdark',
            'email'      => 'sam@rmcreative.ru',
            'body'       => 'Hello, business card!',
            'created_at' => time(),
            'updated_at' => time(),
            'touch'      => 0,
        ]);

        $this->createTable('{{%menu}}', [
            'id'         => Schema::TYPE_PK,
            'name'       => Schema::TYPE_STRING,
            'status'     => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'user_id'    => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->insert('{{%menu}}', [
            'id'         => '1',
            'name'       => 'The header menu',
            'status'     => 'active',
            'created_at' => time(),
            'updated_at' => time(),
            'user_id'    => '100',
        ]);

        $this->insert('{{%menu}}', [
            'id'         => '2',
            'name'       => 'footer menu',
            'status'     => 'active',
            'created_at' => time(),
            'updated_at' => time(),
            'user_id'    => '100',
        ]);

        $this->createTable('{{%menu_item}}', [
            'id'         => Schema::TYPE_PK,
            'name'       => Schema::TYPE_STRING,
            'user_id'    => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER,
            'page_id'    => Schema::TYPE_INTEGER,
            'menu_id'    => Schema::TYPE_INTEGER,
            'url'        => Schema::TYPE_TEXT,
            'status'     => Schema::TYPE_STRING,
            'parent_id'  => Schema::TYPE_INTEGER,
            'position'   => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->insert('{{%menu_item}}', [
            'id'         => 1,
            'name'       => 'About',
            'user_id'    => 100,
            'created_at' => time(),
            'page_id'    => NULL,
            'menu_id'    => 1,
            'url'        => '#',
            'status'     => 'active',
            'parent_id'  => 0,
            'position'   => 0,
        ]);

        $this->insert('{{%menu_item}}', [
            'id'         => 2,
            'name'       => '',
            'user_id'    => 100,
            'created_at' => time(),
            'page_id'    => 2,
            'menu_id'    => 1,
            'url'        => NULL,
            'status'     => 'active',
            'parent_id'  => 0,
            'position'   => 1,
        ]);

        $this->insert('{{%menu_item}}', [
            'id'         => 9,
            'name'       => '',
            'user_id'    => 100,
            'created_at' => time(),
            'page_id'    => 3,
            'menu_id'    => 1,
            'url'        => NULL,
            'status'     => 'active',
            'parent_id'  => 1,
            'position'   => 0,
        ]);

        $this->insert('{{%menu_item}}', [
            'id'         => 10,
            'name'       => 'Item',
            'user_id'    => 100,
            'created_at' => time(),
            'page_id'    => NULL,
            'menu_id'    => 1,
            'url'        => '#',
            'status'     => 'active',
            'parent_id'  => 1,
            'position'   => 1,
        ]);


        $this->insert('{{%menu_item}}', [
            'id'         => 11,
            'name'       => 'Item',
            'user_id'    => 100,
            'created_at' => time(),
            'page_id'    => NULL,
            'menu_id'    => 2,
            'url'        => '#',
            'status'     => 'active',
            'parent_id'  => 0,
            'position'   => 0,
        ]);

        $this->insert('{{%menu_item}}', [
            'id'         => 12,
            'name'       => 'Item 2',
            'user_id'    => 100,
            'created_at' => time(),
            'page_id'    => NULL,
            'menu_id'    => 2,
            'url'        => '#',
            'status'     => 'active',
            'parent_id'  => 0,
            'position'   => 1,
        ]);

        $this->insert('{{%menu_item}}', [
            'id'         => 13,
            'name'       => 'News',
            'user_id'    => 100,
            'created_at' => time(),
            'page_id'    => NULL,
            'menu_id'    => 1,
            'url'        => '/index.php?r=site/posts',
            'status'     => 'active',
            'parent_id'  => 0,
            'position'   => 2,
        ]);

        $this->createTable('{{%page}}', [
            'id'               => Schema::TYPE_PK,
            'name'             => Schema::TYPE_TEXT,
            'description'      => Schema::TYPE_TEXT,
            'full_text'        => Schema::TYPE_TEXT,
            'user_id'          => Schema::TYPE_INTEGER,
            'created_at'       => Schema::TYPE_INTEGER,
            'updated_at'       => Schema::TYPE_INTEGER,
            'alias'            => Schema::TYPE_STRING,
            'title'            => Schema::TYPE_STRING,
            'meta_keywords'    => Schema::TYPE_STRING,
            'meta_description' => Schema::TYPE_STRING,
            'menu_id'          => Schema::TYPE_INTEGER,
            'status'           => Schema::TYPE_STRING,
            'template'         => Schema::TYPE_STRING,
        ], $tableOptions);

        $this->insert('{{%page}}', [
            'id'               => 1,
            'name'             => 'Main page',
            'description'      => NULL,
            'full_text'        => '<p>Main page</p>',
            'user_id'          => 100,
            'created_at'       => time(),
            'updated_at'       => time(),
            'alias'            => '',
            'title'            => 'Main page title',
            'meta_keywords'    => 'main page, my site, business card',
            'meta_description' => 'My site on yii2 business card template',
            'menu_id'          => NULL,
            'status'           => 'active',
            'template'         => '',
        ]);

        $this->insert('{{%page}}', [
            'id'               => 2,
            'name'             => 'Contact',
            'description'      => NULL,
            'full_text'        => '<p>Our contact</p>',
            'user_id'          => 100,
            'created_at'       => time(),
            'updated_at'       => time(),
            'alias'            => '',
            'title'            => 'Our contacts',
            'meta_keywords'    => 'contacts, business, card',
            'meta_description' => 'Our contacts business card',
            'menu_id'          => NULL,
            'status'           => 'active',
            'template'         => 'contact.php',
        ]);

        $this->insert('{{%page}}', [
            'id'               => 3,
            'name'             => 'About',
            'description'      => NULL,
            'full_text'        => '<p>About us</p>',
            'user_id'          => 100,
            'created_at'       => time(),
            'updated_at'       => time(),
            'alias'            => 'about',
            'title'            => 'About us',
            'meta_keywords'    => 'about, about us',
            'meta_description' => 'About us',
            'menu_id'          => NULL,
            'status'           => 'active',
            'template'         => '',
        ]);

        $this->createTable('{{%param}}', [
            'key'     => Schema::TYPE_STRING,
            'value'   => Schema::TYPE_TEXT,
            'comment' => Schema::TYPE_STRING,
        ], $tableOptions);

        $this->insert('{{%param}}', [
            'key'     => 'companyName',
            'value'   => 'Business Card',
            'comment' => 'Company name',
        ]);

        $this->insert('{{%param}}', [
            'key'     => 'contactEmail',
            'value'   => 'info@site.com',
            'comment' => 'Contact email',
        ]);

        $this->insert('{{%param}}', [
            'key'     => 'mainPageId',
            'value'   => '1',
            'comment' => 'Main page ID',
        ]);

        $this->insert('{{%param}}', [
            'key'     => 'siteOffMessage',
            'value'   => 'The Site is underconstruction',
            'comment' => 'Message when the site is off',
        ]);

        $this->insert('{{%param}}', [
            'key'     => 'siteStatus',
            'value'   => 'on',
            'comment' => 'Site status',
        ]);

        $this->insert('{{%param}}', [
            'key'     => 'title',
            'value'   => 'My site',
            'comment' => 'Site name',
        ]);

        $this->createTable('{{%post}}', [
            'id'               => Schema::TYPE_PK,
            'name'             => Schema::TYPE_TEXT,
            'alias'            => Schema::TYPE_STRING,
            'body'             => Schema::TYPE_TEXT,
            'description'      => Schema::TYPE_TEXT,
            'title'            => Schema::TYPE_STRING,
            'meta_description' => Schema::TYPE_STRING,
            'meta_keywords'    => Schema::TYPE_STRING,
            'created_at'       => Schema::TYPE_INTEGER,
            'updated_at'       => Schema::TYPE_INTEGER,
            'user_id'          => Schema::TYPE_INTEGER,
            'status'           => Schema::TYPE_STRING,
        ], $tableOptions);

        $this->insert('{{%post}}', [
            'id'               => 1,
            'name'             => 'First post.',
            'alias'            => '',
            'body'             => '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
            'description'      => '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
            'title'            => '',
            'meta_description' => '',
            'meta_keywords'    => '',
            'created_at'       => time(),
            'updated_at'       => time(),
            'user_id'          => 100,
            'status'           => 'active',
        ]);

        $this->insert('{{%post}}', [
            'id'               => 2,
            'name'             => 'Second post.',
            'alias'            => '',
            'body'             => '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
            'description'      => '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
            'title'            => '',
            'meta_description' => '',
            'meta_keywords'    => '',
            'created_at'       => time(),
            'updated_at'       => time(),
            'user_id'          => 100,
            'status'           => 'active',
        ]);
    }

    public function safeDown ()
    {
        $this->dropTable('{{%feedback}}');
        $this->dropTable('{{%menu}}');
        $this->dropTable('{{%menu_item}}');
        $this->dropTable('{{%page}}');
        $this->dropTable('{{%param}}');
    }

}
