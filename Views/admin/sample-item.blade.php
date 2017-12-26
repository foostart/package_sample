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
<table class="table table-hover">
    <thead>
        <tr>
            <th style='width:5%'>
                {{ trans($plang_admin.'.columns.order') }}
            </th>

            <!-- sample name -->
            <?php $name = 'sample_name' ?>
            <th class="hidden-xs" style='width:65%'>{!! trans($plang_admin.'.columns.name') !!}
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

            <th style='width:10%'>
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
        @foreach($items as $sample)
        <tr>
            <!--COUNTER-->
            <td> <?php echo $counter; $counter++ ?> </td>

            <!--CATEGORY NAME-->
            <td> {!! $sample->sample_name !!} </td>

            <!--OPERATOR-->
            <td>
                <a href="{!! URL::route('samples.edit', ['id' => $sample->sample_id,
                                                            '_token' => csrf_token()
                                                           ])
                        !!}">
                    <i class="fa fa-edit fa-2x"></i>
                </a>
                <a href="{!! URL::route('samples.delete',['id' => $sample->id,
                                                            '_token' => csrf_token(),
                                                             ])
                         !!}"
                   class="margin-left-5 delete">
                    <i class="fa fa-trash-o fa-2x"></i>
                </a>
                <span class="clearfix"></span>
            </td>
            <!--/END OPERATOR-->
        </tr>
        @endforeach
    </tbody>
</table>
@else
    <!--SEARCH RESULT MESSAGE-->
    <span class="text-warning">
        <h5>
            {{ trans($plang_admin.'.message-find-failed') }}
        </h5>
    </span>
    <!--/SEARCH RESULT MESSAGE-->
@endif
<div class="paginator">
    {!! $items->appends($request->except(['page']) )->render() !!}
</div>