<!------------------------------------------------------------------------------
| List of elements in contact form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['contacts.post', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTONS-->
    <div class='btn-form'>
        <!-- DELETE BUTTON -->
        @if($item)
            <a href="{!! URL::route('contacts.delete',['id' => @$item->id, '_token' => csrf_token()]) !!}"
            class="btn btn-danger pull-right margin-left-5 delete">
                {!! trans($plang_admin.'.buttons.delete') !!}
            </a>
        @endif
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
                {!! trans($plang_admin.'.tabs.menu-1') !!}
            </a>
        </li>
    </ul>
    <!--/TAB MENU-->

    <!--TAB CONTENT-->
    <div class="tab-content">

        <!--MENU 1-->
        <div id="menu_1" class="tab-pane fade in active">

            <!--TITLE-->
            @include('package-category::admin.partials.input_text', [
                'name' => 'contact_title',
                'label' => trans($plang_admin.'.labels.title'),
                'value' => @$item->contact_title,
                'description' => trans($plang_admin.'.descriptions.title'),
                'errors' => $errors,
            ])
            <!--/TITLE-->
            <div class="row">
                <div class='col-md-6'>
                    <!--NAME-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'contact_name',
                        'label' => trans($plang_admin.'.labels.name'),
                        'value' => @$item->contact_name,
                        'description' => trans($plang_admin.'.descriptions.name'),
                        'errors' => $errors,
                    ])
                    <!-- /NAME-->
                </div>
                
                <div class='col-md-6'>
                    <!--EMAIL-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'contact_email',
                        'label' => trans($plang_admin.'.labels.email'),
                        'value' => @$item->contact_email,
                        'description' => trans($plang_admin.'.descriptions.email'),
                        'errors' => $errors,
                    ])
                    <!-- /EMAIL-->
                </div>
                
                <div class='col-md-6'>
                    <!--PHONE-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'contact_phone',
                        'label' => trans($plang_admin.'.labels.phone'),
                        'value' => @$item->contact_phone,
                        'description' => trans($plang_admin.'.descriptions.contact-phone'),
                    ])
                </div>
                
                <div class="col-md-6">
                    <!--STATUS-->
                    @include('package-category::admin.partials.select_single', [
                        'name' => 'status',
                        'label' => trans($plang_admin.'.form.status'),
                        'value' => @$item->status,
                        'items' => $status,
                        'description' => trans($plang_admin.'.descriptions.status'),
                    ])
                    <!--/STATUS-->
                </div>
            </div>
            
             <!--DESCRIPTION-->
            @include('package-category::admin.partials.textarea', [
                'name' => 'contact_description',
                'label' => trans($plang_admin.'.labels.description'),
                'value' => @$item->contact_description,
                'description' => trans($plang_admin.'.descriptions.description'),
                'rows' => 25,
                'tinymce' => true,
                'errors' => $errors,
            ])
            <!--/DESCRIPTION-->
        </div>

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