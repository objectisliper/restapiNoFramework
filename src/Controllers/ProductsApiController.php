<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 20.01.19
 * Time: 18:56
 */

namespace App\Controllers;

use App\Models\Products;
use App\Models\ProductsCategories;


class ProductsApiController extends BaseController
{

    public function getProductsList($request){
        $products = $request['em']->getRepository('\App\Models\Products')->findAll();
        $productsArray = array();
        foreach ($products as $key => $product) {
            $values['id'] = $product->getId();
            $values['title'] = $product->getSku();
            $values['Asin'] = $product->getAsin();
            $productsArray[] = $values;
        }
        return $this->apiResponse($productsArray,200);
    }

    public function getProductsListByCategory($request){
        $sql = 'SELECT p.sku, p.asin FROM products_categories as pc
                                                        left join products as p on p.id = pc.product_id
                                                        where category_id = :category_id';
        $stmt = $request['em']->getConnection()->prepare($sql);
        $stmt->bindValue('category_id', $request['attr']['id']);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $this->apiResponse($products,200);
    }

    public function createProduct($request){
        $product = new Products();
        try {
            $product->setAsin($_REQUEST['asin']);
            $product->setSku($_REQUEST['sku']);
            $request['em']->persist($product);
            $request['em']->flush();
            if (isset($_POST['category'])){
                $productCategory = new ProductsCategories();
                $productCategory->setProduct($product);
                $productCategory->setCategory($request['em']->getRepository('\App\Models\Categories')
                                ->findOneBy(['title' => $_POST['category']]));
                $request['em']->persist($productCategory);
                $request['em']->flush();
            }
        } catch (\Exception $e){
            return $this->apiResponse(['success' => false, 'error' => 'product with such asin already exist'], 500);
        }
        return $this->apiResponse(['success' => true, 'msg' => 'product successful created'], 200);
    }

    public function updateProduct($request){
        $product = $request['em']->getRepository('\App\Models\Products')->findOneBy(['id' => $request['attr']['id']]);
        if (empty($product)){
            return $this->apiResponse(['success' => false, 'error' => 'such product not exist'], 500);
        }
        $assin = isset($_REQUEST['asin']) ? $_REQUEST['asin'] : $product->getAsin;
        $sku = isset($_REQUEST['sku']) ? $_REQUEST['sku'] : $product->getSku;
        if (isset($_REQUEST['category'])){
            $productCategory = new \ProductsCategories();
            $productCategory->setProduct($product);
            $productCategory->setCategory($request['em']->getRepository('\App\Models\Categories')
                ->findOneBy(['title' => $_POST['category']]));
            $request['em']->persist($productCategory);
            $request['em']->flush();
        }
        $product->setAsin($assin);
        $product->setSku($sku);
        $request['em']->persist($product);
        $request['em']->flush();

        return $this->apiResponse(['success' => true, 'msg' => 'product successful updated'], 200);
    }

    public function deleteProduct($request){
        try{
            $product = $request['em']->getRepository('\App\Models\Products')->findOneBy(['id' => $request['attr']['id']]);
            $request['em']->remove($product);
            $request['em']->flush();
        } catch (\Exception $e){
            return $this->apiResponse(['success' => false, 'error' => 'such product not exist'], 500);
        }
        return $this->apiResponse(['success' => true, 'msg' => 'product successful deleted'], 200);
    }

}