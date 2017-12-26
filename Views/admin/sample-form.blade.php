<!------------------------------------------------------------------------------
| List of elements in sample form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['samples.post', 'id' => @$sample->id, 'context' => $request->get('context')],  'files'=>true, 'method' => 'post'])  !!}

<ul class="nav nav-tabs">
    <!--MENU 1-->
    <li class="active">
        <a data-toggle="tab" href="#menu_1">
            {!! trans($plang_admin.'.menu_1') !!}
        </a>
    </li>

    <!--MENU 2-->
    <li>
        <a data-toggle="tab" href="#menu_2">
            {!! trans($plang_admin.'.menu_2') !!}
        </a>
    </li>

    <!--MENU 3-->
    <li>
        <a data-toggle="tab" href="#menu_3">
            {!! trans($plang_admin.'.menu_3') !!}
        </a>
    </li>
</ul>

<div class="tab-content">

    <!--CONTENT MENU 1-->
    <div id="menu_1" class="tab-pane fade in active">

        <!--SAMPLE NAME-->
        @include('package-category::admin.partials.input_text', [
        'name' => 'sample_name',
        'label' => trans($plang_admin.'.sample_name'),
        'value' => @$sample->sample_name,
        'description' => trans($plang_admin.'.sample-name-description'),
        'errors' => $errors,
        ])
        <!--/SAMPLE NAME-->

        <!-- LIST OF CATEGORIES -->
        @include('package-category::admin.partials.select_single', [
        'name' => 'category_id',
        'label' => trans($plang_admin.'.lb-sample-category'),
        'items' => $samples,
        'value' => @$sample->sample_id_parent,
        'description' => trans($plang_admin.'.sample-category-description'),
        'errors' => $errors,
        ])
        <!-- /LIST OF CATEGORIES -->
    </div>

    <!--CONTENT MENU 2-->
    <div id="menu_2" class="tab-pane fade">
        <h3>Menu 1</h3>
        <p>Some content in menu 1.</p>
    </div>

    <!--CONTENT MENU 3-->
    <div id="menu_3" class="tab-pane fade">
        <h3>Menu 2</h3>
        <p>Some content in menu 2.</p>
    </div>

</div>

<div class='hidden-field'>
    {!! Form::hidden('id',@$sample->id) !!}
    {!! Form::hidden('context',$request->get('context',null)) !!}
</div>

<div class='btn-form'>
    <!-- DELETE BUTTON -->
    <a href="{!! URL::route('samples.delete',['id' => @$sample->id, '_token' => csrf_token()]) !!}"
    class="btn btn-danger pull-right margin-left-5 delete">
    {!! trans($plang_admin.'.btn_delete') !!}
    </a>
    <!-- DELETE BUTTON -->

    <!-- SAVE BUTTON -->
    {!! Form::submit(trans($plang_admin.'.btn_save'), array("class"=>"btn btn-info pull-right ")) !!}
    <!-- /SAVE BUTTON -->
</div>
{!! Form::close() !!}
<!------------------------------------------------------------------------------
| End list of elements in sample form
|------------------------------------------------------------------------------>