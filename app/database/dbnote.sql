--users
id
username
password
mobile
email
sex
realname
crdt_id
birthday
province_code
city_code
avatar
last_login_time
last_login_ip
created_at
updated_at


--project
id
--基础信息
project_name
cover_img
big_point
project_statge
team_size
industry_id
province_code
city_code
--商业计划
business_plan_doc
video_url
user_demand
solution
solution_advantage
market_analysis
development_plan
other
project_album  --json         ['xxx.jpg', 'aaa.png', 'ccc.jpg']
--盈利模式
revenue_driver --收入来源
cost_structure --成本构成json  [{cost_item: '', cost_fee: ''},{cost_item: '', cost_fee: ''}]
financial_data --营业收入json  [{year: '2014', income: 2000, gross_profit: 1000, net_profit: 500}]
--团队成员
team_members   --团队成员json  [{avatar:'', name: '', is_founder: 1, introduction: '', position : '', address: '', phone: '', birthday: '', education_experience: [{school: '', major: '', education: '', start_date: '', end_date: ''}], work_experience: [{company: '', position: '', start_date: '', end_date: '', work_content: ''}]}]
--公司架构
has_company    --是否成立公司
company_info   --公司信息json  {company_name: '', startup_date: '', address: '', registered_capital: 500000, legal_person: '', organization_code: '', business_license: '/xx/aa.jpg', equity_structure: [{shareholder_name: '', title: '', contribution: 100000, share: 0.1}]}
--融资需求
financial_needs --融资需求
transfer_ratio --出让股份比例
min_sub_amt    --最小认购金额
capital_usage  --融资用途
is_verified  --是否审核通过
verified_dt
verifier
created_at
updated_at

total_amt
collect_amt
collect_days
video_url
description
detail
tags
enable_stock_sub --是否支持股份认购
min_sub_amt  --最小认购金额
max_sub_count  --最大认购者数量
verified  --是否审核通过
start_dt
end_dt
created_at
updated_at

--project_subscription
id
project_id
sub_amt
user_id
sub_dt
created_at
updated_at


--project_support_levels
id
project_id
level_alias
support_amt
reward_img
reward_description
max_sub_count
created_at
updated_at


--project_supports
id
project_id  --项目id
level_id     --等级
support_amt   --支持金额
support_note  --捐助人想说的话
user_id  --用户id
support_dt
created_at
updated_at

--project_comments
id
project_id
content
user_id
created_at
updated_at

--industry
id
industry_name
created_at
updated_at

--cities
id
city_code
city_name
created_at
update_at

--provinces
id
province_code
province_name
created_at
update_at

--tags
id
tag_name
created_at
updated_at

--private_msg
id
from
to
msg
created_at
updated_at


--mails
id
user_id
to
subject
body
send_time
created_at
updated_at


