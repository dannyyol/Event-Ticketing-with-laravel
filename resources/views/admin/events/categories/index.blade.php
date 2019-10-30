@extends('layouts.app')

@section('content')
    <h3 class="page-title">Categories</h3>
    
    <p>
        {{-- <a href="{{ route('admin.categories.create') }}" class=""></a> --}}
        {{-- Modal --}}
    @can('category_create')
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
        @lang('quickadmin.qa_add_new')
        </a>
    @endcan
    </p>
   
    
      
      <!-- Modal -->
    <form action="{{route('admin.categories.store')}}" method="POST">
        {{ csrf_field() }}
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                    <label for="">Title:</label>
                    <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">Help text</small>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value='Save changes'>
                </div>
            </div>
            </div>
        </div>
    </form>
      {{-- End of modal --}}
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($categories) > 0 ? 'datatable' : '' }} @can('category_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('category_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.roles.fields.title')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)
                            <tr data-entry-id="{{ $category->id }}">
                                @can('role_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $category->name }}</td>
                                <td>
                                    @can('category_view')
                                    {{-- <a href="{{ route('admin.roles.show',[$role->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a> --}}
                                    @endcan
                                    @can('category_edit')
                                        {{-- <a href="{{ route('admin.categories.edit',[$category->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a> --}}
                                    <!-- Modal -->
                                    {{-- @foreach ($categories as $category)
                                        
                                    @endforeach --}}
                                <a href="#" class="btn btn-xs btn-info" data-toggle="modal" data-target="#{{$category->id}}">@lang('quickadmin.qa_edit')</a>

                                    <form action="{{route('admin.categories.update', $category->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <div class="modal fade" id="{{$category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Title:</label>
                                                        
                                                    
                                                    <input type="text" class="form-control" name="name" value='{{$category->name}}' id="" aria-describedby="helpId" placeholder="">
                                                    <small id="helpId" class="form-text text-muted">Help text</small>
                                                </div>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-primary" value='Save changes'>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </form>
          {{-- End of modal --}}
    
                                    @endcan
                                    @can('category_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.categories.destroy', $category->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('category_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.categories.mass_destroy') }}';
        @endcan

    </script>
@endsection