<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    //Epicodus
    // $server = 'mysql:host=localhost;dbname=shoes_test';
    // $username = 'root';
    // $password = 'root';
    // $DB = new PDO($server, $username, $password);

    //home mac
    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    //home page
    $app->get("/", function() use ($app) {
        //displays home information, includes add brand and add store buttons
        return $app['twig']->render("home.html.twig", array('brands' => Brand::getAll(), 'stores' => Store::getAll()));
    });

    $app->post('/', function() use ($app) {
        //clears all and returns to the homepage
        Store::deleteAll();
        Brand::deleteAll();
        return $app->redirect('/');
    });

    //brands pages
    $app->get("addbrands", function() use ($app){
        // goes to page to add a brand
        return $app['twig']->render ("addbrands.html.twig");
    });

    $app->post("addbrands", function() use ($app){
        //takes brand and adds it to database
        $name = $_POST['brand_input'];
        $new_brand = New Brand ($name);
        $new_brand->save();
        return $app->redirect('/');
    });

    $app->get("addbrands/{store_id}", function($store_id) use ($app){
        //takes brand and adds it to a store
        // $name = $_POST['brand_input'];
        // $new_brand = New Brand ($name);
        // $new_brand->save();
        $store = Store::find($store_id);
        $brands = $store->getBrandlist();
        return $app['twig']->render ("addbrands.html.twig", array('store' => $store, 'brands' => $brands));
    });

    $app->get("addbrands/{store_id}", function($store_id) use ($app){
        //takes brand and adds it to a store
        $name = $_POST['brand_input'];
        $new_brand = New Brand ($name);
        $brand = Brand::find($)
        $new_brand->save();
        $store = Store::find($store_id);
        $store->addbrand($new_brand);
        $brands = $store->getBrandlist();
        return $app['twig']->render ("store.html.twig", array('store' => $store, 'brands' => $brands));

    });

    //stores pages
    $app->get("addstores", function() use ($app) {
        // goes to page to add a store
        return $app['twig']->render ("addstores.html.twig");
    });

    $app->post("addstores", function() use ($app) {
        // takes store and adds it to database
        $name = $_POST['store_input'];
        $new_store = New Store ($name);
        $new_store->save();
        return $app->redirect('/');
    });

    //store pages
    $app->get("/stores/{store_id}", function($store_id) use ($app) {
        //lists every brand in this store
        $store = Store::find($store_id);
        $brands = $store->getBrandlist();
        return $app['twig']->render ("store.html.twig", array('store' => $store, 'brands' => $brands));
    });

    $app->post("/stores/{id}", function($id) use ($app) {
        return $app['twig']->render ("store.html.twig");
    });


    // $app->update("/store{id}", function($id) use ($app) {
    //     return $app['twig']->render ("store.html.twig");
    // });
    //
    // $app->delete("/store{id}", function($id) use ($app) {
    //     return $app['twig']->render ("store.html.twig");
    // });

    //brand pages
    $app->get("/brand{id}", function($id) use ($app) {
        return $app['twig']->render ("brand.html.twig");
    });

    $app->post("/brand{id}", function($id) use ($app) {
        return $app['twig']->render ("brand.html.twig");
    });

    return $app;
?>
