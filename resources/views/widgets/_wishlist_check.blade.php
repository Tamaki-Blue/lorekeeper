@if(Auth::check() && (new App\Models\User\Wishlist)->isWishlisted($item->id, Auth::user()))
    <i class="fa fa-clipboard-list text-success" data-toggle="tooltip" title="On one of your wishlists!"></i>
@endif
