<?php

namespace Source\Web;

class Site extends Controller
{
    public function __construct()
    {
        parent::__construct("web");
    }

    public function home(): void
{
    $productModel = new \Source\Models\Products\Product();
    $products = $productModel->findAll(); // Puxa todos os produtos

    echo $this->view->render("home", [
        "productsData" => $products // Passa pra view
    ]);
}

    public function about(): void
    {
        echo $this->view->render("about");
    }

    public function contact(): void
    {
        echo "Contact Us";
    }

    public function location(): void
    {
        echo "Our Location";
    }

    public function cart(): void
    {
        echo $this->view->render("cart");
    }

    public function services(): void
    {
        echo "Our Services";
    }

    public function faqs(): void
    {
        echo $this->view->render("faqs");
    }

    public function login(): void
    {
        echo $this->view->render("login");
    }

    public function error (array $data): void
    {
        echo "Error {$data["errcode"]}...";
    }

    public function register (array $data): void
    {
        echo $this->view->render("register");
    }

    public function profile (array $data): void
    {
        echo $this->view->render("profile");
    }

    public function reset_password (array $data): void
    {
        echo $this->view->render("reset_password");
    }

    public function reset_password_phone (array $data): void
    {
        echo $this->view->render("reset_password_phone");
    }

    public function new_password (array $data): void
    {
        echo $this->view->render("new_password");
    }

    public function product (array $data): void
    {
        echo $this->view->render("product");
    }

    public function seller_register (array $data): void
    {
        echo $this->view->render("seller_register");
    }

    public function confirm_email (array $data): void
    {
        echo $this->view->render("confirm_email");
    }
}