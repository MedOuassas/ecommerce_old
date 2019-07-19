@extends('admin.index')
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <a href="{{aurl('categories/create')}}" class="btn btn-info margin">
                <i class="fa fa-plus"></i> {{ trans('admin.create')}}
            </a>
            <a href="" class="btn btn-primary edit_categ showbtn hidden">
                <i class="fa fa-edit"></i> {{ trans('admin.edit')}}
            </a>
            <a href="" class="btn btn-danger margin delete_categ showbtn hidden" data-toggle="modal" data-target="#delete_modal">
                <i class="fa fa-trash"></i> {{ trans('admin.delete')}}
            </a>
        </div>
    </div>
    <div id="jstree_categories"></div>
    <input type="hidden" name="parent" class="parent_id" value="">
</div>
<div id="delete_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('admin.delete_all')}}</h4>
            </div>
            {!! Form::open(['id' => 'delete', 'method' => 'delete']) !!}
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h3>{{ trans('admin.ask_delete_this')}} <span class="title_categ"></span> ?</h3>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.no')}}</button>
                <button type="submit" class="btn btn-danger del_all">{{ trans('admin.yes')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@push('jscript')
<script>
    $(function () {
        $('#jstree_categories').jstree({
            "core": {
                "themes": {
                    "variant": "large"
                },
                'data' : {!! load_category() !!} ,
                'opened' : true
            },
            "checkbox": {
                "keep_selected_style": false
            },
            "plugins": ["wholerow"]
        });

        $('#jstree_categories').on('changed.jstree', function (e,data) {
            var categ_selected = data.selected[0];
            $('.parent_id').val(categ_selected);
            categ_selected.length ? $('.showbtn').removeClass('hidden'):$('.showbtn').addClass('hidden');
            $('.edit_categ').attr('href', '{{ aurl('categories') }}/'+categ_selected+'/edit');
            $(document).on('click','.delete_categ', function (e) {
                e.preventDefault();
                $('#delete').attr('action', '{{ aurl('categories') }}/'+categ_selected);
                $('.title_categ').text(data.node.text);
                $('#delete_modal').modal('show');
            });
        });
    });
</script>
@endpush

@endsection
