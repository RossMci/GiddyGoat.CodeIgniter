<?php

defined('BASEPATH') or exit('No direct script access allowed');
// handles the shopping cart in the program
class ShoppingCart extends CI_Controller
{
    // manges the user acess 
    public function UserHasAccess()
    {
        $this->load->library('session');
        // loads the user in the session 
        $user = $this->session->user;
        // $user = session_id();
        //checks if it null to see if logged in 
        // if ($user == NULL) {
          if ( $this->session->userdata('UserId') == false){
            $view_data = array(
                'content' => $this->load->view('content/main_content', null, True),
                "error" => "Please login"
            );

            $this->load->view('Layout', $view_data);
            // $error= 'alert("Hello! I am an alert box!!")';
            // redirect(site_url('GGHome/index'));
            // $error= 'alert("Hello! I am an alert box!!")';
            return false;
        }
        return true;
    }
    // adds the fabric detials too the cart 
    public function AddFabric(int $fabricId)
    {

        $this->load->model('FabricRepository');
        $this->load->model('ShoppingCartRepository');
        var_dump($_POST);
        $quantity = $this->input->post('quantity');
        $fabric = $this->FabricRepository->getFabricById($fabricId);
        $cartValuesArray = array(
            'session_id' => session_id(),
            'notion_id' => null,
            'fabric_id' => $fabric->fabric_id,
            'class_id' => null,
            'product_name' => $fabric->name,
            'product_desc' => $fabric->description,
            'quantity' => $quantity,
            'price' => $fabric->cost,
            'image_path' => $fabric->image
        );

        $this->ShoppingCartRepository->addCart($cartValuesArray);

        redirect(site_url('ShoppingCart/index'));
    }
    // adds the Notion detials too the cart 
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

        redirect(site_url('ShoppingCart/index'));
    }

    // adds the Class detials too the cart  and books a class
    public function addClass(int $classId)
    {
        $this->load->model('ClassRepository');
        $this->load->model('ShoppingCartRepository');
        $class = $this->ClassRepository->getClassById($classId);
        var_dump($class);
        $cartValuesArray = array(
            'session_id' => session_id(),
            'notion_id' => null,
            'fabric_id' => null,
            'class_id' => $class->class_id,
            'product_name' => $class->name,
            'product_desc' => $class->description,
            'quantity' => 1,
            'price' => $class->price,
            'image_path' => "assets/images/classes/classes.jpg"
        );
        $BookValuesArray = array(
            'class_id' => $class->class_id,
            'member_id' =>  $this->session->userdata("UserId"),
            'paidInFull' => 'n',
            'price' => $class->price,

        );
        $this->ClassRepository->BookClass($BookValuesArray);
        $this->ShoppingCartRepository->addCart($cartValuesArray);

        redirect(site_url('ShoppingCart/index'));
    }
    // handles the books when checked out to keep track if its been paid for.
    function CheckoutBookedClass($classId)
    {
        $class = $this->ClassRepository->getClassById($classId);
        $CheckoutBookValuesArray = array(
            'paidInFull' => 'Y'
        );
        $this->ClassRepository->CheckoutBookedClass($CheckoutBookValuesArray);
    }
    public function index() //displayShoppingcars the shopping cart 
    {
        if (!$this->UserHasAccess()) {
            return;
        } else {
            $this->load->model('ShoppingCartRepository');

            $carts = $this->ShoppingCartRepository->GetCartsBySessionId(session_id());
            $vars = array(
                'carts' => $carts
            );
            $view_data = array(
                'content' => $this->load->view('content/ShoppingCart_content', $vars, True)
            );
            // var_dump(session_id());
            $this->load->view('ShoppingCart', $view_data);
        }
    }
    // handles the cart item customer wishs too buy them.
    public function handleCheckOut()
    {
        $this->load->model('ShoppingCartRepository');
        $this->load->model('purchaseService');
        $this->load->model('purchaseItemService');
        $this->load->model('ClassRepository');
        if (!$this->UserHasAccess()) {
            return;
        } else {


            $cartItems = $this->ShoppingCartRepository->GetCartsBySessionId(Session_Id());

            $purchaseValuesArray = array(
                "memberId" => $this->session->userdata("UserId")
            );

            $purchase = $this->purchaseService->addpurchase($purchaseValuesArray);
            foreach ($cartItems as $cartItem) {
                $purchaseItemValuesArray = array(
                    "purchase_id" => $purchase->purchase_id,
                    "class_id" => $cartItem->class_id,
                    "fabric_id" => $cartItem->fabric_id,
                    "notion_id" => $cartItem->notion_id,
                    "qty" => $cartItem->quantity,
                    "cost" => $cartItem->price,
                );
                $CheckoutBookValuesArray = array(
                    "class_id" => $cartItem->class_id,
                    "memberId" => $this->session->userdata("UserId"),
                    "paidInFull" => 'Y'
                );

                /*$orderItem = */
                $this->ClassRepository->CheckoutBookedClass($CheckoutBookValuesArray);
                $this->purchaseItemService->addpurchaseItem($purchaseItemValuesArray);
                //option 1$this->ShoppingCartRepository->deleteShopppingCartById($cartItem->Id);
            }
            //options 2
            $this->ShoppingCartRepository->deleteCartsBySessionId(Session_Id());

            // redirect('purchases/' . $purchase->purchase_id);
            //TODO Correct way
            //redirect('purchases/' . $purchase->purchase_id);
            redirect(site_url('ShoppingCart/index'));
        }
    }
    // removes one item from cart.
    function RemoveCartItem($id)
    {
        $this->load->model('ShoppingCartRepository');
        $this->ShoppingCartRepository->RemoveCartItem($id);
        redirect(site_url('ShoppingCart/index'));
    }
}
