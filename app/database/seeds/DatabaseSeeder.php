<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
        $this->call('ProvinceTableSeeder');
        $this->call('CityTableSeeder');
        $this->call('DictTableSeeder');
        //$this->call('SentrySeeder');
	}

}

class UserTableSeeder extends Seeder {
    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'mobile' => '15168102723',
            'password' => Hash::make('123456'),
            'nickname' => 'Cc',
            'province_code' => '10086',
            'city_code' => '10000'
        ));
        User::create(array(
            'mobile' => '13857455238',
            'password' => Hash::make('123456'),
            'nickname' => 'Admin',
            'province_code' => '10086',
            'city_code' => '10000',
            'user_level' => 3
        ));
    }
}

class ProvinceTableSeeder extends Seeder {
    public function run()
    {
        DB::table('provinces')->delete();
        Province::create(array(
            'province_code' => '330000',
            'province_name' => '浙江省',
        ));
        Province::create(array(
            'province_code' => '110000',
            'province_name' => '北京市',
        ));

    }
}

class CityTableSeeder extends Seeder {
    public function run()
    {
        DB::table('cities')->delete();
        City::create(array(
            'city_code' => 'cx',
            'city_name' => '慈溪市',
            'province_code' => '330000'

        ));
        City::create(array(
            'city_code' => 'nb',
            'city_name' => '宁波市',
            'province_code' => '330000'
        ));

        City::create(array(
            'city_code' => 'bj',
            'city_name' => '北京市',
            'province_code' => '110000'
        ));

    }
}

class DictTableSeeder extends Seeder {
    public function run()
    {
        // 1. 概念阶段  2. 筹备中  3. 已运营尚未盈利  3.已运营且已盈利
        DB::table('dicts')->delete();

        Dict::create(array(
            'dict_name' => 'project_stage',
            'key' => '1',
            'value' => '概念阶段'
        ));
        Dict::create(array(
            'dict_name' => 'project_stage',
            'key' => '2',
            'value' => '筹备中'
        ));
        Dict::create(array(
            'dict_name' => 'project_stage',
            'key' => '3',
            'value' => '已运营尚未盈利'
        ));
        Dict::create(array(
            'dict_name' => 'project_stage',
            'key' => '4',
            'value' => '已运营且已盈利'
        ));

        Dict::create(array(
            'dict_name' => 'has_company',
            'key' => 'Y',
            'value' => '是'
        ));

        Dict::create(array(
            'dict_name' => 'has_company',
            'key' => 'N',
            'value' => '否'
        ));

        //1.审核中  2.审核未通过  3.审核通过  4.正在众筹  5.众筹成功  6.众筹失败
        Dict::create(array(
            'dict_name' => 'financing_state',
            'key' => '1',
            'value' => '审核中'
        ));
        Dict::create(array(
            'dict_name' => 'financing_state',
            'key' => '2',
            'value' => '审核未通过'
        ));
        Dict::create(array(
            'dict_name' => 'financing_state',
            'key' => '3',
            'value' => '审核通过'
        ));
        Dict::create(array(
            'dict_name' => 'financing_state',
            'key' => '4',
            'value' => '正在众筹'
        ));
        Dict::create(array(
            'dict_name' => 'financing_state',
            'key' => '5',
            'value' => '众筹失败'
        ));
        Dict::create(array(
            'dict_name' => 'financing_state',
            'key' => '6',
            'value' => '众筹成功'
        ));

    }
}

/**
 * Class SentrySeeder
 * Sentry插件用，目前不用了
 */
class SentrySeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        DB::table('groups')->delete();
        DB::table('users_groups')->delete();

        Sentry::getUserProvider()->create(array(
            'mobile'  => '13857455238',
            'password'    => Hash::make('123456'),
            'email'       => 'admin@admin.com',
            'province_code'   => '100',
            'city_code'   => '200',
            'activated'   => 1,
        ));

        Sentry::getUserProvider()->create(array(
            'mobile'  => '15168102723',
            'password'    => Hash::make('123456'),
            'email'       => '443895389@qq.com',
            'province_code'   => '100',
            'city_code'   => '200',
            'activated'   => 1,
        ));

        Sentry::getGroupProvider()->create(array(
            'name'        => 'Normal',
            'permissions' => array('admin' => 0),
        ));

        Sentry::getGroupProvider()->create(array(
            'name'        => 'Admin',
            'permissions' => array('admin' => 1),
        ));



        // Assign user permissions
        $adminUser  = Sentry::getUserProvider()->findByLogin('13857455238');
        $adminGroup = Sentry::getGroupProvider()->findByName('Admin');
        $adminUser->addGroup($adminGroup);

        $normalUser  = Sentry::getUserProvider()->findByLogin('15168102723');
        $normalGroup = Sentry::getGroupProvider()->findByName('Normal');
        $normalUser->addGroup($normalGroup);
    }

}
