
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('sample::sample_admin.page_search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_sample','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">
            {!! Form::label('sample_name','Name:') !!}
            {!! Form::text('sample_name', null, ['class' => 'form-control', 'placeholder' => trans('sample::sample_admin.sample_name')]) !!}
        </div>

        {!! Form::submit(trans('sample::sample_admin.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>


