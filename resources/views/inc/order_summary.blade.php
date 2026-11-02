{{-- AJAX-rendered cart summary partial --}}
@foreach(\Cart::getContent() as $item)
    @php
        $assoc = $item->associatedModel ?? null;
        $thumbUrl = null;
        if ($assoc && !($assoc instanceof \__PHP_Incomplete_Class)) {
            $thumbUrl = is_object($assoc) ? ($assoc->image ?? ($assoc->get_thumb->file_url ?? null)) : null;
        }
    @endphp
    <tr>
        <td>
            <a href="{{route('cart.item.delete', $item->id)}}"><i class="fa fa-trash-o text-danger"></i></a>
        </td>
        <td class="text-left">
            @if($thumbUrl)
                <img width="35" src="{{$thumbUrl}}" alt="">
            @endif
            <span style="font-size: 12px">{{$item->name}}</span>
            @if(!empty($item->attributes['variant']))
                <small class="text-muted d-block">{{$item->attributes['variant']}}</small>
            @endif
        </td>
        <td>{{$item->price}}</td>
        <td width="15%" class="cart_qty">
            <a href="{{route('cart.item.minus', $item->id)}}"><i class="fa fa-minus"></i></a>
            <input type="text" min="1" value="{{$item->quantity}}" readonly style="width:40px;text-align:center">
            <a href="{{route('cart.item.plus', $item->id)}}"><i class="fa fa-plus"></i></a>
        </td>
        <td>{{$item->getPriceSum()}}</td>
    </tr>
@endforeach

