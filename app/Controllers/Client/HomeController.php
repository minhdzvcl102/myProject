<?php

namespace App\Controllers\Client;

use App\Controller;
use App\Models\Banner;
use App\Models\CartUser;
use App\Models\Categories;
use App\Models\Comment;
use App\Models\Product;


class HomeController extends Controller
{
  protected $product;
  protected $banner;
  protected $categories;
  protected $comment;
  protected $cartUser;
  public function __construct()
  {
    $this->product = new Product();
    $this->banner = new Banner();
    $this->categories = new Categories();
    $this->comment = new Comment();
    $this->cartUser = new CartUser();
  }
  public function index()
  {

    if (!empty($_SESSION['user'])) {
      $listCart = $this->cartUser->findAllcartUser($_SESSION['user']['id']);
      $_SESSION['listCart'] = $listCart;
      $total = 0;
      $vat = 0;
      foreach ($_SESSION['listCart'] as $item) {
        $total +=  $item['is_sale'] == 1
          ? $item['price_sale'] * $item['quantity']
          : $item['price'] * $item['quantity'];
      }
      $_SESSION['vat'] = $total * 0.02;
      $_SESSION['total'] = $total;
    }
    // debug($_SESSION['listCart']);
    $listProducts = $this->product->findAll();
    $listBanners = $this->banner->findAll();
    $listCategories = $this->categories->findAll();
    $listProducts = array_filter(
      $listProducts,
      function ($product) {
        return $product['is_show_home'] == 1;
      }
    );

    // debug($listProducts);

    return view('client.home', compact('listProducts', 'listBanners', 'listCategories'));
  }
  public function listProduct()
  {

    if (!empty($_SESSION['user'])) {
      $listCart = $this->cartUser->findAllcartUser($_SESSION['user']['id']);
      $_SESSION['listCart'] = $listCart;
      $total = 0;
      $vat = 0;
      foreach ($_SESSION['listCart'] as $item) {
        $total +=  $item['is_sale'] == 1
          ? $item['price_sale'] * $item['quantity']
          : $item['price'] * $item['quantity'];
      }
      $_SESSION['vat'] = $total * 0.02;
      $_SESSION['total'] = $total;
    }

    $listProducts = $this->product->findAll();
    $listProducts = array_filter($listProducts, function ($product) {
      return $product['is_show_home'] == 1;
    });
    if (isset($_GET['search'])) {
      $search = $_GET['search'];
      $listProducts = array_filter($listProducts, function ($product) use ($search) {
        return str_contains($product['name'], $search);
      });
    }
    // debug($categories_search);
    if (isset($_GET['categories_search'])) {
      $categories_search = $_GET['categories_search'];
      $listProducts = array_filter($listProducts, function ($product) use ($categories_search) {
        return $product['category_id'] == $categories_search;
      });
    }
  
    if(isset($_GET['amount'])){
      $priceRange = $_GET['amount'];
      // Loại bỏ ký tự `$` và tách chuỗi theo dấu `-`
      list($min, $max) = explode('-', str_replace('$', '', $priceRange));
  
      // Trim để loại bỏ khoảng trắng
      $min = trim($min);
      $max = trim($max);

      $listProducts = array_filter($listProducts, function ($product) use ($min, $max) {
        if ($product['is_sale'] == 1) {
          return $product['price_sale'] >= $min && $product['price_sale'] <= $max;
        } else {
          return $product['price'] >= $min && $product['price'] <= $max;
        }
      });
    }
    $listCategories = $this->categories->findAll();
    $listCategories = array_filter($listCategories, function ($categories) {
      return $categories['is_active'] == 1;
    });
    // debug($listProducts);
    return view('client.listProduct', compact('listProducts', 'listCategories'));
  }

  function detailProduct($id, $category_id)
  {
    // debug($id,$category_id);
    $listProducts = $this->product->findAll();
    $detailProduct = $this->product->findId($id,);
    $detailCategories = $this->categories->findId($category_id);
    $listComment = $this->comment->findIdCmt($id);
    // debug($listComment);
    $listComment = array_filter($listComment, function ($comment) {
      return $comment['is_show'] == 1;
    });
    // debug($_SESSION['user']);

    return view('client.detail', compact('detailProduct', 'detailCategories', 'listProducts', 'listComment'));
  }
}
