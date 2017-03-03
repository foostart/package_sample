<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('groups.edit') !!}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New</a>
    </div>
</div>
@if( ! $samples_categories->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>{{ trans('sample::sample_admin.order') }}</td>
            <th style='width:10%'>ID</th>
            <th style='width:50%'>Sample category name</th>
            <th style='width:20%'>{{ trans('sample::sample_admin.operations') }}</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nav = $samples_categories->toArray();
            $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($samples_categories as $sample_category)
        <tr>
            <td>
                <?php echo $counter; $counter++ ?>
            </td>
            <td>{!! $sample_category->sample_category_id !!}</td>
            <td>{!! $sample_category->sample_category_name !!}</td>
            <td>
                <a href="{!! URL::route('admin_sample.edit', ['id' => $sample_category->sample_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('admin_sample_category.delete',['id' =>  $sample_category->sample_category_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<span class="text-warning"><h5>No results found.</h5></span>
@endif
<div class="paginator">
    {!! $samples_categories->appends($request->except(['page']) )->render() !!}
</div>