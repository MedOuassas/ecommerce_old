<a href="{{ aurl('admin/'.$id.'/edit') }}" class="btn btn-primary margin"><i class="fa fa-edit fa-fw"></i></a>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_item{{$id}}"><i class="fa fa-trash fa-fw"></i></button>

<div class="modal fade" id="delete_item{{$id}}" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        {!! Form::open(['route'=>['admin.destroy',$id], 'method'=>'delete']) !!}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{ trans('admin.delete')}}</h4>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger">
                <h3>{{ trans('admin.delete_this', ['name'=>$name]) }} ?</h3>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.no')}}</button>
            <button type="submit" class="btn btn-danger" name="del_all">{{ trans('admin.yes')}}</button>
        </div>
        {!! Form::close() !!}
    </div>
  </div>
</div>