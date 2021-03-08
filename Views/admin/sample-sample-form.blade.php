<!------------------------------------------------------------------------------
| List of elements in sample form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['samples.sample', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTONS-->
    <div class='btn-form'>
    

        <!-- SAVE BUTTON -->
        {!! Form::submit(trans($plang_admin.'.buttons.sent'), array("class"=>"btn btn-info pull-right ")) !!}
        <!-- /SAVE BUTTON -->
    </div>
    <!--/BUTTONS-->


    <!--TAB CONTENT-->
    <div class="tab-content">

        <!--MENU 1-->
        <div id="menu_1" class="tab-pane fade in active">

            <!--sample title-->
            @include('package-sample::admin.partials.input_text', [
            'name' => 'sample_title',
            'label' => trans($plang_admin.'.labels.title'),
            'value' => @$item->sample_title,
            'description' => trans($plang_admin.'.descriptions.title'),
            'errors' => $errors,
            ])
            <!--/sample title-->

            <!--sample email-->
            @include('package-sample::admin.partials.textarea', [
            'name' => 'sample_email',
            'label' => trans($plang_admin.'.labels.email'),
            'value' => @$item->sample_email,
            'description' => trans($plang_admin.'.descriptions.email'),
            'tinymce' => false,
            'errors' => $errors,
            ])
            <!--/sample email-->

            <!--sample phone-->
            @include('package-sample::admin.partials.input_text', [
            'name' => 'sample_phone',
            'label' => trans($plang_admin.'.labels.phone'),
            'value' => @$item->sample_phone,
            'description' => trans($plang_admin.'.descriptions.phone'),
            'errors' => $errors,
            ])
            <!--/sample title-->

            <!--sample message-->
            @include('package-sample::admin.partials.textarea', [
            'name' => 'sample_message',
            'label' => trans($plang_admin.'.labels.message'),
            'value' => @$item->sample_message,
            'description' => trans($plang_admin.'.descriptions.message'),
            'rows' => 50,
            'tinymce' => true,
            'errors' => $errors,
            ])
            <!--/sample message-->

            

        

    </div>
    <!--/TAB CONTENT-->

    <!--HIDDEN FIELDS-->
    <div class='hidden-field'>
        {!! Form::hidden('id',@$item->id) !!}
        {!! Form::hidden('context',$request->get('context',null)) !!}
    </div>
    <!--/HIDDEN FIELDS-->

{!! Form::close() !!}
<!------------------------------------------------------------------------------
| End list of elements in sample form
|------------------------------------------------------------------------------>