<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


    	// seed permissions
    	DB::statement("

			INSERT INTO `permissions` 
						(`id`, 
						`name`, 
						`display_name`, 
						`description`, 
						`created_at`, 
						`updated_at`) 
						VALUES
						(1, 
						'create-news', 
						'create news', 
						'Who can create news', 
						NULL, 
						NULL),
						(2, 
						'edit-news', 
						'edit news', 
						'Who can edit news', 
						NULL, 
						NULL),
						(3, 
						'delete-news', 
						'delete news', 
						'Who can delete news', 
						NULL, 
						NULL),
						(4, 
						'manage-urgent-news', 
						'manage urgent news', 
						'Who can manage urgent news (Add/Update/Delete)', 
						NULL, 
						NULL),
						(5, 
						'manage-users', 
						'manage users', 
						'Who can manage users (Add/Update/Delete)', 
						NULL, 
						NULL),
						(6, 
						'change-user-role', 
						'manage users roles', 
						'Who can change users roles', 
						NULL, 
						NULL);
					");
    	// seed roles
		DB::statement("
			INSERT INTO `roles` (`id`, `name`, `display_name`, `description`) VALUES
			(1, 'admin', 'Admin', 'Admin'),
			(2, 'revise-editor', 'Revise Editor', 'Revise Editor'),
			(3, 'editor', 'Editor', 'Editor'); 
		");


		// seed permission_role
        DB::statement("

			INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
			(1, 1),
			(2, 1),
			(3, 1),
			(4, 1),
			(5, 1),
			(6, 1),
			(1, 2),
			(2, 2),
			(3, 2),
			(1, 3);
        ");

        // seed Admin user
        $password = bcrypt('VestnikEgyptAdmin2018');
        DB::statement("

			INSERT INTO `users` (`id`, `name`, `email`, `password`,`blocked`,`deleted`) VALUES
			(1, 'Admin', 'admin@vestnikegypt.com', '$password', 0, 0);

        ");

        // seed role user
        DB::statement(" INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (1, 1); ");

        // seed categories
        DB::statement(" INSERT INTO `categories` (`id`) VALUES (1), (2), (3), (4); ");

        // seed categories translations
        DB::statement(" INSERT INTO `category_translations` (`id`,`category_id`,`name`,`discription`,`locale`) 
        				VALUES 
        				(1, 1,'سياسة' ,'', 'ar'), 
        				(2, 1,'Политика' ,'', 'ru'), 
        				(3, 2,'اقتصاد' ,'', 'ar'), 
        				(4, 2,'Экономика' ,'', 'ru'), 
        				(5, 3,'رياضة' ,'', 'ar'), 
        				(6, 3,'Спорт' ,'', 'ru'), 
        				(7, 4,'ثقافة ومجتمع' ,'', 'ar'), 
        				(8, 4,'Культура и Общество' ,'', 'ru'); 
        			");


        // $this->call(UsersTableSeeder::class);
    }
}
