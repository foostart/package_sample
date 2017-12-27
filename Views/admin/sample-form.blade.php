<!------------------------------------------------------------------------------
| List of elements in sample form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['samples.post', 'id' => @$sample->id],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTONS-->
    <div class='btn-form'>
        <!-- DELETE BUTTON -->
        <a href="{!! URL::route('samples.delete',['id' => @$sample->id, '_token' => csrf_token()]) !!}"
        class="btn btn-danger pull-right margin-left-5 delete">
        {!! trans($plang_admin.'.buttons.delete') !!}
        </a>
        <!-- DELETE BUTTON -->

        <!-- SAVE BUTTON -->
        {!! Form::submit(trans($plang_admin.'.buttons.save'), array("class"=>"btn btn-info pull-right ")) !!}
        <!-- /SAVE BUTTON -->
    </div>
    <!--/BUTTONS-->

    <!--TAB MENU-->
    <ul class="nav nav-tabs">
        <!--MENU 1-->
        <li class="active">
            <a data-toggle="tab" href="#menu_1">
                {!! trans($plang_admin.'.tabs.menu_1') !!}
            </a>
        </li>

        <!--MENU 2-->
        <li>
            <a data-toggle="tab" href="#menu_2">
                {!! trans($plang_admin.'.tabs.menu_2') !!}
            </a>
        </li>

        <!--MENU 3-->
        <li>
            <a data-toggle="tab" href="#menu_3">
                {!! trans($plang_admin.'.tabs.menu_3') !!}
            </a>
        </li>
    </ul>
    <!--/TAB MENU-->

    <!--TAB CONTENT-->
    <div class="tab-content">

        <!--MENU 1-->
        <div id="menu_1" class="tab-pane fade in active">

            <!--SAMPLE NAME-->
            @include('package-category::admin.partials.input_text', [
            'name' => 'sample_name',
            'label' => trans($plang_admin.'.labels.name'),
            'value' => @$sample->sample_name,
            'description' => trans($plang_admin.'.description.name'),
            'errors' => $errors,
            ])
            <!--/SAMPLE NAME-->

            <!-- LIST OF CATEGORIES -->
            @include('package-category::admin.partials.select_single', [
            'name' => 'category_id',
            'label' => trans($plang_admin.'.labels.category'),
            'items' => $categories,
            'value' => @$sample->sample_id_parent,
            'description' => trans($plang_admin.'.description.category'),
            'errors' => $errors,
            ])
            <!-- /LIST OF CATEGORIES -->
        </div>

        <!--MENU 2-->
        <div id="menu_2" class="tab-pane fade">
            <h3>Menu 1</h3>
            <p>Some content in menu 1.</p>
        </div>

        <!--MENU 3-->
        <div id="menu_3" class="tab-pane fade">
            <h3>Menu 2</h3>
            <p>Some content in menu 2.</p>
        </div>

    </div>
    <!--/TAB CONTENT-->

    <!--HIDDEN FIELDS-->
    <div class='hidden-field'>
        {!! Form::hidden('id',@$sample->id) !!}
        {!! Form::hidden('context',$request->get('context',null)) !!}
    </div>
    <!--/HIDDEN FIELDS-->

{!! Form::close() !!}
<!------------------------------------------------------------------------------
| End list of elements in sample form
|------------------------------------------------------------------------------>