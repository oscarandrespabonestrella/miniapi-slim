<?php
require_once 'vendor/autoload.php';
require 'database.php';



$app = new \Slim\Slim();


$recipes=\Cocktails\RecipesPopularityQuery::create();

$app->response;

$app->get("/v1/recipes/popular/:how_many",function($how_many) use ($app,$recipes){
    $populars = $recipes
        ->orderByFavorited("desc")
        ->limit($how_many)
        ->find()
        ->toJson();
    echo $populars;
});


$app->put("/v1/recipes/favorite/:url",function($url) use ($recipes,$app){
    $request = $app->request;
    $getfavorite = $recipes->findByUrl($url);

    if ( $getfavorite != null ) {
        $getfavorite = $recipes->findOneByUrl($url);
        $qtyFavorite=$getfavorite->getFavorited()+1;
        $getfavorite->setFavorited($qtyFavorite);
        $getfavorite->save();
    } else {
        $getfavorite->setUrl($url);
        $getfavorite->setTitle($request->params("title"));
        $getfavorite->save();
    }



});


$app->put("/v1/recipes/unfavorite/:id",function($id) use ($recipes,$app){
    $getfavorite = $recipes->findOneByRecipeId($id);
    if ( $getfavorite != null ) {
        $qtyFavorite = $getfavorite->getFavorited() - 1;
        $getfavorite->setFavorited($qtyFavorite);
        $getfavorite->save();
    }else {
        $app->notFound();
    }
});


//$app->delete("/v1/recipes/favorite/:id",function($id) use ($recipes,$app){
//    $getfavorite = $recipes->findOneByRecipeId($id);
//    $getfavorite->delete();
//});




$app->run();


