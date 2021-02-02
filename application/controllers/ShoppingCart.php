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
        redirect(site_url('ShoppingCart/index'));
    }
    public function addNotion(int $notionId)
    {
        $this->load->model('NotionsRepository');
        $this->load->model('ShoppingCartRepository');
        $notion = $this->NotionsRepository->getNotionById($notionId);

        $cartValuesArray = array(
            'session_id' => session_id(),
            'notion_id' => $notion->notion_id,
            'fabric_id' => null,
            'class_id' => null,
            'product_name' => $notion->name,
            'product_desc' => $notion->description,
            'quantity' => 1,
            'price' => $notion->cost,
            'image_path' => $notion->image
        );

        $this->ShoppingCartRepository->addCart($cartValuesArray);

        //TODO redirect Shoppingcart/index
        redirect(site_url('ShoppingCart/index'));
    }
    public function addClass(int $classId)
    {
        $this->load->model('ClassRepository');
        $this->load->model('ShoppingCartRepository');
        $class = $this->ClassRepository->getClassById($classId);

        $cartValuesArray = array(
            'session_id' => session_id(),
            'notion_id' => null,
            'fabric_id' => null,
            'class_id' => $class->class_id,
            'product_name' => $class->name,
            'product_desc' => $class->description,
            'quantity' => 1,
            'price' => $class->cost,
            'image_path' => $class->image
        );

        $this->ShoppingCartRepository->addCart($cartValuesArray);

        //TODO redirect Shoppingcart/index
        redirect(site_url('ShoppingCart/index'));
    }

    public function index() //displayShoppingcart()
    {
        $this->load->model('ShoppingCartRepository');

        $carts = $this->ShoppingCartRepository->GetCartsBySessionId( session_id());
        $vars = array(
            'carts' => $carts
        );
        $view_data = array(
            'content' => $this->load->view('content/ShoppingCart_content', $vars, True)
        );
        var_dump(session_id());
		 $this->load->view('ShoppingCart', $view_data);
    }
    public function handleCheckOut()
	{
        $this->load->model('ShoppingCartRepository');
        $this->load->model('purchaseService');
		$cartItems = $this->ShoppingCartRepository->GetCartsBySessionId(Session_Id());

		$purchaseValuesArray = array(
			"memberId" => 1, //customerNumber
			// "date" => now()
		);

		$purchase = $this->purchaseService->addpurchase($purchaseValuesArray);
		foreach ($cartItems as $cartItem) {
			$purchaseItemValuesArray = array(
				"purchaseNumber" => $purchase->purchase_id,
				"productID" => $cartItem->productId,
				"Date" => now()
			);
			/*$orderItem = */$this->purchaseItemService->addpurchaseItem($purchaseItemValuesArray);
			//option 1$this->ShoppingCartRepository->deleteShopppingCartById($cartItem->Id);
		}
		//options 2
        $this->ShoppingCartRepository->deleteCartsBySessionId($cartItem->Session_Id);
        
        
        redirect('content/ShoppingCart_content');
        
	}
}
