@extends('......layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">用户</strong> / <small>User</small></div>
</div>
<div class="am-g">
  <div class="am-u-md-6 am-cf">
    <div class="am-fl am-cf">
      <div class="am-btn-toolbar am-fl">
        <div class="am-btn-group am-btn-group-xs">
          <button type="button" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</button>
          <button type="button" class="am-btn am-btn-default"><span class="am-icon-edit"></span> 修改</button>
          <button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
        </div>

        <div class="am-form-group am-margin-left am-fl">
          <select>
            <option value="option1">所有类别</option>
            <option value="option2">IT业界</option>
            <option value="option3">数码产品</option>
            <option value="option3">笔记本电脑</option>
            <option value="option3">平板电脑</option>
            <option value="option3">只能手机</option>
            <option value="option3">超极本</option>
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="am-u-md-3 am-cf">
    <div class="am-fr">
      <div class="am-input-group am-input-group-sm">
        <input type="text" class="am-form-field">
            <span class="am-input-group-btn">
              <button class="am-btn am-btn-default" type="button">搜索</button>
            </span>
      </div>
    </div>
  </div>
</div>


<div class="am-g">
      <div class="am-u-sm-12">
        <form class="am-form">
          <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th class="table-check"><input type="checkbox" /></th><th class="table-id">ID</th><th class="table-title">标题</th><th class="table-type">类别</th><th class="table-author">作者</th><th class="table-date">修改日期</th><th class="table-set">操作</th>
              </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="checkbox" /></td>
              <td>1</td>
              <td><a href="#">Business management</a></td>
              <td>default</td>
              <td>测试1号</td>
              <td>2014年9月4日 7:28:47</td>
              <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</button>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td><input type="checkbox" /></td>
              <td>2</td>
              <td><a href="#">Business management</a></td>
              <td>default</td>
              <td>测试1号</td>
              <td>2014年9月4日 7:28:47</td>
              <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</button>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td><input type="checkbox" /></td>
              <td>3</td>
              <td><a href="#">Business management</a></td>
              <td>default</td>
              <td>测试1号</td>
              <td>2014年9月4日 7:28:47</td>
              <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</button>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td><input type="checkbox" /></td>
              <td>1</td>
              <td><a href="#">Business management</a></td>
              <td>default</td>
              <td>测试1号</td>
              <td>2014年9月4日 7:28:47</td>
              <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</button>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td><input type="checkbox" /></td>
              <td>2</td>
              <td><a href="#">Business management</a></td>
              <td>default</td>
              <td>测试1号</td>
              <td>2014年9月4日 7:28:47</td>
              <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</button>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td><input type="checkbox" /></td>
              <td>3</td>
              <td><a href="#">Business management</a></td>
              <td>default</td>
              <td>测试1号</td>
              <td>2014年9月4日 7:28:47</td>
              <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</button>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td><input type="checkbox" /></td>
              <td>1</td>
              <td><a href="#">Business management</a></td>
              <td>default</td>
              <td>测试1号</td>
              <td>2014年9月4日 7:28:47</td>
              <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</button>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td><input type="checkbox" /></td>
              <td>2</td>
              <td><a href="#">Business management</a></td>
              <td>default</td>
              <td>测试1号</td>
              <td>2014年9月4日 7:28:47</td>
              <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</button>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td><input type="checkbox" /></td>
              <td>3</td>
              <td><a href="#">Business management</a></td>
              <td>default</td>
              <td>测试1号</td>
              <td>2014年9月4日 7:28:47</td>
              <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</button>
                  </div>
                </div>
              </td>
            </tr>

            </tbody>
        </table>
          <div class="am-cf">
      共 15 条记录
          <div class="am-fr">
            <ul class="am-pagination">
              <li class="am-disabled"><a href="#">«</a></li>
              <li class="am-active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">»</a></li>
            </ul>
          </div>
        </div>
      <hr />
      <p>注：.....</p>
    </form>
  </div>

</div>
@stop

@section('page_js')
<script>
    $(function(){

    });

</script>
@stop