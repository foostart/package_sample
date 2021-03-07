<!------------------------------------------------------------------------------
| List of elements in contact form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['contacts.sample', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

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

            <!--contact title-->
            @include('package-contact::admin.partials.input_text', [
            'name' => 'contact_title',
            'label' => trans($plang_admin.'.labels.title'),
            'value' => @$item->contact_title,
            'description' => trans($plang_admin.'.descriptions.title'),
            'errors' => $errors,
            ])
            <!--/contact title-->

            <!--contact email-->
            @include('package-contact::admin.partials.textarea', [
            'name' => 'contact_email',
            'label' => trans($plang_admin.'.labels.email'),
            'value' => @$item->contact_email,
            'description' => trans($plang_admin.'.descriptions.email'),
            'tinymce' => false,
            'errors' => $errors,
            ])
            <!--/contact email-->

            <!--contact phone-->
            @include('package-contact::admin.partials.input_text', [
            'name' => 'contact_phone',
            'label' => trans($plang_admin.'.labels.phone'),
            'value' => @$item->contact_phone,
            'description' => trans($plang_admin.'.descriptions.phone'),
            'errors' => $errors,
            ])
            <!--/contact title-->

            <!--contact message-->
            @include('package-contact::admin.partials.textarea', [
            'name' => 'contact_message',
            'label' => trans($plang_admin.'.labels.message'),
            'value' => @$item->contact_message,
            'description' => trans($plang_admin.'.descriptions.message'),
            'rows' => 50,
            'tinymce' => true,
            'errors' => $errors,
            ])
            <!--/contact message-->

            

        

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
| End list of elements in contact form
|------------------------------------------------------------------------------>