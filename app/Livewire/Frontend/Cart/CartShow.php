<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CartShow extends Component
{
    use LivewireAlert;
    public $cart;

    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id',$cartId)->where('user_id', auth()->user()->id)->first();
        if($cartData)
        {
            if($cartData->productColor()->where('id',$cartData->product_color_id)->exists()){

                $productColor = $cartData->productColor()->where('id',$cartData->product_color_id)->first();
                if($productColor->quantity > $cartData->quantity){

                    $cartData->decrement('quantity');
                    $this->alert('success', 'Update', [
                        'position' => 'top-end',
                        'timer' => 3000,
                        'toast' => true,
                        'text' => 'Quantity Update',
                    ]);
                } else {
                    $this->alert('warning', 'Tidak Tersedia', [
                        'position' => 'top-end',
                        'timer' => 3000,
                        'toast' => true,
                        'text' => 'Hanya '.$productColor->quantity.' Jumlah yang Tersedia',
                    ]);
                }
            } else {

                if($cartData->product->quantity > $cartData->quantity) {

                    $cartData->decrement('quantity');
                    $this->alert('success', 'Update', [
                        'position' => 'top-end',
                        'timer' => 3000,
                        'toast' => true,
                        'text' => 'Quantity Update',
                    ]);
                } else {
                    $this->alert('warning', 'Tidak Tersedia', [
                        'position' => 'top-end',
                        'timer' => 3000,
                        'toast' => true,
                        'text' => 'Hanya '.$cartData->product->quantity.' Jumlah yang Tersedia',
                    ]);
                }
            }

        } else {

            $this->alert('error', 'Error', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => 'Ada Yang Salah',
            ]);
        }
    }

    public function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id',$cartId)->where('user_id', auth()->user()->id)->first();
        if($cartData)
        {
            if($cartData->productColor()->where('id',$cartData->product_color_id)->exists()){

                $productColor = $cartData->productColor()->where('id',$cartData->product_color_id)->first();
                if($productColor->quantity > $cartData->quantity){

                    $cartData->increment('quantity');
                    $this->alert('success', 'Update', [
                        'position' => 'top-end',
                        'timer' => 3000,
                        'toast' => true,
                        'text' => 'Quantity Update',
                    ]);
                } else {
                    $this->alert('warning', 'Tidak Tersedia', [
                        'position' => 'top-end',
                        'timer' => 3000,
                        'toast' => true,
                        'text' => 'Hanya '.$productColor->quantity.' Jumlah yang Tersedia',
                    ]);
                }
            } else {

                if($cartData->product->quantity > $cartData->quantity) {

                    $cartData->increment('quantity');
                    $this->alert('success', 'Update', [
                        'position' => 'top-end',
                        'timer' => 3000,
                        'toast' => true,
                        'text' => 'Quantity Update',
                    ]);
                } else {
                    $this->alert('warning', 'Tidak Tersedia', [
                        'position' => 'top-end',
                        'timer' => 3000,
                        'toast' => true,
                        'text' => 'Hanya '.$cartData->product->quantity.' Jumlah yang Tersedia',
                    ]);
                }
            }

        } else {

            $this->alert('error', 'Error', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => 'Ada Yang Salah',
            ]);
        }
    }

    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart
        ]);
    }
}
