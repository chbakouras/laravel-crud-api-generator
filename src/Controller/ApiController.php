<?php namespace Chbakouras\CrudApiGenerator\Controller;

use App\Http\Controllers\Controller as Controller;
use Chbakouras\CrudApiGenerator\Request\Pagination;
use Chbakouras\CrudApiGenerator\Request\Sort;
use Chbakouras\CrudApiGenerator\Service\CrudService;

/**
 * @author Chrisostomos Bakouras
 */
abstract class ApiController extends Controller
{
    use Pagination, Sort;

    /** @var  CrudService */
    protected $service;
}
