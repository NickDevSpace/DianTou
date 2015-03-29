@extends('......layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">用户</strong> / <small>User</small></div>
</div>
<div class="am-g">

        <div class="am-u-md-6 am-cf">
        <div class="am-fl am-cf">
          <div class="am-btn-toolbar am-fl">

          </div>
        </div>
        </div>
        <div class="am-u-md-3 am-cf">
        <div class="am-fr">
          <button type="button" class="admin-back-btn am-btn am-btn-default">返回</button>
        </div>
        </div>

</div>

<div class="am-g">
      <div class="am-u-sm-12">
            <h3>基本信息</h3>
            <hr/>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">账号</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->account}}}
              </div>
            </div>

            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">用户类型</div>
              <div class="am-u-sm-8 am-u-md-10">
                @if($user->user_type == '1')个人@else 企业 @endif
              </div>
            </div>

            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">用户昵称</div>
              <div class="am-u-sm-8 am-u-md-10">
                {{{$user->nickname}}}
              </div>
            </div>

            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">所在城市</div>
              <div class="am-u-sm-8 am-u-md-10">
                {{{$user->province['province_name']}}}&nbsp;{{{$user->city['city_name']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">注册时间</div>
              <div class="am-u-sm-8 am-u-md-10">
                {{{$user->created_at}}}
              </div>
            </div>
            <h3>认证信息</h3>
            <hr/>
            @if($user->user_type == '1')
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">真实姓名</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['real_name']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">手机号</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['mobile']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">联系地址</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['address']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">生日</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['birthday']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">性别</div>
              <div class="am-u-sm-8 am-u-md-10">
                    @if($user->userinfo['sex'] == '1')
                        男
                    @elseif($user->userinfo['sex'] == '2')
                        女
                    @else
                        保密
                    @endif
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">身份证号码</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['crdt_id']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">身份证正面</div>
              <div class="am-u-sm-8 am-u-md-10">
                    <img src="/{{{$user->userinfo['crdt_photo_a']}}}">
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">身份证反面</div>
              <div class="am-u-sm-8 am-u-md-10">
                    <img src="/{{{$user->userinfo['crdt_photo_b']}}}">
              </div>
            </div>
            @else
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">公司名称</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['company_name']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">邮箱</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['email']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">联系地址</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['address']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">联系电话</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['telephone']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">营业执照注册号</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['biz_lic_id']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">营业执照注册地址</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['biz_lic_addr']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">营业执照到期日期</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['biz_exp_dt']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">营业执照照片</div>
              <div class="am-u-sm-8 am-u-md-10">
                    <img src="/{{{$user->userinfo['biz_lic_photo']}}}">
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">营业执照照片（盖章）</div>
              <div class="am-u-sm-8 am-u-md-10">
                    <img src="/{{{$user->userinfo['biz_lic_photo_sealed']}}}">
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">组织机构代码</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['org_code']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">营业范围</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['business_scope']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">公司成立日期</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['startup_dt']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">注册资金</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['reg_capital']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">法人代表姓名</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['legal_name']}}}
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">法人代表身份证号</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$user->userinfo['legal_crdt_id']}}}
              </div>
            </div>

            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">法人代表身份证正面</div>
              <div class="am-u-sm-8 am-u-md-10">
                    <img src="/{{{$user->userinfo['legal_crdt_photo_a']}}}">
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">法人代表身份证反面</div>
              <div class="am-u-sm-8 am-u-md-10">
                    <img src="/{{{$user->userinfo['legal_crdt_photo_b']}}}">
              </div>
            </div>
            @endif
            <div class="am-u-sm-3 am-u-sm-centered">
                <div class="am-margin">
                <form id="form" action="{{{action('AdminAuditController@postDoUserCertify')}}}" method="post">
                    <input type="hidden" name="audit_flag" value="">
                    <input type="hidden" name="user_id" value="{{{$user->id}}}">
                    <button id="pass-btn" type="button" class="am-btn am-btn-primary">审核通过</button>
                    <button id="deny-btn" type="button" class="am-btn am-btn-default">审核不通过</button>
                </form>
                </div>

            </div>
      </div>


</div>
@stop

@section('page_js')
<script>
    $(function(){
        $('#pass-btn').on('click', function(){
            if(confirm('确认该用户通过实名认证？')){
                $('input[name="audit_flag"]').val(1);
                $('#form').submit();
            }
        });

        $('#deny-btn').on('click', function(){
            if(confirm('确认该用户不通过实名认证？')){
                $('input[name="audit_flag"]').val(0);
                $('#form').submit();
            }
        });
    });

</script>
@stop