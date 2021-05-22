<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class MenuAdmin extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $active;
    public function __construct($active)
    {
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $name = Auth::user()->name;

        return view('components.menu-admin', compact('name'));
    }

    public function Menus()
    {
        return [
            [
                'label' => 'Kategori',
                'icon' => 'fas fa-th-list',
                'link' => '#',
            ],
            [
                'label' => 'Produk',
                'icon' => 'fas fa-tags',
                'link' => '#',
            ],
            [
                'label' => 'Pengguna',
                'icon' => 'fas fa-user',
                'link' => '#',
            ],
            [
                'label' => 'Pesanan',
                'icon' => 'fas fa-shopping-basket',
                'link' => '#',
            ],
            [
                'label' => 'Pembayaran',
                'icon' => 'fas fa-cash-register',
                'link' => '#',
            ],
        ];
    }

    public function isActive($label)
    {
        return $label == $this->active;
    }
}
