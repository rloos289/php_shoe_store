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

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

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

//brands page
    $app->get('/brands', function() use ($app) {
        //lists brands page that allows users to add and delete brands
        return $app['twig']->render("brands.html.twig", array('brands' => Brand::getAll()));
    });

    $app->post('/brands', function() use ($app) {
        //allows the user to add a brand to the brands page
        $brand_name = $_POST['brand_input'];
        $brand = new Brand($brand_name);
        $brand->save();
        return $app['twig']->render("brands.html.twig", array('brands' => Brand::getAll()));
    });

    $app->post('/clearbrands', function() use ($app) {
        //delete all brands from the brand page and the database
        Brand::deleteAll();
        return $app->redirect('/brands');
    });

//stores page
    $app->get('/stores', function() use ($app) {
        //lists stores page that allows users to add and delete brands
        return $app['twig']->render("stores.html.twig", array('stores' => Store::getAll()));
    });

    $app->post('/stores', function() use ($app) {
        //adds a store to the stores page
        $store_name = $_POST['store_input'];
        $store = new Store($store_name);
        $store->save();
        return $app['twig']->render("stores.html.twig", array('stores' => Store::getAll()));
    });

    $app->post('/clearstores', function() use ($app) {
        //delete all stores from the brand page and the database
        Store::deleteAll();
        return $app->redirect('/stores');
    });

//individual brand pages
    $app->get('/brand/{id}', function($id) use ($app) {
        //lists individual brand information
        $brand = Brand::find($id);
        $stores = $brand->getStorelist();
        return $app['twig']->render("brand.html.twig", array('brand' => $brand, 'stores' => $stores));
    });

    // $app->post('/brand/{id}', function($id) use ($app) {
    //     //add a brand to a store
    //     $brand = Brand::find($id);
    //     $store = new Store($_POST['store_input']);
    //     $store->save();
    //     $store = Store::find($store);
    //     $brand->addStore($store);
    //     $stores = $brand->getStorelist();
    //     return $app['twig']->render("brand.html.twig", array('brand' => $brand, 'allstores' => store::getAll(), 'stores' => $stores));
    // });

//individual store pages
    $app->get("/store/{id}", function($id) use ($app) {
        //individual store home page
        $store = Store::find($id);
        $brands = $store->getBrandlist();
        return $app['twig']->render("store.html.twig", array('store' => $store));
    });

    $app->delete("/store/delete/{id}", function($id) use ($app) {
        //deletes individual store
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render("home.html.twig", array('brands' => Brand::getAll(), 'stores' => Store::getAll()));
    });

    $app->patch("/store/update/{id}", function ($id) use ($app) {
        $store = Store::find($id);
        $store->update($_POST['new_store_name']);
        return $app['twig']->render("store.html.twig", array('store' => $store));
    });

    return $app;
?>
