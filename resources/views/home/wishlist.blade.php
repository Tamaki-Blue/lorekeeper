@extends('home.layout')

@section('home-title') Wishlists: {{ $wishlist ? $wishlist->name : 'Default' }} @endsection

@section('home-content')
{!! breadcrumbs(['Wishlists' => 'wishlists', ($wishlist ? $wishlist->name : 'Default') => 'wishlists/'.($wishlist ? $wishlist->id : 'default')]) !!}

<h1 class="mb-4">
    Wishlist: {{ $wishlist ? $wishlist->name : 'Default' }}
    @if($wishlist)
        <div class="float-right">
            <a href="#" class="btn btn-secondary edit-wishlist">Edit Wishlist</a>
            <a href="#" class="btn btn-danger delete-wishlist">Delete Wishlist</a>
        </div>
    @endif
</h1>

@if(!count($items))
    <p>No items found.</p>
@else
    {!! $items->render() !!}

    <div class="row ml-md-2 mb-4">
        <div class="d-flex row flex-wrap col-12 pb-1 px-0 ubt-bottom">
            <div class="col-5 col-md-4 font-weight-bold">Name</div>
            <div class="col-5 col-md-3 font-weight-bold">Category</div>
            <div class="col-5 col-md font-weight-bold">Count {!! add_help('Set to 0 to remove an item from this wishlist.') !!}</div>
        </div>
        @foreach($items as $item)
            <div class="d-flex row flex-wrap col-12 mt-1 pt-2 px-0 ubt-top">
                <div class="col-5 col-md-4"> @if(isset($item->item->image_url)) <img class="small-icon" src="{{ $item->item->image_url }}" alt="{{ $item->item->name }}"> @endif{!! $item->item->displayName !!} </div>
                <div class="col-4 col-md-3"> {{ $item->item->category ? $item->item->category->name : '' }} </div>
                <div class="col-3 col-md text-right">
                    {!! Form::open(['url' => ($wishlist ? 'wishlists/'.$wishlist->id.'/update/'.$item->item->id : 'wishlists/default/update/'.$item->item->id)]) !!}
                        <div class="input-group mb-3">
                            {!! Form::number('count', $item->count, ['class' => 'form-control', 'aria-describedby' => 'editButton-'.$item->id]) !!}
                            <div class="input-group-append">
                                {!! Form::submit('Edit', ['class' => 'btn btn-primary', 'id' => 'editButton-'.$item->id]) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-3 col-md-1 text-right">
                    <div class="btn btn-secondary" id="move-{{ $item->item->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-arrow-alt-circle-right dropdown-toggle" data-toggle="tooltip" title="Move to Wishlist"></i>
                        <div class="dropdown-menu" aria-labelledby="move-{{ $item->item->id }}">
                            @if($wishlist)
                                {!! Form::open(['url' => 'wishlists/move/'.$item->item->id, 'id' => 'wishlistForm-0-'.$item->item->id]) !!}
                                    {!! Form::hidden('source_id', $wishlist ? $wishlist->id : 0) !!}
                                    <a class="dropdown-item" href="#" onclick="document.getElementById('wishlistForm-0-{{ $item->item->id }}').submit();">
                                        Default
                                        @if((new App\Models\User\Wishlist)->itemCount($item->id, Auth::user()))
                                                - {{ (new App\Models\User\Wishlist)->itemCount($item->item->id, Auth::user()) }} In Wishlist
                                        @endif
                                    </a>
                                {!! Form::close() !!}
                            @endif
                            @foreach(Auth::user()->wishlists as $targetWishlist)
                                @if(!$wishlist || ($targetWishlist->id != $wishlist->id))
                                    {!! Form::open(['url' => 'wishlists/'.$targetWishlist->id.'/move/'.$item->item->id, 'id' => 'wishlistForm-'.$targetWishlist->id.'-'.$item->item->id]) !!}
                                        {!! Form::hidden('source_id', $wishlist ? $wishlist->id : 0) !!}
                                        <a class="dropdown-item" href="#" onclick="document.getElementById('wishlistForm-{{ $targetWishlist->id }}-{{ $item->item->id }}').submit();">
                                            {{ $targetWishlist->name }}
                                            @if($targetWishlist->itemCount($item->item->id, Auth::user()))
                                                - {{ $targetWishlist->itemCount($item->item->id, Auth::user()) }} In Wishlist
                                            @endif
                                        </a>
                                    {!! Form::close() !!}
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {!! $items->render() !!}
@endif

@endsection
@section('scripts')
@if($wishlist)
    <script>

    $( document ).ready(function() {
        $('.edit-wishlist').on('click', function(e) {
            e.preventDefault();
            loadModal("{{ url('wishlists/edit/'.$wishlist->id) }}", 'Edit Wishlist');
        });

        $('.delete-wishlist').on('click', function(e) {
            e.preventDefault();
            loadModal("{{ url('wishlists/delete/'.$wishlist->id) }}", 'Delete Wishlist');
        });
    });

    </script>
@endif
@endsection
