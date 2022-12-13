{!! Form::open(['url' => 'admin/masterlist/trade/' . $trade->id]) !!}
<p>This will process the trade between {!! $trade->sender->displayName !!} and {!! $trade->recipient->displayName !!} immediately. Please enter the transfer cooldown period for each character in days (the fields have been pre-filled with the default cooldown value).</p>
@foreach ($trade->getCharacterData() as $character)
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::checkbox('is_giftable[' . $character->id . ']', 1, $character->is_giftable, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                {!! Form::label('is_giftable[' . $character->id . ']', 'Is Giftable', ['class' => 'form-check-label ml-3']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::checkbox('is_tradeable[' . $character->id . ']', 1, $character->is_tradeable, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                {!! Form::label('is_tradeable[' . $character->id . ']', 'Is Tradeable', ['class' => 'form-check-label ml-3']) !!}
            </div>
        </div>
        <div class="col-md">
            <div class="row">
                <div class="col-md-4 form-group">
                    {!! Form::checkbox('is_sellable[' . $character->id . ']', 1, $character->is_sellable, ['class' => 'form-check-input', 'data-toggle' => 'toggle', 'id' => 'resellable']) !!}
                    {!! Form::label('is_sellable[' . $character->id . ']', 'Is Resellable', ['class' => 'form-check-label ml-3']) !!}
                </div>
                <div class="col-md d-flex">
                    {!! Form::label('Resale Value') !!} {!! add_help('This value is publicly displayed on the character\'s page.') !!}
                    {!! Form::text('sale_value[' . $character->id . ']', $character->sale_value, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="cooldowns[{{ $character->id }}]">Cooldown for {!! $character->displayName !!} (Number of Days)</label>
        {!! Form::text('cooldowns[' . $character->id . ']', $cooldown, ['class' => 'form-control']) !!}
    </div>
@endforeach
<div class="text-right">
    {!! Form::submit('Approve', ['class' => 'btn btn-success', 'name' => 'action']) !!}
</div>
{!! Form::close() !!}
