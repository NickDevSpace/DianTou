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
        $this->call('IndustryTableSeeder');
		$this->call('ProjectTableSeeder');
		$this->call('FollowTableSeeder');
		$this->call('SubscriptionTableSeeder');
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
            'province_code' => '330000',
            'city_code' => 'cx'
        ));
        User::create(array(
            'mobile' => '13857455238',
            'password' => Hash::make('123456'),
            'nickname' => 'Admin',
            'province_code' => '330000',
            'city_code' => 'nb',
            'user_level' => 3
        ));
    }
}

class ProjectTableSeeder extends Seeder {
    public function run()
    {
        DB::table('projects')->delete();
        Project::create(array(
            'project_no' => '201500000001',
			'project_name' => '测试默认项目',
            'project_cover' => 'upload/default.jpg',
            'sub_title' => '测试默认项目子标题',
			'industry_code' => 'I0101',
            'province_code' => '330000',
            'city_code' => 'cx',
			'address' => '慈溪浒山街道',
			'detail' => '<h3>项目展示</h3>',
			'company_name' => '测试公司',
			'legal_person' => '施老板',
			'startup_date' => '2015-01-01',
			'registered_address' => '慈溪市坎墩',
			'registered_capital' => 1000000,
			'organization_code' => '33002221154',
			'legal_id_card' => 'upload/default.jpg',
			'legal_cre_rpt' => 'upload/default.jpg',
			'total_amt' => 3000000,
			'retain_amt' => 1000000,
			'fin_amt' => 2000000,
			'share_count' => 200,
			'amt_per_share' => 10000,
			'fin_days' => 30,
			'user_id' => 1
        ));
		
    }
}


class FollowTableSeeder extends Seeder {
    public function run()
    {
        DB::table('follows')->delete();
        Follow::create(array(
            'project_id' => 1,
            'user_id' => 1,
        ));
    }
}

class SubscriptionTableSeeder extends Seeder {
    public function run()
    {
        Subscription::create(array(
            'project_id' => 1,
            'app_amt' => 1000,
			'app_share' => 0.02,
			'app_state' => '1',
			'user_id' => 1,
        ));
		
		Subscription::create(array(
            'project_id' => 1,
            'ack_amt' => 100000,
			'ack_share' => 0.3,
			'ack_state' => '1',
			'user_id' => 1,
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

class IndustryTableSeeder extends Seeder {
    public function run()
    {
        DB::table('industries')->delete();
        Industry::create(array(
            'industry_code' => 'I01',
            'industry_name' => '美食',
            'parent' => 'I'

        ));
        Industry::create(array(
            'industry_code' => 'I0101',
            'industry_name' => '烧烤',
            'parent' => 'I01'
        ));
        Industry::create(array(
            'industry_code' => 'I0102',
            'industry_name' => '火锅',
            'parent' => 'I01'
        ));
        Industry::create(array(
            'industry_code' => 'I0103',
            'industry_name' => '日料',
            'parent' => 'I01'
        ));

        Industry::create(array(
            'industry_code' => 'I02',
            'industry_name' => '休闲娱乐',
            'parent' => 'I'

        ));

        Industry::create(array(
            'industry_code' => 'I0201',
            'industry_name' => '电影',
            'parent' => 'I02'

        ));

        Industry::create(array(
            'industry_code' => 'I0202',
            'industry_name' => '健身',
            'parent' => 'I02'

        ));

        Industry::create(array(
            'industry_code' => 'I03',
            'industry_name' => '零售',
            'parent' => 'I'
        ));

        Industry::create(array(
            'industry_code' => 'IA0301',
            'industry_name' => '综合零售',
            'parent' => 'I03'
        ));

        Industry::create(array(
            'industry_code' => 'IA0302',
            'industry_name' => '服饰/鞋帽',
            'parent' => 'I03'
        ));

        Industry::create(array(
            'industry_code' => 'IA0303',
            'industry_name' => '珠宝首饰',
            'parent' => 'I03'
        ));

        Industry::create(array(
            'industry_code' => 'IA0304',
            'industry_name' => '水果',
            'parent' => 'I03'
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
