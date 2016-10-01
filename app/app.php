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
        Brand::deleteAll();
        return $app->redirect('/brands');
    });

    return $app;
?>
