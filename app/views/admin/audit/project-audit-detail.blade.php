@extends('......layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">项目审核</strong> / <small>Project Audit</small></div>
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
          <form id="form" action="{{{action('AdminAuditController@postDoProjectAudit')}}}" method="post">
                <h3>项目基本信息</h3>
                <hr/>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">项目名称</div>
                  <div class="am-u-sm-9">
                        <a href="{{{action('ProjectController@getShow', array($project->id))}}}">{{{$project->project_name}}}</a>
                  </div>
                </div>

                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">所在城市</div>
                  <div class="am-u-sm-9">
                    {{{$project->province['province_name']}}}&nbsp;{{{$project->city['city_name']}}}
                  </div>
                </div>

                <h3>融资信息</h3>
                <hr/>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">融资需求金额</div>
                  <div class="am-u-sm-9">
                        {{{$project->raise_quota}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">最大融资阈值</div>
                  <div class="am-u-sm-9">
                        {{{$project->max_raise_quota}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">最小融资阈值</div>
                  <div class="am-u-sm-9">
                        {{{$project->min_raise_quota}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">当前股东人数</div>
                  <div class="am-u-sm-9">
                        {{{$project->retain_stockholder}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">出让股份占比</div>
                  <div class="am-u-sm-9">
                        {{{$project->assign_share}}}%
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">单人最小投资金额</div>
                  <div class="am-u-sm-9">
                        {{{$project->min_sub_quota}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">融资期限</div>
                  <div class="am-u-sm-9">
                        {{{$project->raise_days}}}天
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">是否允许其他地区用户认购</div>
                  <div class="am-u-sm-9">
                        @if($project->allow_nolocal == 'Y') 是 @else 否 @endif
                  </div>
                </div>
                <h3>发起人信息</h3>
                <hr/>
                <?php $user = $project->user;?>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">账号</div>
                  <div class="am-u-sm-9">
                        {{{$user->account}}}
                  </div>
                </div>

                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">用户类型</div>
                  <div class="am-u-sm-9">
                    @if($user->user_type == '1')个人@else 企业 @endif
                  </div>
                </div>

                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">用户昵称</div>
                  <div class="am-u-sm-9">
                    {{{$user->nickname}}}
                  </div>
                </div>

                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">所在城市</div>
                  <div class="am-u-sm-9">
                    {{{$user->province['province_name']}}}&nbsp;{{{$user->city['city_name']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">注册时间</div>
                  <div class="am-u-sm-9">
                    {{{$user->created_at}}}
                  </div>
                </div>


                @if($user['user_type'] == '1')
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">真实姓名</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['real_name']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">手机号</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['mobile']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">联系地址</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['address']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">生日</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['birthday']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">性别</div>
                  <div class="am-u-sm-9">
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
                  <div class="am-u-sm-3 am-text-right">身份证号码</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['crdt_id']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">身份证正面</div>
                  <div class="am-u-sm-9">
                        <img src="/{{{$user->userinfo['crdt_photo_a']}}}">
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">身份证反面</div>
                  <div class="am-u-sm-9">
                        <img src="/{{{$user->userinfo['crdt_photo_b']}}}">
                  </div>
                </div>
                @else
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">公司名称</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['company_name']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">邮箱</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['email']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">联系地址</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['address']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">联系电话</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['telephone']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">营业执照注册号</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['biz_lic_id']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">营业执照注册地址</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['biz_lic_addr']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">营业执照到期日期</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['biz_exp_dt']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">营业执照照片</div>
                  <div class="am-u-sm-9">
                        <img src="/{{{$user->userinfo['biz_lic_photo']}}}">
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">营业执照照片（盖章）</div>
                  <div class="am-u-sm-9">
                        <img src="/{{{$user->userinfo['biz_lic_photo_sealed']}}}">
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">组织机构代码</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['org_code']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">营业范围</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['business_scope']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">公司成立日期</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['startup_dt']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">注册资金</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['reg_capital']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">法人代表姓名</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['legal_name']}}}
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">法人代表身份证号</div>
                  <div class="am-u-sm-9">
                        {{{$user->userinfo['legal_crdt_id']}}}
                  </div>
                </div>

                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">法人代表身份证正面</div>
                  <div class="am-u-sm-9">
                        <img src="/{{{$user->userinfo['legal_crdt_photo_a']}}}">
                  </div>
                </div>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">法人代表身份证反面</div>
                  <div class="am-u-sm-9">
                        <img src="/{{{$user->userinfo['legal_crdt_photo_b']}}}">
                  </div>
                </div>
                @endif
                <h3>审核意见</h3>
                <hr/>
                <div class="am-g am-margin-top">
                  <div class="am-u-sm-3 am-text-right">审核意见</div>
                  <div class="am-u-sm-9">
                        <textarea id="i-audit-comment" style="height:200px; width:450px" name="audit_comment" placeholder="若不通过请填写原因" required></textarea>
                  </div>
                </div>
                <div class="am-u-sm-3 am-u-sm-centered">
                    <div class="am-margin">

                        <input type="hidden" name="audit_state" value="">
                        <input type="hidden" name="audit_apply_id" value="{{{$audit_apply_id}}}">
                        <button id="pass-btn" type="button" class="am-btn am-btn-primary">审核通过</button>
                        <button id="deny-btn" type="button" class="am-btn am-btn-default">审核不通过</button>

                    </div>

                </div>
          </form>
      </div>


</div>
@stop

@section('page_js')
<script>
    $(function(){
        $('#pass-btn').on('click', function(){
            if(confirm('确认该项目通过审核？')){
                $('input[name="audit_state"]').val(1);
                if(checkForm()){
                    $('#form').submit();
                }
            }
        });

        $('#deny-btn').on('click', function(){
            if(confirm('确认该项目不通过审核？')){
                $('input[name="audit_state"]').val(2);
                if(checkForm()){
                    $('#form').submit();
                }
            }
        });

        function checkForm(){
            if($('#i-audit-comment').val().trim() == ''){
                $('<span class="am-text-danger">请填写审核意见</span>').appendTo($('#i-audit-comment').parent());
                return false;
            }else{
                $('#i-audit-comment').parent().find('.am-text-danger').remove();
                return true;
            }
        }
    });

</script>
@stop