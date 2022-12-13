{!! Form::open(['url' => 'admin/masterlist/transfer/' . $transfer->id]) !!}
@if ($transfer->status == 'Accepted')
    <p>This will process the transfer of {!! $transfer->character->displayName !!} from {!! $transfer->sender->displayName !!} to {!! $transfer->recipient->displayName !!} immediately.</p>
@else
    <p>This will approve the transfer of {!! $transfer->character->displayName !!} from {!! $transfer->sender->displayName !!} to {!! $transfer->recipient->displayName !!}, and it will be processed once the recipient accepts it.</p>
@endif
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::checkbox('is_giftable', 1, $transfer->character->is_giftable, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
            {!! Form::label('is_giftable', 'Is Giftable', ['class' => 'form-check-label ml-3']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::checkbox('is_tradeable', 1, $transfer->character->is_tradeable, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
            {!! Form::label('is_tradeable', 'Is Tradeable', ['class' => 'form-check-label ml-3']) !!}
        </div>
    </div>
    <div class="col-md">
        <div class="row">
            <div class="col-md-4 form-group">
                {!! Form::checkbox('is_sellable', 1, $transfer->character->is_sellable, ['class' => 'form-check-input', 'data-toggle' => 'toggle', 'id' => 'resellable']) !!}
                {!! Form::label('is_sellable', 'Is Resellable', ['class' => 'form-check-label ml-3']) !!}
            </div>
            <div class="col-md d-flex">
                {!! Form::label('Resale Value') !!} {!! add_help('This value is publicly displayed on the character\'s page.') !!}
                {!! Form::text('sale_value', $transfer->character->sale_value, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    {!! Form::label('cooldown', 'Cooldown (days)') !!}
    {!! Form::text('cooldown', $cooldown, ['class' => 'form-control']) !!}
</div>
<div class="text-right">
    {!! Form::submit('Approve', ['class' => 'btn btn-success', 'name' => 'action']) !!}
</div>
{!! Form::close() !!}
