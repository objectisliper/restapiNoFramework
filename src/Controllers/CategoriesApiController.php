<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 20.01.19
 * Time: 17:12
 */

namespace App\Controllers;


use App\Models\Categories;
use Doctrine\ORM\EntityManager;

class CategoriesApiController extends BaseController
{
    public function getCategoriesList($request){
        $categories = $request['em']->getRepository('\App\Models\Categories')->findAll();
        $categoryArray = array();
        foreach ($categories as $key => $category) {
            $values['id'] = $category->getId();
            $values['title'] = $category->getTitle();
            $categoryArray[] = $values;
        }
        return $this->apiResponse($categoryArray,200);
    }

    public function createCategory($request){
        $category = new Categories();
        try {
            $category->setTitle($_REQUEST['title']);
            $request['em']->persist($category);
            $request['em']->flush();
        } catch (\Exception $e){
            return $this->apiResponse(['success' => false, 'error' => 'category with such asin already exist'], 500);
        }
        return $this->apiResponse(['success' => true, 'msg' => 'category successful created'], 200);
    }

    public function updateCategory($request){
        $category = $request['em']->getRepository('\App\Models\Categories')->findOneBy(['id' => $request['attr']['id']]);
        if (empty($category)){
            return $this->apiResponse(['success' => false, 'error' => 'such category not exist'], 500);
        }
        if (!isset($_REQUEST['title'])){
            return $this->apiResponse(['success' => false, 'error' => 'We need title!'], 500);
        }
        $category->setTitle($_REQUEST['title']);
        $request['em']->persist($category);
        $request['em']->flush();

        return $this->apiResponse(['success' => true, 'msg' => 'category successful updated'], 200);
    }

    public function deleteCategory($request){
        try{
            $category = $request['em']->getRepository('\App\Models\Categories')->findOneBy(['id' => $request['attr']['id']]);
            $request['em']->remove($category);
            $request['em']->flush();
        } catch (\Exception $e){
            return $this->apiResponse(['success' => false, 'error' => 'such category not exist'], 500);
        }
        return $this->apiResponse(['success' => true, 'msg' => 'category successful deleted'], 200);
    }

}