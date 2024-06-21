<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
* @OA\Info(
*             title="ElevaCap API",
*             version="1.0",
*             description="All the API endpoints for ElevaCap",
* )
*
* @OA\Server(url="http://localhost:8000/api")
*/

class ProspectControlller extends Controller
{
    /**
     * @OA\Get(
     *     path="/prospects",
     *     tags={"Prospects"},
     *     summary="Get list of Prospects",
     *     description="Returns list of Prospects",
     *  @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *   )
     * )
     */
    //get all prospects
    public function index()
    {

    }

    //post
    public function store()
    {

    }

    //delete
    public function destroy()
    {

    }

    //get a single prospect
    public function show()
    {

    }

    //put
    public function update()
    {

    }

    //patch
    public function updatePartial()
    {

    }

}
