<?php

namespace Source\Web;

class Seller extends Controller
{
    public function __construct()
    {
        parent::__construct("seller");
    }

    public function home(): void
    {
        //echo "Home Page...";
        echo $this->view->render("home",[]);
    }

    public function about(): void
    {
        echo "Olha que bonito o SOBRE do Site...";
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
        echo "Frequently Asked Questions";
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

    public function product (array $data): void
    {
        echo $this->view->render("product");
    }

    public function seller (array $data): void
    {
        echo $this->view->render("seller");
    }

}