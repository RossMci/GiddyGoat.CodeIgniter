<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ShoppingCart extends CI_Controller
{
    //to do addNotion , AddClass
    public function AddFabric(int $fabricId)
    {
        $this->load->model('FabricRepository');
        $this->load->model('ShoppingCartRepository');
        $fabric = $this->FabricRepository->getFabricById($fabricId);

        $cartValuesArray = array(
            'session_id' => session_id(),
            'notion_id' => null,
            'fabric_id' => $fabric->fabric_id,
            'class_id' => null,
            'product_name' => $fabric->name,
            'product_desc' => $fabric->description,
            'quantity' => 1,
            'price' => $fabric->cost,
            'image_path' => $fabric->image
        );

        $this->ShoppingCartRepository->addCart($cartValuesArray);

        //TODO redirect Shoppingcart/index
    }

    public function index() //displayShoppingcart()
    {
    }
    public function handleCheckout() //displayShoppingcart()
    {
    }
}
