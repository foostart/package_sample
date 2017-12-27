<!--ADD NEW SAMPLE ITEM-->
<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('samples.edit', []) !!}" class="btn btn-info pull-right">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            {{trans($plang_admin.'.buttons.add')}}
        </a>
    </div>
</div>
<!--/ADD NEW SAMPLE ITEM-->

@if( ! $items->isEmpty() )
<?php
    $withs = [
        'order' => '5%',
        'name' => '30%',
        'updated_at' => '30%',
        'operations' => '20%',
    ]
?>
<table class="table table-hover">

    <thead>
        <tr>

            <!--ORDER-->
            <th style='width:{{ $withs['order'] }}'>
                {{ trans($plang_admin.'.columns.order') }}
            </th>

            <!-- NAME -->
            <?php $name = 'sample_name' ?>

            <th class="hidden-xs" style='width:{{ $withs['name'] }}'>{!! trans($plang_admin.'.columns.name') !!}
                <a href='{!! $sorting["url"][$name] !!}' class='tb-id' data-order='asc'>
                    @if($sorting['items'][$name] == 'asc')
                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>
                    @elseif($sorting['items'][$name] == 'desc')
                        <i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>
                    @else
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                    @endif
                </a>
            </th>

            <!-- NAME -->
            <?php $name = 'updated_at' ?>

            <th class="hidden-xs" style='width:{{ $withs['updated_at'] }}'>{!! trans($plang_admin.'.columns.updated_at') !!}
                <a href='{!! $sorting["url"][$name] !!}' class='tb-id' data-order='asc'>
                    @if($sorting['items'][$name] == 'asc')
                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>
                    @elseif($sorting['items'][$name] == 'desc')
                        <i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>
                    @else
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                    @endif
                </a>
            </th>

            <!--OPERATIONS-->
            <th style='width:{{ $withs['operations'] }}'>
                {{ trans($plang_admin.'.columns.operations') }}
            </th>
        </tr>

    </thead>

    <tbody>
        <?php
            global $counter;
            $nav = $items->toArray();
            $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>

        @foreach($items as $item)
            <tr>
                <!--COUNTER-->
                <td> <?php echo $counter; $counter++ ?> </td>

                <!--NAME-->
                <td> {!! $item->sample_name !!} </td>

                <!--UPDATED AT-->
                <td> {!! $item->updated_at !!} </td>

                <!--OPERATOR-->
                <td>
                    <!--edit-->
                    <a href="{!! URL::route('samples.edit', ['id' => $item->sample_id,
                                                                '_token' => csrf_token()
                                                               ])
                            !!}">
                        <i class="fa fa-edit fa-2x"></i>
                    </a>

                    <!--delete-->
                    <a href="{!! URL::route('samples.delete',['id' => $item->id,
                                                                '_token' => csrf_token(),
                                                                 ])
                             !!}"
                       class="margin-left-5 delete">
                        <i class="fa fa-trash-o fa-2x"></i>
                    </a>

                    <!--copy-->
                    <a href="{!! URL::route('samples.edit',['id' => $item->id,
                                                            'cid' => $item->id,
                                                            '_token' => csrf_token(),
                                                            ])
                             !!}"
                        class="margin-left-5 delete">
                        <i class="fa fa-files-o fa-2x" aria-hidden="true"></i>
                    </a>
                    <span class="clearfix"></span>
                </td>

            </tr>
        @endforeach

    </tbody>

</table>
@else
    <!--SEARCH RESULT MESSAGE-->
    <span class="text-warning">
        <h5>
            {{ trans($plang_admin.'.description.not-found') }}
        </h5>
    </span>
    <!--/SEARCH RESULT MESSAGE-->
@endif
<div class="paginator">
    {!! $items->appends($request->except(['page']) )->render() !!}
</div>