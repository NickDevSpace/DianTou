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
        $this->call('PrivateMessageTableSeeder');
        $this->call('ProvinceTableSeeder');
        $this->call('CityTableSeeder');
        $this->call('SystemDictsTableSeeder');
        $this->call('IndustryTableSeeder');
		$this->call('ProjectTableSeeder');
		$this->call('FollowTableSeeder');
        $this->call('CommentTableSeeder');
		//$this->call('AppointmentTableSeeder');
		//$this->call('SubscriptionTableSeeder');
        //$this->call('SentrySeeder');
	}

}

class UserTableSeeder extends Seeder {
    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
            'account' => '15201926937',
            'password' => Hash::make('123456'),
            'nickname' => '管理员',
            'province_code' => '330000',
            'city_code' => 'cx',
            'user_type' => '1',
            'user_level' => '3'
        ));

        UserinfoPrivate::create(array(
            'user_id' => 1,
            'mobile' => '15201926937'
        ));

        User::create(array(
            'account' => '15168102723',
            'password' => Hash::make('123456'),
            'nickname' => '冲比冲',
            'province_code' => '330000',
            'city_code' => 'cx',
            'user_type' => '1',
            'user_level' => '1'
        ));

        UserinfoPrivate::create(array(
            'user_id' => 2,
            'mobile' => '15168102723'
        ));

        User::create(array(
            'account' => '443895389@qq.com',
            'password' => Hash::make('123456'),
            'nickname' => '点投科技',
            'province_code' => '330000',
            'city_code' => 'yy',
            'user_type' => '2',
            'user_level' => '1'
        ));

        UserinfoEnterprise::create(array(
            'user_id' => 3,
            'email' => '443895389@qq.com'
        ));


    }
}

class PrivateMessageTableSeeder extends Seeder{
    public function run()
    {
        DB::table('private_messages')->delete();
        PrivateMessage::create(array(
            'sender' => 3,
            'receiver' => 2,
            'content' => 'Hello world1'
        ));
        PrivateMessage::create(array(
            'sender' => 3,
            'receiver' => 2,
            'content' => '你在说撒'
        ));

        PrivateMessage::create(array(
            'sender' => 3,
            'receiver' => 2,
            'content' => '2B'
        ));
        PrivateMessage::create(array(
            'sender' => 2,
            'receiver' => 3,
            'content' => '。。。。。。'
        ));
        PrivateMessage::create(array(
            'sender' => 2,
            'receiver' => 3,
            'content' => '算求'
        ));
        PrivateMessage::create(array(
            'sender' => 3,
            'receiver' => 2,
            'content' => '我是小白'
        ));
        PrivateMessage::create(array(
            'sender' => 1,
            'receiver' => 2,
            'content' => '我是小白'
        ));

    }
}

class ProjectTableSeeder extends Seeder {
    public function run()
    {
        DB::table('projects')->delete();
        Project::create(array(
            'project_no' => '201500000001',
			'project_name' => '测试项目',
            'project_cover' => 'upload/default.jpg',
            'sub_title' => '测试项目子标题',
			'industry_code' => 'I0101',
            'province_code' => '330000',
            'city_code' => 'cx',
			'address' => '慈溪浒山街道',
			'detail' => '<h3>项目展示</h3>',
			'raise_quota' => 3000000,
            'min_raise_quota' => 2500000,
            'max_raise_quota' => 3500000,
            'min_sub_quota' => 20000,
            'retain_stockholder' => 3,
            'assign_share' => 40,
			'raise_days' => 30,
			'allow_nolocal' => 'Y',
			'user_id' => 1
        ));

        Project::create(array(
            'project_no' => '201500000002',
            'project_name' => '烤鱼店',
            'project_cover' => 'upload/default.jpg',
            'sub_title' => '烤鱼店烤鱼店烤鱼店',
            'industry_code' => 'I0101',
            'province_code' => '330000',
            'city_code' => 'cx',
            'address' => '慈溪坎墩街道',
            'detail' => '<h3>项目展示</h3>',
            'raise_quota' => 2000000,
            'min_raise_quota' => 1800000,
            'max_raise_quota' => 3200000,
            'min_sub_quota' => 20000,
            'retain_stockholder' => 1,
            'assign_share' => 40,
            'raise_days' => 45,
            'raise_start_date' => '2015-04-15',
            'raise_end_date' => '2015-05-25',
            'state' => 'RAISE',
            'allow_nolocal' => 'Y',
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

class AppointmentTableSeeder extends Seeder {
    public function run()
    {
		Appointment::create(array(
            'project_id' => 1,
			'app_part_count' => 5,
            'app_amt' => 50000,
			'app_share' => 0.03,
			'app_margin_amt' => 5000,
			'app_time' => date('Y-m-d H:i:s', time()),
			'state' => '1',
			'user_id' => 1,
        ));
        
    }
}

class CommentTableSeeder extends seeder {
     public function run()
     {
          Comment::create(array(
               'project_id' => 1,
               'user_id' => 1,
               'content' => '不错哦',
          ));
     }
}

class SubscriptionTableSeeder extends Seeder {
    public function run()
    {
        Subscription::create(array(
            'project_id' => 1,
            'sub_amt' => 50000,
			'sub_time' => date('Y-m-d H:i:s', time()),
			'state' => '1',
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
            'city_code' => 'nb',
            'city_name' => '宁波市',
            'province_code' => '330000'
        ));
		
        City::create(array(
            'city_code' => 'cx',
            'city_name' => '慈溪市',
            'province_code' => '330000'

        ));
		
		City::create(array(
            'city_code' => 'yy',
            'city_name' => '余姚市',
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



class SystemDictsTableSeeder extends Seeder {
    public function run()
    {

        DB::table('system_dicts')->delete();

        // 项目状态
        SystemDict::create(array(
            'dict_name' => 'PROJECT_STATE',
            'dict_key' => 'SAVE_DRAFT',
            'dict_value' => '保存草稿'
        ));
        SystemDict::create(array(
            'dict_name' => 'PROJECT_STATE',
            'dict_key' => 'SUBMIT_AUDIT',
            'dict_value' => '提交审核'
        ));
        SystemDict::create(array(
            'dict_name' => 'PROJECT_STATE',
            'dict_key' => 'AUDIT_FAILED',
            'dict_value' => '审核未通过'
        ));
        SystemDict::create(array(
            'dict_name' => 'PROJECT_STATE',
            'dict_key' => 'AUDIT_PASS',
            'dict_value' => '审核通过'
        ));
        SystemDict::create(array(
            'dict_name' => 'PROJECT_STATE',
            'dict_key' => 'ROADSHOW',
            'dict_value' => '路演中'
        ));
        SystemDict::create(array(
            'dict_name' => 'PROJECT_STATE',
            'dict_key' => 'RAISE',
            'dict_value' => '融资中'
        ));
        SystemDict::create(array(
            'dict_name' => 'PROJECT_STATE',
            'dict_key' => 'RAISE_FAILED',
            'dict_value' => '融资失败'
        ));
        SystemDict::create(array(
            'dict_name' => 'PROJECT_STATE',
            'dict_key' => 'RAISE_SUCCESS',
            'dict_value' => '融资成功'
        ));
        SystemDict::create(array(
            'dict_name' => 'PROJECT_STATE',
            'dict_key' => 'SHARE_OUT_BONUS',
            'dict_value' => '分红'
        ));
        SystemDict::create(array(
            'dict_name' => 'PROJECT_STATE',
            'dict_key' => 'END',
            'dict_value' => '项目结束'
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



        // Assign user-mgr permissions
        $adminUser  = Sentry::getUserProvider()->findByLogin('13857455238');
        $adminGroup = Sentry::getGroupProvider()->findByName('Admin');
        $adminUser->addGroup($adminGroup);

        $normalUser  = Sentry::getUserProvider()->findByLogin('15168102723');
        $normalGroup = Sentry::getGroupProvider()->findByName('Normal');
        $normalUser->addGroup($normalGroup);
    }

}
